/*
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.PS.Generator.js
Description     : Personalized Diet Plan - Generated Meals Plan for Members
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/


if (typeof window.FoodDB === 'undefined') {
    console.error('Food Database (FoodDB) not loaded. Please load DP.PS.FoodDB.js first.');
}

// PlanGenerator object
const PlanGenerator = {
    // Generate meal plan for multiple days
    generateMealPlan: function (
        dietType,
        duration,
        targetCalories,
        targetProtein,
        targetCarbs,
        targetFat,
        budget
    ) {
        const fullPlan = [];

        for (let day = 0; day < duration; day++) {
            const dailyPlan = this.generateDailyPlan(
                dietType,
                targetCalories,
                targetProtein,
                targetCarbs,
                targetFat,
                budget
            );

            fullPlan.push(dailyPlan);
        }

        return fullPlan;
    },

    // Generate meal plan for one day
    generateDailyPlan: function (dietType, targetCalories, targetProtein, targetCarbs, targetFat, budgetPerDay) {
        const mealDistribution = {
            breakfast: 0.25,
            lunch: 0.30,
            dinner: 0.30,
            snack: 0.15
        };

        const mealTargetCalories = {
            breakfast: targetCalories * mealDistribution.breakfast,
            lunch: targetCalories * mealDistribution.lunch,
            dinner: targetCalories * mealDistribution.dinner,
            snack: targetCalories * mealDistribution.snack
        };

        const mealTargetProtein = {
            breakfast: targetProtein * mealDistribution.breakfast,
            lunch: targetProtein * mealDistribution.lunch,
            dinner: targetProtein * mealDistribution.dinner,
            snack: targetProtein * mealDistribution.snack
        };

        const mealTargetCarbs = {
            breakfast: targetCarbs * mealDistribution.breakfast,
            lunch: targetCarbs * mealDistribution.lunch,
            dinner: targetCarbs * mealDistribution.dinner,
            snack: targetCarbs * mealDistribution.snack
        };

        const mealTargetFat = {
            breakfast: targetFat * mealDistribution.breakfast,
            lunch: targetFat * mealDistribution.lunch,
            dinner: targetFat * mealDistribution.dinner,
            snack: targetFat * mealDistribution.snack
        };

        const mealBudget = {
            breakfast: budgetPerDay * mealDistribution.breakfast,
            lunch: budgetPerDay * mealDistribution.lunch,
            dinner: budgetPerDay * mealDistribution.dinner,
            snack: budgetPerDay * mealDistribution.snack
        };

        const usedToday = {
            breakfast: new Set(),
            lunch: new Set(),
            dinner: new Set(),
            snack: new Set()
        };

        const dailyPlan = {
            breakfast: this.selectBestMeal('breakfast', dietType, mealTargetCalories.breakfast, mealTargetProtein.breakfast, mealTargetCarbs.breakfast, mealTargetFat.breakfast, mealBudget.breakfast, usedToday),
            lunch: this.selectBestMeal('lunch', dietType, mealTargetCalories.lunch, mealTargetProtein.lunch, mealTargetCarbs.lunch, mealTargetFat.lunch, mealBudget.lunch, usedToday),
            dinner: this.selectBestMeal('dinner', dietType, mealTargetCalories.dinner, mealTargetProtein.dinner, mealTargetCarbs.dinner, mealTargetFat.dinner, mealBudget.dinner, usedToday),
            snack: this.selectBestMeal('snack', dietType, mealTargetCalories.snack, mealTargetProtein.snack, mealTargetCarbs.snack, mealTargetFat.snack, mealBudget.snack, usedToday)
        };

        dailyPlan.totalCalories =
            dailyPlan.breakfast.calories +
            dailyPlan.lunch.calories +
            dailyPlan.dinner.calories +
            dailyPlan.snack.calories;

        dailyPlan.totalPrice =
            dailyPlan.breakfast.price +
            dailyPlan.lunch.price +
            dailyPlan.dinner.price +
            dailyPlan.snack.price;

        return dailyPlan;
    },

    selectBestMeal: function (mealType, dietType, targetCalories, targetProtein, targetCarbs, targetFat, budget, usedMeals) {
        const availableFoods = FoodDB.getFilteredFoods(mealType, dietType);

        const budgetedAndUnusedFoods = availableFoods.filter(food => {
            return food.price <= budget && !usedMeals[mealType].has(food.name);
        });

        if (budgetedAndUnusedFoods.length === 0) {
            return this.defaultEmptyFood("No suitable food");
        }

        const scoredFoods = budgetedAndUnusedFoods.map(food => {
            const calorieDeviation = Math.abs(food.calories - targetCalories) / targetCalories;
            const proteinDeviation = Math.abs(food.protein - targetProtein) / (targetProtein || 1);
            const carbsDeviation = Math.abs(food.carbs - targetCarbs) / (targetCarbs || 1);
            const fatDeviation = Math.abs(food.fat - targetFat) / (targetFat || 1);

            // Score based on nutritional deviations 
            const score =
                calorieDeviation * 0.4 +
                proteinDeviation * 0.2 +
                carbsDeviation * 0.2 +
                fatDeviation * 0.2;

            return { food, score };
        });

        scoredFoods.sort((a, b) => a.score - b.score);

        // Select from the top candidates 
        const topCandidates = scoredFoods.slice(0, 5);

        if (topCandidates.length > 0) {
            const chosen = topCandidates[Math.floor(Math.random() * topCandidates.length)].food;
            usedMeals[mealType].add(chosen.name); 
            return {
                name: chosen.name,
                calories: chosen.calories,
                protein: chosen.protein,
                carbs: chosen.carbs,
                fat: chosen.fat,
                price: chosen.price,
                groceryList: chosen.groceryList,
                cookingInstructions: chosen.cookingInstructions
            };
        }
        return this.defaultEmptyFood("No suitable food");
    },

    // Fallback empty food
    defaultEmptyFood: function (message = "No meal") {
        return {
            name: message,
            calories: 0,
            protein: 0,
            carbs: 0,
            fat: 0,
            price: 0,
            groceryList: [],
            cookingInstructions: []
        };
    }
};

window.PlanGenerator = PlanGenerator;
