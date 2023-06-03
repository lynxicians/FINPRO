import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import sass from 'sass';


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: ['resources/views/**'],
        }),
    ],
    css: {
        preprocessorOptions: {
          scss: {
            implementation: sass,
          },
        },
      },
    // resolve: {
    //     alias: {
    //         '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap')
    //     }
    // },
});
