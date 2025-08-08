<?php
session_start();
header('Content-Type: application/json');
/*Programmer Name : Sim Tian (TP077056)
Program Name    : DP.PS.ProcessSavePlan.php
Description     : Personalized Diet Plan - Save Generated Diet Plans to the database
First Written on: Sunday, 15-June-2025
Edited on : Sunday, 22-June-2025
*/
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['user_id'], $data['title'], $data['plan_data'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required data.']);
    exit;
}

$user_id = $data['user_id'];
$title = $data['title'];
$planData = json_encode($data['plan_data']);

$stmt = $con->prepare("INSERT INTO meal_plans (mpl_user_id, mpl_title, mpl_plan_data) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $title, $planData);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Your meal plan has been saved successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}
?>
    
    
