<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="text-center text-4xl/9 font-bold tracking-tight text-gray-900">Create your account</h2>
        <p class="mt-2 text-center text-sm/6 text-gray-500">
            Event Management System USM
        </p>
    </div>
    <form method="POST" action="{{ route('register') }}" class="mt-5">
        @csrf

        <!-- Acc type -->
        <div>
            <x-input-label for="role_id" :value="__('This account will be used by?')" class="block text-sm/6 font-medium text-gray-900"/>
            <div class="flex justify-between mt-2">
                <div class="border-gray-300 flex place-items-center gap-2 p-2 text-xs font-semibold text-gray-900 border rounded-md hover:bg-black hover:text-white cursor-pointer" id="society">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="truncate">Student Society</span>
                </div>
                <div class="border-gray-300 flex place-items-center gap-2 p-2 text-xs font-semibold text-gray-900 border rounded-md hover:bg-black hover:text-white cursor-pointer" id="individual">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <span class="truncate">Individual</span>
                </div>
                <div class="border-gray-300 flex place-items-center gap-2 p-2 text-xs font-semibold text-gray-900 border rounded-md hover:bg-black hover:text-white cursor-pointer" id="admin">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>
                    <span class="truncate">Admin</span>
                </div>
            </div>
            <input type="hidden" name="role_id" id="account_type_input" value="" />
        </div>
        
        <!-- Name -->
        <div id="full-name" class="mt-4 hidden">
            <x-input-label id="fullname-label" for="name" :value="__('Full Name')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-input-label id="society-label" for="name" :value="__('Society')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="name" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required 
                        autofocus 
                        autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div id="user-name" class="mt-4 hidden">
            <x-input-label for="username" :value="__('Username')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="username" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6" 
                        type="text" 
                        name="username" 
                        :value="old('username')" 
                        required 
                        autofocus 
                        autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div id="email-section" class="mt-4 hidden">
            <x-input-label id="email-label" for="email" :value="__('Email')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-input-label id="studEmail-label" for="email" :value="__('Student Email')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="email" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div id="psswrd-section" class="mt-4 hidden">
            <x-input-label for="password" :value="__('Password')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="password" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div id="confirm-psswrd" class="mt-4 hidden">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm/6 font-medium text-gray-900"/>
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6"
                            type="password"
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div id="submit-button" class="mt-6 hidden">
            <button type="submit" class="flex w-full justify-center rounded-md bg-purple-600 px-3 py-1.5 text-sm/6 font-medium text-white shadow-xs hover:bg-purple-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">Create account</button>
        </div>

        <p class="mt-4 text-center text-sm/6 text-gray-500">
        Already have an account?
        <a href="{{ route('login') }}" class="font-semibold text-purple-600 hover:text-purple-500">Log In</a>
        </p>
        
    </form>
</x-guest-layout>
