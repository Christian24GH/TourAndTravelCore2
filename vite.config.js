import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    /*
    server: {
        host: 'YOUR_STATIC_IP_ADDRESS', // your machine's IP.
        port: 5173,
        strictPort: true,
        cors: {
        origin: 'http://YOUR_STATIC_IP_ADDRESS', // or '*' for testing, safer to specify exact
        methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
        allowedHeaders: ['Content-Type', 'Authorization'],
        },
    },*/
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
