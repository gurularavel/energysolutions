<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Forms\Components\IconPickerField;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $modelLabel = 'Service';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Basic Info')->schema([
                Forms\Components\Tabs::make('Title Translations')->tabs([
                    Forms\Components\Tabs\Tab::make('AZ')->schema([
                        Forms\Components\TextInput::make('title.az')
                            ->label('Title (AZ)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                    ]),
                    Forms\Components\Tabs\Tab::make('RU')->schema([
                        Forms\Components\TextInput::make('title.ru')->label('Title (RU)'),
                    ]),
                    Forms\Components\Tabs\Tab::make('EN')->schema([
                        Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                    ]),
                ])->columnSpanFull(),

                Forms\Components\TextInput::make('slug')->required(),
                Forms\Components\Select::make('type')
                    ->options(['service' => 'Service', 'experiment' => 'Experiment'])
                    ->default('service')->required(),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->default(true),

                IconPickerField::make('card_icon_class')
                    ->label('Card Icon Class')
                    ->columnSpanFull(),

                IconPickerField::make('featured_icon_class')
                    ->label('Featured Icon Class')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Images')->schema([
                SpatieMediaLibraryFileUpload::make('card_image')
                    ->collection('card_image')->image()->label('Card Image'),
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->collection('featured_image')->image()->label('Featured Image'),
                SpatieMediaLibraryFileUpload::make('breadcrumb_image')
                    ->collection('breadcrumb_image')->image()->label('Breadcrumb Image'),
            ])->columns(3),

            Forms\Components\Section::make('Qruplar Arasındakı Şəkillər')
                ->description('Hər şəkil üçün hansı qrupdan sonra görünəcəyini seçin. Drag-drop ilə sıralamaq mümkündür.')
                ->schema([
                    Forms\Components\Repeater::make('supportingImages')
                        ->relationship()
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('image')
                                ->collection('image')
                                ->image()
                                ->required()
                                ->label('Şəkil')
                                ->columnSpan(2),

                            Forms\Components\Select::make('after_group')
                                ->label('Hansı qrupdan sonra?')
                                ->options(fn (Forms\Get $get) => collect(
                                    \App\Models\ServiceChecklistItem::query()
                                        ->when(
                                            request()->route('record'),
                                            fn ($q) => $q->whereHas(
                                                'service',
                                                fn ($s) => $s->where('slug', request()->route('record'))
                                            )
                                        )
                                        ->whereNotNull('section_group')
                                        ->distinct()
                                        ->pluck('section_group')
                                )->mapWithKeys(fn ($g) => [$g => ucfirst($g)])->toArray())
                                ->placeholder('Qrup seçin...')
                                ->searchable()
                                ->required(),

                            Forms\Components\TextInput::make('sort_order')
                                ->numeric()
                                ->default(0)
                                ->label('Sıra'),
                        ])
                        ->columns(4)
                        ->orderColumn('sort_order')
                        ->reorderable('sort_order')
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['after_group'] ? ucfirst($state['after_group']) . ' sonrası' : null)
                        ->label('Şəkillər'),
                ]),

            Forms\Components\Section::make('Qrup Başlıqları')
                ->description('Hər qrup üçün başlıq təyin edin. Bu başlıqlar checklist siyahısının üstündə görünür.')
                ->schema([
                    Forms\Components\Repeater::make('checklistGroups')
                        ->relationship()
                        ->schema([
                            Forms\Components\Select::make('group_key')
                                ->label('Qrup')
                                ->options(fn () => collect(
                                    \App\Models\ServiceChecklistItem::query()
                                        ->when(
                                            request()->route('record'),
                                            fn ($q) => $q->whereHas(
                                                'service',
                                                fn ($s) => $s->where('slug', request()->route('record'))
                                            )
                                        )
                                        ->whereNotNull('section_group')
                                        ->distinct()
                                        ->pluck('section_group')
                                )->mapWithKeys(fn ($g) => [$g => ucfirst($g)])->toArray())
                                ->searchable()
                                ->required(),

                            Forms\Components\Tabs::make('Title')->tabs([
                                Forms\Components\Tabs\Tab::make('AZ')->schema([
                                    Forms\Components\TextInput::make('title.az')->label('Başlıq (AZ)'),
                                ]),
                                Forms\Components\Tabs\Tab::make('RU')->schema([
                                    Forms\Components\TextInput::make('title.ru')->label('Başlıq (RU)'),
                                ]),
                                Forms\Components\Tabs\Tab::make('EN')->schema([
                                    Forms\Components\TextInput::make('title.en')->label('Başlıq (EN)'),
                                ]),
                            ])->columnSpan(2),

                            Forms\Components\TextInput::make('sort_order')
                                ->numeric()->default(0)->label('Sıra'),
                        ])
                        ->columns(4)
                        ->orderColumn('sort_order')
                        ->reorderable('sort_order')
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => isset($state['group_key'])
                            ? ucfirst($state['group_key']) . ' — ' . ($state['title']['az'] ?? '')
                            : null)
                        ->label('Qrup başlıqları'),
                ]),

            Forms\Components\Section::make('Checklist Items')->schema([
                Forms\Components\Repeater::make('checklistItems')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('item_type')
                            ->label('Növ')
                            ->options([
                                'list'       => '☑ Adi siyahı (bullet)',
                                'text_image' => '◧ Sol text + Sağ şəkil',
                            ])
                            ->default('list')
                            ->required()
                            ->live(),

                        Forms\Components\Tabs::make('Content Translations')->tabs([
                            Forms\Components\Tabs\Tab::make('AZ')->schema([
                                Forms\Components\Textarea::make('content.az')->label('Content (AZ)')->required()->rows(2),
                            ]),
                            Forms\Components\Tabs\Tab::make('RU')->schema([
                                Forms\Components\Textarea::make('content.ru')->label('Content (RU)')->rows(2),
                            ]),
                            Forms\Components\Tabs\Tab::make('EN')->schema([
                                Forms\Components\Textarea::make('content.en')->label('Content (EN)')->rows(2),
                            ]),
                        ])->columnSpanFull(),

                        SpatieMediaLibraryFileUpload::make('item_image')
                            ->collection('item_image')
                            ->image()
                            ->label('Şəkil (sağ tərəf)')
                            ->visible(fn (Forms\Get $get) => $get('item_type') === 'text_image')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('section_group')->placeholder('group1, group2...'),
                        Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                    ])
                    ->columns(2)
                    ->orderColumn('sort_order')
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string =>
                        ($state['item_type'] === 'text_image' ? '◧ ' : '☑ ') .
                        (isset($state['content']['az']) ? mb_strimwidth($state['content']['az'], 0, 60, '…') : '')
                    ),
            ]),

            Forms\Components\Section::make('Accordion Sections')->schema([
                Forms\Components\Repeater::make('accordionSections')
                    ->relationship()
                    ->schema([
                        Forms\Components\Tabs::make('Accordion Translations')->tabs([
                            Forms\Components\Tabs\Tab::make('AZ')->schema([
                                Forms\Components\TextInput::make('title.az')->label('Title (AZ)')->required(),
                                Forms\Components\RichEditor::make('content.az')->label('Content (AZ)')->columnSpanFull(),
                            ]),
                            Forms\Components\Tabs\Tab::make('RU')->schema([
                                Forms\Components\TextInput::make('title.ru')->label('Title (RU)'),
                                Forms\Components\RichEditor::make('content.ru')->label('Content (RU)')->columnSpanFull(),
                            ]),
                            Forms\Components\Tabs\Tab::make('EN')->schema([
                                Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                                Forms\Components\RichEditor::make('content.en')->label('Content (EN)')->columnSpanFull(),
                            ]),
                        ])->columnSpanFull(),
                        Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                    ])
                    ->columns(2)
                    ->orderColumn('sort_order')
                    ->collapsible(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            SpatieMediaLibraryImageColumn::make('card_image')
                ->collection('card_image')->width(60)->height(40),
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('slug')->searchable(),
            Tables\Columns\BadgeColumn::make('type'),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->boolean(),
        ])
        ->defaultSort('sort_order')
        ->reorderable('sort_order')
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
