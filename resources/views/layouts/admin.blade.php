<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} - Admin Qurban Masjid Al-Abror</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gradient-to-br from-green-50 via-green-100/50 to-emerald-50">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-600/75 lg:hidden"
            @click="sidebarOpen = false">
        </div>

        <!-- Sidebar - Fixed on desktop -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-green-600 to-emerald-700 transform transition-transform duration-300 ease-in-out lg:translate-x-0 overflow-y-auto">

            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-green-700/50 sticky top-0 z-10">
                <div class="flex items-center space-x-2 px-4">
                    <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 bg-white/20 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C12 2 8 6 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10C16 6 12 2 12 2ZM12 12C10.9 12 10 11.1 10 10C10 8.14 11.03 6.36 12 5.04C12.97 6.36 14 8.14 14 10C14 11.1 13.1 12 12 12Z" />
                            <path
                                d="M4 22V14H6V22H4ZM18 22V14H20V22H18ZM2 14H22V16H2V14ZM7 22V18H9V22H7ZM15 22V18H17V22H15ZM11 22V17H13V22H11Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white font-bold text-sm leading-tight">Sistem Manajemen Kupon</h2>
                        <p class="text-green-200 text-xs">Panitia Qurban Masjid Al-Abror</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="px-4 py-6">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Tambah Kupon -->
                    <a href="#"
                        class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-white/10">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="font-medium">Tambah Kupon</span>
                    </a>

                    <!-- Scan Kupon -->
                    <a href="#"
                        class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-white/10">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        <span class="font-medium">Scan Kupon</span>
                    </a>

                    <!-- Daftar Kupon Tersedia -->
                    <a href="#"
                        class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-white/10">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <span class="font-medium">Kupon Tersedia</span>
                    </a>

                    <!-- Daftar Kupon Terpakai -->
                    <a href="#"
                        class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-white/10">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">Kupon Terpakai</span>
                    </a>

                    <!-- Manajemen Admin (Super Admin Only) -->
                    @if (auth()->user()->role === 'super_admin')
                        <a href="{{ route('manajemen-admin.index') }}"
                            class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('manajemen-admin.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="font-medium">Manajemen Admin</span>
                        </a>
                    @endif
                </div>

                <!-- Divider -->
                <div class="my-6 border-t border-white/20"></div>

                <!-- Settings Section -->
                <div class="space-y-1">
                    <p class="px-4 text-xs font-semibold text-green-200 uppercase tracking-wider mb-2">Pengaturan</p>

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-white/10">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">Profil</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 hover:bg-red-500/20">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="lg:pl-64 flex flex-col min-h-screen">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-sm shadow-sm border-b border-green-100 sticky top-0 z-30">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <!-- Mobile Menu Button -->
                    <button @click="sidebarOpen = true"
                        class="lg:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <div class="flex-1 lg:flex-none">
                        <h1 class="text-xl font-semibold text-gray-800">{{ $header ?? 'Dashboard' }}</h1>
                    </div>

                    <!-- User Info -->
                    <div class="flex items-center space-x-4">
                        <div class="hidden sm:flex items-center space-x-3">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                                <span
                                    class="text-white font-semibold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white/50 border-t border-green-100 py-4 px-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Masjid Al-Abror. Sistem Manajemen Qurban.
            </footer>
        </div>
    </div>
</body>

</html>
