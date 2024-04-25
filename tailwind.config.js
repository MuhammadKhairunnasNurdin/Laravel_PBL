/** @type {import('tailwindcss').Config} */
// export default
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

