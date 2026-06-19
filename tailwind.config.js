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
          DEFAULT: '#006F5C',
          dark: '#005547',
          light: '#EEF7F4',
        },
        secondary: {
          DEFAULT: '#CC205C',
          dark: '#A61A4B',
          light: '#FDF2F5',
        },
        accent: {
          orange: '#FF8A00',
        },
        neutral: {
          dark: '#111827',
          medium: '#374151',
          light: '#6B7280',
          bg: '#F4FAF8',
        }
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      borderRadius: {
        'lg': '16px',
        'xl': '24px',
      }
    },
  },
  plugins: [],
}
