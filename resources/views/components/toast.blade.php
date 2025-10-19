@php
    $types = ['success', 'error', 'info'];
@endphp

<div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2">
    @foreach($types as $type)
        @if(session($type))
            <div x-data="{ show: true, timer: null }"
                 x-init="timer = setTimeout(() => show = false, 3000); 
                         $el.addEventListener('mouseenter', () => clearTimeout(timer));
                         $el.addEventListener('mouseleave', () => timer = setTimeout(() => show = false, 3000))"
                 x-show="show"
                 x-transition.opacity
                 class="flex items-center w-80 p-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800"
                 role="alert">

                {{-- Icono según tipo --}}
                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8
                    @if($type=='success') text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200
                    @elseif($type=='error') text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200
                    @else text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200 @endif
                    rounded-lg">
                    @if($type=='success')
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                    @elseif($type=='error')
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3 13.414-1.414 1.414L10 11.414l-1.586 1.586L7 13.414 8.586 12 7 10.414l1.414-1.414L10 10.586l1.586-1.586L13 10.414 11.414 12 13 13.414Z"/>
                        </svg>
                    @else
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm1 15H9v-2h2v2Zm0-4H9V5h2v6Z"/>
                        </svg>
                    @endif
                </div>

                {{-- Mensaje --}}
                <div class="ms-3 text-sm font-normal flex-1">{{ session($type) }}</div>

                {{-- Botón cerrar --}}
                <button @click="show = false" type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex items-center justify-center dark:bg-gray-800 dark:text-gray-500 dark:hover:text-white">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif
    @endforeach
</div>
