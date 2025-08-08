<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.PS.step3.php
Description     : Personalized Diet Plan - Step 3 Recommended Daily Nutrients
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
-->
<?php
    session_start();

    if (!isset($_SESSION['usr_user_id'])) {
        echo "<script>
            alert(\"You must be logged in to access the homepage.\\nYou will be redirected to the login page.\");
            window.location.replace('login.html');
        </script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Daily Nutrients - RunTime Fitness</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="DP.css">
    <style>
        /* Back Button */
        .back-button {
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
            color: #8D7151;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .back-button:hover {
            color: #6a4819;
        }

        .back-button i {
            margin-right: 5px;
        }

        /* Plan Header */
        .plan-header {
            text-align: center;
            margin: 20px 0 30px;
        }

        .plan-header h1 {
            color: #6a4819;
            margin-bottom: 10px;
            font-size: 2rem;
        }

        /* Recommended Daily Values */
        .chart-container {
            position: relative;
            height: auto;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .bar-chart-classic {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 90%;
            max-width: 700px;
            height: auto;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .bar-column {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            height: 50px;
            flex: none;
            margin: 10px 0;
            width: 100%;
            gap: 10px;
        }

        .bar {
            height: 30px;
            width: 0;
            min-width: 20px;
            background-color: #8D7151;
            border-radius: 5px;
            transition: width 1.5s ease-out, background-color 0.3s ease;
            transform-origin: left;
        }

        .bar.calories-bar { background-color: #6a4819; }
        .bar.protein-bar { background-color: #8D7151; }
        .bar.carbs-bar { background-color: #b38b4f; }
        .bar.fat-bar { background-color: #d4b88c; }

        .bar-label {
            margin-top: 0;
            font-size: 0.9rem;
            color: #6a4819;
            font-weight: 600;
            text-align: left;
        }

        .bar-value-display {
            position: relative;
            left: auto;
            top: auto;
            min-width: 80px;
            text-align: right;
            font-size: 0.85rem;
            color: #6a4819;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.5s ease 1s;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .bar-chart-classic {
                height: auto;
                padding: 15px 0;
            }
            .bar {
                height: 25px;
                min-width: 15px;
            }
            .bar-label {
                font-size: 0.8rem;
            }
            .bar-value-display {
                font-size: 0.75rem;
                min-width: 60px;
            }
        }

        /* Remove old nutrition grid styles */
        .nutrition-grid,
        .nutrition-item {
            display: none; 
        }

        .nutrition-label {
            font-size: 1rem;
            color: #8c7851;
            margin-bottom: 10px;
        }

        .nutrition-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #6a4819;
        }

        /* Plan Duration Options */
        .plan-duration-options {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin: 60px 0;
        }

        .duration-option {
            flex: 1;
            min-width: 150px;
            padding: 20px;
            background-color: #fff;
            border: 2px solid transparent;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(106, 72, 25, 0.1);
        }

        .duration-option:hover {
            background-color: #f9f6f0;
        }

        .duration-option.active {
            background-color: rgba(179, 139, 79, 0.1);
            border-color: #b38b4f;
        }

        .duration-option div:first-child {
            font-size: 1.2rem;
            font-weight: 600;
            color: #6a4819;
            margin-bottom: 5px;
        }

        .option-desc {
            font-size: 0.9rem;
            color: #8c7851;
        }

        /* Buttons */
        .button-container {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
        }

        .back-btn, .generate-btn, .save-btn, .export-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn {
            background-color: #f0e6d6;
            color: #6a4819;
        }

        .back-btn:hover {
            background-color: #e5d9c3;
        }

        .generate-btn, .save-btn {
            background-color: #8D7151;
            color: white;
        }

        .generate-btn:hover, .save-btn:hover {
            background-color: #6a4819;
            transform: translateY(-2px);
        }

        .export-btn {
            background-color: #fff;
            color: #6a4819;
            border: 1px solid #e0e0e0;
        }

        .export-btn:hover {
            background-color: #f5f0e2;
            transform: translateY(-2px);
        }

        .generate-btn i, .save-btn i, .export-btn i {
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .plan-duration-options {
                flex-direction: column;
            }
            
            .duration-option {
                width: 100%;
            }
            
            .nutrition-grid {
                flex-direction: column;
            }
            
            .nutrition-item {
                width: 100%;
            }
            
            .button-container {
                flex-direction: column;
                gap: 15px;
            }
            
            .action-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .back-btn, .generate-btn, .save-btn, .export-btn {
                width: 100%;
                justify-content: center;
            }
        }

        .nutritionist-section {
            display: flex;
            align-items: center;
            gap: 18px;
            margin: 30px 0 20px 0;
        }
        .nutritionist-avatar {
            width: 90px;
            height: 90px;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 8px rgba(106,72,25,0.10);
            animation: float 3s ease-in-out infinite;
            flex-shrink: 0;
            cursor: pointer;
            transition: box-shadow 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .nutritionist-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .nutritionist-avatar:hover {
            box-shadow: 0 6px 18px rgba(106,72,25,0.18);
        }
        @keyframes float {
            0% { transform: translateY(0);}
            50% { transform: translateY(-10px);}
            100% { transform: translateY(0);}
        }
        .nutritionist-bubble {
            background: #fff;
            border-radius: 18px 18px 18px 4px;
            box-shadow: 0 2px 8px rgba(106,72,25,0.08);
            padding: 18px 22px;
            font-size: 1.08rem;
            max-width: 600px;
            min-width: 320px;
            position: relative;
            margin-left: 0;
            margin-right: auto;
            transition: box-shadow 0.2s;
            cursor: pointer;
        }
        .nutritionist-bubble:before {
            content: '';
            position: absolute;
            left: -12px;
            bottom: 18px;
            border-width: 10px 12px 10px 0;
            border-style: solid;
            border-color: transparent #fff transparent transparent;
        }
        .nutritionist-bubble:hover {
            box-shadow: 0 6px 18px rgba(106,72,25,0.18);
        }
        @media (max-width: 700px) {
            .nutritionist-section { flex-direction: column; align-items: flex-start; }
            .nutritionist-avatar { width: 70px; height: 70px; }
            .nutritionist-bubble { font-size: 1rem; max-width: 95vw; }
        }
    </style>
</head>
<body>
    <main class="container">
        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-bar-active" id="progress-active"></div>
                <div class="step completed">1</div>
                <div class="step completed">2</div>
                <div class="step active">3</div>
            </div>
        </div>

        <a href="DP.PS.step2.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <div class="plan-header">
            <h1>Step 3: Recommended Daily Nutrients</h1>
        </div>

        <!-- Nutritionist Section -->
        <div class="nutritionist-section">
            <div class="nutritionist-avatar" id="nutritionist3">
                <img src="images/nutri.png" alt="Nutritionist">
            </div>
            <div class="nutritionist-bubble" id="nutritionist3-bubble">
                These are the nutrients your body needs every day.
            </div>
        </div>

        <section>
            
            <div class="chart-container">
                <div class="bar-chart-classic" id="nutritionChartClassic">
                    <div class="bar-column">
                        <div class="bar-value-display" id="calories-value-display"></div>
                        <div class="bar calories-bar"></div>
                        <div class="bar-label">Calories</div>
                    </div>
                    <div class="bar-column">
                        <div class="bar-value-display" id="protein-value-display"></div>
                        <div class="bar protein-bar"></div>
                        <div class="bar-label">Protein</div>
                    </div>
                    <div class="bar-column">
                        <div class="bar-value-display" id="carbs-value-display"></div>
                        <div class="bar carbs-bar"></div>
                        <div class="bar-label">Carbs</div>
                    </div>
                    <div class="bar-column">
                        <div class="bar-value-display" id="fat-value-display"></div>
                        <div class="bar fat-bar"></div>
                        <div class="bar-label">Fat</div>
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button class="generate-btn" id="generate-plan-btn">
                    <i class="fas fa-utensils"></i> Generate Meal Plan
                </button>
            </div>
        </section>
    </main>

    <script src="DP.PS.Calculation.js"></script>
    <script src="DP.PS.FoodDB.js"></script>
    <script src="DP.PS.Generator.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('progress-active').style.width = '100%';

            // Load nutrition data from localStorage or calculate if missing
            let nutritionData = JSON.parse(localStorage.getItem('ps_nutrition') || '{}');
            const userData = {
                height: parseFloat(localStorage.getItem('ps_height')),
                weight: parseFloat(localStorage.getItem('ps_weight')),
                age: parseInt(localStorage.getItem('ps_age')),
                gender: localStorage.getItem('ps_gender'),
                activityFactor: parseFloat(localStorage.getItem('ps_activity'))
            };

            if (userData.height && userData.weight && userData.age && userData.gender && userData.activityFactor) {
                if (typeof calculateNutritionValues === 'function') {
                    nutritionData = calculateNutritionValues(userData);
                    localStorage.setItem('ps_nutrition', JSON.stringify(nutritionData));
                }
            } 
            // Display nutrition values
            if (nutritionData.calories && nutritionData.protein && nutritionData.carbs && nutritionData.fat &&
                !isNaN(nutritionData.calories) && !isNaN(nutritionData.protein) && !isNaN(nutritionData.carbs) && !isNaN(nutritionData.fat)) {

                // Custom Bar Chart Rendering
                const caloriesBar = document.querySelector('.calories-bar');
                const proteinBar = document.querySelector('.protein-bar');
                const carbsBar = document.querySelector('.carbs-bar');
                const fatBar = document.querySelector('.fat-bar');

                const caloriesValueDisplay = document.getElementById('calories-value-display');
                const proteinValueDisplay = document.getElementById('protein-value-display');
                const carbsValueDisplay = document.getElementById('carbs-value-display');
                const fatValueDisplay = document.getElementById('fat-value-display');

                // max value for scaling the bar widths
                const maxCalories = 2500; 
                const maxProtein = 200; 
                const maxCarbs = 400; 
                const maxFat = 100; 

                // max width for the bars 
                const maxBarWidth = 600; 

                const getBarWidth = (value, max) => {
                    return Math.min(1, value / max) * maxBarWidth; 
                };

                // Set bar widths and display values
                setTimeout(() => { 
                    caloriesBar.style.width = `${getBarWidth(nutritionData.calories, maxCalories)}px`;
                    caloriesValueDisplay.textContent = `${nutritionData.calories} kcal`;
                    caloriesValueDisplay.style.opacity = 1;

                    proteinBar.style.width = `${getBarWidth(nutritionData.protein, maxProtein)}px`;
                    proteinValueDisplay.textContent = `${nutritionData.protein}g`;
                    proteinValueDisplay.style.opacity = 1;

                    carbsBar.style.width = `${getBarWidth(nutritionData.carbs, maxCarbs)}px`;
                    carbsValueDisplay.textContent = `${nutritionData.carbs}g`;
                    carbsValueDisplay.style.opacity = 1;

                    fatBar.style.width = `${getBarWidth(nutritionData.fat, maxFat)}px`;
                    fatValueDisplay.textContent = `${nutritionData.fat}g`;
                    fatValueDisplay.style.opacity = 1;
                }, 100); 

            } 

            // Generate Meal Plan Button handler (FIXED)
            const generateBtn = document.getElementById('generate-plan-btn');
            if (generateBtn) {
                generateBtn.addEventListener('click', function () {
                    const planType = localStorage.getItem('ps_planType') || 'regular';
                    const duration = parseInt(localStorage.getItem('ps_duration') || '7');
                    const calories = nutritionData.calories || 2000;
                    const protein = nutritionData.protein || 100;
                    const carbs = nutritionData.carbs || 200;
                    const fat = nutritionData.fat || 50;
                    const budget = parseFloat(localStorage.getItem('ps_budget') || '50');

                    if (window.PlanGenerator) {
                        const plan = PlanGenerator.generateMealPlan(
                            planType,
                            duration,
                            calories,
                            protein,
                            carbs,
                            fat,
                            budget
                        );
                        localStorage.setItem('generatedMealPlan', JSON.stringify(plan));
                        window.location.href = 'DP.PS.Loading.php';
                    } else {
                        alert('Meal plan generator not loaded.');
                    }
                });
            }

        
            // Food alternatives check
            const dietType = localStorage.getItem('ps_diet_type') || 'regular';
            const mealType = 'lunch';

            if (typeof FoodDB !== 'undefined') {
                const alternatives = FoodDB.getFilteredFoods(mealType, dietType);
            }
        });
    </script>
</body>
</html>
