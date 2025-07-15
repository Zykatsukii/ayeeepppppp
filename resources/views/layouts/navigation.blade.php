<nav x-data="{ open: false }" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] border-r border-blue-300 shadow-lg flex flex-col">

    <!-- Desktop Sidebar Content -->
    <div class="flex flex-col h-full">

        <!-- Logo / Title -->
        <div class="flex items-center justify-center h-16 border-b border-blue-300 flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-blue-900 hover:text-teal-600 font-semibold text-xl tracking-wider select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linejoin="round" stroke-linecap="round">
                    <path d="M12 2C13.1046 2 14 2.89543 14 4C14 5.10457 13.1046 6 12 6C10.8954 6 10 5.10457 10 4C10 2.89543 10.8954 2 12 2Z" />
                    <path d="M19 10C20.1046 10 21 10.8954 21 12C21 13.1046 20.1046 14 19 14C17.8954 14 17 13.1046 17 12C17 10.8954 17.8954 10 19 10Z" />
                    <path d="M5 10C6.10457 10 7 10.8954 7 12C7 13.1046 6.10457 14 5 14C3.89543 14 3 13.1046 3 12C3 10.8954 3.89543 10 5 10Z" />
                    <path d="M12 18C13.1046 18 14 18.8954 14 20C14 21.1046 13.1046 22 12 22C10.8954 22 10 21.1046 10 20C10 18.8954 10.8954 18 12 18Z" />
                    <circle cx="12" cy="12" r="2" />
                </svg>
                <span>Ayaka</span>
            </a>
        </div>

        <!-- Nav Links -->
        <div class="flex-grow overflow-y-auto mt-4 px-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition
                       {{ request()->routeIs('dashboard') ? 'bg-white/70 font-semibold shadow-md' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linejoin="round" stroke-linecap="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('bookings.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition
                       {{ request()->routeIs('bookings.index') ? 'bg-white/70 font-semibold shadow-md' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M8 7V3m0 0H5m3 0h3m3 0h3m-3 0v4m0 0h3m-3 0v14a2 2 0 002 2h-4a2 2 0 01-2-2V7m0 0H5a2 2 0 00-2 2v12a2 2 0 002 2h14" />
                        </svg>
                        Booking
                    </a>
                </li>
            </ul>
        </div>

        <!-- Profile Section -->
        <div class="border-t border-blue-300 p-4 flex flex-col">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-200 rounded-full w-10 h-10 flex items-center justify-center text-blue-800 font-semibold uppercase select-none">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-blue-900 font-semibold select-none">{{ Auth::user()->name }}</p>
                    <a href="{{ route('profile.edit') }}" class="text-teal-600 hover:underline text-sm select-none">Profile</a>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-md bg-teal-600 text-white font-semibold hover:bg-teal-700 transition">Log Out</button>
            </form>
        </div>
    </div>

    <!-- Mobile sidebar toggle button -->
    <button
        @click="open = !open"
        class="fixed top-4 left-4 z-50 inline-flex items-center justify-center p-2 rounded-md text-blue-900 bg-white/90 shadow-lg hover:bg-white/100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:hidden"
        aria-label="Toggle sidebar"
    >
        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Mobile Sidebar Overlay -->
    <div
        x-show="open"
        @click="open = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 sm:hidden"
        style="display:none;"
    ></div>

    <!-- Mobile Sidebar Content -->
    <aside
        x-show="open"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] border-r border-blue-300 shadow-lg flex flex-col sm:hidden"
        style="display:none;"
        @click.away="open = false"
    >
        <!-- Repeat same content as desktop sidebar for mobile -->

        <div class="flex items-center justify-center h-16 border-b border-blue-300 flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-blue-900 hover:text-teal-600 font-semibold text-xl tracking-wider select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linejoin="round" stroke-linecap="round">
                    <path d="M12 2C13.1046 2 14 2.89543 14 4C14 5.10457 13.1046 6 12 6C10.8954 6 10 5.10457 10 4C10 2.89543 10.8954 2 12 2Z" />
                    <path d="M19 10C20.1046 10 21 10.8954 21 12C21 13.1046 20.1046 14 19 14C17.8954 14 17 13.1046 17 12C17 10.8954 17.8954 10 19 10Z" />
                    <path d="M5 10C6.10457 10 7 10.8954 7 12C7 13.1046 6.10457 14 5 14C3.89543 14 3 13.1046 3 12C3 10.8954 3.89543 10 5 10Z" />
                    <path d="M12 18C13.1046 18 14 18.8954 14 20C14 21.1046 13.1046 22 12 22C10.8954 22 10 21.1046 10 20C10 18.8954 10.8954 18 12 18Z" />
                    <circle cx="12" cy="12" r="2" />
                </svg>
                <span>Ayaka</span>
            </a>
        </div>

        <div class="flex-grow overflow-y-auto mt-4 px-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition
                       {{ request()->routeIs('dashboard') ? 'bg-white/70 font-semibold shadow-md' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linejoin="round" stroke-linecap="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('bookings.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-blue-900 hover:text-teal-600 hover:bg-white/50 transition
                       {{ request()->routeIs('bookings.index') ? 'bg-white/70 font-semibold shadow-md' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M8 7V3m0 0H5m3 0h3m3 0h3m-3 0v4m0 0h3m-3 0v14a2 2 0 002 2h-4a2 2 0 01-2-2V7m0 0H5a2 2 0 00-2 2v12a2 2 0 002 2h14" />
                        </svg>
                        Booking
                    </a>
                </li>
            </ul>
        </div>

        <div class="border-t border-blue-300 p-4 flex flex-col">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-200 rounded-full w-10 h-10 flex items-center justify-center text-blue-800 font-semibold uppercase select-none">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-blue-900 font-semibold select-none">{{ Auth::user()->name }}</p>
                    <a href="{{ route('profile.edit') }}" class="text-teal-600 hover:underline text-sm select-none">Profile</a>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-md bg-teal-600 text-white font-semibold hover:bg-teal-700 transition">Log Out</button>
            </form>
        </div>
    </aside>
</nav>
