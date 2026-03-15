<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center px-4 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <svg viewBox="0 0 62 65" class="h-16 w-16 text-red-600">
                <path fill="#FF2D20" d="M61.8548 14.6253C61.8778...Z"/>
            </svg>
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white text-center mb-2">
            Sistema Laravel
        </h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm text-center mb-6">
            Inicia sesión para continuar
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="w-full max-w-md bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-900 dark:text-white" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-gray-900 dark:text-white"
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-red-600 shadow-sm focus:ring-red-500 dark:focus:ring-red-600 dark:focus:ring-offset-gray-800" 
                        name="remember"
                    >
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800" 
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3 bg-red-600 hover:bg-red-700 focus:ring-red-500">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Footer -->
        <div class="mt-6 text-sm text-gray-500 dark:text-gray-400 text-center">
            &copy; {{ date('Y') }} Mi Sistema. Todos los derechos reservados.
        </div>
    </div>
</x-guest-layout>
