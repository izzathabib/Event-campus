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
        // dd($request->all());
        // Validate the form data
        $validatedData = $request->validate([
            // Paper Work
            'tajuk_kk' => 'bail|required|string|max:1',
            'peng_kump_sasar' => 'bail|required|string|max:1',
            'obj' => 'bail|required|string|max:1',
            'impak' => 'bail|required|string|max:1',

            // MyCSD Mapping
            'taj_prog' => 'bail|required|string|max:1',

            // Application to Organize Events
            'nama' => 'bail|required|string|max:1',
        ], [

            // tajuk_kk
            'tajuk_kk.required' => 'Tajuk Kertas Kerja is required.',
            'tajuk_kk.string' => 'Tajuk Kertas Kerja must be a valid text.',
            'tajuk_kk.max' => 'Tajuk Kertas Kerja must not exceed 255 characters.',

            // peng_kump_sasar
            'peng_kump_sasar.required' => 'Pengenalan & Kumpulan Sasaran is required.',
            'peng_kump_sasar.string' => 'Pengenalan & Kumpulan Sasaran must be a valid text.',
            'peng_kump_sasar.max' => 'Pengenalan & Kumpulan Sasaran must not exceed 2000 characters.',

            // obj
            'obj.required' => 'Objektif is required.',
            'obj.string' => 'Objektif must be a valid text.',
            'obj.max' => 'Objektif must not exceed 1000 characters.',

            // impak
            'impak.required' => 'Impak Dijangkakan is required.',
            'impak.string' => 'Impak Dijangkakan must be a valid text.',
            'impak.max' => 'Impak Dijangkakan must not exceed 1000 characters.',

        ]);

        dd($validatedData);

        // Store data in the respective tables
        PaperWork::create([
            'user_id' => Auth::id(),
            'tajuk_kk' => $validatedData['tajuk_kk'],
            'peng_kump_sasar' => $validatedData['peng_kump_sasar'],
            'obj' => $validatedData['obj'],
            'impak' => $validatedData['impak'],
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
 