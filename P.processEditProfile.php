<?php
session_start();
include 'config.php';

if (!isset($_SESSION['usr_user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['usr_user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize input
    $username = trim($_POST["username"]);
    $fullName = trim($_POST["fullName"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);
    $security_keyword = trim($_POST["security_keyword"]);

    $dob = trim($_POST["dob"]); // Expected format: dd/mm/yyyy
    $gender = $_POST["gender"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];
    $goal = trim($_POST["goal"]);

    // Convert date format to yyyy-mm-dd
    $dob_parts = explode("/", $dob);
    if (count($dob_parts) === 3) {
        $dob = $dob_parts[2] . "-" . $dob_parts[1] . "-" . $dob_parts[0];
    }

    // Update `users` table (NOW includes password & keyword)
    $sql_users = "UPDATE users SET 
                    usr_username = ?, 
                    usr_full_name = ?, 
                    usr_email = ?, 
                    usr_phone = ?, 
                    usr_password = ?, 
                    usr_security_keyword = ? 
                  WHERE usr_user_id = ?";
    $stmt_users = $con->prepare($sql_users);
    $stmt_users->bind_param("ssssssi", $username, $fullName, $email, $phone, $password, $security_keyword, $user_id);

    // Update `member_profiles` table
    $sql_profile = "UPDATE member_profiles SET 
                    mbp_dob = ?, 
                    mbp_gender = ?, 
                    mbp_height = ?, 
                    mbp_weight = ?, 
                    mbp_goal = ? 
                    WHERE mbp_user_ID = ?";
    $stmt_profile = $con->prepare($sql_profile);
    $stmt_profile->bind_param("ssddsi", $dob, $gender, $height, $weight, $goal, $user_id);

    // Execute both
    $success_users = $stmt_users->execute();
    $success_profile = $stmt_profile->execute();

    if ($success_users && $success_profile) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='P.editProfile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile. Please try again.'); window.history.back();</script>";
    }

    $stmt_users->close();
    $stmt_profile->close();
    $con->close();
}
?>
