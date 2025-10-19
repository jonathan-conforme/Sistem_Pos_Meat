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
    <body class="bg-white dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
 
    <x-navbar/>

<section class="bg-gray dark:bg-gray-900 py-16">
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
        <img src="{{ asset('image/desarrollo.gif') }}" 
             alt="Equipo de GuayacoDev trabajando en soluciones tecnológicas" 
             class="w-full object-cover">
      </div>

    </div>
  </div>
</section>

 <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
 @include('components.toggle')
@include('components.footer')


    </body>
     <script src="https://cdn.jsdelivr.net/npm/flowbite@2.2.1/dist/flowbite.min.js"></script>
</html>
