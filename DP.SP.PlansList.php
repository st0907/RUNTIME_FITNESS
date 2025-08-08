<!--
Programmer Name : Sim Tian (TP077056), Siew Zhen Lynn (TP076386)
Program Name    : DP.SP.PlansList.php
Description     : Show the list of saved diet plans
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
-->
<?php
session_start();
if (!isset($_SESSION['usr_user_id'])) {
    echo "<script>alert('Please login first.'); window.location.href = 'login.html';</script>";
    exit;
}

include("config.php");

$userId = $_SESSION['usr_user_id'];

if (isset($_SESSION['plan_deleted'])) {
    if ($_SESSION['plan_deleted']) {
        echo "<script>alert('Plan deleted successfully!');</script>";
    } else {
        echo "<script>alert('Failed to delete plan. Please try again.');</script>";
    }
    unset($_SESSION['plan_deleted']);
}

$stmt = $con->prepare("SELECT * FROM meal_plans WHERE mpl_user_id = ? ORDER BY mpl_created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$plans = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Plans - RunTime Fitness</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="DP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 200vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f4ec;
            color: #6a4819;
            line-height: 1.6;
            background-image: none;
            overflow-x: hidden;
            position: relative;
        }
        .main-content {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
        .page-title {
            text-align: center;
            margin-bottom: 40px;
            color: #6a4819; 
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .instructions-text {
            text-align: center;
            font-size: 1.2rem;
            color: #8c7851; 
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            padding-bottom: 30px;
            justify-items: center;
        }
        .plan-card {
            max-width: 420px;
            width: 100%;
            background: linear-gradient(145deg, #f7f3ea 60%, #e9e2d0 100%);
            border-radius: 28px;
            box-shadow: 8px 8px 24px #e0d6c2, -8px -8px 24px #fffbe6, 0 2px 8px 2px #e5dbc7 inset;
            border: 2.5px solid #e5dbc7;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: stretch;
            overflow: visible;
            position: relative;
            padding: 0 0 12px 0;
            transition: box-shadow 0.25s, transform 0.25s;
            min-height: 240px;
            max-height: 260px;
            height: 260px;
        }
        .plan-card > * {
            flex-shrink: 0;
        }
        .plans-grid {
            align-items: stretch;
        }
        .card-header {
            background: linear-gradient(90deg, #e9e2d0 60%, #f7f3ea 100%);
            border-radius: 22px 22px 18px 18px;
            box-shadow: 0 4px 12px #e5dbc7 inset, 0 2px 8px #fffbe6;
            margin: -18px 24px 0 24px;
            padding: 18px 24px 10px 24px;
            color: #8D7151;
            font-size: 1.18rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 2;
        }
        .card-title {
            margin: 0;
            font-size: 1.25rem;
            font-family: inherit;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #8D7151;
            text-shadow: 0 2px 4px #fffbe6;
        }
        .card-title i {
            color: #b38b4f;
            margin-right: 10px;
            filter: drop-shadow(0 1px 2px #fffbe6);
        }
        .card-body, .card-content {
            display: none;
        }
        .card-date {
            color: #b38b4f;
            font-size: 1.rem;
            font-style: italic;
        }
        .card-actions-inline {
            display: flex;
            gap: 16px;
            justify-content: flex-end;
            align-items: flex-end;
            margin: 0 24px 18px 24px;
            flex: 1 0 auto;
        }
        .btn-view-details,
        .btn-delete-plan {
            padding: 12px 18px;
            border-radius: 13px;
            text-decoration: none;
            font-size: 0.90rem;
            font-weight: 600;
            min-width: 140px;
            height: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: none;
            background: #8D7151;
            box-shadow: 0 4px 12px #e5dbc7 inset, 0 2px 8px #fffbe6;
            color: #fff;
        }
        .btn-view-details:hover,
        .btn-delete-plan:hover {
            background: #8D7151;
            color: #fff;
            box-shadow: 0 4px 12px #e5dbc7 inset, 0 2px 8px #fffbe6;
            transform: none;
        }
        @media (max-width: 768px) {
            .plans-grid {
                grid-template-columns: 1fr;
            }
            .page-title {
                font-size: 2rem;
            }
            .plan-card {
                min-height: 200px;
                max-height: 220px;
                height: 220px;
            }
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
            <a href="DP.MAIN.php">About Diet</a>
            <a href="DP.DF.Main.php">Diet Plans</a>
            <a href="DP.PS.Main.php">Personalized Diet Plan</a>
            <a href="DP.NT.Main.php">Nutrition Journal</a>
            <a href="DP.SP.PlansList.php" class="active">My Plans</a>
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
    <div class="main-content">
        <div class="container">
            <div class="page-title">
                <h1>MY SAVED PLANS</h1>
            </div>
        <?php if (count($plans) === 0): ?>
                <div class="instructions-text">You haven't saved any plans yet.</div>
        <?php else: ?>
                <div class="plans-grid">
                    <?php $planNumber = 1; ?>
                    <?php foreach ($plans as $plan): ?>
                        <div class="plan-card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Meal Plan <?= $planNumber++ ?></h3>
                            </div>
                            <p class="card-date" style="margin: 18px 24px 0 24px;">Created on: <?= date("d/m/Y, H:i:s", strtotime($plan['mpl_created_at'])) ?></p>
                            <div class="card-actions-inline">
                                <a href="DP.SP.ViewDetails.php?mpl_id=<?= $plan['mpl_id'] ?>" class="btn-view-details redesigned-view-btn"><i class="fas fa-eye"></i> View Details</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        <?php endif; ?>
        </div>
    </div>
    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved.</p>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set active navigation link based on current page
            const currentPage = window.location.pathname.split('/').pop();
            const navLinks = document.querySelectorAll('.nav-links a');
            
            navLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                if (linkHref === currentPage) {
                    link.classList.add('active');
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
        });
    </script>

</body>
</html>
