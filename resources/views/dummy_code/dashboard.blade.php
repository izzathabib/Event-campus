<thead>
    <tr class="bg-gray-50">
        <th class="w-32 px-6 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Masa</th>
        <th class="w-full px-6 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aktiviti</th>
        <th class="px-4 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
    </tr>
</thead>

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

<td class="py-4 whitespace-nowrap border-b">
    <button 
        type="button"
        @click="removeRow(index)"
        class="text-red-600 hover:text-red-800 text-center"
        x-show="timeActivities.length > 1"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    </button>
</td>


<!-- Error message for the whole table -->
<p x-show="timeActivities.some(row => !row.time || !row.activity.trim())"
    class="text-sm text-red-600 font-medium mt-3">
    * Please fill in both time and activity fields or remove unwanted rows. 
</p>


<tbody>
    <template x-for="(row, index) in timeActivities" :key="row.id">
        <tr>
            <td class="px-2 py-4 whitespace-nowrap border-b">
                <input 
                    type="time" 
                    x-model="row.time"
                    @input="validateRow(row)"
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
                    @input="validateRow(row)"
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
                    @click="removeRow(index)"
                    class="text-red-600 hover:text-red-800 text-center"
                    x-show="timeActivities.length > 1"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </td>
        </tr>
    </template>
</tbody>