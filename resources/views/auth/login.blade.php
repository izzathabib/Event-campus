<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="text-center text-4xl/9 font-bold tracking-tight text-gray-900">Login</h2>
        <p class="mt-5 mb-12 text-center text-base/6 text-gray-500">
            Event Management System USM
        </p>
    </div>
    @if (session()->has('adminNotVerified'))
        <div id="flash-error" class="bg-rose-700 text-white px-4 py-3 rounded relative mb-4 text-sm font-medium flex items-center justify-between" role="alert">
            <div class="px-4 py-3">
                <span class="block sm:inline">{{ session('adminNotVerified') }}</span>
            </div>
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('flash-error').remove()">
                <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="block text-sm/6 font-medium text-gray-900"/>

            <x-text-input id="password" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> -->

        <div class="flex justify-end mt-3">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-500 hover:text-gray-900 rounded-md focus:outline-none  focus:text-purple-700" href="{{ route('password.request') }}">
                    {{ __('Forgot password') }}
                </a>
            @endif
        </div>

        <x-primary-button class="flex w-full justify-center rounded-md bg-purple-600 px-3 py-1.5 text-sm/6 font-medium text-white shadow-xs hover:bg-purple-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600 mt-6">
            {{ __('Login') }}
        </x-primary-button>

        <p class="mt-8 text-center text-sm/6 text-gray-500">
        You dont have an account yet?
        <a href="{{ route('register') }}" class="font-semibold text-purple-600 hover:text-purple-500"> Create account</a>
        </p>
    </form>
</x-guest-layout>
