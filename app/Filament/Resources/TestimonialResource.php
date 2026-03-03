<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Homepage';
    protected static ?string $modelLabel = 'Testimonial';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\Textarea::make('quote.az')->label('Quote (AZ)')->required()->rows(3),
                    Forms\Components\TextInput::make('client_name.az')->label('Client Name (AZ)')->required(),
                    Forms\Components\TextInput::make('client_title.az')->label('Client Title (AZ)'),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\Textarea::make('quote.ru')->label('Quote (RU)')->rows(3),
                    Forms\Components\TextInput::make('client_name.ru')->label('Client Name (RU)'),
                    Forms\Components\TextInput::make('client_title.ru')->label('Client Title (RU)'),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\Textarea::make('quote.en')->label('Quote (EN)')->rows(3),
                    Forms\Components\TextInput::make('client_name.en')->label('Client Name (EN)'),
                    Forms\Components\TextInput::make('client_title.en')->label('Client Title (EN)'),
                ]),
            ])->columnSpanFull(),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
            SpatieMediaLibraryFileUpload::make('photo')->collection('photo')->image()->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            SpatieMediaLibraryImageColumn::make('photo')->collection('photo')->width(50)->height(50)->circular(),
            Tables\Columns\TextColumn::make('client_name')->searchable(),
            Tables\Columns\TextColumn::make('client_title'),
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
            'index'  => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit'   => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
