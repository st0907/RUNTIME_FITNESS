<?php
// Programmer Name: Sim Tian
// Program Name   : P.deleteAccount.php
// Description    : Delete user account and all related data
// Last Updated   : 10-July-2025

session_start();
include 'config.php';

if (!isset($_SESSION['usr_user_id'])) {
    echo "Please login first.";
    exit();
}

$user_id = $_SESSION['usr_user_id'];
$member_id = $user_id; // Same ID used in member-related tables

// Start transaction
$con->begin_transaction();

try {
    // Delete related journal meals
    $getJournalIDs = "SELECT ntj_journal_id FROM nutrition_journal WHERE ntj_user_id = ?";
    $stmt = $con->prepare($getJournalIDs);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $journal_id = $row['ntj_journal_id'];
        $deleteMeals = $con->prepare("DELETE FROM journal_meals WHERE jnm_journal_id = ?");
        $deleteMeals->bind_param("i", $journal_id);
        $deleteMeals->execute();
    }

    // Delete data from other tables (by user ID)
    $tables_user_id = [
        "meal_plans" => "mpl_user_id",
        "nutrition_journal" => "ntj_user_id",
        "workout_plan" => "wop_user_id",
        "workout_status" => "wos_user_id"
    ];

    foreach ($tables_user_id as $table => $column) {
        $stmt = $con->prepare("DELETE FROM $table WHERE $column = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    }

    // Delete data from other tables (by member ID)
    $tables_member_id = [
        "body_measurements" => "bdm_member_ID",
        "daily_logs" => "dll_member_ID",
        "weight_logs" => "wgl_member_ID"
    ];

    foreach ($tables_member_id as $table => $column) {
        $stmt = $con->prepare("DELETE FROM $table WHERE $column = ?");
        $stmt->bind_param("i", $member_id);
        $stmt->execute();
    }

    // Delete from member_profiles
    $stmt = $con->prepare("DELETE FROM member_profiles WHERE mbp_user_ID = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Delete from users
    $stmt = $con->prepare("DELETE FROM users WHERE usr_user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Commit all
    $con->commit();

    // Clear session and respond
    session_unset();
    session_destroy();

    echo "Account deleted successfully.";
} catch (Exception $e) {
    $con->rollback();
    echo "Failed to delete account. Please try again.";
}
?>
