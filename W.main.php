<!--Programmer Name: YEO PEI WEN (TP077057), SIM TIAN (TP077056)
Program Name: W.main.php
Description: Homepage for workout page
First Written on: Wednesday, 18-June-2025
Edited on: 12-JULY-2025-->

<?php
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
  <link rel="stylesheet" href="W.main.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <nav class="navbar">
    <div class="nav-container">
      <a href="memberHomepage.php" class="home-button"><i class="fas fa-home"></i></a>

        <ul class="nav-links">
          <li><a href="W.main.php" class="active">Workout</a></li>
          <li><a href="W.library.php">Workout Library</a></li>
          <li><a href="W.P.plan.php">Personalized Workout Plan</a></li>
          <li><a href="W.routine.php">Workout Routine</a></li>
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

  <section class="index">
    <div class="index-content">
      <h1>Workout Page</h1>
      <p>Your personalized fitness journey starts here. Get custom workout plans, track your progress, and achieve your fitness goals with our comprehensive platform.</p>
    </div>
    <img src="images/WorkoutMain.gif" class="character-image WorkoutMain-gif" alt="Workout GIF">
  </section>

  <section class="feature">
    <div class="feature-container">
      <h2>Why Choose RunTimeFitness?</h2>
      <div class="feature-grid">
        <div class="feature-card">
            <div class="feature-icon">📚</div>
          <h3>Workout Library</h3>
          <p>Access videos with instructions from beginner to advanced.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">📝</div>
          <h3>Personalized Workout Plans</h3>
          <p>Get workout plans tailored to your body type, fitness level, and goals.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🎯</div>
          <h3>Workout Routine</h3>
          <p>Here’s your personalized workout routine based on your goals and fitness level.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">📊</div>
          <h3>Workout Progress</h3>
          <p>Monitor your progress, set goals, and stay motivated.</p>
        </div>
      </div>
    </div>
  </section>

  <script src="W.main.js"></script>
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
<footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved</p>
        </div>
    </footer>
</html>
