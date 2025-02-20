import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/core.css',
                'resources/js/core.js',
                'resources/css/bootstrap-datepicker.min.css',
                'resources/fonts/iconfont.css',
                'resources/css/style.css',
                'resources/vendors/chartjs/Chart.min.js',
                'resources/vendors/jquery.flot/jquery.flot.js',
                'resources/vendors/jquery.flot/jquery.flot.resize.js',
                'resources/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js',
                'resources/vendors/apexcharts/apexcharts.min.js',
                'resources/vendors/feather-icons/feather.min.js',
                'resources/js/template.js',
                'resources/js/dashboard-light.js',
                'resources/js/datepicker.js'
            ],
            refresh: true,
        }),
    ],
});