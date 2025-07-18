<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-white px-4">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-blue-800">Distribusi Barang </h1>
                <p class="text-sm text-gray-500 mt-2">Silakan login untuk mengakses sistem</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                  :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" name="remember">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif

                    <div class="flex gap-3">
                        <x-primary-button>
                            {{ __('Log in') }}
                        </x-primary-button>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-xs font-semibold uppercase rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Register
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <p class="mt-8 text-xs text-gray-500 text-center">
            PT. Distribusi Barang 
        </p>
    </div>
</x-guest-layout>
