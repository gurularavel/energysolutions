<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoGalleryItemResource\Pages;
use App\Models\VideoGalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\HtmlString;

class VideoGalleryItemResource extends Resource
{
    protected static ?string $model = VideoGalleryItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-play-circle';
    protected static ?string $navigationGroup = 'Gallery';
    protected static ?string $navigationLabel = 'Video Qalereya';
    protected static ?string $modelLabel = 'Video';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Video Məlumatları')->schema([

                Forms\Components\Tabs::make('Title Translations')->tabs([
                    Forms\Components\Tabs\Tab::make('AZ')->schema([
                        Forms\Components\TextInput::make('title.az')->label('Başlıq (AZ)')->placeholder('Video başlığı (isteğe bağlı)'),
                    ]),
                    Forms\Components\Tabs\Tab::make('RU')->schema([
                        Forms\Components\TextInput::make('title.ru')->label('Başlıq (RU)'),
                    ]),
                    Forms\Components\Tabs\Tab::make('EN')->schema([
                        Forms\Components\TextInput::make('title.en')->label('Başlıq (EN)'),
                    ]),
                ])->columnSpanFull(),

                Forms\Components\TextInput::make('youtube_url')
                    ->label('YouTube URL')
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->required()
                    ->url()
                    ->live(onBlur: true)
                    ->columnSpan(1),

                Forms\Components\Placeholder::make('youtube_preview')
                    ->label('YouTube Preview')
                    ->content(function (Forms\Get $get): HtmlString {
                        $url = $get('youtube_url');
                        if (!$url) {
                            return new HtmlString('<span style="color:#9ca3af;font-style:italic">URL daxil edin...</span>');
                        }

                        $id = null;
                        if (preg_match('/youtu\.be\/([a-zA-Z0-9_\-]{11})/', $url, $m)) $id = $m[1];
                        elseif (preg_match('/[?&]v=([a-zA-Z0-9_\-]{11})/', $url, $m)) $id = $m[1];
                        elseif (preg_match('/embed\/([a-zA-Z0-9_\-]{11})/', $url, $m)) $id = $m[1];

                        if (!$id) {
                            return new HtmlString('<span style="color:#ef4444">Düzgün YouTube URL deyil</span>');
                        }

                        $thumb = "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
                        return new HtmlString(
                            '<div style="position:relative;width:100%;max-width:280px;border-radius:8px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.15)">'
                            . '<img src="' . $thumb . '" style="width:100%;display:block">'
                            . '<div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center">'
                            . '<div style="width:48px;height:48px;background:rgba(255,0,0,0.85);border-radius:50%;display:flex;align-items:center;justify-content:center">'
                            . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22" height="22" style="margin-left:3px"><path d="M8 5v14l11-7z"/></svg>'
                            . '</div></div>'
                            . '<div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent,rgba(0,0,0,0.6));padding:16px 10px 8px;color:white;font-size:12px">Video ID: ' . e($id) . '</div>'
                            . '</div>'
                        );
                    })
                    ->columnSpan(1),

            ])->columns(2),

            Forms\Components\Section::make('Üz Şəkil (isteğe bağlı)')->schema([
                SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->collection('thumbnail')
                    ->image()
                    ->imageEditor()
                    ->label('Üz Şəkil')
                    ->helperText('Yüklənməsə YouTube-un avtomatik thumbnail-i istifadə olunacaq.')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Parametrlər')->schema([
                Forms\Components\TextInput::make('sort_order')
                    ->label('Sıra')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktiv')
                    ->default(true),
            ])->columns(2),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('thumbnail_preview')
                ->label('Thumbnail')
                ->state(fn (VideoGalleryItem $record): string => $record->getThumbnailUrl())
                ->width(100)
                ->height(60)
                ->extraImgAttributes(['style' => 'object-fit:cover;border-radius:4px']),

            Tables\Columns\TextColumn::make('title')
                ->label('Başlıq')
                ->default('—')
                ->searchable(),

            Tables\Columns\TextColumn::make('youtube_url')
                ->label('YouTube URL')
                ->limit(40)
                ->url(fn ($record) => $record->youtube_url, true),

            Tables\Columns\TextColumn::make('sort_order')
                ->label('Sıra')
                ->sortable(),

            Tables\Columns\IconColumn::make('is_active')
                ->label('Aktiv')
                ->boolean(),
        ])
        ->defaultSort('sort_order')
        ->reorderable('sort_order')
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListVideoGalleryItems::route('/'),
            'create' => Pages\CreateVideoGalleryItem::route('/create'),
            'edit'   => Pages\EditVideoGalleryItem::route('/{record}/edit'),
        ];
    }
}
