<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        {{-- load feather icons throug a link js and all files --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css">
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js"></script> 

       
        
        <!-- Styles -->

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/css/core.css', 'resources/js/core.js'])
        @vite(['resources/css/bootstrap-datepicker.min.css'])
        @vite(['resources/fonts/iconfont.css'])
        @vite(['resources/css/style.css'])

        <!-- Plugin js for this page -->
        @vite([
            'resources/vendors/chartjs/Chart.min.js',
            'resources/vendors/jquery.flot/jquery.flot.js',
            'resources/vendors/jquery.flot/jquery.flot.resize.js',
            'resources/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js',
            'resources/vendors/apexcharts/apexcharts.min.js',
            'resources/vendors/feather-icons/feather.min.js',
            'resources/js/template.js',
            'resources/js/dashboard-light.js',
            'resources/js/datepicker.js'
        ])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="flex h-screen bg-gray-100"> 
            <!-- Sidebar -->
            <livewire:navigation-menu/> 

            <!-- Main Content Area -->
            <main class="page-content p-5 w-full ">
                {{ $slot }}
 
           
               
            </main>
            
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                feather.replace();

            });
        </script>
    </body>
</html>