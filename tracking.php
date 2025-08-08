<!--Programmer Name: SERENE LOH ZI TING (TP075920), SIM TIAN (TP077056)
Program Name: tracking.php
Description: Allow users to update their progress, include PHP, JS, HTML, CSS
First Written on: Wednesday, 19-June-2025
Edited on: 9-July-2025
-->
<?php
  session_start();
  require('config.php'); 

  $memberID = $_SESSION['usr_user_id'] ?? null;

  if (!$memberID) {
      echo "<script>
          alert(\"You must be logged in to track progress!\\nYou will be redirected to the Log In Page!\");
          window.location.replace('login.html');
      </script>";
      exit;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $date = date('Y-m-d');

      if (isset($_POST['save_weight'])) {
          $weight = $_POST['weight'];
          $stmt = $con->prepare("SELECT * FROM weight_logs WHERE wgl_member_ID = ? AND wgl_entry_date = ?");
          $stmt->bind_param("is", $memberID, $date);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
              $stmt = $con->prepare("UPDATE weight_logs SET wgl_weight = ? WHERE wgl_member_ID = ? AND wgl_entry_date = ?");
              $stmt->bind_param("dis", $weight, $memberID, $date);
          } else {
              $stmt = $con->prepare("INSERT INTO weight_logs (wgl_member_ID, wgl_entry_date, wgl_weight) VALUES (?, ?, ?)");
              $stmt->bind_param("isd", $memberID, $date, $weight);
          }
          $stmt->execute();
          $stmt->close();

          echo "<script>alert('Weight saved successfully!'); window.location.replace('tracking.php');</script>";
      }

      if (isset($_POST['save_measurements'])) {
          $waist = $_POST['waist'];
          $hip = $_POST['hip'];
          $thigh = $_POST['thigh'];

          if (is_numeric($waist) && is_numeric($hip) && is_numeric($thigh)) {
              $stmt = $con->prepare("SELECT * FROM body_measurements WHERE bdm_member_ID = ? AND bdm_entry_date = ?");
              $stmt->bind_param("is", $memberID, $date);
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                  // Update existing record
                  $stmt = $con->prepare("UPDATE body_measurements SET bdm_waist = ?, bdm_hip = ?, bdm_thigh = ? WHERE bdm_member_ID = ? AND bdm_entry_date = ?");
                  $stmt->bind_param("ddd is", $waist, $hip, $thigh, $memberID, $date);
              } else {
                  // Insert new record
                  $stmt = $con->prepare("INSERT INTO body_measurements (bdm_member_ID, bdm_waist, bdm_hip, bdm_thigh, bdm_entry_date) VALUES (?, ?, ?, ?, ?)");
                  $stmt->bind_param("iddds", $memberID, $waist, $hip, $thigh, $date);
              }

              $stmt->execute();
              $stmt->close();

              echo "<script>alert('Body measurements saved successfully!'); window.location.replace('tracking.php');</script>";
          } else {
              echo "<script>alert('Please enter a value between 10 cm and 200 cm for waist, hip, and thigh measurements.');</script>";
          }
      }

      if (isset($_POST['save_logs'])) {
          $water = $_POST['water'];
          $sleep = $_POST['sleep'];

          $stmt = $con->prepare("SELECT * FROM daily_logs WHERE dll_member_ID = ? AND dll_entry_date = ?");
          $stmt->bind_param("is", $memberID, $date);
          $stmt->execute();
          $check = $stmt->get_result();

          if ($check->num_rows > 0) {
              $stmt = $con->prepare("UPDATE daily_logs SET dll_water_cups = ?, dll_sleep_hours = ? WHERE dll_member_ID = ? AND dll_entry_date = ?");
              $stmt->bind_param("diis", $water, $sleep, $memberID, $date);
          } else {
              $stmt = $con->prepare("INSERT INTO daily_logs (dll_member_ID, dll_water_cups, dll_sleep_hours, dll_entry_date) VALUES (?, ?, ?, ?)");
              $stmt->bind_param("iids", $memberID, $water, $sleep, $date);
          }

          $stmt->execute();
          $stmt->close();

          // Generate JS-friendly message
          $feedback = "";
          if ($water < 4) {
              $feedback .= "💧 You drank too little water today. Stay hydrated!\\n";
          } elseif ($water <= 10) {
              $feedback .= "👍 Great job! You're drinking a healthy amount of water.\\n";
          } else {
              $feedback .= "⚠️ Too much water isn't always good! Try to moderate.\\n";
          }

          if ($sleep < 5) {
              $feedback .= "😴 You didn’t sleep enough. Try to rest more.\\n";
          } elseif ($sleep <= 9) {
              $feedback .= "🌟 Excellent sleep! Keep it up.\\n";
          } else {
              $feedback .= "💤 Too much sleep might make you feel sluggish. Stay balanced.\\n";
          }

          $feedback .= "✅ Daily logs saved successfully!";

          echo "<script>alert(\"$feedback\"); window.location.replace('tracking.php');</script>";
          exit;
      }
  }

  // Fetch data for chart display
  $weightDates = $weightValues = [];
  $measurementDates = $measurementValues = [];
  $waterDates = $waterValues = [];
  $sleepDates = $sleepValues = [];

  // Fetch weight logs
  $result = $con->query("SELECT wgl_entry_date, wgl_weight FROM weight_logs WHERE wgl_member_ID = '$memberID' ORDER BY wgl_entry_date");
  while ($row = $result->fetch_assoc()) {
      $weightDates[] = $row['wgl_entry_date'];
      $weightValues[] = $row['wgl_weight'];
  }

  // Fetch individual body measurements
  $measurementDates = $waistValues = $hipValues = $thighValues = [];

  $result = $con->query("SELECT bdm_entry_date, bdm_waist, bdm_hip, bdm_thigh FROM body_measurements WHERE bdm_member_ID = '$memberID' ORDER BY bdm_entry_date");
  while ($row = $result->fetch_assoc()) {
      $measurementDates[] = $row['bdm_entry_date'];
      $waistValues[] = $row['bdm_waist'];
      $hipValues[] = $row['bdm_hip'];
      $thighValues[] = $row['bdm_thigh'];
  }

  // Fetch water/sleep logs
  $result = $con->query("SELECT dll_entry_date, dll_water_cups, dll_sleep_hours FROM daily_logs WHERE dll_member_ID = '$memberID' ORDER BY dll_entry_date");
  while ($row = $result->fetch_assoc()) {
      $waterDates[] = $row['dll_entry_date'];
      $waterValues[] = $row['dll_water_cups'];
      $sleepDates[] = $row['dll_entry_date'];
      $sleepValues[] = $row['dll_sleep_hours'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUNTIME FITNESS - Progress Tracking</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            * {
                box-sizing: border-box;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                margin: 0;
                padding: 0;
            }
            
            body {
                background-color: #fdf8f2;
                color: #333;
                line-height: 1.6;
            }
            
            header {
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #fff;
                height: 85px;
                padding: 0 7% 0 3%;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                position: sticky;
                top: 0;
                z-index: 1000;
                position: relative;
            }
            
            #navbar-img {
                flex: 1;
                display: flex;
                align-items: center;
            }
            
            .nav-links {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                display: flex;
                gap: 2rem;
                justify-content: center;
            }
            
            .profile-link {
                flex: 1;
                display: flex;
                justify-content: flex-end;
                align-items: center;
                text-decoration: none;
            }
            
            #navbar-img img{
                height: 50px;
            }

            .home-nav-item {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: #f3ede3;
                color: #8D7151;
                font-size: 1.2rem;
                transition: all 0.3s ease;
                box-shadow: 0 2px 5px rgba(106, 72, 25, 0.1);
                border: 1px solid rgba(141, 113, 81, 0.1);
                margin-left: 16px;
                text-decoration: none;
            }

            .home-nav-item:hover {
                background-color: #8D7151;
                color: #fff;
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(106, 72, 25, 0.2);
            }

            .home-nav-item::after {
                display: none;
            }

            .nav-links a {
                text-decoration: none;
                color: #8D7151;
                font-weight: 500;
                transition: all 0.3s;
                font-size: 1.1rem;
                padding: 0 0 5px 0;
                position: relative;
                border-bottom: none;
            }

            .nav-links a:hover::after{
                content:'';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: #8E735B;
            }

            .nav-links a.active::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: #8E735B;
            }

            .profile-icon {
                width: 40px;
                height: 40px;
                background-color:rgb(182, 148, 120);
                font-weight: 600;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                cursor: pointer;
                transition: background-color 0.3 ease, transform 0.2s;
            }

            .profile-icon:hover {
                background-color:rgba(198, 163, 135, 0.9);
                transform: scale(1.05);
            }

            .page-header {
                text-align: center;
                margin: 3rem 0;
            }
            
            .page-header h1{
              font-size: 2.5rem;
              color: #4a3c2c;
              margin-bottom: 0.5rem;
            }

            .page-header p{
              color: #777;
              font-size: 1.1rem;
            }

            .tracker {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                gap: 2rem;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                padding: 0 5%;
            }
            
            .card {
                background: #fff;
                padding: 2rem;
                border-radius: 16px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .card:hover {
              transform: translateY(-4px);
              box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            }

            .card h2 {
              font-size: 1.5rem;
              color: #8e735B;
              margin-bottom: 1rem;
            }
            
            .card input, .card button {
                display: block;
                margin: 0.5rem 0;
                padding: 0.75rem;
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 10px;
                font-size: 1rem;
            }

            .card button {
                background-color: #8E735B;
                color: white;
                border: none;
                cursor: pointer;
                font-weight: bold;
                transition: background-color 0.2s ease;
            }
            
            .card button:hover {
                background-color: #6e5947;
            }

            label {
              font-weight: 500;
              margin-top: 0.5rem;
              display: block;
              color: #444;
            }

            .report {
                background: #fff;
                padding: 2rem;
                border-radius: 16px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                margin: 2rem 5%;
            }
            
            .report:hover {
              transform: translateY(-4px);
              box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            }

            .report h2 {
              font-size: 1.5rem;
              color: #8e735B;
              margin-bottom: 1rem;
            }

            .report h3 {
              font-size: 1rem;
              color: #8e735B;
              margin-bottom: 1rem;
            }

            .spacer-align {
              height: 20px; 
            }
        </style>
</head>
<body>
    <header>
        <div id="navbar-img">
            <a href="memberHomepage.php" class="home-nav-item" title="BACK TO MAIN PAGE">
                <i class="fas fa-home"></i>
            </a>
        </div>
        <div class="nav-links">
            <a href="DP.indexMain.php">Diet Plans</a>
            <a href="W.main.php">Workout</a>
            <a href="tracking.php" class="active">Progress Tracking</a>
            <a href="community.php">Community</a>
        </div>
        <div>
            <a href="P.viewProfile.php" class="profile-link">
                <div class="profile-icon">👤</div>
            </a>
        </div>
        <div>
            <a href="#" title="Logout" id="logout-link" style="margin-left: 1rem;color: #8E735B;">
                <i class="fa fa-sign-out fa-lg"></i>
            </a>
        </div>
    </header>

    <div class="page-header">
        <h1>🏋️ Progress Tracker</h1>
        <p>Track your fitness journey creatively!</p>
    </div>

  <section class="tracker">
    <div class="card">
      <h2>⚖️ Daily Weight</h2>
      <form method="POST" onsubmit="return validateWeightForm()">
        <div style="text-align: center;" >
          <img src="images/weight.gif" alt="Fitness Animation" width="100">
        </div>
        <input type="number" name="weight" min="10" max="200" step="0.1" placeholder="Today's Weight (kg)">
        <button type="submit" name="save_weight">Save Weight</button>
      </form>
    </div>

    <div class="card">
      <h2>📏 Body Measurements</h2>
      <form method="POST" onsubmit="return validateMeasurementForm()">
        <input type="text" name="waist" min="10" max="200" step="0.1"  placeholder="Waist (cm)">
        <input type="text" name="hip" min="10" max="200" step="0.1"  placeholder="Hip (cm)">
        <input type="text" name="thigh" min="10" max="200" step="0.1"  placeholder="Thigh (cm)">
        <button type="submit" name="save_measurements">Save</button>
      </form>
    </div>

    <div class="card">
      <h2>💧 Water & Sleep Log</h2>
      <form method="POST" onsubmit="return validateLogsForm()">
        <label>Water Intake (cups):</label>
        <input type="number" name="water" id="water" min="0" max="20" placeholder="Water Intake (cups)">
        <label>Sleep (hours):</label>
        <input type="number" name="sleep" id="sleep" min="0" max="24" placeholder="Sleep (hours)">
        <div class="spacer-align"></div>
        <button type="submit" name="save_logs">Log Today</button>
      </form>
    </div>
  </section>
  
  <br><br>

  <section class="report" style="display: flex; flex-direction: column; align-items: auto; gap: 20px;">
    <h2>📊 Weekly Report</h2>
      <p id="report">Your weekly summary will appear here.</p>

    <!-- Row 1: Weight and Body Measurement -->
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; width: 100%;">
      <div style="flex: 1 1 45%;">
        <h3>💪🏻 Weight Chart</h3>
        <canvas id="chartWeight"></canvas>
      </div>
      <div style="flex: 1 1 45%;">
        <h3>🧍 Body Measurement Chart Report</h3>
        <canvas id="measurementChart"></canvas>
      </div>
    </div>

    <!-- Row 2: Water and Sleep -->
    <div style="width: 90%;">
      <h3>💧 Water and Sleep Chart 😴</h3>
      <canvas id="waterandsleepChart"></canvas>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    function validateWeightForm() {
      const weightInput = document.querySelector('input[name="weight"]').value;
      const weight = parseFloat(weightInput);
      if (!weightInput || isNaN(weight) || weight < 10 || weight > 200) {
        alert("Please enter a value between 10 to 200 for weight.");
        return false; // prevent submission
      }
      return true;
    }

    function validateMeasurementForm() {
      const waist = parseFloat(document.querySelector('input[name="waist"]').value);
      const hip = parseFloat(document.querySelector('input[name="hip"]').value);
      const thigh = parseFloat(document.querySelector('input[name="thigh"]').value);

      if (
        isNaN(waist) || waist < 10 || waist > 200 ||
        isNaN(hip) || hip < 10 || hip > 200 ||
        isNaN(thigh) || thigh < 10 || thigh > 200
      ) {
        alert("Please enter values between 10 to 200 for waist, hip, and thigh.");
        return false;
      }
      return true;
    }

    // Convert PHP arrays to JavaScript
    const weightLabels = <?= json_encode($weightDates); ?>;
    const weightData = <?= json_encode($weightValues); ?>;

    const measurementLabels = <?= json_encode($measurementDates); ?>;
    const measurementData = <?= json_encode($measurementValues); ?>;

    const labels = <?php echo json_encode($waterDates); ?>; 
    const waterData = <?php echo json_encode($waterValues); ?>;
    const sleepData = <?php echo json_encode($sleepValues); ?>; 

    // Weight Chart
    new Chart(document.getElementById('chartWeight'), {
      type: 'line',
      data: {
        labels: weightLabels,
        datasets: [{
          label: 'Weight (kg)',
          data: weightData,
          backgroundColor: 'rgba(142, 115, 91, 0.2)',
          borderColor: '#8E735B',
          fill: true,
          tension: 0.3
        }]
      }
    });
  
    const ctx = document.getElementById('measurementChart').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?= json_encode($measurementDates) ?>,
        datasets: [
          {
            label: 'Waist (cm)',
            data: <?= json_encode($waistValues) ?>,
            borderColor: '#FF6384',
            fill: false
          },
          {
            label: 'Hip (cm)',
            data: <?= json_encode($hipValues) ?>,
            borderColor: '#36A2EB',
            fill: false
            },
          {
            label: 'Thigh (cm)',
            data: <?= json_encode($thighValues) ?>,
            borderColor: '#FFCE56',
            fill: false
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Body Measurements (cm)'
          }
        }
      }
    });


    // Water & Sleep Chart
    const ctx2 = document.getElementById('waterandsleepChart').getContext('2d');
    new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Water Intake (cups)',
          data: waterData,
          backgroundColor: '#6EC6FF'
        },
        {
          label: 'Sleep Duration (hours)',
          data: sleepData,
          backgroundColor: '#A3D9A5'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'Daily Water vs Sleep Tracking'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Amount'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Date'
          }
        }
      }
    }
    });

    // Logout confirmation
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
  </script>
    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
