<?php
/*Programmer Name: SIM TIAN (TP077056)
Program Name: W.getCheckbox.php
Description: Get check box for workout routine page
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

$sql = "SELECT wos_day, wos_date, wos_item, wos_checked FROM workout_status WHERE wos_user_id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
    exit;
}

$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$status_by_day = [];
$status_by_date = [];

while ($row = $result->fetch_assoc()) {
    $day = $row['wos_day'];   // For plan display
    $date = $row['wos_date']; // For charting
    $item = $row['wos_item'];
    $checked = (bool)$row['wos_checked'];

    // Grouped by day name (e.g., "Monday")
    if (!isset($status_by_day[$day])) {
        $status_by_day[$day] = [];
    }
    $status_by_day[$day][$item] = $checked;

    // Grouped by actual date (e.g., "2025-06-30")
    if (!isset($status_by_date[$date])) {
        $status_by_date[$date] = [];
    }
    $status_by_date[$date][$item] = $checked;
}

echo json_encode([
    'success' => true,
    'status_by_day' => $status_by_day,
    'status_by_date' => $status_by_date
]);
exit;
?>
