const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                transparent: 'transparent',
                'main': '#1e1e2c',          // main-bg
                'side': '#2d2d44',          // sidebar-bg
                'accent': '#33e1ed',        // accent cyan
                'card': {
                    DEFAULT: '#2d2d44',
                    'border': '#383852',
                    'title': {
                        DEFAULT: '#ffffff', // text color
                        'border': '#5e5e8b' // bottom border
                    },
                    'gray': colors.gray,
                },
                'table': {
                    'header': '#1e1e2c',
                    'even': '#2c2c40',
                    'odd': '#383852',
                    'border': '#41415f',
                },
                'alert': {
                    'success': colors.green,
                    'warning': colors.yellow,
                    'danger': colors.red,
                    'info': colors.sky,
                },
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
