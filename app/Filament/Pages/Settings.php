<?php

namespace App\Filament\Pages;

use App\Settings\BlogSettings;
use App\Services\ThemeService;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;
use BackedEnum;

class Settings extends Page implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static ?string $navigationLabel = 'Ayarlar';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(BlogSettings::class);
        $this->form->fill([
            'site_name' => $settings->site_name,
            'site_tagline' => $settings->site_tagline,
            'site_description' => $settings->site_description,
            'comments_enabled' => $settings->comments_enabled,
            'default_meta_title' => $settings->default_meta_title,
            'default_meta_description' => $settings->default_meta_description,
            'theme' => $settings->theme ?? 'default',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Section::make('Site Bilgileri')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Site Adı')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('site_tagline')
                            ->label('Site Sloganı')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('site_description')
                            ->label('Site Açıklaması')
                            ->maxLength(500)
                            ->rows(3),
                    ]),
                Schemas\Section::make('Yorumlar')
                    ->schema([
                        Forms\Components\Toggle::make('comments_enabled')
                            ->label('Yorumlar Aktif'),
                    ]),
                Schemas\Section::make('SEO Varsayılanları')
                    ->schema([
                        Forms\Components\TextInput::make('default_meta_title')
                            ->label('Varsayılan Meta Başlık')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('default_meta_description')
                            ->label('Varsayılan Meta Açıklama')
                            ->maxLength(500)
                            ->rows(3),
                    ]),
                Schemas\Section::make('Tema Ayarları')
                    ->schema([
                        Forms\Components\Select::make('theme')
                            ->label('Aktif Tema')
                            ->options(function () {
                                $themeService = app(ThemeService::class);
                                $themes = $themeService->getAvailableThemes();
                                return collect($themes)->mapWithKeys(function ($info, $key) {
                                    return [$key => $info['name'] . ($info['description'] ? ' - ' . $info['description'] : '')];
                                })->toArray();
                            })
                            ->required()
                            ->default('default')
                            ->helperText('Frontend görünümü için kullanılacak temayı seçin'),
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
        
        $settings = app(BlogSettings::class);
        $settings->site_name = $data['site_name'];
        $settings->site_tagline = $data['site_tagline'] ?? null;
        $settings->site_description = $data['site_description'] ?? null;
        $settings->comments_enabled = $data['comments_enabled'] ?? true;
        $settings->default_meta_title = $data['default_meta_title'] ?? null;
        $settings->default_meta_description = $data['default_meta_description'] ?? null;
        $settings->theme = $data['theme'] ?? 'default';
        $settings->save();

        Notification::make()
            ->title('Ayarlar başarıyla kaydedildi.')
            ->success()
            ->send();
    }
}

