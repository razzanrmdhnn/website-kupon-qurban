<x-admin-layout>
    <x-slot name="header">Dashboard</x-slot>
    <x-slot name="title">Dashboard</x-slot>

    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl shadow-lg p-6 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-green-100">Panel Admin Qurban Masjid Al-Abror - Kelola data qurban dengan mudah</p>
            </div>
            <div class="hidden md:block">
                <svg class="w-24 h-24 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C12 2 8 6 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10C16 6 12 2 12 2ZM12 12C10.9 12 10 11.1 10 10C10 8.14 11.03 6.36 12 5.04C12.97 6.36 14 8.14 14 10C14 11.1 13.1 12 12 12Z" />
                    <path
                        d="M4 22V14H6V22H4ZM18 22V14H20V22H18ZM2 14H22V16H2V14ZM7 22V18H9V22H7ZM15 22V18H17V22H15ZM11 22V17H13V22H11Z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Kupon -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-green-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Kupon</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>

        <!-- Total Peserta -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-green-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Peserta</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>

        <!-- Total Hewan -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-green-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-amber-100 rounded-lg">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Hewan</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>

        <!-- Kupon Ditukar -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-green-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-emerald-100 rounded-lg">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Kupon Ditukar</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-green-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="#"
                    class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors group">
                    <div class="p-3 bg-green-500 rounded-full mb-2 group-hover:bg-green-600 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Tambah Kupon</span>
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors group">
                    <div class="p-3 bg-blue-500 rounded-full mb-2 group-hover:bg-blue-600 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Tambah Peserta</span>
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center p-4 bg-amber-50 rounded-lg hover:bg-amber-100 transition-colors group">
                    <div class="p-3 bg-amber-500 rounded-full mb-2 group-hover:bg-amber-600 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Tambah Hewan</span>
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors group">
                    <div class="p-3 bg-purple-500 rounded-full mb-2 group-hover:bg-purple-600 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Lihat Laporan</span>
                </a>
            </div>
        </div>

        <!-- Info Qurban -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-green-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Qurban</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm text-gray-600">Tahun Qurban</span>
                    <span class="font-semibold text-gray-800">1447 H / {{ date('Y') }} M</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm text-gray-600">Status Pendaftaran</span>
                    <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">Dibuka</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm text-gray-600">Tanggal Pelaksanaan</span>
                    <span class="font-semibold text-gray-800">10 Dzulhijjah 1447 H</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-sm text-gray-600">Lokasi</span>
                    <span class="font-semibold text-gray-800">Masjid Al-Abror</span>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
