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

<h1 class="text-lg font-semibold ml-4">Event Application</h1>
<div class="flex items-center justify-center p-4 mt-3 w-full">
    <div class="w-full max-w-4xl bg-white rounded-lg border border-gray-300 overflow-hidden" x-data="multiStepForm()" x-cloak>
    
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
            <form action="{{ route('society.storeEventApplicationData') }}" method="POST" enctype="multipart/form-data" id="multi-step-form">
                @csrf
                <!-- Step 1: Paper work -->
                <div x-show="currentStep === 1" class="step-transition">
                    <div class="flex flex-col items-center">
                        <h3 class="text-xl font-bold text-gray-800">KERTAS KERJA PROGRAM/ PROJEK/ AKTIVITI</h3>
                        <h3 class="text-xl font-bold text-gray-800 mb-6">PERTUBUHAN PELAJAR UNIVERSITI SAINS MALAYSIA</h3>
                    </div>
                    
                    <div class="grid grid-cols-1  gap-6">
                        <!-- Tajuk Kertas Kerja -->
                        <div x-data="{ 
                            value: '{{ old('tajuk_kk') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value || this.value.trim() === '') {
                                    this.hasError = true;
                                    this.errorMessage = 'This field is required.';
                                } else if (this.value.length > 100) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field must not exceed 100 characters.';
                                } else {
                                    this.hasError = false;
                                    this.errorMessage = '';
                                }
                                $data.updateFormError('tajuk_kk', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="tajuk_kk" class="block text-sm font-medium text-gray-700 mb-1">Tajuk Kertas Kerja</label>
                            <input type="text" id="tajuk_kk" name="tajuk_kk"
                                x-model="value"
                                x-ref="tajukKkInput"
                                @input="document.getElementById('nama_program').value = $refs.tajukKkInput.value"
                                @input="validate()"
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                                class="cursor-auto text-sm" 
                                required>
                            <!-- Real-time error message -->
                            <p
                                x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600"
                            ></p>
                            <!-- Server-side error message -->
                            <x-input-error :messages="$errors->get('tajuk_kk')" class="mt-2" />
                        </div>
                        <!-- Pengenalan & Kumpulan Sasaran/ Penyertaan -->
                        <div x-data="{ 
                            value: '{{ old('peng_kump_sasar') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value || this.value.trim() === '') {
                                    this.hasError = true;
                                    this.errorMessage = 'This field is required.';
                                } else if (this.value.length > 2000) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field must not exceed 2000 characters.';
                                } else {
                                    this.hasError = false;
                                    this.errorMessage = '';
                                }
                                // Update the parent form's error tracking
                                $data.updateFormError('peng_kump_sasar', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label>
                            <textarea 
                            id="peng_kump_sasar" 
                            name="peng_kump_sasar" 
                            rows="10" cols="50"
                            x-model="value"
                            @input="validate()" 
                            x-bind:class="hasError 
                                ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                            required
                            class="text-sm cursor-auto"
                            ></textarea>
                            <!-- Real-time error message -->
                            <p
                                x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600"
                            ></p>
                            <!-- Server-side error message -->
                            <x-input-error :messages="$errors->get('peng_kump_sasar')" class="mt-2" />
                        </div>
                        <!-- Objektif (Selaras dengan Elemen & Atribut HEBAT) -->
                        <div x-data="{ 
                            value: '{{ old('obj') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value || this.value.trim() === '') {
                                    this.hasError = true;
                                    this.errorMessage = 'This field is required.';
                                } else if (this.value.length > 1000) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field must not exceed 1000 characters.';
                                } else {
                                    this.hasError = false;
                                    this.errorMessage = '';
                                }
                                // Update the parent form's error tracking
                                $data.updateFormError('obj', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="obj" class="block text-sm font-medium text-gray-700 mb-1">Objektif (Selaras dengan Elemen & Atribut HEBAT)</label>
                            <textarea 
                            id="obj" 
                            name="obj" 
                            rows="5" cols="50"
                            x-model="value"
                            @input="validate()" 
                            x-bind:class="hasError 
                                ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                            required
                            class="text-sm cursor-auto"
                            ></textarea>
                            <!-- Real-time error message -->
                            <p
                                x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600"
                            ></p>
                            <!-- Server-side error message -->
                            <x-input-error :messages="$errors->get('obj')" class="mt-2" />
                        </div>
                        <!-- Impak Dijangkakan -->
                        <div x-data="{ 
                            value: '{{ old('impak') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value || this.value.trim() === '') {
                                    this.hasError = true;
                                    this.errorMessage = 'This field is required.';
                                } else if (this.value.length > 2000) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field must not exceed 2000 characters.';
                                } else {
                                    this.hasError = false;
                                    this.errorMessage = '';
                                }
                                // Update the parent form's error tracking
                                $data.updateFormError('impak', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="impak" class="block text-sm font-medium text-gray-700 mb-1">Impak Dijangkakan</label>
                            <textarea 
                            id="impak" 
                            name="impak" 
                            rows="10" cols="50"
                            x-model="value"
                            @input="validate()" 
                            x-bind:class="hasError 
                                ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                            required
                            class="text-sm cursor-auto"
                            ></textarea>
                            <!-- Real-time error message -->
                            <p
                                x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600"
                            ></p>
                            <!-- Server-side error message -->
                            <x-input-error :messages="$errors->get('impak')" class="mt-2" />
                        </div>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 mb-4 mt-14">Lampiran A</p>
                    <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-8">
                        TENTATIF PROGRAM/ PROJEK/ AKTIVITI
                    </h5>
                    <!-- Tarikh and Masa in 1 line -->
                    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 justify-between">

                        <!-- Tarikh Mula -->
                        <div class="w-48"
                        x-data="{ 
                            value: '{{ old('start_date') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value) {
                                    this.hasError = true;
                                    this.errorMessage = 'Start date is required.';
                                } else {
                                    const today = new Date();
                                    const selectedDate = new Date(this.value);
                                    if (selectedDate < today) {
                                        this.hasError = true;
                                        this.errorMessage = 'Date cannot be in the past.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                }
                                $data.updateFormError('start_date', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tarikh Mula</label>
                            <input type="date" 
                                id="start_date" 
                                name="start_date"
                                x-model="value"
                                @input="validate()"
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                                required
                                class="text-sm cursor-auto">
                            <p x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600">
                            </p>
                        </div>

                        <!-- Masa Mula -->
                        <div class="w-40"
                        x-data="{ 
                            value: '{{ old('start_time') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value) {
                                    this.hasError = true;
                                    this.errorMessage = 'Start time is required.';
                                } else {
                                    this.hasError = false;
                                    this.errorMessage = '';
                                }
                                $data.updateFormError('start_time', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Masa Mula</label>
                            <input type="time" 
                                id="start_time" 
                                name="start_time"
                                x-model="value"
                                @input="validate()"
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                                required
                                class="text-sm cursor-auto">
                            <p x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600">
                            </p>
                        </div>

                        <div class="w-6 flex items-center">
                            <span class="inline-block w-5 h-px bg-gray-400"></span>
                        </div>

                        <!-- Tarikh Tamat -->
                        <div class="w-48"
                        x-data="{ 
                            value: '{{ old('end_date') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field is required.';
                                } else {
                                    // Get the start date value from the start_date input
                                    const startDate = new Date(document.getElementById('start_date').value);
                                    const endDate = new Date(this.value);
                                    
                                    if (endDate < startDate) {
                                        this.hasError = true;
                                        this.errorMessage = 'Tarikh tamat cannot be before tarikh mula.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                }
                                $data.updateFormError('end_date', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tarikh Tamat</label>
                            <input type="date" 
                                id="end_date" 
                                name="end_date"
                                x-model="value"
                                @input="validate()"
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                                required
                                class="text-sm cursor-auto">
                            <p x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600">
                            </p>
                        </div>

                        <!-- Masa Tamat -->
                        <div class="w-40" 
                        x-data="{ 
                            value: '{{ old('end_time') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (!this.value) {
                                    this.hasError = true;
                                    this.errorMessage = 'End time is required.';
                                } else {
                                    // Get start date and end date
                                    const startDate = document.getElementById('start_date').value;
                                    const endDate = document.getElementById('end_date').value;
                                
                                    // Get start time
                                    const startTime = document.getElementById('start_time').value;
                                
                                    // If same day, check time
                                    if (startDate === endDate) {
                                        if (this.value <= startTime) {
                                            this.hasError = true;
                                            this.errorMessage = 'End time must be after start time.';
                                        } else {
                                            this.hasError = false;
                                            this.errorMessage = '';
                                        }
                                    }
                                } 
                                $data.updateFormError('end_time', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Masa Tamat</label>
                            <input type="time" 
                                id="end_time" 
                                name="end_time"
                                x-model="value"
                                @input="validate()"
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                                required
                                class="text-sm cursor-auto">
                            <p x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600">
                            </p>
                        </div>
                        
                    </div>

                    <!-- Lokasi -->
                    <div x-data="{ 
                        value: '{{ old('lokasi') }}',
                        hasError: false,
                        errorMessage: '',
                        validate() {
                            if (!this.value || this.value.trim() === '') {
                                this.hasError = true;
                                this.errorMessage = 'This field is required.';
                            } else if (this.value.length > 100) {
                                this.hasError = true;
                                this.errorMessage = 'Location must not exceed 100 characters.';
                            } else {
                                this.hasError = false;
                                this.errorMessage = '';
                            }
                            $data.updateFormError('lokasi', this.hasError);
                        }
                    }" @init="validate()" @input="validate()">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1 mt-4">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi"
                            x-model="value"
                            @input="validate()"
                            x-bind:class="hasError 
                                ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                            required
                            class="text-sm cursor-auto">
                        <p class="block text-sm font-medium text-gray-700 mb-1 mt-6">
                            * Sila nyatakan alamat pautan sekiranya Program/ Projek/ Aktiviti dijalankan secara atas talian atau hibrid.<br> 
                            Sila patuhi SOP pencegahan/ penularan wabak pandemik Covid-19 MKN/ USM yang sedang berkuatkuasa.
                        </p>
                        <!-- Real-time error message -->
                        <p x-show="hasError" 
                            x-text="errorMessage"
                            class="mt-2 text-sm text-red-600">
                        </p>
                        <!-- Server-side error message -->
                        <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                    </div>
                    <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-10">
                        Atur Cara
                    </h5>

                    <!-- Table for Time and Activity -->
                    <div>
                        <!-- Loop through each day -->
                        <template x-for="(day, dayIndex) in days" :key="day.id">
                            <div class="mb-8">
                                <div class="flex justify-between items-center mb-4">
                                    <h6 class="text-sm font-semibold text-gray-800" x-text="day.title" x-show="days.length > 1"></h6>
                                    <button 
                                        type="button"
                                        @click="removeDay(dayIndex)"
                                        class="text-red-600 hover:text-red-800"
                                        x-show="days.length > 1"
                                    >
                                        <span class="text-sm">Remove Day</span>
                                    </button>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                                        <thead>
                                            <tr class="bg-gray-100 border border-gray-300">
                                                <th class="w-32 px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Masa</th>
                                                <th class="w-full px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Aktiviti</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(row, index) in day.timeActivities" :key="row.id">
                                                <tr>
                                                    <td class="px-2 py-4 whitespace-nowrap border-b">
                                                        <input 
                                                            type="time" 
                                                            x-model="row.time"
                                                            @input="validateRow(dayIndex, row)"
                                                            :class="row.hasError 
                                                                ? 'w-32 px-2 py-2 border rounded-md border-red-500'
                                                                : 'w-32 px-2 py-2 border rounded-md border-gray-300'"
                                                            required
                                                            class="text-sm cursor-auto"
                                                        >
                                                    </td>
                                                    <td class="px-2 py-4 whitespace-nowrap border-b">
                                                        <input 
                                                            type="text" 
                                                            x-model="row.activity"
                                                            @input="validateRow(dayIndex, row)"
                                                            :class="row.hasError 
                                                                ? 'w-full px-2 py-2 border rounded-md border-red-500'
                                                                : 'w-full px-2 py-2 border rounded-md border-gray-300'"
                                                            placeholder="Enter activity"
                                                            required
                                                            class="text-sm cursor-auto"                                                        >
                                                    </td>
                                                    <td class="py-4 whitespace-nowrap border-b">
                                                        <button 
                                                            type="button"
                                                            @click="removeRow(dayIndex, index)"
                                                            class="text-red-600 hover:text-red-800 text-center"
                                                            x-show="day.timeActivities.length > 1"
                                                        >
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="px-2 py-1 whitespace-nowrap">
                                                    <button 
                                                        type="button"
                                                        @click="addRow(dayIndex)"
                                                        class="w-full px-1 py-1 text-purple-700 text-sm font-medium hover:font-semibold transition-colors duration-300 flex flex-row  justify-center gap-2"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-4">
                                                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                                        </svg>
                                                        <p>
                                                            <span>
                                                                Add Row
                                                            </span>
                                                        </p>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </template>
                        <p x-show="days.some(day => day.timeActivities.some(row => !row.time || !row.activity.trim()))"
                            class="text-sm text-red-600 font-medium mt-3">
                            * Please fill in both time and activity fields and remove unwanted rows. 
                        </p>
                        <button 
                            type="button"
                            @click="addDay"
                            class="mt-4 px-4 py-2 border border-gray-300 text-purple-700 text-sm font-medium rounded-md hover:font-semibold transition-colors duration-300 hover:shadow-md"
                        >
                            Add Day
                        </button>
                    </div>
                    <input type="hidden" name="days" x-bind:value="JSON.stringify(days)">

                    <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-14">
                        JAWATANKUASA PELAKSANA
                    </h5>
                    <div class="mb-10">
                        <label for="collaboration" class="text-sm font-medium text-gray-700 mb-1">Sila nyatakan pihak kolaborasi bersama (Jika ada):</label>
                        <input class="w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500 text-sm"
                            type="text" id="collaboration" name="collaboration"
                            placeholder="e.g., Computer Science Society, Persatuan Mahasiswa Islam, etc.">
                    </div>

                    <!-- Jawatankuasa Pelaksana -->
                    <div class="overflow-x-auto mb-4">
                        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 border border-gray-300">
                                    <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Jawatan</th>
                                    <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Nama</th>
                                    <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">No. Matrik</th>
                                    <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Tahun Pengajian</th>
                                    <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Pusat Tanggungjawab</th>
                                    <th class="py-2 px-4 border border-gray-300 text-center text-sm font-semibold text-gray-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(item, index) in items" :key="index">
                                    <tr class="hover:bg-gray-50 text-sm">
                                        <td class="py-2 px-4 border border-gray-300">
                                            <span x-show="!item.isEditing" x-text="item.jawatan"></span>
                                            <input 
                                                x-show="item.isEditing" 
                                                x-model="item.jawatan" 
                                                type="text" 
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                            >
                                        </td>
                                        <td class="py-2 px-4 border border-gray-300">
                                            <span x-show="!item.isEditing" x-text="item.namaPemegangJawatan" class="whitespace-pre-line text-sm"></span>
                                            <textarea
                                                x-show="item.isEditing"
                                                x-model="item.namaPemegangJawatan"
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                                rows="3" cols="200"
                                                @keydown.enter="autoNumbering($event, item, 'namaPemegangJawatan')"
                                            ></textarea>
                                        </td>
                                        <td class="py-2 px-4 border border-gray-300">
                                            <span x-show="!item.isEditing" x-text="item.noMatrikPemegangJawatan" class="whitespace-pre-line text-sm"></span>
                                            <textarea
                                                x-show="item.isEditing"
                                                x-model="item.noMatrikPemegangJawatan"
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                                rows="2" cols="50"
                                                @keydown.enter="autoNumbering($event, item, 'noMatrikPemegangJawatan')"
                                            ></textarea>
                                        </td>
                                        <td class="py-2 px-4 border border-gray-300">
                                            <span x-show="!item.isEditing" x-text="item.tahunPemegangJawatan" class="whitespace-pre-line text-sm"></span>
                                            <textarea 
                                                x-show="item.isEditing" 
                                                x-model="item.tahunPemegangJawatan" 
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                                rows="2" cols="5"
                                                @keydown.enter="autoNumbering($event, item, 'tahunPemegangJawatan')"
                                            ></textarea>
                                        </td>
                                        <td class="py-2 px-4 border border-gray-300">
                                            <span x-show="!item.isEditing" x-text="item.pusatTanggungjawab" class="whitespace-pre-line text-sm"></span>
                                            <textarea 
                                                x-show="item.isEditing" 
                                                x-model="item.pusatTanggungjawab" 
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                                rows="2" cols="20"
                                                @keydown.enter="autoNumbering($event, item, 'pusatTanggungjawab')"
                                            ></textarea>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            <template x-if="!item.isEditing">
                                                <button
                                                    title="Edit" 
                                                    @click="editRow(index)"
                                                    class="text-purple-600 hover:text-purple-800 text-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                </button>
                                            </template>
                                            <template x-if="item.isEditing">
                                                <div class="py-1">
                                                    <button
                                                        title="Save" 
                                                        @click="saveRow(index)"
                                                        class="bg-indigo-500 text-white py-1 px-4 rounded-md hover:bg-indigo-600 text-xs text-center"
                                                    >
                                                        Save
                                                    </button>
                                                </div>
                                            </template>
                                            <template x-if="!item.isEditing">
                                                <button
                                                    title="Delete" 
                                                    @click="deleteRow(index)"
                                                    class="text-red-600 hover:text-red-800 text-center"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </template>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="whitespace-nowrap">
                                        <button 
                                            type="button"
                                            @click="addRowTableJawatankuasa()"
                                            class="w-full px-1 py-1 text-gray-500 text-sm font-medium hover:text-gray-800 transition-colors duration-300 flex flex-row  justify-center gap-2 hover:bg-gray-100"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-4">
                                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                            <p>
                                                <span>
                                                    Add Row
                                                </span>
                                            </p>
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="text-sm mt-8 p-2 font-medium text-gray-700">
                            <p class="mb-2">*Nota:</p>
                            <p class="mb-2">1. Hanya Program/ Projek/ Aktiviti yang mempunyai kolaborasi bersama dibenarkan untuk membuat pelantikan ke-II atau lebih daripada pihak yang berkolaborasi.</p>
                            <p class="mb-2">2. Keseluruhan Jawatankuasa Pelaksana tidak boleh melebihi 20% daripada peserta Program/ Projek/ Aktiviti dan mengikut kesesuaian.</p>
                            <p class="mb-2">3. Status Akademik dalam Sidang Akademik semasa Jawatankuasa Pelaksana yang dicadangkan berada dalam keadaan aktif dan bukan dalam tempoh percubaan (P1 atau P2).</p>
                        </div>
                    </div>
                    <input type="hidden" name="jawatankuasa" :value="JSON.stringify(items)">

                    <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-14">
                        CADANGAN BELANJAWAN
                    </h5>
                    <div class="mb-10">
                        <label for="penaja" class="text-sm font-medium text-gray-700 mb-1">Sila nyatakan Penaja/ Pemberi Sumbangan (Jika ada):</label>
                        <input class="w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500 text-sm"
                            type="text" id="penaja" name="penaja">
                    </div>

                    <!-- Cadangan Belanjawan -->
                    <div class="overflow-x-auto mb-14">
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
                                <template x-for="(belanjawan, index) in belanjawans" :key="index">
                                    <tr class="hover:bg-gray-50 text-sm">
                                        <td class="py-2 px-2 border border-gray-300">
                                            <span x-text="belanjawan.pendapatan"></span>
                                        </td>
                                        <td class="py-2 px-2 border border-gray-300">
                                            <input
                                                type="number"
                                                x-model="belanjawan.unitPendapatan"
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                            >
                                        </td>
                                        <td class="py-2 px-2 border border-gray-300">
                                            <input
                                                type="number"
                                                x-model="belanjawan.rmPendapatan"
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                            >
                                        </td>
                                        <td class="py-2 px-2 border border-gray-300">
                                            <span x-text="belanjawan.perbelanjaan"></span>
                                        </td>
                                        <td class="py-2 px-2 border border-gray-300">
                                            <input
                                                type="number"
                                                x-model="belanjawan.unitPerbelanjaan"
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                            >
                                        </td>
                                        <td class="py-2 px-2 border border-gray-300">
                                            <input
                                                type="number"
                                                x-model="belanjawan.rmPerbelanjaan"
                                                class="py-1 px-2 border border-gray-300 rounded w-full text-sm"
                                            >
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-100 font-semibold text-sm">
                                    <td class="py-2 px-2 border border-gray-300 text-right">Jumlah</td>
                                    <td class="py-2 px-2 border border-gray-300">
                                        <span x-text="belanjawans.reduce((sum, b) => sum + (parseFloat(b.unitPendapatan) || 0), 0)"></span>
                                    </td>
                                    <td class="py-2 px-2 border border-gray-300">
                                        <span x-text="belanjawans.reduce((sum, b) => sum + (parseFloat(b.rmPendapatan) || 0), 0).toFixed(2)"></span>
                                    </td>
                                    <td class="py-2 px-2 border border-gray-300 text-right">Jumlah</td>
                                    <td class="py-2 px-2 border border-gray-300">
                                        <span x-text="belanjawans.reduce((sum, b) => sum + (parseFloat(b.unitPerbelanjaan) || 0), 0)"></span>
                                    </td>
                                    <td class="py-2 px-2 border border-gray-300">
                                        <span x-text="belanjawans.reduce((sum, b) => sum + (parseFloat(b.rmPerbelanjaan) || 0), 0).toFixed(2)"></span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <input type="hidden" name="belanjawans" :value="JSON.stringify(belanjawans)">

                        <div class="text-sm mt-8 p-2 font-medium text-gray-700">
                            <p class="mb-2">*Jawatankuasa Pelaksana/ Bendahari Program/ Projek/ Aktiviti digalakkan untuk mendapatkan tajaan/ sumbangan pihak luar USM.</p>
                            <p class="mb-2">Surat edaran Ketua Setiausaha Kementerian Pendidikan Malaysia (No. Rujukan: KPM.100-1/10/1 Jld. 7, bertarikh 19 Januari 2017) - Larangan Pemberian Cenderahati kepada Tetamu Kehormat (VIP) semasa perasmian Majlis Rasmi, diterima pakai di USM.</p>
                            <p class="mb-2">Pekeliling Perbendaharaan Malaysia PB 3.1</p>
                            <p class="mb-2">3.10.1.3 pemberian cenderamata tidak dibenarkan tetapi sekiranya benar-benar perlu, hendaklah dihadkan kepada buku, kraf tangan tempatan, produk makanan tempatan atau produk agensi sendiri.</p>
                        </div>
                    </div>

                    <!-- Profil Tetamu -->
                    <div class="bg-white rounded-lg border border-gray-300 p-6">
                        <div class="flex justify-between items-center mb-12 text-sm">
                            <h2 class="text-sm font-semibold text-gray-800">FORMAT PROFIL PENCERAMAH/ TETAMU JEMPUTAN/ JURI</h2>
                            <button
                                type="button" 
                                @click="addPenceramah()"
                                class="px-4 py-2 border border-purple-500 text-purple-500 hover:text-white rounded hover:bg-purple-500 transition flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Tambah Jemputan
                            </button>
                        </div>

                        <!-- Penceramah Profiles -->
                        <template x-for="(penceramah, index) in penceramahs" :key="index">
                            <div class="border border-gray-300 rounded-lg p-4 mb-6 bg-white relative">
                                <button 
                                    @click="removePenceramah(index)"
                                    class="absolute top-2 right-2 text-red-500 hover:text-red-700"
                                    title="Remove"
                                    type="button"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Photo Upload -->
                                    <div class="md:col-span-2 flex items-center">
                                        <div class="w-40 h-40 bg-white border border-gray-300 mr-4 overflow-hidden flex items-center justify-center">
                                            <template x-if="!penceramah.photoPenceramah">
                                                <span class="text-gray-500 text-sm">Gambar</span>
                                            </template>
                                            <template x-if="penceramah.photoPenceramah">
                                                <img :src="penceramah.photoPenceramah" class="w-full h-full object-cover">
                                            </template>
                                            <input 
                                                type="file"
                                                name="photoPenceramah[]" 
                                                class="hidden" 
                                                :id="'photo-upload-'+index"
                                                @change="handlePhotoUpload(index, $event)"
                                            >
                                        </div>
                                        <button 
                                            type="button"
                                            @click="document.getElementById('photo-upload-'+index).click()"
                                            class="px-3 py-1 border border-purple-500 text-purple-500 rounded hover:bg-purple-50 hover:border-purple-600 hover:text-purple-600 transition text-sm"
                                        >
                                            Muat Naik Gambar
                                        </button>
                                    </div>

                                    <!-- Personal Details -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama:</label>
                                        <input 
                                            type="text" 
                                            x-model="penceramah.namaPenceramah"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                            placeholder="Nama Penuh"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Umur:</label>
                                        <input 
                                            type="number" 
                                            x-model="penceramah.umurPenceramah"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                            placeholder="Umur"
                                        >
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat:</label>
                                        <textarea 
                                            x-model="penceramah.alamatPenceramah"
                                            rows="2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                            placeholder="Alamat Penuh"
                                        ></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">E-mel:</label>
                                        <input 
                                            type="email" 
                                            x-model="penceramah.emailPenceramah"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                            placeholder="example@email.com"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Tel. Bimbit:</label>
                                        <input 
                                            type="tel" 
                                            x-model="penceramah.telefonPenceramah"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                            placeholder="012-3456789"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Media Sosial:</label>
                                        <input 
                                            type="text" 
                                            x-model="penceramah.media_sosialPenceramah"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kerjaya/Jawatan:</label>
                                        <input 
                                            type="text" 
                                            x-model="penceramah.kerjayaPenceramah"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                            placeholder="Pekerjaan Semasa"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Bidang Kepakaran:</label>
                                        <input 
                                            type="text" 
                                            x-model="penceramah.bidangPenceramah"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                            placeholder="Bidang Pakar"
                                        >
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Latarbelakang Pendidikan:</label>
                                        <textarea 
                                            x-model="penceramah.pendidikanPenceramah"
                                            rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-purple-500 text-sm"
                                            placeholder="Sijil/ Ijazah/ Pengalaman"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <input type="hidden" name="penceramahs" :value="JSON.stringify(penceramahs)">
                    </div>

                    <!-- Poster Hebahan -->
                    <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-14">
                        POSTER HEBAHAN
                    </h5>

                    <div x-data="{
                        posterFile: null,
                        posterUrl: '',
                        showPreview: false,
                        hasError: false,
                        errorMessage: '',
                        validate() {
                            this.hasError = !this.posterFile;
                            this.errorMessage = this.hasError ? 'Poster Hebahan is required.' : '';
                            // Update the parent form's error tracking
                            $data.updateFormError('posterHebahan', this.hasError);
                        },
                        handlePosterChange(event) {
                            const file = event.target.files[0];
                            this.posterFile = file;
                            this.validate();
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.posterUrl = e.target.result;
                                    this.showPreview = true;
                                };
                                reader.readAsDataURL(file);
                            } else {
                                this.posterUrl = '';
                                this.showPreview = false;
                            }
                        },
                        removePoster() {
                            this.posterFile = null;
                            this.posterUrl = '';
                            this.showPreview = false;
                            this.$refs.posterInput.value = '';
                            this.validate();
                        }
                    }">
                        <!-- Image Preview Area -->
                        <div class="relative rounded-lg overflow-hidden bg-gray-100 mb-2 object-contain w-96 h-96" 
                            x-show="showPreview">
                            <img :src="posterUrl" alt="Preview" class="object-contain w-96 h-96">
                            <button type="button"
                                class="absolute top-2 right-2 bg-gray-800 bg-opacity-70 rounded-full p-1 text-white hover:bg-gray-900"
                                @click="removePoster">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Upload Image -->
                        <div class="flex items-center p-2">
                            <div class="flex items-center space-x-2 mt-6 mb-2">
                                <label for="posterHebahan" class="flex items-center gap-2 cursor-pointer text-purple-500 hover:text-purple-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">Upload</span>
                                </label>
                                <input type="file" id="posterHebahan" name="posterHebahan" accept="image/*" class="hidden" x-ref="posterInput" @change="handlePosterChange">
                                
                            </div>
                        </div>
                        <!-- Real-time error message -->
                        <p
                            x-show="hasError" 
                            x-text="errorMessage"
                            class="mt-2 text-sm text-red-600"
                        ></p>
                    </div>
                </div>
                
                <!-- Step 2: MyCSD Mapping -->
                <div x-show="currentStep === 2" class="step-transition">
                    <div class="flex flex-col items-center">
                        <h3 class="text-xl font-bold text-gray-800">PEMETAAN MyCSD & ATRIBUT HEBAT</h3>
                        <h3 class="text-xl font-bold text-gray-800 mb-10">PERMOHONAN MENGADAKAN PROGRAM / AKTIVITI</h3>
                    </div>

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
                
                <!-- Step 3: Application to Organize Events -->
                <div x-show="currentStep === 3" class="step-transition">
                    <div class="flex flex-col items-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-10">BORANG PERMOHONAN MENGADAKAN PROGRAM</h3>
                    </div>
                    
                    <!-- Butiran Pemohon -->
                    <div class="grid grid-cols-1 gap-6">
                        <h5 class="text-sm font-semibold text-gray-800 mb-2 mt-2">
                        Butiran Pemohon
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
                                } else if (this.value.length > 60) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field must not exceed 60 characters.';
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
                            class="text-sm"
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
                        
                        <!-- No IC -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div x-data="{ 
                                value: '{{ old('no_ic') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 14) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 14 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('no_ic', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="no_ic" class="block text-sm font-medium text-gray-700 mb-1">No. Kad Pengenalan</label>
                                <input type="text" id="no_ic" name="no_ic"  
                                    x-model="value"
                                    @input="validate()"
                                    x-bind:class="hasError 
                                        ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                        : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                    class="text-sm"
                                    placeholder="012345-01-1234"
                                    required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('no_ic')" class="mt-2" />
                            </div>
                            
                            <!-- Jawatan -->
                            <div x-data="{ 
                                value: '{{ old('jawatan_borg_adkn_prog') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 100) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 100 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('jawatan_borg_adkn_prog', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="jawatan_borg_adkn_prog" class="block text-sm font-medium text-gray-700 mb-1">Jawatan</label>
                                <input type="text" id="jawatan_borg_adkn_prog" name="jawatan_borg_adkn_prog"  
                                    x-model="value"
                                    @input="validate()"
                                    x-bind:class="hasError 
                                        ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                        : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                    class="text-sm"
                                    placeholder="PENGARAH PROGRAM"
                                    required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('jawatan_borg_adkn_prog')" class="mt-2" />
                            </div>
                        
                            <!-- No. Matrik -->
                            <div x-data="{ 
                                value: '{{ old('no_matric') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 20) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 20 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('no_matric', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="no_matric" class="block text-sm font-medium text-gray-700 mb-1">No. Matrik</label>
                                <input type="number" id="no_matric" name="no_matric" 
                                    x-model="value"
                                    @input="validate()"
                                    x-bind:class="hasError 
                                        ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                        : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                    class="text-sm"
                                    required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('no_matric')" class="mt-2" />
                            </div>

                            <!-- Tel. Bimbit -->
                            <div x-data="{ 
                                value: '{{ old('tel_bimbit') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 20) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 20 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('tel_bimbit', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="tel_bimbit" class="block text-sm font-medium text-gray-700 mb-1">Tel. Bimbit</label>
                                <input type="tel" id="tel_bimbit" name="tel_bimbit"  
                                    x-model="value"
                                    @input="validate()"
                                    x-bind:class="hasError 
                                        ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                        : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                    class="text-sm"
                                    placeholder="012-3456789"
                                    required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('tel_bimbit')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div x-data="{ 
                                value: '{{ old('email_borg_adkn_prog') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (!emailPattern.test(this.value)) {
                                        this.hasError = true;
                                        this.errorMessage = 'Please enter a valid email address.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('email_borg_adkn_prog', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="email_borg_adkn_prog" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email_borg_adkn_prog" name="email_borg_adkn_prog"  
                                    x-model="value"
                                    @input="validate()"
                                    x-bind:class="hasError 
                                        ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                        : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                    class="text-sm"
                                    placeholder="example@email.com"
                                    required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('email_borg_adkn_prog')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Alamat Penggal -->
                        <div x-data="{ 
                            value: '{{ old('alamat_penggal') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (this.value.length > 255) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field must not exceed 255 characters.';
                                } else {
                                    this.hasError = false;
                                    this.errorMessage = '';
                                }
                                // Update the parent form's error tracking
                                $data.updateFormError('alamat_penggal', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="alamat_penggal" class="block text-sm font-medium text-gray-700 mb-1">Alamat Penggal</label>
                            <textarea 
                            id="alamat_penggal" 
                            name="alamat_penggal" 
                            rows="4" cols="50"
                            x-model="value"
                            @input="validate()"
                            x-bind:class="hasError 
                                ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                            class="text-sm"
                            ></textarea>
                            <!-- Real-time error message -->
                            <p
                                x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600"
                            ></p>
                            <!-- Server-side error message -->
                            <x-input-error :messages="$errors->get('alamat_penggal')" class="mt-2" />
                        </div>

                        <!-- Alamat Cuti -->
                        <div x-data="{ 
                            value: '{{ old('alamat_cuti') }}',
                            hasError: false,
                            errorMessage: '',
                            validate() {
                                if (this.value.length > 255) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field must not exceed 255 characters.';
                                } else {
                                    this.hasError = false;
                                    this.errorMessage = '';
                                }
                                // Update the parent form's error tracking
                                $data.updateFormError('alamat_cuti', this.hasError);
                            }
                        }" @init="validate()" @input="validate()">
                            <label for="alamat_cuti" class="block text-sm font-medium text-gray-700 mb-1">Alamat Semasa Cuti</label>
                            <textarea 
                            id="alamat_cuti" 
                            name="alamat_cuti" 
                            rows="4" cols="50"
                            x-model="value"
                            @input="validate()"
                            x-bind:class="hasError 
                                ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                            class="text-sm"
                            ></textarea>
                            <!-- Real-time error message -->
                            <p
                                x-show="hasError" 
                                x-text="errorMessage"
                                class="mt-2 text-sm text-red-600"
                            ></p>
                            <!-- Server-side error message -->
                            <x-input-error :messages="$errors->get('alamat_cuti')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Permohonan -->
                    <div class="grid grid-cols-1 gap-6 mt-10">
                        <h5 class="text-sm font-semibold text-gray-800 mb-1">
                        Permohonan
                        </h5>

                        <!-- Nama Program-->
                        <div>
                            <label for="nama_program" class="block text-sm font-medium text-gray-700 mb-1">Nama Program</label>
                            <input type="text" id="nama_program" name="nama_program"
                                value=""
                                readonly
                                class="w-full px-3 py-2 border rounded-md border-gray-300 bg-gray-100 cursor-not-allowed text-sm focus:outline-none focus:ring-1 focus:ring-purple-500"
                                placeholder="Nama Program akan sama seperti Tajuk Kertas Kerja"
                            />
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Klasifikasi Program -->
                            <div x-data="{ 
                                value: '{{ old('klasifikasi_program') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 100) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 100 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('klasifikasi_program', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="klasifikasi_program" class="block text-sm font-medium text-gray-700 mb-1">
                                    Klasifikasi Program<span class="text-red-600 text-md font-semibold">*</span>
                                </label>
                                <input type="text" id="klasifikasi_program" name="klasifikasi_program"  
                                    x-model="value"
                                    @input="validate()"
                                    x-bind:class="hasError 
                                        ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                        : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                    class="text-sm"
                                    placeholder="e.g. KEPIMPINAN"
                                    required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('klasifikasi_program')" class="mt-2" />
                            </div>
                            
                            <!-- Bilangan kumpulan pengelola -->
                            <div x-data="{ 
                                value: '{{ old('bilangan_kumpulan_pengelola') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 100) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 100 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('bilangan_kumpulan_pengelola', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="bilangan_kumpulan_pengelola" class="block text-sm font-medium text-gray-700 mb-1">
                                    Bilangan kumpulan pengelola<span class="text-red-600 text-md font-semibold">*</span>
                                </label>
                                <input type="text" id="bilangan_kumpulan_pengelola" name="bilangan_kumpulan_pengelola"  
                                    x-model="value"
                                    @input="validate()"
                                    x-bind:class="hasError 
                                        ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                        : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                    class="text-sm"
                                    placeholder="e.g. 10 orang"
                                    required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('bilangan_kumpulan_pengelola')" class="mt-2" />
                            </div>
                        
                            <!-- Bilangan sasaran -->
                            <div x-data="{ 
                                value: '{{ old('bilangan_sasaran') }}',
                                hasError: false,
                                errorMessage: '',
                                validate() {
                                    if (!this.value || this.value.trim() === '') {
                                        this.hasError = true;
                                        this.errorMessage = 'This field is required.';
                                    } else if (this.value.length > 100) {
                                        this.hasError = true;
                                        this.errorMessage = 'This field must not exceed 100 characters.';
                                    } else {
                                        this.hasError = false;
                                        this.errorMessage = '';
                                    }
                                    // Update the parent form's error tracking
                                    $data.updateFormError('bilangan_sasaran', this.hasError);
                                }
                            }" @init="validate()" @input="validate()">
                                <label for="bilangan_sasaran" class="block text-sm font-medium text-gray-700 mb-1">
                                    Bilangan Sasaran<span class="text-red-600 text-md font-semibold">*</span>
                                </label>
                                <input type="text" id="bilangan_sasaran" name="bilangan_sasaran" 
                                    x-model="value"
                                    @input="validate()"
                                    x-bind:class="hasError 
                                        ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                        : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'" 
                                    class="text-sm"
                                    placeholder="e.g. 100 orang"
                                    required>
                                <!-- Real-time error message -->
                                <p
                                    x-show="hasError" 
                                    x-text="errorMessage"
                                    class="mt-2 text-sm text-red-600"
                                ></p>
                                <!-- Server-side error message -->
                                <x-input-error :messages="$errors->get('bilangan_sasaran')" class="mt-2" />
                            </div>

                            <!-- Kutipan dari peserta -->
                            <div>
                                <label for="kutipan_dari_peserta" class="block text-sm font-medium text-gray-700 mb-1">Kutipan Dari Peserta</label>
                                <input type="text" id="kutipan_dari_peserta" name="kutipan_dari_peserta"  
                                    class="text-sm w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500"
                                    placeholder="e.g. RM3 atau abaikan jika tiada">
                            </div>
                        </div>

                        <!-- Tujuan Kutipan Wang (Dynamic Visibility & Real-time Required) -->
                        <div>
                            <label for="tujuan_kutipan_wang" class="block text-sm font-medium text-gray-700 mb-1">Tujuan kutipan wang</label>
                            <input type="text" id="tujuan_kutipan_wang" name="tujuan_kutipan_wang"  
                                class="text-sm w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500"
                                placeholder="e.g. Pendaftaran atau abaikan jika tiada">
                        </div>

                        <!-- Tempat Kutipan (Dynamic Checkbox) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Kutipan</label>
                            <div class="flex flex-col gap-1">
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="tempat_kutipan[]" value="Di Dalam Kampus"
                                        x-model="values"
                                        @change="validate()"
                                        class="mr-2 rounded border-gray-400">
                                    Di Dalam Kampus
                                </label>
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="tempat_kutipan[]" value="Di Luar Kampus"
                                        x-model="values"
                                        @change="validate()"
                                        class="mr-2 rounded border-gray-400">
                                    Di Luar Kampus
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Pengakuan -->
                    <div class="mt-10"
                    x-data="{
                        checked: false,
                        hasError: true,
                        validate() {
                            this.hasError = !this.checked;
                            $data.updateFormError('pengakuan', this.hasError);
                        }
                    }"
                    @init="validate()">
                        <h5 class="text-sm font-semibold text-gray-800 mb-1">
                        Pengakuan
                        </h5>

                        <div>
                           <label class="text-sm text-gray-700">Saya sertakan kertas kerja tentang program yang dicadangkan itu. Kutipan wang akan diuruskan mengikut kehendak AUKU seksyen 15A dan saya akan mematuhi semua peraturan yang ditetapkan oleh Universiti. 
                           <input type="checkbox" id="pengakuan" name="pengakuan" 
                                x-model="checked"
                                @change="validate()"
                                class="ml-2 rounded border-gray-400 focus:ring-blue-500"
                                required></label>
                            <p class="text-red-600 text-sm mt-4">Tanda pengakuan untuk menghantar borang*</p>
                        </div>
                    </div>
                </div>

                <!-- Form Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button 
                        x-show="currentStep > 1" 
                        @click="goToPrevStep" 
                        type="button"
                        class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm rounded-md transition-colors duration-300"
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
</div>
@endsection


