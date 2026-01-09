<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Arr;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Galeri';
    protected static ?string $modelLabel = 'Galeri';
    protected static ?string $pluralModelLabel = 'Galeri';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Galeri')
                ->schema([
                    TextInput::make('title')
                        ->label('Judul (opsional)')
                        ->maxLength(150)
                        ->placeholder('Contoh: Dokumentasi kegiatan'),

                    FileUpload::make('images')
                        ->label('Gambar (bisa lebih dari 1)')
                        ->multiple()
                        ->image()
                        ->reorderable()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('gallery')
                        ->visibility('public')
                        ->helperText('Unggah satu atau lebih gambar; urutan pertama dipakai sebagai thumbnail.'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('images')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->height(60)
                    ->square()
                    ->getStateUsing(fn ($record) => Arr::first($record->images ?? []) ?? $record->image),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
