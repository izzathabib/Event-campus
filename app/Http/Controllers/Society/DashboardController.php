<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\Advisor;
use App\Models\PaperWork;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get listof event applications
        $eventApplications = PaperWork::where('user_id', auth()->id())->latest()->get();
        // Get list of society advisor
        $advisors = Advisor::with(['society_advisor_data'])
        ->where('user_id', auth()->id())
        ->get();
        // dd($advisors);
        return view('society.dashboard', compact('eventApplications', 'advisors'));
        
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

    public function deleteSocietyAdvisor($id)
    {
        $advisor = User::where('id', $id)->findOrFail($id);
        $advisor->delete();
        
        return redirect()->route('society.dashboard')->with('delete_advisor', 'Advisor deleted successfully.');
    }
}
