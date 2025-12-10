<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Título de la aplicación --}}
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts y Vite (Tailwind) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ✨ ESTILOS DEL VIDEO DE FONDO --}}
    <style>
        /* 🔹 Asegura que el video cubra toda la pantalla */
        video.bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* similar a background-size: cover */
            z-index: -1; /* lo pone detrás del contenido */
        }
    </style>
</head>

{{-- MODIFICADO: Se mantiene text-white para que el texto de navegación sea visible --}}
<body class="antialiased font-sans text-white">
    
    {{-- 🎬 VIDEO DE FONDO MANTENIDO --}}
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/fondo.mp4') }}" type="video/mp4">
    </video>

    {{-- 📦 Contenedor principal centrado, sin estilos de fondo estáticos --}}
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            
            {{-- 🧭 NAVEGACIÓN DE LOGIN/REGISTER (MANTENIDA) --}}
            <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                
                {{-- Espacio para el logo (vacío) --}}
                <div class="flex lg:justify-center lg:col-start-2">
                    {{-- Puedes colocar aquí un <img> o <svg> de tu propio logo si lo deseas --}}
                </div>

                @if (Route::has('login'))
                    {{-- Este div contiene los botones de Log in / Register --}}
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 lg:col-start-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="font-semibold text-gray-200 hover:text-white">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-200 hover:text-white">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ms-4 font-semibold text-gray-200 hover:text-white">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </header>

            {{-- ZONA DE CONTENIDO CENTRAL (ELIMINADA) --}}
            <main class="mt-6">
                {{-- Aquí puedes añadir tu propio contenido minimalista --}}
                <div class="text-center pt-20">
                    <h1 class="text-6xl font-extrabold tracking-tight">¡Bienvenid@!</h1>
                    <p class="mt-4 text-xl text-white/80">Comienza a navegar por nuestro proyecto.</p>
                </div>
            </main>

            {{-- FOOTER (ELIMINADO) --}}
            
        </div>
    </div>
</body>
</html>