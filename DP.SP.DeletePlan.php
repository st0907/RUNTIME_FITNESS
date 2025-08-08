<!--Programmer Name : Sim Tian (TP077056)
Program Name    : DP.SP.DeletePlan.php
Description     : Delete Saved Diet Plans
First Written on: Sunday, 22-June-2025
-->
<?php
session_start();
include("config.php");

// Validate session and POST data
if (!isset($_SESSION['usr_user_id'])) {
    die("Session user_id missing. Are you logged in?");
}

if (!isset($_POST['mpl_id'])) {
    die("mpl_id not received in POST.");
}

$userId = $_SESSION['usr_user_id'];
$planId = $_POST['mpl_id'];

// Delete plan
$stmt = $con->prepare("DELETE FROM meal_plans WHERE mpl_id = ? AND mpl_user_id = ?");
$stmt->bind_param("ii", $planId, $userId);

if ($stmt->execute()) {
    $_SESSION['plan_deleted'] = true;
    header("Location: DP.SP.PlansList.php");
    exit;
} else {
    $_SESSION['plan_deleted'] = false;
    header("Location: DP.SP.PlansList.php");
    exit;
}
?>
