<!--
Programmer Name : Sim Tian (TP077056)
Program Name    : P.Logout.php
Description     : Tells the user that they have successfully logged out from the system
First Written on: Saturday, 28-June-2025
-->
<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout | RUNTIME FITNESS</title>
    <meta http-equiv="refresh" content="5;url=login.html">
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3ede3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .logout-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            max-width: 400px;
        }

        .logout-container h1 {
            font-size: 1.5rem;
            color: #8E735B;
            margin-bottom: 10px;
        }

        .logout-container p {
            color: #666;
            margin-bottom: 20px;
        }

        .logout-container i {
            font-size: 2rem;
            color: #f39c12;
            margin-bottom: 15px;
        }

        .btn {
            background-color: #8E735B;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #7b604b;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <i class="fas fa-smile-beam"></i>
        <h1>You’ve been logged out successfully</h1>
        <p>Thank you for using Runtime Fitness. Take care and see you soon 🥰💞💖</p>
        <a href="login.html" class="btn">Login Again</a>
    </div>
</body>
</html>
