@extends('layouts.app')

@section('styles')
  
@endsection

@section('content')

<h1 class="text-lg font-semibold">Event Application</h1>
<div class="mt-4 mb-8">
    <!-- Form Navigation -->
    <div class="flex items-center gap-10 mt-6 mb-6 text-sm text-gray-400 border-b sticky top-0 bg-white z-10">
        <div id="paper-work-nav" class="py-4 hover:text-purple-800 cursor-pointer hover:border-b border-b text-purple-800 border-purple-800">Paper Work</div>
        <div id="mycsd-map-nav" class="py-4 hover:text-purple-800 cursor-pointer hover:border-b border-b">MyCSD Mapping</div>
        <div id="apply-to-organize-event-nav" class="py-4 hover:text-purple-800 cursor-pointer hover:border-b border-b">Application to Organize Events</div>
    </div>

    <!-- Form -->
    <div class="flex justify-center">
        <!-- Paper Work -->
        <div id="paper-work-form" class="w-full max-w-4xl bg-white rounded-lg border border-gray-300 overflow-hidden">
        
            <!-- Form Header -->
            <div class=" p-6">
                <div class="flex flex-col items-center justify-center mt-6 mb-4">
                    <img src="{{ asset('images/USM-COLOR-72703c67.png') }}" alt="Organization Logo" class="h-20 mb-6">
                    <h3 class="text-xl font-bold text-gray-800">KERTAS KERJA PROGRAM/ PROJEK/ AKTIVITI</h3>
                    <h3 class="text-xl font-bold text-gray-800">PERTUBUHAN PELAJAR UNIVERSITI SAINS MALAYSIA</h3>
                </div>
            </div>
            
            <!-- Form Body -->
            <div class="p-6">
                <form>
                    <!-- Step 1: Paper work -->
                    <div>
                        <div class="grid grid-cols-1  gap-6">
                            <!-- Tajuk Kertas Kerja -->
                            <div>
                                <label for="tajuk_kk" class="block text-sm font-medium text-gray-700 mb-1">Tajuk Kertas Kerja</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 text-sm">
                                    {{ $eventApplications->tajuk_kk }}
                                </div>
                            </div>
                            <!-- Pengenalan & Kumpulan Sasaran/ Penyertaan -->
                            <div>
                                <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line text-sm">
                                    {{ $eventApplications->peng_kump_sasar }}
                                </div>
                            </div>
                            <!-- Objektif (Selaras dengan Elemen & Atribut HEBAT) -->
                            <div>
                                <label for="obj" class="block text-sm font-medium text-gray-700 mb-1">Objektif (Selaras dengan Elemen & Atribut HEBAT)</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line text-sm">
                                    {{ $eventApplications->obj }}
                                </div>
                            </div>
                            <!-- Impak Dijangkakan -->
                            <div>
                                <label for="impak" class="block text-sm font-medium text-gray-700 mb-1">Impak Dijangkakan</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line text-sm">
                                    {{ $eventApplications->impak }}
                                </div>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-800 mb-4 mt-14">Lampiran A</p>
                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-8">
                            TENTATIF PROGRAM/ PROJEK/ AKTIVITI
                        </h5>
                        <div class="w-full px-3 py-2 border rounded-md border-gray-300">
                            <table class="w-full mb-6">
                                <tbody>
                                    <!-- Tarikh -->
                                    <tr class="border-b">
                                        <td class="py-2 font-medium text-gray-700 text-sm">Tarikh: 
                                            @if ($eventApplications->start_date === $eventApplications->end_date)
                                                {{ \Carbon\Carbon::parse($eventApplications->start_date)->format('d F Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($eventApplications->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($eventApplications->end_date)->format('d F Y') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Masa -->
                                    <tr class="border-b">
                                        <td class="py-2 font-medium text-gray-700 text-sm">Masa: 
                                            @if ($eventApplications->start_time === $eventApplications->end_time)
                                                {{ \Carbon\Carbon::parse($eventApplications->start_time)->format('h:i A') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($eventApplications->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($eventApplications->end_time)->format('h:i A') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-medium text-gray-700 text-sm">Lokasi: {{ $eventApplications->lokasi }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-10">
                            Atur Cara
                        </h5>

                        <!-- Table for Time and Activity -->
                        <div>
                            <!-- Loop through each day -->
                            <div class="mb-8">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                                        <thead>
                                            <tr class="bg-gray-50">
                                                <th class="w-32 px-6 py-3 border-b border-r border-gray-300 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Masa</th>
                                                <th class="w-full px-6 py-3 border-b border-gray-300 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aktiviti</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($eventApplications->event_days as $day)
                                                @if($eventApplications->event_days->count() > 1)
                                                <tr class="border-b">
                                                    <td>
                                                        <h5 class="text-sm font-semibold text-gray-800 px-2 py-2">{{ $day->title }}</h5>
                                                    </td>
                                                </tr>
                                                @endif
                                                @foreach($day->time_activities as $activity)
                                                <tr class="border-b">
                                                    <td class="whitespace-nowrap border-r border-gray-300 px-2">
                                                        <div class="w-32 text-sm">
                                                            {{ \Carbon\Carbon::parse($activity->time)->format('h:i A') }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-2 py-2">
                                                        <div class="w-32 text-sm">
                                                            {{ $activity->activity }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-10">
                            JAWATANKUASA PELAKSANA
                        </h5>

                        <div class="flex gap-2 text-sm text-gray-800 mb-6">
                            <p>Sila nyatakan pihak kolaborasi bersama (Jika ada):</p>
                            <div class="border-b border-gray-300">{{ $eventApplications->collaboration }}</div>
                        </div>

                        <!-- Table for Jawatankuasa Pelaksana -->
                        <div>
                            <div class="mb-8">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                                        <thead>
                                            <tr class="bg-gray-50">
                                                <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Jawatan</th>
                                                <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Nama</th>
                                                <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">No. Matrik</th>
                                                <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Tahun Pengajian</th>
                                                <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Pusat Tanggungjawab</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($eventApplications->jawatankuasa as $jawatankuasa)
                                                <tr class="border-b">
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="w-32 text-sm whitespace-pre-line">
                                                            {{ $jawatankuasa->jawatan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="w-32 text-sm whitespace-pre-line">
                                                            {{ $jawatankuasa->nama_pemegang_jawatan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="w-32 text-sm whitespace-pre-line">
                                                            {{ $jawatankuasa->no_matrik_pemegang_jawatan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="w-32 text-sm whitespace-pre-line">
                                                            {{ $jawatankuasa->tahun_pemegang_jawatan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="w-32 text-sm whitespace-pre-line">
                                                            {{ $jawatankuasa->pusat_tanggungjawab }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-10">
                            CADANGAN BELANJAWAN
                        </h5>

                        <div class="flex gap-2 text-sm text-gray-800 mb-6">
                            <p>Slla nyatakan Penaja/ Pemberi Sumbangan (Jlka ada):</p>
                            <div class="border-b border-gray-300">{{ $eventApplications->penaja }}</div>
                        </div>

                        <!-- Table for Belanjawan -->
                        <div>
                            <div class="mb-8">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                                        <thead>
                                            <tr class="bg-gray-100 border border-gray-300">
                                                <th class="py-2 px-2 border border-gray-300 text-center text-sm font-semibold text-gray-500">Pendapatan</th>
                                                <th class="py-2 px-2 border border-gray-300 text-center text-sm font-semibold text-gray-500">Unit</th>
                                                <th class="py-2 px-2 border border-gray-300 text-center text-sm font-semibold text-gray-500">RM</th>
                                                <th class="py-2 px-2 border border-gray-300 text-center text-sm font-semibold text-gray-500">Perbelanjaan</th>
                                                <th class="py-2 px-2 border border-gray-300 text-center text-sm font-semibold text-gray-500">Unit</th>
                                                <th class="py-2 px-2 border border-gray-300 text-center text-sm font-semibold text-gray-500">RM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($belanjawans as $belanjawan)
                                                <tr class="border-b">
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="text-sm whitespace-pre-line">
                                                            {{ $belanjawan->pendapatan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="text-sm whitespace-pre-line">
                                                            {{ $belanjawan->unit_pendapatan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="text-sm whitespace-pre-line">
                                                            {{ $belanjawan->rm_pendapatan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="text-sm whitespace-pre-line">
                                                            {{ $belanjawan->perbelanjaan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="text-sm whitespace-pre-line">
                                                            {{ $belanjawan->unit_perbelanjaan }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-wrap px-2 py-1 border-r border-gray-300">
                                                        <div class="text-sm whitespace-pre-line">
                                                            {{ $belanjawan->rm_perbelanjaan }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-gray-100 font-semibold text-sm">
                                                <td class="py-2 px-2 border border-gray-300 text-right">Jumlah</td>
                                                <td class="py-2 px-2 border border-gray-300">
                                                    {{ $belanjawans->sum('unit_pendapatan') }}
                                                </td>
                                                <td class="py-2 px-2 border border-gray-300">
                                                    {{ number_format($belanjawans->sum('rm_pendapatan'), 2) }}
                                                </td>
                                                <td class="py-2 px-2 border border-gray-300 text-right">Jumlah</td>
                                                <td class="py-2 px-2 border border-gray-300">
                                                    {{ $belanjawans->sum('unit_perbelanjaan') }}
                                                </td>
                                                <td class="py-2 px-2 border border-gray-300">
                                                    {{ number_format($belanjawans->sum('rm_perbelanjaan'), 2) }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-10">
                            FORMAT PROFIL PENCERAMAH/ TETAMU JEMPUTAN/ JURI
                        </h5>

                        @foreach($penceramahs as $penceramah)
                        <div class="flex justify-center">
                            <div class="mb-4 mt-4 border border-gray-300 p-4 w-3/5">
                                <div class="p-4 w-100 h-100 flex justify-center">
                                    @if($penceramah->photoPenceramahPath)
                                        <img 
                                            src="{{ asset('storage/' . $penceramah->photoPenceramahPath) }}" 
                                            alt="Penceramah Photo" 
                                            class="w-32 h-32 object-cover rounded mb-2"
                                        >
                                    @else
                                        <span class="text-gray-400 text-sm">No photo available</span>
                                    @endif
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Nama: {{ $penceramah->namaPenceramah }}
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Umur: {{ $penceramah->umurPenceramah }}
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Alamat: {{ $penceramah->alamatPenceramah }}
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Email: {{ $penceramah->emailPenceramah }}
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Tel: {{ $penceramah->telefonPenceramah }}
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Media Sosial: {{ $penceramah->media_sosialPenceramah }}
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Kerjaya/ Jawatan: {{ $penceramah->kerjayaPenceramah }}
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Bidang Kepakaran: {{ $penceramah->bidangPenceramah }}
                                </div>
                                <div class="text-sm whitespace-pre-line">
                                    Latar Belakang Pendidikan dan Kelayakan Akademik: {{ $penceramah->pendidikanPenceramah }}
                                </div> 
                            </div>
                        </div>
                        @endforeach

                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-10">
                            POSTER HEBAHAN
                        </h5>

                        <div class="p-4 flex justify-center">
                            @if($eventApplications->poster_hebahan_path)
                                <img 
                                    src="{{ asset('storage/' . $eventApplications->poster_hebahan_path) }}" 
                                    alt="Penceramah Photo" 
                                    class="w-96 h-96 rounded mb-2 object-contain"
                                >
                            @else
                                <span class="text-gray-400 text-sm">No photo available</span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <!-- MyCSD Mapping -->
        <div id="mycsd-map-form" class="hidden w-full max-w-4xl bg-white rounded-lg border-2 overflow-hidden">
        
            <!-- Form Header -->
            <div class=" p-6">
                <div class="flex flex-col items-center justify-center mt-6 mb-4">
                    <img src="{{ asset('images/USM-COLOR-72703c67.png') }}" alt="Organization Logo" class="h-20 mb-6">
                    <h3 class="text-xl font-bold text-gray-800">PEMETAAN MyCSD & ATTRIBUTE HEBAT</h3>
                    <h3 class="text-xl font-bold text-gray-800">PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI</h3>
                </div>
            </div>
            
            <!-- Form Body -->
            <div class="p-6">
                <!-- Kaedah / Poster / HFP -->
                    <div class="flex flex-row justify-between gap-2 mb-6">
                        <!-- Kaedah -->
                        <div class="flex flex-row border border-gray-300"
                            x-data="{
                                value: '{{ old('kaedah') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    $data.updateFormError('kaedah', this.hasError);
                                }
                            }" 
                            @init="validate()"
                        >
                            <div class="bg-blue-300 px-6 flex items-center border-r border-gray-300">
                                <p class="text-sm">KAEDAH</p>
                            </div>
                            <div class="border-r text-sm flex flex-col">
                                <label for="kaedah1" class="border-b border-gray-300 p-2">Atas Talian</label>
                                <label for="kaedah2" class="border-b border-gray-300 p-2">Fizikal</label>
                                <label for="kaedah3" class="p-2">Hybrid</label>
                            </div>
                            <div class="flex flex-col items-center text-sm">
                                <div class="border-b border-gray-300 p-2">
                                    <input type="radio" id="kaedah1" name="kaedah" value="Atas Talian"
                                        x-model="value"
                                        @change="validate()" 
                                        required 
                                        {{ old('kaedah') == 'Atas Talian' ? 'checked' : '' }}>
                                </div>
                                <div class="border-b border-gray-300 p-2">
                                    <input type="radio" id="kaedah2" name="kaedah" value="Fizikal"
                                        x-model="value"
                                        @change="validate()" 
                                        {{ old('kaedah') == 'Fizikal' ? 'checked' : '' }}>
                                </div>
                                <div class="p-2">
                                    <input type="radio" id="kaedah3" name="kaedah" value="Hybrid"
                                        x-model="value"
                                        @change="validate()" 
                                        {{ old('kaedah') == 'Hybrid' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        
                        <!-- HFP -->
                        <div class="flex flex-row border border-gray-300"
                            x-data="{
                                value: '{{ old('hfp') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value) {
                                        this.hasError = true;
                                        this.errorMessage = 'Please select HFP.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    $data.updateFormError('hfp', this.hasError);
                                }
                            }" 
                            @init="validate()"
                        >
                            <div class="bg-blue-300 px-6 flex items-center border-r border-gray-300">
                                <p class="text-sm">HEBAT FLAGSHIP PROGRAMMES (HFP)</p>
                            </div>
                            <div class="border-r text-sm flex flex-col">
                                <label for="hfp_ya" class="border-b border-gray-300 p-2">Ya</label>
                                <label for="hfp_tidak" class="border-b border-gray-300 p-2">Tidak</label>
                            </div>
                            <div class="flex flex-col items-center text-sm">
                                <div class="border-b border-gray-300 p-2">
                                    <input type="radio" id="hfp_ya" name="hfp" value="Ya"
                                        x-model="value"
                                        @change="validate()" 
                                        required 
                                        {{ old('hfp') == 'Ya' ? 'checked' : '' }}>
                                </div>
                                <div class="border-b border-gray-300 p-2">
                                    <input type="radio" id="hfp_tidak" name="hfp" value="Tidak"
                                        x-model="value"
                                        @change="validate()" 
                                        {{ old('hfp') == 'Tidak' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <!-- Poster -->
                        <div class="flex flex-row border border-gray-300"
                            x-data="{
                                value: '{{ old('poster') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value) {
                                        this.hasError = true;
                                        this.errorMessage = 'Please select Poster.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    $data.updateFormError('poster', this.hasError);
                                }
                            }" 
                            @init="validate()"
                        >
                            <div class="bg-blue-300 p-6 flex items-center border-r border-gray-300">
                                <p class="text-sm">POSTER</p>
                            </div>
                            <div class="border-r text-sm flex flex-col">
                                <label for="poster_ya" class="border-b border-gray-300 p-2">Ya</label>
                                <label for="poster_tidak" class="border-b border-gray-300 p-2">Tidak</label>
                            </div>
                            <div class="flex flex-col items-center text-sm">
                                <div class="border-b border-gray-300 p-2">
                                    <input type="radio" id="poster_ya" name="poster" value="Ya"
                                        x-model="value"
                                        @change="validate()" 
                                        required 
                                        {{ old('poster') == 'Ya' ? 'checked' : '' }}>
                                </div>
                                <div class="border-b border-gray-300 p-2">
                                    <input type="radio" id="poster_tidak" name="poster" value="Tidak"
                                        x-model="value"
                                        @change="validate()" 
                                        {{ old('poster') == 'Tidak' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('kaedah')" class="mt-2" />
                    <x-input-error :messages="$errors->get('hfp')" class="mt-2" />
                    <x-input-error :messages="$errors->get('poster')" class="mt-2 mb-4" />

                    <!-- Pertubuhan Pelajar -->
                    <div class="flex flex-col border border-gray-300 mb-6"
                        x-data="{
                            value: '{{ old('pertubuhan') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value) {
                                    this.hasError = true;
                                    this.errorMessage = 'Please select type of pertubuhan.';
                                } else {
                                    this.hasError = false;
                                    this.errorMessage = '';
                                }
                                $data.updateFormError('pertubuhan', this.hasError);
                            }
                        }" 
                        @init="validate()"
                    >
                        <div class="bg-blue-300 py-1 flex justify-center items-center border-b border-gray-300">
                            <AR class="text-sm">PERTUBUHAN PELAJAR</p>
                        </div>
                        <div class="flex flex-row justify-stretch w-full">
                            <!-- Persatuan & Kelab -->
                            <div class="flex flex-row">
                                <div class="border-r text-sm flex flex-col">
                                    <label for="pertubuhan_persatuan" class="border-b border-gray-300 py-2 px-14">Persatuan</label>
                                    <label for="pertubuhan_kelab" class="border-gray-300 py-2 px-14">Kelab</label>
                                </div>
                                <div class="flex flex-col items-center text-sm">
                                    <div class="border-r border-b border-gray-300 p-2">
                                        <input type="radio" id="pertubuhan_persatuan" name="pertubuhan" value="Persatuan"
                                            x-model="value"
                                            @change="validate()" 
                                            required 
                                            {{ old('pertubuhan') == 'Persatuan' ? 'checked' : '' }}>
                                    </div>
                                    <div class="border-r border-gray-300 p-2">
                                        <input type="radio" id="pertubuhan_kelab" name="pertubuhan" value="Kelab"
                                            x-model="value"
                                            @change="validate()" 
                                            {{ old('pertubuhan') == 'Kelab' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <!-- MPD & Anak Negeri -->
                            <div class="flex flex-row">
                                <div class="border-r text-sm flex flex-col">
                                    <label for="pertubuhan_mpd" class="border-b border-gray-300 py-2 px-16">Majlis Penghuni Desasiswa</label>
                                    <label for="pertubuhan_negeri" class="border-gray-300 py-2 px-16">Anak Negeri</label>
                                </div>
                                <div class="flex flex-col items-center text-sm">
                                    <div class="border-r border-b border-gray-300 p-2">
                                        <input type="radio" id="pertubuhan_mpd" name="pertubuhan" value="Majlis Penghuni Desasiswa"
                                            x-model="value"
                                            @change="validate()" 
                                            required 
                                            {{ old('pertubuhan') == 'Majlis Penghuni Desasiswa' ? 'checked' : '' }}>
                                    </div>
                                    <div class="border-r border-gray-300 p-2">
                                        <input type="radio" id="pertubuhan_negeri" name="pertubuhan" value="Anak Negeri"
                                            x-model="value"
                                            @change="validate()" 
                                            {{ old('pertubuhan') == 'Anak Negeri' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <!-- Badan Beruniform & Sekreteriat -->
                            <div class="flex flex-row">
                                <div class="border-r text-sm flex flex-col">
                                    <label for="pertubuhan_uniform" class="border-b border-gray-300 py-2 px-14">Badan Beruniform</label>
                                    <label for="pertubuhan_sekreteriat" class="border-gray-300 py-2 px-14">Sekreteriat</label>
                                </div>
                                <div class="flex flex-col items-center text-sm">
                                    <div class="border-b border-gray-300 py-2 px-3">
                                        <input type="radio" id="pertubuhan_uniform" name="pertubuhan" value="Badan Beruniform"
                                            x-model="value"
                                            @change="validate()" 
                                            required 
                                            {{ old('pertubuhan') == 'Badan Beruniform' ? 'checked' : '' }}>
                                    </div>
                                    <div class="border-gray-300 py-2 px-3">
                                        <input type="radio" id="pertubuhan_sekreteriat" name="pertubuhan" value="Sekreteriat"
                                            x-model="value"
                                            @change="validate()" 
                                            {{ old('pertubuhan') == 'Sekreteriat' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Elemen Attribute Hebat -->
                    <div class="flex flex-col border border-gray-300 mb-6">
                        <!-- Header -->
                        <div class="flex flex-row border-b border-gray-300">
                            <div class="w-1/5">
                                <div class="bg-blue-300 border-r border-gray-300 p-2">
                                    <p class="text-sm">ELEMEN</p>
                                </div>
                            </div>
                            <div class="flex flex-row justify-between w-4/5">
                                <div class="bg-blue-300 border-r border-gray-300 p-2 w-1/3">
                                    <p class="text-sm">ATTRIBUTE HEBAT</p>
                                </div>
                                <div class=" bg-blue-300 border-r border-gray-300 p-2 w-2/3">
                                    <p class="text-sm">TERAS MYCSD</p>
                                </div>
                                <div class="bg-blue-300 p-2 flex items-center justify-center">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Holistik -->
                        <div class="flex flex-row border-b border-gray-300">
                            <div class="border-r border-gray-300 py-1 px-1 w-1/5 flex flex-col items-center justify-center">
                                <p class="text-sm">HOLISTIC</p>
                                <p class="text-sm">(HOLISTIK)</p>
                            </div>
                            <div class="w-4/5">
                                <div class="flex flex-row">
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Kerja Kumpulan</p>
                                    </div>
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Kepimpinan; Sukan (*)</p>
                                    </div>
                                    <div class="border-b border-gray-300 p-2">
                                        <input type="checkbox" id="holistic_kerja_kump" name="holistic[]" value="Kerja Kumpulan"
                                            class="rounded border-gray-400"
                                            {{ old('holistic') == 'Kerja Kumpulan' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                
                                <div class="flex flex-row">
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Kepimpinan</p>
                                    </div>
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Kepimpinan (Cth: Jawatan yang disandang dalam Pertubuhan Pelajar; Anugerah)</p>
                                    </div>
                                    <div class="border-b border-gray-300 p-2">
                                        <input type="checkbox" id="holistic_kepimpinan" name="holistic[]" value="Kepimpinan"
                                            class="rounded border-gray-400"
                                            {{ old('holistic') == 'Kepimpinan' ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="flex flex-row">
                                    <div class="border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Pembelajaran Sepanjang Hayat</p>
                                    </div>
                                    <div class="border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Kesukarelawanan; Khidmat Masyarakat; Reka Cipta & Inovasi (*)</p>
                                    </div>
                                    <div class="p-2">
                                        <input type="checkbox" id="holistic_pemb_spnjg_hyt" name="holistic[]" value="Pembelajaran Sepanjang Hayat"
                                            class="rounded border-gray-400"
                                            {{ old('holistic') == 'Kepimpinan' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ENTREPRENEURIAL -->
                        <div class="flex flex-row border-b border-gray-300">
                            <div class="border-r border-gray-300 py-1 px-1 w-1/5 flex flex-col items-center justify-center">
                                <p class="text-sm">ENTREPRENEURIAL</p>
                                <p class="text-sm">(KEUSAHAWANAN)</p>
                            </div>
                            <div class="w-4/5">
                                <div class="flex flex-row">
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Minda Keusahawanan</p>
                                    </div>
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Keusahawanan; Reka Cipta & Inovasi (Cth: Projek Menerbitkan Majalah, Produk, Sistem, Fotografi, Videografi Secara Atas Talian Atau Fizikal) (*)</p>
                                    </div>
                                    <div class="border-b border-gray-300 p-2">
                                        <input type="checkbox" id="entrepreneurial_mind_kushwnn" name="entrepreneurial[]" value="Minda Keusahawanan"
                                            class="rounded border-gray-400"
                                            {{ old('entrepreneurial') == 'Minda Keusahawanan' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                
                                <div class="flex flex-row">
                                    <div class="border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Kemahiran Keusahawanan</p>
                                    </div>
                                    <div class="border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Keusahawanan (Cth: Subjek WUS101; Inkubator Usahawan Pelajar; Jualan Hari Konvokesyen; Persembahan Berbayar; Aktiviti yang melibatkan kursus berkredit tidak layak MyCSD)</p>
                                    </div>
                                    <div class="p-2">
                                        <input type="checkbox" id="entrepreneurial_kemahirn_kushwnn" name="entrepreneurial[]" value="Kemahiran Keusahawanan"
                                            class="rounded border-gray-400"
                                            {{ old('entrepreneurial') == 'Kemahiran Keusahawanan' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- BALANCED -->
                        <div class="flex flex-row border-b border-gray-300">
                            <div class="border-r border-gray-300 py-1 px-1 w-1/5 flex flex-col items-center justify-center">
                                <p class="text-sm">BALANCED</p>
                                <p class="text-sm">(SEIMBANG)</p>
                            </div>
                            <div class="w-4/5">
                                <div class="flex flex-row">
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Nilai, Sikap & Kemanusiaan</p>
                                    </div>
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Kesukarelawanan; Khidmat Masyarakat; Kepimpinan (Cth: Perkembangan Diri) (*)</p>
                                    </div>
                                    <div class="border-b border-gray-300 p-2">
                                        <input type="checkbox" id="balanced_nilai_sikap_kmnusaan" name="balanced[]" value="Nilai, Sikap & Kemanusiaan"
                                            class="rounded border-gray-400"
                                            {{ old('balanced') == 'Nilai, Sikap & Kemanusiaan' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                
                                <div class="flex flex-row">
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Etika & Profesionalisme</p>
                                    </div>
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Kepimpinan; Pengucapan Awam; Sukan (*)</p>
                                    </div>
                                    <div class="border-b border-gray-300 p-2">
                                        <input type="checkbox" id="balanced_etika_prof" name="balanced[]" value="Etika & Profesionalisme"
                                            class="rounded border-gray-400"
                                            {{ old('balanced') == 'Nilai, Sikap & Kemanusiaan' ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="flex flex-row">
                                    <div class="border-r border-b border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Pemikiran Saintifik</p>
                                    </div>
                                    <div class="border-r border-b border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Reka Cipta & Inovasi</p>
                                    </div>
                                    <div class="p-2 border-b border-gray-300">
                                        <input type="checkbox" id="balanced_pemikiran_saintifik" name="balanced[]" value="Pemikiran Saintifik"
                                            class="rounded border-gray-400"
                                            {{ old('balanced') == 'Pemikiran Saintifik' ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="flex flex-row">
                                    <div class="border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Apresiasi Seni</p>
                                    </div>
                                    <div class="border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Kebudayaan</p>
                                    </div>
                                    <div class="p-2">
                                        <input type="checkbox" id="balanced_apresiasi_seni" name="balanced[]" value="Apresiasi Seni"
                                            class="rounded border-gray-400"
                                            {{ old('balanced') == 'Apresiasi Seni' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ARTICULATE -->
                        <div class="flex flex-row border-b border-gray-300">
                            <div class="border-r border-gray-300 py-1 px-1 w-1/5 flex flex-col items-center justify-center">
                                <p class="text-sm">ARTICULATE</p>
                                <p class="text-sm">(ARTIKULASI)</p>
                            </div>
                            <div class="w-4/5">
                                <div class="flex flex-row">
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Komunikasi</p>
                                    </div>
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Kepimpinan; Pengucapan Awam (*)</p>
                                    </div>
                                    <div class="border-b border-gray-300 p-2">
                                        <input type="checkbox" id="articulate_komunikasi" name="articulate[]" value="Komunikasi"
                                            class="rounded border-gray-400"
                                            {{ old('articulate') == 'Komunikasi' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                
                                <div class="flex flex-row">
                                    <div class="border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Keyakinan</p>
                                    </div>
                                    <div class="border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Pengucapan Awam; Kebudayaan; Sukan (*)</p>
                                    </div>
                                    <div class="p-2">
                                        <input type="checkbox" id="articulate_keyakinan" name="articulate[]" value="Keyakinan"
                                            class="rounded border-gray-400"
                                            {{ old('articulate') == 'Keyakinan' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- THINKING -->
                        <div class="flex flex-row">
                            <div class="border-r border-gray-300 py-1 px-1 w-1/5 flex flex-col items-center justify-center">
                                <p class="text-sm">THINKING</p>
                                <p class="text-sm">(BERFIKIR)</p>
                            </div>
                            <div class="w-4/5">
                                <div class="flex flex-row">
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Pemikiran Kritis</p>
                                    </div>
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Reka Cipta & Inovasi; Keusahawanan (*)</p>
                                    </div>
                                    <div class="border-b border-gray-300 p-2">
                                        <input type="checkbox" id="thinking_pemikiran_kritis" name="thinking[]" value="Pemikiran Kritis"
                                            class="rounded border-gray-400"
                                            {{ old('thinking') == 'Pemikiran Kritis' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                
                                <div class="flex flex-row">
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Pemikiran Kreatif & Inovatif</p>
                                    </div>
                                    <div class="border-b border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Reka Cipta & Inovasi; Kebudayaan (*)</p>
                                    </div>
                                    <div class="border-b border-gray-300 p-2">
                                        <input type="checkbox" id="thinking_pemikiran_kreatif_inovatif" name="thinking[]" value="Pemikiran Kreatif & Inovatif"
                                            class="rounded border-gray-400"
                                            {{ old('thinking') == 'Pemikiran Kreatif & Inovatif' ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="flex flex-row">
                                    <div class="border-r border-b border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Penyelesaian Masalah</p>
                                    </div>
                                    <div class="border-r border-b border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Reka Cipta & Inovasi; Kesukarelawanan; Khidmat Masyarakat; Keusahawanan (*)</p>
                                    </div>
                                    <div class="p-2 border-b border-gray-300">
                                        <input type="checkbox" id="thinking_penyelesaian_masalah" name="thinking[]" value="Penyelesaian Masalah"
                                            class="rounded border-gray-400"
                                            {{ old('thinking') == 'Penyelesaian Masalah' ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="flex flex-row">
                                    <div class="border-r border-gray-300 py-1 px-2 w-1/3">
                                        <p class="text-sm">Minda Global</p>
                                    </div>
                                    <div class="border-r border-gray-300 py-1 px-2 w-2/3">
                                        <p class="text-sm">Program Antarabangsa (Cth: Internship; Student Exchange; Pertandingan; Persembahan) ; Sukan (*)</p>
                                    </div>
                                    <div class="p-2">
                                        <input type="checkbox" id="thinking_minda_global" name="thinking[]" value="Minda Global"
                                            class="rounded border-gray-400"
                                            {{ old('thinking') == 'Minda Global' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
</div>
@endsection


