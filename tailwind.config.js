import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
                mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', '"Liberation Mono"', '"Courier New"', 'monospace'],
            },
            colors: {
                // Tema Industrial / Toko Bangunan
                'construction': {
                    400: '#FDE047', // Kuning terang
                    500: '#EAB308', // Kuning konstruksi
                    600: '#CA8A04', // Kuning gelap
                },
                'steel': {
                    800: '#27272A', // Abu-abu baja
                    900: '#18181B', // Hitam pekat
                },
                'brick': {
                    600: '#DC2626', // Merah bata
                }
            },
            boxShadow: {
                // Neo-brutalism shadows
                'neo': '4px 4px 0px 0px rgba(24, 24, 27, 1)', // Solid black shadow
                'neo-sm': '2px 2px 0px 0px rgba(24, 24, 27, 1)',
                'neo-hover': '2px 2px 0px 0px rgba(24, 24, 27, 1)',
            }
        },
    },

    plugins: [forms],
};
