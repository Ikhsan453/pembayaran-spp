import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',  // Sesuaikan dengan file yang digunakan
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
