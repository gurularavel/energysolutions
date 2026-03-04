<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageTranslations extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-language';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Frontend Translations';
    protected static ?int $navigationSort = 3;
    protected static string $view = 'filament.pages.manage-translations';

    public ?array $data = [];

    public function mount(): void
    {
        $az = require resource_path('lang/az/frontend.php');
        $ru = require resource_path('lang/ru/frontend.php');
        $en = require resource_path('lang/en/frontend.php');

        $this->form->fill($this->buildFormData($az, $ru, $en));
    }

    private function buildFormData(array $az, array $ru, array $en): array
    {
        $data = [];
        foreach ($az as $group => $keys) {
            if (!is_array($keys)) continue;
            foreach ($keys as $key => $val) {
                $data["{$group}__{$key}__az"] = $az[$group][$key] ?? '';
                $data["{$group}__{$key}__ru"] = $ru[$group][$key] ?? '';
                $data["{$group}__{$key}__en"] = $en[$group][$key] ?? '';
            }
        }
        return $data;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('translations')->tabs([

                Forms\Components\Tabs\Tab::make('Naviqasiya')->schema(
                    $this->buildTabSchema('nav', [
                        'home'         => 'Ana Səhifə',
                        'services'     => 'Xidmətlər',
                        'experiments'  => 'Səriştəlilik Sınaqları',
                        'certificates' => 'Sertifikatlar',
                        'gallery'      => 'Qalereya',
                        'photo_gallery'=> 'Foto Qalereya',
                        'video_gallery'=> 'Video Qalereya',
                        'order_form'   => 'Sifariş Blankı',
                        'news'         => 'Xəbərlər',
                        'contact'      => 'Əlaqə',
                    ])
                ),

                Forms\Components\Tabs\Tab::make('Bölmə Başlıqları')->schema(
                    $this->buildTabSchema('sections', [
                        'about'        => 'Haqqımızda',
                        'our_services' => 'Xidmətlərimiz',
                        'gallery'      => 'Qalereya',
                        'testimonials' => 'Müştəri Rəyləri',
                        'news'         => 'Xəbərlər',
                        'video_gallery'=> 'Video Qalereya',
                    ])
                ),

                Forms\Components\Tabs\Tab::make('Səhifə Başlıqları')->schema(
                    $this->buildTabSchema('pages', [
                        'photo_gallery' => 'Foto Qalereya Səhifəsi',
                        'certificates'  => 'Sertifikatlar Səhifəsi',
                        'video_gallery' => 'Video Qalereya Səhifəsi',
                    ])
                ),

                Forms\Components\Tabs\Tab::make('Haqqımızda Kartlar')->schema(
                    $this->buildTabSchema('about', [
                        'services'     => 'Xidmətlər Kartı',
                        'policies'     => 'Siyasətlər Kartı',
                        'certificates' => 'Sertifikatlar Kartı',
                        'projects'     => 'Layihələr Kartı',
                    ])
                ),

                Forms\Components\Tabs\Tab::make('Düymələr')->schema(
                    $this->buildTabSchema('buttons', [
                        'more'          => 'Ətraflı Düyməsi',
                        'download_form' => 'Formanı Yüklə Düyməsi',
                        'all_videos'    => 'Bütün Videolar Düyməsi',
                        'show_all'      => 'Hamısını Göstər Düyməsi',
                    ])
                ),

                Forms\Components\Tabs\Tab::make('Formlar')->schema(
                    $this->buildTabSchema('forms', [
                        'complaint_title' => 'Şikayət Forması Başlığı',
                        'order_title'     => 'Sifariş Forması Başlığı',
                    ], 'textarea')
                ),

                Forms\Components\Tabs\Tab::make('Xidmət Səhifəsi')->schema(
                    $this->buildTabSchema('service', [
                        'contact_us'  => 'Əlaqə Qurun Mətni',
                        'experiments' => 'Səriştəlilik Sınaqları',
                    ])
                ),

                Forms\Components\Tabs\Tab::make('Footer')->schema(
                    $this->buildTabSchema('footer', [
                        'site_map' => 'Saytın Xəritəsi',
                        'about'    => 'Haqqımızda',
                    ])
                ),

                Forms\Components\Tabs\Tab::make('Ümumi')->schema(
                    $this->buildTabSchema('common', [
                        'no_video' => 'Video Yoxdur Mətni',
                    ])
                ),

            ])->columnSpanFull(),
        ])->statePath('data');
    }

    private function buildTabSchema(string $group, array $labels, string $type = 'input'): array
    {
        $fields = [];
        foreach ($labels as $key => $label) {
            $fields[] = Forms\Components\Section::make($label)
                ->schema([
                    $type === 'textarea'
                        ? Forms\Components\Textarea::make("{$group}__{$key}__az")->label('🇦🇿 AZ')->rows(2)
                        : Forms\Components\TextInput::make("{$group}__{$key}__az")->label('🇦🇿 AZ'),
                    $type === 'textarea'
                        ? Forms\Components\Textarea::make("{$group}__{$key}__ru")->label('🇷🇺 RU')->rows(2)
                        : Forms\Components\TextInput::make("{$group}__{$key}__ru")->label('🇷🇺 RU'),
                    $type === 'textarea'
                        ? Forms\Components\Textarea::make("{$group}__{$key}__en")->label('🇬🇧 EN')->rows(2)
                        : Forms\Components\TextInput::make("{$group}__{$key}__en")->label('🇬🇧 EN'),
                ])->columns(3);
        }
        return $fields;
    }

    public function save(): void
    {
        $formData = $this->form->getState();

        $langs = ['az' => [], 'ru' => [], 'en' => []];

        foreach ($formData as $flatKey => $value) {
            // flatKey format: group__key__locale
            $parts = explode('__', $flatKey);
            if (count($parts) !== 3) continue;
            [$group, $key, $locale] = $parts;
            $langs[$locale][$group][$key] = $value ?? '';
        }

        foreach ($langs as $locale => $groups) {
            // Merge with existing (to preserve 'lang' group which has no form fields)
            $existing = require resource_path("lang/{$locale}/frontend.php");
            foreach ($groups as $group => $keys) {
                $existing[$group] = array_merge($existing[$group] ?? [], $keys);
            }
            $this->writeLangFile($locale, $existing);
        }

        Notification::make()->title('Translations saved successfully!')->success()->send();
    }

    private function writeLangFile(string $locale, array $data): void
    {
        $path = resource_path("lang/{$locale}/frontend.php");
        $content = "<?php\n\nreturn " . $this->arrayToPhp($data) . ";\n";
        file_put_contents($path, $content);
    }

    private function arrayToPhp(array $array, int $depth = 0): string
    {
        $indent = str_repeat('    ', $depth);
        $innerIndent = str_repeat('    ', $depth + 1);
        $lines = ['['];
        foreach ($array as $key => $value) {
            $phpKey = is_string($key) ? "'{$key}'" : $key;
            if (is_array($value)) {
                $lines[] = "{$innerIndent}{$phpKey} => " . $this->arrayToPhp($value, $depth + 1) . ',';
            } else {
                $escaped = addslashes($value);
                $lines[] = "{$innerIndent}{$phpKey} => '{$escaped}',";
            }
        }
        $lines[] = "{$indent}]";
        return implode("\n", $lines);
    }
}
