<?php
/*Programmer Name: SIM TIAN (TP077056)
Program Name: W.saveCheckbox.php
Description: Save check box for workout routine page
First Written on: Monday, 23-June-2025
Edited on: 08-JULY-2025*/

session_start();
include 'config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usr_user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput, true);

// Log for debugging (optional)
// error_log("Raw input: " . $rawInput);

if (!is_array($data) || !isset($data['day'], $data['item'], $data['checked'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$user_id = $_SESSION['usr_user_id'];
$day = $data['day'];
$item = $data['item'];
$checked = $data['checked'] ? 1 : 0;
$date = date('Y-m-d');

$sql = "REPLACE INTO workout_status (wos_user_id, wos_day, wos_date, wos_item, wos_checked)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'SQL prepare failed: ' . $con->error]);
    exit;
}

$stmt->bind_param("ssssi", $user_id, $day, $date, $item, $checked);
$stmt->execute();

echo json_encode(['success' => true]);
?>
