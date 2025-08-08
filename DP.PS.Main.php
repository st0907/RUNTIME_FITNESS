<!--
Programmer Name : Siew Zhen Lynn (TP076386)
Program Name    : DP.PS.Main.php
Description     : Personalized Diet Plan - Brief Information about Personalized Diet Plan (Javascript)
First Written on: Sunday, 15-June-2025
Edited on: 05-July-2025
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
    <title>Personalized Diet Plan - RunTime Fitness</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="DP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="DP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&family=Segoe+UI&display=swap" rel="stylesheet">
    <style>
        /* Diet Types Section */
        .diet-types-section {
            margin: 80px 0;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .section-title h2 {
            display: inline-block;
            font-family: 'VT323', monospace;
            font-size: 2rem;
            color: #6a4819;
            padding: 10px 20px;
            position: relative;
            z-index: 2;
        }

        .section-title::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: rgba(106, 72, 25, 0.2);
            z-index: 1;
        }

        .section-title h2::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f8f4ec;
            z-index: -1;
        }

        .diet-types-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        /* Diet Type Card */
        .diet-type-card {
            width: 300px;
            background-color: #ffffff;
            border: 2px solid #e6dfd1;
            border-radius: 15px;
            padding: 0;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(106, 72, 25, 0.08);
        }

        .diet-type-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(to right, #8D7151, #b38b4f);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .diet-type-card:hover {
            transform: translateY(-5px);
            border-color: #b38b4f;
            box-shadow: 0 10px 20px rgba(106, 72, 25, 0.15);
        }

        .diet-type-card:hover::before {
            opacity: 1;
        }

        .diet-type-card.active {
            border-color: #b38b4f;
            background-color: rgba(179, 139, 79, 0.05);
            box-shadow: 0 10px 25px rgba(106, 72, 25, 0.2);
        }

        .diet-type-card.active::before {
            opacity: 1;
        }

        .card-header {
            background-color: transparent;
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px dashed #e6dfd1;
            position: relative;
            transition: all 0.3s ease;
        }

        .card-header.active {
            background-color: rgba(248, 244, 236, 0.5);
            border-bottom: 1px dashed #b38b4f;
        }

        .diet-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
            border: 2px solid #b38b4f;
            border-radius: 50%;
            color: #8D7151;
            background-color: #f9f6f0;
        }

        .diet-title {
            flex-grow: 1;
            font-family: 'VT323', monospace;
            font-size: 1.6rem;
            color: #6a4819;
            letter-spacing: 1px;
        }

        .expand-icon {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #8D7151;
            transition: transform 0.3s ease;
        }

        .expand-icon.active {
            transform: rotate(180deg);
        }

        .card-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
            background-color: #fff;
        }

        .card-body.active {
            max-height: 300px;
        }

        .card-content {
            padding: 20px;
            color: #6a4819;
        }

        .card-content p {
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: 1rem;
        }

        .features-list {
            list-style: none;
        }

        .features-list li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .features-list li i {
            color: #8D7151;
            margin-right: 10px;
        }

        /* Consultation Process Section */
        .consultation-process {
            margin: 70px 0;
            position: relative;
        }
        
        .process-steps {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }
        
        .process-step {
            flex: 1;
            min-width: 250px;
            max-width: 350px;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(106, 72, 25, 0.08);
            transition: all 0.3s ease;
            position: relative;
            border: 2px solid #e6dfd1;
        }
        
        .process-step:hover {
            transform: none;
            box-shadow: 0 5px 15px rgba(106, 72, 25, 0.08);
            border-color: #e6dfd1;
        }
        
        .step-number {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background-color: #8D7151;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            border: 2px solid #fff;
        }
        
        .step-icon {
            font-size: 2.5rem;
            color: #b38b4f;
            margin-bottom: 20px;
        }
        
        .step-title {
            font-family: 'VT323', monospace;
            font-size: 1.5rem;
            color: #6a4819;
            margin-bottom: 15px;
        }
        
        .step-description {
            color: #8c7851;
            line-height: 1.6;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .diet-types-container {
                flex-direction: column;
                align-items: center;
            }

            .diet-type-card {
                width: 100%;
                max-width: 350px;
            }
            
            .process-step {
                min-width: 100%;
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
            <a href="DP.PS.Main.php" class="active">Personalized Diet Plan</a>
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

    <div class="container">
        <div class="page-title">
            <h1>PERSONALIZED DIET PLAN</h1>
        </div>
        
        <!-- Move nutritionist section here, right after the title -->
        <div class="nutritionist-section" style="display: flex; align-items: center; gap: 18px; margin: 20px auto 40px; max-width: 800px;">
            <div class="nutritionist-avatar" style="width: 110px; height: 110px; border-radius: 18px; overflow: hidden; background: #fff; box-shadow: 0 2px 8px rgba(106,72,25,0.10); animation: float 3s ease-in-out infinite; flex-shrink: 0;">
                <img src="images/nutri.png" alt="Nutritionist" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
            <div class="nutritionist-bubble" style="background: #fff; border-radius: 18px 18px 18px 4px; box-shadow: 0 2px 8px rgba(106,72,25,0.08); padding: 18px 22px; font-size: 1.08rem; position: relative;">
                Hi! I'm Celine, your Personal Nutritionist. I'm here to help you create a custom nutrition plan tailored to your goals.
            </div>
        </div>

        <div class="main-section">
            <!-- Consultation Process Section -->
            <div class="consultation-process">
                <div class="process-steps">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <div class="step-icon"><i class="fas fa-clipboard-list"></i></div>
                        <h3 class="step-title">Choose Your Plan Type</h3>
                        <p class="step-description">Choose from diet plans tailored to different lifestyles and preferences.</p>
                    </div>
                    
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <div class="step-icon"><i class="fas fa-sliders-h"></i></div>
                        <h3 class="step-title">Set Your Goals</h3>
                        <p class="step-description">Enter your details to get a macronutrient and budget-friendly plan you can customize.</p>
                    </div>
                    
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <div class="step-icon"><i class="fas fa-utensils"></i></div>
                        <h3 class="step-title">Generate Your Meal Plan</h3>
                        <p class="step-description">View your personalized meal plan with complete daily meal breakdowns.</p>
                    </div>
                </div>
            </div>


            
            <!-- Food Images Strip Section -->
            <div class="second-section">
                <div class="second-section-strip">
                    <div class="second-section-img">
                        <img src="images/DP.MainSec2a.jpg" alt="salad bowl">
                    </div>
                    <div class="second-section-img">
                        <img src="images/DP.MainSec2b.jpg" alt="Healthy salad bowl">
                    </div>
                    <div class="second-section-img">
                        <img src="images/DP.MainSec2c.jpg" alt="Oatmeal bowl">
                    </div>
                    <div class="second-section-img">
                        <img src="images/DP.MainSec2d.jpg" alt="Nutritious bowl">
                    </div>
                </div>
            </div>
            
            <!-- Move button here -->
            <div class="button-container">
                <a href="DP.PS.step1.php" class="cta-button">Create Your Plan</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Card expansion functionality
            const dietCards = document.querySelectorAll('.diet-type-card');
            
            dietCards.forEach(card => {
                const header = card.querySelector('.card-header');
                const body = card.querySelector('.card-body');
                const expandIcon = card.querySelector('.expand-icon');
                
                header.addEventListener('click', function() {
                    const isActive = body.classList.contains('active');
                    
                    // Close all cards first
                    dietCards.forEach(c => {
                        c.classList.remove('active');
                        c.querySelector('.card-body').classList.remove('active');
                        c.querySelector('.card-header').classList.remove('active');
                        c.querySelector('.expand-icon').classList.remove('active');
                    });

                    if (!isActive) {
                        card.classList.add('active');
                        body.classList.add('active');
                        header.classList.add('active');
                        expandIcon.classList.add('active');
                        
                        setTimeout(() => {
                            const rect = card.getBoundingClientRect();
                            const isInView = (
                                rect.top >= 0 &&
                                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
                            );
                            
                            if (!isInView) {
                                card.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            }
                        }, 300);
                    }
                });
            });
            
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

    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved.</p>
        </div>
    </footer>
</body>
</html> 
