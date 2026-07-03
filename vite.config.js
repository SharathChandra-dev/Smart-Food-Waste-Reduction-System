import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/global.css',
                'resources/css/components/header.css',
                'resources/css/components/footer.css',
                'resources/css/Admin/admin.css',
                'resources/css/Admin/layout.css',
                'resources/css/Admin/admin_dashboard.css',
                'resources/css/Admin/fooditems.css',
                'resources/css/Admin/admin_users.css',
                'resources/css/Admin/pending_food.css',
                'resources/css/User/global.css',
                'resources/css/User/foods.css',
                'resources/js/app.js',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
