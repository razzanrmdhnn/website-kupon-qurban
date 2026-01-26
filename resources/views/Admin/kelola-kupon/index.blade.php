<x-admin-layout>
    <x-slot name="header">Kelola Kupon</x-slot>
    <x-slot name="title">Kelola Kupon</x-slot>

    <style>
        .qr-container svg {
            width: 160px;
            height: 160px;
        }

        #qrCodeContainer svg {
            width: 192px;
            height: 192px;
        }
    </style>

    <!-- Success Notification -->
    @if (session('success'))
        <div id="successNotification" class="fixed top-4 right-4 z-50">
            <div class="bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Error Notification -->
    @if ($errors->any())
        <div id="errorNotification" class="fixed top-4 right-4 z-50">
            <div class="bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl shadow-lg p-6 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Kelola Kupon Qurban 🎫</h2>
                <p class="text-green-100">Generate dan kelola kupon qurban</p>
            </div>
            <button onclick="openModal()"
                class="flex items-center gap-2 bg-white text-green-600 px-5 py-3 rounded-xl font-semibold hover:bg-green-50 transition-colors shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Kupon
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
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
                    <p class="text-2xl font-bold text-gray-800">{{ $totalKupon }}</p>
                </div>
            </div>
        </div>

        <!-- Kupon Tersedia -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-green-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Kupon Tersedia</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $kuponTersedia }}</p>
                </div>
            </div>
        </div>

        <!-- Kupon Terpakai -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-green-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-amber-100 rounded-lg">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Kupon Terpakai</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $kuponTerpakai }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6 border border-green-100">
        <form method="GET" action="{{ route('kelola-kupon.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <!-- Search -->
                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari Nama
                    </label>
                    <div class="relative">
                        <input type="text" name="search" placeholder="Ketik nama untuk mencari..."
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Filter RT -->
                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        RT
                    </label>
                    <div class="relative">
                        <select name="rt"
                            class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all appearance-none bg-white">
                            <option value="">Semua RT</option>
                            <option value="1" {{ request('rt') == '1' ? 'selected' : '' }}>RT 01</option>
                            <option value="2" {{ request('rt') == '2' ? 'selected' : '' }}>RT 02</option>
                            <option value="3" {{ request('rt') == '3' ? 'selected' : '' }}>RT 03</option>
                            <option value="4" {{ request('rt') == '4' ? 'selected' : '' }}>RT 04</option>
                            <option value="5" {{ request('rt') == '5' ? 'selected' : '' }}>RT 05</option>
                        </select>
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Filter Status -->
                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status
                    </label>
                    <div class="relative">
                        <select name="status"
                            class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all appearance-none bg-white">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia
                            </option>
                            <option value="terpakai" {{ request('status') == 'terpakai' ? 'selected' : '' }}>Terpakai
                            </option>
                        </select>
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="md:col-span-2 flex flex-col justify-end">
                    <label class="block text-sm font-medium text-gray-700 mb-2 opacity-0 select-none">Aksi</label>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 bg-green-500 text-white px-4 py-2.5 rounded-lg hover:bg-green-600 transition-all shadow-sm hover:shadow-md font-medium"
                            title="Terapkan Filter">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span class="hidden lg:inline">Filter</span>
                        </button>
                        @if (request()->hasAny(['search', 'rt', 'status']))
                            <a href="{{ route('kelola-kupon.index') }}"
                                class="flex items-center justify-center gap-2 bg-gray-500 text-white px-4 py-2.5 rounded-lg hover:bg-gray-600 transition-all shadow-sm hover:shadow-md font-medium"
                                title="Reset Filter">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Active Filters Display -->
            @if (request()->hasAny(['search', 'rt', 'status']))
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm font-medium text-gray-600">Filter Aktif:</span>
                        @if (request('search'))
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Nama: "{{ request('search') }}"
                            </span>
                        @endif
                        @if (request('rt'))
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                RT {{ str_pad(request('rt'), 2, '0', STR_PAD_LEFT) }}
                            </span>
                        @endif
                        @if (request('status'))
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ ucfirst(request('status')) }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </form>
    </div>

    <!-- Kupon Table -->
    <div class="bg-white rounded-xl shadow-md border border-green-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">No</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Kode Kupon</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">RT</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">QR Code</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Dibuat</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($kupons as $index => $kupon)
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $kupons->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="font-mono text-sm bg-gray-100 px-3 py-1 rounded-lg text-gray-800">{{ $kupon->kode_unik }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $kupon->nama }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">{{ $kupon->formatted_rt }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <button onclick="showQrCode({{ $kupon->id }}, '{{ $kupon->kode_unik }}')"
                                    class="p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors"
                                    title="Lihat QR Code">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                    </svg>
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                @if ($kupon->status === 'tersedia')
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Tersedia</span>
                                @else
                                    <span
                                        class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-medium">Terpakai</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $kupon->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="showDetail({{ $kupon->id }})"
                                        class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors"
                                        title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button onclick="showDeleteConfirmation({{ $kupon->id }}, '{{ $kupon->kode_unik }}')"
                                        class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors"
                                        title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                    <form id="deleteForm{{ $kupon->id }}" action="{{ route('kelola-kupon.destroy', $kupon) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">Belum ada kupon</p>
                                    <p class="text-gray-400 text-sm">Klik tombol "Tambah Kupon" untuk menambahkan kupon
                                        baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($kupons->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $kupons->withQueryString()->links() }}
            </div>
        @endif
    </div>

    <!-- Hidden Delete Forms -->
    @foreach ($kupons as $kupon)
        <form id="deleteForm{{ $kupon->id }}" action="{{ route('kelola-kupon.destroy', $kupon) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    <!-- Modal Tambah Kupon -->
    <div id="modalTambahKupon" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal()"></div>

        <!-- Modal Content -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-t-2xl px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white">Tambah Kupon Baru</h3>
                        <button onclick="closeModal()" class="text-white hover:text-green-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form id="formTambahKupon" method="POST" action="{{ route('kelola-kupon.store') }}">
                        @csrf
                        <!-- Nama  -->
                        <div class="mb-5">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" id="nama" name="nama" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                    placeholder="Masukkan nama">
                            </div>
                        </div>

                        <!-- RT -->
                        <div class="mb-6">
                            <label for="rt" class="block text-sm font-medium text-gray-700 mb-2">
                                RT <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <select id="rt" name="rt" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors appearance-none bg-white">
                                    <option value="">Pilih RT</option>
                                    <option value="1">RT 01</option>
                                    <option value="2">RT 02</option>
                                    <option value="3">RT 03</option>
                                    <option value="4">RT 04</option>
                                    <option value="5">RT 05</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3">
                            <button type="button" onclick="closeModal()"
                                class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-700 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Generate Kupon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal QR Code -->
    <div id="modalQrCode" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeQrModal()"></div>

        <!-- Modal Content -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm transform transition-all">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-t-2xl px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white">QR Code Kupon</h3>
                        <button onclick="closeQrModal()" class="text-white hover:text-green-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6 flex flex-col items-center">
                    <div id="qrCodeContainer" class="bg-white p-4 rounded-xl border-2 border-gray-200 mb-4">
                        <!-- QR Code will be injected here -->
                    </div>
                    <p id="qrCodeLabel" class="text-lg font-mono font-bold text-gray-800"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Kupon -->
    <div id="modalDetail" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeDetailModal()"></div>

        <!-- Modal Content -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-t-2xl px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white">Detail Kupon</h3>
                        <button onclick="closeDetailModal()"
                            class="text-white hover:text-green-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6" id="detailContent">
                    <!-- Detail will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="modalDeleteConfirmation" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeDeleteModal()"></div>

        <!-- Modal Content -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-t-2xl px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-xl font-bold text-white">Konfirmasi Hapus</h3>
                        </div>
                        <button onclick="closeDeleteModal()" class="text-white hover:text-red-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <div class="flex flex-col items-center text-center mb-6">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Hapus Kupon?</h4>
                        <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus kupon ini?</p>
                        <div class="bg-gray-50 rounded-lg p-3 w-full">
                            <p class="text-sm text-gray-500 mb-1">Kode Kupon</p>
                            <p id="deleteKuponCode" class="font-mono font-bold text-gray-800"></p>
                        </div>
                    </div>

                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 mb-6">
                        <div class="flex gap-2">
                            <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-sm text-amber-800">Tindakan ini tidak dapat dibatalkan. Data kupon akan dihapus secara permanen.</p>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteModal()"
                            class="flex-1 px-4 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all">
                            Batal
                        </button>
                        <button type="button" onclick="confirmDelete()"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:from-red-600 hover:to-red-700 transition-all flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        function openModal() {
            document.getElementById('modalTambahKupon').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalTambahKupon').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('formTambahKupon').reset();
        }

        function showQrCode(kuponId, kodeUnik) {
            fetch(`/kelola-kupon/${kuponId}`)
                .then(response => response.json())
                .then(kupon => {
                    document.getElementById('qrCodeContainer').innerHTML = kupon.qr_code;
                    document.getElementById('qrCodeLabel').textContent = kodeUnik;
                    document.getElementById('modalQrCode').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
        }

        function closeQrModal() {
            document.getElementById('modalQrCode').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function showDetail(kuponId) {
            fetch(`/kelola-kupon/${kuponId}`)
                .then(response => response.json())
                .then(kupon => {
                    const statusClass = kupon.status === 'tersedia' ? 'bg-green-100 text-green-700' :
                        'bg-amber-100 text-amber-700';
                    const statusText = kupon.status === 'tersedia' ? 'Tersedia' : 'Terpakai';

                    document.getElementById('detailContent').innerHTML = `
                        <div class="flex flex-col items-center mb-6">
                            <div class="bg-white p-4 rounded-xl border-2 border-gray-200 mb-4 qr-container">
                                ${kupon.qr_code}
                            </div>
                            <p class="text-xl font-mono font-bold text-gray-800">${kupon.kode_unik}</p>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-500">Nama</span>
                                <span class="font-medium text-gray-800">${kupon.nama}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-500">RT</span>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">RT ${String(kupon.rt).padStart(2, '0')}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-500">Status</span>
                                <span class="${statusClass} px-3 py-1 rounded-full text-xs font-medium">${statusText}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-500">Tanggal Dibuat</span>
                                <span class="text-gray-800">${new Date(kupon.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</span>
                            </div>
                        </div>
                    `;
                    document.getElementById('modalDetail').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
        }

        function closeDetailModal() {
            document.getElementById('modalDetail').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        let deleteKuponId = null;

        function showDeleteConfirmation(kuponId, kodeUnik) {
            deleteKuponId = kuponId;
            document.getElementById('deleteKuponCode').textContent = kodeUnik;
            document.getElementById('modalDeleteConfirmation').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('modalDeleteConfirmation').classList.add('hidden');
            document.body.style.overflow = 'auto';
            deleteKuponId = null;
        }

        function confirmDelete() {
            if (deleteKuponId) {
                document.getElementById('deleteForm' + deleteKuponId).submit();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeQrModal();
                closeDetailModal();
                closeDeleteModal();
            }
        });

        // Auto-hide notifications
        setTimeout(() => {
            const successNotification = document.getElementById('successNotification');
            const errorNotification = document.getElementById('errorNotification');
            if (successNotification) successNotification.style.display = 'none';
            if (errorNotification) errorNotification.style.display = 'none';
        }, 3000);
    </script>
</x-admin-layout>
