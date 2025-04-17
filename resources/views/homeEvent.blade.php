@extends('layouts.app')

@section('content')
<div class="flex flex-row items-center justify-center">
<div></div>
<div class="lg:w-2/5 sm:w-4/5">
@if($events->count() > 0)
@foreach ($events as $event)
<div class="border-b border-gray-300 mt-10">
    <div class="flex items-center gap-2 p-2">
        <div class="relative">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-9 h-9 rounded-full object-cover">
            <div class="profile-status"></div>
        </div>
        <p class="text-sm font-semibold">{{ $event->users?->username ?? 'Unknown User' }}</p>
        <p class="text-sm text-gray-500"><span class="text-gray-500 text-base font-bold mr-1">
            ·</span>{{ $event->created_at->shortAbsoluteDiffForHumans() }}
        </p>
    </div>
    
    <!-- Event Image -->
    <div class="relative">
        <img src="{{ asset('storage/' . $event->image_path) }}" 
                alt="Event Image" 
                class="w-full object-cover">
    </div>
    <!-- Event Caption -->
    <div class="p-4">
        <p class="text-gray-800 text-sm whitespace-pre-line line-clamp-5 transition-all duration-200">
            <span class="font-semibold mr-2">{{ $event->users?->username }}</span> {{ $event->caption }}
        </p>
        @if (strlen($event->caption) > 90)
            <button onclick="toggleCaption(this)" 
                    class="text-gray-500 text-sm hover:text-gray-700 focus:outline-none">
                See more
            </button>
        @endif
    </div>
</div>
@endforeach
@else
    <p class="font-semibold">No events available</p>
@endif
</div>
<div></div>
</div>

<script>
    function toggleCaption(element) {
    const caption = element.previousElementSibling;
    const seeMoreBtn = element;
    
    if (caption.classList.contains('line-clamp-5')) {
        caption.classList.remove('line-clamp-5');
        seeMoreBtn.textContent = 'See less';
    } else {
        caption.classList.add('line-clamp-5');
        seeMoreBtn.textContent = 'See more';
    }
}
</script>
@endsection