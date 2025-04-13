{{-- resources/views/schedule-builder.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Cara Builder</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .activity-item.sortable-ghost {
            background-color: rgba(59, 130, 246, 0.2);
            border: 2px dashed #3b82f6;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-4">
    <div class="max-w-4xl mx-auto" x-data="scheduleBuilder()">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-white">
                <h1 class="text-2xl font-bold">Atur Cara</h1>
                <p class="mt-1 text-blue-100">Jadual Aktiviti</p>
            </div>
            
            <!-- Schedule Builder Interface -->
            <div class="p-6">
                <!-- Controls Section -->
                <div class="mb-6 flex flex-wrap gap-4">
                    <button 
                        @click="addDay()" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200">
                        + Tambah Hari
                    </button>
                    
                    <button 
                        @click="saveDraft()" 
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition-colors duration-200">
                        Simpan Draf
                    </button>
                    
                    <button 
                        @click="showPreviewModal = true" 
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors duration-200">
                        Pratonton
                    </button>
                </div>
                
                <!-- Days Section -->
                <div class="space-y-6">
                    <template x-for="(day, dayIndex) in schedule" :key="dayIndex">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <!-- Day Header -->
                            <div class="bg-gray-100 p-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="font-bold mr-4" x-text="day.name"></div>
                                    <input 
                                        type="text" 
                                        x-model="day.name" 
                                        class="px-2 py-1 border border-gray-300 rounded-md text-sm"
                                        :placeholder="`HARI ${dayIndex + 1}`">
                                </div>
                                <div class="flex items-center gap-2">
                                    <button 
                                        @click="addActivity(dayIndex)" 
                                        class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm transition-colors duration-200">
                                        + Aktiviti
                                    </button>
                                    <button 
                                        @click="removeDay(dayIndex)" 
                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm transition-colors duration-200">
                                        Buang
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Activities Table -->
                            <div class="p-4">
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr>
                                            <th class="border border-gray-300 bg-gray-50 px-4 py-2 text-left w-1/3">Masa</th>
                                            <th class="border border-gray-300 bg-gray-50 px-4 py-2 text-left w-2/3">Aktiviti</th>
                                        </tr>
                                    </thead>
                                    <tbody :id="`day-${dayIndex}-activities`" class="activities-list">
                                        <template x-for="(activity, activityIndex) in day.activities" :key="activityIndex">
                                            <tr class="activity-item border border-gray-200 hover:bg-gray-50">
                                                <td class="border border-gray-300 p-2">
                                                    <div class="flex items-center gap-2">
                                                        <input 
                                                            type="time" 
                                                            x-model="activity.startTime" 
                                                            class="w-full px-2 py-1 border border-gray-300 rounded-md">
                                                        <span>-</span>
                                                        <input 
                                                            type="time" 
                                                            x-model="activity.endTime" 
                                                            class="w-full px-2 py-1 border border-gray-300 rounded-md">
                                                    </div>
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex-grow">
                                                            <input 
                                                                type="text" 
                                                                x-model="activity.description" 
                                                                class="w-full px-2 py-1 border border-gray-300 rounded-md"
                                                                placeholder="Keterangan aktiviti">
                                                        </div>
                                                        <button 
                                                            @click="removeActivity(dayIndex, activityIndex)" 
                                                            class="px-2 py-1 bg-red-100 hover:bg-red-200 text-red-600 rounded-md text-sm">
                                                            &times;
                                                        </button>
                                                        <div class="cursor-move px-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                
                                <!-- Empty State -->
                                <div x-show="day.activities.length === 0" class="text-center py-8 text-gray-500">
                                    <p>Belum ada aktiviti. Klik "+ Aktiviti" untuk menambah.</p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                
                <!-- Empty Schedule State -->
                <div x-show="schedule.length === 0" class="text-center py-12 border border-dashed border-gray-300 rounded-lg">
                    <div class="text-gray-400 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 9v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                    </div>
                    <p class="text-lg text-gray-500">Jadual anda masih kosong</p>
                    <p class="text-gray-400 mb-4">Klik "Tambah Hari" untuk mulai membuat jadual</p>
                    <button 
                        @click="addDay()" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200">
                        + Tambah Hari
                    </button>
                </div>
                
                <!-- Save Button -->
                <div class="mt-6 flex justify-end">
                    <button 
                        @click="saveSchedule()" 
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors duration-200">
                        Simpan Jadual
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Preview Modal -->
        <div x-show="showPreviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak>
            <div class="bg-white rounded-lg p-6 max-w-3xl w-full max-h-90vh overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Pratonton Jadual</h2>
                    <button @click="showPreviewModal = false" class="text-gray-500 hover:text-gray-700">
                        &times;
                    </button>
                </div>
                
                <div class="border border-gray-300 rounded-lg overflow-hidden">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 bg-gray-100 px-4 py-2 text-left w-1/3">Masa</th>
                                <th class="border border-gray-300 bg-gray-100 px-4 py-2 text-left w-2/3">Aktiviti</th>
                            </tr>
                        </thead>
                        <template x-for="(day, dayIndex) in schedule" :key="dayIndex">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="border border-gray-300 bg-gray-800 text-white px-4 py-2 font-bold" x-text="day.name || `HARI ${dayIndex + 1}`"></td>
                                </tr>
                                <template x-for="(activity, activityIndex) in day.activities" :key="activityIndex">
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <span x-text="formatTimeDisplay(activity.startTime, activity.endTime)"></span>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2" x-text="activity.description"></td>
                                    </tr>
                                </template>
                                <tr x-show="day.activities.length === 0">
                                    <td colspan="2" class="border border-gray-300 px-4 py-2 text-gray-500 text-center">
                                        Tiada aktiviti
                                    </td>
                                </tr>
                            </tbody>
                        </template>
                    </table>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button 
                        @click="showPreviewModal = false" 
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition-colors duration-200 mr-2">
                        Tutup
                    </button>
                    <button 
                        @click="printSchedule()" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200">
                        Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function scheduleBuilder() {
            return {
                schedule: [],
                showPreviewModal: false,
                
                init() {
                    // Load saved schedule from localStorage if exists
                    const savedSchedule = localStorage.getItem('scheduleDraft');
                    if (savedSchedule) {
                        this.schedule = JSON.parse(savedSchedule);
                    } 
                    // Otherwise start with default 2 days (like the paper form)
                    else {
                        this.addDay();
                        this.addDay();
                    }
                    
                    // Initialize sortable after rendering
                    this.$nextTick(() => {
                        this.initSortable();
                    });
                },
                
                initSortable() {
                    // Make activities sortable within each day
                    this.schedule.forEach((day, dayIndex) => {
                        const el = document.getElementById(`day-${dayIndex}-activities`);
                        if (el) {
                            new Sortable(el, {
                                animation: 150,
                                handle: '.cursor-move',
                                ghostClass: 'sortable-ghost',
                                onEnd: (evt) => {
                                    // Update the order in the data model
                                    const activities = [...this.schedule[dayIndex].activities];
                                    const movedItem = activities.splice(evt.oldIndex, 1)[0];
                                    activities.splice(evt.newIndex, 0, movedItem);
                                    this.schedule[dayIndex].activities = activities;
                                }
                            });
                        }
                    });
                },
                
                addDay() {
                    const dayNumber = this.schedule.length + 1;
                    this.schedule.push({
                        name: `HARI ${dayNumber}`,
                        activities: []
                    });
                    
                    // Re-initialize sortable after adding a new day
                    this.$nextTick(() => {
                        this.initSortable();
                    });
                },
                
                removeDay(dayIndex) {
                    if (confirm('Adakah anda pasti untuk membuang hari ini?')) {
                        this.schedule.splice(dayIndex, 1);
                    }
                },
                
                addActivity(dayIndex) {
                    this.schedule[dayIndex].activities.push({
                        startTime: '',
                        endTime: '',
                        description: ''
                    });
                },
                
                removeActivity(dayIndex, activityIndex) {
                    this.schedule[dayIndex].activities.splice(activityIndex, 1);
                },
                
                formatTimeDisplay(startTime, endTime) {
                    if (!startTime && !endTime) return '';
                    if (!startTime) return `hingga ${endTime}`;
                    if (!endTime) return `dari ${startTime}`;
                    return `${startTime} - ${endTime}`;
                },
                
                saveDraft() {
                    localStorage.setItem('scheduleDraft', JSON.stringify(this.schedule));
                    alert('Jadual telah disimpan sebagai draf.');
                },
                
                saveSchedule() {
                    // Here you would typically send the data to your backend
                    // For now we'll just save to localStorage and show confirmation
                    localStorage.setItem('scheduleData', JSON.stringify(this.schedule));
                    
                    // Example AJAX request to Laravel backend
                    /*
                    fetch('/api/schedule', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ schedule: this.schedule })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert('Jadual telah disimpan dengan jayanya.');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ralat semasa menyimpan jadual.');
                    });
                    */
                    
                    alert('Jadual telah disimpan dengan jayanya.');
                },
                
                printSchedule() {
                    const printWindow = window.open('', '_blank');
                    
                    let printContent = `
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Atur Cara</title>
                            <style>
                                body { font-family: Arial, sans-serif; }
                                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                                th { background-color: #f2f2f2; }
                                .day-header { background-color: #333; color: white; font-weight: bold; }
                                @media print {
                                    body { margin: 0; padding: 20px; }
                                }
                            </style>
                        </head>
                        <body>
                            <h1>Atur Cara</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Masa</th>
                                        <th style="width: 70%;">Aktiviti</th>
                                    </tr>
                                </thead>
                    `;
                    
                    this.schedule.forEach((day) => {
                        printContent += `
                            <tbody>
                                <tr>
                                    <td colspan="2" class="day-header">${day.name}</td>
                                </tr>
                        `;
                        
                        if (day.activities.length === 0) {
                            printContent += `
                                <tr>
                                    <td colspan="2" style="text-align: center; color: #666;">Tiada aktiviti</td>
                                </tr>
                            `;
                        } else {
                            day.activities.forEach((activity) => {
                                printContent += `
                                    <tr>
                                        <td>${this.formatTimeDisplay(activity.startTime, activity.endTime)}</td>
                                        <td>${activity.description}</td>
                                    </tr>
                                `;
                            });
                        }
                        
                        printContent += `</tbody>`;
                    });
                    
                    printContent += `
                            </table>
                        </body>
                        </html>
                    `;
                    
                    printWindow.document.open();
                    printWindow.document.write(printContent);
                    printWindow.document.close();
                    
                    // Wait for content to load then print
                    printWindow.onload = function() {
                        printWindow.print();
                    };
                }
            };
        }
    </script>
</body>
</html>