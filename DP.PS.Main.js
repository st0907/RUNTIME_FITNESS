/*
Programmer Name : Siew Zhen Lynn (TP076386)
Program Name    : DP.PS.Main.js
Description     : Personalized Diet Plan (Javascript)
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/

document.addEventListener('DOMContentLoaded', function() {
    // Form elements
    const dietTypeOptions = document.querySelectorAll('.diet-type-option');
    const durationOptions = document.querySelectorAll('.duration-option');
    const heightInput = document.getElementById('height-input');
    const weightInput = document.getElementById('weight-input');
    const ageInput = document.getElementById('age-input');
    const genderSelect = document.getElementById('gender-select');
    const activityLevel = document.getElementById('activity-level');
    const budgetInput = document.getElementById('budget-input');
    
    // Nutrition display elements
    const caloriesValue = document.getElementById('calories-value');
    const proteinValue = document.getElementById('protein-value');
    const carbsValue = document.getElementById('carbs-value');
    const fatValue = document.getElementById('fat-value');
    
    // Form and results sections
    const generatePlanBtn = document.getElementById('generate-plan-btn');
    const personalPlanForm = document.getElementById('personalized-form');
    const personalPlanResults = document.getElementById('personal-plan-results');
    const backToFormBtn = document.getElementById('back-to-form-btn');
    
    // Summary elements
    const summaryPlanType = document.getElementById('summary-plan-type');
    const summaryCalories = document.getElementById('summary-calories');
    const summaryDuration = document.getElementById('summary-duration');
    const summaryBudget = document.getElementById('summary-budget');
    
    // Diet type selection
    dietTypeOptions.forEach(option => {
        option.addEventListener('click', () => {
            dietTypeOptions.forEach(opt => opt.classList.remove('active'));
            option.classList.add('active');
        });
    });
    
    // Duration selection
    durationOptions.forEach(option => {
        option.addEventListener('click', () => {
            durationOptions.forEach(opt => opt.classList.remove('active'));
            option.classList.add('active');
        });
    });
    
    // Calculate & update nutrition values 
    function updateNutritionDisplay() {
        const height = parseFloat(heightInput.value) || 0;
        const weight = parseFloat(weightInput.value) || 0;
        const age = parseFloat(ageInput.value) || 0;
        const gender = genderSelect.value;
        const activityFactor = parseFloat(activityLevel.value) || 0;
        
        if (height && weight && age && gender && activityFactor) {
            const userData = {
                height,
                weight,
                age,
                gender,
                activityFactor
            };
            
            const nutritionValues = calculateNutritionValues(userData);
            
            // Update UI with calculated values
            caloriesValue.textContent = nutritionValues.calories;
            proteinValue.textContent = nutritionValues.protein;
            carbsValue.textContent = nutritionValues.carbs;
            fatValue.textContent = nutritionValues.fat;
        }
    }
    
    // event listeners to form inputs
    heightInput.addEventListener('input', updateNutritionDisplay);
    weightInput.addEventListener('input', updateNutritionDisplay);
    ageInput.addEventListener('input', updateNutritionDisplay);
    genderSelect.addEventListener('change', updateNutritionDisplay);
    activityLevel.addEventListener('change', updateNutritionDisplay);

    generatePlanBtn.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Validate form
        const requiredInputs = [heightInput, weightInput, ageInput, genderSelect, activityLevel, budgetInput];
        let isValid = true;
        
        requiredInputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.style.borderColor = '#e74c3c';
            } else {
                input.style.borderColor = '#e8d7be';
            }
        });
        
        if (isValid) {
            const activeDietType = document.querySelector('.diet-type-option.active');
            const activeDuration = document.querySelector('.duration-option.active');
            
            summaryPlanType.textContent = activeDietType.querySelector('div:nth-child(2)').textContent;
            summaryCalories.textContent = caloriesValue.textContent;
            summaryDuration.textContent = activeDuration.querySelector('div:nth-child(1)').textContent;
            summaryBudget.textContent = '$' + budgetInput.value;
            
            personalPlanForm.style.display = 'none';
            personalPlanResults.classList.add('active');
            
            updateDayTabs(activeDuration.getAttribute('data-value'));
        }
    });
    
    // Update day tabs based on selected duration
    function updateDayTabs(durationValue) {
        const personalDayTabs = document.getElementById('personal-day-tabs');
        
        personalDayTabs.innerHTML = '';
        
        for (let i = 1; i <= durationValue; i++) {
            const dayTab = document.createElement('div');
            dayTab.className = i === 1 ? 'day-tab active' : 'day-tab';
            dayTab.textContent = 'Day ' + i;
            personalDayTabs.appendChild(dayTab);
            
            dayTab.addEventListener('click', () => {
                document.querySelectorAll('#personal-day-tabs .day-tab').forEach(tab => {
                    tab.classList.remove('active');
                });
                dayTab.classList.add('active');
            });
        }
    }
    
    if (backToFormBtn) {
        backToFormBtn.addEventListener('click', () => {
            personalPlanForm.style.display = 'block';
            personalPlanResults.classList.remove('active');
        });
    }
    
    const initialDayTabs = document.querySelectorAll('#personal-day-tabs .day-tab');
    initialDayTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            initialDayTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
    
    // Food details modal
    const detailsBtns = document.querySelectorAll('.details-btn');
    const foodDetailsModal = document.getElementById('food-details-modal');
    const closeModalBtns = document.querySelectorAll('.close-modal');
    
    detailsBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            foodDetailsModal.classList.add('active');
        });
    });
    
    // Food swap
    const swapIcons = document.querySelectorAll('.meal-item i');
    const foodSwapModal = document.getElementById('food-swap-modal');
    const swapItemName = document.getElementById('swap-item-name');
    const swapOptions = document.querySelectorAll('.swap-option');
    const swapConfirmBtn = document.getElementById('swap-confirm-btn');
    
    swapIcons.forEach(icon => {
        icon.addEventListener('click', (e) => {
            const foodName = e.target.parentElement.textContent.trim().replace(/\s+/g, ' ').split(' ').slice(0, -1).join(' ');
            swapItemName.textContent = foodName;
            
            foodSwapModal.classList.add('active');

            swapOptions.forEach(opt => opt.classList.remove('active'));
        });
    });
    
    // Swap option selection
    swapOptions.forEach(option => {
        option.addEventListener('click', () => {
            swapOptions.forEach(opt => opt.classList.remove('active'));
            option.classList.add('active');
        });
    });
    
    // Confirm swap button
    swapConfirmBtn.addEventListener('click', () => {
        const selectedOption = document.querySelector('.swap-option.active');
        if (selectedOption) {
            foodSwapModal.classList.remove('active');
        }
    });
    
    // Close modals
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            foodDetailsModal.classList.remove('active');
            foodSwapModal.classList.remove('active');
        });
    });
    
    window.addEventListener('click', (e) => {
        if (e.target === foodDetailsModal) {
            foodDetailsModal.classList.remove('active');
        }
        if (e.target === foodSwapModal) {
            foodSwapModal.classList.remove('active');
        }
    });
    
    // Save and export functionality
    const saveBtn = document.querySelector('.save-btn');
    const exportBtn = document.querySelector('.export-btn');
    
    if (saveBtn) {
        saveBtn.addEventListener('click', () => {
            alert('Plan saved successfully!');
        });
    }
    
    if (exportBtn) {
        exportBtn.addEventListener('click', () => {
            alert('Exporting plan as PDF...');
        });
    }
}); 
