<?php
/*
Programmer Name : Sim Tian (TP077056)
Program Name    : DP.NT.ProcessSaveJournal.php
Description     : Save journal to the database
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/
session_start();
include 'config.php';

if (!isset($_SESSION['usr_user_id'])) {
    echo "Unauthorized access.";
    exit;
}

$userID = $_SESSION['usr_user_id'];
$entryDate = $_POST['entryDate'];

// Validation
$mealTypes = ['breakfast', 'lunch', 'dinner', 'snack'];
$atLeastOneMealEntered = false;

foreach ($mealTypes as $meal) {
    $foods = $_POST[$meal . 'Food'] ?? [];
    $portions = $_POST[$meal . 'Portion'] ?? [];
    $calories = $_POST[$meal . 'Calories'] ?? '';

    for ($i = 0; $i < count($foods); $i++) {
        $food = trim($foods[$i]);
        $portion = trim($portions[$i]);

        if (!empty($food) || !empty($portion) || ($i == 0 && !empty($calories))) {
            if (empty($food)) {
                echo "Please enter a food name for $meal.";
                exit;
            }
            if (empty($portion)) {
                echo "Please enter a portion size for $meal.";
                exit;
            }
            if ($i == 0 && empty($calories)) {
                echo "Please enter calories for $meal.";
                exit;
            }
            $atLeastOneMealEntered = true;
        }
    }
}

if (!$atLeastOneMealEntered) {
    echo "Please enter at least one meal to save your journal";
    exit;
} 

$mood = $_POST['selectedMood'] ?? '';
$breakfastCalories = $_POST['breakfastCalories'] ?? '';
$lunchCalories = $_POST['lunchCalories'] ?? '';
$dinnerCalories = $_POST['dinnerCalories'] ?? '';
$snackCalories = $_POST['snackCalories'] ?? '';
$water = $_POST['waterIntake'] ?? '';
$supplements = $_POST['supplements'] ?? '';
$notes = $_POST['journalNotes'] ?? '';
$now = date("Y-m-d H:i:s");

$checkSql = "SELECT ntj_journal_id FROM nutrition_journal WHERE ntj_user_id = ? AND ntj_entry_date = ?";
$checkStmt = $con->prepare($checkSql);
$checkStmt->bind_param("is", $userID, $entryDate);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $row = $checkResult->fetch_assoc();
    $journalID = $row['ntj_journal_id'];

    $updateSql = "UPDATE nutrition_journal SET 
        ntj_breakfast_calories = ?, 
        ntj_lunch_calories = ?, 
        ntj_dinner_calories = ?, 
        ntj_snacks_calories = ?, 
        ntj_water_intake = ?, 
        ntj_supplements = ?, 
        ntj_notes = ?, 
        ntj_mood = ?, 
        ntj_updated_at = ?
        WHERE ntj_journal_id = ?";
    
    $updateStmt = $con->prepare($updateSql);
    $updateStmt->bind_param("sssssssssi", $breakfastCalories, $lunchCalories, $dinnerCalories, $snackCalories, $water, $supplements, $notes, $mood, $now, $journalID);
    $updateStmt->execute();

    // Delete old meal items
    $deleteMealSql = "DELETE FROM journal_meals WHERE jnm_journal_id = ?";
    $delStmt = $con->prepare($deleteMealSql);
    $delStmt->bind_param("i", $journalID);
    $delStmt->execute();
} else {
    // Insert new journal
    $insertSql = "INSERT INTO nutrition_journal (
        ntj_user_id, ntj_entry_date, ntj_breakfast_calories, ntj_lunch_calories,
        ntj_dinner_calories, ntj_snacks_calories, ntj_water_intake, ntj_supplements, 
        ntj_notes, ntj_mood, ntj_created_at, ntj_updated_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $insertStmt = $con->prepare($insertSql);
    $insertStmt->bind_param("isssssssssss", $userID, $entryDate, $breakfastCalories, $lunchCalories, $dinnerCalories, $snackCalories, $water, $supplements, $notes, $mood, $now, $now);
    $insertStmt->execute();
    $journalID = $insertStmt->insert_id;
}

// Insert meal items
$mealTypes = ['breakfast', 'lunch', 'dinner', 'snack'];
foreach ($mealTypes as $meal) {
    $foods = $_POST[$meal . 'Food'] ?? [];
    $portions = $_POST[$meal . 'Portion'] ?? [];

    for ($i = 0; $i < count($foods); $i++) {
        $food = trim($foods[$i]);
        $portion = trim($portions[$i]);
        if ($food !== '' || $portion !== '') {
            $insertMeal = $con->prepare("INSERT INTO journal_meals (jnm_journal_id, jnm_meal_type, jnm_food_name, jnm_portion_size) VALUES (?, ?, ?, ?)");
            $insertMeal->bind_param("isss", $journalID, $meal, $food, $portion);
            $insertMeal->execute();
        }
    }
}

echo json_encode(['status' => 'success', 'message' => 'Journal saved successfully ✅']);
?>
