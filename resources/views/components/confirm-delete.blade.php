@props([
    'confirmText' => 'Sí, eliminar',
    'cancelText' => 'Cancelar',
    'title' => '¿Estás seguro?',
    'text' => 'Esta acción no se puede deshacer.',
    'confirmColor' => '#dc2626',
    'cancelColor' => '#6b7280'
])

<script>
    function confirmDelete(options = {}) {
        return Swal.fire({
            title: options.title || '{{ $title }}',
            text: options.text || '{{ $text }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: options.confirmText || '{{ $confirmText }}',
            cancelButtonText: options.cancelText || '{{ $cancelText }}',
            confirmButtonColor: options.confirmColor || '{{ $confirmColor }}',
            cancelButtonColor: options.cancelColor || '{{ $cancelColor }}',
            customClass: {
                confirmButton: 'px-4 py-2 rounded-lg font-medium',
                cancelButton: 'px-4 py-2 rounded-lg font-medium'
            },
            buttonsStyling: false,
            reverseButtons: true
        });
    }
</script>
