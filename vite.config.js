import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/card-effects.js',
                'resources/js/sweetalert.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        // Habilitar minificación
        minify: 'terser',
        // Configuración de Terser para una mejor optimización
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true
            }
        },
        // Dividir el código en chunks más pequeños
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['alpinejs', '@alpinejs/focus'],
                }
            }
        },
        // Habilitar el cache busting
        manifest: true,
        // Comprimir assets
        assetsInlineLimit: 4096
    },
    // Optimizaciones de desarrollo
    server: {
        hmr: {
            overlay: true
        },
        // Habilitar compresión
        compress: true
    }
})
