<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\ApplyToOrganizeEvent;
use App\Models\MycsdMap;
use App\Models\PaperWork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventManagementController extends Controller
{
    public function eventApplicationView()
    {
        return view('society.eventApplication'); 
    }

    // Store event application data
    public function storeEventApplicationData(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            // Paper Work
            'tajuk_kk' => 'required|string|max:255',

            // MyCSD Mapping
            'taj_prog' => 'required|string|max:255',

            // Application to Organize Events
            'nama' => 'required|string|max:255',
        ]);

        // Store data in the respective tables
        PaperWork::create([
            'user_id' => Auth::id(),
            'tajuk_kk' => $validatedData['tajuk_kk'],
        ]);

        MycsdMap::create([
            'user_id' => Auth::id(),
            'taj_prog' => $validatedData['taj_prog'],
        ]);

        ApplyToOrganizeEvent::create([
            'user_id' => Auth::id(),
            'nama' => $validatedData['nama'],
        ]);

        // Redirect or return a success response
        return redirect()->back()->with('success', 'Event application submitted successfully!');
    }
}
 