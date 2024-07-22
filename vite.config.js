import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Swal from 'sweetalert2';
import DataTable from 'datatables.net-dt';

export default defineConfig({
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
