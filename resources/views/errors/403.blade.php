<x-app-layout>
    <div class="flex flex-col items-center justify-center h-[80vh] text-center px-4">
        <!-- Imagen divertida -->
        <img src="{{ asset('image/trabajar.svg') }}" alt="Señalando" class="w-64 mb-6">

        <!-- Mensaje -->
        <h1 class="text-5xl font-bold text-purple-900 mb-4">¡Ponte a trabajar mejor!</h1>
        <p class="text-lg mb-6">No tienes permisos para ver esta página. ¡Hora de ponerse las pilas!</p>

        <!-- Botón para volver -->
        <a href="{{ route('dashboard') }}" class="bg-purple-900 text-white px-6 py-3 rounded hover:bg-purple-800 transition">
            Volver al inicio
        </a>
    </div>
</x-app-layout>
