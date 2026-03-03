<?php

namespace App\Filament\Pages;

use App\Models\HomepageSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;

class ManageHomepageSections extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Homepage';
    protected static ?string $navigationLabel = 'Homepage Sections';
    protected static ?int $navigationSort = 6;
    protected static string $view = 'filament.pages.manage-homepage-sections';

    public ?array $aboutData = [];
    public ?array $slogan1Data = [];
    public ?array $slogan2Data = [];
    public ?array $certTextData = [];
    public ?array $futureServicesData = [];

    public function mount(): void
    {
        $this->fillForms();
    }

    protected function fillForms(): void
    {
        $keys = ['about', 'slogan1', 'slogan2', 'cert_text', 'future_services'];
        foreach ($keys as $key) {
            $section = HomepageSection::getSection($key);
            $prop = lcfirst(str_replace('_', '', ucwords($key, '_'))) . 'Data';
            $data = $section ? $section->toArray() : ['section_key' => $key];

            if ($key === 'cert_text' && !empty($data['background_image'])) {
                $data['background_image'] = [$data['background_image']];
            }

            $this->$prop = $data;
        }
    }

    protected function getSectionForm(string $key): array
    {
        return [
            Forms\Components\Hidden::make('section_key')->default($key),
            Forms\Components\Tabs::make('Content Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\Textarea::make('content.az')->label('Content (AZ)')->rows(4)->columnSpanFull(),
                    Forms\Components\TextInput::make('button_text.az')->label('Button Text (AZ)'),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\Textarea::make('content.ru')->label('Content (RU)')->rows(4)->columnSpanFull(),
                    Forms\Components\TextInput::make('button_text.ru')->label('Button Text (RU)'),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\Textarea::make('content.en')->label('Content (EN)')->rows(4)->columnSpanFull(),
                    Forms\Components\TextInput::make('button_text.en')->label('Button Text (EN)'),
                ]),
            ])->columnSpanFull(),
            Forms\Components\TextInput::make('button_link')->label('Button Link'),
        ];
    }

    protected function getForms(): array
    {
        return [
            'aboutForm', 'slogan1Form', 'slogan2Form', 'certTextForm', 'futureServicesForm',
        ];
    }

    public function aboutForm(Form $form): Form
    {
        return $form->schema($this->getSectionForm('about'))->statePath('aboutData');
    }

    public function slogan1Form(Form $form): Form
    {
        return $form->schema($this->getSectionForm('slogan1'))->statePath('slogan1Data');
    }

    public function slogan2Form(Form $form): Form
    {
        return $form->schema($this->getSectionForm('slogan2'))->statePath('slogan2Data');
    }

    public function certTextForm(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Hidden::make('section_key')->default('cert_text'),
            Forms\Components\Tabs::make('Content Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\Textarea::make('content.az')->label('Mətn (AZ)')->rows(4)->columnSpanFull(),
                    Forms\Components\TextInput::make('button_text.az')->label('Düymə Mətni (AZ)'),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\Textarea::make('content.ru')->label('Mətn (RU)')->rows(4)->columnSpanFull(),
                    Forms\Components\TextInput::make('button_text.ru')->label('Düymə Mətni (RU)'),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\Textarea::make('content.en')->label('Mətn (EN)')->rows(4)->columnSpanFull(),
                    Forms\Components\TextInput::make('button_text.en')->label('Düymə Mətni (EN)'),
                ]),
            ])->columnSpanFull(),
            Forms\Components\TextInput::make('button_link')->label('Düymə Linki'),
            Forms\Components\FileUpload::make('background_image')
                ->label('Sertifikat Bölməsi Şəkli')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('homepage/cert-image')
                ->visibility('public')
                ->helperText('Sağ tərəfdə görünən şəkil. Yüklənməsə standart şəkil istifadə olunur.')
                ->columnSpanFull(),
        ])->statePath('certTextData');
    }

    public function futureServicesForm(Form $form): Form
    {
        return $form->schema($this->getSectionForm('future_services'))->statePath('futureServicesData');
    }

    public function save(string $key): void
    {
        $propMap = [
            'about'           => 'aboutData',
            'slogan1'         => 'slogan1Data',
            'slogan2'         => 'slogan2Data',
            'cert_text'       => 'certTextData',
            'future_services' => 'futureServicesData',
        ];

        $prop = $propMap[$key];
        $data = $this->$prop;
        $data['section_key'] = $key;

        if (isset($data['background_image']) && is_array($data['background_image'])) {
            $data['background_image'] = array_values($data['background_image'])[0] ?? null;
        }

        HomepageSection::updateOrCreate(['section_key' => $key], $data);

        Notification::make()->title('Saved successfully')->success()->send();
    }
}
