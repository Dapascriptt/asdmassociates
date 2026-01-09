<?php

namespace App\Filament\Pages;

use App\Models\ContactSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ContactContent extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Kontak';
    protected static ?string $title = 'Konten Kontak';
    protected static ?string $slug = 'contact-content';
    protected static ?string $navigationGroup = 'Website';
    protected static ?int $navigationSort = 5;

    public ?array $data = [];
    public ?ContactSetting $record = null;

    public function mount(): void
    {
        $this->record = ContactSetting::first() ?? ContactSetting::create();
        $this->form->fill($this->record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('hero_title')
                        ->label('Judul')
                        ->placeholder('Hubungi kami untuk konsultasi'),
                    Forms\Components\Textarea::make('hero_subtitle')
                        ->label('Subjudul')
                        ->rows(2)
                        ->placeholder('Jam operasional, respons, dll'),
                ]),

            Forms\Components\Section::make('Informasi Kontak')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('phone')->label('Telepon / WhatsApp'),
                    Forms\Components\TextInput::make('email')->label('Email utama'),
                    Forms\Components\TextInput::make('email_alt')->label('Email cadangan'),
                    Forms\Components\TextInput::make('working_hours')->label('Jam kerja'),
                    Forms\Components\Textarea::make('address')->label('Alamat')->rows(3)->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Map Embed')
                ->schema([
                    Forms\Components\Textarea::make('map_embed')
                        ->label('Embed map (iframe src)')
                        ->placeholder('https://www.google.com/maps/embed?...')
                        ->rows(3),
                ]),
        ])->statePath('data');
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()
            ->title('Konten kontak tersimpan')
            ->success()
            ->send();
    }

    protected static string $view = 'filament.pages.contact-content';
}
