/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Warna merah resmi Telkom Sukabumi
        'telkom-red': '#E12026',
        'telkom-dark': '#B81419',
      }
    },
  },
  plugins: [],
}