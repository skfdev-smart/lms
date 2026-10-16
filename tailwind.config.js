import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
                raleway: ['Raleway', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#DA251D', // SPINDO Red
                    hover: '#b91b15',
                },
                secondary: '#1a1a1a', // Darker Grey/Black for industrial feel
            },
            animation: {
                'spin-slow': 'spin 60s linear infinite',
                'blob': 'blob 7s infinite',
            },
            keyframes: {
                blob: {
                    '0%': { transform: 'translate(0px, 0px) scale(1)' },
                    '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                    '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                    '100%': { transform: 'translate(0px, 0px) scale(1)' },
                },
                'grid-move': {
                    '0%': { transform: 'translateY(0)' },
                    '100%': { transform: 'translateY(40px)' },
                },
                'float': {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                'pulse-glow': {
                    '0%, 100%': { opacity: '1', boxShadow: '0 0 10px #DA251D' },
                    '50%': { opacity: '0.7', boxShadow: '0 0 20px #DA251D' },
                },
                'text-shimmer': {
                    '0%': { backgroundPosition: '0% 50%' },
                    '100%': { backgroundPosition: '200% 50%' },
                },
                'slide-right': {
                    '0%': { transform: 'translateX(-100%)' },
                    '100%': { transform: 'translateX(300%)' },
                },
            },
            animation: {
                'spin-slow': 'spin 60s linear infinite',
                'blob': 'blob 7s infinite',
                'grid-move': 'grid-move 2s linear infinite',
                'float': 'float 3s ease-in-out infinite',
                'pulse-glow': 'pulse-glow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'text-shimmer': 'text-shimmer 2.5s linear infinite',
                'slide-right': 'slide-right linear infinite',
            },
        },
    },

    plugins: [forms],
};
