/*
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.PS.GeneratedPlan.js
Description     : Javascript that Generate Meals for Members
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/

document.addEventListener('DOMContentLoaded', function() {
    // DOM elements
    const loadingIndicator = document.getElementById('loading-indicator');
    const mealPlanContainer = document.getElementById('meal-plan-container');
    const daysTabsContainer = document.getElementById('days-tabs');
    const daysContentContainer = document.getElementById('days-content');
    const prevDayBtn = document.getElementById('prev-day');
    const nextDayBtn = document.getElementById('next-day');
    
    // Summary elements
    const dietTypeEl = document.getElementById('diet-type');
    const dailyCaloriesEl = document.getElementById('daily-calories');
    const dailyBudgetEl = document.getElementById('daily-budget');
    const planDurationEl = document.getElementById('plan-duration');
    const dailyProteinEl = document.getElementById('daily-protein');
    const dailyCarbsEl = document.getElementById('daily-carbs');
    const dailyFatEl = document.getElementById('daily-fat');
    
    // Store current user preferences and meal plan
    let currentUserPreferences = {};
    let currentMealPlan = {};
    let currentActiveDay = 1;
    
    // Initialize the page
    init();
    
    // Main initialization function
    function init() {
        localStorage.removeItem('generatedMealPlan');
        
        loadUserPreferences();
        updateSummaryInfo();
        generatePlan();
        setupButtonHandlers();
        debugButtonElements();
    }
    
    // Load user preferences from localStorage
    function loadUserPreferences() {
        try {
            const planType = localStorage.getItem('ps_planType');
            const height = localStorage.getItem('ps_height');
            const weight = localStorage.getItem('ps_weight');
            const age = localStorage.getItem('ps_age');
            const gender = localStorage.getItem('ps_gender');
            const activity = localStorage.getItem('ps_activity');
            const goal = localStorage.getItem('ps_goal');
            const duration = localStorage.getItem('ps_duration');
            const budget = localStorage.getItem('ps_budget');
            
            const nutritionData = JSON.parse(localStorage.getItem('ps_nutrition') || '{}');

            // Store all preferences in the current state
            currentUserPreferences = {
                planType: planType || 'regular',
                height: parseFloat(height) || 170,
                weight: parseFloat(weight) || 70,
                age: parseInt(age) || 30,
                gender: gender || 'male',
                activity: activity || 'moderate',
                goal: goal || 'maintain',
                duration: duration || '7',
                budget: parseFloat(budget) || 50,
                calories: nutritionData.calories || 2000,
                protein: nutritionData.protein || 125,
                carbs: nutritionData.carbs || 250,
                fat: nutritionData.fat || 67
            };
            
            // Check if there's a saved meal plan
            const savedMealPlan = localStorage.getItem('generatedMealPlan');
            if (savedMealPlan) {
                currentMealPlan = JSON.parse(savedMealPlan);
            }
            
        } catch (error) {
            console.error('Error loading user preferences:', error);
            
            // Default values if loading fails
            currentUserPreferences = {
                planType: 'regular',
                height: 170,
                weight: 70,
                age: 30,
                gender: 'male',
                activity: 'moderate',
                goal: 'maintain',
                duration: '7',
                budget: 50,
                calories: 2000,
                protein: 125,
                carbs: 250,
                fat: 67
            };
        }
    }
    
    // Update plan summary information
    function updateSummaryInfo() {
        const dietTypeNames = {
            'regular': 'Regular Diet',
            'keto': 'Keto Diet',
            'vegan': 'Vegan Diet',
            'vegetarian': 'Vegetarian Diet',
            'pescatarian': 'Pescatarian Diet',
            'dairy-free': 'Dairy-Free Diet',
            'gluten-free': 'Gluten-Free Diet',
            'low-carb': 'Low Carb Diet',
            'home-cook': 'Simple Home Cooking'
        };
        
        const durationText = {
            '1': '1 Day',
            '3': '3 Days',
            '7': '7 Days'
        };
        
        // Update DOM elements with user preferences
        dietTypeEl.textContent = dietTypeNames[currentUserPreferences.planType] || currentUserPreferences.planType;
        dailyCaloriesEl.textContent = `${currentUserPreferences.calories} kcal`;
        dailyBudgetEl.textContent = `RM${currentUserPreferences.budget.toFixed(2)}`;
        planDurationEl.textContent = durationText[currentUserPreferences.duration] || `${currentUserPreferences.duration} Days`;
        dailyProteinEl.textContent = `${currentUserPreferences.protein}g`;
        dailyCarbsEl.textContent = `${currentUserPreferences.carbs}g`;
        dailyFatEl.textContent = `${currentUserPreferences.fat}g`;
    }

    function setupButtonHandlers() {
        function addEventListenerSafely(id, event, handler, label) {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener(event, handler);
            } else {
            }
        }

        // Save plan button
        addEventListenerSafely('save-plan-btn', 'click', function() {
            saveMealPlan();
        }, 'Save plan');
        
        // Regenerate button
        addEventListenerSafely('regenerate-plan-btn', 'click', function() {
            generatePlan();
        }, 'Regenerate plan');
        
        // Print/Export PDF button
        addEventListenerSafely('print-plan-btn', 'click', function() {
            exportToPDF();  
        }, 'Print/Export PDF');
        
        // View Saved Plans button
        addEventListenerSafely('view-plan-btn', 'click', function() {
            window.location.href = 'DP.SP.PlansList.php';
        }, 'View Saved Plans');

        // New Plan button
        addEventListenerSafely('new-plan-btn', 'click', function() {
            window.location.href = 'DP.PS.Main.php';
        }, 'New Plan');

        // Navigation buttons
        addEventListenerSafely('prev-day', 'click', function() {
            if (currentActiveDay > 1) {
                selectDay(currentActiveDay - 2, currentMealPlan.length); // -2 because selectDay expects 0-based index
            }
        }, 'Previous day');
        
        addEventListenerSafely('next-day', 'click', function() {
            if (currentActiveDay < currentMealPlan.length) {
                selectDay(currentActiveDay, currentMealPlan.length); // currentActiveDay is 1-based, so pass as index
            }
        }, 'Next day');
        
        // Confirmation buttons in modals
        addEventListenerSafely('confirm-save-btn', 'click', function() {
            const saveModal = document.getElementById('save-modal');
            if (saveModal) saveModal.style.display = 'none';
        }, 'Confirm save');
        
        addEventListenerSafely('confirm-grocery-notice-btn', 'click', function() {
            const groceryNoticeModal = document.getElementById('grocery-notice-modal');
            if (groceryNoticeModal) groceryNoticeModal.style.display = 'none';
        }, 'Confirm grocery notice');

        // Modal close buttons
        const closeButtons = document.querySelectorAll('.close-modal');
        if (closeButtons.length > 0) {
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (modal) modal.style.display = 'none';
                });
            });
        }
    }
    
    // Generate meal plan
    function generatePlan() {
        loadingIndicator.style.display = 'block';

        daysTabsContainer.innerHTML = '';
        daysContentContainer.innerHTML = '';

        setTimeout(() => {
            try {
                const duration = 7;
                currentMealPlan = [];

                const usedMealsAcrossPlan = new Set(); 

                for (let i = 0; i < duration; i++) {
                    const dailyPlan = window.PlanGenerator.generateDailyPlan(
                        currentUserPreferences.planType,
                        currentUserPreferences.calories,
                        currentUserPreferences.protein,
                        currentUserPreferences.carbs,
                        currentUserPreferences.fat,
                        currentUserPreferences.budget,
                        usedMealsAcrossPlan  
                    );
                    currentMealPlan.push(dailyPlan);
                }
                localStorage.setItem('generatedMealPlan', JSON.stringify(currentMealPlan));
                renderTabbedMealPlan();
                loadingIndicator.style.display = 'none';
            } catch (error) {
                loadingIndicator.style.display = 'none';
                alert('Error generating meal plan. Please try again.');
            }
        }, 500);
    }
    
    function renderTabbedMealPlan() {
    const numberOfDays = currentMealPlan.length;

    daysTabsContainer.innerHTML = '';
    daysContentContainer.innerHTML = '';

    for (let i = 0; i < numberOfDays; i++) {
        const dayNumber = i + 1;
        // Create tab
        const tab = document.createElement('div');
        tab.className = `day-tab ${dayNumber === currentActiveDay ? 'active' : ''}`;
        tab.setAttribute('data-day', i); 
        tab.textContent = `Day ${dayNumber}`;
        tab.addEventListener('click', () => selectDay(i, numberOfDays));
        daysTabsContainer.appendChild(tab);

        // Create content for this day
        const dayCard = document.createElement('div');
        dayCard.className = `day-card ${dayNumber === currentActiveDay ? 'active' : ''}`;
        dayCard.id = `day-${i}`;
        const mealContainer = document.createElement('div');
        mealContainer.className = 'meal-container';

        // Create sections for each meal type
        const mealTypes = ['breakfast', 'lunch', 'dinner', 'snack'];
        mealTypes.forEach(mealType => {
            const mealFoods = currentMealPlan[i][mealType];
            renderMealSection(mealType, Array.isArray(mealFoods) ? mealFoods : [mealFoods], mealContainer, i);
        });

        dayCard.appendChild(mealContainer);
        daysContentContainer.appendChild(dayCard);
    }

    // Update navigation buttons
    updateNavigationButtons(currentActiveDay, numberOfDays);
}
    
    // Select and display a specific day
    function selectDay(dayIndex, totalDays) {
        currentActiveDay = dayIndex + 1; 
        // Update tabs
        document.querySelectorAll('.day-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        const activeTab = document.querySelector(`.day-tab[data-day="${dayIndex}"]`);
        if (activeTab) {
            activeTab.classList.add('active');
            activeTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
        // Update content
        document.querySelectorAll('.day-card').forEach(content => {
            content.classList.remove('active');
        });
        const activeContent = document.getElementById(`day-${dayIndex}`);
        if (activeContent) {
            activeContent.classList.add('active');
        }
        // Update navigation buttons
        updateNavigationButtons(currentActiveDay, totalDays);
    }
    
    // Update navigation button states
    function updateNavigationButtons(currentDay, totalDays) {
        prevDayBtn.disabled = currentDay === 1;
        nextDayBtn.disabled = currentDay === totalDays;
    }
    
    // Show meal details in modal
    function showMealDetails(meal, title) {
        
        // Set modal title
        document.getElementById('modal-meal-title').textContent = title;
        
        // Update nutrition information
        document.getElementById('modal-calories').textContent = meal.calories + ' kcal';
        document.getElementById('modal-fat').textContent = meal.fat + 'g';
        document.getElementById('modal-carbs').textContent = meal.carbs + 'g';
        document.getElementById('modal-protein').textContent = meal.protein + 'g';
        
        // Populate grocery list
        const groceryContainer = document.getElementById('modal-grocery');
        groceryContainer.innerHTML = '';
        
        if (meal.groceryList && meal.groceryList.length > 0) {
            meal.groceryList.forEach(item => {
                const groceryItem = document.createElement('li');
                groceryItem.className = 'grocery-item';
                groceryItem.innerHTML = `
                    <input type="checkbox" class="grocery-checkbox">
                    <span class="grocery-name">${item.item || item.name}</span>
                    <span class="grocery-quantity">${item.quantity}</span>
                `;
                groceryContainer.appendChild(groceryItem);
            });
        } else {
            groceryContainer.innerHTML = '<p>No grocery information available.</p>';
        }
        
        // Populate cooking instructions
        const instructionsContainer = document.getElementById('modal-instructions');
        instructionsContainer.innerHTML = '';
        
        if (meal.cookingInstructions && meal.cookingInstructions.length > 0) {
            meal.cookingInstructions.forEach(instruction => {
                const instructionItem = document.createElement('li');
                instructionItem.className = 'cooking-step';
                instructionItem.textContent = instruction;
                instructionsContainer.appendChild(instructionItem);
            });
        } else {
            instructionsContainer.innerHTML = '<p>No cooking instructions available.</p>';
        }
        
        // Show the modal
        const modal = document.getElementById('details-modal');
        if (modal) {
            modal.style.display = 'block';
        }
    }
    
    // Show swap modal with alternatives
    function showSwapModal(day, mealType, currentFood) {
        const dayIndex = day;
        document.getElementById('swap-modal-title').textContent = `Swap ${currentFood.name}`;
        const alternativesContainer = document.getElementById('food-alternatives');
        alternativesContainer.innerHTML = '';
        const mealDistribution = {
            breakfast: 0.25,
            lunch: 0.30,
            dinner: 0.30,
            snack: 0.15
        };
        const targetCalories = currentUserPreferences.calories * mealDistribution[mealType];
        const targetProtein = currentUserPreferences.protein * mealDistribution[mealType];
        const targetCarbs = currentUserPreferences.carbs * mealDistribution[mealType];
        const targetFat = currentUserPreferences.fat * mealDistribution[mealType];
        const mealBudget = currentUserPreferences.budget * mealDistribution[mealType];
        // Get alternatives
        const alternatives = FoodSwapper.findAlternatives(
            currentFood,
            mealType,
            currentUserPreferences.planType,
            mealBudget,
            targetCalories,
            targetProtein,
            targetCarbs,
            targetFat
        );
        if (alternatives.length === 0) {
            const noAlternativesMsg = document.createElement('p');
            noAlternativesMsg.textContent = 'No suitable alternatives found for this meal.';
            noAlternativesMsg.style.textAlign = 'center';
            noAlternativesMsg.style.padding = '20px';
            noAlternativesMsg.style.color = '#8c7851';
            alternativesContainer.appendChild(noAlternativesMsg);
        } else {
            const dailyTotals = {
                calories: currentMealPlan[dayIndex].totalCalories,
                protein: currentMealPlan[dayIndex].breakfast.protein + 
                        currentMealPlan[dayIndex].lunch.protein + 
                        currentMealPlan[dayIndex].dinner.protein + 
                        currentMealPlan[dayIndex].snack.protein,
                carbs: currentMealPlan[dayIndex].breakfast.carbs + 
                       currentMealPlan[dayIndex].lunch.carbs + 
                       currentMealPlan[dayIndex].dinner.carbs + 
                       currentMealPlan[dayIndex].snack.carbs,
                fat: currentMealPlan[dayIndex].breakfast.fat + 
                     currentMealPlan[dayIndex].lunch.fat + 
                     currentMealPlan[dayIndex].dinner.fat + 
                     currentMealPlan[dayIndex].snack.fat,
                price: currentMealPlan[dayIndex].totalPrice
            };
            // Create alternative cards
            alternatives.forEach(food => {
                const impact = FoodSwapper.calculateSwapImpact(currentFood, food, dailyTotals);
                const alternativeCard = document.createElement('div');
                alternativeCard.className = 'alternative-card';
                
                const getChangeClass = (percentChange) => {
                    if (percentChange > 5) return 'negative-change';
                    if (percentChange < -5) return 'positive-change';
                    return 'neutral-change';
                };
                
                const getChangeSign = (value) => {
                    return value > 0 ? '+' : '';
                };
                
                
                alternativeCard.innerHTML = `
    <div class="alt-card-header">
        <h3 class="alt-food-name">${food.name}</h3>
    </div>
    <div class="alternative-details">
        <div class="alternative-nutrition alt-nutrition-vertical">
            <div class="nutrition-item nutrition-vertical-box">
                <div>
                    <span class="nutrient-label">Calories:</span>
                    <span class="nutrient-value">${food.calories} cal</span>
                    <span class="nutrient-diff ${getChangeClass(impact.percentChanges.calories)}">
                        (${getChangeSign(impact.differences.calories)}${impact.differences.calories} cal)
                    </span>
                </div>
                <div>
                    <span class="nutrient-label">Protein:</span>
                    <span class="nutrient-value">${food.protein}g</span>
                    <span class="nutrient-diff ${getChangeClass(impact.percentChanges.protein)}">
                        (${getChangeSign(impact.differences.protein)}${impact.differences.protein}g)
                    </span>
                </div>
                <div>
                    <span class="nutrient-label">Carbs:</span>
                    <span class="nutrient-value">${food.carbs}g</span>
                    <span class="nutrient-diff ${getChangeClass(impact.percentChanges.carbs)}">
                        (${getChangeSign(impact.differences.carbs)}${impact.differences.carbs}g)
                    </span>
                </div>
                <div>
                    <span class="nutrient-label">Fat:</span>
                    <span class="nutrient-value">${food.fat}g</span>
                    <span class="nutrient-diff ${getChangeClass(impact.percentChanges.fat)}">
                        (${getChangeSign(impact.differences.fat)}${impact.differences.fat}g)
                    </span>
                </div>
            </div>
        </div>
        <div class="alternative-price">
            <span>Price:</span>
            <span>RM${food.price.toFixed(2)}</span>
            <span class="${getChangeClass(impact.percentChanges.price)}">
                (${getChangeSign(impact.differences.price)}RM${impact.differences.price.toFixed(2)})
            </span>
        </div>
    </div>
    <div class="alternative-actions">
        <button class="btn-select-alternative" data-day="${day}" data-meal-type="${mealType}" data-food-index="${alternatives.indexOf(food)}">
            Select
        </button>
        <button class="btn-view-details">
            View Details
        </button>
    </div>
`;
                alternativesContainer.appendChild(alternativeCard);
                
                const viewDetailsBtn = alternativeCard.querySelector('.btn-view-details');
                viewDetailsBtn.addEventListener('click', () => {
                    document.getElementById('swap-modal').style.display = 'none';
                    showMealDetails(food, food.name);
                });
                
                const selectBtn = alternativeCard.querySelector('.btn-select-alternative');
                selectBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedFoodIndex = parseInt(this.getAttribute('data-food-index'));
                    const selectedFood = alternatives[selectedFoodIndex];

                    if (currentMealPlan && currentMealPlan[day] && currentMealPlan[day][mealType]) {
                        if (Array.isArray(currentMealPlan[day][mealType])) {
                            const foodIdx = currentMealPlan[day][mealType].findIndex(f => f.name === currentFood.name);
                            if (foodIdx !== -1) {
                                currentMealPlan[day][mealType][foodIdx] = selectedFood;
                            }
                        } else {
                            currentMealPlan[day][mealType] = selectedFood;
                        }
                    }

                    // Save to localStorage for both keys 
                    localStorage.setItem('mealPlan', JSON.stringify(currentMealPlan));
                    localStorage.setItem('generatedMealPlan', JSON.stringify(currentMealPlan));

                    // Re-render the meal plan UI
                    renderTabbedMealPlan();

                    selectBtn.disabled = true;
                    selectBtn.innerHTML = '<i class="fas fa-check"></i> Selected!';
                    selectBtn.style.background = '#b38b4f';
                    selectBtn.style.color = '#fffbe6';
                    selectBtn.style.transition = 'background 0.3s, color 0.3s';
                    // Show a temporary message
                    let msg = document.createElement('div');
                    msg.className = 'swap-success-msg';
                    msg.innerHTML = '<i class="fas fa-check-circle"></i> Food swapped!';
                    msg.style.cssText = 'margin-top:12px;color:#8D7151;font-weight:600;background:#fffbe6;border-radius:8px;padding:8px 18px;box-shadow:0 2px 8px #e5dbc7;display:inline-block;animation:fadeInOut 2s;';
                    selectBtn.parentNode.appendChild(msg);
                    setTimeout(() => {
                        msg.remove();
                        selectBtn.disabled = false;
                        selectBtn.innerHTML = 'Select';
                        selectBtn.style.background = '';
                        selectBtn.style.color = '';
                        // Close modal after the message disappears
                        document.getElementById('swap-modal').style.display = 'none';
                    }, 1800);
                });
            });
        }
        document.getElementById('swap-modal').style.display = 'block';
    }
    
    // Render meal section
    function renderMealSection(mealType, foods, container, day) {
        const mealTitle = mealType.charAt(0).toUpperCase() + mealType.slice(1);
        
        // Set appropriate icon for meal type
        let mealIcon;
        switch(mealType.toLowerCase()) {
            case 'breakfast':
                mealIcon = 'fa-coffee';
                break;
            case 'lunch':
                mealIcon = 'fa-utensils';
                break;
            case 'dinner':
                mealIcon = 'fa-moon';
                break;
            case 'snack':
                mealIcon = 'fa-apple-alt';
                break;
            default:
                mealIcon = 'fa-utensils';
        }
        
        const meal = document.createElement('div');
        meal.className = 'meal';
        meal.dataset.day = day;
        meal.dataset.mealType = mealType;

        const mealLeft = document.createElement('div');
        mealLeft.className = 'meal-left';

        const mealIconDiv = document.createElement('div');
        mealIconDiv.className = 'meal-icon';
        mealIconDiv.innerHTML = `<i class="fas ${mealIcon}"></i>`;

        const mealContent = document.createElement('div');
        mealContent.className = 'meal-content';

        const mealTitleDiv = document.createElement('div');
        mealTitleDiv.className = 'meal-title';
        mealTitleDiv.textContent = mealTitle;

        const mealItems = document.createElement('div');
        mealItems.className = 'meal-items';

        // Create meal items
        foods.forEach(food => {
            const mealItem = document.createElement('div');
            mealItem.className = 'meal-item';
            mealItem.textContent = food.name;
            mealItems.appendChild(mealItem);
        });

        // Calculate total calories and price
        const totalCalories = foods.reduce((sum, food) => sum + food.calories, 0);
        const totalPrice = foods.reduce((sum, food) => sum + food.price, 0);

        const mealInfo = document.createElement('div');
        mealInfo.className = 'meal-info';
        mealInfo.innerHTML = `
            <span><i class="fas fa-fire"></i> ${totalCalories} kcal</span>
            <span><i class="fas fa-dollar-sign"></i> RM${totalPrice.toFixed(2)}</span>
        `;

        const mealActions = document.createElement('div');
        mealActions.className = 'meal-actions';
        
        // Create Details button
        const detailsButton = document.createElement('button');
        detailsButton.className = 'btn-details';
        detailsButton.innerHTML = '<i class="fas fa-info-circle"></i> Details';
        detailsButton.addEventListener('click', () => {
            showMealDetails(foods[0], mealTitle);
        });
        
        // Create Swap button
        const swapButton = document.createElement('button');
        swapButton.className = 'btn-swap';
        swapButton.innerHTML = '<i class="fas fa-sync-alt"></i> Swap';
        
        // swap button
        swapButton.addEventListener('click', () => {
            showSwapModal(day, mealType, foods[0]);
        });
        
        mealActions.appendChild(detailsButton);
        mealActions.appendChild(swapButton);

        mealContent.appendChild(mealTitleDiv);
        mealContent.appendChild(mealItems);
        mealContent.appendChild(mealInfo);

        mealLeft.appendChild(mealIconDiv);
        mealLeft.appendChild(mealContent);

        meal.appendChild(mealLeft);
        meal.appendChild(mealActions);

        container.appendChild(meal);
    }
    
    function saveMealPlan() {
        const planTitle = `Meal Plan - ${new Date().toLocaleString()}`;

        const dataToSave = {
            user_id: USER_ID, 
            title: planTitle,
            plan_data: currentMealPlan
        };

        fetch('DP.PS.ProcessSavePlan.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(dataToSave),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Your meal plan has been saved successfully!');
                localStorage.setItem('generatedMealPlan', JSON.stringify(currentMealPlan));
            } else {
                alert('Error saving meal plan: ' + data.message);
            }
        })
        .catch((error) => {
            alert('An error occurred while trying to save your meal plan.');
        });
    }
    
    //for debugging
    function debugButtonElements() {
        const buttonIds = [
            'save-plan-btn',
            'regenerate-plan-btn',
            'view-plan-btn',
            'new-plan-btn',
            'prev-day',
            'next-day',
            'confirm-grocery-notice-btn'
        ];
        
        buttonIds.forEach(id => {
            const element = document.getElementById(id);
        });
    }
    
    // calorie and macro calculations
    function calculateBMR(height, weight, age, gender) {
        height = parseFloat(height);
        weight = parseFloat(weight);
        age = parseInt(age);
        
        if (gender === 'male') {
            return (10 * weight) + (6.25 * height) - (5 * age) + 5;
        } else {
            return (10 * weight) + (6.25 * height) - (5 * age) - 161;
        }
    }
    
    function calculateTDEE(bmr, activityLevel) {
        const activityMultipliers = {
            'sedentary': 1.2,
            'light': 1.375,
            'moderate': 1.55,
            'very': 1.725,
            'extra': 1.9
        };
        
        const multiplier = activityMultipliers[activityLevel] || 1.55;
        return bmr * multiplier;
    }
    
    function calculateGoalCalories(tdee, goal) {
        const goalMultipliers = {
            'lose': 0.8,    // 20% deficit for weight loss
            'maintain': 1,  // Maintenance
            'gain': 1.15    // 15% surplus for weight gain
        };
        
        const multiplier = goalMultipliers[goal] || 1;
        return tdee * multiplier;
    }

const style = document.createElement('style');
style.innerHTML = `@keyframes fadeInOut { 0%{opacity:0;} 10%{opacity:1;} 90%{opacity:1;} 100%{opacity:0;} }`;
document.head.appendChild(style);
});
