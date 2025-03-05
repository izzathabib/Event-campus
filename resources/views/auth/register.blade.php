<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="text-center text-4xl/9 font-bold tracking-tight text-gray-900">Create your account</h2>
        <p class="mt-3 text-center text-sm/6 text-gray-500">
            Event Management System USM
        </p>
    </div>
    <form method="POST" action="{{ route('register') }}" class="mt-9">
        @csrf

        <!-- Acc type -->
        <div>
            <x-input-label for="account_type" :value="__('Account Type')" class="block text-sm/6 font-medium text-gray-900"/>
            <div class="relative mt-1">
                <button type="button" id="account_type_button" class="border border-gray-300 block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 text-sm/6">
                    <div class="flex justify-between">
                        <span id="selected_account_type">Please Select</span>
                        <svg class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                <ul id="account_type_options" class="absolute z-10 mt-1 bg-white border w-full border-gray-300 rounded-md shadow-lg hidden">
                    <li class="cursor-pointer px-3 py-1.5 hover:bg-purple-600 hover:text-white text-sm/6" data-value="Society">Society</li>
                    <li class="cursor-pointer px-3 py-1.5 hover:bg-purple-600 hover:text-white text-sm/6" data-value="Individual">Individual</li>
                    <li class="cursor-pointer px-3 py-1.5 hover:bg-purple-600 hover:text-white text-sm/6" data-value="Admin (TDC)">Admin (TDC)</li>
                </ul>
            </div>
            
            <input type="hidden" name="account_type" id="account_type_input">
            <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="name" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="email" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6" 
            type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="password" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <button type="submit" class="flex w-full justify-center rounded-md bg-purple-600 px-3 py-1.5 text-sm/6 font-medium text-white shadow-xs hover:bg-purple-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">Create account</button>
        </div>

        <p class="mt-6 text-center text-sm/6 text-gray-500">
        Already have an account?
        <a href="{{ route('login') }}" class="font-semibold text-purple-600 hover:text-purple-500">Log In</a>
        </p>
        
    </form>
</x-guest-layout>
