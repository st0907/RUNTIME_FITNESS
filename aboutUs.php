<!--Programmer Name: SERENE LOH ZI TING (TP075920)
Program Name: aboutUs.php
Description: Introduce our website to user
First Written on: Wednesday, 6-June-2025
Edited on: 9-July-2025-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - RUNTIME FITNESS</title>
        <link rel="icon" href="images/logo.png">
    <style>
            *{
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            }
            
            body{
                background-color: #fdf8f2;
                color: #333;
                line-height: 1.6;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            html {
                height: 100%;
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

            /* Navigation Bar Styles */
            #navbar-img {
                flex: 1;
                display: flex;
                align-items: center;
                height: 70px;
            }
            #navbar-img img{
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

            .nav-links a.active::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: #8E735B;
            }

            .nav-links a:hover::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: #8E735B;
            }

            .navbar .get-started,
            .navbar .login {
                padding: 0.6rem 1.4rem;
                border-radius: 25px;
                font-weight: 600;
                border: none;
                cursor: pointer;
                transition: all 0.3 ease;
                transform-origin: center;
            }

            .navbar .get-started{
                background-color: #836953;
                color: white;
            }

            .navbar .get-started:hover {
                background-color: #a5836b;
                transform: scale(1.1);
                box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            }

            .navbar .login {
                background-color: transparent;
                color: #836953;
                border: 2px solid #836953;
            }

            .navbar .login:hover {
                background-color: #f7e7db;
                transform: scale(1.1);
                box-shadow:0 4px 10px rgba(0,0,0,0.1);
            }

            .nav-links a:hover::after {
                content:'';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: #8E735B;
            }

            .nav-buttons{
                display: flex;
                align-items: center;
                gap: 1rem;
            }

        
            button, .btn {
                transition: all 0.3s ease;
                transform-origin: center;
            }

        .about-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6rem 8%;
            background-color: #fef9f4;
            animation: fadeInUp 1.2s ease-in-out;
            flex-wrap: wrap;
            flex: 1;
        }

        .about-content {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 3rem;
        }

        .about-text {
            flex: 1;
            padding-right: 3rem;
            min-width: 280px;
            animation: fadeInUp 1.4s ease;
        }

        .about-text h2 {
            font-size: 2.4rem;
            margin-bottom: 1.2rem;
            color: #4a3c2c;
            animation: fadeInUp 1.6s ease;
        }

        .about-text p {
            font-size: 1.1rem;
            max-width: 600px;
            color: #333;
            line-height: 1.8;
            animation: fadeInUp 1.8s ease;
        }

        .about-image {
            flex: 1;
            text-align: center;
            min-width: 260px;
            animation: fadeInRight 1.6s ease;
        }

        @keyframes fadeInUp {
            from{
                opacity: 0;
                transform: translateY(30px);
            }
            to{
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .about-image img {
            max-width: 100%;
            width: 250px;
            transition: transform 0.6s ease;
        }

        .about-image img:hover {
            transform: scale(1.05) rotate(2deg);
        }

        footer {
            background-color: #f9f6f0;
            color: #8D7151;
            padding: 20px 0;
            margin-top: 60px;
            text-align: center;
            border-top: 1px solid #e5dbc7;
            margin-bottom: 0;
        }
        
        @media (max-width: 768px){
            .about-section{
                flex-direction: column;
                text-align: center;
                padding: 3rem 2rem;
            }

            .about-text {
                padding-right: 0;
            }

            .about-image {
                margin-top: 2rem;
            }
        }
    </style>
    <!-- Font Awesome for home icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div id="navbar-img">
            <a href="homepage.php" class="home-nav-item" title="BACK TO MAIN PAGE">
                <i class="fas fa-home"></i>
            </a>
        </div>
        <div class="nav-links">
            <a href="aboutUs.php" class="active">About Us</a>
            <a href="howItWorks.html">How it works</a>
            <a href="dietPlan.html">Diet Plans</a>
            <a href="workoutPlan.html">Workout Plans</a>
            <a href="contact.php">Contact</a>
        </div>
        <div class="navbar">
            <div class="nav-buttons">
                <a href="login.html">
                    <button class="login">Login</button>
                </a>
                <a href="register.php">
                    <button class="get-started">Get started for free</button>
                </a>
            </div>
        </div>
    </header>

    <section class="about-section" id="about">
        <div class="about-content">
            <div class="about-text">
            <h2>About Us</h2>
            <p>At RUNTIME FITNESS, we're more than just a workout website. 
            We're your partner in building sustainable fitness habits that feel right for your life. 
            Our team is made up of passionate trainers, developers, and wellness advocates who believe 
            in a balanced, science-backed approach to health.</p>
            </div>

            <div class="about-image">
            <img src="images/logo.png" alt="RUNTIME FITNESS Logo">
        </div>
        </div>
    </section>

    <footer>
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved</p>
        </div>
    </footer>
    
</body>
</html>
