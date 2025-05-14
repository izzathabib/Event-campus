window.multiStepForm = function() {
    return {
        currentStep: 1,
        showSuccessModal: false,
        formErrors: {
            tajuk_kk: true,
            peng_kump_sasar: true,
            obj: true,
            impak: true,
            taj_prog: true,
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
        }

        
    };
}