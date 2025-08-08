/*Programmer Name: YEO PEI WEN (TP077057)
Program Name: W.P.Calculation.js
Description: Calculation BMI for workout page
First Written on: Saturday, 21-June-2025
Edited on: 08-JULY-2025*/

import { workoutData } from './W.P.WorkoutDB.js';

/**
 * Calculate BMI (Body Mass Index)
 * @param {number} weight - Weight in kg
 * @param {number} height - Height in cm
 * @returns {number} BMI value (rounded to 1 decimal place)
 */
export function calculateBMI(weight, height) {
  const heightM = height / 100;
  const bmi = (weight / (heightM * heightM)).toFixed(1);
  return parseFloat(bmi);
}

/**
 * Generate workout plan based on BMI
 * @param {number} weight - Weight in kg
 * @param {number} height - Height in cm
 * @returns {object} An object with BMI, Category, Suggested Workouts, Example Workouts, and Weekly Plan
 */
export function generateWorkoutPlan(weight, height) {
  const bmi = calculateBMI(weight, height);

  let data = {};

  if (bmi < 18.5) data = workoutData.underweight;
  else if (bmi < 25) data = workoutData.normal;
  else if (bmi < 30) data = workoutData.overweight;
  else if (bmi < 35) data = workoutData.obese1;
  else if (bmi < 40) data = workoutData.obese2;
  else if (bmi > 40) data = workoutData.obese3;

  return {
    BMI: bmi,
    Category: data.category,
    SuggestedWorkoutTypes: data.types,
    ExampleWorkouts: data.examples,
    WeeklyPlan: data.plan
  };
}
