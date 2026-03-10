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
                'data.email' => 'Turnstile doğrulaması tamamlanmadı. Yenidən cəhd edin.',
            ]);
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret'   => config('services.turnstile.secret_key'),
            'response' => $this->captchaToken,
        ]);

        $result = $response->json();

        if (empty($result['success'])) {
            throw ValidationException::withMessages([
                'data.email' => 'Turnstile doğrulaması uğursuz oldu. Yenidən cəhd edin.',
            ]);
        }
    }
}
