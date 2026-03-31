import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import flowbite from "flowbite/plugin";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    // BUENA PRÁCTICA: Safelist para clases dinámicas de JavaScript
    safelist: [
        'bg-red-600',
        'bg-gray-500',
        'hover:bg-red-700',
        'hover:bg-gray-600',
        'text-white',
        'px-6',
        'py-2.5',
        'rounded-lg',
        'font-bold',
        'mx-2',
        'shadow-md',
        'focus:ring-4',
        'focus:ring-red-300',
        'focus:ring-gray-300'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        flowbite,
    ],
};