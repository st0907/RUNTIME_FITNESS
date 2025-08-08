<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.MAIN.php
Description     : Nutrition Homepage
First Written on: Sunday, 15-June-2025
Edited on: 07-July-2025
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
    <title>Diet Plan - RunTime Fitness</title>
    <link rel="stylesheet" href="DP.css">
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #f8f4ec;
            background-image: none;
            color: #6a4819;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth; 
        }

        .container {
            max-width: 1200px;
            margin: 40px auto 0;
            padding: 0 20px;
            background: none;
        }

        /* Section A */
        .main-cta-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FAF8F2;
            padding: 100px 0;
            min-height: 600px;
            position: relative;
            overflow: hidden;
        }
        
        .main-cta-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #b38b4f 50%, transparent 100%);
            opacity: 0.8;
        }
        
        .main-cta-section::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #e5dbc7 50%, transparent 100%);
            opacity: 0.6;
        }
        
        .main-cta-content {
            flex: 1;
            padding-left: 100px;
            max-width: 580px;
            position: relative;
        }
        
        
        .main-cta-btns {
            display: flex;
            gap: 20px;
            margin-top: 40px;
        }
        
        .main-cta-btn-primary {
            background: linear-gradient(135deg, #8D7151 0%, #6a4819 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 16px 36px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.3px;
            box-shadow: 0 4px 12px rgba(141, 113, 81, 0.25);
            position: relative;
            overflow: hidden;
        }
        
        .main-cta-btn-primary::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }
        
        .main-cta-btn-primary:hover {
            background: linear-gradient(135deg, #6a4819 0%, #5a3c15 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(141, 113, 81, 0.35);
        }
        
        .main-cta-btn-primary:hover::before {
            left: 100%;
        }
        
        .main-cta-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding-right: 60px;
        }
        
        .main-cta-video-crop {
            width: 400px;
            height: 400px; 
            overflow: hidden;
            border-radius: 8px; 
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background: #f3ede3;
            border: 1px solid #e5dbc7;
            box-shadow: 0 20px 30px rgba(106, 72, 25, 0.1);
            position: relative;
            transform: rotate(-5deg);
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);            
        }

        .main-cta-video-crop:hover {
            transform: rotate(5deg);
        }
        
        .main-cta-video-crop::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 8px;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.2);
        }
        
        .main-cta-video-crop video {
            width: 400px;
            height: 400px;
            object-fit: cover;
        }

        @media (max-width: 1200px) {
            .main-cta-content {
                padding-left: 60px;
            }
            .main-cta-image {
                padding-right: 40px;
            }
        }
        
        @media (max-width: 1100px) {
            .main-cta-section { 
                flex-direction: column-reverse; 
                padding: 80px 40px;
                text-align: center;
                min-height: 680px;
            }
            .main-cta-content { 
                padding-left: 0; 
                margin-top: 60px;
                max-width: 100%;
            }
            .main-cta-image {
                padding-right: 0;
            }
        }
        
        @media (max-width: 768px) {
            .main-cta-section {
                padding: 60px 20px;
                min-height: 600px;
            }
            .main-cta-video-crop {
                width: 350px;
                height: 350px;
            }
            .main-cta-video-crop video { 
                width: 350px; 
                height: 350px; 
            }
        }
        
        @media (max-width: 480px) {

            .main-cta-video-crop {
                width: 300px;
                height: 300px;
            }
            .main-cta-video-crop video { 
                width: 300px; 
                height: 300px; 
            }
        }

        .second-section-placeholder {
            width: 100%;
            margin: 60px auto;
            padding: 40px 20px;
            min-height: 300px;
            border-radius: 15px;
            background-color: #f3ede3;
            border: 2px dashed #b38b4f;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #6a4819;
        }

        .placeholder-text {
            font-size: 1.8rem;
            font-weight: 500;
            opacity: 0.7;
            text-align: center;
        }
         
        /* Third Section */
        .third-section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 60px;
            color: #8D7151;
            margin-top: 80px;
            font-weight: 700;
            letter-spacing: 1px;
            position: relative;
        }
        
        .third-section-title::after {
            content: "";
            display: block;
            width: 80px;
            height: 3px;
            background-color: #b38b4f;
            margin: 15px auto 0;
        }

        .third-section-container {
            position: relative;
            width: 100%;
            padding: 40px 0 80px;
            overflow: visible;
            margin: 0;
            background: none;
        }

        .third-section-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            padding: 0;
            height: 560px;
            overflow: visible;
        }

        .third-section-features {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            height: 560px;
            width: 100%;
            padding: 0;
        }

        .third-section-feature {
            position: absolute;
            width: 360px;
            height: 480px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(141, 113, 81, 0.1);
            left: 50%;
            margin-left: -180px;
            transition: all 0.5s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Fixed positions */
        .third-section-feature.position-left {
            transform: scale(0.85) translateX(-450px);
            opacity: 0.7;
            z-index: 1;
        }

        .third-section-feature.position-middle {
            transform: scale(1) translateX(0);
            opacity: 1;
            z-index: 3;
            box-shadow: 0 15px 30px rgba(141, 113, 81, 0.15);
        }

        .third-section-feature.position-right {
            transform: scale(0.85) translateX(450px);
            opacity: 0.7;
            z-index: 1;
        }

        .third-section-feature-img {
            height: 180px;
            width: 100%;
            overflow: hidden;
            background: #f3ede3;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .third-section-feature-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .third-section-feature-content {
            padding: 30px 25px;
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .third-section-feature-title {
            font-size: 1.7rem;
            color: #8D7151;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .third-section-feature-desc {
            color: #6a4819;
            margin-bottom: auto;
            line-height: 1.6;
            font-size: 1rem;
            flex: 1;
        }

        .third-section-feature-btn {
            display: inline-block;
            padding: 13px 30px;
            background-color: #8D7151;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 25px;
            border: none;
            cursor: pointer;
        }

        .third-section-feature-btn:hover {
            background-color: #6a4819;
            transform: translateY(-2px);
        }
        
        /* Inactive cards */
        .third-section-feature:not(.position-middle) {
            cursor: pointer;
        }
        
        .third-section-feature:not(.position-middle) .third-section-feature-btn {
            opacity: 0.6;
            background-color: #b38b4f;
            pointer-events: none;
        }

        .third-section-feature.position-middle .third-section-feature-btn {
            opacity: 1;
            pointer-events: auto;
        }

        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #8D7151;
            font-size: 1.5rem;
            z-index: 100;
            box-shadow: 0 3px 10px rgba(141, 113, 81, 0.15);
            transition: all 0.3s ease;
            border: 1px solid rgba(141, 113, 81, 0.1);
        }

        .nav-arrow:hover {
            background-color: #fff;
            color: #8D7151;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 5px 15px rgba(141, 113, 81, 0.2);
        }

        .prev-arrow {
            left: -25px;
        }

        .next-arrow {
            right: -25px;
        }

        footer {
            margin-top: 80px;
            padding: 40px 0;
            text-align: center;
            border-top: 1px solid #b38b4f;
            background-color: #8D7151;
            color: #fff;
        }

        .copyright {
            color: #fff;
            font-size: 0.9rem;
        }

        footer a {
            color: #fff;
        }

        footer a:hover {
            color: #b38b4f;
        }

        @media (max-width: 768px) {
            .third-section-features {
                flex-direction: column;
            }
            
            .third-section-feature {
                min-width: 100%;
            }
            
            .slide-title {
                font-size: 1.5rem;
            }
            
            .slide-desc {
                font-size: 1rem;
            }
        }

        /* Second Section */
        .second-section {
            width: 100vw;
            margin: 0;
            padding: 0;
            display: flex;
            overflow: hidden;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            height: 250px;
            margin-top: 50px;
        }

        .second-section-strip {
            display: flex;
            width: 100%;
        }

        .second-section-img {
            flex: 1;
            height: 240px; 
            overflow: hidden;
        }

        .second-section-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        @media (max-width: 768px) {
            .second-section-strip {
                flex-wrap: wrap;
            }
            
            .second-section-img {
                flex: 1 1 50%;
                height: 150px;
            }
        }

        @media (max-width: 480px) {
            .second-section-img {
                flex: 1 1 100%;
                height: 150px;
            }
        }

        /* Animation - video transition */
        .animated-entry {
            opacity: 0;
        }
        
        .transition-video-container {
            position: fixed;
            z-index: 1000;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5dbc7;
            box-shadow: 0 20px 30px rgba(106, 72, 25, 0.1);
            transition: all 1.2s cubic-bezier(0.22, 1, 0.36, 1);
        }
        
        .transition-video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .main-cta-section.animated .main-cta-content {
            animation: slideInFromLeft 1.2s forwards 0.7s;
            opacity: 0;
        }
        
        @keyframes slideInFromLeft {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .main-cta-video-crop.animated {
            opacity: 0;
        }

        /* Nutrition Tips Section */
        .section-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #b38b4f, transparent);
            margin: 80px auto 40px;
            width: 80%;
        }

        .nutrition-tips-container {
            max-width: 800px;
            margin: 0 auto;
            height: 300px;
            min-height: 400px;
            position: relative;
            padding: 20px 0 60px;
        }

        .tips-carousel {
            position: relative;
            width: 550px;
            height: 300px;
            margin-left: -70px;
            overflow: hidden;
        }

        .tip-card {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(141, 113, 81, 0.1);
            padding: 30px;
            text-align: center;
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.5s ease;
            visibility: hidden;
            border: 1px solid rgba(179, 139, 79, 0.1);
        }

        .tip-card.active {
            opacity: 1;
            transform: translateX(0);
            visibility: visible;
        }

        .tip-icon {
            width: 70px;
            height: 70px;
            background-color: #f3ede3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #8D7151;
            font-size: 28px;
        }

        .tip-title {
            font-size: 1.5rem;
            color: #8D7151;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .tip-content {
            color: #6a4819;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        .carousel-nav {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 10px;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #e5dbc7;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background-color: #8D7151;
            transform: scale(1.2);
        }

        .carousel-arrows {
            position: absolute;
            width: 160%;
            top: 40%; 
            left: -132px;
            display: flex;
            justify-content: space-between;
            padding: 0 -110px; 
            pointer-events: none;
        }

        .carousel-arrow {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(141, 113, 81, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #8D7151;
            box-shadow: 0 3px 10px rgba(141, 113, 81, 0.15);
            transition: all 0.3s ease;
            pointer-events: auto;
        }

        .carousel-arrow:hover {
            background-color: #fff;
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(141, 113, 81, 0.2);
        }

        @media (max-width: 768px) {
            .nutrition-tips-container {
                padding: 50px 15px 60px;
            }
            
            .tip-card {
                padding: 20px 15px;
            }
            
            .tip-icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
            
            .tip-title {
                font-size: 1.3rem;
            }
            
            .tip-content {
                font-size: 1rem;
            }
            
            .carousel-arrows {
                padding: 0 5px;
            }
        }
        .main-cta-flex-row {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            width: 100%;
            gap: 48px;
        }
        .main-cta-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .main-cta-right {
            flex: 1;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
        }
        .nutrition-tips-container {
            max-width: 420px;
            min-width: 320px;
            width: 100%;
        }
        @media (max-width: 1100px) {
            .main-cta-flex-row {
                flex-direction: column;
                align-items: center;
                gap: 32px;
            }
            .main-cta-right {
                justify-content: center;
                width: 100%;
            }
            .nutrition-tips-container {
                max-width: 100%;
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
            <a href="DP.MAIN.php" class="active">About Diet</a>
            <a href="DP.DF.Main.php">Diet Plans</a>
            <a href="DP.PS.Main.php">Personalized Diet Plan</a>
            <a href="DP.NT.Main.php">Nutrition Journal</a>
            <a href="DP.SP.PlansList.php">My Plans</a>
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
    
    <div class="main-cta-section" style="background: none; border: none; box-shadow: none; min-height: 520px; padding-left: 90px; padding-right: 40px; position: relative; overflow: visible;">
        <div class="main-cta-flex-row">
            <div class="main-cta-left">
                <div class="main-cta-image" style="position: relative; display: flex; justify-content: center; align-items: center; margin-top: -35px;">
                    <div class="main-cta-video-crop" style="position: relative; z-index: 1; border-radius: 32px; box-shadow: 0 8px 40px 0 rgba(106,72,25,0.10); overflow: visible; transform: rotate(-5deg); transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);" onmouseover="this.style.transform='rotate(5deg)'" onmouseout="this.style.transform='rotate(-5deg)'">
                        <video id="main-video" width="420" height="420" autoplay loop muted playsinline style="border-radius: 32px; background: #fff; display: block;">
                            <source src="images/DP.MainSecA.salad.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <!-- Nutritionist & Bubble Floating Bottom Right -->
                        <div class="nutritionist-section" style="position: absolute; right: -32px; bottom: -30px; display: flex; align-items: center; gap: 10px; z-index: 0;">
                            <div class="nutritionist-avatar" style="width: 64px; height: 64px; border-radius: 50%; overflow: hidden; background: #fff; box-shadow: 0 2px 8px rgba(106,72,25,0.10); flex-shrink: 0; border: 4px solid #fff;">
                                <img src="images/nutri.png" alt="Happy User" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            </div>
                            <div class="nutritionist-bubble" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(106,72,25,0.10); padding: 12px 18px; font-size: 1.08rem; position: relative; color: #8D7151; font-style: italic; white-space: nowrap;">
                                Let's get started!
                                <span style="position: absolute; left: -18px; bottom: 16px; width: 0; height: 0; border-top: 12px solid transparent; border-bottom: 12px solid transparent; border-right: 18px solid #fff;"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 48px; text-align: center; width: 100%;">
                    <button id="explore-btn" class="main-cta-btn-primary" style="min-width: 180px; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(106,72,25,0.10);">Explore Plans</button>
                </div>
            </div>
            <div class="main-cta-right">
                <div class="nutrition-tips-container">
                    <div class="tips-carousel">
                        <div class="tip-card active">
                            <div class="tip-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3 class="tip-title">Quick Facts</h3>
                            <p class="tip-content">Consuming a variety of colorful fruits and vegetables ensures you get a wide range of essential nutrients and antioxidants.</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">
                                <i class="fas fa-apple-alt"></i>
                            </div>
                            <h3 class="tip-title">Healthy Habits</h3>
                            <p class="tip-content">Eating slowly and mindfully can help you enjoy your food more and may help prevent overeating.</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">
                                <i class="fas fa-tint"></i>
                            </div>
                            <h3 class="tip-title">Hydration</h3>
                            <p class="tip-content">Drinking adequate water throughout the day helps maintain energy levels and supports overall health and digestion.</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">
                                <i class="fas fa-carrot"></i>
                            </div>
                            <h3 class="tip-title">Balanced Diet</h3>
                            <p class="tip-content">Include a source of protein, healthy fat, and complex carbohydrates in each meal for sustained energy.</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h3 class="tip-title">Heart Health</h3>
                            <p class="tip-content">Omega-3 fatty acids found in fish, walnuts, and flaxseeds can help support heart health and reduce inflammation.</p>
                        </div>
                    </div>
                    <div class="carousel-nav">
                        <button class="carousel-dot active" data-index="0"></button>
                        <button class="carousel-dot" data-index="1"></button>
                        <button class="carousel-dot" data-index="2"></button>
                        <button class="carousel-dot" data-index="3"></button>
                        <button class="carousel-dot" data-index="4"></button>
                    </div>
                    <div class="carousel-arrows">
                        <button class="carousel-arrow prev"><i class="fas fa-chevron-left"></i></button>
                        <button class="carousel-arrow next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Second Section (formerly Third Section) -->
        <h2 class="third-section-title" id="nutrition-goals">Choose Your Nutrition Goals</h2>
        <div class="third-section-container">
            <div class="third-section-wrapper">
                <div class="nav-arrow prev-arrow"><i class="fas fa-chevron-left"></i></div>
                <div class="nav-arrow next-arrow"><i class="fas fa-chevron-right"></i></div>
                
                <div class="third-section-features">
                    <div class="third-section-feature position-left" data-index="0">
                        <div class="third-section-feature-img">
                            <img src="images/DP.DF.5.jpg" alt="Diet Plans">
                        </div>
                        <div class="third-section-feature-content">
                            <h3 class="third-section-feature-title">Diet Plans</h3>
                            <p class="third-section-feature-desc">Choose from a variety of pre-designed meal plans including Keto, Mediterranean, Vegan, and more. Each plan is nutritionally balanced for optimal health.</p>
                            <a href="DP.DF.Main.php" class="third-section-feature-btn">Explore Plans</a>
                        </div>
                    </div>
                    
                    <div class="third-section-feature position-middle" data-index="1">
                        <div class="third-section-feature-img">
                            <img src="images/DP.PS.4.jpg" alt="Personalized Diet Plan">
                        </div>
                        <div class="third-section-feature-content">
                            <h3 class="third-section-feature-title">Personalized Diet Plan</h3>
                            <p class="third-section-feature-desc">Get a custom meal plan based on your body metrics, goals, and dietary preferences. Our algorithm creates the perfect plan just for you.</p>
                            <a href="DP.PS.Main.php" class="third-section-feature-btn">Create My Plan</a>
                        </div>
                    </div>
                    
                    <div class="third-section-feature position-right" data-index="2">
                        <div class="third-section-feature-img">
                            <img src="images/DP.PS.3.jpg" alt="Nutrition Journal">
                        </div>
                        <div class="third-section-feature-content">
                            <h3 class="third-section-feature-title">Nutrition Journal</h3>
                            <p class="third-section-feature-desc">Track your daily food intake, monitor nutrients, and gain insights into your eating habits. Make smarter choices with data-driven feedback.</p>
                            <a href="DP.NT.Main.php" class="third-section-feature-btn">Start Tracking</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get reference to the main video element
            const mainVideo = document.getElementById('main-video');
            
            // Check if we came from splash page with transition animation
            const splashVideoPlayed = sessionStorage.getItem('splashVideoPlayed');
            const transitionAnimation = sessionStorage.getItem('transitionAnimation');
            const splashVideoTime = parseFloat(sessionStorage.getItem('videoTime') || '0');
            
            // Implement animation transition
            if (splashVideoPlayed === 'true' && transitionAnimation === 'true') {
                // Get stored dimensions and position
                const top = parseFloat(sessionStorage.getItem('splashVideoTop') || '0');
                const left = parseFloat(sessionStorage.getItem('splashVideoLeft') || '0');
                const width = parseFloat(sessionStorage.getItem('splashVideoWidth') || '500');
                const height = parseFloat(sessionStorage.getItem('splashVideoHeight') || '500');
                
                // Create a temporary video element for the transition
                const transContainer = document.createElement('div');
                transContainer.className = 'transition-video-container';
                transContainer.style.top = top + 'px';
                transContainer.style.left = left + 'px';
                transContainer.style.width = width + 'px';
                transContainer.style.height = height + 'px';
                
                const transVideo = document.createElement('video');
                transVideo.autoplay = true;
                transVideo.muted = true;
                transVideo.loop = true;
                transVideo.playsInline = true;
                
                const source = document.createElement('source');
                source.src = 'images/DP.MainSecA.salad.mp4';
                source.type = 'video/mp4';
                
                transVideo.appendChild(source);
                transContainer.appendChild(transVideo);
                document.body.appendChild(transContainer);
                
                // Hide the main content initially
                const mainCTASection = document.querySelector('.main-cta-section');
                const mainCTAContent = document.querySelector('.main-cta-content');
                const mainVideoCrop = document.querySelector('.main-cta-video-crop');
                
                mainCTASection.classList.add('animated');
                mainVideoCrop.classList.add('animated');
                
                // Set the video time to match the splash video
                transVideo.addEventListener('loadedmetadata', function() {
                    // Set current time to match splash video
                    if (splashVideoTime > 0) {
                        transVideo.currentTime = splashVideoTime;
                    }
                    
                    // Start animation after a short delay
                    setTimeout(function() {
                        // Get the target position
                        const targetElem = document.querySelector('.main-cta-video-crop');
                        const targetRect = targetElem.getBoundingClientRect();
                        
                        // Animate to the target position
                        transContainer.style.top = targetRect.top + 'px';
                        transContainer.style.left = targetRect.left + 'px';
                        transContainer.style.width = targetRect.width + 'px';
                        transContainer.style.height = targetRect.height + 'px';
                        
                        // Remove the transition element after animation completes
                        setTimeout(function() {
                            mainVideoCrop.style.opacity = '1';
                            
                            // Transfer the time to the main video
                            mainVideo.currentTime = transVideo.currentTime;
                            
                            // Remove the transition video
                            setTimeout(function() {
                                transContainer.remove();
                                
                                // Clear storage
                                sessionStorage.removeItem('transitionAnimation');
                                sessionStorage.removeItem('splashVideoTop');
                                sessionStorage.removeItem('splashVideoLeft');
                                sessionStorage.removeItem('splashVideoWidth');
                                sessionStorage.removeItem('splashVideoHeight');
                            }, 200);
                        }, 1200);
                    }, 300);
                });
            }
            
            // scrolling for Explore Now button (sectionA)
            const exploreBtn = document.getElementById('explore-btn');
            if (exploreBtn) {
                exploreBtn.addEventListener('click', function() {
                    const featuresSection = document.getElementById('nutrition-goals');
                    if (featuresSection) {
                        const headerOffset = 15; 
                        const targetPosition = featuresSection.getBoundingClientRect().top + window.pageYOffset - headerOffset;
                        const startPosition = window.pageYOffset;
                        const distance = targetPosition - startPosition;
                        const duration = 1500; 
                        let start = null;

                        function animation(currentTime) {
                            if (start === null) start = currentTime;
                            const timeElapsed = currentTime - start;
                            const progress = Math.min(timeElapsed / duration, 1);
                            
                            // Easing function for smooth acceleration and deceleration
                            const easeInOutCubic = progress => {
                                return progress < 0.5
                                    ? 4 * progress * progress * progress
                                    : 1 - Math.pow(-2 * progress + 2, 3) / 2;
                            };

                            window.scrollTo(0, startPosition + (distance * easeInOutCubic(progress)));

                            if (timeElapsed < duration) {
                                requestAnimationFrame(animation);
                            }
                        }

                        requestAnimationFrame(animation);
                    }
                });
            }
            
            // Features carousel functionality
            const features = document.querySelectorAll('.third-section-feature');
            const prevArrow = document.querySelector('.prev-arrow');
            const nextArrow = document.querySelector('.next-arrow');
            
            // Store indexes for tracking position
            let leftIndex = 0;
            let middleIndex = 1;
            let rightIndex = 2;
            
            // Set up card data and positions
            const cardsData = [
                {
                    title: "Diet Plans",
                    description: "Choose from a variety of pre-designed meal plans including Keto, Mediterranean, Vegan, and more. Each plan is nutritionally balanced for optimal health.",
                    buttonText: "Explore Plans",
                    buttonLink: "DP.DF.Main.php"
                },
                {
                    title: "Personalized Diet Plan",
                    description: "Get a custom meal plan based on your body metrics, goals, and dietary preferences. Our algorithm creates the perfect plan just for you.",
                    buttonText: "Create My Plan",
                    buttonLink: "DP.PS.Main.php"
                },
                {
                    title: "Nutrition Journal",
                    description: "Track your daily food intake, monitor nutrients, and gain insights into your eating habits. Make smarter choices with data-driven feedback.",
                    buttonText: "Start Tracking",
                    buttonLink: "DP.NT.Main.php"
                }
            ];
            
            // Function to update the card content and position
            function updateCardState() {
                features.forEach((card, index) => {
                    // Remove all position classes
                    card.classList.remove('position-left', 'position-middle', 'position-right');
                    
                    // Add appropriate position class
                    if (index === leftIndex) {
                        card.classList.add('position-left');
                    } else if (index === middleIndex) {
                        card.classList.add('position-middle');
                    } else if (index === rightIndex) {
                        card.classList.add('position-right');
                    }
                    
                    // Update content based on data index
                    const cardData = cardsData[index];
                    card.querySelector('.third-section-feature-title').textContent = cardData.title;
                    card.querySelector('.third-section-feature-desc').textContent = cardData.description;
                    
                    const button = card.querySelector('.third-section-feature-btn');
                    button.textContent = cardData.buttonText;
                    button.href = cardData.buttonLink;
                });
            }
            
            // Function to rotate cards to the right
            function rotateRight() {
                // Disable buttons during transition
                nextArrow.style.pointerEvents = 'none';
                prevArrow.style.pointerEvents = 'none';
                
                // Update indexes (rotating right)
                leftIndex = (leftIndex + 2) % 3;
                middleIndex = (middleIndex + 2) % 3;
                rightIndex = (rightIndex + 2) % 3;
                
                // Update the card positions and content
                updateCardState();
                
                // Re-enable buttons after transition
                setTimeout(() => {
                    nextArrow.style.pointerEvents = 'auto';
                    prevArrow.style.pointerEvents = 'auto';
                }, 500);
            }
            
            // Function to rotate cards to the left
            function rotateLeft() {
                // Disable buttons during transition
                nextArrow.style.pointerEvents = 'none';
                prevArrow.style.pointerEvents = 'none';
                
                // Update indexes (rotating left)
                leftIndex = (leftIndex + 1) % 3;
                middleIndex = (middleIndex + 1) % 3;
                rightIndex = (rightIndex + 1) % 3;
                
                // Update the card positions and content
                updateCardState();
                
                // Re-enable buttons after transition
                setTimeout(() => {
                    nextArrow.style.pointerEvents = 'auto';
                    prevArrow.style.pointerEvents = 'auto';
                }, 500);
            }
            
            // Add event listeners for arrow buttons
            prevArrow.addEventListener('click', function(e) {
                e.preventDefault();
                rotateLeft();
            });
            
            nextArrow.addEventListener('click', function(e) {
                e.preventDefault();
                rotateRight();
            });
            
            // Make the side cards clickable to move them to center
            features.forEach((card, index) => {
                card.addEventListener('click', function(e) {
                    // Only handle clicks on the card itself, not on buttons
                    if (e.target.closest('.third-section-feature-btn')) {
                        return;
                    }
                    
                    if (index === leftIndex) {
                        rotateLeft();
                    } else if (index === rightIndex) {
                        rotateRight();
                    }
                });
            });
            
            // Initialize the cards
            updateCardState();
            
            // Prevent clicking on inactive card buttons
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.third-section-feature-btn');
                if (!btn) return;
                
                const card = btn.closest('.third-section-feature');
                if (!card || !card.classList.contains('position-middle')) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
            }, true);

            // Add new script for nutrition tips carousel
            const tipCards = document.querySelectorAll('.tip-card');
            const dots = document.querySelectorAll('.carousel-dot');
            const prevArrowTips = document.querySelector('.carousel-arrows .prev');
            const nextArrowTips = document.querySelector('.carousel-arrows .next');
            let currentTipIndex = 0;
            
            // Function to show a specific tip
            function showTip(index) {
                // Hide all tips
                tipCards.forEach(card => {
                    card.classList.remove('active');
                });
                
                // Remove active class from all dots
                dots.forEach(dot => {
                    dot.classList.remove('active');
                });
                
                // Show the selected tip
                tipCards[index].classList.add('active');
                dots[index].classList.add('active');
                currentTipIndex = index;
            }
            
            // Add click event listeners to dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showTip(index);
                });
            });
            
            // Add click event listeners to arrows
            prevArrowTips.addEventListener('click', () => {
                let newIndex = currentTipIndex - 1;
                if (newIndex < 0) newIndex = tipCards.length - 1;
                showTip(newIndex);
            });
            
            nextArrowTips.addEventListener('click', () => {
                let newIndex = currentTipIndex + 1;
                if (newIndex >= tipCards.length) newIndex = 0;
                showTip(newIndex);
            });
            
            // Auto-rotate tips every 6 seconds
            setInterval(() => {
                let newIndex = currentTipIndex + 1;
                if (newIndex >= tipCards.length) newIndex = 0;
                showTip(newIndex);
            }, 6000);

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
