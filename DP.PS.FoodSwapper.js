/*
Programmer Name : Siew Zhen Lynn (TP076386)
Program Name    : DP.PS.FoodSwapper.js
Description     : Food Swapping Functionality 
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/

if (typeof window.FoodDB === 'undefined') {
}

const FoodSwapper = {
    findAlternatives: function(currentFood, mealType, dietType, budget, targetCalories, targetProtein, targetCarbs, targetFat) {
        const availableFoods = FoodDB.getFilteredFoods(mealType, dietType);
        
        // Filter out current food
        const alternatives = availableFoods.filter(food => food.name !== currentFood.name);
        
        if (alternatives.length === 0) {
            return [];
        }
        
        // Calculate score for each alternative 
        const scoredAlternatives = alternatives.map(food => {
            if (food.price > budget) {
                return { food, score: -Infinity };
            }
            
            // Calculate similarity to current food's nutritional
            const calorieDeviation = Math.abs(food.calories - currentFood.calories) / currentFood.calories;
            const proteinDeviation = Math.abs(food.protein - currentFood.protein) / (currentFood.protein || 1);
            const carbsDeviation = Math.abs(food.carbs - currentFood.carbs) / (currentFood.carbs || 1);
            const fatDeviation = Math.abs(food.fat - currentFood.fat) / (currentFood.fat || 1);
            
            // Calculate deviation from target nutritional values
            const targetCalorieDeviation = Math.abs(food.calories - targetCalories) / targetCalories;
            const targetProteinDeviation = Math.abs(food.protein - targetProtein) / (targetProtein || 1);
            const targetCarbsDeviation = Math.abs(food.carbs - targetCarbs) / (targetCarbs || 1);
            const targetFatDeviation = Math.abs(food.fat - targetFat) / (targetFat || 1);
            
            // Calculate price similarity 
            const priceSimilarity = 1 - Math.abs(food.price - currentFood.price) / currentFood.price;
            
            // Calculate total score 
            const score = 
                (calorieDeviation * 0.3) + 
                (proteinDeviation * 0.15) + 
                (carbsDeviation * 0.15) + 
                (fatDeviation * 0.15) + 
                (targetCalorieDeviation * 0.1) + 
                (targetProteinDeviation * 0.05) + 
                (targetCarbsDeviation * 0.05) + 
                (targetFatDeviation * 0.05) - 
                (priceSimilarity * 0.1); 
            
            return { food, score };
        });
        
        scoredAlternatives.sort((a, b) => a.score - b.score);
        
        // Return top alternative
        return scoredAlternatives
            .filter(item => item.score !== -Infinity)
            .slice(0, 5) 
            .map(item => item.food);
    },
    
    calculateSwapImpact: function(currentFood, newFood, dailyTotals) {
        const caloriesDiff = newFood.calories - currentFood.calories;
        const proteinDiff = newFood.protein - currentFood.protein;
        const carbsDiff = newFood.carbs - currentFood.carbs;
        const fatDiff = newFood.fat - currentFood.fat;
        const priceDiff = newFood.price - currentFood.price;
        
        const newTotals = {
            calories: dailyTotals.calories + caloriesDiff,
            protein: dailyTotals.protein + proteinDiff,
            carbs: dailyTotals.carbs + carbsDiff,
            fat: dailyTotals.fat + fatDiff,
            price: dailyTotals.price + priceDiff
        };
        const percentChanges = {
            calories: (caloriesDiff / dailyTotals.calories) * 100,
            protein: (proteinDiff / dailyTotals.protein) * 100,
            carbs: (carbsDiff / dailyTotals.carbs) * 100,
            fat: (fatDiff / dailyTotals.fat) * 100,
            price: (priceDiff / dailyTotals.price) * 100
        };
        
        return {
            currentTotals: dailyTotals,
            newTotals: newTotals,
            differences: {
                calories: caloriesDiff,
                protein: proteinDiff,
                carbs: carbsDiff,
                fat: fatDiff,
                price: priceDiff
            },
            percentChanges: percentChanges
        };
    },
    
    // Swap food item 
    swapFood: function(mealPlan, day, mealType, currentFoodName, newFood) {
        const updatedMealPlan = JSON.parse(JSON.stringify(mealPlan));
        
        updatedMealPlan[day][mealType] = {
            name: newFood.name,
            calories: newFood.calories,
            protein: newFood.protein,
            carbs: newFood.carbs,
            fat: newFood.fat,
            price: newFood.price,
            groceryList: newFood.groceryList,
            cookingInstructions: newFood.cookingInstructions
        };
        
        // Recalculate daily totals
        updatedMealPlan[day].totalCalories = 
            updatedMealPlan[day].breakfast.calories + 
            updatedMealPlan[day].lunch.calories + 
            updatedMealPlan[day].dinner.calories + 
            updatedMealPlan[day].snack.calories;
            
        updatedMealPlan[day].totalPrice = 
            updatedMealPlan[day].breakfast.price + 
            updatedMealPlan[day].lunch.price + 
            updatedMealPlan[day].dinner.price + 
            updatedMealPlan[day].snack.price;
        
        return updatedMealPlan;
    }
};

window.FoodSwapper = FoodSwapper; 
