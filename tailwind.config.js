/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        'putih-purple': '#726274', 
        'abang': '#5D5C5C',
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

