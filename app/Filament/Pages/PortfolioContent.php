<?php

namespace App\Filament\Pages;

use App\Models\PortfolioItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class PortfolioContent extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Portofolio';
    protected static ?string $navigationGroup = 'Website';
    protected static ?int $navigationSort = 6;
    protected static string $view = 'filament.pages.portfolio-content';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'portfolio_items' => PortfolioItem::orderBy('sort_order')->get()->toArray(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Portofolio (slider)')
                ->schema([
                    Forms\Components\Repeater::make('portfolio_items')
                        ->label('Daftar portofolio')
                        ->reorderable('sort_order')
                        ->schema([
                            Forms\Components\TextInput::make('role')->label('Peran')->maxLength(255),
                            Forms\Components\TextInput::make('period')->label('Periode')->maxLength(255),
                            Forms\Components\TextInput::make('company')->label('Nama perusahaan')->maxLength(255)->required(),
                            Forms\Components\FileUpload::make('logo')
                                ->label('Logo')
                                ->image()
                                ->directory('portfolio')
                                ->imageEditor()
                                ->imagePreviewHeight('120'),
                        ])
                        ->columns(2),
                ]),

        ])->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        PortfolioItem::query()->delete();
        foreach ($state['portfolio_items'] ?? [] as $i => $item) {
            PortfolioItem::create(array_merge($item, ['sort_order' => $i]));
        }

        Notification::make()
            ->title('Portofolio tersimpan')
            ->success()
            ->send();
    }
}
