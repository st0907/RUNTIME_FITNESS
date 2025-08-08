<!--
Programmer Name : Sim Tian (TP077056)
Program Name    : processLogin.php
Description     : Process of logging into the system
First Written on: Sunday, 26-May-2025
Edited on : Sunday, 13-July-2025
-->

<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('config.php'); // Include the database connection

    if (isset($_POST['loginUsername']) && isset($_POST['password'])) {
        $username = $_POST['loginUsername'];
        $password = $_POST['password'];

        var_dump($_POST);

        // Validate the inputs
        if (empty($username) || empty($password)) {
            echo "<script>alert('Please fill in all fields');</script>";
            exit();
        }

        // ✅ Default admin login check
        if ($username === 'admin' && $password === 'i_am_admin_123') {
            $_SESSION['usr_user_id'] = 'admin';
            $_SESSION['usr_username'] = 'admin';
            header('Location: adminHomepage.php');
            exit();
        }

        // Check from database
        $stmt = $con->prepare("SELECT * FROM users WHERE usr_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if ($password === $user['usr_password']) {
                $_SESSION['usr_user_id'] = $user['usr_user_id'];
                $_SESSION['usr_username'] = $user['usr_username'];

                //xlyn: added usr_last_login to record last login time stamp. 
                $updateStmt = $con->prepare("UPDATE users SET usr_last_login = NOW() WHERE usr_user_id = ?");
                $updateStmt->bind_param("i", $user['usr_user_id']);
                $updateStmt->execute();
                $updateStmt->close();                

                header('Location: indexMain.php');
                exit();
            } else {
                echo "<script>
                        alert('Incorrect password. Please try again!');
                        window.location.replace('login.html');
                    </script>";
            }
        } else {
            echo "<script>
                    alert('User does not exist. Please register first!');
                    window.location.replace('login.html');
                </script>";
        }
    } else {
        echo "<script>
                alert('No data received.');
                window.location.replace('login.html');
            </script>";
    }
?>
