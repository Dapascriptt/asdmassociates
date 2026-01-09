<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Mitra';
    protected static ?string $modelLabel = 'Mitra';
    protected static ?string $pluralModelLabel = 'Mitra';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Mitra')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Mitra')
                        ->placeholder('Contoh: PT Contoh Sejahtera')
                        ->maxLength(120),

                    TextInput::make('order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Semakin kecil, semakin dulu tampil.'),

                    FileUpload::make('logo')
                        ->label('Logo')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('mitra')
                        ->visibility('public')
                        ->required()
                        ->columnSpanFull()
                        ->helperText('Upload logo PNG/JPG. Disarankan PNG transparan.'),

                    Toggle::make('is_active')
                        ->label('Aktifkan tampil di website')
                        ->default(true)
                        ->inline(false),

                    Toggle::make('is_client')
                        ->label('Tandai sebagai Klien')
                        ->helperText('Jika diaktifkan, logo masuk slider Klien.')
                        ->default(false)
                        ->inline(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->height(40)
                    ->square(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter(),

                ToggleColumn::make('is_client')
                    ->label('Klien?')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('delete')
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn(Partner $record) => $record->delete()),
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
            'index'  => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit'   => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
