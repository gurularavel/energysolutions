<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryCategoryResource\Pages;
use App\Models\GalleryCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryCategoryResource extends Resource
{
    protected static ?string $model = GalleryCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Gallery';
    protected static ?string $modelLabel = 'Gallery Category';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\TextInput::make('name.az')->label('Name (AZ)')->required(),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\TextInput::make('name.ru')->label('Name (RU)'),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\TextInput::make('name.en')->label('Name (EN)'),
                ]),
            ])->columnSpanFull(),
            Forms\Components\TextInput::make('filter_class')->required()->placeholder('lab, offi, out, eks'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('filter_class'),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
        ])
        ->defaultSort('sort_order')
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGalleryCategories::route('/'),
            'create' => Pages\CreateGalleryCategory::route('/create'),
            'edit'   => Pages\EditGalleryCategory::route('/{record}/edit'),
        ];
    }
}
