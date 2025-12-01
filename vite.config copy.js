import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    /* server: {
        host: '172.20.125.59',
        port: 5173,
    } */

    server: {
        host: '0.0.0.0', // <--- CAMBIA ESTO (Es más seguro y flexible)
        port: 5173,
        hmr: {
            host: '172.20.125.59' // <--- AQUÍ SÍ pon tu IP fija para que el celular sepa dónde buscar los estilos
        }
    }
});