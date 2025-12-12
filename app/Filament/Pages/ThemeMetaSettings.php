<?php

namespace App\Filament\Pages;

use App\Services\ThemeService;
use App\Settings\ThemeMetaSettings;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use BackedEnum;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;

class ThemeMetaPage extends Page implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static ?string $navigationLabel = 'Tema Meta';

    protected static ?string $title = 'Tema Meta';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';

    protected string $view = 'filament.pages.theme-meta-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(ThemeMetaSettings::class);
        $this->form->fill([
            'meta' => $settings->meta ?? [],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Section::make('Tema Bazlı Alanlar')
                    ->schema([
                        Forms\Components\Repeater::make('meta')
                            ->label('Tema Metaları')
                            ->schema([
                                Forms\Components\Select::make('theme')
                                    ->label('Tema')
                                    ->options(function (ThemeService $themeService) {
                                        $themes = $themeService->getAvailableThemes();
                                        return collect($themes)->mapWithKeys(fn ($info, $key) => [$key => $info['name'] ?? ucfirst($key)])->toArray();
                                    })
                                    ->required(),
                                Forms\Components\TextInput::make('marquee_text')
                                    ->label('Marquee / Kayar Yazı')
                                    ->maxLength(255)
                                    ->helperText('Gem teması için üstte kayan yazı'),
                            ])
                            ->columns(1)
                            ->reorderable()
                            ->default([]),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Kaydet')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $settings = app(ThemeMetaSettings::class);
        $settings->meta = $data['meta'] ?? [];
        $settings->save();

        Notification::make()
            ->title('Tema meta ayarları kaydedildi.')
            ->success()
            ->send();
    }
}


