<!-- Alpine.js -->

<div x-data="{ open: false, loading: false }">
    <!-- Loader central -->
    <div x-show="loading" 
     class="fixed inset-0 flex items-center justify-center bg-[rgba(51,51,51,0.8)] z-[99999]"
     x-transition>
 
<div class="relative flex items-center justify-center">
    <!-- Círculo central -->
    <div class="w-6 h-6 bg-white rounded-full"></div>
    
    <!-- Ondas -->
    <div class="absolute w-6 h-6 border-4 border-white rounded-full animate-ping"></div>
    <div class="absolute w-10 h-10 border-4 border-white rounded-full animate-ping delay-150"></div>
    <div class="absolute w-14 h-14 border-4 border-white rounded-full animate-ping delay-300"></div>
  </div>
</div>
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Logo -->
            <a href="" @click="loading = true" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('image/guayacologo.webp') }}" class="h-8" alt="GuayacoDev Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap">
                    <span class="text-[#2AA4D9] dark:text-[#2AA4D9]">Guayaco</span>
                    <span class="text-[#075985] dark:text-gray-300">Dev</span>
                </span>
            </a>
            
            <!-- Botones derecha -->
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
              
                <button @click="open = !open" 
                        data-collapse-toggle="navbar-sticky" 
                        type="button" 
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" 
                        aria-controls="navbar-sticky" 
                        aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            
            <!-- Menú -->
            <div class="items-center justify-between w-full md:flex md:w-auto md:order-1" 
                 :class="{ 'hidden': !open }" 
                 id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="{{ route('welcome') }}" 
                           @click="loading = true"
                           class="block py-2 px-3 rounded-sm md:p-0 {{ request()->routeIs('welcome.*') ? 'text-[#2AA4D9] md:dark:text-[#2AA4D9]' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#2AA4D9] dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent md:dark:hover:text-[#2AA4D9]' }}">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing.about') }}" 
                           @click="loading = true"
                           class="block py-2 px-3 rounded-sm md:p-0 {{ request()->routeIs('landing.about.*') ? 'text-[#2AA4D9] md:dark:text-[#2AA4D9]' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#2AA4D9] dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent md:dark:hover:text-[#2AA4D9]' }}">
                            Acerca de
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing.projects') }}" 
                           @click="loading = true"
                           class="block py-2 px-3 rounded-sm md:p-0 {{ request()->routeIs('landing.projects.*') ? 'text-[#2AA4D9] md:dark:text-[#2AA4D9]' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#2AA4D9] dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent md:dark:hover:text-[#2AA4D9]' }}">
                            Proyectos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing.services') }}" 
                           @click="loading = true"
                           class="block py-2 px-3 rounded-sm md:p-0 {{ request()->routeIs('landing.services.*') ? 'text-[#2AA4D9] md:dark:text-[#2AA4D9]' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#2AA4D9] dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent md:dark:hover:text-[#2AA4D9]' }}">
                            Servicios
                        </a>
                    </li>
                  



                </ul>
            </div>
        </div>
    </nav>
</div>


<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
