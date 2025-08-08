<!--
Programmer Name : Sim Tian (TP077056)
Program Name    : processResetPassword.php
Description     : Reset Password
First Written on: Sunday, 23-May-2025
Edited on : Sunday, 22-June-2025
-->
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Include the database connection file
include('config.php');

// Check if form data is received
if (isset($_POST['resetUsername']) && isset($_POST['keyPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
    
    // Get form data
    $username = $_POST['resetUsername'];
    $keyword = $_POST['keyPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Sanitize the inputs
    $username = mysqli_real_escape_string($con, $username);
    $keyword = mysqli_real_escape_string($con, $keyword);
    $newPassword = mysqli_real_escape_string($con, $newPassword);
    $confirmPassword = mysqli_real_escape_string($con, $confirmPassword);

    // Validate password match
    if ($newPassword !== $confirmPassword) {
        echo "<script>
                    alert('New Password and Confirm Password are not match. Please try again!'); 
                    window.location.href = 'login.html';
                </script>";
        exit();
    }

    // Check if the user exists and validate the keyword
    $query = "SELECT * FROM users WHERE usr_username = '$username' AND usr_security_keyword = '$keyword'";
    $result = mysqli_query($con, $query);

    // Check if the query execution failed
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    if (mysqli_num_rows($result) > 0) {
        // User exists, now update the password
        $user = mysqli_fetch_assoc($result);
        
        // Use plaintext password, no hashing applied
        $updatedPassword = $newPassword;  // Directly use the new password

        // Update the password in the database
        $updateQuery = "UPDATE users SET usr_password = '$updatedPassword' WHERE usr_username = '$username'";

        if (mysqli_query($con, $updateQuery)) {
            // Password updated successfully
            echo "<script>
                    alert('Your password has been successfully reset.'); 
                    window.location.href = 'login.html';
                </script>";
        } else {
            // Error updating the password
            echo "<script>
                    alert('There was an error resetting your password. Please try again.'); 
                    window.location.href = 'login.html';
                </script>";
        }
    } else {
        // User does not exist or wrong keyword
        echo "<script>
                alert('User does not exist or wrong keyword. Please try again!'); 
                window.location.href = 'login.html';
            </script>";
    }
} else {
    // No data received
    echo "<script>
            alert('No date received.'); 
            window.location.href = 'login.html';
        </script>";
}
?>
