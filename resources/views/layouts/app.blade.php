<!DOCTYPE html>
<!-- 1. Añadir class="" -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- 2. SCRIPT ANTI-PARPADEO -->
        <script>
            // Revisa localStorage o la preferencia del sistema y aplica la clase 'dark' al <html>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
        <!-- FIN SCRIPT -->
    </head>
    <body class="font-sans antialiased">
        <!-- 3. Añadir dark:bg-gray-900 -->
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- +++ INICIO: SCRIPT DE CORRECCIÓN PARA wire:navigate +++ -->
        <!--
            Este script escucha el evento 'livewire:navigated', que se dispara
            cada vez que Livewire termina de cargar una página nueva vía SPA.
            Vuelve a ejecutar la misma lógica del <head> para asegurar que
            la clase 'dark' se mantenga en la etiqueta <html>.
        -->
        <script data-navigate-once>
            document.addEventListener('livewire:navigated', () => {
                if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            });
        </script>
        <!-- +++ FIN DEL SCRIPT +++ -->
    </body>
</html>
