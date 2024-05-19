<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;

class Settings extends Page
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    // public static function canAccess(): bool
    // {
    //     return auth()->user()->canManageSettings();
    // }

    protected function getHeaderActions(): array
    {
        FilamentAsset::register([
            Js::make('custom-script', 'https://cdn.tailwindcss.com'),
        ]);

        $panel = Filament::getPanel();
        $primaryColor = $panel->getColors()['primary'];

        view()->share('primaryColor', $primaryColor);

        return [];
    }

    public static function getNavigationLabel(): string
    {
        return 'Configurações';
    }

    public function getTitle(): string
    {
        return 'Configurações';
    }

    public function mount(Setting $settings): void
    {
        $this->form->fill($settings->first()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\FileUpload::make('logo')
                        ->label('Logo'),
                    Forms\Components\FileUpload::make('favicon')
                        ->label('Favicon'),
                ])->columns(2),

                Forms\Components\TextInput::make('name')
                    ->label('Nome da empresa')
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Grid::make()->schema([
                    Forms\Components\TextInput::make('zipcode')
                        ->label('CEP')
                        ->mask('99999-999')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('street')
                        ->label('Rua')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('number')
                        ->label('Número')
                        ->required()
                        ->maxLength(255),
                ])->columns(3),

                Forms\Components\Grid::make()->schema([
                    Forms\Components\TextInput::make('address')
                        ->label('Endereço')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('complement')
                        ->label('Complemento')
                        ->required()
                        ->maxLength(255),
                ])->columns(2),

                Forms\Components\Grid::make()->schema([
                    Forms\Components\TextInput::make('whatsapp')
                        ->label('Whatsapp')
                        ->mask('(99)99999-9999')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->label('E-mail')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('shipping_fee')
                        ->label('Taxa de entrega')
                        ->numeric()
                        ->required()
                        ->maxLength(255),

                ])->columns(3),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        if (self::$model::count()) {
            $find = self::$model::first();
            $find->update($this->form->getState());
            $title = __('Atualizado com sucesso!');
        } else {
            self::$model::create($this->form->getState());
            $title = __('Registrado com sucesso!');
        }

        Notification::make('notification')
            ->title($title)
            ->success()
            ->send();
    }
}
