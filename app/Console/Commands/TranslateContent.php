<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateContent extends Command
{
    protected $signature = 'translate:content {--dry-run : Show what would be translated without saving}';
    protected $description = 'Translate all Azerbaijani content to Russian and English';

    private GoogleTranslate $toRu;
    private GoogleTranslate $toEn;

    private array $models = [
        \App\Models\Slider::class => ['heading', 'button_text'],
        \App\Models\Service::class => ['title'],
        \App\Models\HomepageSection::class => ['subtitle', 'content', 'button_text'],
        \App\Models\GalleryFeature::class => ['title', 'description'],
        \App\Models\GalleryCategory::class => ['name'],
        \App\Models\GalleryImage::class => ['alt_text'],
        \App\Models\Testimonial::class => ['quote', 'client_name', 'client_title'],
        \App\Models\Certificate::class => ['title'],
        \App\Models\Stat::class => ['label'],
        \App\Models\Partner::class => ['name'],
        \App\Models\BlogPost::class => ['title'],
        \App\Models\SiteSetting::class => ['company_name', 'address', 'footer_copyright'],
    ];

    public function handle(): void
    {
        $this->toRu = new GoogleTranslate('ru');
        $this->toRu->setSource('az');

        $this->toEn = new GoogleTranslate('en');
        $this->toEn->setSource('az');

        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('DRY RUN - no changes will be saved');
        }

        foreach ($this->models as $modelClass => $fields) {
            $shortName = class_basename($modelClass);
            $this->info("\nProcessing: {$shortName}");

            $records = $modelClass::all();
            $bar = $this->output->createProgressBar($records->count());
            $bar->start();

            foreach ($records as $record) {
                foreach ($fields as $field) {
                    $azValue = $record->getTranslation($field, 'az', false);

                    if (empty($azValue)) {
                        continue;
                    }

                    $ruValue = $record->getTranslation($field, 'ru', false);
                    $enValue = $record->getTranslation($field, 'en', false);

                    $needsRu = empty($ruValue);
                    $needsEn = empty($enValue);

                    if (!$needsRu && !$needsEn) {
                        continue;
                    }

                    try {
                        if ($needsRu) {
                            $translated = $this->toRu->translate($azValue);
                            if (!$dryRun) {
                                $record->setTranslation($field, 'ru', $translated);
                            } else {
                                $this->line("\n  [{$field}] az→ru: {$azValue} => {$translated}");
                            }
                        }

                        if ($needsEn) {
                            $translated = $this->toEn->translate($azValue);
                            if (!$dryRun) {
                                $record->setTranslation($field, 'en', $translated);
                            } else {
                                $this->line("\n  [{$field}] az→en: {$azValue} => {$translated}");
                            }
                        }

                        usleep(300000); // 0.3s delay to avoid rate limiting
                    } catch (\Exception $e) {
                        $this->error("\n  Error translating [{$field}]: " . $e->getMessage());
                    }
                }

                if (!$dryRun) {
                    $record->save();
                }

                $bar->advance();
            }

            $bar->finish();
        }

        // Handle ServiceAccordionSection and ServiceChecklistItem
        $this->translateServiceSubModels($dryRun);

        $this->info("\n\nDone!");
    }

    private function translateServiceSubModels(bool $dryRun): void
    {
        $subModels = [];

        // Check if these models exist
        if (class_exists(\App\Models\ServiceAccordionSection::class)) {
            $subModels[\App\Models\ServiceAccordionSection::class] = ['title', 'content'];
        }
        if (class_exists(\App\Models\ServiceChecklistItem::class)) {
            $subModels[\App\Models\ServiceChecklistItem::class] = ['content'];
        }
        if (class_exists(\App\Models\ServiceSupportingImage::class)) {
            $subModels[\App\Models\ServiceSupportingImage::class] = ['alt_text'];
        }
        if (class_exists(\App\Models\VideoGalleryItem::class)) {
            $subModels[\App\Models\VideoGalleryItem::class] = ['title'];
        }

        foreach ($subModels as $modelClass => $fields) {
            $shortName = class_basename($modelClass);
            $this->info("\nProcessing: {$shortName}");

            $records = $modelClass::all();
            $bar = $this->output->createProgressBar($records->count());
            $bar->start();

            foreach ($records as $record) {
                foreach ($fields as $field) {
                    $azValue = $record->getTranslation($field, 'az', false);

                    if (empty($azValue)) {
                        continue;
                    }

                    $ruValue = $record->getTranslation($field, 'ru', false);
                    $enValue = $record->getTranslation($field, 'en', false);

                    $needsRu = empty($ruValue);
                    $needsEn = empty($enValue);

                    if (!$needsRu && !$needsEn) {
                        continue;
                    }

                    try {
                        if ($needsRu) {
                            $translated = $this->toRu->translate($azValue);
                            if (!$dryRun) {
                                $record->setTranslation($field, 'ru', $translated);
                            }
                        }

                        if ($needsEn) {
                            $translated = $this->toEn->translate($azValue);
                            if (!$dryRun) {
                                $record->setTranslation($field, 'en', $translated);
                            }
                        }

                        usleep(300000);
                    } catch (\Exception $e) {
                        $this->error("\n  Error translating [{$field}]: " . $e->getMessage());
                    }
                }

                if (!$dryRun) {
                    $record->save();
                }

                $bar->advance();
            }

            $bar->finish();
        }
    }
}
