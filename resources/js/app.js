import './bootstrap';
import 'flowbite';
import Swal from 'sweetalert2'; // Importamos la librería
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.Swal = Swal; // Lo hacemos global por si quieres usarlo en otro lado

// --- Función de Confirmación Global ---
window.confirmDelete = (formId) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta acción no se puede revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        buttonsStyling: false, // OBLIGATORIO para usar Tailwind
        customClass: {
            confirmButton: 'bg-red-600 text-white px-6 py-2.5 mx-2 rounded-lg font-bold hover:bg-red-700 focus:ring-4 focus:ring-red-300 transition-all shadow-md',
            cancelButton: 'bg-gray-500 text-white px-6 py-2.5 mx-2 rounded-lg font-bold hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 transition-all shadow-md',
            popup: 'rounded-xl border dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
};

Alpine.start();