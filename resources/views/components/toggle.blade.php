<!-- Coloca esto en tu layout principal (ej: resources/views/layouts/app.blade.php) -->
<div x-data="globalTheme()" x-init="initTheme()">
    <!-- Toggle de Tema -->
    <div class="fixed bottom-4 right-4 z-50">
        <!-- Botón de toggle -->
        <button @click="open = !open"
            aria-label="Cambiar tema"
            class="p-3 rounded-full bg-gray-200/80 dark:bg-gray-700/80 shadow-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-all backdrop-blur-sm"
            :aria-expanded="open">
            
            <!-- Iconos dinámicos con transición -->
            <div class="relative w-6 h-6">
                <!-- Sol (light) -->
                <svg x-show="theme === 'light'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="absolute w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41-1.41M12 6a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
                
                <!-- Luna (dark) -->
                <svg x-show="theme === 'dark'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="absolute w-6 h-6 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
                
                <!-- Sistema -->
                <svg x-show="theme === 'system'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="absolute w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17h4.5M4 6h16M4 6a2 2 0 012-2h12a2 2 0 012 2M4 6v10a2 2 0 002 2h12a2 2 0 002-2V6"/>
                </svg>
            </div>
        </button>

        <!-- Dropdown -->
        <div x-show="open" 
             @click.outside="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="absolute bottom-14 right-0 w-44 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-lg shadow-xl p-2 space-y-2 z-50 border border-gray-200 dark:border-gray-700"
             x-cloak>
            
            <button @click="setTheme('light')" 
                    class="flex items-center space-x-2 w-full px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    :class="{'bg-gray-100 dark:bg-gray-700': theme === 'light'}">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41-1.41M12 6a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
                <span>Claro</span>
                <span x-show="theme === 'light'" class="ml-auto text-blue-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </button>

            <button @click="setTheme('dark')" 
                    class="flex items-center space-x-2 w-full px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    :class="{'bg-gray-100 dark:bg-gray-700': theme === 'dark'}">
                <svg class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
                <span>Oscuro</span>
                <span x-show="theme === 'dark'" class="ml-auto text-blue-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </button>

            <button @click="setTheme('system')" 
                    class="flex items-center space-x-2 w-full px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    :class="{'bg-gray-100 dark:bg-gray-700': theme === 'system'}">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17h4.5M4 6h16M4 6a2 2 0 012-2h12a2 2 0 012 2M4 6v10a2 2 0 002 2h12a2 2 0 002-2V6"/>
                </svg>
                <span>Sistema</span>
                <span x-show="theme === 'system'" class="ml-auto text-blue-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</div>

<script>
function globalTheme() {
    return {
        open: false,
        theme: localStorage.getItem('theme') || 'system',
        
        initTheme() {
            // Sincronizar con cualquier tema existente
            this.syncExistingTheme();
            
            // Aplicar el tema inicial
            this.applyGlobalTheme(this.theme);
            
            // Escuchar cambios en las preferencias del sistema
            this.setupSystemPreferenceListener();
        },
        
        setTheme(theme) {
            this.theme = theme;
            localStorage.setItem('theme', theme);
            this.applyGlobalTheme(theme);
            this.open = false;
            
            // Disparar evento personalizado para notificar a otros componentes
            document.dispatchEvent(new CustomEvent('theme-changed', { 
                detail: { theme: theme }
            }));
        },
        
        applyGlobalTheme(theme) {
            const isDark = this.shouldUseDarkMode(theme);
            
            // 1. Aplicar clase dark de Tailwind
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            
            // 2. Actualizar atributos para Flowbite
            document.documentElement.setAttribute('data-mode', isDark ? 'dark' : 'light');
            
            // 3. Actualizar atributo para compatibilidad general
            document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
            
            // 4. Forzar actualización de componentes Flowbite
            this.updateFlowbiteComponents();
            
            // 5. Actualizar barra lateral específicamente
            this.updateSidebarTheme(isDark);
        },
        
        shouldUseDarkMode(theme) {
            return theme === 'dark' || 
                  (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        },
        
        syncExistingTheme() {
            // Sincronizar con data-bs-theme (Bootstrap)
            if (document.documentElement.hasAttribute('data-bs-theme')) {
                this.theme = document.documentElement.getAttribute('data-bs-theme');
            }
            // Sincronizar con data-mode (Flowbite)
            else if (document.documentElement.hasAttribute('data-mode')) {
                this.theme = document.documentElement.getAttribute('data-mode');
            }
            
            localStorage.setItem('theme', this.theme);
        },
        
        setupSystemPreferenceListener() {
            const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            darkModeMediaQuery.addListener((e) => {
                if (this.theme === 'system') {
                    this.applyGlobalTheme('system');
                }
            });
        },
        
        updateFlowbiteComponents() {
            // Esperar un momento para que el DOM se actualice
            setTimeout(() => {
                if (typeof Flowbite !== 'undefined') {
                    // Reiniciar componentes Flowbite que necesitan actualización
                    const componentsToUpdate = [
                        'Drawer', 'Dropdown', 'Modal', 'Tooltip', 'Popover', 
                        'Collapse', 'Accordion', 'Tabs', 'Carousel'
                    ];
                    
                    componentsToUpdate.forEach(component => {
                        if (Flowbite[component]) {
                            document.querySelectorAll(`[data-${component.toLowerCase()}]`).forEach(el => {
                                new Flowbite[component](el);
                            });
                        }
                    });
                }
            }, 50);
        },
        
        updateSidebarTheme(isDark) {
            // Seleccionar todos los sidebars (pueden ser múltiples)
            const sidebars = document.querySelectorAll('.sidebar, aside, [data-sidebar]');
            
            sidebars.forEach(sidebar => {
                // Actualizar clases de Tailwind
                if (isDark) {
                    sidebar.classList.add('dark', 'bg-gray-800');
                    sidebar.classList.remove('bg-white');
                } else {
                    sidebar.classList.remove('dark', 'bg-gray-800');
                    sidebar.classList.add('bg-white');
                }
                
                // Actualizar atributos para Flowbite
                sidebar.setAttribute('data-mode', isDark ? 'dark' : 'light');
                
                // Actualizar colores de texto
                const textElements = sidebar.querySelectorAll('[class*="text-"]');
                textElements.forEach(el => {
                    if (isDark) {
                        el.classList.remove('text-gray-800');
                        el.classList.add('text-gray-200');
                    } else {
                        el.classList.remove('text-gray-200');
                        el.classList.add('text-gray-800');
                    }
                });
            });
        }
    }
}
</script>

<style>
[x-cloak] { display: none !important; }

/* Transición suave para el cambio de tema */
html {
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Asegurar que el fondo se extienda completamente */
body {
    @apply min-h-screen bg-white dark:bg-gray-900;
}
</style>