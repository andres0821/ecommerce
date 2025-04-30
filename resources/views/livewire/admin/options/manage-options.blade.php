<div>

    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
                <x-button wire:click="$set('newOption.openModal', true)">Nuevo</x-button>
            </div>
        </header>

        <div class="p-6">
            <div class="space-y-6 ">
                @foreach ($options as $option)
                <div class="p-6 rounded-lg border border-gray-200 relative">
                    <div class="absolute -top-3 px-4 bg-white">
                        <span>
                            {{ $option->name }}
                        </span>
                    </div>
                    {{-- Valores --}}
                    <div class="flex flex-wrap">
                        @foreach ($option->feature as $featured)
                        @switch($option->type)
                            @case(1)
                                {{-- Texto --}}
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                    {{ $featured->description }}
                                </span>                                
                                @break
                            @case(2)
                                {{-- Color --}}
                                <span class="inline-block w-6 h-6 shadow-lg rounded-full border-2 border-gray-300 me-2" style="background-color: {{ $featured->value }}"></span>
                                @break
                            @default                             
                        @endswitch                            
                        @endforeach                        
                    </div>
                </div>                    
                @endforeach
            </div>
        </div>
    </section>

    <x-dialog-modal wire:model="newOption.openModal"> 
        <x-slot name="title">
            {{ __('Crear opción') }}
        </x-slot>

        <x-slot name="content">
            <x-validation-errors class="mb-4"/>
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-1" value="{{ __('Nombre') }}" />
                    <x-input wire:model="newOption.name" class="w-full" type="text" placeholder="Por ejemplo: Tamaño ó Color" />
                </div>
                <div>
                    <x-label class="mb-1" value="{{ __('Tipo') }}" />
                    <x-select wire:model.live="newOption.type" class="w-full">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>

            </div>
            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="mx-4">Valores</span>
                <hr class="flex-1">
            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $features) 
                <div wire:key="features-{{ $index }}" class="p-6 rounded-lg border border-gray-200 relative">
                    <div class="absolute -top-3 px-4 bg-white">
                        <button wire:click="removeFeature({{ $index }})">
                            <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <x-label class="mb-1" value="{{ __('Valor') }}" />
                            
                            @switch($newOption->type)
                                @case(1)
                                    <x-input wire:model="newOption.features.{{ $index }}.value" class="w-full" type="text" placeholder="Ingrese el valor de la opción" />
                                    
                                    @break
                                @case(2)
                                    <div class="border border-gray-300 rounded-md h-[42px] flex items-center justify-between px-3">
                                        {{ $newOption['features'][$index]['value'] ?: 'Selecciona un color' }}
                                        <input wire:model.live="newOption.features.{{ $index }}.value" type="color">
                                    </div>
                                    
                                    @break
                                @default
                                    
                            @endswitch
                        </div>
                        <div>
                            <x-label class="mb-1" value="{{ __('Descripción') }}" />
                            <x-input wire:model="newOption.features.{{ $index }}.description" class="w-full" type="text" placeholder="Ingrese una descripción" />
                        </div>
                    </div>               
                </div>
                @endforeach
            </div>

            <div class="flex justify-end">
                <x-button wire:click="addFeature" class="bg-gray-200 text-gray-700 hover:bg-gray-300">
                    {{ __('Agregar valor') }}
                </x-button>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('newOption.openModal', false)" class="mr-2">
                {{ __('Cancelar') }}
            </x-secondary-button>
            <x-button wire:click="saveOption" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>            
        </x-slot>

    </x-dialog-modal>

</div>
