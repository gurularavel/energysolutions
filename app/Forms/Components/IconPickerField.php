<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class IconPickerField extends Field
{
    protected string $view = 'forms.components.icon-picker-field';

    public static function allIcons(): array
    {
        return [
            // Flaticon
            'flaticon-allah-word', 'flaticon-multiply', 'flaticon-clock', 'flaticon-plus',
            'flaticon-minus', 'flaticon-play-button', 'flaticon-play-button-1',
            'flaticon-star-of-favorites-outline', 'flaticon-next', 'flaticon-search',
            'flaticon-bag', 'flaticon-quote', 'flaticon-star', 'flaticon-favourite',
            'flaticon-quote-1', 'flaticon-next-1', 'flaticon-file', 'flaticon-doc',
            'flaticon-link', 'flaticon-call', 'flaticon-pin', 'flaticon-calendar',
            'flaticon-verified', 'flaticon-user', 'flaticon-maps-and-flags', 'flaticon-mail',
            'flaticon-tick', 'flaticon-check', 'flaticon-quote-2', 'flaticon-confirmation',
            'flaticon-telephone', 'flaticon-email', 'flaticon-pin-1', 'flaticon-placeholder',
            'flaticon-down-arrow', 'flaticon-quote-3', 'flaticon-open-archive', 'flaticon-send',
            'flaticon-phone', 'flaticon-envelope', 'flaticon-pin-2', 'flaticon-left-quotes-sign',
            'flaticon-phone-call', 'flaticon-tag', 'flaticon-search-interface-symbol',
            'flaticon-at', 'flaticon-basket', 'flaticon-chat', 'flaticon-reply',
            'flaticon-earth-grid-symbol', 'flaticon-twitter', 'flaticon-up-arrow',
            'flaticon-user-1', 'flaticon-speech-bubble-comment', 'flaticon-left-arrow-1',
            'flaticon-map-marker', 'flaticon-comment', 'flaticon-phone-call-1',
            'flaticon-maps-and-flags-1', 'flaticon-chat-1', 'flaticon-chat-2', 'flaticon-chat-3',
            'flaticon-phone-call-2', 'flaticon-sharing', 'flaticon-quote-4', 'flaticon-quote-5',
            'flaticon-user-2', 'flaticon-phone-receiver-silhouette', 'flaticon-check-mark',
            'flaticon-down-arrow-2', 'flaticon-menu', 'flaticon-email-1', 'flaticon-search-1',
            'flaticon-construction-and-tools', 'flaticon-plus-1', 'flaticon-play-button-2',
            'flaticon-headphone', 'flaticon-placeholder-1', 'flaticon-house-with-wooden-roof',
            'flaticon-placeholder-2', 'flaticon-insurance', 'flaticon-pdf', 'flaticon-zoom',
            'flaticon-tooth', 'flaticon-smile', 'flaticon-smile-1', 'flaticon-smile-2',
            'flaticon-smile-3', 'flaticon-tick-1', 'flaticon-tick-2', 'flaticon-clock-1',
            'flaticon-chat-4', 'flaticon-dental-review', 'flaticon-dentist',
            'flaticon-tooth-whitening', 'flaticon-cavities', 'flaticon-woman',
            'flaticon-star-1', 'flaticon-star-2', 'flaticon-dentist-1', 'flaticon-next-2',
            'flaticon-message', 'flaticon-magnifying-glass', 'flaticon-protection',
            'flaticon-tooth-1', 'flaticon-apple', 'flaticon-dental',
            'flaticon-medical-appointment', 'flaticon-dentist-2', 'flaticon-healthy-tooth',
            'flaticon-address', 'flaticon-alarm-clock',
            // Icomoon
            'icon-phone-call', 'icon-magnifying-glass', 'icon-right-arrow', 'icon-report',
            'icon-global', 'icon-business', 'icon-protection', 'icon-user',
            'icon-conversation', 'icon-tick', 'icon-twitter', 'icon-facebook-circular-logo',
            'icon-pinterest', 'icon-instagram', 'icon-email', 'icon-placeholder',
            'icon-recruit', 'icon-creative', 'icon-help', 'icon-customer-review',
            'icon-conversation-1', 'icon-checking', 'icon-cyber-security',
            'icon-mobile-analytics', 'icon-analysis', 'icon-creative-1', 'icon-check',
            'icon-down-arrow', 'icon-log-out', 'icon-add', 'icon-add-1', 'icon-remove',
        ];
    }
}
