/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
      ],
    theme: {
    extend: {
      colors: {
        'primary': '#41454F',
        'secondary': '#f19620',
      },
    },
    },
    prefix: 'tw-',
    plugins: [],
    }