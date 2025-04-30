<div>
    <form wire:submit="store">

        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen
                    <input type="file" accept="image/*" wire:model="image" class="hidden" />
                </label>

            </div>
            <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $image ? $image->temporaryUrl() : Storage::url($productEdit['image_path']) }}" alt="">
        </figure>

        <x-validation-errors :errors="$errors" class="mb-4" />

        <div class="card">

            <div class="mb-4">
                <x-label class="mb-2">Codigo</x-label>
                <x-input class="w-full" placeholder="Ingrese el código del producto" wire:model="productEdit.sku" />
            </div>

            <div class="mb-4">
                <x-label class="mb-2">Nombre del producto</x-label>
                <x-input class="w-full" placeholder="Porfavor ingrese el nombre del producto" wire:model="productEdit.name" />
            </div>

            <div class="mb-4">
                <x-label class="mb-2">Descripción</x-label>
                <x-textarea class="w-full" placeholder="Porfavor ingrese la descripción del producto" wire:model="productEdit.description" />
            </div>

            <div class="mb-4">
                <x-label class="mb-2">Familias</x-label>
                <x-select class="w-full" wire:model.live="family_id">
                    <option value="" disabled selected>Seleccione una familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">{{ $family->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">Categorías</x-label>
                <x-select class="w-full" wire:model.live="category_id">
                    <option value="" disabled selected>Seleccione una categoría</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">Subcategorías</x-label>
                <x-select class="w-full" wire:model.live="productEdit.subcategory_id">
                    <option value="" disabled selected>Seleccione una subcategorías</option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">Precio</x-label>
                <x-input type="number" step="0.01" class="w-full" placeholder="Porfavor ingrese el precio del producto" wire:model="productEdit.price" />
            </div>

            <div class="flex justify-end">
                <x-danger-button onclick="confirmDelete()">Eliminar</x-danger-button>
                <x-button class="ml-2">Actualizar producto</x-button>
            </div>

        </div>

    </form>

    <form action=" {{ route('admin.products.destroy', $product) }} " method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, ¡eliminalo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>    
    @endpush

</div>

