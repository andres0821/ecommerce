<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
]">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex items-center">
                <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm hover:text-blue-500">Cerrar sesión</button>
                    </form>                
                </div>   
            </div>                    
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center justify-center">
            <h2 class="text-lg font-semibold text-gray-800">YOUTECHSUPPORT SAS</h2>            
        </div>
    </div>  
</x-admin-layout>