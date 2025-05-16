<div class="flex flex-col md:flex-row space-y-6 md:space-y-0 justify-between">

<!-- Start Date -->
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

<!-- Start Time -->
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

<div class="w-6 flex items-center justify-center text-sm font-medium text-gray-700">
    <p>to</p>
</div>

<!-- End Date -->
<div class="w-48"
x-data="{ 
    value: '{{ old('end_date') }}',
    hasError: false,
    errorMessage: '',
    validate() {
        if (!this.value) {
            this.hasError = true;
            this.errorMessage = 'End date is required.';
        } else {
            const startDate = new Date($refs.startDate.value);
            const endDate = new Date(this.value);
            if (endDate < startDate) {
                this.hasError = true;
                this.errorMessage = 'End date cannot be before start date.';
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

<!-- End Time -->
<div class="w-40" 
x-data="{ 
    value: '{{ old('end_time') }}',
    hasError: false,
    errorMessage: '',
    validate() {
        if (!this.value) {
            this.hasError = true;
            this.errorMessage = 'End time is required.';
        } else if ($refs.startDate.value === $refs.endDate.value) {
            const startTime = new Date(`2000-01-01T${$refs.startTime.value}`);
            const endTime = new Date(`2000-01-01T${this.value}`);
            if (endTime <= startTime) {
                this.hasError = true;
                this.errorMessage = 'End time must be after start time.';
            } else {
                this.hasError = false;
                this.errorMessage = '';
            }
        } else {
            this.hasError = false;
            this.errorMessage = '';
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