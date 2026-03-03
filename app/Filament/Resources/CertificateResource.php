<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificateResource\Pages;
use App\Models\Certificate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $modelLabel = 'Certificate';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\TextInput::make('title.az')->label('Title (AZ)'),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\TextInput::make('title.ru')->label('Title (RU)'),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\TextInput::make('title.en')->label('Title (EN)'),
                ]),
            ])->columnSpanFull(),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
            SpatieMediaLibraryFileUpload::make('certificate_image')
                ->collection('certificate_image')->image()->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            SpatieMediaLibraryImageColumn::make('certificate_image')->collection('certificate_image')->width(60)->height(40),
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
            'index'  => Pages\ListCertificates::route('/'),
            'create' => Pages\CreateCertificate::route('/create'),
            'edit'   => Pages\EditCertificate::route('/{record}/edit'),
        ];
    }
}
