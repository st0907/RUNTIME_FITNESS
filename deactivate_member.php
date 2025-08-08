<!--
Programmer Name : Yong Xuan Lyn (TP076797)
Program Name    : deactivate_member.php
Description     : Allow admin edit delete a member profile
First Written on: Wednesday, 09-July-2025
Edited on: Saturday, 12-July-2025
-->

<?php
session_start();
include 'config.php';

$memberId = $_GET['id'] ?? null;

if ($memberId) {
    // Need to delete from secoindary tables before deleting from users
    // 1. Delete from body_measurements
    $stmt_bm = mysqli_prepare($con, "DELETE FROM body_measurements WHERE bdm_member_ID = ?");
    mysqli_stmt_bind_param($stmt_bm, "i", $memberId);
    mysqli_stmt_execute($stmt_bm);
    mysqli_stmt_close($stmt_bm);

    // 2. Delete from daily_logs
    $stmt_dl = mysqli_prepare($con, "DELETE FROM daily_logs WHERE dll_member_ID = ?");
    mysqli_stmt_bind_param($stmt_dl, "i", $memberId);
    mysqli_stmt_execute($stmt_dl);
    mysqli_stmt_close($stmt_dl);

    // 3. Delete from weight_logs
    $stmt_wl = mysqli_prepare($con, "DELETE FROM weight_logs WHERE wgl_member_ID = ?");
    mysqli_stmt_bind_param($stmt_wl, "i", $memberId);
    mysqli_stmt_execute($stmt_wl);
    mysqli_stmt_close($stmt_wl);

    // 4. Delete from member_profiles
    $stmt_mp = mysqli_prepare($con, "DELETE FROM member_profiles WHERE mbp_user_ID = ?");
    mysqli_stmt_bind_param($stmt_mp, "i", $memberId);
    mysqli_stmt_execute($stmt_mp);
    mysqli_stmt_close($stmt_mp);

    // 5. Delete from nutrition_journal
    $stmt_nj = mysqli_prepare($con, "DELETE FROM nutrition_journal WHERE ntj_user_id = ?");
    mysqli_stmt_bind_param($stmt_nj, "i", $memberId);
    mysqli_stmt_execute($stmt_nj);
    mysqli_stmt_close($stmt_nj);

    // 6. Delete from users
    $stmt_u = mysqli_prepare($con, "DELETE FROM users WHERE usr_user_id = ?");
    mysqli_stmt_bind_param($stmt_u, "i", $memberId);

    if (mysqli_stmt_execute($stmt_u)) {
        header("Location: view_members.php");
        exit;
    } else {
        echo "Failed to delete member: " . mysqli_error($con);
    }
    mysqli_stmt_close($stmt_u);
} else {
    echo "Invalid member ID";
}

?>
