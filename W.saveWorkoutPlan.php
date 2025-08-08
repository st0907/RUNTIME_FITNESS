<?php
/*Programmer Name: SIM TIAN (TP077056)
Program Name: W.saveWorkoutPlan.php
Description: Save workout plan for workout plan page
First Written on: Monday, 23-June-2025
Edited on: 08-JULY-2025*/

session_start();
include 'config.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['usr_user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['usr_user_id'];

// Get and decode JSON input
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

// Normalize keys to lowercase
$normalized = array_change_key_case($data, CASE_LOWER);

// Validate all required fields
if (!isset($normalized['height'], $normalized['weight'], $normalized['bmi'], $normalized['category'], $normalized['plan'])) {
    echo json_encode(['success' => false, 'message' => 'Incomplete data']);
    exit;
}

// Extract values
$height   = floatval($normalized['height']);
$weight   = floatval($normalized['weight']);
$bmi      = floatval($normalized['bmi']);
$category = $normalized['category'];
$plan     = json_encode($normalized['plan']); // Save array as JSON

// Optional: delete existing plan this week
$deleteSql = "DELETE FROM workout_plan 
              WHERE wop_user_id = ? 
              AND YEARWEEK(wop_created_at, 1) = YEARWEEK(NOW(), 1)";
$deleteStmt = $con->prepare($deleteSql);
$deleteStmt->bind_param("s", $user_id);
$deleteStmt->execute();

// Insert new workout plan
$insertSql = "INSERT INTO workout_plan 
    (wop_user_id, wop_height, wop_weight, wop_bmi, wop_category, wop_plan)
    VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($insertSql);
$stmt->bind_param("sdddss", $user_id, $height, $weight, $bmi, $category, $plan);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save workout plan',
        'error' => $stmt->error
    ]);
}
?>
