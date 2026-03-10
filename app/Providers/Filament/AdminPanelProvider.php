<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Auth\Login;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->brandName('Energy Solutions')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook('panels::head.end', fn (): HtmlString => new HtmlString(
                '<link rel="stylesheet" href="' . asset('assets/css/flaticon.css') . '">' .
                '<link rel="stylesheet" href="' . asset('assets/css/icomoon.css') . '">' .
                '<link rel="stylesheet" href="' . asset('assets/css/font-awesome.min.css') . '">' .
                (request()->routeIs('filament.admin.auth.login')
                    ? '<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>'
                    : '')
            ))
            ->renderHook('panels::auth.login.form.after', fn (): HtmlString => new HtmlString('
                <div style="margin-top: 1rem;">
                    <div class="cf-turnstile"
                         data-sitekey="' . config('services.turnstile.site_key') . '"
                         data-callback="onTurnstileSuccess"
                         data-expired-callback="onTurnstileExpired"
                         data-error-callback="onTurnstileError">
                    </div>
                </div>
                <script>
                    function onTurnstileSuccess(token) {
                        Livewire.dispatch("captchaTokenReady", { token: token });
                    }
                    function onTurnstileExpired() {
                        Livewire.dispatch("captchaTokenReady", { token: "" });
                    }
                    function onTurnstileError() {
                        Livewire.dispatch("captchaTokenReady", { token: "" });
                    }
                </script>
            '));
    }
}
