<script>

window.confirmDelete = function(formId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        
        // 1. Forzamos los colores mediante propiedades directas (esto inyecta style="background-color:...")
        confirmButtonColor: '#dc2626', // bg-red-600
        cancelButtonColor: '#6b7280',  // bg-gray-500
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        
        // 2. Reactivamos esto pero solo para el padding y la fuente
        buttonsStyling: true, 
        
        customClass: {
            // Añadimos !important mediante clases de Tailwind si es necesario
            confirmButton: 'px-5 py-2.5 rounded-lg text-white font-bold shadow-sm',
            cancelButton: 'px-5 py-2.5 rounded-lg text-white font-bold shadow-sm'
        },

        showClass: { popup: 'animate__animated animate__zoomIn animate__faster' },
        hideClass: { popup: 'animate__animated animate__zoomOut animate__faster' }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
    // ESTO SOLO SE EJECUTA SI HAY SESIÓN
    @if(session('success') || session('error') || session('info') || session('warning') || $errors->any())
        let iconType = 'success';
        let message = '';
        let animationIn = 'animate__fadeInRight';
        let animationOut = 'animate__fadeOutRight';

        @if(session('success'))
            iconType = 'success';
            message = '{{ session('success') }}';
            animationIn = 'animate__fadeInDown';
        @elseif(session('error') || $errors->any())
            iconType = 'error';
            message = '{{ session('error') ?: $errors->first() }}';
            animationIn = 'animate__backInRight';
        @elseif(session('warning'))
            iconType = 'warning';
            message = '{{ session('warning') }}';
            animationIn = 'animate__heartBeat';
        @elseif(session('info'))
            iconType = 'info';
            message = '{{ session('info') }}';
            animationIn = 'animate__fadeInDown';
        @endif

        if (message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                showClass: { popup: `animate__animated ${animationIn} animate__faster` },
                hideClass: { popup: `animate__animated ${animationOut} animate__faster` },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({ icon: iconType, title: message });
        }
    @endif
</script>