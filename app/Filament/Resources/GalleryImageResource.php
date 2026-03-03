<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryImageResource\Pages;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class GalleryImageResource extends Resource
{
    protected static ?string $model = GalleryImage::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Gallery';
    protected static ?string $modelLabel = 'Gallery Image';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('gallery_category_id')
                ->label('Category')
                ->options(GalleryCategory::orderBy('sort_order')->pluck('name', 'id'))
                ->required(),
            Forms\Components\Tabs::make('Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\TextInput::make('alt_text.az')->label('Alt Text (AZ)'),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\TextInput::make('alt_text.ru')->label('Alt Text (RU)'),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\TextInput::make('alt_text.en')->label('Alt Text (EN)'),
                ]),
            ])->columnSpanFull(),
            Forms\Components\Select::make('height_class')
                ->options(['height-sm' => 'Small', 'height-lg' => 'Large'])
                ->default('height-sm'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
            SpatieMediaLibraryFileUpload::make('gallery_image')
                ->collection('gallery_image')->image()->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            SpatieMediaLibraryImageColumn::make('gallery_image')->collection('gallery_image')->width(60)->height(40),
            Tables\Columns\TextColumn::make('category.name')->sortable(),
            Tables\Columns\TextColumn::make('alt_text'),
            Tables\Columns\TextColumn::make('height_class'),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->boolean(),
        ])
        ->defaultSort('sort_order')
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGalleryImages::route('/'),
            'create' => Pages\CreateGalleryImage::route('/create'),
            'edit'   => Pages\EditGalleryImage::route('/{record}/edit'),
        ];
    }
}
