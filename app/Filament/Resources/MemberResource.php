<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Member';
    protected static ?string $pluralModelLabel = 'Member';
    protected static ?string $navigationGroup = 'Website';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Profil')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('position')->label('Jabatan')->required(),
                    Forms\Components\FileUpload::make('photo')
                        ->directory('members')
                        ->image()
                        ->imageEditor()
                        ->maxSize(2048),
                    Forms\Components\TextInput::make('phone')->tel(),
                    Forms\Components\TextInput::make('email')->email(),
                    // LinkedIn diabaikan sesuai permintaan
                    Forms\Components\Textarea::make('overview')
                        ->label('Overview')
                        ->rows(4),
                ])
                ->columns(2),

            Forms\Components\Section::make('Experience Highlight')
                ->schema([
                    Forms\Components\Repeater::make('experience_highlights')
                        ->schema([
                            Forms\Components\Textarea::make('item')
                                ->rows(2)
                                ->label('Poin')
                                ->required(),
                        ])
                        ->default([])
                        ->columns(1)
                        ->collapsed()
                        ->label('Daftar Highlight'),
                ]),

            Forms\Components\Section::make('Pengaturan')
                ->schema([
                    Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->square(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('position')->sortable(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime('d M Y'),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('delete')
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn(Member $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
