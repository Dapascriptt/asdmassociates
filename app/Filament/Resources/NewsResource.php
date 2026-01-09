<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $pluralLabel = 'Berita';
    protected static ?string $modelLabel = 'Berita';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Berita')
                    ->schema([
                        Forms\Components\TextInput::make('url')
                            ->label('Link Berita (URL)')
                            ->placeholder('https://...')
                            ->required()
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Ringkasan singkat')
                            ->rows(2)
                            ->maxLength(500),
                        Forms\Components\TextInput::make('site_name')
                            ->label('Nama situs')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('image')
                            ->label('URL Gambar')
                            ->maxLength(500)
                            ->prefixIcon('heroicon-o-photo'),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Tanggal Publish')
                            ->seconds(false)
                            ->default(now()),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->limit(30),
                Tables\Columns\TextColumn::make('site_name')
                    ->label('Sumber')
                    ->limit(20),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publish')
                    ->dateTime('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y'),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('delete')
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    public static function fetchOgMetadata(string $url): array
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return [];
        }

        $html = null;

        // Try cURL first
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT => 8,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; ASDM-Bot/1.0)',
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_HTTPHEADER => [
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language: en-US,en;q=0.9',
                ],
            ]);
            $html = curl_exec($ch);
            curl_close($ch);
        }

        // Fallback file_get_contents jika curl gagal
        if (!$html) {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 8,
                    'follow_location' => 1,
                    'user_agent' => 'Mozilla/5.0 (compatible; ASDM-Bot/1.0)',
                ],
                'ssl' => [
                    'verify_peer' => true,
                    'verify_peer_name' => true,
                ],
            ]);
            $html = @file_get_contents($url, false, $context);
        }

        if (!$html) {
            return [];
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        if (!@$dom->loadHTML($html)) {
            return [];
        }
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $getMeta = function (array $names) use ($xpath) {
            foreach ($names as $name) {
                $query = "//meta[@property='{$name}']/@content | //meta[@name='{$name}']/@content";
                $node = $xpath->query($query)->item(0);
                if ($node && $node->nodeValue) {
                    return trim($node->nodeValue);
                }
            }
            return null;
        };

        $titleTag = $xpath->query('//title')->item(0);
        $titleTagVal = $titleTag ? trim($titleTag->textContent) : null;
        $metaDesc = $getMeta(['description']);

        return [
          'title' => $getMeta(['og:title', 'twitter:title', 'title']) ?? $titleTagVal,
          'description' => $getMeta(['og:description', 'twitter:description', 'description']) ?? $metaDesc,
          'image' => $getMeta(['og:image', 'og:image:secure_url', 'twitter:image', 'image']),
          'published_at' => $getMeta(['article:published_time', 'og:updated_time']),
          'site_name' => $getMeta(['og:site_name']),
        ];
    }
}
