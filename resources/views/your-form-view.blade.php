<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyCSD Form</title>
    {{-- Link to your compiled Tailwind CSS file --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="container mx-auto p-6 lg:p-10">

        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Borang Teras MyCSD</h1>

        {{-- Display Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Display Validation Errors (Optional) --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                 <strong class="font-bold">Oops! There were some errors:</strong>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('csd.form.submit') }}" method="POST">
            @csrf {{-- CSRF Protection Token --}}

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-r border-gray-300 w-1/6">
                                    Elemen
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-r border-gray-300 w-1/4">
                                    Atribut Hebat
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-r border-gray-300 w-2/4">
                                    Teras MyCSD
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider w-1/12">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white"> {{-- Remove divide-y from here if adding borders manually to TR --}}
                            {{-- Loop through each element group --}}
                            @foreach ($formData as $group)
                                {{-- Loop through attributes within the group --}}
                                @foreach ($group['attributes'] as $index => $attribute)
                                    {{-- Use @class directive for conditional classes --}}
                                    <tr @class([
                                        'hover:bg-blue-50 transition duration-150 ease-in-out',
                                        // Apply standard thin bottom border to all rows initially
                                        'border-b border-gray-200',
                                        // Apply thicker, darker border *only* if it's the last row in this group
                                        'border-b-2 border-gray-200' => $loop->last,
                                        // Optional: different background for alternating rows, skip if it's the last row
                                        // 'bg-gray-50' => $loop->even && !$loop->last,
                                    ])>

                                        {{-- Display Element cell only for the first row of the group using rowspan --}}
                                        @if ($loop->first)
                                            <td @class([
                                                'px-4 py-4 align-top border-r border-gray-300 text-sm font-medium text-gray-800',
                                                // Also add the thick bottom border to the rowspan cell if it's the last group's last row
                                                'border-b-2 border-gray-200' => $loop->parent->last,
                                                // Otherwise add the normal thin border
                                                'border-b border-gray-200' => !$loop->parent->last,
                                            ])
                                                rowspan="{{ count($group['attributes']) }}">
                                                {{ $group['element'] }}
                                            </td>
                                        @endif

                                        {{-- Attribute Cell --}}
                                        <td class="px-4 py-4 align-top border-r border-gray-300 text-sm text-gray-700">
                                            {{ $attribute['attribute'] }}
                                        </td>

                                        {{-- Teras MyCSD Cell --}}
                                        <td class="px-4 py-4 align-top border-r border-gray-300 text-sm text-gray-700 whitespace-normal">
                                            {{ $attribute['teras'] }}
                                        </td>

                                        {{-- Checkbox Cell --}}
                                        <td class="px-4 py-4 align-middle text-center">
                                            {{-- Use a unique ID for label association and check if it was previously selected --}}
                                            @php
                                                $checkboxId = 'attribute_' . $attribute['id'];
                                                $isChecked = in_array($attribute['id'], $selectedAttributes ?? []); // Use null coalesce for safety
                                            @endphp
                                            <input
                                                type="checkbox"
                                                id="{{ $checkboxId }}"
                                                name="selected_attributes[]"
                                                value="{{ $attribute['id'] }}" {{-- Use the unique ID as the value --}}
                                                class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                                                {{ $isChecked ? 'checked' : '' }}
                                                aria-labelledby="{{ $checkboxId }}_label" {{-- Associate with a label for accessibility --}}
                                            >
                                            {{-- Screen-reader only label --}}
                                            <label id="{{ $checkboxId }}_label" for="{{ $checkboxId }}" class="sr-only">Pilih {{ $attribute['attribute'] }}</label>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    Submit Selections
                </button>
            </div>

        </form>

    </div>

    {{-- Include your compiled JS if needed --}}
    {{-- @vite('resources/js/app.js') --}}
</body>
</html>