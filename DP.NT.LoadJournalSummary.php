<?php
/*
Programmer Name : Sim Tian (TP077056)
Program Name    : DP.NT.Journal.php
Description     : Retrive journal from database
First Written on: 05-July-2025
*/
session_start();
include 'config.php';

$userID = $_SESSION['usr_user_id'];

$sql = "SELECT ntj_entry_date, ntj_mood FROM nutrition_journal WHERE ntj_user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$entries = [];
while ($row = $result->fetch_assoc()) {
    $entries[$row['ntj_entry_date']] = [
        'mood' => $row['ntj_mood']
    ];
}

echo json_encode($entries);
?>
