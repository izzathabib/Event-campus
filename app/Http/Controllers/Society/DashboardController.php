<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\Advisor;
use App\Models\Belanjawan;
use App\Models\PaperWork;
use App\Models\Penceramah;
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
        $eventApplications = PaperWork::with(['event_days.time_activities', 'jawatankuasa', 'belanjawans'])
        ->where('user_id', auth()->id())
        ->where('id', $id)->first();

        $belanjawans = Belanjawan::where('paper_work_id', $id)->get();

        $penceramahs = Penceramah::where('paper_work_id', $id)->get();
        // dd($eventApplications);
        return view('displaySingleEventApplication', compact(
            'eventApplications', 
            'belanjawans', 
            'penceramahs',
        ));
    }

    // Controller to display the edit page for event application form
    public function editEventApplicationForm($id)
    {
        // Get single event application
        $eventApplications = PaperWork::with(['event_days.time_activities', 'jawatankuasa', 'belanjawans'])
        ->where('user_id', auth()->id())
        ->where('id', $id)->first();

        $belanjawans = Belanjawan::where('paper_work_id', $id)->get();

        $penceramahs = Penceramah::where('paper_work_id', $id)->get();
        // dd($eventApplications);
        return view('society.editEventApplicationForm', compact(
            'eventApplications', 
            'belanjawans', 
            'penceramahs',
        ));
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
