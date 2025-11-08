import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    // --- ¡AÑADE ESTE BLOQUE! ---
    server: {
        host: '0.0.0.0', // Esto fuerza a VITE a escuchar en todas las IPs
        port: 5173,      // El puerto por defecto
    }
});
