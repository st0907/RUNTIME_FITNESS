<!--Programmer Name: SERENE LOH ZI TING (TP075920)
Program Name: memberHomepage.php
Description: Homepage for member after login
First Written on: Wednesday, 19-June-2025
Edited on: 08-JULY-2025
-->

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUNTIME FITNESS - Member Dashboard</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="DP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f8f4ec;
            color: #333;
            line-height: 1.6;
        }

        header {
            display: flex;
            align-items: center;
            background-color: #fff;
            height: 85px;
            padding: 0 7% 0 3%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: relative;
            top: 0;
            z-index: 1000;
        }
        #navbar-img {
            flex: 1;
            display: flex;
            align-items: center;
            height: 70px;
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
            height: 70px;
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

        .hero {
            display: flex;
            justify-content: space-between;
            padding: 4rem 5%;
            gap: 3rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .hero-content {
            flex: 1 1 400px;
        }

        .hero-title {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-image {
            width: 100%;
            max-width: 500px;
            border-radius: 16px;
        }

        .section-title {
            text-align: center;
            margin-top: 4rem;
            font-size: 2rem;
            color: #4a3c2c;
        }

        .decorative-elements {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            overflow: hidden;
        }

        .decorative-elements img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 2rem 5%;
        }

        .feature-card {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .feature-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .feature-card h3{
            margin-bottom: 1rem;
            color: #8E735B;
        }

        .feature-card p{
            color: #666;
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: block;
            line-height: 1;
        }

        .features .feature-card,
        .features .feature-card *,
        .features .feature-card h3,
        .features .feature-card p,
        .features .feature-card a {
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <header>
        <div id="navbar-img">
            <img src="images/logo.gif" alt="RUNTIME FITNESS GIF">
        </div>
        <div class="nav-links">
            <a href="DP.indexMain.php">Diet Plans</a>
            <a href="W.main.php">Workout</a>
            <a href="tracking.php">Progress Tracking</a>
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

    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Welcome Back, Champion!</h1>
            <p class="hero-description">Your personalized dashboard is ready. Keep track of your progress, explore new plans, and stay on top of your goals. You're doing amazing - let's keep it going! Remember, every small step you take brings you closer to your best self—stay consistent and celebrate your journey!</p>
        </div>
        <div class="hero-image">
            <div class="decorative-elements">
                <img src="images/HERO_GIF.gif" alt="hero Gif">
            </div>
        </div>
    </section>

    <h2 class="section-title">Your Quick Access Tools</h2>
    <section class="features">
        <a class="feature-card" href="DP.MAIN.php" tabindex="0">
            <span class="feature-icon" aria-hidden="true">
                <!-- Diet SVG -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <ellipse cx="16" cy="16" rx="13" ry="10" fill="#fdf8f2" stroke="#8E735B" stroke-width="2"/>
                  <path d="M10 18c0-3 2-6 6-6s6 3 6 6" stroke="#8E735B" stroke-width="2" stroke-linecap="round"/>
                  <ellipse cx="16" cy="21" rx="6" ry="3" fill="#8E735B" fill-opacity="0.15"/>
                  <circle cx="13" cy="14" r="1" fill="#8E735B"/>
                  <circle cx="19" cy="14" r="1" fill="#8E735B"/>
                </svg>
            </span>
            <h3>Diet Plans</h3>
            <p>Review and adjust your current meal plan based on your dietary goals and preferences.</p>
        </a>
        <a class="feature-card" href="W.main.php" tabindex="0">
            <span class="feature-icon" aria-hidden="true">
                <!-- Workout SVG -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="7" y="14" width="18" height="4" rx="2" fill="#8E735B" fill-opacity="0.15"/>
                  <rect x="4" y="12" width="4" height="8" rx="2" fill="#8E735B"/>
                  <rect x="24" y="12" width="4" height="8" rx="2" fill="#8E735B"/>
                  <rect x="13" y="10" width="6" height="12" rx="3" fill="#8E735B"/>
                </svg>
            </span>
            <h3>Workout</h3>
            <p>Log today's workout or choose a new challenge from the workout library.</p>
        </a>
        <a class="feature-card" href="tracking.php" tabindex="0">
            <span class="feature-icon" aria-hidden="true">
                <!-- Progress SVG -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="6" y="20" width="4" height="6" rx="2" fill="#8E735B" fill-opacity="0.15"/>
                  <rect x="14" y="14" width="4" height="12" rx="2" fill="#8E735B"/>
                  <rect x="22" y="10" width="4" height="16" rx="2" fill="#8E735B"/>
                  <rect x="6" y="26" width="20" height="2" rx="1" fill="#8E735B"/>
                </svg>
            </span>
            <h3>Progress Tracking</h3>
            <p>Track your fitness journey and see your improvements over time.</p>
        </a>
        <a class="feature-card" href="community.php" tabindex="0">
            <span class="feature-icon" aria-hidden="true">
                <!-- Community SVG -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <ellipse cx="16" cy="16" rx="13" ry="10" fill="#fdf8f2" stroke="#8E735B" stroke-width="2"/>
                  <ellipse cx="16" cy="16" rx="7" ry="5" fill="#8E735B" fill-opacity="0.15"/>
                  <circle cx="12" cy="15" r="1.5" fill="#8E735B"/>
                  <circle cx="20" cy="15" r="1.5" fill="#8E735B"/>
                  <rect x="13.5" y="18" width="5" height="1.5" rx="0.75" fill="#8E735B"/>
                </svg>
            </span>
            <h3>Community</h3>
            <p>Join discussions, share achievements, and get tips from fellow fitness lovers.</p>
        </a>
    </section>

    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved.</p>
        </div>
    </footer>
<script>
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Fade-in observer setup
        const fadeElements = document.querySelectorAll('.fade-in');
        const fadeInObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    fadeInObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        fadeElements.forEach(el => fadeInObserver.observe(el));
        
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

    function selectDiet(el) {
        document.querySelectorAll('.diet-box').forEach(box => box.classList.remove('active'));
        el.classList.add('active');
    }
</script>
</body>
</html>
