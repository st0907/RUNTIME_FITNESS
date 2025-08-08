<?php
/*Programmer Name: YEO PEI WEN (TP077057), SIM TIAN (TP077056)
Program Name: W.routine.php
Description: Routine for workout page
First Written on: Sunday, 22-June-2025
Edited on: 12-JULY-2025*/

    session_start();

    if (!isset($_SESSION['usr_user_id'])) {
        echo "<script>
            alert(\"You must be logged in to access the homepage.\\nYou will be redirected to the login page.\");
            window.location.replace('login.html');
        </script>";
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RunTime Fitness - Workout Page</title>
  <link rel="icon" href="images/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="W.routine.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .footer-sticky {
      margin-top: auto;
    }
    .page-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .routine-container {
      max-width: 900px;
      width: 100%;
      margin: 150px auto 120px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      align-self: center;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="nav-container">
      <a href="memberHomepage.php" class="home-button"><i class="fas fa-home"></i></a>

        <ul class="nav-links">
          <li><a href="W.main.php">Workout</a></li>
          <li><a href="W.library.php">Workout Library</a></li>
          <li><a href="W.P.plan.php">Personalized Workout Plan</a></li>
          <li><a href="W.routine.php" class="active">Workout Routine</a></li>
          <li><a href="W.progress.php">Workout Progress</a></li>
        </ul>
      
      <div class="nav-right">
        <a href="P.viewProfile.php" class="profile-link">
          <div class="profile-icon">👤</div>
        </a>
        <a href="#" title="Logout" id="logout-link" class="logout-icon">
          <i class="fa fa-sign-out fa-lg"></i>
        </a>
      </div>
    </div>
  </nav>

  <div class="page-wrapper">
    <div class="routine-container">
      <h1>Weekly Workout Routine</h1>
      <div id="today-card" class="today-card-container"></div>
      <div id="other-days" class="week-grid small-grid"></div>
    </div>
  </div>

  <footer class="footer-sticky" style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; text-align: center; border-top: 1px solid #e5dbc7;">
    <div style="max-width: 1200px; margin: 0 auto;">
      <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved</p>
    </div>
  </footer>
  <script src="W.routine.js"></script>
  <script>
        // Logout confirmation
        document.addEventListener('DOMContentLoaded', function () {
            const logoutLink = document.getElementById('logout-link');
            if (logoutLink) {
                logoutLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Update your progress?',
                        text: "💪 Have you updated your progress for today?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, update now',
                        cancelButtonText: 'Logout anyway',
                        reverseButtons: true,
                        background: '#fff8f3',
                        confirmButtonColor: '#8E735B',
                        cancelButtonColor: '#ccc'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'tracking.php';
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            window.location.href = 'P.Logout.php';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
