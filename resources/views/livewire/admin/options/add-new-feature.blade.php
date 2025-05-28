<div>
    <form wire:submit="addFeature" class="flex space-x-4">

        <div class="flex-1">

            <x-label class="mb-1" value="{{ __('Valor') }}" />     
                @switch($option->type)
                    @case(1)
                        <x-input wire:model="newFeature.value" class="w-full" type="text" placeholder="Ingrese el valor de la opción" />
                        
                        @break
                    @case(2)
                        <div class="border border-gray-300 rounded-md h-[42px] flex items-center justify-between px-3">
                            {{ $newFeature['value'] ?: 'Selecciona un color' }}
                            <input wire:model.live="newFeature.value" type="color">
                        </div>
                        
                        @break
                    @default   
                @endswitch               
        </div>

        <div class="flex-1">

            <x-label class="mb-1" value="{{ __('Descripción') }}" />
            <x-input wire:model="newFeature.description" class="w-full" type="text" placeholder="Ingrese una descripción" />

        </div>

        <div class="pt-7">
            <x-button>Agregar</x-button>
        </div>   

    </form>
</div>