<?php
/*Programmer Name: SIM TIAN (TP077056)
Program Name: W.getProgress.php
Description: Get process for workout progress page
First Written on: Monday, 23-June-2025
Edited on: 08-JULY-2025*/

session_start();
include 'config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usr_user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

// ✅ Extract duration from workout name like "Stretch (15 mins)"
function getDurationByWorkout($workoutName) {
    if (preg_match('/\((\d+)\s*mins?\)/i', $workoutName, $matches)) {
        return (int)$matches[1];
    }
    return 20; // Default if not found
}

$user_id = $_SESSION['usr_user_id'];

$sql = "SELECT wos_day, wos_item, wos_checked, wos_date
        FROM workout_status 
        WHERE wos_user_id = ? AND wos_checked = 1
        ORDER BY wos_date";

$stmt = $con->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'SQL prepare failed: ' . $con->error]);
    exit;
}

$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$log = [];
while ($row = $result->fetch_assoc()) {
    $duration = getDurationByWorkout($row['wos_item']);
    $log[] = [
        'day' => $row['wos_day'],
        'date' => $row['wos_date'],
        'workout' => $row['wos_item'],
        'duration' => $duration
    ];
}

echo json_encode(['success' => true, 'log' => $log]);
?>
