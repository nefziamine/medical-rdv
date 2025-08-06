/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#2563eb',
          light: '#3b82f6',
          dark: '#1e40af',
        },
        accent: {
          DEFAULT: '#22c55e',
          light: '#4ade80',
          dark: '#15803d',
        },
      },
      fontFamily: {
        sans: ['Figtree', 'ui-sans-serif', 'system-ui'],
        logo: ['"Pacifico"', 'cursive'],
      },
      boxShadow: {
        'xl-blue': '0 10px 25px -5px #2563eb33, 0 4px 6px -4px #2563eb22',
      },
      backgroundImage: {
        'hero-gradient': 'linear-gradient(135deg, #3b82f6 0%, #22c55e 100%)',
      },
    },
  },
  plugins: [],
} 