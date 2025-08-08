<!--Programmer Name: SERENE LOH ZI TING (TP075920)
Program Name: contact.php
Description: show contact page to user
First Written on: Wednesday, 6-June-2025
Edited on: 9-July-2025-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - RUNTIME FITNESS</title>
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
                animation: pageFade 0.6s ease-in;
            }

            @keyframes pageFade {
                from { opacity: 0; }
                to { opacity: 1; }
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
            }

            #navbar-img img{
                height: 70px;
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

            button, .btn {
                transition: all 0.3s ease;
                transform-origin: center;
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

            .contact-text{
                padding: 2em 2em;
                text-align: center;
                background-color: #fffaf3;
                animation: fadeInsection 1s ease;
            }

            @keyframes fadeInSection {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

            .contact-text h1{
                font-size: 2em;
                margin-bottom: 3rem;
                animation: slideIn 1s ease-out;
            }

            @keyframes slideIn {
            from { transform: translateX(-50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

            .contact-text p{
                font-size: 1.1em;
                margin: 0.5rem 0; 
                animation: fadeInText 1.5s ease;
            }

            @keyframes fadeInText {
            from { opacity: 0; }
            to { opacity: 1; }
        }

            .contact-text a{
                color: #0000ee;
                text-decoration: underline;
            }

            .footer {
                background-color: #f8f5f0;
                text-align: center;
                padding: 2em 0;
                border-top: 1px solid #ddd;
            }

            .footer .social-media{
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px;
                flex-wrap: wrap;
                padding-top: 1rem;
            }

            .footer .social-media a{
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                overflow: hidden;
            }

            .footer .social-media img {
                width: 30px;
                height: 30px;
                transition: transform 0.2s ease;
                object-fit: contain;
            }

            .footer .social-media img:hover {
                transform: scale(1.1);
            }

            .contact-image img {
                width: 600px;
                height: auto;
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
            <a href="aboutUs.php">About Us</a>
            <a href="howItWorks.html">How it works</a>
            <a href="dietPlan.html">Diet Plans</a>
            <a href="workoutPlan.html">Workout Plans</a>
            <a href="contact.php" class="active">Contact</a>
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
    <section class="contact-text">
        <div class="contact-image">
            <img src="images/contact.png" alt="Contact image">
        </div>
        <h1>Contact Us</h1>
        <div class="contact-content">
        <p>Have any questions or need support? We're here to help!</p>
        <p>Email us at: <a href="mailto:support@runtimefitness.com">support@runtimefitness.com</a></p>
        </div>
        <p>Follow us on social media for updates and tips.</p>
    </section>
    <footer class="footer">
        <div style="max-width: 1200px; margin: 0 auto;">
        <div class="social-media">
            <a href="#" target="_blank" aria-label="Instagram">
                <img src="images/instagram.png" alt="Instagram">
            </a>
            <a href="https://www.facebook.com/profile.php?id=61562113993601" target="_blank" aria-label="Facebook">
                <img src="images/facebook.png" alt="Facebook">
            </a>
            <a href="#" target="_blank" aria-label="Twitter">
                <img src="images/twitter.png" alt="Twitter">
            </a>
        </div>
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved</p>
        </div>
    </footer>
</body>
</html>
