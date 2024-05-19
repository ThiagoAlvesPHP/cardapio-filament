<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            Configurações Gerais
        </x-slot>

        <form wire:submit="create">
            {{ $this->form }}

            <button type="submit">
                {{ __('Salvar') }}
            </button>
        </form>
    </x-filament::section>
</x-filament-panels::page>
