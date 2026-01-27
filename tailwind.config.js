import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        brand: {
          green: '#0F6B4A',
          yellow: '#FFC24A',
          color: "#1f2937" ,
          green: '#10B981', // Exemple : vert émeraude yellow: '#FACC15',
        },
      },
    },
  },

  plugins: [forms],
};
