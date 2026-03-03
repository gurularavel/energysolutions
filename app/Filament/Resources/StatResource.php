<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatResource\Pages;
use App\Models\Stat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StatResource extends Resource
{
    protected static ?string $model = Stat::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Homepage';
    protected static ?string $modelLabel = 'Stat';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('number')->numeric()->required(),
            Forms\Components\TextInput::make('speed')->numeric()->default(3000),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Tabs::make('Translations')->tabs([
                Forms\Components\Tabs\Tab::make('AZ')->schema([
                    Forms\Components\TextInput::make('label.az')->label('Label (AZ)')->required(),
                ]),
                Forms\Components\Tabs\Tab::make('RU')->schema([
                    Forms\Components\TextInput::make('label.ru')->label('Label (RU)'),
                ]),
                Forms\Components\Tabs\Tab::make('EN')->schema([
                    Forms\Components\TextInput::make('label.en')->label('Label (EN)'),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('number')->sortable(),
            Tables\Columns\TextColumn::make('label')->searchable(),
            Tables\Columns\TextColumn::make('speed'),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
        ])
        ->defaultSort('sort_order')
        ->reorderable('sort_order')
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListStats::route('/'),
            'create' => Pages\CreateStat::route('/create'),
            'edit'   => Pages\EditStat::route('/{record}/edit'),
        ];
    }
}
