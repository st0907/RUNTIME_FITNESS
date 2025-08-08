<?php
/*
Programmer Name : Sim Tian (TP077056)
Program Name    : DP.PS.GetMemberData.php
Description     : Personalized Diet Plan - Get Member Data for chatbot 
First Written on: Sunday, 15-June-2025
Edited on : Sunday, 22-June-2025
*/
session_start();
include 'config.php';

$mbp_user_ID = $_SESSION['usr_user_id']; 

$sql = "SELECT mbp_height, mbp_weight, mbp_dob, mbp_gender FROM member_profiles WHERE mbp_user_ID = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $con->error);
}

$stmt->bind_param("i", $mbp_user_ID);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if (!$userData) {
    echo "ERROR: No user found";
    exit;
}

$height = $userData['mbp_height'];
$weight = $userData['mbp_weight'];
$dob = $userData['mbp_dob'];
$genderVal = $userData['mbp_gender']; 

$gender = ($genderVal == 0) ? 'Male' : 'Female';

$dobDate = new DateTime($dob);
$today = new DateTime();
$age = $today->diff($dobDate)->y;

echo "$height,$weight,$age,$gender";
?>
