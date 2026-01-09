<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

use App\Models\AboutContent;
use App\Models\Certification;
use App\Models\TeamMember;

class About extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'About';
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'Website';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.about';

    public ?array $data = [];

    public function mount(): void
    {
        $content = AboutContent::firstOrCreate([]);

        $this->form->fill([
            'intro_1' => $content->intro_1,
            'intro_2' => $content->intro_2,
            'hero_title' => $content->hero_title,
            'hero_subtitle' => $content->hero_subtitle,
            'hero_points' => $content->hero_points,
            'vision' => $content->vision,
            'mission' => $content->mission,
            'hero_image' => $content->hero_image,

            'certifications' => Certification::orderBy('sort_order')->get()->toArray(),
            'team_members' => TeamMember::orderBy('sort_order')->get()->toArray(),
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Konten Tentang Kami')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('hero_image')
                        ->label('Hero Image')
                        ->image()
                        ->directory('about')
                        ->imageEditor()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('hero_title')
                        ->label('Judul hero')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('hero_subtitle')
                        ->label('Subjudul hero')
                        ->rows(2),
                    Forms\Components\TagsInput::make('hero_points')
                        ->label('Poin hero')
                        ->placeholder('Analisis awal - Pemetaan risiko & strategi')
                        ->helperText('Gunakan tanda enter untuk poin baru. Format opsional: Judul - Deskripsi'),

                    Forms\Components\Textarea::make('intro_1')->label('Paragraf 1')->rows(4),
                    Forms\Components\Textarea::make('intro_2')->label('Paragraf 2')->rows(4),

                    Forms\Components\FileUpload::make('about_images')
                        ->label('Galeri singkat (multi foto)')
                        ->multiple()
                        ->image()
                        ->directory('about/gallery')
                        ->reorderable()
                        ->imageEditor()
                        ->panelLayout('grid')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Sertifikasi & Kredensial')
                ->schema([
                    Forms\Components\Repeater::make('certifications')
                        ->reorderable('sort_order')
                        ->schema([
                            Forms\Components\TextInput::make('title')->required(),
                            Forms\Components\TextInput::make('issuer'),
                            Forms\Components\TextInput::make('year'),
                            Forms\Components\FileUpload::make('image')
                                ->label('File Sertifikat (opsional)')
                                ->image()
                                ->directory('certifications')
                                ->imageEditor()
                                ->helperText('Biarkan kosong jika tidak ada lampiran sertifikat.'),
                        ]),
                ]),

            Forms\Components\Section::make('Tim & Partner')
                ->schema([
                    Forms\Components\Repeater::make('team_members')
                        ->reorderable('sort_order')
                        ->schema([
                            Forms\Components\FileUpload::make('photo')
                                ->image()
                                ->directory('team')
                                ->imageEditor()
                                ->imageCropAspectRatio('1:1'),

                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('position'),
                            Forms\Components\Textarea::make('bio')->rows(3),

                            Forms\Components\TagsInput::make('practice_areas')
                                ->label('Bidang Praktik'),
                        ]),
                ]),
        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function save(): void
    {
        $state = $this->form->getState();

        AboutContent::first()->update($state);

        Certification::query()->delete();
        foreach ($state['certifications'] ?? [] as $i => $c) {
            Certification::create(array_merge($c, ['sort_order' => $i]));
        }

        TeamMember::query()->delete();
        foreach ($state['team_members'] ?? [] as $i => $t) {
            TeamMember::create(array_merge($t, ['sort_order' => $i]));
        }

        Notification::make()
            ->title('About berhasil disimpan')
            ->success()
            ->send();
    }
}
