<!--
Programmer Name : Sim Tian (TP077056)
Program Name    : DP.NT.Journal.php
Description     : Retrive journal from database
First Written on: 05-July-2025
-->

<?php
session_start();
include 'config.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (!isset($_SESSION['usr_user_id'])) {
        echo "<script>
            alert(\"You must be logged in to access the homepage.\\nYou will be redirected to the login page.\");
            window.location.replace('login.html');
        </script>";
        exit;
}

if (!isset($_GET['entryDate']) || empty($_GET['entryDate'])) {
    echo "Missing date.";
    exit;
}

$entryDate = $_GET['entryDate'];
$userId = $_SESSION['usr_user_id'];

$sql = "SELECT * FROM nutrition_journal WHERE ntj_entry_date = ? AND ntj_user_id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $con->error);
}

$stmt->bind_param("si", $entryDate, $userId); 

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No data found.";
    exit;
}

$row = $result->fetch_assoc();
$journalId = $row['ntj_journal_id'];

echo "[ENTRY]\n";
echo "ntj_mood: {$row['ntj_mood']}\n";
echo "ntj_breakfast_calories: " . ($row['ntj_breakfast_calories'] == 0 ? '' : $row['ntj_breakfast_calories']) . "
";
echo "ntj_lunch_calories: " . ($row['ntj_lunch_calories'] == 0 ? '' : $row['ntj_lunch_calories']) . "
";
echo "ntj_dinner_calories: " . ($row['ntj_dinner_calories'] == 0 ? '' : $row['ntj_dinner_calories']) . "
";
echo "ntj_snacks_calories: " . ($row['ntj_snacks_calories'] == 0 ? '' : $row['ntj_snacks_calories']) . "
";
echo "ntj_water_intake: {$row['ntj_water_intake']}\n";
echo "ntj_supplements: {$row['ntj_supplements']}\n";
echo "ntj_notes: {$row['ntj_notes']}\n";

$mealSql = "SELECT * FROM journal_meals WHERE jnm_journal_id = ?";
$mealStmt = $con->prepare($mealSql);

if (!$mealStmt) {
    die("Meal prepare failed: " . $con->error);
}

$mealStmt->bind_param("i", $journalId); 
$mealStmt->execute();
$mealResult = $mealStmt->get_result();

echo "[MEALS]\n";
while ($meal = $mealResult->fetch_assoc()) {
    echo "{$meal['jnm_meal_type']}|{$meal['jnm_food_name']}|{$meal['jnm_portion_size']}\n";
}
?>
