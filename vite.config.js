import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // --- ¡ESTA ES LA SOLUCIÓN! ---
    // Le decimos a VITE que escuche y reporte
    // ESTA IP específica.
    server: {
        // host: '192.168.31.210', // <-- ¡TU IP DE RED AQUÍ!
        host: '192.168.61.63',
        port: 5173,
    }
});