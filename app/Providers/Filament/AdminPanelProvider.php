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
                    ? '<script src="https://www.google.com/recaptcha/enterprise.js?render=' . config('services.recaptcha.site_key') . '" async defer></script>'
                    : '')
            ))
            ->renderHook('panels::auth.login.form.after', fn (): HtmlString => new HtmlString('
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        function executeCaptcha() {
                            if (typeof grecaptcha === "undefined" || typeof grecaptcha.enterprise === "undefined") {
                                setTimeout(executeCaptcha, 300);
                                return;
                            }
                            grecaptcha.enterprise.ready(function () {
                                grecaptcha.enterprise.execute("' . config('services.recaptcha.site_key') . '", { action: "login" })
                                    .then(function (token) {
                                        Livewire.dispatch("captchaTokenReady", { token: token });
                                    });
                            });
                        }
                        executeCaptcha();

                        // Refresh token every 90 seconds (token expires in 2 min)
                        setInterval(function () {
                            if (typeof grecaptcha !== "undefined" && typeof grecaptcha.enterprise !== "undefined") {
                                grecaptcha.enterprise.ready(function () {
                                    grecaptcha.enterprise.execute("' . config('services.recaptcha.site_key') . '", { action: "login" })
                                        .then(function (token) {
                                            Livewire.dispatch("captchaTokenReady", { token: token });
                                        });
                                });
                            }
                        }, 90000);
                    });
                </script>
            '));
    }
}
