@extends('layouts.app')

@section('styles')
  <style>
      [x-cloak] { display: none !important; }
      .step-transition {
          transition: all 0.3s ease-in-out;
      }
  </style>
@endsection

@section('content')
<div class="grid grid-cols-6">
  <div class="col-span-5 col-start-2">
    <h1 class="text-lg font-semibold ml-4">Event Application</h1>
    <div class="flex items-center justify-center p-4 mt-3 w-full">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden" x-data="multiStepForm()" x-cloak>
        
            <!-- Form Header with Progress -->
            <div class=" p-6 text-gray-500">
                <div class="relative pt-1">
                    <div class="flex items-center justify-between mb-7">
                        <div class="text-xs font-semibold inline-block py-1">
                            Step <span x-text="currentStep"></span> of <span x-text="steps.length"></span>
                        </div>
                    </div>
        
                    
                    <!-- Step Indicators -->
                    <div class="flex justify-between">
                        <template x-for="(step, index) in steps" :key="index">
                            <div class="flex flex-col items-center">
                                <div 
                                    :class="{
                                        'bg-lime-500 text-white border-lime-500': currentStep > index + 1,
                                        'bg-white text-purple-600 border-purple-300': currentStep <= index + 1,
                                        'ring-2 ring-purple-600 ring-offset-2': currentStep === index + 1
                                    }"
                                    class="rounded-full h-8 w-8 flex items-center justify-center border text-sm font-bold transition-all duration-300"
                                >
                                    <span x-show="currentStep > index + 1">✓</span>
                                    <span x-show="currentStep <= index + 1" x-text="index + 1"></span>
                                </div>
                                <div class="text-xs mt-4 font-medium" x-text="step.title"></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            
            <!-- Form Body -->
            <div class="p-6">
                <form id="multi-step-form" @submit.prevent="submitForm">
                    <!-- Step 1: Personal Information -->
                    <div x-show="currentStep === 1" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">KERTAS KERJA PROGRAM/ PROJEK/ AKTIVITI
                        PERTUBUHAN PELAJAR UNIVERSITI SAINS MALAYSIA</h3>
                        
                        <div class="grid grid-cols-1  gap-6">
                            <div>
                                <label for="tajuk_kk" class="block text-sm font-medium text-gray-700 mb-1">Tajuk Kertas Kerja</label>
                                <input type="text" id="tajuk_kk" name="tajuk_kk" x-model="formData.tajukKk" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                            </div>
                            
                            <div>
                                <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label>
                                <textarea id="peng_kump_sasar" name="peng_kump_sasar" rows="10" cols="50" x-model="formData.pengKumpSasar" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                </textarea>
                            </div>
                            
                            <div>
                                <label for="obj" class="block text-sm font-medium text-gray-700 mb-1">Objektif (Selaras dengan Elemen & Atribut HEBAT)</label>
                                <textarea id="obj" name="obj" rows="5" cols="50" x-model="formData.obj" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                </textarea>
                            </div>
                            
                            <div>
                                <label for="impak" class="block text-sm font-medium text-gray-700 mb-1">Impak Dijangkakan</label>
                                <textarea id="impak" name="impak" rows="10" cols="50" x-model="formData.impak" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                                </textarea>
                            </div>
                        </div>
                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-14">
                          TENTATIF PROGRAM/ PROJEK/ AKTIVITI
                        </h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          <div>
                              <label for="tarikh" class="block text-sm font-medium text-gray-700 mb-1">Tarikh/ Hari</label>
                              <input type="date" id="tarikh" name="tarikh" x-model="formData.tarikh" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                  required>
                          </div>

                          <div>
                              <label for="masa" class="block text-sm font-medium text-gray-700 mb-1">Masa</label>
                              <input type="time" id="masa" name="masa" x-model="formData.masa" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                  required>
                          </div>

                          <div>
                              <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                              <input type="text" id="lokasi" name="lokasi" x-model="formData.lokasi" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                  required>
                          </div>
                        </div>
                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-8">
                        Atur Cara
                        </h5>
                        <div>
                            <!-- <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label> -->
                            <textarea id="atur_cara" name="atur_cara" rows="10" cols="50" x-model="formData.aturCara" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                required>
                            </textarea>
                        </div>

                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-14">
                          JAWATANKUASA PELAKSANA
                        </h5>
                        <div>
                            <!-- <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label> -->
                            <textarea id="jawat_pelak" name="jawat_pelak" rows="10" cols="50" x-model="formData.jawatPelak" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                required>
                            </textarea>
                        </div>

                        <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-14">
                            CADANGAN BELANJAWAN
                        </h5>
                        <div>
                            <!-- <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label> -->
                            <textarea id="cada_belan" name="cada_belan" rows="10" cols="50" x-model="formData.cadaBelan" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                required>
                            </textarea>
                        </div>
                    </div>
                    
                    <!-- Step 2: Address Information -->
                    <div x-show="currentStep === 2" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">
                            PEMETAAN MyCSD & ATRIBUT HEBAT PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="taj_prog" class="block text-sm font-medium text-gray-700 mb-1">TAJUK PROGRAM / AKTIVITI</label>
                                <input type="text" id="taj_prog" name="taj_prog" x-model="formData.tajProg" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                            </div>

                            <div>
                                <label for="nam_pert" class="block text-sm font-medium text-gray-700 mb-1">NAMA PERTUBUHAN</label>
                                <input type="text" id="nam_pert" name="nam_pert" x-model="formData.namPert" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="kaedah" class="block text-sm font-medium text-gray-700 mb-1">KAEDAH</label>
                                    <select id="kaedah" name="kaedah" x-model="formData.kaedah" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                        required>
                                        <option value="" disabled {{ old('kaedah', $defaultKaedah ?? '') == '' ? 'selected' : '' }} class="bg-white">Sila Pilih Kaedah</option>
                                        <option value="Atas Talian" {{ old('kaedah', $defaultKaedah ?? '') == 'online' ? 'selected' : '' }}>Atas Talian</option>
                                        <option value="Fizikal (Berdasarkan SOP MKN semasa)" {{ old('kaedah', $defaultKaedah ?? '') == 'physical' ? 'selected' : '' }}>Fizikal (Berdasarkan SOP MKN semasa)</option>
                                        <option value="Hybrid (Berdasarkan SOP MKN semasa)" {{ old('kaedah', $defaultKaedah ?? '') == 'hybrid' ? 'selected' : '' }}>Hybrid (Berdasarkan SOP MKN semasa)</option> 
                                    </select>
                                </div>

                                <div>
                                    <p class="block text-sm font-medium text-gray-700 mb-1">HEBAT FLAGSHIP PROGRAMMES (HFP)</p> 
                                    {{-- Using flex column for vertical layout --}}
                                    <div class="space-y-2"> 
                                        {{-- Option 1: Ya --}}
                                        <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="hfp_ya" 
                                                name="hfp" 
                                                value="ya" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300"
                                                {{-- Pre-select if it was the old input or a default --}}
                                                {{ old('hfp', $defaultHfp ?? '') == 'ya' ? 'checked' : '' }} 
                                            >
                                            <label for="hfp_ya" class="ml-3 block text-sm font-medium text-gray-700">
                                                Ya
                                            </label>
                                        </div>

                                        {{-- Option 2: Tidak --}}
                                        <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="hfp_tidak" 
                                                name="hfp" 
                                                value="tidak" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300"
                                                {{-- Pre-select if it was the old input or a default --}}
                                                {{ old('hfp', $defaultHfp ?? '') == 'tidak' ? 'checked' : '' }} 
                                            >
                                            <label for="kaedah_online" class="ml-3 block text-sm font-medium text-gray-700">
                                                Tidak
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <p class="block text-sm font-medium text-gray-700 mb-1">POSTER</p> 
                                    {{-- Using flex column for vertical layout --}}
                                    <div class="space-y-2"> 
                                        {{-- Option 1: Ya --}}
                                        <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="poster_ya" 
                                                name="poster" 
                                                value="ya" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300"
                                                {{-- Pre-select if it was the old input or a default --}}
                                                {{ old('poster', $defaultPoster ?? '') == 'ya' ? 'checked' : '' }} 
                                            >
                                            <label for="poster_ya" class="ml-3 block text-sm font-medium text-gray-700">
                                                Ya
                                            </label>
                                        </div>

                                        {{-- Option 2: Tidak --}}
                                        <div class="flex items-center">
                                            <input 
                                                type="radio" 
                                                id="poster_tidak" 
                                                name="poster" 
                                                value="tidak" 
                                                class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300"
                                                {{-- Pre-select if it was the old input or a default --}}
                                                {{ old('poster', $defaultPoster ?? '') == 'tidak' ? 'checked' : '' }} 
                                            >
                                            <label for="kaedah_online" class="ml-3 block text-sm font-medium text-gray-700">
                                                Tidak
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3: Education -->
                    <div x-show="currentStep === 3" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">PERMOHONAN MENGADAKAN PROGRAM</h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                        <h5 class="text-sm font-semibold text-gray-800 mb-2 mt-2">
                        1. Butiran Pemohon
                        </h5>
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                <input type="text" id="nama" name="nama" x-model="formData.nama" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            </div>

                            <div>
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
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 4: Professional Experience -->
                    <div x-show="currentStep === 4" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Professional Experience</h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="current_employer" class="block text-sm font-medium text-gray-700 mb-1">Current Employer</label>
                                <input type="text" id="current_employer" name="current_employer" x-model="formData.currentEmployer" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>
                            
                            <div>
                                <label for="job_title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                                <input type="text" id="job_title" name="job_title" x-model="formData.jobTitle" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="years_experience" class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label>
                                    <input type="number" id="years_experience" name="years_experience" x-model="formData.yearsExperience" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        min="0" max="50" required>
                                </div>
                                
                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                                    <select id="industry" name="industry" x-model="formData.industry" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required>
                                        <option value="">Select Industry</option>
                                        <option value="technology">Technology</option>
                                        <option value="healthcare">Healthcare</option>
                                        <option value="finance">Finance</option>
                                        <option value="education">Education</option>
                                        <option value="retail">Retail</option>
                                        <!-- Add more industries as needed -->
                                    </select>
                                </div>
                            </div>
                            
                            <div>
                                <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">Key Skills (comma separated)</label>
                                <textarea id="skills" name="skills" x-model="formData.skills" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 5: Review and Submit -->
                    <div x-show="currentStep === 5" class="step-transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Review Your Information</h3>
                        
                        <div class="space-y-6">
                            <!-- Personal Information Review -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-medium text-gray-800 mb-2">Personal Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Name:</span> 
                                        <span class="font-medium" x-text="formData.firstName + ' ' + formData.lastName"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Email:</span> 
                                        <span class="font-medium" x-text="formData.email"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Phone:</span> 
                                        <span class="font-medium" x-text="formData.phone"></span>
                                    </div>
                                </div>
                                <button type="button" @click="goToStep(1)" class="text-sm text-blue-600 hover:underline mt-2">Edit</button>
                            </div>
                            
                            <!-- Address Information Review -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-medium text-gray-800 mb-2">Address Information</h4>
                                <div class="grid grid-cols-1 gap-2 text-sm">
                                    <div>
                                        <span class="text-gray-600">Address:</span> 
                                        <span class="font-medium" x-text="formData.address"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">City, State, Postal Code:</span> 
                                        <span class="font-medium" x-text="formData.city + ', ' + formData.state + ' ' + formData.postalCode"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Country:</span> 
                                        <span class="font-medium" x-text="formData.country"></span>
                                    </div>
                                </div>
                                <button type="button" @click="goToStep(2)" class="text-sm text-blue-600 hover:underline mt-2">Edit</button>
                            </div>
                            
                            <!-- Education Information Review -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-medium text-gray-800 mb-2">Education Information</h4>
                                <div class="grid grid-cols-1 gap-2 text-sm">
                                    <div>
                                        <span class="text-gray-600">Education Level:</span> 
                                        <span class="font-medium" x-text="getEducationDisplayName(formData.highestEducation)"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Institution:</span> 
                                        <span class="font-medium" x-text="formData.institution"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Field of Study:</span> 
                                        <span class="font-medium" x-text="formData.fieldOfStudy"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Graduation Year:</span> 
                                        <span class="font-medium" x-text="formData.graduationYear"></span>
                                    </div>
                                </div>
                                <button type="button" @click="goToStep(3)" class="text-sm text-blue-600 hover:underline mt-2">Edit</button>
                            </div>
                            
                            <!-- Professional Experience Review -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-medium text-gray-800 mb-2">Professional Experience</h4>
                                <div class="grid grid-cols-1 gap-2 text-sm">
                                    <div>
                                        <span class="text-gray-600">Current Employer:</span> 
                                        <span class="font-medium" x-text="formData.currentEmployer"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Job Title:</span> 
                                        <span class="font-medium" x-text="formData.jobTitle"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Years of Experience:</span> 
                                        <span class="font-medium" x-text="formData.yearsExperience"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Industry:</span> 
                                        <span class="font-medium" x-text="formData.industry"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Skills:</span> 
                                        <span class="font-medium" x-text="formData.skills"></span>
                                    </div>
                                </div>
                                <button type="button" @click="goToStep(4)" class="text-sm text-blue-600 hover:underline mt-2">Edit</button>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center mb-4">
                                    <input type="checkbox" id="agree_terms" name="agree_terms" x-model="formData.agreeTerms" 
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                                    <label for="agree_terms" class="ml-2 block text-sm text-gray-700">
                                        I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
                                    </label>
                                </div>
                            </div>
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
                                class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-md transition-colors duration-300"
                            >
                                Submit Application
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Success Modal -->
        <div x-show="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak>
            <div class="bg-white rounded-lg p-8 max-w-md w-full">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Application Submitted!</h3>
                    <p class="text-gray-600 mb-6">Thank you for your application. We'll review your information and get back to you soon.</p>
                    
                    <button 
                        @click="resetForm" 
                        type="button"
                        class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-300"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
        
        <script>
            function multiStepForm() {
                return {
                    currentStep: 1,
                    showSuccessModal: false,
                    steps: [
                        { title: 'Paper Work' },
                        { title: 'MyCSD Mapping' },
                        { title: 'Application to Organize Events' },
                    ],
                    formData: {
                        // Personal information
                        firstName: '',
                        lastName: '',
                        email: '',
                        phone: '',
                        
                        // Address information
                        address: '',
                        city: '',
                        state: '',
                        postalCode: '',
                        country: '',
                        
                        // Education information
                        highestEducation: '',
                        institution: '',
                        fieldOfStudy: '',
                        graduationYear: '',
                        
                        // Professional experience
                        currentEmployer: '',
                        jobTitle: '',
                        yearsExperience: '',
                        industry: '',
                        skills: '',
                        
                        // Terms agreement
                        agreeTerms: false
                    },
                    
                    getEducationDisplayName(value) {
                        const educationMap = {
                            'high_school': 'High School',
                            'associate': 'Associate Degree',
                            'bachelor': 'Bachelor\'s Degree',
                            'master': 'Master\'s Degree',
                            'doctorate': 'Doctorate'
                        };
                        
                        return educationMap[value] || value;
                    },
                    
                    goToNextStep() {
                        if (this.currentStep < this.steps.length) {
                            this.currentStep++;
                            window.scrollTo(0, 0);
                        }
                    },
                    
                    goToPrevStep() {
                        if (this.currentStep > 1) {
                            this.currentStep--;
                            window.scrollTo(0, 0);
                        }
                    },
                    
                    goToStep(step) {
                        if (step >= 1 && step <= this.steps.length) {
                            this.currentStep = step;
                            window.scrollTo(0, 0);
                        }
                    },
                    
                    submitForm() {
                        // Form validation
                        if (!this.formData.agreeTerms) {
                            alert('Please agree to the Terms and Conditions to continue.');
                            return;
                        }
                        
                        // Here you would normally send the data to your Laravel backend
                        console.log('Form submitted!', this.formData);
                        
                        // For demo purposes, we'll just show a success message
                        this.showSuccessModal = true;
                    },
                    
                    resetForm() {
                        this.currentStep = 1;
                        this.showSuccessModal = false;
                        
                        // Reset form data
                        Object.keys(this.formData).forEach(key => {
                            if (typeof this.formData[key] === 'boolean') {
                                this.formData[key] = false;
                            } else {
                                this.formData[key] = '';
                            }
                        });
                    }
                };
            }
        </script>
    </div>
  </div>
</div>


@endsection


</html>