import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // da togliere
    server: {
        host: "0.0.0.0",
        port: 5173,
        watch: {
            usePolling: true,
        },
        hmr: {
            host: "192.168.1.101", // L'indirizzo IP del server Docker visibile al browser
            port: 5173,
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
