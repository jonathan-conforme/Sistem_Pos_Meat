
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Animate.css para animaciones (opcional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')


    </div>
    <!-- ✅ Toast de notificación (reutilizable con Alpine) -->
<div 
    x-data="{ show: false, message: '', type: 'success' }"
    x-show="show"
    x-transition
    x-cloak
    :class="{
        'bg-green-600': type === 'success',
        'bg-red-600': type === 'error'
    }"
    class="fixed top-5 right-5 text-white px-4 py-3 rounded-lg shadow-lg z-50 flex items-center space-x-2"
>
    <!-- Icono dinámico -->
    <template x-if="type === 'success'">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </template>
    <template x-if="type === 'error'">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </template>

    <p x-text="message" class="font-medium"></p>
</div>
<div id="notification-container" class="fixed top-4 right-4 z-50 space-y-3"></div>
<script>
function showNotification(message, type = 'info') {
    const container = document.getElementById('notification-container');
    const notification = document.createElement('div');

    const styles = {
        success: 'bg-green-600 text-white border-l-4 border-green-700',
        error: 'bg-red-600 text-white border-l-4 border-red-700',
        info: 'bg-blue-600 text-white border-l-4 border-blue-700',
        warning: 'bg-yellow-500 text-white border-l-4 border-yellow-600'
    };

    const icons = {
        success: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        error: 'M10 14l2-2m0 0l2-2m-2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
        info: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        warning: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z'
    };

    notification.className = `
        p-4 rounded-lg shadow-lg transform transition-all duration-300 
        ${styles[type]} flex items-center opacity-0 translate-x-full
    `;

    notification.innerHTML = `
        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${icons[type]}" />
        </svg>
        <span class="flex-1">${message}</span>
        <button onclick="this.parentElement.remove()" class="ml-4 text-current hover:opacity-70">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    `;

    container.appendChild(notification);

    setTimeout(() => {
        notification.classList.remove('opacity-0', 'translate-x-full');
    }, 10);

    setTimeout(() => {
        notification.classList.add('opacity-0', 'translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}
</script>

<script>
    // 🧩 Función global para mostrar toast
    window.showToast = function (message, type = 'success') {
        const toast = document.querySelector('[x-data]');
        if (!toast || !toast.__x) return;

        toast.__x.$data.message = message;
        toast.__x.$data.type = type;
        toast.__x.$data.show = true;

        // Ocultar automáticamente después de 3 segundos
        setTimeout(() => {
            toast.__x.$data.show = false;
        }, 3000);
    }
</script>

    <script src="https://cdn.tailwindcss.com"></script>
   
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.js"></script>
    <!-- Antes del cierre de </body> -->

</body>

</html>