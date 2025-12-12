<?php

namespace App\Filament\Pages;

use App\Settings\SocialSettings as SocialSettingsConfig;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;

class SocialLinksSettings extends Page implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static ?string $navigationLabel = 'Sosyal Medya';

    protected static ?string $title = 'Sosyal Medya';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-share';

    protected string $view = 'filament.pages.social-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(SocialSettingsConfig::class);
        $this->form->fill([
            'links' => $settings->links ?? [],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Section::make('Sosyal Medya Bağlantıları')
                    ->schema([
                        Forms\Components\Repeater::make('links')
                            ->label('Linkler')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('İsim')
                                    ->required()
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('icon')
                                    ->label('Boostrap Icon (ör: bi bi-facebook)' )
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('url')
                                    ->label('Link')
                                    ->required()
                                    ->url()
                                    ->maxLength(255),
                            ])
                            ->default([])
                            ->reorderable()
                            ->collapsible()
                            ->addActionLabel('Bağlantı ekle')
                            ->grid(1),
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

        $settings = app(SocialSettingsConfig::class);
        $settings->links = $data['links'] ?? [];
        $settings->save();

        Notification::make()
            ->title('Sosyal medya ayarları kaydedildi.')
            ->success()
            ->send();
    }
}


