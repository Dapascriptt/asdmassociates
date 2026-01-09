<?php

namespace App\Filament\Pages;

use App\Models\ServicePageContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ServiceContent extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Layanan (Hero)';
    protected static ?string $title = 'Konten Layanan (Hero)';
    protected static ?string $slug = 'service-content';
    protected static ?int $navigationSort = 4;

    public ?array $data = [];
    public ?ServicePageContent $record = null;

    public function mount(): void
    {
        $this->record = ServicePageContent::first() ?? ServicePageContent::create();
        $this->data = $this->record->toArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Konten Hero Layanan')
                ->schema([
                    Forms\Components\TextInput::make('hero_title')
                        ->label('Judul')
                        ->placeholder('Pendampingan hukum yang rapi dan terukur')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('hero_subtitle')
                        ->label('Subjudul')
                        ->rows(3)
                        ->placeholder('Tulis subjudul ringkas untuk bagian hero layanan'),
                    Forms\Components\FileUpload::make('hero_image')
                        ->label('Gambar Hero')
                        ->directory('services/hero')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('200'),
                    Forms\Components\TagsInput::make('hero_points')
                        ->label('Poin Hero')
                        ->placeholder('Tambahkan poin (gunakan tanda enter)')
                        ->helperText('Contoh: Analisis awal — Pemetaan risiko & strategi'),
                ])
                ->columns(2),
        ])->statePath('data');
    }

    public function save(): void
    {
        $this->record->update($this->form->getState());

        Notification::make()
            ->title('Konten layanan tersimpan')
            ->success()
            ->send();
    }

    protected static string $view = 'filament.pages.service-content';
}
