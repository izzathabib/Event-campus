window.multiStepForm = function() {
    return {
        currentStep: 1,
        showSuccessModal: false,

        days: [
            {
                id: 1,
                title: 'Hari Pertama',
                timeActivities: [{ time: '', activity: '', id: 1, hasError: false }]
            }
        ],
        validateRow(dayIndex, row) {
            let isValid = true;
            if (!row.time || !row.activity.trim()) {
                row.hasError = true;
                row.errorMessage = 'Both time and activity are required.';
                isValid = false;
            } else {
                row.hasError = false;
            }
            
            // Update the parent form error state for timeActivities
            this.updateFormError('timeActivities', 
                this.days.some(day => day.timeActivities.some(row => !row.time || !row.activity.trim()))
            );
            
            return isValid;
        },
        addRow(dayIndex) {
            this.days[dayIndex].timeActivities.push({
                time: '',
                activity: '',
                id: Date.now(),
                hasError: false
            });
        },
        removeRow(dayIndex, rowIndex) {
            if (this.days[dayIndex].timeActivities.length > 1) {
                this.days[dayIndex].timeActivities.splice(rowIndex, 1);
            }
        },
        addDay() {
            this.days.push({
                id: Date.now(),
                title: `Hari Ke - ${this.days.length + 1}`,
                timeActivities: [{ time: '', activity: '', id: Date.now(), hasError: false }]
            });
        },
        removeDay(dayIndex) {
            if (this.days.length > 1) {
                this.days.splice(dayIndex, 1);
                // Update day titles
                this.days.forEach((day, index) => {
                    day.title = `Day ${index + 1}`;
                });
            }
        },

        formErrors: {
            // Paper work
            tajuk_kk: true,
            peng_kump_sasar: true,
            obj: true,
            impak: true,
            start_date: true,
            start_time: true,
            end_date: true,
            lokasi: true,
            timeActivities: true,
            // MyCSD Mapping
            kaedah: true,
            hfp: true,
            poster: true,
            pertubuhan: true,
            // Application to Organize Events
            nama: true
        },
        
        steps: [
            { title: 'Paper Work' },
            { title: 'MyCSD Mapping' },
            { title: 'Application to Organize Events' },
        ],
        formData: {
            // Paper work
            tajukKk: '',
            pengKumpSasar: '',
            obj: '',
            impak: '',
            
            // MyCSD Mapping
            tajProg: '',
            
            // Application to Organize Events
            nama: '',

            // Terms agreement
            // agreeTerms: false
        },

        // Add hasErrors method here
        hasErrors() {
            return Object.values(this.formErrors).some(error => error === true);
        },

        // Add this method to update form errors
        updateFormError(field, hasError) {
            this.formErrors[field] = hasError;
            console.log(`Updated ${field} error state:`, hasError);
        },

        validate(field, value) {
            let hasError = false;
            if (!value || value.trim() === '') {
                hasError = true;
            }
            this.updateFormError(field, hasError);
            return !hasError;
        },
        
        // getEducationDisplayName(value) {
        //     const educationMap = {
        //         'high_school': 'High School',
        //         'associate': 'Associate Degree',
        //         'bachelor': 'Bachelor\'s Degree',
        //         'master': 'Master\'s Degree',
        //         'doctorate': 'Doctorate'
        //     };
            
        //     return educationMap[value] || value;
        // },
        
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
            if (this.hasErrors()) {
                console.log('Form has errors, submission prevented');
                return;
            }
            // Form validation
            // if (!this.formData.agreeTerms) {
            //     alert('Please agree to the Terms and Conditions to continue.');
            //     return;
            // }
            
            // Here you would normally send the data to your Laravel backend
            console.log('Form submitted!', this.formData);
            
            // For demo purposes, we'll just show a success message
            // this.showSuccessModal = true;
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
        },

        /* ##- Function for JAWATANKUASA PELAKSANA -## */
        items: [
            { jawatan: "Penaung", namaPemegangJawatan: "", noMatrikPemegangJawatan: "Not applicable", tahunPemegangJawatan: "Not applicable", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "Penasihat", namaPemegangJawatan: "", noMatrikPemegangJawatan: "Not applicable", tahunPemegangJawatan: "Not applicable", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "Pemantau", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "Pengarah", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "Timb. Pengarah", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "Timb. Pengarah II*", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "Setiausaha", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "Setiausaha II*", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "Bendahari (jika ada belanjawan)", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "AJK 1", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
            { jawatan: "AJK 2", namaPemegangJawatan: "", noMatrikPemegangJawatan: "", tahunPemegangJawatan: "", pusatTanggungjawab: "", isEditing: false },
        ],

        // Edit a row
        editRow(index) {
            this.items[index].isEditing = true;
        },

        // Save edited row
        saveRow(index) {
            this.items[index].isEditing = false;
        },

        // Delete a row
        deleteRow(index) {
            this.items.splice(index, 1);
        },

        // Add a new empty row
        addRowTableJawatankuasa() {
            this.items.push({ 
                jawatan: "", 
                namaPemegangJawatan: "", 
                noMatrikPemegangJawatan: "", 
                tahunPemegangJawatan: "", 
                pusatTanggungjawab: "", 
                isEditing: true  // Automatically enter edit mode
            });
        },

        autoNumbering(event, item, field) {
            const textarea = event.target;
            const value = textarea.value;
            const lines = value.split('\n');
            const lastLine = lines[lines.length - 1];
            const match = lastLine.match(/^(\d+)\.\s/);
            if (match) {
                event.preventDefault();
                const nextNumber = parseInt(match[1], 10) + 1;
                const insert = `\n${nextNumber}. `;
                const start = textarea.selectionStart;
                const end = textarea.selectionEnd;
                item[field] = value.substring(0, start) + insert + value.substring(end);
                // Move cursor to end of inserted text
                setTimeout(() => {
                    textarea.selectionStart = textarea.selectionEnd = start + insert.length;
                }, 0);
            }
        }
        /* End of Function for JAWATANKUASA PELAKSANA */
    };
}