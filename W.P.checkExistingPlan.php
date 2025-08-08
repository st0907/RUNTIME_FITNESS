<?php
/*Programmer Name: SIM TIAN (TP077056)
Program Name: W.P.checkExistingPlan.php
Description: Check existing plan page for workout page
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
$startOfWeek = date('Y-m-d', strtotime('monday this week'));

$sql = "SELECT wop_plan, wop_created_at 
        FROM workout_plan 
        WHERE wop_user_id = ? AND DATE(wop_created_at) >= ? 
        ORDER BY wop_created_at DESC 
        LIMIT 1";

$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $user_id, $startOfWeek);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    echo json_encode([
        'success' => true,
        'exists' => true,
        'plan' => json_decode($data['wop_plan'], true),
        'created_at' => $data['wop_created_at']
    ]);
} else {
    echo json_encode(['success' => true, 'exists' => false]);
}
?>
