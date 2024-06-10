import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: false,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/images/avatars/avatar.jpg',
                    dest: 'images/avatars'
                },
                // {
                //     src: 'resources/fonts/inter/*',
                //     dest: 'fonts/inter'
                // },
                // {
                //     src: 'resources/fonts/fontawesome/*',
                //     dest: 'fonts/fontawesome'
                // },
                // {
                //     src: 'resources/fonts/simple-line-icons/*',
                //     dest: 'fonts/simple-line-icons'
                // }
            ]
        })
    ],
});
