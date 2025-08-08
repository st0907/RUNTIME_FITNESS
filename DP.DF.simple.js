/*
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.DF.Main.php
Description     : Diet Plans
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/

document.addEventListener('DOMContentLoaded', function() {
    
    // Get all plan cards
    const planCards = document.querySelectorAll('.plan-card');
    
    // click event to each plan card
    planCards.forEach((card, index) => {
        card.addEventListener('click', function() {
            
            // Remove active class from all cards
            planCards.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked card
            this.classList.add('active');
            
            const planType = this.getAttribute('data-plan');
            
            // Hide instructions and show meal plan section
            const instructionsText = document.getElementById('plan-instructions');
            const mealPlanSection = document.getElementById('meal-plan-section');
            
            if (instructionsText) {
                instructionsText.style.display = 'none';
            }
            
            if (mealPlanSection) {
                mealPlanSection.style.display = 'block';
            }
            
            window.updateMeals(planType, 'monday');
        });
    });
    
    const dayTabs = document.querySelectorAll('.day-tab');
    
    // click event to each day tab
    dayTabs.forEach((tab, index) => {
        tab.addEventListener('click', function() {
            
            // Remove active class from all tabs
            dayTabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            const activePlanCard = document.querySelector('.plan-card.active');
            if (activePlanCard) {
                const planType = activePlanCard.getAttribute('data-plan');
                const day = this.getAttribute('data-day');
                window.updateMeals(planType, day);
            }
        });
    });
});