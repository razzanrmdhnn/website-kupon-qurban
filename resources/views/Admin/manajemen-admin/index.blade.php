<x-admin-layout>
    <x-slot name="header">Manajemen Admin</x-slot>
    <x-slot name="title">Manajemen Admin</x-slot>

    <!-- Alert Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Administrator</h2>
            <p class="text-gray-600 mt-1">Kelola akun administrator</p>
        </div>
        <button onclick="openModal('create')"
            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Tambah Admin
        </button>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-green-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Username
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Role
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Terdaftar
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($admins as $index => $admin)
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-white font-semibold text-sm">{{ strtoupper(substr($admin->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $admin->name }}
                                            @if ($admin->id === auth()->id())
                                                <span
                                                    class="ml-2 px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $admin->username }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($admin->role === 'super_admin')
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-white bg-gradient-to-r from-purple-500 to-purple-600 rounded-full shadow-sm">Super
                                        Admin</span>
                                @else
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">Admin</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $admin->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex items-center justify-center space-x-2">
                                    @if ($admin->role !== 'super_admin')
                                        <button onclick="openModal('edit', {{ $admin->id }})"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                    @endif
                                    @if ($admin->id !== auth()->id())
                                        <form action="{{ route('manajemen-admin.destroy', $admin) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="mt-4 text-sm text-gray-500">Belum ada data administrator</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Stats Card -->
    <div class="mt-6 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl shadow-md p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm">Total Administrator</p>
                <p class="text-3xl font-bold mt-1">{{ $admins->count() }}</p>
            </div>
            <div class="bg-white/20 rounded-full p-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="formModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div id="modalHeader"
                class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4 sticky top-0 flex items-center justify-between">
                <div>
                    <h3 id="modalTitle" class="text-xl font-semibold text-white">Form Tambah Administrator</h3>
                    <p id="modalSubtitle" class="text-green-100 text-sm mt-1">Lengkapi informasi untuk menambahkan
                        admin baru</p>
                </div>
                <button onclick="closeModal()" class="text-white hover:text-green-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="adminForm" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" id="formMethod" name="_method" value="">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                placeholder="Masukkan nama lengkap">
                            <span class="text-red-600 text-sm mt-1 hidden" id="nameError"></span>
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="username" id="username" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                placeholder="Masukkan username">
                            <span class="text-red-600 text-sm mt-1 hidden" id="usernameError"></span>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password" id="password" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                placeholder="Masukkan password">
                            <span class="text-red-600 text-sm mt-1 hidden" id="passwordError"></span>
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div id="infoBox" class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="h-5 w-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700 font-medium" id="infoBoxTitle">Informasi Password</p>
                                <p class="text-sm text-blue-600 mt-1" id="infoBoxText">Password harus minimal 8
                                    karakter</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 border-t border-gray-200 pt-6">
                        <button type="button" onclick="closeModal()"
                            class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200 font-medium"
                            id="submitBtn">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Simpan Admin
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentModalMode = 'create';
        let adminData = {
            @foreach ($admins as $admin)
                {{ $admin->id }}: {
                    id: {{ $admin->id }},
                    name: '{{ addslashes($admin->name) }}',
                    username: '{{ addslashes($admin->username) }}',
                },
            @endforeach
        };

        function openModal(mode, adminId = null) {
            currentModalMode = mode;
            const modal = document.getElementById('formModal');
            const form = document.getElementById('adminForm');
            const modalHeader = document.getElementById('modalHeader');
            const submitBtn = document.getElementById('submitBtn');

            // Reset form
            form.reset();
            document.querySelectorAll('[id$="Error"]').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });

            if (mode === 'create') {
                document.getElementById('modalTitle').textContent = 'Form Tambah Administrator';
                document.getElementById('modalSubtitle').textContent = 'Lengkapi informasi untuk menambahkan admin baru';
                modalHeader.className =
                    'bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4 sticky top-0 flex items-center justify-between';
                submitBtn.innerHTML =
                    '<span class="flex items-center"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>Simpan Admin</span>';
                document.getElementById('infoBoxTitle').textContent = 'Informasi Password';
                document.getElementById('infoBoxText').textContent = 'Password harus minimal 8 karakter';

                document.getElementById('password').required = true;
                document.getElementById('password_confirmation').required = true;
                document.getElementById('password').placeholder = 'Masukkan password';

                form.action = '{{ route('manajemen-admin.store') }}';
                document.getElementById('formMethod').value = '';
            } else if (mode === 'edit' && adminId) {
                const admin = adminData[adminId];
                document.getElementById('modalTitle').textContent = 'Form Edit Administrator';
                document.getElementById('modalSubtitle').textContent = 'Perbarui informasi administrator';
                modalHeader.className =
                    'bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 sticky top-0 flex items-center justify-between';
                submitBtn.innerHTML =
                    '<span class="flex items-center"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Update Admin</span>';
                document.getElementById('infoBoxTitle').textContent = 'Perhatian';
                document.getElementById('infoBoxText').textContent =
                    'Biarkan kolom password kosong jika tidak ingin mengubah password. Password harus minimal 8 karakter jika diisi.';

                document.getElementById('name').value = admin.name;
                document.getElementById('username').value = admin.username;
                document.getElementById('password').value = '';
                document.getElementById('password_confirmation').value = '';
                document.getElementById('password').required = false;
                document.getElementById('password_confirmation').required = false;
                document.getElementById('password').placeholder = 'Masukkan password baru (opsional)';

                form.action = '{{ route('manajemen-admin.update', ':id') }}'.replace(':id', adminId);
                document.getElementById('formMethod').value = 'PUT';
            }

            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('formModal').classList.add('hidden');
        }

        document.getElementById('formModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.getElementById('adminForm').addEventListener('submit', function(e) {
            e.preventDefault();
            this.submit();
        });
    </script>
</x-admin-layout>
