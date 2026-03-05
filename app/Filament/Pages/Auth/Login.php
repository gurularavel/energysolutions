<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;

class Login extends BaseLogin
{
    public string $captchaToken = '';

    #[On('captchaTokenReady')]
    public function setCaptchaToken(string $token): void
    {
        $this->captchaToken = $token;
    }

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                ...parent::form($form)->getComponents(withHidden: true),
                Hidden::make('captchaToken'),
            ]);
    }

    public function authenticate(): ?LoginResponse
    {
        $this->validateCaptcha();

        return parent::authenticate();
    }

    protected function validateCaptcha(): void
    {
        if (empty($this->captchaToken)) {
            throw ValidationException::withMessages([
                'data.email' => 'reCAPTCHA doğrulaması tamamlanmadı. Yenidən cəhd edin.',
            ]);
        }

        $apiKey = config('services.recaptcha.enterprise_api_key');
        $projectId = config('services.recaptcha.project_id');

        if ($apiKey && $projectId) {
            $response = Http::post(
                "https://recaptchaenterprise.googleapis.com/v1/projects/{$projectId}/assessments?key={$apiKey}",
                [
                    'event' => [
                        'token'          => $this->captchaToken,
                        'siteKey'        => config('services.recaptcha.site_key'),
                        'expectedAction' => 'login',
                    ],
                ]
            );

            $result = $response->json();
            $score  = $result['riskAnalysis']['score'] ?? 0;

            if ($score < 0.5) {
                throw ValidationException::withMessages([
                    'data.email' => 'reCAPTCHA doğrulaması uğursuz oldu. Bot aktivliyi aşkarlandı.',
                ]);
            }
        }
    }
}
