<!--Programmer Name: SERENE LOH ZI TING (TP075920)
Program Name: homepage.php
Description: Homepage for user preview
First Written on: Wednesday, 6-June-2025
Edited on: 9-July-2025-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUNTIME FITNESS</title>
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

            button, .btn {
                transition: all 0.3s ease;
                transform-origin: center;
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

        .hero {
            display: flex;
            justify-content: space-between;
            padding: 4rem 5%;
            gap: 3rem;
            align-items: center;
            flex-wrap: wrap ;
        }

        .hero-content {
            flex: 1 1 400px;
        }

        .hero-title {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-description {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 2rem;
        }

        .hero-image{
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

        .feature-card h3 {
            margin-bottom: 1rem;
            color: #8E735B;
        }

        .feature-card p{
            color: #666;
        }

        .feature-preview {
            display: none;
            padding: 1rem;
            margin-top: 1rem;
            background-color: #f9f3ec;
            border-radius: 10px;
            font-size: 0.9rem;
        }

    </style>
</head>
<body>
    <header>
        <div id="navbar-img">
            <img src="images/logo.gif" alt="RUNTIME FITNESS GIF">
        </div>
            <div class="nav-links">
                <a href="aboutUs.php">About Us</a>
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

    <section class="hero">
         <div class="hero-content">
        <h1 class="hero-title">Chill Your Way to Fitness with RUNTIME FITNESS!</h1>
        <p class="hero-description">Welcome to a new kind of workout experience—one that's effective, fun, and stress-free. At RUNTIME FITNESS, 
            we combine smart training with a relaxed atmosphere so you can build strength, boost energy, and stay consistent 
            without burning out. From quick workouts to recovery sessions, everything's designed 
            to fit your lifestyle. Fitness doesn't have to be intense to work—just consistent, cool, and made for you.</p>
        <div class="navbar">
            <div class="nav-buttons">
                <a href="register.php">
                    <button class="get-started">Get started for free</button>
                </a>
            </div>
        </div>
    </div>

        </div>
        <div class="hero-image">
            <div class="decorative-elements">
                <img src="images/HERO_GIF.gif" alt="Hero Gif">
            </div>
        </div>
    </section>

    <h2 class="section-title">Explore Our Features</h2>
    <section class="features">
        <div class="feature-card" onclick="handleFeatureClick('Smart Workout Plans')">
            <span class="feature-icon" aria-hidden="true">
                <!-- Workout SVG -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="7" y="14" width="18" height="4" rx="2" fill="#8E735B" fill-opacity="0.15"/>
                  <rect x="4" y="12" width="4" height="8" rx="2" fill="#8E735B"/>
                  <rect x="24" y="12" width="4" height="8" rx="2" fill="#8E735B"/>
                  <rect x="13" y="10" width="6" height="12" rx="3" fill="#8E735B"/>
                </svg>
            </span>
            <h3>Smart Workout Plans</h3>
            <p>Tailored routines for strength, cardio, flexibility, and recovery — built to match your fitness level and time.</p>
            <div class="feature-preview">Preview a smart plan suited for busy professionals and beginners. <br><em>Click again to sign up & unlock more!</em></div>
        </div>
        <div class="feature-card" onclick="handleFeatureClick('Diet Matching')">
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
            <h3>Diet Matching</h3>
            <p>Choose your preference — Anything, Vegetarian, Keto, or Vegan. Set calories and meal count for an instant plan.</p>
            <div class="feature-preview">Create your personalized diet meal today!<br><em>Click again to unlock your custom diet!</em></div>
        </div>
        <div class="feature-card" onclick="handleFeatureClick('Progress Tracker')">
            <span class="feature-icon" aria-hidden="true">
                <!-- Progress SVG -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="6" y="20" width="4" height="6" rx="2" fill="#8E735B" fill-opacity="0.15"/>
                  <rect x="14" y="14" width="4" height="12" rx="2" fill="#8E735B"/>
                  <rect x="22" y="10" width="4" height="16" rx="2" fill="#8E735B"/>
                  <rect x="6" y="26" width="20" height="2" rx="1" fill="#8E735B"/>
                </svg>
            </span>
            <h3>Progress Tracker</h3>
            <p>Track weight, sleep, water, and body measurements. See your journey in beautiful, simple charts.</p>
            <div class="feature-preview">Visualize your progress and set weekly goals easily. <br><em>Sign in to save your stats!</em></div>
        </div>
        <div class="feature-card" onclick="handleFeatureClick('Weekly Reports')">
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
            <h3>Weekly Reports</h3>
            <p>Stay motivated with weekly summaries and gentle tips to improve your wellness habits consistently.</p>
            <div class="feature-preview">Preview a sample wellness report. <br><em>Create an account to see your own!</em></div>
        </div>
    </section>

    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved</p>
        </div>
    </footer>

     <script>
        function handleFeatureClick(title) {
            const cards = document.querySelectorAll('.feature-card');
            cards.forEach(card => {
                const preview = card.querySelector('.feature-preview');
                if (card.querySelector('h3').textContent === title) {
                    if (preview.style.display === 'block') {
                        window.location.href = 'register.php';
                    } else {
                        preview.style.display = 'block';
                    }
                } else {
                    card.querySelector('.feature-preview').style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
