<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-primary hover:text-secondary hover:underline transition font-semibold" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif

            <x-primary-button class="bg-primary hover:bg-secondary">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        
        <div class="mt-6 text-center border-t border-gray-100 pt-4">
            <p class="text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-primary hover:text-secondary hover:underline font-bold transition">Daftar sekarang</a>
            </p>
        </div>
    </form>
</x-guest-layout>
