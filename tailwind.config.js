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
        'secondary': '#3D3D3D',
        'third': '#FECF56',
      },
    },
    },
    prefix: 'tw-',
    plugins: [],
    }