@extends('layouts.app')
@section('content')
    <div class="w-full">
        <div class="flex items-center gap-4">
            <button type="button" title="Back"
                onclick="window.history.back();"
                class="inline-flex items-center px-3 py-1.5 text-xl font-semibold hover:text-purple-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </button>
            <h2 class="text-xl font-semibold">Add Society Advisor</h2>
        </div>
        <p class="mt-2 text-sm/6 text-gray-600">Please fill in the details below to add a society advisor.</p>
    </div>
    <div class="flex flex-col items-center justify-center p-4 mt-3 w-3/5 mx-auto bg-white rounded-lg border border-gray-300">
        <form method="POST" action="{{ route('society.add_society_advisor') }}" class="mt-5 w-full">
            @csrf

            <!-- Acc type -->
            <div>
                <input type="hidden" name="role_id" id="account_type_input" value="4" />
            </div>
            
            <!-- Name -->
            <div id="full-name" class="mt-4">
                <x-input-label id="fullname-label" for="name" :value="__('Full Name')" class="block text-sm/6 font-medium text-gray-900"/>
                <x-text-input id="name" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus
                            placeholder="Ali Bin Abu" 
                            autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Username -->
            <div id="user-name" class="mt-4">
                <x-input-label for="username" :value="__('Username')" class="block text-sm/6 font-medium text-gray-900"/>
                <x-text-input id="username" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6" 
                            type="text" 
                            name="username" 
                            :value="old('username')" 
                            required 
                            autofocus
                            placeholder="aliAbu" 
                            autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div id="email-section" class="mt-4">
                <x-input-label id="email-label" for="email" :value="__('Email')" class="block text-sm/6 font-medium text-gray-900"/>
                <x-text-input id="email" class="block mt-1 w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-purple-600 sm:text-sm/6" 
                            type="email" 
                            name="email" 
                            :value="old('email')"
                            placeholder="ali@email.com" 
                            required 
                            autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div id="submit-button" class="mt-6">
                <button type="submit" class="flex w-full justify-center rounded-md bg-purple-900 px-3 py-1.5 text-sm/6 font-medium text-white shadow-xs hover:bg-purple-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">Add advisor</button>
            </div>

            
            
        </form>
    </div>
    
@endsection
