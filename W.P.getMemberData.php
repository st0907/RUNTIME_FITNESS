<?php
/*Programmer Name: SIM TIAN (TP077056)
Program Name: W.getMemberData.php
Description: Get member data for workout plan page
First Written on: Monday, 23-June-2025
Edited on: 08-JULY-2025*/

session_start();
include 'config.php';

header('Content-Type: application/json');

// Check session
if (!isset($_SESSION['usr_user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['usr_user_id'];

$sql = "SELECT mbp_height, mbp_weight FROM member_profiles WHERE mbp_user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    echo json_encode($data); // ✅ clean JSON
} else {
    echo json_encode(['error' => 'User not found']);
}
?>
