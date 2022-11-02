/** @type {import('tailwindcss').Config} */ 
module.exports = {
    content: ["./src/**/*.{html,js}"],
    theme: {
      extend: {
        scale: {
            '115': '1.15'
          }
      },
    },
    plugins: [],
    darkMode: 'class',
  }