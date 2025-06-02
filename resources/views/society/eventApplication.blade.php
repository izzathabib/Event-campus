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
    <div class="w-full max-w-4xl bg-white rounded-lg border-2 shadow-md overflow-hidden" x-data="multiStepForm()" x-cloak>
    
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
        @if (session()->has('success'))
            <div id="flash-error" class="bg-sky-700 text-white px-4 py-3 rounded relative mb-4 text-sm font-medium flex items-center justify-between" role="alert">
                <div class="px-4 py-3">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('flash-error').remove()">
                    <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </button>
            </div>
        @endif
        <!-- Form Body -->
        <div class="p-6">
            <form action="{{ route('society.storeEventApplicationData') }}" method="POST" enctype="multipart/form-data" id="multi-step-form">
                @csrf
                <!-- Step 1: Paper work -->
                <div x-show="currentStep === 1" class="step-transition">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">KERTAS KERJA PROGRAM/ PROJEK/ AKTIVITI PERTUBUHAN PELAJAR UNIVERSITI SAINS MALAYSIA</h3>
                    
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
                                @input="validate()"
                                x-bind:class="hasError 
                                    ? 'w-full px-3 py-2 border rounded-md border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500'
                                    : 'w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-purple-500'"
                                class="cursor-auto" 
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
                                required>
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
                                required>
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
                                required>
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
                                required>
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
                            required>
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
                                            <tr class="bg-gray-50">
                                                <th class="w-32 px-6 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Masa</th>
                                                <th class="w-full px-6 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aktiviti</th>
                                                <th class="px-4 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
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
                                                        >
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
                    <!-- <div>
                        <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label>
                        <textarea id="atur_cara" name="atur_cara" rows="10" cols="50" x-model="formData.aturCara" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                            required>
                        </textarea>
                    </div> -->

                    <!-- <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-14">
                        JAWATANKUASA PELAKSANA
                    </h5> -->
                    <!-- <div>
                        <label for="peng_kump_sasar" class="block text-sm font-medium text-gray-700 mb-1">Pengenalan & Kumpulan Sasaran/ Penyertaan</label>
                        <textarea id="jawat_pelak" name="jawat_pelak" rows="10" cols="50" x-model="formData.jawatPelak" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                            required>
                        </textarea>
                    </div> -->

                    <!-- <h5 class="text-sm font-semibold text-gray-800 mb-4 mt-14">
                        CADANGAN BELANJAWAN
                    </h5>
                    <div>
                        <textarea id="cada_belan" name="cada_belan" rows="10" cols="50" x-model="formData.cadaBelan" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500"
                            required>
                        </textarea>
                    </div> -->
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
                                } else if (this.value.length > 100) {
                                    this.hasError = true;
                                    this.errorMessage = 'This field must not exceed 100 characters.';
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


