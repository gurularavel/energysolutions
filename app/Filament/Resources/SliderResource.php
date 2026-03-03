<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Homepage';
    protected static ?string $modelLabel = 'Slider';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\TextInput::make('heading.az')->label('Heading (AZ)')->required(),
                    Forms\Components\TextInput::make('button_text.az')->label('Button Text (AZ)'),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\TextInput::make('heading.ru')->label('Heading (RU)'),
                    Forms\Components\TextInput::make('button_text.ru')->label('Button Text (RU)'),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\TextInput::make('heading.en')->label('Heading (EN)'),
                    Forms\Components\TextInput::make('button_text.en')->label('Button Text (EN)'),
                ]),
            ])->columnSpanFull(),
            Forms\Components\TextInput::make('button_link'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
            SpatieMediaLibraryFileUpload::make('background_image')
                ->collection('background_image')
                ->image()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            SpatieMediaLibraryImageColumn::make('background_image')
                ->collection('background_image')
                ->width(80)->height(50),
            Tables\Columns\TextColumn::make('heading')->limit(50)->searchable(),
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
            'index'  => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit'   => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
