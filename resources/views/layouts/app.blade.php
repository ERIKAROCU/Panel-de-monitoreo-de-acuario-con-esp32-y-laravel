<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AcuarioSmart') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            // Revisa localStorage o la preferencia del sistema y aplica la clase 'dark' al <html>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
        </head>
    
    {{-- MODIFICADO: Se añade 'relative min-h-screen' para el video de fondo --}}
    <body class="font-sans antialiased relative min-h-screen">
        
        {{-- 🎥 INICIO: FONDO DE VIDEO CONDICIONAL (AÑADIDO) --}}
        {{-- 🔹 Fondo global (solo visible en rutas 'dashboard') --}}
        {{-- 🎥 INICIO: FONDO DE VIDEO CONDICIONAL (CORREGIDO) --}}
{{-- 🔹 Fondo global (solo visible en rutas 'dashboard' O 'prediccion') --}}
{{-- 🎥 INICIO: FONDO DE VIDEO CONDICIONAL (CORREGIDO) --}}
{{-- 🔹 Fondo global (solo visible en rutas 'dashboard' O 'prediccion') --}}
@if (request()->is('dashboard*') || request()->is('prediccion*'))
    <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden">
        <video autoplay muted loop playsinline 
            preload="auto"
            class="w-full h-full object-cover"
            style="transform: translate3d(0, 0, 0);">
            <source src="{{ asset('videos/ac.mp4') }}" type="video/webm">
        </video>
    </div>
@endif


        {{-- MODIFICADO: Contenedor principal para manejar la visibilidad del video --}}
        {{-- Si hay video, el fondo es transparente. Si no lo hay, usamos el fondo gris/oscuro por defecto. --}}
<div class="relative z-10 min-h-screen @if (!request()->is('dashboard*') && !request()->is('prediccion*')) bg-gray-100 dark:bg-gray-900 @else bg-transparent @endif">            
            @include('layouts.navigation')

            @if (isset($header))
                {{-- MODIFICADO: Fondo semitransparente con desenfoque --}}
                <header class="bg-white/80 dark:bg-gray-800/80 shadow backdrop-blur-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- MODIFICADO: Contenido principal sin fondo y con margen/padding ligero --}}
            <main class="bg-transparent mx-auto my-4 p-1 max-w-7xl">
                {{ $slot }}
            </main>
        </div>

        <script data-navigate-once>
            document.addEventListener('livewire:navigated', () => {
                if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            });
        </script>
        </body>
</html>