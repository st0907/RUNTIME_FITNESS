<?php
/*
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.NT.GetMonthlySummary.php
Description     : PHP code to get monthly summary in diet plan page
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/
session_start();
include("config.php");

if (!isset($_SESSION['usr_user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

if (!isset($_GET['month']) || !isset($_GET['year'])) {
    echo json_encode(["error" => "Month and year not specified"]);
    exit;
}

$userId = $_SESSION['usr_user_id'];
$month = $_GET['month'];
$year = $_GET['year'];

$stmt = $con->prepare("
    SELECT 
        COUNT(*) as totalEntries,
        AVG(ntj_breakfast_calories + ntj_lunch_calories + ntj_dinner_calories + ntj_snacks_calories) as avgCalories
    FROM 
        nutrition_journal 
    WHERE 
        ntj_user_id = ? AND 
        MONTH(ntj_entry_date) = ? AND 
        YEAR(ntj_entry_date) = ?
");
$stmt->bind_param("iii", $userId, $month, $year);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$response = [
    "totalEntries" => $data['totalEntries'] ? $data['totalEntries'] : 0,
    "avgCalories" => $data['avgCalories'] ? round($data['avgCalories']) : 0
];

echo json_encode($response);
?>
