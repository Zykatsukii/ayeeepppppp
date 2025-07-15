<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Ayaka-style favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyBmaWxsPSIjYmNkOWVhIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZD0iTTEyIDMgTDIgOSA2IDkgNiAxNSAxOCAxNSAxOCA5IDE4IDkgMTIgMTgiLz48L3N2Zz4=" />

    <!-- Elegant font for Ayaka vibes -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4 {
            font-family: 'DM Serif Display', serif;
        }

        .snowflake {
            position: fixed;
            top: -10px;
            color: #ffffffcc;
            font-size: 1rem;
            animation: fall linear infinite;
            z-index: 5;
            pointer-events: none;
        }

        @keyframes fall {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
        }

        .frosted {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
        }

        .ayaka-mode {
            background: linear-gradient(to bottom right, #e0dfff, #d8e9f4, #bcd9ea) !important;
            color: #334155 !important;
        }

        /* Loading Spinner */
        #loadingOverlay {
            background: rgba(255, 255, 255, 0.7);
            z-index: 100;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] min-h-screen antialiased text-gray-800 relative overflow-hidden">

    <!-- ❄️ Snowflakes -->
    @for ($i = 0; $i < 25; $i++)
        <div class="snowflake" style="left: {{ rand(0, 100) }}%; animation-duration: {{ rand(10, 20) }}s; animation-delay: -{{ rand(0, 20) }}s;">
            ❄️
        </div>
    @endfor

    <!-- 🌨️ Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 hidden flex items-center justify-center">
        <div class="animate-spin h-16 w-16 border-4 border-blue-300 border-t-transparent rounded-full"></div>
    </div>

    <!-- 💠 Toggle Ayaka Mode -->
    <button 
        id="ayakaToggleBtn"
        class="fixed top-5 right-5 z-50 bg-white/40 text-sm text-[#334155] px-4 py-2 rounded-lg frosted shadow hover:bg-white/60 transition"
    >
        🌨️ Ayaka Mode
    </button>

    <!-- 🔝 Back to Top Button -->
    <button 
        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 bg-white/40 backdrop-blur-md rounded-full p-3 shadow-lg text-indigo-700 hover:bg-white/60 transition hidden"
        id="backToTopBtn"
    >
        ⬆️
    </button>

    <div class="min-h-screen flex flex-col z-10 relative">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Header -->
        @if (isset($header))
            <header class="frosted shadow-lg py-6 mt-4 mx-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-semibold text-[#333366] tracking-wide drop-shadow-md">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endif

        <!-- Main Content -->
        <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="space-y-8">
                @yield('content')
            </div>
        </main>

        <!-- Footer with Ayaka Quote -->
        @php
            $quotes = [
                "Snow illuminates the land, just as I illuminate my clan.",
                "Grace is not simply given — it is practiced.",
                "Even the frost has warmth when shared with the right people.",
                "I am Kamisato Ayaka, a humble servant of the Shogun.",
            ];
        @endphp

        <footer class="frosted shadow-inner py-4 text-center text-gray-600 text-sm">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.<br>
            <span class="italic text-xs text-blue-900 mt-2 block">“{{ $quotes[array_rand($quotes)] }}”</span>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Ayaka Mode Toggle + Save to LocalStorage
        const toggleBtn = document.getElementById('ayakaToggleBtn');
        const body = document.body;
        const MODE_KEY = 'ayaka_mode';

        // Apply saved mode
        if (localStorage.getItem(MODE_KEY) === 'on') {
            body.classList.add('ayaka-mode');
        }

        toggleBtn.addEventListener('click', () => {
            const isOn = body.classList.toggle('ayaka-mode');
            localStorage.setItem(MODE_KEY, isOn ? 'on' : 'off');
        });

        // Show loading spinner on page unload
        window.addEventListener('beforeunload', () => {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        });

        // Back to top visibility
        const backToTop = document.getElementById('backToTopBtn');
        window.addEventListener('scroll', () => {
            backToTop.classList.toggle('hidden', window.scrollY < 200);
        });
    </script>
</body>
</html>
