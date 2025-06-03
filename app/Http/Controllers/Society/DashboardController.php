<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\PaperWork;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get listof event applications
        $eventApplications = PaperWork::where('user_id', auth()->id())->latest()->get();
        // dd($eventApplications);
        return view('society.dashboard', compact('eventApplications'));
        
    }

    public function displaySingleEventApplication($id)
    {
        // Get single event application
        $eventApplications = PaperWork::with('event_days.time_activities')
        ->where('user_id', auth()->id())
        ->where('id', $id)->first();
        // dd($eventApplications);
        return view('displaySingleEventApplication', compact('eventApplications'));
    }

    public function deleteEventApplication($id)
    {
        $event = PaperWork::where('user_id', auth()->id())->findOrFail($id);
        $event->delete();
        
        return redirect()->route('society.dashboard')->with('delete_success', 'Event application deleted successfully.');
    }
}
