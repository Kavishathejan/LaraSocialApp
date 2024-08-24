<!-- resources/views/auth/login.blade.php -->
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <head>
        <!-- Include your custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>

    <div class="outer-container">
        <div class="flex flex-col items-center justify-center min-h-screen py-6 bg-white">
            <!-- Title at the top -->
            <div class="text-center mb-6">
                <h1 class="title-text">Laravel Social Login</h1>
            </div>

            <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
                <!-- Title -->
                <h2 class="text-3xl font-bold text-center mb-6">{{ __('Login') }}</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="text-black" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="text-black" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-4">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
                    </div>

                    <!-- Login Button -->
                    <div class="flex items-center justify-center mb-4">
                        <x-primary-button class="login-btn">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Google Authentication Button -->
                <div class="mt-4 flex items-center justify-center">
                    <a href="{{ route('google.auth') }}" class="flex items-center justify-center google-btn">
                        <!-- Google Logo Image -->
                        <img src="{{ asset('images/google-logo.png') }}" alt="Google Logo" class="w-8 h-8 mr-2">
                        {{ __('Continue with Google') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
