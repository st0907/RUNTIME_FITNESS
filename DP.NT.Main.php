<!DOCTYPE html>
<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.Main.php
Description     : Nutrition Journal
First Written on: Sunday, 15-June-2025
Edited on: Sunday, 20-June-2025
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Journal - RunTime Fitness</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="DP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #f8f4ec;
            color: #6a4819;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto 0;
            padding: 0 20px;
            background: none;
        }

        /* Page Title */
        .page-title {
            text-align: center;
            margin: 40px 0;
            position: relative;
            padding: 15px 0;
            border-bottom: 1px solid rgba(106, 72, 25, 0.2);
        }

        .page-title h1 {
            font-size: 2rem;
            color: #8D7151;
            margin-bottom: 15px;
        }

        .page-title p {
            font-size: 1.2rem;
            color: #6a4819;
        }

        /* Calendar Section */
        .calendar-section {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 40px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            text-align: center;
        }

        .calendar-nav {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .month-year {
            font-size: 1.8rem;
            font-weight: 600;
            color: #6a4819;
            width: 60%;
            text-align: center;
        }

        .calendar-btn {
            background-color: #f3ede3;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #6a4819;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .calendar-btn:hover {
            background-color: #e5dbc7;
            transform: translateY(-2px);
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .day-name {
            text-align: center;
            font-weight: 600;
            color: #8D7151;
            padding: 10px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .calendar-day {
            aspect-ratio: 1/1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: transparent;
            position: relative;
        }

        .calendar-day:hover {
            background-color: #f3ede3;
            transform: translateY(-3px);
        }

        .day-number {
            font-size: 1.2rem;
            font-weight: 500;
            color: #6a4819;
        }

        .day-indicator {
            display: none;
        }

        .day-mood {
            font-size: 1.2rem;
            margin-top: 5px;
        }

        .day-empty {
            background-color: transparent;
            cursor: default;
        }

        .day-empty:hover {
            background-color: transparent;
            transform: none;
        }

        .day-today {
            font-weight: bold;
            color: #8D7151;
        }

        /* Form styles */
        .form-section {
            margin-bottom: 20px;
        }

        .form-section h3 {
            color: #6a4819;
            margin-bottom: 15px;
            font-size: 1.2rem;
            padding-bottom: 5px;
            border-bottom: 1px solid #e5dbc7;
        }

        .meal-entry {
            background-color: #f9f7f0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .meal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .meal-title {
            font-weight: 600;
            color: #8D7151;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #6a4819;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e5dbc7;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .form-control:focus {
            border-color: #8D7151;
            outline: none;
            box-shadow: 0 0 0 2px rgba(141, 113, 81, 0.2);
        }

        .form-control::placeholder {
            color: #b9b9b9;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .stats-row {
            display: flex;
            gap: 20px;
        }

        .stats-column {
            flex: 1;
        }

        /* Journal Entry Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .journal-modal {
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: translateY(20px);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .modal-overlay.active .journal-modal {
            transform: translateY(0);
        }

        .journal-modal-header {
            background-color: #8D7151;
            padding: 20px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .journal-modal-title {
            font-size: 1.6rem;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.4rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close-modal:hover {
            transform: scale(1.2);
        }

        .journal-modal-body {
            padding: 25px;
            overflow-y: auto;
            max-height: calc(90vh - 130px); 
        }

        .journal-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Mood selector */
        .mood-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .mood-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .mood-option:hover {
            background-color: #f3ede3;
        }

        .mood-option.selected {
            background-color: #e5dbc7;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .mood-emoji {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .mood-label {
            font-size: 0.8rem;
            color: #6a4819;
        }

        .journal-modal-footer {
            padding: 20px;
            border-top: 1px solid #e5dbc7;
            text-align: right;
            flex-shrink: 0;
        }

        .save-btn {
            background-color: #8D7151;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            background-color: #6a4819;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Summary Section */
        .journal-summary {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .summary-title {
            font-size: 1.6rem;
            font-weight: 600;
            color: #6a4819;
        }

        .summary-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            background-color: #f9f7f0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 600;
            color: #8D7151;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #6a4819;
            font-weight: 500;
        }

        .summary-chart {
            height: 300px;
            background-color: #f9f7f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .chart-placeholder {
            color: #b38b4f;
            font-style: italic;
        }

        /* Footer */
        footer {
            margin-top: 60px;
            padding: 30px 0;
            background-color: #8D7151;
            color: white;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .calendar-grid, .calendar-days {
                grid-template-columns: repeat(7, 1fr);
                gap: 5px;
            }

            .day-number {
                font-size: 1rem;
            }

            .stats-row {
                flex-direction: column;
                gap: 15px;
            }

            .calendar-section, .journal-summary {
                padding: 20px;
            }

            .month-year {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .calendar-day {
                min-height: 40px;
            }

            .calendar-btn {
                width: 35px;
                height: 35px;
            }

            .journal-modal-title {
                font-size: 1.3rem;
            }
        }

        .form-row {
            display: flex;
            gap: 15px;
            align-items: flex-end;
            margin-bottom: 10px;
        }

        .food-item {
            margin-bottom: 15px;
        }

        .food-name {
            flex: 2;
        }

        .portion-size {
            flex: 1;
        }

        .btn-container {
            display: flex;
            align-items: flex-end;
            padding-bottom: 12px;
        }

        .add-btn, .remove-btn {
            background: none;
            border: none;
            font-size: 1.8rem;
            padding: 0 10px;
            cursor: pointer;
            font-weight: normal;
            line-height: 1;
        }

        .add-btn {
            color: #8D7151;
        }

        .remove-btn {
            color: #f44336;
        }

        .calories-group {
            margin-top: 15px;
            border-top: 1px dashed #e5dbc7;
            padding-top: 15px;
        }
        .disabled-day {
            background-color: #f5eee6;
            color: #999;
            opacity: 0.6;
        }

        .custom-tooltip {
            position: absolute;
            background-color: #e5dbc7; /* Light brown */
            color: #6a4819; /* Darker brown for text */
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
            white-space: nowrap;
            z-index: 1001;
            pointer-events: none; /* Allow events to pass through */
            opacity: 0;
            transition: opacity 0s; /* Instant transition */
        }

        .custom-tooltip.active {
            opacity: 1;
        }
    </style>
</head>
<body>
    <header>
        <div id="navbar-img">
            <a href="memberHomepage.php" class="home-nav-item" title="BACK TO MAIN PAGE">
                <i class="fas fa-home"></i>
            </a>
        </div>
        <div class="nav-links">
            <a href="DP.MAIN.php">About Diet</a>
            <a href="DP.DF.Main.php">Diet Plans</a>
            <a href="DP.PS.Main.php">Personalized Diet Plan</a>
            <a href="DP.NT.Main.php" class="active">Nutrition Journal</a>
            <a href="DP.SP.PlansList.php">My Plans</a>
        </div>
        <div>
            <a href="P.viewProfile.php" class="profile-link">
                <div class="profile-icon">👤</div>
            </a>
        </div>
        <div>
            <a href="#" title="Logout" id="logout-link" style="margin-left: 1rem;color: #8E735B;">
                <i class="fa fa-sign-out fa-lg"></i>
            </a>
        </div>   
    </header>

    <div class="container">
        <div class="page-title">
            <h1>Nutrition Journal</h1>
            <p>Track your daily meals, calories, and nutrition insights</p>
        </div>

        <div class="calendar-section">
            <div class="calendar-header">
                <div class="calendar-nav">
                    <button class="calendar-btn" id="prevMonthBtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="month-year" id="monthYearDisplay">May 2025</div>
                    <button class="calendar-btn" id="nextMonthBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="calendar-days">
                <div class="day-name">Sun</div>
                <div class="day-name">Mon</div>
                <div class="day-name">Tue</div>
                <div class="day-name">Wed</div>
                <div class="day-name">Thu</div>
                <div class="day-name">Fri</div>
                <div class="day-name">Sat</div>
            </div>

            <div class="calendar-grid" id="calendarGrid">
                <!-- Calendar days will be generated by JavaScript -->
            </div>
        </div>

        <div class="journal-summary">
            <div class="summary-header">
                <h2 class="summary-title">Monthly Summary</h2>
            </div>

            <div class="summary-stats">
                <div class="stat-card">
                    <div class="stat-value" id="avgCaloriesValue">1,850</div>
                    <div class="stat-label">Avg. Daily Calories</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="totalEntriesValue">12</div>
                    <div class="stat-label">Total Entries</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="moodResult"><span id="moodCount"></span></div>
                    <div class="stat-label">Most Frequent Mood</div>
                </div>
            </div>

            <div id="moodSummaryText" style="text-align: center; margin-top: 20px; font-size: 1.1rem; color: #6a4819;"></div>
            <div id="moodAchievement" style="text-align: center; margin-top: 10px; font-size: 1.2rem; color: #8D7151; font-weight: bold;"></div>

            
        </div>
    </div>

    <!-- Journal Entry Modal -->
    <div class="modal-overlay" id="journalModal">
        <div class="journal-modal">
            <div class="journal-modal-header">
                <div class="journal-modal-title" id="journalDate">Journal for May 30, 2025</div>
                <div id="modalMoodDisplay" style="font-size: 1.2rem; color: #fff;"></div>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <div class="journal-modal-body">
                <form class="journal-form" id="journalForm">
                    <input type="hidden" id="entryDate" name="entryDate">
                    <div class="form-section">
                        <h3>Meals</h3>
                        
                        <!-- Breakfast Section -->
                        <div class="meal-entry">
                            <div class="meal-header">
                                <div class="meal-title">Breakfast</div>
                            </div>
                            <div id="breakfastItems">
                                <div class="food-item">
                                    <div class="form-row">
                                        <div class="form-group food-name">
                                            <label for="breakfastFood1">Food Name</label>
                                            <input type="text" class="form-control" name="breakfastFood[]" placeholder="E.g., Oatmeal">
                                        </div>
                                        <div class="form-group portion-size">
                                            <label for="breakfastPortion1">Portion Size</label>
                                            <input type="text" class="form-control" name="breakfastPortion[]" placeholder="E.g., 1 cup">
                                        </div>
                                        <div class="btn-container">
                                            <button type="button" class="add-btn" onclick="addFoodItem('breakfast')">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group calories-group">
                                <label for="breakfastCalories">Total Calories for Breakfast</label>
                                <input type="number" class="form-control" id="breakfastCalories" name="breakfastCalories" min="0" placeholder="E.g., 350">
                            </div>
                        </div>
                        
                        <!-- Lunch Section -->
                        <div class="meal-entry">
                            <div class="meal-header">
                                <div class="meal-title">Lunch</div>
                            </div>
                            <div id="lunchItems">
                                <div class="food-item">
                                    <div class="form-row">
                                        <div class="form-group food-name">
                                            <label for="lunchFood1">Food Name</label>
                                            <input type="text" class="form-control" name="lunchFood[]" placeholder="E.g., Chicken salad">
                                        </div>
                                        <div class="form-group portion-size">
                                            <label for="lunchPortion1">Portion Size</label>
                                            <input type="text" class="form-control" name="lunchPortion[]" placeholder="E.g., 200g">
                                        </div>
                                        <div class="btn-container">
                                            <button type="button" class="add-btn" onclick="addFoodItem('lunch')">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group calories-group">
                                <label for="lunchCalories">Total Calories for Lunch</label>
                                <input type="number" class="form-control" id="lunchCalories" name="lunchCalories" min="0" placeholder="E.g., 450">
                            </div>
                        </div>
                        
                        <!-- Dinner Section -->
                        <div class="meal-entry">
                            <div class="meal-header">
                                <div class="meal-title">Dinner</div>
                            </div>
                            <div id="dinnerItems">
                                <div class="food-item">
                                    <div class="form-row">
                                        <div class="form-group food-name">
                                            <label for="dinnerFood1">Food Name</label>
                                            <input type="text" class="form-control" name="dinnerFood[]" placeholder="E.g., Grilled salmon">
                                        </div>
                                        <div class="form-group portion-size">
                                            <label for="dinnerPortion1">Portion Size</label>
                                            <input type="text" class="form-control" name="dinnerPortion[]" placeholder="E.g., 150g">
                                        </div>
                                        <div class="btn-container">
                                            <button type="button" class="add-btn" onclick="addFoodItem('dinner')">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group calories-group">
                                <label for="dinnerCalories">Total Calories for Dinner</label>
                                <input type="number" class="form-control" id="dinnerCalories" name="dinnerCalories" min="0" placeholder="E.g., 500">
                            </div>
                        </div>
                        
                        <!-- Snacks Section -->
                        <div class="meal-entry">
                            <div class="meal-header">
                                <div class="meal-title">Snacks</div>
                            </div>
                            <div id="snackItems">
                                <div class="food-item">
                                    <div class="form-row">
                                        <div class="form-group food-name">
                                            <label for="snackFood1">Food Name</label>
                                            <input type="text" class="form-control" name="snackFood[]" placeholder="E.g., Greek yogurt">
                                        </div>
                                        <div class="form-group portion-size">
                                            <label for="snackPortion1">Portion Size</label>
                                            <input type="text" class="form-control" name="snackPortion[]" placeholder="E.g., 1 cup">
                                        </div>
                                        <div class="btn-container">
                                            <button type="button" class="add-btn" onclick="addFoodItem('snack')">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group calories-group">
                                <label for="snackCalories">Total Calories for Snacks</label>
                                <input type="number" class="form-control" id="snackCalories" name="snackCalories" min="0" placeholder="E.g., 200">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3>Daily Health Metrics</h3>
                        <div class="stats-row">
                            <div class="stats-column">
                                <div class="form-group">
                                    <label for="waterIntake">Water Intake</label>
                                    <input type="text" class="form-control" id="waterIntake" name="waterIntake" placeholder="E.g., 2.5 liters">
                                </div>
                            </div>
                            <div class="stats-column">
                                <div class="form-group">
                                    <label for="supplements">Supplements/Vitamins</label>
                                    <input type="text" class="form-control" id="supplements" name="supplements" placeholder="E.g., Multivitamin, Vitamin D">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mood">Mood</label>
                            <input type="hidden" id="selectedMood" name="selectedMood" value="">
                            <div class="mood-selector">
                                <div class="mood-option" data-mood="happy" onclick="selectMood('happy', this)">
                                    <div class="mood-emoji">😀</div>
                                    <div class="mood-label">Happy</div>
                                </div>
                                <div class="mood-option" data-mood="energetic" onclick="selectMood('energetic', this)">
                                    <div class="mood-emoji">⚡</div>
                                    <div class="mood-label">Energetic</div>
                                </div>
                                <div class="mood-option" data-mood="tired" onclick="selectMood('tired', this)">
                                    <div class="mood-emoji">😴</div>
                                    <div class="mood-label">Tired</div>
                                </div>
                                <div class="mood-option" data-mood="stressed" onclick="selectMood('stressed', this)">
                                    <div class="mood-emoji">😓</div>
                                    <div class="mood-label">Stressed</div>
                                </div>
                                <div class="mood-option" data-mood="calm" onclick="selectMood('calm', this)">
                                    <div class="mood-emoji">😌</div>
                                    <div class="mood-label">Calm</div>
                                </div>
                                <div class="mood-option" data-mood="sick" onclick="selectMood('sick', this)">
                                    <div class="mood-emoji">🤒</div>
                                    <div class="mood-label">Sick</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3>Notes</h3>
                        <div class="form-group">
                            <label for="journalNotes">Additional Remarks</label>
                            <textarea class="form-control" id="journalNotes" name="journalNotes" placeholder="How did you feel? Any concerns or wins to note?"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="journal-modal-footer">
                <div id="journal-form-error" style="color: #c0392b; margin-bottom: 15px; text-align: center; font-weight: bold; display: none;"></div>
                <button type="submit" form="journalForm" class="save-btn" id="saveJournalBtn">Save Journal Entry</button>
            </div>
        </div>
    </div>

    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | Nutrition Journal</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const calendarGrid = document.getElementById('calendarGrid');
            const monthYearDisplay = document.getElementById('monthYearDisplay');
            const prevMonthBtn = document.getElementById('prevMonthBtn');
            const nextMonthBtn = document.getElementById('nextMonthBtn');
            const journalModal = document.getElementById('journalModal');
            const closeModal = document.getElementById('closeModal');
            const journalDateEl = document.getElementById('journalDate');
            const entryDateInput = document.getElementById('entryDate');
            const journalForm = document.getElementById('journalForm');
            const saveJournalBtn = document.getElementById('saveJournalBtn');
            const selectedMoodInput = document.getElementById('selectedMood');
            
            // Stats Elements
            const avgCaloriesValue = document.getElementById('avgCaloriesValue');
            const totalEntriesValue = document.getElementById('totalEntriesValue');
            const avgCostValue = document.getElementById('avgCostValue');

            // Current date tracking
            let currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);

            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();
            let selectedDate = null;

            // Initialize journal entries storage
            let journalEntries = JSON.parse(localStorage.getItem('journalEntries')) || {};

            // Function to select mood
            window.selectMood = function(mood, element) {
                // Remove selected class from all options
                const moodOptions = document.querySelectorAll('.mood-option');
                moodOptions.forEach(option => option.classList.remove('selected'));
                
                // Add selected class to clicked option
                element.classList.add('selected');
                
                // Set the hidden input value
                selectedMoodInput.value = mood;
            };

            // Mood emoji mapping
            const moodEmojis = {
                'happy': '😀',
                'energetic': '⚡',
                'tired': '😴',
                'stressed': '😓',
                'calm': '😌',
                'sick': '🤒'
            };

            // Function to add a new food item
            window.addFoodItem = function(mealType) {
                const container = document.getElementById(`${mealType}Items`);
                const foodItems = container.querySelectorAll('.food-item');
                const newIndex = foodItems.length + 1;
                
                const newFoodItem = document.createElement('div');
                newFoodItem.className = 'food-item';
                newFoodItem.innerHTML = `
                    <div class="form-row">
                        <div class="form-group food-name">
                            <label for="${mealType}Food${newIndex}">Food Name</label>
                            <input type="text" class="form-control" name="${mealType}Food[]" placeholder="E.g., Food name">
                        </div>
                        <div class="form-group portion-size">
                            <label for="${mealType}Portion${newIndex}">Portion Size</label>
                            <input type="text" class="form-control" name="${mealType}Portion[]" placeholder="E.g., Portion">
                        </div>
                        <div class="btn-container">
                            <button type="button" class="remove-btn" onclick="removeFoodItem(this)">-</button>
                        </div>
                    </div>
                `;
                
                container.appendChild(newFoodItem);
            };

            // Function to remove a food item
            window.removeFoodItem = function(button) {
                const foodItem = button.closest('.food-item');
                foodItem.parentNode.removeChild(foodItem);
            };

            // Function to collect all food items for a meal type
            function collectFoodItems(mealType) {
                const container = document.getElementById(`${mealType}Items`);
                const foodInputs = container.querySelectorAll(`input[name="${mealType}Food[]"]`);
                const portionInputs = container.querySelectorAll(`input[name="${mealType}Portion[]"]`);
                
                const foods = [];
                const portions = [];
                
                foodInputs.forEach(input => {
                    foods.push(input.value);
                });
                
                portionInputs.forEach(input => {
                    portions.push(input.value);
                });
                
                return { foods, portions };
            }

            // Generate the calendar
            function generateCalendar(month, year) {
                // Clear the calendar grid
                calendarGrid.innerHTML = '';
                
                // Update month and year display
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                monthYearDisplay.textContent = `${monthNames[month]} ${year}`;
                
                // Get the first day of the month
                const firstDay = new Date(year, month, 1);
                const startingDay = firstDay.getDay(); // 0 for Sunday, 1 for Monday, etc.
                
                // Get the number of days in the month
                const lastDay = new Date(year, month + 1, 0);
                const totalDays = lastDay.getDate();
                
                // Create empty cells for days before the first day of the month
                for (let i = 0; i < startingDay; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'calendar-day day-empty';
                    calendarGrid.appendChild(emptyDay);
                }
                
                // Get today's date only once
                const today = new Date();
                today.setHours(0, 0, 0, 0); // clear time for accurate comparison
                
                for (let day = 1; day <= totalDays; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day';
                    
                    const selectedDay = new Date(year, month, day);
                    selectedDay.setHours(0, 0, 0, 0); // normalize
                    
                    // Check if this is today
                    if (
                        day === today.getDate() &&
                        month === today.getMonth() &&
                        year === today.getFullYear()
                    ) {
                        dayCell.classList.add('day-today');
                    }
                    
                    // Create the day number element
                    const dayNumber = document.createElement('div');
                    dayNumber.className = 'day-number';
                    dayNumber.textContent = day;
                    
                    // Create mood element
                    const moodEl = document.createElement('div');
                    moodEl.className = 'day-mood';
                    
                    // Format dateStr consistently as yyyy-mm-dd
                    const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    if (journalEntries[dateStr]) {
                        const entry = journalEntries[dateStr];
                        if (entry.mood && moodEmojis[entry.mood]) {
                            moodEl.textContent = moodEmojis[entry.mood];
                        }
                    }
                    
                    // Add elements
                    dayCell.appendChild(dayNumber);
                    dayCell.appendChild(moodEl);
                    
                    // Prevent selecting future dates
                    if (selectedDay > today) {
                        dayCell.classList.add('disabled-day');
                        dayCell.addEventListener('mouseover', function(event) {
                            showCustomTooltip(event, 'You can only log meals for today or earlier');
                        });
                        dayCell.addEventListener('mousemove', function(event) {
                            updateCustomTooltipPosition(event);
                        });
                        dayCell.addEventListener('mouseout', function() {
                            hideCustomTooltip();
                        });
                    } else {
                        dayCell.addEventListener('click', () => {
                            selectedDate = new Date(year, month, day);
                            openJournalModal(selectedDate);
                        });
                    }

                    calendarGrid.appendChild(dayCell);
                }

                updateStatistics();
                loadMoodSummary(currentMonth + 1, currentYear);
                fetchMonthlySummary(currentMonth + 1, currentYear);
            }

            // Open the journal modal for a specific date
            function openJournalModal(date) {
                // Format the display date for the modal header
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const dateStr = date.toLocaleDateString('en-US', options);
                journalDateEl.textContent = `Journal for ${dateStr}`;

                // Format the hidden input date (for DB usage) - pad month/day with 0
                const formattedDate = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
                entryDateInput.value = formattedDate;

                // Reset the form first
                journalForm.reset();

                // Clear food items
                resetFoodItems('breakfast');
                resetFoodItems('lunch');
                resetFoodItems('dinner');
                resetFoodItems('snack');

                // Clear selected mood
                document.querySelectorAll('.mood-option').forEach(el => el.classList.remove('selected'));
                selectedMoodInput.value = '';

                // Fetch data from server for selected date
                fetch(`DP.NT.Journal.php?entryDate=${formattedDate}`)
                    .then(res => res.text())
                    .then(data => {
                        if (!data.includes('[ENTRY]')) {
                            console.log("No entry for this date.");
                            return;
                        }

                        const entryBlock = data.split('[MEALS]')[0].replace('[ENTRY]\n', '');
                        const mealBlock = data.split('[MEALS]')[1];

                        const entryLines = entryBlock.trim().split('\n');
                        const entryData = {};
                        entryLines.forEach(line => {
                            const [key, val] = line.split(':');
                            entryData[key.trim()] = val ? val.trim() : '';
                        });

                        // Fill mood
                        selectedMoodInput.value = entryData['ntj_mood'] || '';
                        // Highlight the selected mood button
                        const moodOptions = document.querySelectorAll('.mood-option');
                        moodOptions.forEach(el => {
                            el.classList.remove('selected'); // reset first
                            if (el.dataset.mood === entryData['ntj_mood']) {
                                el.classList.add('selected');
                            }
                        });

                        const modalMoodDisplay = document.getElementById('modalMoodDisplay');
                        const selectedMood = entryData['ntj_mood'];

                        if (selectedMood) {
                            const emoji = moodEmojis[selectedMood] || '';
                            modalMoodDisplay.innerHTML = `Selected mood: ${emoji} ${selectedMood.toUpperCase()}`;
                        } else {
                            modalMoodDisplay.innerHTML = '';
                        }



                        // Fill calories
                        document.getElementById('breakfastCalories').value = entryData['ntj_breakfast_calories'] || '';
                        document.getElementById('lunchCalories').value = entryData['ntj_lunch_calories'] || '';
                        document.getElementById('dinnerCalories').value = entryData['ntj_dinner_calories'] || '';
                        document.getElementById('snackCalories').value = entryData['ntj_snacks_calories'] || '';

                        // Fill other fields
                        document.getElementById('waterIntake').value = entryData['ntj_water_intake'] || '';
                        document.getElementById('supplements').value = entryData['ntj_supplements'] || '';
                        document.getElementById('journalNotes').value = entryData['ntj_notes'] || '';

                        // Fill meal items
                        const mealLines = mealBlock.trim().split('\n');
                        const mealGroups = {
                            breakfast: [],
                            lunch: [],
                            dinner: [],
                            snack: []
                        };

                        mealLines.forEach(line => {
                            const [mealType, food, portion] = line.split('|');
                            if (mealGroups[mealType]) {
                                mealGroups[mealType].push({ food, portion });
                            }
                        });

                        for (const mealType in mealGroups) {
                            const items = mealGroups[mealType];
                            items.forEach((item, index) => {
                                if (index === 0) {
                                    const firstFood = document.querySelector(`#${mealType}Items .food-item`);
                                    firstFood.querySelector(`input[name="${mealType}Food[]"]`).value = item.food;
                                    firstFood.querySelector(`input[name="${mealType}Portion[]"]`).value = item.portion;
                                } else {
                                    addFoodItem(mealType);
                                    const allItems = document.querySelectorAll(`#${mealType}Items .food-item`);
                                    const lastItem = allItems[allItems.length - 1];
                                    lastItem.querySelector(`input[name="${mealType}Food[]"]`).value = item.food;
                                    lastItem.querySelector(`input[name="${mealType}Portion[]"]`).value = item.portion;
                                }
                            });
                        }
                    })
                    .catch(err => console.error("Error loading journal:", err));

                // Show the modal
                journalModal.classList.add('active');
            }

            // Load journal entry data into the form
            function loadJournalEntry(dateStr) {
                // Reset form
                journalForm.reset();
                
                // Clear any additional food items
                resetFoodItems('breakfast');
                resetFoodItems('lunch');
                resetFoodItems('dinner');
                resetFoodItems('snack');
                
                // Reset mood selection
                const moodOptions = document.querySelectorAll('.mood-option');
                moodOptions.forEach(option => option.classList.remove('selected'));
                
                // Check if there's an entry for this date
                if (journalEntries[dateStr]) {
                    const entry = journalEntries[dateStr];
                    
                    // Fill in the meal data
                    if (entry.breakfast) {
                        loadMealItems('breakfast', entry.breakfast);
                        document.getElementById('breakfastCalories').value = entry.breakfastCalories || '';
                    }
                    
                    if (entry.lunch) {
                        loadMealItems('lunch', entry.lunch);
                        document.getElementById('lunchCalories').value = entry.lunchCalories || '';
                    }
                    
                    if (entry.dinner) {
                        loadMealItems('dinner', entry.dinner);
                        document.getElementById('dinnerCalories').value = entry.dinnerCalories || '';
                    }
                    
                    if (entry.snack) {
                        loadMealItems('snack', entry.snack);
                        document.getElementById('snackCalories').value = entry.snackCalories || '';
                    }
                    
                    // Fill in other fields
                    document.getElementById('waterIntake').value = entry.waterIntake || '';
                    document.getElementById('supplements').value = entry.supplements || '';
                    document.getElementById('journalNotes').value = entry.journalNotes || '';
                    
                    // Set mood if available
                    if (entry.mood) {
                        selectedMoodInput.value = entry.mood;
                        const moodOption = document.querySelector(`.mood-option[data-mood="${entry.mood}"]`);
                        if (moodOption) {
                            moodOption.classList.add('selected');
                        }
                    }
                }
            }

            function loadMealItemsFromString(mealType, str) {
                const container = document.getElementById(`${mealType}Items`);
                resetFoodItems(mealType);

                const items = str.split(',');
                items.forEach((item, index) => {
                    const [food, portion] = item.split('~');

                    if (index === 0) {
                        const first = container.querySelector('.food-item');
                        first.querySelector(`input[name="${mealType}Food[]"]`).value = food;
                        first.querySelector(`input[name="${mealType}Portion[]"]`).value = portion;
                    } else {
                        const div = document.createElement('div');
                        div.className = 'food-item';
                        div.innerHTML = `
                            <div class="form-row">
                                <div class="form-group food-name">
                                    <label>Food Name</label>
                                    <input type="text" class="form-control" name="${mealType}Food[]" value="${food}">
                                </div>
                                <div class="form-group portion-size">
                                    <label>Portion Size</label>
                                    <input type="text" class="form-control" name="${mealType}Portion[]" value="${portion}">
                                </div>
                                <div class="btn-container">
                                    <button type="button" class="remove-btn" onclick="removeFoodItem(this)">-</button>
                                </div>
                            </div>
                        `;
                        container.appendChild(div);
                    }
                });
            }

            // Reset food items for a meal type
            function resetFoodItems(mealType) {
                const container = document.getElementById(`${mealType}Items`);
                
                // Keep only the first food item
                const foodItems = container.querySelectorAll('.food-item');
                for (let i = 1; i < foodItems.length; i++) {
                    container.removeChild(foodItems[i]);
                }
                
                // Reset the first food item's inputs
                const firstFoodItem = container.querySelector('.food-item');
                if (firstFoodItem) {
                    const foodInput = firstFoodItem.querySelector(`input[name="${mealType}Food[]"]`);
                    const portionInput = firstFoodItem.querySelector(`input[name="${mealType}Portion[]"]`);
                    
                    if (foodInput) foodInput.value = '';
                    if (portionInput) portionInput.value = '';
                }
            }
            
            // Load meal items from entry
            function loadMealItems(mealType, mealData) {
                if (!mealData || !mealData.foods || !mealData.portions) return;
                
                const container = document.getElementById(`${mealType}Items`);
                resetFoodItems(mealType); // Reset to have only one food item
                
                // Fill the first food item
                const firstFoodItem = container.querySelector('.food-item');
                if (firstFoodItem && mealData.foods.length > 0) {
                    const foodInput = firstFoodItem.querySelector(`input[name="${mealType}Food[]"]`);
                    const portionInput = firstFoodItem.querySelector(`input[name="${mealType}Portion[]"]`);
                    
                    if (foodInput) foodInput.value = mealData.foods[0] || '';
                    if (portionInput) portionInput.value = mealData.portions[0] || '';
                }
                
                // Add additional food items if needed
                for (let i = 1; i < mealData.foods.length; i++) {
                    const newFoodItem = document.createElement('div');
                    newFoodItem.className = 'food-item';
                    newFoodItem.innerHTML = `
                        <div class="form-row">
                            <div class="form-group food-name">
                                <label for="${mealType}Food${i+1}">Food Name</label>
                                <input type="text" class="form-control" name="${mealType}Food[]" value="${mealData.foods[i] || ''}" placeholder="E.g., Food name">
                            </div>
                            <div class="form-group portion-size">
                                <label for="${mealType}Portion${i+1}">Portion Size</label>
                                <input type="text" class="form-control" name="${mealType}Portion[]" value="${mealData.portions[i] || ''}" placeholder="E.g., Portion">
                            </div>
                            <div class="btn-container">
                                <button type="button" class="remove-btn" onclick="removeFoodItem(this)">-</button>
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(newFoodItem);
                }
            }
            
            // Save journal entry
            function saveJournalEntry(event) {
                event.preventDefault();
                const errorDiv = document.getElementById('journal-form-error');
                errorDiv.style.display = 'none'; // Hide previous errors

                const mealTypes = ['breakfast', 'lunch', 'dinner', 'snack'];
                let atLeastOneMealEntered = false;

                for (const mealType of mealTypes) {
                    const foodInputs = document.querySelectorAll(`#${mealType}Items input[name="${mealType}Food[]"]`);
                    const portionInputs = document.querySelectorAll(`#${mealType}Items input[name="${mealType}Portion[]"]`);
                    const caloriesInput = document.getElementById(`${mealType}Calories`);

                    let mealHasAnyInput = false;
                    for (let i = 0; i < foodInputs.length; i++) {
                        const food = foodInputs[i].value.trim();
                        const portion = portionInputs[i].value.trim();
                        if (food || portion) {
                            mealHasAnyInput = true;
                            break;
                        }
                    }
                    const calories = caloriesInput.value.trim();
                    if (calories) {
                        mealHasAnyInput = true;
                    }

                    if (mealHasAnyInput) {
                        // Validate this specific meal's completeness
                        let currentMealComplete = true;
                        for (let i = 0; i < foodInputs.length; i++) {
                            const food = foodInputs[i].value.trim();
                            const portion = portionInputs[i].value.trim();
                            if (food || portion) { // If either food or portion is entered, both must be present
                                if (!food) {
                                    errorDiv.textContent = `Please enter a food name for ${mealType}.`;
                                    errorDiv.style.display = 'block';
                                    return;
                                }
                                if (!portion) {
                                    errorDiv.textContent = `Please enter a portion size for ${mealType}.`;
                                    errorDiv.style.display = 'block';
                                    return;
                                }
                            }
                        }
                        if (!calories) {
                            errorDiv.textContent = `Please enter calories for ${mealType}.`;
                            errorDiv.style.display = 'block';
                            return;
                        }
                        atLeastOneMealEntered = true;
                    }
                }

                if (!atLeastOneMealEntered) {
                    errorDiv.textContent = 'Please enter at least one meal to save your journal';
                    errorDiv.style.display = 'block';
                    return;
                }

                const formData = new FormData(document.getElementById('journalForm'));

                fetch('DP.NT.ProcessSaveJournal.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const date = formData.get("entryDate");
                        const mood = formData.get("selectedMood");

                        journalEntries[date] = {
                            mood: mood,
                            breakfastCalories: formData.get("breakfastCalories"),
                            lunchCalories: formData.get("lunchCalories"),
                            dinnerCalories: formData.get("dinnerCalories"),
                            snackCalories: formData.get("snackCalories"),
                        };

                        localStorage.setItem("journalEntries", JSON.stringify(journalEntries));
                        journalModal.classList.remove('active');
                        generateCalendar(currentMonth, currentYear);
                    } else {
                        errorDiv.textContent = data.message;
                        errorDiv.style.display = 'block';
                    }
                })
                .catch(err => {
                    errorDiv.textContent = 'An unexpected error occurred. Please try again.';
                    errorDiv.style.display = 'block';
                    console.error('Save failed:', err);
                });
            }

            
            // Update statistics based on journal entries
            function updateStatistics() {
                // This function is now primarily for mood summary, as calorie/entry stats are fetched from server
            }
            
            function fetchMonthlySummary(month, year) {
                fetch(`DP.NT.GetMonthlySummary.php?month=${month}&year=${year}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) {
                            console.error(data.error);
                            return;
                        }

                        document.getElementById('totalEntriesValue').textContent = data.totalEntries;
                        document.getElementById('avgCaloriesValue').textContent = data.avgCalories;
                    })
                    .catch(err => console.error('Error fetching summary:', err));
            }

            function fetchMoodSummary(month, year) {
                fetch(`DP.NT.GetMoodSummary.php?month=${currentMonth + 1}&year=${currentYear}`)
                .then(res => res.json())
                .then(data => {
                    for (const mood in data) {
                    if (mood === '') continue; // skip blank mood

                    const count = data[mood];
                    console.log(`Mood ${mood}: ${count} times`);

                    // Now show GIF / quote / video here
                    }
                });
            }

            function loadMoodSummary(month, year) {
                fetch(`DP.NT.GetMoodSummary.php?month=${month}&year=${year}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) {
                            console.error(data.error);
                            return;
                        }

                        let maxMood = '';
                        let maxCount = 0;

                        for (const mood in data) {
                            if (data[mood] > maxCount) {
                                maxMood = mood;
                                maxCount = data[mood];
                            }
                        }

                        if (maxMood) {
                            // Only run this if moodCount element exists:
                            const moodCountEl = document.getElementById('moodCount');
                            if (moodCountEl) moodCountEl.textContent = maxCount;

                            displayMoodResult(maxMood, maxCount);
                            displayMoodAchievement(data);
                        } else {
                            document.getElementById('moodSummaryText').innerHTML = "No mood data this month.";
                            const moodCountEl = document.getElementById('moodCount');
                            if (moodCountEl) moodCountEl.textContent = '0';
                            document.getElementById('moodAchievement').innerHTML = '';
                        }
                    })
                    .catch(err => console.error("Failed to load mood summary:", err));
            }

            function displayMoodResult(mood, count) {
                const moodQuotes = {
                    happy: {
                        text: `You felt happy ${count} times. 😊 Keep up the positivity!`,
                        gif: "images/happy.gif"
                    },
                    energetic: {
                        text: `Full of energy! ${count} days of ⚡ power mode!`,
                        gif: "images/energetic.gif"
                    },
                    tired: {
                        text: `You felt tired ${count} times. Don't forget to rest. 😴`,
                        gif: "images/tired.gif"
                    },
                    stressed: {
                        text: `You've felt stressed ${count} times. Take a deep breath. 😌`,
                        gif: "images/stress.gif"
                    },
                    calm: {
                        text: `You've had ${count} calm days. Peaceful vibes! 🧘`,
                        gif: "images/calm.gif"
                    },
                    sick: {
                        text: `You've felt unwell ${count} times. Hope you recover soon! 🤒`,
                        gif: "images/sick.gif"
                    }
                };


                const moodData = moodQuotes[mood];
                if (!moodData) return;

                const moodSummaryTextEl = document.getElementById('moodSummaryText');
                moodSummaryTextEl.innerHTML = `
                    <p>${moodData.text}</p>
                    <img src="${moodData.gif}" width="100" alt="${mood}">
                `;
            }

            function displayMoodAchievement(data) {
                const moodAchievement = document.getElementById('moodAchievement');
                if (!moodAchievement) return;

                // Example achievement logic
                const entries = Object.entries(data);
                const total = entries.reduce((acc, [_, count]) => acc + count, 0);

                if (total >= 20) {
                    moodAchievement.innerHTML = "🎉 You logged moods for 20+ days this month!";
                } else {
                    moodAchievement.innerHTML = "";
                }
            }


            // Event Listeners
            prevMonthBtn.addEventListener('click', () => {
                if (currentYear === 2025 && currentMonth === 5) return;
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentMonth, currentYear);
            });
            
            nextMonthBtn.addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentMonth, currentYear);
            });
            
            closeModal.addEventListener('click', () => {
                journalModal.classList.remove('active');
            });
            
            journalForm.addEventListener('submit', saveJournalEntry);
            
            // Close modal when clicking outside
            journalModal.addEventListener('click', (e) => {
                if (e.target === journalModal) {
                    journalModal.classList.remove('active');
                }
            });
            fetch("DP.NT.LoadJournalSummary.php")
                .then(response => response.json())
                .then(data => {
                    localStorage.setItem("journalEntries", JSON.stringify(data));
                    journalEntries = data;
                    generateCalendar(currentMonth, currentYear);
                });

            // Initialize calendar with current month
            generateCalendar(currentMonth, currentYear);
            // Logout confirmation
        const logoutLink = document.getElementById('logout-link');
        if (logoutLink) {
            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Update your progress?',
                    text: "💪 Have you updated your progress for today?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update now',
                    cancelButtonText: 'Logout anyway',
                    reverseButtons: true,
                    background: '#fff8f3',
                    confirmButtonColor: '#8E735B',
                    cancelButtonColor: '#ccc'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'tracking.php';
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = 'P.Logout.php';
                    }
                });
            });
        }
        });

        // Custom tooltip functions
        let tooltipTimeout;
        const customTooltip = document.createElement('div');
        customTooltip.className = 'custom-tooltip';
        document.body.appendChild(customTooltip);

        function showCustomTooltip(event, message) {
            clearTimeout(tooltipTimeout);
            customTooltip.textContent = message;
            customTooltip.classList.add('active');
            updateCustomTooltipPosition(event);
        }

        function updateCustomTooltipPosition(event) {
            const mouseX = event.clientX;
            const mouseY = event.clientY;

            // Position the tooltip above the cursor
            customTooltip.style.left = `${mouseX}px`;
            customTooltip.style.top = `${mouseY}px`;
            customTooltip.style.transform = 'translate(-50%, -100%)'; // Center horizontally, directly above cursor
        }

        function hideCustomTooltip() {
            customTooltip.classList.remove('active');
        }
    </script>
</body>
</html> 
