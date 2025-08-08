<!--
Programmer Name : Yong Xuan Lyn (TP076797)
Program Name    : report_registration.php
Description     : Allow admin to view registration statistics
First Written on: Wednesday, 09-July-2025
Edited on: Sunday, 13-July-2025
-->

<?php
SESSION_START();
include 'config.php';

// Fetch registration counts

// Get current date
$currentDate = date('l, d/m/Y');
// Get current year, month, and week
$currentYear = date('Y');
$currentMonth = date('m');
$currentWeek = date('W');

// Annual registrations
$resultAnnual = mysqli_query($con, "SELECT COUNT(*) AS count FROM users WHERE YEAR(usr_reg_date) = '$currentYear'");
$annual = mysqli_fetch_assoc($resultAnnual)['count'];

// Monthly registrations
$resultMonth = mysqli_query($con, "SELECT COUNT(*) AS count FROM users WHERE YEAR(usr_reg_date) = '$currentYear' AND MONTH(usr_reg_date) = '$currentMonth'");
$month = mysqli_fetch_assoc($resultMonth)['count'];

// Weekly registrations
$resultWeek = mysqli_query($con, "SELECT COUNT(*) AS count FROM users WHERE YEAR(usr_reg_date) = '$currentYear' AND WEEK(usr_reg_date, 1) = '$currentWeek'");
$week = mysqli_fetch_assoc($resultWeek)['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
        body {
            background: #fdf8f2;
            font-family: sans-serif;
        }

        .report-box {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 2rem;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.07);
            margin-top: 2.5rem;
        }

        h2{
            color: #5a4033;
            margin-bottom: 1rem;
        }

        h3 {
            color: #5a4033;
            margin-bottom: 1.5rem;
        }

        ul{
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #fff7f1;
            color: #7c6b60;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            z-index: 100;
        }

        header {
            background-color: #fff;
            padding: 1.3rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 90%;
            height: 48px;
        }
        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .logout {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            cursor: pointer;
        }
        .home-icon {
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
        .home-icon:hover {
            color: #fff;
            background-color: #8D7151;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(106, 72, 25, 0.2);
        }
        .home-icon:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(106, 72, 25, 0.15);
        }
    </style>
</head>
<body>
    <a href="adminHomepage.php" class="home-icon" title="Back to Admin Home" tabindex="0">
        <i class="fas fa-home"></i>
    </a>
    <header>
        <div></div>
        <div class="nav-buttons">
            <form action="homepage.php" method="POST">
                <button class="logout">Logout</button>
            </form>
        </div>
    </header>
    <div class="report-box">
        <h2>Member Registration Report</h2>
        <h3>Today's date: <?= $currentDate ?></h3>
        <ul>
            <li><strong>This Week:</strong> <?= $week ?> members</li>
            <li><strong>This Month:</strong> <?= $month ?> members</li>
            <li><strong>This Year:</strong> <?= $annual ?> members</li>
        </ul>
    </div>

    <footer>
        &copy; 2025 RUNTIME FITNESS Admin Portal. All rights reserved.
    </footer>
</body>
</html>
