<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            Configurações Gerais
        </x-slot>

        <form wire:submit="create">
            {{ $this->form }}

            <button type="submit" class="px-10 py-2 mt-4 rounded-md text-white font-semibold">
                {{ __('Salvar') }}
            </button>
        </form>
    </x-filament::section>

    <style scoped>
        button.px-10 {
            background-color: rgb({{ $primaryColor[500] }}) !important;
        }

        button:hover {
            background-color: rgb({{ $primaryColor[400] }}) !important;
        }
    </style>
</x-filament-panels::page>
