<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ManageSiteSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::instance();
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Settings')->tabs([

                Forms\Components\Tabs\Tab::make('Şirkət Məlumatları')->schema([
                    Forms\Components\Tabs::make('Company Name')->tabs([
                        Forms\Components\Tabs\Tab::make('AZ')->schema([
                            Forms\Components\TextInput::make('company_name.az')->label('Company Name (AZ)'),
                        ]),
                        Forms\Components\Tabs\Tab::make('RU')->schema([
                            Forms\Components\TextInput::make('company_name.ru')->label('Company Name (RU)'),
                        ]),
                        Forms\Components\Tabs\Tab::make('EN')->schema([
                            Forms\Components\TextInput::make('company_name.en')->label('Company Name (EN)'),
                        ]),
                    ])->columnSpanFull(),

                    Forms\Components\TextInput::make('phone')->label('Phone'),
                    Forms\Components\TextInput::make('email')->label('Email')->email(),

                    Forms\Components\Tabs::make('Address')->tabs([
                        Forms\Components\Tabs\Tab::make('AZ')->schema([
                            Forms\Components\Textarea::make('address.az')->label('Address (AZ)'),
                        ]),
                        Forms\Components\Tabs\Tab::make('RU')->schema([
                            Forms\Components\Textarea::make('address.ru')->label('Address (RU)'),
                        ]),
                        Forms\Components\Tabs\Tab::make('EN')->schema([
                            Forms\Components\Textarea::make('address.en')->label('Address (EN)'),
                        ]),
                    ])->columnSpanFull(),

                    Forms\Components\Tabs::make('Footer Copyright')->tabs([
                        Forms\Components\Tabs\Tab::make('AZ')->schema([
                            Forms\Components\TextInput::make('footer_copyright.az')->label('Footer Copyright (AZ)')->columnSpanFull(),
                        ]),
                        Forms\Components\Tabs\Tab::make('RU')->schema([
                            Forms\Components\TextInput::make('footer_copyright.ru')->label('Footer Copyright (RU)')->columnSpanFull(),
                        ]),
                        Forms\Components\Tabs\Tab::make('EN')->schema([
                            Forms\Components\TextInput::make('footer_copyright.en')->label('Footer Copyright (EN)')->columnSpanFull(),
                        ]),
                    ])->columnSpanFull(),

                    Forms\Components\Select::make('default_locale')
                        ->label('Default Language')
                        ->options(['az' => 'Azərbaycan', 'ru' => 'Русский', 'en' => 'English'])
                        ->default('az')
                        ->required(),
                ])->columns(2),

                Forms\Components\Tabs\Tab::make('Social Media')->schema([
                    Forms\Components\TextInput::make('facebook_url')->label('Facebook URL')->url(),
                    Forms\Components\TextInput::make('twitter_url')->label('Twitter URL')->url(),
                    Forms\Components\TextInput::make('instagram_url')->label('Instagram URL')->url(),
                    Forms\Components\TextInput::make('pinterest_url')->label('Pinterest URL')->url(),
                    Forms\Components\TextInput::make('youtube_url')->label('YouTube URL')->url(),
                ])->columns(2),

                Forms\Components\Tabs\Tab::make('Logolar')->schema([
                    SpatieMediaLibraryFileUpload::make('logo')
                        ->collection('logo')->image()->label('Main Logo'),
                    SpatieMediaLibraryFileUpload::make('sticky_logo')
                        ->collection('sticky_logo')->image()->label('Sticky Logo'),
                    SpatieMediaLibraryFileUpload::make('mobile_logo')
                        ->collection('mobile_logo')->image()->label('Mobile Logo'),
                    SpatieMediaLibraryFileUpload::make('footer_logo')
                        ->collection('footer_logo')->image()->label('Footer Logo'),
                ])->columns(2),

                Forms\Components\Tabs\Tab::make('Formlar & PDF-lər')->schema([
                    Forms\Components\TextInput::make('complaint_form_pdf')->label('Complaint Form PDF Path'),
                    Forms\Components\TextInput::make('order_form_pdf')->label('Order Form PDF Path'),
                    Forms\Components\TextInput::make('policy_pdf')->label('Policy PDF Path'),
                ])->columns(1),

            ])->columnSpanFull(),
        ])->statePath('data')->model(SiteSetting::instance());
    }

    public function save(): void
    {
        $settings = SiteSetting::instance();
        $data = $this->form->getState();
        $settings->update($data);

        Notification::make()->title('Settings saved')->success()->send();
    }
}
