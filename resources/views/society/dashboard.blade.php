@extends('layouts.app')
@section('content')
 <h1 class="text-xl font-semibold">Dashboard</h1>
 <div class="bg-white rounded-lg border border-gray-300 overflow-hidden mt-4">
  <h2 class="text-sm font-semibold px-4 py-4 mt-2">Event Applications</h2>
  <div class="px-4 py-2 rounded-lg mb-4">
    <table class="min-w-full bg-white">
      @if (session()->has('delete_success'))
        <div id="flash-error" class="bg-red-700 text-white px-4 py-3 rounded relative mb-4 text-sm font-medium flex items-center justify-between" role="alert">
            <div class="px-4 py-3">
                <span class="block sm:inline">{{ session('delete_success') }}</span>
            </div>
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('flash-error').remove()">
                <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
      @elseif (session()->has('success'))
        <div id="flash-error" class="bg-sky-700 text-white px-4 py-3 rounded relative mb-4 text-sm font-medium flex items-center justify-between" role="alert">
            <div class="px-4 py-3">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('flash-error').remove()">
                <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
      @endif
        <thead>
          <tr class="bg-slate-200">
              <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Event</th>
              <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Status</th>
              <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($eventApplications as $index => $event)
          <tr>
              <td class="px-4 py-2 border-b text-sm">{{ $event->tajuk_kk }}</td>
              <td class="px-4 py-2 border-b"><span class="px-2 py-1 rounded-2xl bg-red-800 text-xs text-white">Pending</span></td>
              <td class="px-4 py-2 border-b text-sm flex gap-2 item-center">
                <!-- Document Icon -->
                <div>
                  <form action="{{ route('society.displaySingleEventApplication', $event->id) }}" method="GET">
                    <button title="View event applications" type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-5 text-blue-600 hover:text-blue-800">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                      </svg>
                    </button>
                  </form>
                </div>
                <!-- Delete Icon -->
                <div>
                  <form action="{{ route('society.deleteEventApplication', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button title="Delete" type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-5 text-red-600 hover:text-red-800">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                      </svg>
                    </button>
                  </form>
                </div>
              </td>
          </tr>
          @empty
          <tr>
              <td colspan="6" class="px-4 py-4 text-center text-gray-500 text-sm">No event applications submitted yet.</td>
          </tr>
          @endforelse
        </tbody>
    </table>
  </div>
 </div>
@endsection