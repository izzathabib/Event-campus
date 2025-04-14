<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CreateEventContoller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'string|max:1000',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('event-images', 'public');

        // Create event
        $event = Event::create([
            'user_id' => auth()->id(),
            'caption' => $request->caption,
            'image_path' => $imagePath,
            // 'status' => 'pending', // Default status
        ]);

        // dd($event);

        return redirect()->route('homeEvent');
        // ->with('success', 'Event created successfully!')
    }
}
