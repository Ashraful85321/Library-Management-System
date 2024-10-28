
// tailwind.config.js
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/css/**/*.css',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    screens: {
     'sm': '640px',
      // => @media (min-width: 640px) { ... }
     'smPlus': '704px',

      'md': '768px',
      // => @media (min-width: 768px) { ... }
      'mdPlus' : '896px',

      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }
      'lgPlus': '1152px',

      'xl': '1280px',
      // => @media (min-width: 1280px) { ... }
      'xlPlus': '1408px',

      '2xl': '1536px',
      // => @media (min-width: 1536px) { ... }

      'r2xl': {'max': '1535px'},
      // => @media (max-width: 1535px) { ... }
      'rxlPlus': {'max': '1407px'},

      'rxl': {'max': '1279px'},
      // => @media (max-width: 1279px) { ... }
      'rlgPlus': {'max': '1151px'},

      'rlg': {'max': '1023px'},
      // => @media (max-width: 1023px) { ... }
      'rmdPlus': {'max': '895px'},

      'rmd': {'max': '767px'},
      // => @media (max-width: 767px) { ... }
      'rsmPlus': {'max': '703px'},

      'rsm': {'max': '639px'},
      // => @media (max-width: 639px) { ... }
    },
    extend: {
      height: {
        '18': '4.5rem', // 18 * 0.25rem = 4.5rem
      },
      width: {
        '18': '4.5rem',
      },
      backgroundImage: {
        'night-sky': "url('/bg-img/night-sky1.jpg')",
        'book1': "url('/bg-img/book1.avif')",
        'book2': "url('/bg-img/book2.jpg')",
        'book3': "url('/bg-img/book3.jpg')",
        'book4': "url('/bg-img/book4.jpg')",
        'book5': "url('/bg-img/green-book.jpg')",
      },
      boxShadow: {
        'custom-light': '0 2px 4px rgba(0, 0, 0, 0.1)',
        'custom-dark': '0 4px 8px rgba(0, 0, 0, 0.2)',
        'custom-color': '0 4px 8px rgba(34, 197, 94, 0.5)',
      }

    },
    textShadow: {
      'a1': '1px 1px 2px rgba(59, 58, 60, 0.8)',
      'a2':'0px 2px 0px hsla(0, 0%, 100%, 0.15)',
      'sm': '1px 1px 2px rgba(0, 0, 0, 0.25)',
      'md': '2px 2px 4px rgba(0, 0, 0, 0.25)',
      'lg': '3px 3px 6px rgba(0, 0, 0, 0.3)',
      'xl': '4px 4px 8px rgba(0, 0, 0, 0.35)',
      '2xl': '5px 5px 10px rgba(0, 0, 0, 0.4)',
      '3xl': '6px 6px 12px rgba(0, 0, 0, 0.45)',
    },
  },
  plugins: [
    function({ addUtilities, theme, e }) {
      const textShadows = theme('textShadow');

      const utilities = Object.keys(textShadows).map(key => ({
        [`.${e(`text-shadow-${key}`)}`]: { textShadow: textShadows[key] },
      }));

      addUtilities(utilities, ['responsive', 'hover']);
     
    },
  ],
};
