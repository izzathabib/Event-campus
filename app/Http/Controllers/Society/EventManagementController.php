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
            'tarikh' => 'required|date|after:today',
            'masa' => 'required|date_format:H:i',

            // MyCSD Mapping
            'taj_prog' => 'bail|required|string|max:1',

            // Application to Organize Events
            'nama' => 'bail|required|string|max:1',
        ], [
            #--#--#
            # KERTAS KERJA PROGRAM/ PROJEK/ AKTIVITI PERTUBUHAN PELAJAR UNIVERSITI SAINS MALAYSIA
            // tajuk_kk
            'tajuk_kk.required' => 'Tajuk Kertas Kerja is required.',
            'tajuk_kk.string' => 'Tajuk Kertas Kerja must be a valid text.',
            'tajuk_kk.max' => 'Tajuk Kertas Kerja must not exceed 100 characters.',

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
            'impak.max' => 'Impak Dijangkakan must not exceed 2000 characters.',

            // tarikh
            'tarikh.required' => 'Date is required.',
            'tarikh.date' => 'Please enter a valid date.',
            'tarikh.after' => 'Date must be in the future.',

            // masa
            'masa.required' => 'Time is required.',
            'masa.date_format' => 'Please enter a valid time.',
            
            #--#--#
            # PEMETAAN MyCSD & ATRIBUT HEBAT PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI
            // taj_prog
            'taj_prog.required' => 'Tajuk Program is required.',
            'taj_prog.string' => 'Tajuk Program must be a valid text.',
            'taj_prog.max' => 'Tajuk Program must not exceed 100 characters.',
            
            #--#--#
            # PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI
            // nama
            'nama.required' => 'Nama Program is required.',
            'nama.string' => 'Nama Program must be a valid text.',
            'nama.max' => 'Nama Program must not exceed 100 characters.',
        ]);

        

        // Store data in the respective tables
        $paperWork = PaperWork::create([
            'user_id' => Auth::id(),
            'tajuk_kk' => $validatedData['tajuk_kk'],
            'peng_kump_sasar' => $validatedData['peng_kump_sasar'],
            'obj' => $validatedData['obj'],
            'impak' => $validatedData['impak'],
        ]);

        MycsdMap::create([
            'user_id' => Auth::id(),
            'paper_work_id' => $paperWork->id,
            'taj_prog' => $validatedData['taj_prog'],
        ]);

        ApplyToOrganizeEvent::create([
            'user_id' => Auth::id(),
            'paper_work_id' => $paperWork->id,
            'nama' => $validatedData['nama'],
        ]);

        // Redirect or return a success response
        return redirect()->back()->with('success', 'Event application submitted successfully!');
    }
}
 