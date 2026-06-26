/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {
      colors: {
        'navy': '#002B6A',
        'navy-50': 'rgba(0, 43, 106, 0.05)',
        'navy-900': '#001d49',
        'teal-50': '#e6f6f5',
        'teal-600': '#009999',
        'teal': '#00B3B3',
        'ink': '#2D2D2D',
        'muted': '#6B6560',
        'line': '#E5E7EB',
        'light-blue': '#8BC53F',
        'red': '#DC2626',
        'orange-pas': '#EB891B',
      }
    },
  },
  plugins: [],
}
