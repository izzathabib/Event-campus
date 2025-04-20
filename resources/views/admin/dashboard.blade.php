@extends('layouts.app')

@section('content')
<h1 class="text-lg font-semibold ml-4">Create Event</h1> 
<!-- <p class="">Students Society</p> -->
<!-- @if (session()->has('userVerified'))
<div id="flash-error" class="bg-green-100 text-green-800 px-4 py-3 rounded relative mb-4 text-sm font-medium flex items-center justify-between" role="alert">
    <div class="px-4 py-3">
        <span class="block sm:inline">{{ session('userVerified') }}</span>
    </div>
    <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('flash-error').remove()">
        <svg class="fill-current h-6 w-6 text-green-800" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Close</title>
            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
        </svg>
    </button>
</div>
@endif
<div class="bg-white border shadow-md rounded-lg flex mr-2">
    
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ID
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($societies as $society)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-900">
                    {{ $society->id }}
                </td>
                <td class="px-6 py-4 whitespace-wrap text-sm text-gray-700">
                    {{ $society->name }}
                </td>
                <td class="px-6 py-4 whitespace-wrap text-sm text-gray-500">
                    {{ $society->email }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if (!$society->admin_verified)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Not Verified
                    </span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Verified
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if (!$society->admin_verified)
                    <form action="{{ route('VerifyUser', $society->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-purple-700 text-sm font-semibold hover:bg-purple-100 rounded-2xl border-2 border-gray-200 px-3">
                            Verify
                        </button>
                    @else
                    <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    </span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
    </table>
</div> -->
  
<!-- <script>
    // Auto dismiss flash messages after 3 seconds
    setTimeout(function() {
        const flashMessages = document.querySelectorAll('[id^="flash-"]');
        flashMessages.forEach(function(message) {
            message.remove();
        });
    }, 7000);
</script> -->
@endsection