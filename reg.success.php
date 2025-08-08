<?php
session_start();
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="3;url=login.html">
    <title>Success</title>
    <link rel="stylesheet" href="register.css">
    <style>
        body {
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 25px;
            border: 1px solid #c3e6cb;
            max-width: 80%;
        }
    </style>
</head>
<body>
    <div class="success-message">
        Registration successful! You will be redirected to login.
    </div>
</body>
</html>
