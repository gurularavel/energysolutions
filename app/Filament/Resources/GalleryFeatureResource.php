<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryFeatureResource\Pages;
use App\Models\GalleryFeature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class GalleryFeatureResource extends Resource
{
    protected static ?string $model = GalleryFeature::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Homepage';
    protected static ?string $modelLabel = 'Gallery Feature';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\TextInput::make('title.az')->label('Title (AZ)')->required(),
                    Forms\Components\Textarea::make('description.az')->label('Description (AZ)')->columnSpanFull(),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\TextInput::make('title.ru')->label('Title (RU)'),
                    Forms\Components\Textarea::make('description.ru')->label('Description (RU)')->columnSpanFull(),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                    Forms\Components\Textarea::make('description.en')->label('Description (EN)')->columnSpanFull(),
                ]),
            ])->columnSpanFull(),
            Forms\Components\TextInput::make('link'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
            SpatieMediaLibraryFileUpload::make('image')->collection('image')->image()->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            SpatieMediaLibraryImageColumn::make('image')->collection('image')->width(60)->height(40),
            Tables\Columns\TextColumn::make('title')->searchable(),
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
            'index'  => Pages\ListGalleryFeatures::route('/'),
            'create' => Pages\CreateGalleryFeature::route('/create'),
            'edit'   => Pages\EditGalleryFeature::route('/{record}/edit'),
        ];
    }
}
