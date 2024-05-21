// vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { copy } from 'vite-plugin-copy';
import path from 'path'; // модуль path

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        copy({
            targets: [
                { src: path.resolve(__dirname, 'resources/css/app.css'), dest: 'public/css' },
                { src: path.resolve(__dirname, 'resources/js/app.js'), dest: 'public/js' },
            ],
        }),
    ],
});
