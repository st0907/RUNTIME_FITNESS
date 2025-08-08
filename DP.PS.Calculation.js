/*
Programmer Name : Siew Zhen Lynn (TP076386)
Program Name    : DP.PS.Calculation.js
Description     : Calculate nutrition values based on user details
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/

/**
 * Calculate BMR 
 * @param {number} weight - kg
 * @param {number} height - cm
 * @param {number} age - years
 * @param {string} gender - 'male' or 'female'
 * @returns {number} BMR value
 */
function calculateBMR(weight, height, age, gender) {
    if (gender === 'male') {
        return 10 * weight + 6.25 * height - 5 * age + 5;
    } else {
        return 10 * weight + 6.25 * height - 5 * age - 161;
    }
}

/**
 * Calculate TDEE 
 * @param {number} bmr - Basal Metabolic Rate
 * @param {number} activityFactor - Activity level factor
 * @returns {number} TDEE value (calories)
 */
function calculateTDEE(bmr, activityFactor) {
    return Math.round(bmr * activityFactor);
}

/**
 * Calculate protein requirements
 * @param {number} weight - Weight in kg
 * @returns {number} Protein in grams
 */
function calculateProtein(weight) {
    // 1.6g per kg of bodyweight for active individuals
    return Math.round(weight * 1.6);
}

/**
 * Calculate fat requirements
 * @param {number} calories - Total daily calories
 * @returns {number} Fat in grams
 */
function calculateFat(calories) {
    // 30% of calories from fat (1g fat = 9 calories)
    return Math.round(calories * 0.3 / 9);
}

/**
 * Calculate carbohydrate requirements
 * @param {number} calories - Total daily calories
 * @param {number} protein - Protein in grams
 * @param {number} fat - Fat in grams
 * @returns {number} Carbs in grams
 */
function calculateCarbs(calories, protein, fat) {
    // Remaining calories from carbs (1g carbs = 4 calories)
    return Math.round((calories - (protein * 4) - (fat * 9)) / 4);
}

/**
 * Calculate all nutrition values based on user inputs
 * @param {object} userData - User data including height, weight, age, gender, and activity level
 * @returns {object} Calculated nutrition values
 */
function calculateNutritionValues(userData) {
    const { height, weight, age, gender, activityFactor } = userData;
    
    const bmr = calculateBMR(weight, height, age, gender);
    const calories = calculateTDEE(bmr, activityFactor);
    const protein = calculateProtein(weight);
    const fat = calculateFat(calories);
    const carbs = calculateCarbs(calories, protein, fat);
    
    return {
        calories,
        protein,
        carbs,
        fat
    };
} 
