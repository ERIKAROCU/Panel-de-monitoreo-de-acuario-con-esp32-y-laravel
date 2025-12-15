<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'AcuarioSmart') }}</title>

    {{-- Fonts y Vite --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Video background --}}
    <style>
        video.bg-video {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
    </style>
</head>

<body class="antialiased font-sans text-white">

    {{-- 🎬 VIDEO --}}
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/fondo.mp4') }}" type="video/mp4">
    </video>

    {{-- Overlay suave para legibilidad --}}
    <div class="fixed inset-0 bg-black/50 z-[-1]"></div>

    <div class="relative min-h-screen flex flex-col">

        {{-- 🧭 HEADER --}}
        <header class="w-full px-6 py-6 flex items-center justify-between max-w-7xl mx-auto">
            
            {{-- Logo / Nombre --}}
            <div class="text-lg font-extrabold tracking-wide">
                {{ config('app.name', 'AcuarioSmart') }}
            </div>

            {{-- Navegación --}}
            @if (Route::has('login'))
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-5 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20
                                  hover:bg-white/20 transition font-semibold text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20
                                  hover:bg-white/20 transition text-sm font-semibold">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="hidden sm:inline-block px-4 py-2 rounded-full bg-indigo-600
                                      hover:bg-indigo-500 transition text-sm font-semibold shadow-lg">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </header>

        {{-- 🌟 CONTENIDO CENTRAL --}}
        <main class="flex-1 flex items-center justify-center px-6">
            <div class="text-center max-w-2xl">

                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold tracking-tight text-white/80">
                    Bienvenido a
                </h3>

                <h1 class="mt-2 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight">
                    AcuarioSmart
                </h1>


                <p class="mt-5 text-base sm:text-lg text-white/80">
                    Sistema de predicción inteligente para monitoreo de variables ambientales en tiempo real.
                </p>

                {{-- CTA --}}
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="w-full sm:w-auto px-8 py-3 rounded-xl bg-indigo-600
                                  hover:bg-indigo-500 transition font-bold shadow-xl">
                            Ir al Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="w-full sm:w-auto px-8 py-3 rounded-xl bg-indigo-600
                                  hover:bg-indigo-500 transition font-bold shadow-xl">
                            Iniciar sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="w-full sm:w-auto px-8 py-3 rounded-xl bg-white/10
                                      backdrop-blur-md border border-white/20
                                      hover:bg-white/20 transition font-semibold">
                                Crear cuenta
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </main>

        {{-- FOOTER mínimo --}}
        <footer class="text-center text-xs text-white/50 pb-6">
            © {{ date('Y') }} {{ config('app.name') }} · Laravel + Livewire
        </footer>
    </div>

</body>
</html>
