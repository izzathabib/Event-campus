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
        <div id="paper-work-form" class="w-full max-w-4xl bg-white rounded-lg border-2 overflow-hidden">
        
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
                <form action="{{ route('society.storeEventApplicationData') }}" method="POST" enctype="multipart/form-data" id="multi-step-form">
                    @csrf
                    <!-- Step 1: Paper work -->
                    <div x-show="currentStep === 1" class="step-transition">
                        
                        
                        <div class="grid grid-cols-1  gap-6">
                            <!-- Tajuk Kertas Kerja -->
                            <div>
                                <label for="tajuk_kk" class="block text-sm font-medium text-gray-700 mb-1">Tajuk Kertas Kerja</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300">
                                    {{ $eventApplications->tajuk_kk }}
                                </div>
                            </div>
                            <!-- Pengenalan & Kumpulan Sasaran/ Penyertaan -->
                            <div>
                                <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line">
                                    {{ $eventApplications->peng_kump_sasar }}
                                </div>
                            </div>
                            <!-- Objektif (Selaras dengan Elemen & Atribut HEBAT) -->
                            <div>
                                <label for="obj" class="block text-sm font-medium text-gray-700 mb-1">Objektif (Selaras dengan Elemen & Atribut HEBAT)</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line">
                                    {{ $eventApplications->obj }}
                                </div>
                            </div>
                            <!-- Impak Dijangkakan -->
                            <div>
                                <label for="impak" class="block text-sm font-medium text-gray-700 mb-1">Impak Dijangkakan</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line">
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
                                        <td class="py-2 font-medium text-gray-700">Tarikh: 
                                            @if ($eventApplications->start_date === $eventApplications->end_date)
                                                {{ \Carbon\Carbon::parse($eventApplications->start_date)->format('d F Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($eventApplications->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($eventApplications->end_date)->format('d F Y') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Masa -->
                                    <tr class="border-b">
                                        <td class="py-2 font-medium text-gray-700">Masa: 
                                            @if ($eventApplications->start_time === $eventApplications->end_time)
                                                {{ \Carbon\Carbon::parse($eventApplications->start_time)->format('h:i A') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($eventApplications->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($eventApplications->end_time)->format('h:i A') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-medium text-gray-700">Lokasi: {{ $eventApplications->lokasi }}</td>
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
                                                        <div class="w-32">
                                                            {{ \Carbon\Carbon::parse($activity->time)->format('h:i A') }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-2 py-2">
                                                        <div class="w-32">
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
                    </div>
                    
                    <!-- Step 2: MyCSD Mapping -->
                    <div x-show="currentStep === 2" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">
                            PEMETAAN MyCSD & ATRIBUT HEBAT PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <!-- TAJUK PROGRAM / AKTIVITI -->
                            <div x-data="{ 
                                value: '{{ old('taj_prog') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 1) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 2000 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('taj_prog', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="taj_prog" class="block text-sm font-medium text-gray-700 mb-1">TAJUK PROGRAM / AKTIVITI</label>
                                <input type="text" id="taj_prog" name="taj_prog" 
                                x-model="value"
                                @input="validate()" 
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('taj_prog')" class="mt-2" />
                            </div>

                            <!-- <div>
                                <label for="nam_pert" class="block text-sm font-medium text-gray-700 mb-1">NAMA PERTUBUHAN</label>
                                <input type="text" id="nam_pert" name="nam_pert" x-model="formData.namPert" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                            </div> -->
                            
                            <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6"> -->
                                <!-- <div>
                                    <label for="kaedah" class="block text-sm font-medium text-gray-700 mb-1">KAEDAH</label>
                                    <select id="kaedah" name="kaedah" x-model="formData.kaedah" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                        <option value="" disabled {{ old('kaedah', $defaultKaedah ?? '') == '' ? 'selected' : '' }} class="bg-white">Sila Pilih Kaedah</option>
                                        <option value="Atas Talian" {{ old('kaedah', $defaultKaedah ?? '') == 'online' ? 'selected' : '' }}>Atas Talian</option>
                                        <option value="Fizikal (Berdasarkan SOP MKN semasa)" {{ old('kaedah', $defaultKaedah ?? '') == 'physical' ? 'selected' : '' }}>Fizikal (Berdasarkan SOP MKN semasa)</option>
                                        <option value="Hybrid (Berdasarkan SOP MKN semasa)" {{ old('kaedah', $defaultKaedah ?? '') == 'hybrid' ? 'selected' : '' }}>Hybrid (Berdasarkan SOP MKN semasa)</option> 
                                    </select>
                                </div> -->

                                <!-- <div> -->
                                    <!-- <p class="block text-sm font-medium text-gray-700 mb-1">HEBAT FLAGSHIP PROGRAMMES (HFP)</p>  -->
                                    {{-- Using flex column for vertical layout --}}
                                    <!-- <div class="space-y-2">  -->
                                        {{-- Option 1: Ya --}}
                                        <!-- <div class="flex items-center"> -->
                                            <!-- <input 
                                                type="radio" 
                                                id="hfp_ya" 
                                                name="hfp" 
                                                value="ya" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300" -->
                                                {{-- Pre-select if it was the old input or a default --}}
                                                <!-- {{ old('hfp', $defaultHfp ?? '') == 'ya' ? 'checked' : '' }} 
                                            >
                                            <label for="hfp_ya" class="ml-3 block text-sm font-medium text-gray-700">
                                                Ya
                                            </label>
                                        </div> -->

                                        {{-- Option 2: Tidak --}}
                                        <!-- <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="hfp_tidak" 
                                                name="hfp" 
                                                value="tidak" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300" -->
                                                {{-- Pre-select if it was the old input or a default --}}
                                                <!-- {{ old('hfp', $defaultHfp ?? '') == 'tidak' ? 'checked' : '' }} 
                                            >
                                            <label for="kaedah_online" class="ml-3 block text-sm font-medium text-gray-700">
                                                Tidak
                                            </label>
                                        </div> -->
                                    <!-- </div>
                                </div>

                                <div>
                                    <p class="block text-sm font-medium text-gray-700 mb-1">POSTER</p>  -->
                                    {{-- Using flex column for vertical layout --}}
                                    <!-- <div class="space-y-2">  -->
                                        {{-- Option 1: Ya --}}
                                        <!-- <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="poster_ya" 
                                                name="poster" 
                                                value="ya" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300" -->
                                                {{-- Pre-select if it was the old input or a default --}}
                                                <!-- {{ old('poster', $defaultPoster ?? '') == 'ya' ? 'checked' : '' }} 
                                            >
                                            <label for="poster_ya" class="ml-3 block text-sm font-medium text-gray-700">
                                                Ya
                                            </label>
                                        </div> -->

                                        {{-- Option 2: Tidak --}}
                                        <!-- <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="poster_tidak" 
                                                name="poster" 
                                                value="tidak" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300" -->
                                                {{-- Pre-select if it was the old input or a default --}}
                                                <!-- {{ old('poster', $defaultPoster ?? '') == 'tidak' ? 'checked' : '' }} 
                                            >
                                            <label for="kaedah_online" class="ml-3 block text-sm font-medium text-gray-700">
                                                Tidak
                                            </label>
                                        </div>
                                    </div> -->
                                <!-- </div>
                            </div>

                            <div>
                                <label for="jen_pertub" class="block text-sm font-medium text-gray-700 mb-1">PERTUBUHAN PELAJAR</label>
                                <select id="jen_pertub" name="jen_pertub" x-model="formData.jenPertub" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                    <option value="" disabled {{ old('jen_pertub', $jenPertub ?? '') == '' ? 'selected' : '' }} class="bg-white">Sila Pilih Jenis Pertubuhan</option>
                                    <option value="Persatuan" {{ old('jen_pertub', $jenPertub ?? '') == 'Persatuan' ? 'selected' : '' }}>Persatuan</option>
                                    <option value="Majlis Penghuni Desasiswa" {{ old('jen_pertub', $jenPertub ?? '') == 'Majlis Penghuni Desasiswa' ? 'selected' : '' }}>Majlis Penghuni Desasiswa</option>
                                    <option value="Badan Beruniform" {{ old('jen_pertub', $jenPertub ?? '') == 'Badan Beruniform' ? 'selected' : '' }}>Badan Beruniform</option> 
                                    <option value="Kelab" {{ old('jen_pertub', $jenPertub ?? '') == 'Kelab' ? 'selected' : '' }}>Kelab</option> 
                                    <option value="Anak Negeri" {{ old('jen_pertub', $jenPertub ?? '') == 'Anak Negeri' ? 'selected' : '' }}>Anak Negeri</option> 
                                    <option value="Sekretariat" {{ old('jen_pertub', $jenPertub ?? '') == 'Sekretariat' ? 'selected' : '' }}>Sekretariat</option> 
                                </select>
                            </div> -->
                        </div>
                    </div>
                    
                    <!-- Step 3: Application to Organize Events -->
                    <div x-show="currentStep === 3" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">PERMOHONAN MENGADAKAN PROGRAM</h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                        <h5 class="text-sm font-semibold text-gray-800 mb-2 mt-2">
                        1. Butiran Pemohon
                        </h5>

                            <!-- Nama -->
                            <div x-data="{ 
                                value: '{{ old('nama') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 1) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 100 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('nama', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                <input type="text" id="nama" name="nama" 
                                x-model="value"
                                @input="validate()"
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>
                            
                            <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="no_ic" class="block text-sm font-medium text-gray-700 mb-1">No. Kad Pengenalan</label>
                                    <input type="text" id="no_ic" name="no_ic" x-model="formData.noIc" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                </div>
                                
                                <div>
                                    <label for="jawatan" class="block text-sm font-medium text-gray-700 mb-1">Jawatan</label>
                                    <input type="text" id="jawatan" name="jawatan" x-model="formData.jawatan" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                </div>

                                <div>
                                    <label for="no_matric" class="block text-sm font-medium text-gray-700 mb-1">No. Matrik</label>
                                    <input type="number" id="no_matric" name="no_matric" x-model="formData.noMatric" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                </div>

                                <div>
                                    <label for="no_matric" class="block text-sm font-medium text-gray-700 mb-1">Tel. Bimbit</label>
                                    <input type="number" id="no_matric" name="no_matric" x-model="formData.noMatric" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                </div>

                                <div>
                                    <label for="no_matric" class="block text-sm font-medium text-gray-700 mb-1">Tel.</label>
                                    <input type="number" id="no_matric" name="no_matric" x-model="formData.noMatric" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500">
                                </div>
                            </div> -->

                            <!-- <div>
                                <label for="alamat_penggal" class="block text-sm font-medium text-gray-700 mb-1">Alamat Penggal</label>
                                <textarea id="alamat_penggal" name="alamat_penggal" rows="5" cols="30" x-model="formData.alamatPenggal" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                </textarea>
                            </div>

                            <div>
                                <label for="alamat_cuti" class="block text-sm font-medium text-gray-700 mb-1">Alamat Semasa Cuti</label>
                                <textarea id="alamat_cuti" name="alamat_cuti" rows="5" cols="30" x-model="formData.alamatCuti" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                </textarea>
                            </div> -->
                        </div>
                    </div>

                    <!-- Form Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <button 
                            x-show="currentStep > 1" 
                            @click="goToPrevStep" 
                            type="button"
                            class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm rounded-md transition-colors duration-300"
                        >
                            Previous
                        </button>
                        
                        <div class="ml-auto">
                            <button 
                                x-show="currentStep < steps.length" 
                                @click="goToNextStep" 
                                type="button"
                                class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-md transition-colors duration-300"
                            >
                                Next
                            </button>
                            
                            <button 
                                x-show="currentStep === steps.length" 
                                type="submit"
                                x-bind:disabled="hasErrors()"
                                class="px-6 py-2 text-sm rounded-md transition-colors duration-300"
                                x-bind:class="{
                                    'bg-purple-600 hover:bg-purple-700 text-white cursor-pointer': !hasErrors(),
                                    'bg-gray-400 text-gray-200 cursor-not-allowed': hasErrors()
                                }"
                                
                            >
                                <span>Submit Application</span>
                            </button>
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
                <form action="{{ route('society.storeEventApplicationData') }}" method="POST" enctype="multipart/form-data" id="multi-step-form">
                    @csrf
                    <!-- Step 1: Paper work -->
                    <div x-show="currentStep === 1" class="step-transition">
                        
                        
                        <div class="grid grid-cols-1  gap-6">
                            <!-- Tajuk Kertas Kerja -->
                            <div>
                                <label for="tajuk_kk" class="block text-sm font-medium text-gray-700 mb-1">Tajuk Kertas Kerja</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300">
                                    {{ $eventApplications->tajuk_kk }}
                                </div>
                            </div>
                            <!-- Pengenalan & Kumpulan Sasaran/ Penyertaan -->
                            <div>
                                <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line">
                                    {{ $eventApplications->peng_kump_sasar }}
                                </div>
                            </div>
                            <!-- Objektif (Selaras dengan Elemen & Atribut HEBAT) -->
                            <div>
                                <label for="obj" class="block text-sm font-medium text-gray-700 mb-1">Objektif (Selaras dengan Elemen & Atribut HEBAT)</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line">
                                    {{ $eventApplications->obj }}
                                </div>
                            </div>
                            <!-- Impak Dijangkakan -->
                            <div>
                                <label for="impak" class="block text-sm font-medium text-gray-700 mb-1">Impak Dijangkakan</label>
                                <div class="w-full px-3 py-2 border rounded-md border-gray-300 whitespace-pre-line">
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
                                        <td class="py-2 font-medium text-gray-700">Tarikh: 
                                            @if ($eventApplications->start_date === $eventApplications->end_date)
                                                {{ \Carbon\Carbon::parse($eventApplications->start_date)->format('d F Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($eventApplications->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($eventApplications->end_date)->format('d F Y') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Masa -->
                                    <tr class="border-b">
                                        <td class="py-2 font-medium text-gray-700">Masa: 
                                            @if ($eventApplications->start_time === $eventApplications->end_time)
                                                {{ \Carbon\Carbon::parse($eventApplications->start_time)->format('h:i A') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($eventApplications->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($eventApplications->end_time)->format('h:i A') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-medium text-gray-700">Lokasi: {{ $eventApplications->lokasi }}</td>
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
                                                        <div class="w-32">
                                                            {{ \Carbon\Carbon::parse($activity->time)->format('h:i A') }}
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-2 py-2">
                                                        <div class="w-32">
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
                    </div>
                    
                    <!-- Step 2: MyCSD Mapping -->
                    <div x-show="currentStep === 2" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">
                            PEMETAAN MyCSD & ATRIBUT HEBAT PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <!-- TAJUK PROGRAM / AKTIVITI -->
                            <div x-data="{ 
                                value: '{{ old('taj_prog') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 1) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 2000 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('taj_prog', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="taj_prog" class="block text-sm font-medium text-gray-700 mb-1">TAJUK PROGRAM / AKTIVITI</label>
                                <input type="text" id="taj_prog" name="taj_prog" 
                                x-model="value"
                                @input="validate()" 
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('taj_prog')" class="mt-2" />
                            </div>

                            <!-- <div>
                                <label for="nam_pert" class="block text-sm font-medium text-gray-700 mb-1">NAMA PERTUBUHAN</label>
                                <input type="text" id="nam_pert" name="nam_pert" x-model="formData.namPert" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                            </div> -->
                            
                            <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6"> -->
                                <!-- <div>
                                    <label for="kaedah" class="block text-sm font-medium text-gray-700 mb-1">KAEDAH</label>
                                    <select id="kaedah" name="kaedah" x-model="formData.kaedah" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                        <option value="" disabled {{ old('kaedah', $defaultKaedah ?? '') == '' ? 'selected' : '' }} class="bg-white">Sila Pilih Kaedah</option>
                                        <option value="Atas Talian" {{ old('kaedah', $defaultKaedah ?? '') == 'online' ? 'selected' : '' }}>Atas Talian</option>
                                        <option value="Fizikal (Berdasarkan SOP MKN semasa)" {{ old('kaedah', $defaultKaedah ?? '') == 'physical' ? 'selected' : '' }}>Fizikal (Berdasarkan SOP MKN semasa)</option>
                                        <option value="Hybrid (Berdasarkan SOP MKN semasa)" {{ old('kaedah', $defaultKaedah ?? '') == 'hybrid' ? 'selected' : '' }}>Hybrid (Berdasarkan SOP MKN semasa)</option> 
                                    </select>
                                </div> -->

                                <!-- <div> -->
                                    <!-- <p class="block text-sm font-medium text-gray-700 mb-1">HEBAT FLAGSHIP PROGRAMMES (HFP)</p>  -->
                                    {{-- Using flex column for vertical layout --}}
                                    <!-- <div class="space-y-2">  -->
                                        {{-- Option 1: Ya --}}
                                        <!-- <div class="flex items-center"> -->
                                            <!-- <input 
                                                type="radio" 
                                                id="hfp_ya" 
                                                name="hfp" 
                                                value="ya" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300" -->
                                                {{-- Pre-select if it was the old input or a default --}}
                                                <!-- {{ old('hfp', $defaultHfp ?? '') == 'ya' ? 'checked' : '' }} 
                                            >
                                            <label for="hfp_ya" class="ml-3 block text-sm font-medium text-gray-700">
                                                Ya
                                            </label>
                                        </div> -->

                                        {{-- Option 2: Tidak --}}
                                        <!-- <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="hfp_tidak" 
                                                name="hfp" 
                                                value="tidak" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300" -->
                                                {{-- Pre-select if it was the old input or a default --}}
                                                <!-- {{ old('hfp', $defaultHfp ?? '') == 'tidak' ? 'checked' : '' }} 
                                            >
                                            <label for="kaedah_online" class="ml-3 block text-sm font-medium text-gray-700">
                                                Tidak
                                            </label>
                                        </div> -->
                                    <!-- </div>
                                </div>

                                <div>
                                    <p class="block text-sm font-medium text-gray-700 mb-1">POSTER</p>  -->
                                    {{-- Using flex column for vertical layout --}}
                                    <!-- <div class="space-y-2">  -->
                                        {{-- Option 1: Ya --}}
                                        <!-- <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="poster_ya" 
                                                name="poster" 
                                                value="ya" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300" -->
                                                {{-- Pre-select if it was the old input or a default --}}
                                                <!-- {{ old('poster', $defaultPoster ?? '') == 'ya' ? 'checked' : '' }} 
                                            >
                                            <label for="poster_ya" class="ml-3 block text-sm font-medium text-gray-700">
                                                Ya
                                            </label>
                                        </div> -->

                                        {{-- Option 2: Tidak --}}
                                        <!-- <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="poster_tidak" 
                                                name="poster" 
                                                value="tidak" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300" -->
                                                {{-- Pre-select if it was the old input or a default --}}
                                                <!-- {{ old('poster', $defaultPoster ?? '') == 'tidak' ? 'checked' : '' }} 
                                            >
                                            <label for="kaedah_online" class="ml-3 block text-sm font-medium text-gray-700">
                                                Tidak
                                            </label>
                                        </div>
                                    </div> -->
                                <!-- </div>
                            </div>

                            <div>
                                <label for="jen_pertub" class="block text-sm font-medium text-gray-700 mb-1">PERTUBUHAN PELAJAR</label>
                                <select id="jen_pertub" name="jen_pertub" x-model="formData.jenPertub" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                    <option value="" disabled {{ old('jen_pertub', $jenPertub ?? '') == '' ? 'selected' : '' }} class="bg-white">Sila Pilih Jenis Pertubuhan</option>
                                    <option value="Persatuan" {{ old('jen_pertub', $jenPertub ?? '') == 'Persatuan' ? 'selected' : '' }}>Persatuan</option>
                                    <option value="Majlis Penghuni Desasiswa" {{ old('jen_pertub', $jenPertub ?? '') == 'Majlis Penghuni Desasiswa' ? 'selected' : '' }}>Majlis Penghuni Desasiswa</option>
                                    <option value="Badan Beruniform" {{ old('jen_pertub', $jenPertub ?? '') == 'Badan Beruniform' ? 'selected' : '' }}>Badan Beruniform</option> 
                                    <option value="Kelab" {{ old('jen_pertub', $jenPertub ?? '') == 'Kelab' ? 'selected' : '' }}>Kelab</option> 
                                    <option value="Anak Negeri" {{ old('jen_pertub', $jenPertub ?? '') == 'Anak Negeri' ? 'selected' : '' }}>Anak Negeri</option> 
                                    <option value="Sekretariat" {{ old('jen_pertub', $jenPertub ?? '') == 'Sekretariat' ? 'selected' : '' }}>Sekretariat</option> 
                                </select>
                            </div> -->
                        </div>
                    </div>
                    
                    <!-- Step 3: Application to Organize Events -->
                    <div x-show="currentStep === 3" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">PERMOHONAN MENGADAKAN PROGRAM</h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                        <h5 class="text-sm font-semibold text-gray-800 mb-2 mt-2">
                        1. Butiran Pemohon
                        </h5>

                            <!-- Nama -->
                            <div x-data="{ 
                                value: '{{ old('nama') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 1) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 100 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('nama', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                <input type="text" id="nama" name="nama" 
                                x-model="value"
                                @input="validate()"
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>
                            
                            <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="no_ic" class="block text-sm font-medium text-gray-700 mb-1">No. Kad Pengenalan</label>
                                    <input type="text" id="no_ic" name="no_ic" x-model="formData.noIc" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                </div>
                                
                                <div>
                                    <label for="jawatan" class="block text-sm font-medium text-gray-700 mb-1">Jawatan</label>
                                    <input type="text" id="jawatan" name="jawatan" x-model="formData.jawatan" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                </div>

                                <div>
                                    <label for="no_matric" class="block text-sm font-medium text-gray-700 mb-1">No. Matrik</label>
                                    <input type="number" id="no_matric" name="no_matric" x-model="formData.noMatric" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                </div>

                                <div>
                                    <label for="no_matric" class="block text-sm font-medium text-gray-700 mb-1">Tel. Bimbit</label>
                                    <input type="number" id="no_matric" name="no_matric" x-model="formData.noMatric" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                </div>

                                <div>
                                    <label for="no_matric" class="block text-sm font-medium text-gray-700 mb-1">Tel.</label>
                                    <input type="number" id="no_matric" name="no_matric" x-model="formData.noMatric" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500">
                                </div>
                            </div> -->

                            <!-- <div>
                                <label for="alamat_penggal" class="block text-sm font-medium text-gray-700 mb-1">Alamat Penggal</label>
                                <textarea id="alamat_penggal" name="alamat_penggal" rows="5" cols="30" x-model="formData.alamatPenggal" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                </textarea>
                            </div>

                            <div>
                                <label for="alamat_cuti" class="block text-sm font-medium text-gray-700 mb-1">Alamat Semasa Cuti</label>
                                <textarea id="alamat_cuti" name="alamat_cuti" rows="5" cols="30" x-model="formData.alamatCuti" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                </textarea>
                            </div> -->
                        </div>
                    </div>

                    <!-- Form Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <button 
                            x-show="currentStep > 1" 
                            @click="goToPrevStep" 
                            type="button"
                            class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm rounded-md transition-colors duration-300"
                        >
                            Previous
                        </button>
                        
                        <div class="ml-auto">
                            <button 
                                x-show="currentStep < steps.length" 
                                @click="goToNextStep" 
                                type="button"
                                class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-md transition-colors duration-300"
                            >
                                Next
                            </button>
                            
                            <button 
                                x-show="currentStep === steps.length" 
                                type="submit"
                                x-bind:disabled="hasErrors()"
                                class="px-6 py-2 text-sm rounded-md transition-colors duration-300"
                                x-bind:class="{
                                    'bg-purple-600 hover:bg-purple-700 text-white cursor-pointer': !hasErrors(),
                                    'bg-gray-400 text-gray-200 cursor-not-allowed': hasErrors()
                                }"
                                
                            >
                                <span>Submit Application</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    
</div>
@endsection


