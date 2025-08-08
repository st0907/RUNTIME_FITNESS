<?php
/*Programmer Name: SIM TIAN (TP077056)
Program Name: W.getWorkoutPlan.php
Description: Get workout plan for workout plan page
First Written on: Monday, 23-June-2025
Edited on: 08-JULY-2025*/

session_start();
include 'config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usr_user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['usr_user_id'];

$sql = "SELECT wop_plan FROM workout_plan 
        WHERE wop_user_id = ? 
        ORDER BY wop_created_at DESC 
        LIMIT 1";

$stmt = $con->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
    exit;
}

$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data && $data['wop_plan']) {
    $decodedPlan = json_decode($data['wop_plan'], true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($decodedPlan)) {
        echo json_encode(['success' => true, 'plan' => $decodedPlan]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to decode plan']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No workout plan found']);
}
?>
