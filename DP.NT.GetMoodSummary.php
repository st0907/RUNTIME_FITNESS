<?php
/*
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.NT.GetMoodSummary.php
Description     : PHP code to get emotion/mood summary in diet plan page
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
*/
header('Content-Type: application/json');
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
        ntj_mood, 
        COUNT(*) as mood_count
    FROM 
        nutrition_journal 
    WHERE 
        ntj_user_id = ? AND 
        MONTH(ntj_entry_date) = ? AND 
        YEAR(ntj_entry_date) = ? AND
        ntj_mood IS NOT NULL AND ntj_mood != ''
    GROUP BY 
        ntj_mood
");
$stmt->bind_param("iii", $userId, $month, $year);
$stmt->execute();
$result = $stmt->get_result();

$moods = [];
while ($row = $result->fetch_assoc()) {
    $moods[$row['ntj_mood']] = $row['mood_count'];
}

echo json_encode($moods);
?>
