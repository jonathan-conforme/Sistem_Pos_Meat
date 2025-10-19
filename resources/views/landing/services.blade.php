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
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />


    </head>
    <body class="bg-gray-100 dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <x-navbar />
  <section class="bg-gray-50 dark:bg-gray-900 py-16">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Título -->
    <div class="text-center mb-12">
      <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
        Nuestros <span class="text-[#2AA4D9]">Servicios</span>
      </h2>
      <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
        En  <span>
          <strong class="text-[#2AA4D9] dark:text-[#2AA4D9]">Guayaco</strong><strong class="text-[#075985] dark:text-gray-300">Dev</strong>
        </span> ofrecemos soluciones digitales adaptadas a tus necesidades.
      </p>
    </div>

    <!-- Grid de servicios -->
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

      <!-- Servicio 1 -->
      <div data-aos="flip-left" data-aos-delay="0" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all">
  <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#2AA4D9] mb-4">
    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
    </svg>
  </div>
  <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Desarrollo Web</h3>
  <p class="text-gray-600 dark:text-gray-300">
    Páginas web modernas, rápidas y optimizadas para ofrecer la mejor experiencia de usuario.
  </p>
</div>

      <!-- Servicio 2 -->
      <div data-aos="flip-left" data-aos-delay="200" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#2AA4D9] mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 3 3 3 0 016 3z"></path>
                </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Software Personalizado</h3>
        <p class="text-gray-600 dark:text-gray-300">
          Sistemas para automatizar procesos empresariales o <strong>plataformas especializadas para investigación académica</strong>.   </p>
      </div>

      <!-- Servicio 3 -->
      <div data-aos="flip-left" data-aos-delay="400" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#2AA4D9] mb-4">
           <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Dashboards Académicos</h3>
        <p class="text-gray-600 dark:text-gray-300">
Visualización profesional de datos para tesis de ingeniería, economía o ciencias de la salud.
        </p>
      </div>
        <!-- Servicio 4 -->
      <div data-aos="flip-left" data-aos-delay="600" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#2AA4D9] mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 8v8H8V8h8zm4-3v2m0 10v2m-4-18v2m0 14v2m-4-18v2m0 14v2m-4-18v2m0 14v2M4 5v2m0 10v2" />
        </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Proyectos con Arduino</h3>
        <p class="text-gray-600 dark:text-gray-300">
          Soluciones con sensores, automatización y prototipos electrónicos para investigación o educación.
        </p>
      </div>
      <!-- Servicio 5 -->
      <div data-aos="flip-left" data-aos-delay="800" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#2AA4D9] mb-4">
         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4h10a1 1 0 011 1v14a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 18h2" />
    </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Apps Móviles</h3>
        <p class="text-gray-600 dark:text-gray-300">
Desarrollo de aplicaciones móviles híbridas o nativas para Android y iOS con enfoque académico o empresarial.          
        </p>
      </div>
      
      <!-- Servicio 6 -->
      <div data-aos="flip-left" data-aos-delay="1000" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#2AA4D9] text-white mb-4">
         <svg class="w-8 h-8 text-white " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 16.5a2.5 2.5 0 01-2.5 2.5H5.5A2.5 2.5 0 013 16.5v-9A2.5 2.5 0 015.5 5h13A2.5 2.5 0 0121 7.5v9z" />
        </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Consultoría Tecnológica</h3>
        <p class="text-gray-600 dark:text-gray-300">
          Asesoría y acompañamiento para optimizar procesos con soluciones digitales efectivas.
        </p>
      </div>

    </div>
  </div>
</section>


 <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
 @include('components.toggle')
@include('components.footer')

 <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
 <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // duración de la animación en ms
    once: true      // animar solo la primera vez que aparece
  });
</script>
    </body>
   


</html>
