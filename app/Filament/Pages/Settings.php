<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

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

    public static function getNavigationLabel(): string
    {
        return 'Configurações';
    }

    public function getTitle(): string
    {
        return 'Configurações';
    }

    public function mount(Setting $post): void
    {
        $this->form->fill($post->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
