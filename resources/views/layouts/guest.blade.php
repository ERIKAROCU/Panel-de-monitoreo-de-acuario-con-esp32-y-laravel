<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ✨ ESTILOS AÑADIDOS PARA EL VIDEO Y EL FONDO TRANSLÚCIDO --}}
    <style>
        /* 🎥 Fondo de video */
        video.bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* 🪟 Fondo translúcido del formulario */
        .bg-form {
            /* Fondo blanco translúcido (0.6 de opacidad) */
            background-color: rgba(255, 255, 255, 0.6); 
            /* Efecto de desenfoque ("vidrio esmerilado") */
            backdrop-filter: blur(6px); 
        }

        /* 🌙 Modo oscuro para el fondo del formulario */
        .dark .bg-form {
            /* Fondo gris oscuro translúcido (0.6 de opacidad) */
            background-color: rgba(31, 41, 55, 0.6); 
        }
    </style>
    {{-- FIN DE ESTILOS AÑADIDOS --}}
</head>

<body class="font-sans text-gray-900 antialiased">
    
    {{-- 🎬 VIDEO DE FONDO AÑADIDO --}}
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/fondo.mp4') }}" type="video/mp4">
        Tu navegador no soporta video HTML5.
    </video>

    {{-- 📦 Contenedor del login --}}
    {{-- Se eliminó bg-gray-100 dark:bg-gray-900 ya que el video es el fondo principal --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        {{-- MODIFICADO: Se reemplazó bg-white dark:bg-gray-800 por la clase .bg-form --}}
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-form shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>