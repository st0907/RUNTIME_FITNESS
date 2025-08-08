<!--
Programmer Name : Yong Xuan Lyn (TP076797)
Program Name    : edit_member.php
Description     : Allow admin edit certain data of selected member profile
First Written on: Wednesday, 09-July-2025
Edited on: Saturday, 12-July-2025
-->

<?php
session_start();
include 'config.php'; 

if (!isset($_SESSION['usr_user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['usr_user_id'];

// Get member ID from URL
$memberId = $_GET['id'] ?? null;

if ($memberId) {
    $query = "SELECT * FROM users WHERE usr_user_id = $memberId";
    $result = mysqli_query($con, $query);
    $member = mysqli_fetch_assoc($result);
} else {
    die("Invalid member ID");
}

function sanitize($data, $con) {
return mysqli_real_escape_string($con, trim($data));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'], $con);
    $email = sanitize($_POST['email'], $con);
    $phone = sanitize($_POST['phone'], $con);

    // Username uniqueness check
    $checkUserQuery = "SELECT * FROM users WHERE usr_username = '$username' AND usr_user_id != $memberId";
    $result = $con->query($checkUserQuery);
    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username already taken.');
                window.location.replace('register.php');
            </script>";
        exit;
    }

    // Prepared statements 
    $stmt = mysqli_prepare($con, "UPDATE users SET usr_username = ?, usr_email = ?, usr_phone = ? WHERE usr_user_id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $phone, $memberId);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: view_members.php");
        exit;
    } else {
        echo "Update failed: " . mysqli_error($con);
    }
    mysqli_stmt_close($stmt);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>

    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="register.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        body {
            background-color: #fdf8f2;
            color: #333;
            line-height: 1.6;
            animation: fadeInBody 1s ease-in;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        @keyframes fadeInBody {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        header {
            background-color: #fff;
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }
        .nav-title {
            font-size: 1.6rem;
            font-weight: bold;
            color: #836953;
        }
        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .nav-buttons span {
            font-weight: 500;
        }
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer
        }
        .logout {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            cursor: pointer;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #fff7f1;
            margin-top: auto;
            color: #7c6b60;
        }

        .back-icon {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(106, 72, 25, 0.15);
            color: #8D7151;
            text-decoration: none;
            font-size: 22px;
            transition: all 0.3s ease;
            z-index: 2001;
            border: 2px solid rgba(141, 113, 81, 0.1);
        }
        .back-icon:hover {
            color: #fff;
            background-color: #8D7151;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(106, 72, 25, 0.2);
        }
        .back-icon:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(106, 72, 25, 0.15);
        }

        .container {
            flex: 1;
        }

    </style>
</head>
<body>
    <a href="view_members.php" class="back-icon" title="Back to Members" tabindex="0">
        <i class="fas fa-arrow-left"></i>
    </a>
    <header>
        <div></div>
        <div class="nav-buttons">
            <form action="homepage.php" method="POST">
                <button class="logout">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">
        <div class="register-container">
            <h1>Edit Member</h1>
            <form method="POST">
            <div class="user-details">
                <div class="input-group" style="width: 100%">
                    <label>Username:</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($member['usr_username']) ?>" required> 
                    <span class="message error" id="usernameError" style="display: none;">Username must be 5-15 characters, letters/numbers/underscores only</span>
                </div>

                <div class="input-group" style="width: 100%">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($member['usr_email'])?>" required>
                    <span class="message error" id="emailError" style="display: none;">Invalid email format</span>
                </div>

                <div class="input-group" style="width: 100%">
                    <label>Phone number:</label>
                    <input type="tel" name="phone" value="<?= htmlspecialchars($member['usr_phone'])?>" required>
                    <span class="message error" id="phoneError" style="display: none;">Please match the format such as 012-3456789 or 011-23456789</span>
                </div>
            </div>
                <button class="submit-btn" type="submit">Update</button>
            </form>
        </div>
    </div>

        <footer>
            &copy; 2025 RUNTIME FITNESS Admin Portal. All rights reserved.
        </footer>

    <script>
    document.querySelector("form").addEventListener("submit", function(e) {
        // Username validation
        const username = document.getElementById("username").value.trim();
        const usernamePattern = /^[A-Za-z0-9_]{5,15}$/;
        const usernameError = document.getElementById("usernameError");

        if (!usernamePattern.test(username)) {
            e.preventDefault();
            usernameError.style.display = "flex";
        } else {
            usernameError.style.display = "none";
        }

        // Phone number validation
        const phone = document.querySelector("input[name='phone']").value.trim();
        const phonePattern = /^[0-9]{3}-[0-9]{7,8}$/;
        const phoneError = document.getElementById("phoneError");

        if (!phonePattern.test(phone)) {
            e.preventDefault();
            phoneError.style.display = "flex";
        } else {
            phoneError.style.display = "none";
        }
    });
    </script>

</body>
</html>
