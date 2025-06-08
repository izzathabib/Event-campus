<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use App\Models\ApplyToOrganizeEvent;
use App\Models\Belanjawan;
use App\Models\EventDay;
use App\Models\Jawatankuasa;
use App\Models\MycsdMap;
use App\Models\PaperWork;
use App\Models\Penceramah;
use App\Models\TimeActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            'tajuk_kk' => 'bail|required|string|max:100',
            'peng_kump_sasar' => 'bail|required|string|max:2000',
            'obj' => 'bail|required|string|max:1000',
            'impak' => 'bail|required|string|max:2000',
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $startDate = Carbon::parse($value);
                    $today = Carbon::today();

                    if ($startDate->isBefore($today)) {
                        $fail('The start date cannot be in the past.');
                    }
                }
            ],
            'start_time' => 'required|date_format:H:i',
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->start_date === $request->end_date) {
                        $startTime = $request->start_time;
                        if ($value <= $startTime) {
                            $fail('End time must be after start time when dates are the same.');
                        }
                    }
                }
            ],
            'lokasi' => 'required|string|max:100',
            'days' => ['required', 'json'],
            'collaboration' => 'nullable|string|max:200',
            'jawatankuasa' => 'json',
            'penaja' => 'nullable|string|max:200',
            'belanjawans' => 'json',
            'penceramahs' => 'json',
            'photoPenceramah.*' => 'nullable|image|max:2048',
            'posterHebahan' => 'image|max:2048',

            // MyCSD Mapping
            'kaedah' => 'required|in:Atas Talian,Fizikal,Hybrid',
            'hfp'    => 'required|in:Ya,Tidak',
            'poster' => 'required|in:Ya,Tidak',
            'pertubuhan' => 'required|in:Persatuan,Kelab,Majlis Penghuni Desasiswa,Anak Negeri,Badan Beruniform,Sekreteriat',
            'holistic' => 'nullable|array',
            'entrepreneurial' => 'nullable|array',
            'balanced' => 'nullable|array',
            'articulate' => 'nullable|array',
            'thinking' => 'nullable|array',

            // Application to Organize Events
            'nama' => 'bail|required|string|max:60',
            'no_ic' => 'required|string|max:14',
            'jawatan_borg_adkn_prog' => 'required|string|max:100',
            'no_matric' => 'required|string|max:20',
            'tel_bimbit' => 'required|string|max:20',
            'email_borg_adkn_prog' => 'required|email|max:255',
            'alamat_penggal' => 'nullable|string|max:255',
            'alamat_cuti' => 'nullable|string|max:255',
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

            // lokasi
            'lokasi.required' => 'Location is required.',
            'lokasi.string' => 'Location must be text.',
            'lokasi.max' => 'Location must not exceed 100 characters.',
            
            #--#--#
            # PEMETAAN MyCSD & ATRIBUT HEBAT PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI
            'kaedah.required' => 'Please make selection on Kaedah.',
            'hfp.required' => 'Please make selection on HFP.',
            'poster.required' => 'Please make selection on Poster.',
            'pertubuhan.required' => 'Please make selection on Pertubuhan.',
            
            #--#--#
            # PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI
            // nama
            'nama.required' => 'Nama Program is required.',
            'nama.string' => 'Nama Program must be a valid text.',
            'nama.max' => 'Nama Program must not exceed 100 characters.',
        ]);

        // Decode the JSON data
        $daysData = json_decode($request->days, true);
        $jawatankuasa = json_decode($request->jawatankuasa, true);
        $belanjawans = json_decode($request->belanjawans, true);
        $penceramahs = json_decode($request->penceramahs, true);

        // Get the penceramah photo
        $photoPenceramah = $request->file('photoPenceramah', []);
        // Handle the poster hebahan upload
        $posterHebahanPath = null;
        if ($request->hasFile('posterHebahan')) {
            $posterHebahanPath = $request->file('posterHebahan')->store('poster_hebahan', 'public');
        }
        
        try {

            // Store data in the respective tables
            $paperWork = PaperWork::create([
                'user_id' => Auth::id(),
                'tajuk_kk' => $validatedData['tajuk_kk'],
                'peng_kump_sasar' => $validatedData['peng_kump_sasar'],
                'obj' => $validatedData['obj'],
                'impak' => $validatedData['impak'],
                'start_date' => $validatedData['start_date'],
                'start_time' => $validatedData['start_time'],
                'end_date' => $validatedData['end_date'],
                'end_time' => $validatedData['end_time'],
                'lokasi' => $validatedData['lokasi'],
                'collaboration' => $validatedData['collaboration'],
                'penaja' => $validatedData['penaja'],
                'poster_hebahan_path' => $posterHebahanPath,
            ]);
            // dd($paperWork);
            foreach ($daysData as $index => $day) {
                $eventDay = EventDay::create([
                    'paper_work_id' => $paperWork->id,
                    'title' => $day['title'],
                    'day_number' => $index + 1
                ]);

                foreach ($day['timeActivities'] as $activity) {
                    if (!empty($activity['time']) && !empty($activity['activity'])) {
                        TimeActivity::create([
                            'event_day_id' => $eventDay->id,
                            'time' => $activity['time'],
                            'activity' => $activity['activity']
                        ]);
                    }
                }
            }

            foreach ($jawatankuasa as $row) {
                // Save to Jawatankuasa model
                Jawatankuasa::create([
                    'paper_work_id' => $paperWork->id,
                    'jawatan' => $row['jawatan'],
                    'nama_pemegang_jawatan' => $row['namaPemegangJawatan'],
                    'no_matrik_pemegang_jawatan' => $row['noMatrikPemegangJawatan'],
                    'tahun_pemegang_jawatan' => $row['tahunPemegangJawatan'],
                    'pusat_tanggungjawab' => $row['pusatTanggungjawab'],
                ]);
            }

            foreach ($belanjawans as $row) {
                Belanjawan::create([
                    'paper_work_id' => $paperWork->id, 
                    'pendapatan' => $row['pendapatan'],
                    'unit_pendapatan' => $row['unitPendapatan'] === '' ? null : $row['unitPendapatan'],
                    'rm_pendapatan' => $row['rmPendapatan'] === '' ? null : $row['rmPendapatan'],
                    'perbelanjaan' => $row['perbelanjaan'],
                    'unit_perbelanjaan' => $row['unitPerbelanjaan'] === '' ? null : $row['unitPerbelanjaan'],
                    'rm_perbelanjaan' => $row['rmPerbelanjaan'] === '' ? null : $row['rmPerbelanjaan'],
                ]);
            }

            foreach ($penceramahs as $index => $row) {
                $photoPenceramahPath = null;
                if (isset($photoPenceramah[$index]) && $photoPenceramah[$index]) {
                    $photoPenceramahPath = $photoPenceramah[$index]->store('penceramah_photos', 'public');
                }
                Penceramah::create([
                    'paper_work_id' => $paperWork->id, 
                    'namaPenceramah' => $row['namaPenceramah'] ?? '',
                    'umurPenceramah' => $row['umurPenceramah'] ?? null,
                    'alamatPenceramah' => $row['alamatPenceramah'] ?? '',
                    'emailPenceramah' => $row['emailPenceramah'] ?? '',
                    'telefonPenceramah' => $row['telefonPenceramah'] ?? '',
                    'media_sosialPenceramah' => $row['media_sosialPenceramah'] ?? '',
                    'kerjayaPenceramah' => $row['kerjayaPenceramah'] ?? '',
                    'bidangPenceramah' => $row['bidangPenceramah'] ?? '',
                    'pendidikanPenceramah' => $row['pendidikanPenceramah'] ?? '',
                    'photoPenceramahPath' => $photoPenceramahPath,
                ]);
            }

            MycsdMap::create([
                'user_id' => Auth::id(),
                'paper_work_id' => $paperWork->id,
                'kaedah' => $validatedData['kaedah'],
                'hfp' => $validatedData['hfp'],
                'poster' => $validatedData['poster'],
                'pertubuhan' => $validatedData['pertubuhan'],
                'holistic' => json_encode($request->holistic),
                'entrepreneurial' => json_encode($request->entrepreneurial),
                'balanced' => json_encode($request->balanced),
                'articulate' => json_encode($request->articulate),
                'thinking' => json_encode($request->thinking),
            ]);

            ApplyToOrganizeEvent::create([
                'user_id' => Auth::id(),
                'paper_work_id' => $paperWork->id,
                'nama' => $validatedData['nama'],
                'no_ic' => $validatedData['no_ic'],
                'jawatan_borg_adkn_prog' => $validatedData['jawatan_borg_adkn_prog'],
                'no_matric' => $validatedData['no_matric'],
                'tel_bimbit' => $validatedData['tel_bimbit'],
                'email_borg_adkn_prog' => $validatedData['email_borg_adkn_prog'],
                'alamat_penggal' => $validatedData['alamat_penggal'],
                'alamat_cuti' => $validatedData['alamat_cuti'],
            ]);

            // Redirect or return a success response
            return redirect()->route('society.dashboard')->with('success', 'Event application submitted successfully!');

        } catch (\Exception $e) {

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Something went wrong. Please try again.']);
                
        }

    }
}
 