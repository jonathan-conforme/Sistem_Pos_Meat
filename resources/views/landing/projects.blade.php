    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
  <link href="/src/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" />
<!-- CDN Font Awesome Gratis -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />


<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
      

    </head>
    <body class="bg-gray-100 dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <x-navbar />
    <!-- Hero Section -->
    <section class="bg-gray py-12">
      <div class="max-w-screen-xl mx-auto px-4 grid md:grid-cols-2 items-center gap-10">
        <div>
          <h1 class="text-4xl font-extrabold leading-tight mb-4">
  Transformamos tus ideas en <span class="text-[#2AA4D9]">Soluciones Digitales</span> Innovadoras
</h1>

          <p class="mb-6 text-gray-600">
  
En GuayacoDev transformamos ideas en soluciones digitales.
Estos proyectos para empresas, startups y tesis muestran nuestro compromiso con calidad e innovación.
Cada desarrollo refleja nuestra experiencia para impulsar el éxito de nuestros clientes.
¡Explora nuestro trabajo y descubre cómo llevar tu proyecto al siguiente nivel!

          </p>
          <div class="flex space-x-4">
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium shadow">Start Project</button>
            <button class="border border-indigo-600 text-indigo-600 px-6 py-2 rounded-lg font-medium">View Case Studies</button>
          </div>
          <div class="mt-6 text-sm text-gray-500">
            <p>25+ Project0s | 98% Satisfación | 1+ Año Experiencia</p>
          </div>
        </div>
     <div class="max-w-xs mx-auto">
  <img src="{{ asset('image/proyecto.gif') }}" 
       alt="Hero" 
       class="w-full h-auto rounded-lg" />
</div>


      </div>
    </section>
    <section class="mt-12">
  <h1 class="text-3xl font-extrabold text-gray-900 mb-4 text-center dark:text-white">
Proyectos
  </h1>
  <p class="text-gray-600 mb-8 text-center dark:text-gray-400">
    Explora nuestros productos destacados, diseñados para impulsar tu negocio y mejorar tu productividad.
  </p>
  <div class="flex flex-wrap justify-center gap-4 mb-8 lg:mb-10 max-w-screen-xl mx-auto">
    <!-- Tarjeta de producto (ancho: 288px) -->
          <div class="w-72 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
      <!-- Contenido idéntico -->
        <a href="#">
        <img class="p-4 rounded-t-lg w-full h-40 object-contain" src="https://images.ctfassets.net/63bmaubptoky/64wdUYA9ydrC2h5ZG7Ypiz/ab15194a3b6c72387787732c66f8d7c5/software-crm-gratis-Agile-CRM-Screenshot-1.png" alt="product image" />
      </a>
      <div class="px-4 pb-4">
        <a href="#">
          <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white line-clamp-2">Sistema de Gestión de Proyectos</h5>
        </a>
        <div class="flex items-center mt-2 mb-3">
          <!-- Rating (reducido) -->
          <div class="flex items-center space-x-1 rtl:space-x-reverse">
            <!-- Iconos de rating... -->
             <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
          </div>
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ms-2">5.0</span>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-2xl font-bold text-gray-900 dark:text-white">$599</span>
         
<!-- Modal toggle -->
<div class="flex justify-center m-5">
    <button id="readProductButton" data-modal-target="readProductModal" data-modal-toggle="readProductModal" class="block text-white bg-[#2AA4D9] hover:bg-[#075985] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
        <i class="fas fa-info-circle text-bg-[#2AA4D9] hover:bg-[#075985] text-sm mr-1"></i>
        Información
    </button>
</div>

<!-- Main modal -->
<div id="readProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <h3 class="font-semibold ">
                            Apple iMac 27”
                        </h3>
                        <p class="font-bold">
                            $2999
                        </p>
                    </div>
                    <div>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="readProductModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Standard glass ,3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US.</dd>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Category</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Electronics/PC</dd>
                </dl>
               
        </div>
    </div>
</div>
        </div>
      </div>
      
    </div>     
    <div class="w-72 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
      <!-- Contenido idéntico -->
        <a href="#">
        <img class="p-4 rounded-t-lg w-full h-40 object-contain" src="https://images.ctfassets.net/63bmaubptoky/64wdUYA9ydrC2h5ZG7Ypiz/ab15194a3b6c72387787732c66f8d7c5/software-crm-gratis-Agile-CRM-Screenshot-1.png" alt="product image" />
      </a>
      <div class="px-4 pb-4">
        <a href="#">
          <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white line-clamp-2">Sistema de Gestión de Proyectos</h5>
        </a>
        <div class="flex items-center mt-2 mb-3">
          <!-- Rating (reducido) -->
          <div class="flex items-center space-x-1 rtl:space-x-reverse">
            <!-- Iconos de rating... -->
             <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
          </div>
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ms-2">5.0</span>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-2xl font-bold text-gray-900 dark:text-white">$599</span>
         
<!-- Modal toggle -->
<div class="flex justify-center m-5">
    <button id="readProductButton" data-modal-target="readProductModal" data-modal-toggle="readProductModal" class="block text-white bg-[#2AA4D9] hover:bg-[#075985] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
        <i class="fas fa-info-circle text-bg-[#2AA4D9] hover:bg-[#075985] text-sm mr-1"></i>
        Información
    </button>
</div>

<!-- Main modal -->
<div id="readProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <h3 class="font-semibold ">
                            Apple iMac 27”
                        </h3>
                        <p class="font-bold">
                            $2999
                        </p>
                    </div>
                    <div>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="readProductModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Standard glass ,3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US.</dd>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Category</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Electronics/PC</dd>
                </dl>
               
        </div>
    </div>
</div>
        </div>
      </div>
      
    </div>  
    <div class="w-72 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
      <!-- Contenido idéntico -->
        <a href="#">
        <img class="p-4 rounded-t-lg w-full h-40 object-contain" src="https://images.ctfassets.net/63bmaubptoky/64wdUYA9ydrC2h5ZG7Ypiz/ab15194a3b6c72387787732c66f8d7c5/software-crm-gratis-Agile-CRM-Screenshot-1.png" alt="product image" />
      </a>
      <div class="px-4 pb-4">
        <a href="#">
          <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white line-clamp-2">Sistema de Gestión de Proyectos</h5>
        </a>
        <div class="flex items-center mt-2 mb-3">
          <!-- Rating (reducido) -->
          <div class="flex items-center space-x-1 rtl:space-x-reverse">
            <!-- Iconos de rating... -->
             <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
          </div>
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ms-2">5.0</span>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-2xl font-bold text-gray-900 dark:text-white">$599</span>
         
<!-- Modal toggle -->
<div class="flex justify-center m-5">
    <button id="readProductButton" data-modal-target="readProductModal" data-modal-toggle="readProductModal" class="block text-white bg-[#2AA4D9] hover:bg-[#075985] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
        <i class="fas fa-info-circle text-bg-[#2AA4D9] hover:bg-[#075985] text-sm mr-1"></i>
        Información
    </button>
</div>

<!-- Main modal -->
<div id="readProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <h3 class="font-semibold ">
                            Apple iMac 27”
                        </h3>
                        <p class="font-bold">
                            $2999
                        </p>
                    </div>
                    <div>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="readProductModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Standard glass ,3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US.</dd>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Category</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Electronics/PC</dd>
                </dl>
               
        </div>
    </div>
</div>
        </div>
      </div>
      
    </div>
     <div class="w-72 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
      <!-- Contenido idéntico -->
        <a href="#">
        <img class="p-4 rounded-t-lg w-full h-40 object-contain" src="https://images.ctfassets.net/63bmaubptoky/64wdUYA9ydrC2h5ZG7Ypiz/ab15194a3b6c72387787732c66f8d7c5/software-crm-gratis-Agile-CRM-Screenshot-1.png" alt="product image" />
      </a>
      <div class="px-4 pb-4">
        <a href="#">
          <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white line-clamp-2">Sistema de Gestión de Proyectos</h5>
        </a>
        <div class="flex items-center mt-2 mb-3">
          <!-- Rating (reducido) -->
          <div class="flex items-center space-x-1 rtl:space-x-reverse">
            <!-- Iconos de rating... -->
             <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
          </div>
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ms-2">5.0</span>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-2xl font-bold text-gray-900 dark:text-white">$599</span>
         
<!-- Modal toggle -->
<div class="flex justify-center m-5">
    <button id="readProductButton" data-modal-target="readProductModal" data-modal-toggle="readProductModal" class="block text-white bg-[#2AA4D9] hover:bg-[#075985] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
        <i class="fas fa-info-circle text-bg-[#2AA4D9] hover:bg-[#075985] text-sm mr-1"></i>
        Información
    </button>
</div>

<!-- Main modal -->
<div id="readProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <h3 class="font-semibold ">
                            Apple iMac 27”
                        </h3>
                        <p class="font-bold">
                            $2999
                        </p>
                    </div>
                    <div>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="readProductModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Standard glass ,3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US.</dd>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Category</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Electronics/PC</dd>
                </dl>
               
        </div>
    </div>
</div>
        </div>
      </div>
      
    </div>
  </div>
</section>
<section class="bg-white dark:bg-gray-900 py-16">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-12 lg:items-center">
      
      <!-- Texto -->
      <div>
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
          Sobre <span class="text-[#2AA4D9]">Guayaco</span><span class="text-[#075985]">Dev</span>
        </h2>
        <p class="mt-6 text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
          En <strong>GuayacoDev</strong> creemos que la tecnología es una herramienta poderosa para transformar ideas en soluciones reales. 
          Somos un equipo apasionado de desarrolladores, diseñadores y estrategas que trabaja para crear 
          <span class="font-semibold text-[#2AA4D9]">plataformas personalizadas, CRMs, páginas web</span> y soluciones digitales que impulsan el crecimiento de negocios y proyectos académicos.
        </p>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
          Desde nuestros inicios, hemos colaborado con estudiantes, emprendedores y empresas para convertir sus retos en oportunidades, siempre con un enfoque en la innovación, calidad y cercanía con nuestros clientes.
        </p>

        <div class="mt-8">
          <a href="#contacto" 
             class="inline-block px-6 py-3 text-white bg-[#2AA4D9] hover:bg-[#075985] rounded-lg font-medium transition-colors">
            Contáctanos
          </a>
        </div>
      </div>

      <!-- Imagen -->
      <div class="mt-10 lg:mt-0">
        <img src="{{ asset('image/equipo-guayacodev.jpg') }}" 
             alt="Equipo de GuayacoDev trabajando en soluciones tecnológicas" 
             class="w-full rounded-xl shadow-lg object-cover">
      </div>

    </div>
  </div>
</section>
@include('components.toggle')
@include('components.footer')

    </body>
     <script src="https://cdn.jsdelivr.net/npm/flowbite@2.2.1/dist/flowbite.min.js"></script>
</html>
