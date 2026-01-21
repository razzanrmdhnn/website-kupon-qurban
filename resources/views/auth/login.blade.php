<x-guest-layout>
    <!-- Login Card -->
    <div class="w-full sm:max-w-md">
        <!-- Login Form Card -->
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            <!-- Header Section with Gradient -->
            <div class="bg-gradient-to-br from-green-600 to-emerald-700 px-6 sm:px-8 py-8 sm:py-10 text-center">
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2 leading-tight">
                    Sistem Manajemen<br> Kupon Qurban
                </h1>
                <p class="text-green-50 text-xs sm:text-sm font-medium">Panitia Qurban Masjid Al-Abror</p>
                <div class="mt-4 h-1 w-16 sm:w-20 bg-white/30 mx-auto rounded-full"></div>
            </div>

            <!-- Form Section -->
            <div class="px-6 sm:px-8 py-6 sm:py-8">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-5 sm:mb-6">Login Admin</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Username -->
                    <div class="mb-5">
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                            Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input id="username" name="username" type="text" required autofocus
                                placeholder="Masukkan username Anda"
                                class="block w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 text-gray-700 font-medium"
                                value="{{ old('username') }}">
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required
                                autocomplete="current-password" placeholder="Masukkan password Anda"
                                class="block w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 text-gray-700 font-medium">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox"
                                class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500 focus:ring-offset-0 transition-all duration-200"
                                name="remember">
                            <span
                                class="ms-2 text-sm text-gray-600 group-hover:text-gray-800 transition-colors duration-200">Ingat
                                saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-green-600 hover:text-green-700 font-medium transition-colors duration-200"
                                href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-3.5 px-4 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
