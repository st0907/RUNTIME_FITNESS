<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.PS.step1.php
Description     : Personalized Diet Plan - Step 1 Choose Your Plan Type
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
    <title>Choose Your Plan Type - RunTime Fitness</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="DP.css">
    <style>
        /* Virtual Nutritionist Section */
        .nutritionist-section {
            display: flex;
            margin: 0 0 30px;
            position: relative;
            background-color: #f8f4ec;
            overflow: visible;
        }

        .nutritionist-container {
            display: flex;
            width: 100%;
            position: relative;
            padding: 10px 0;
        }

        .nutritionist-avatar {
            width: 200px; 
            height: auto;
            overflow: hidden;
            background-color: transparent;
            z-index: 2;
            border-radius: 0;
            border: none;
            box-shadow: none;
            transition: transform 0.5s ease;
            animation: float 3s ease-in-out infinite;
            position: relative;
        }

        .nutritionist-avatar:hover {
            animation-play-state: paused;
        }

        .nutritionist-avatar img {
            width: 100%;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 5px 15px rgba(106, 72, 25, 0.15));
        }

        .speech-bubble {
            background-color: #fff;
            border-radius: 20px;
            padding: 15px 20px;
            margin-left: 0;
            box-shadow: 0 4px 15px rgba(106, 72, 25, 0.1);
            position: relative;
            z-index: 1;
            max-width: 600px;
            align-self: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: popOut 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-origin: left center;
        }

        /* Pop-out animation for speech bubble */
        @keyframes popOut {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            70% {
                transform: scale(1.05);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Speech bubble pointer */
        .speech-bubble:before {
            content: '';
            position: absolute;
            left: -15px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 15px 15px 15px 0;
            border-style: solid;
            border-color: transparent #fff transparent transparent;
            filter: drop-shadow(-3px 0 5px rgba(106, 72, 25, 0.05));
        }

        .speech-bubble:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 20px rgba(106, 72, 25, 0.15);
        }

        .speech-bubble p {
            color: #6a4819;
            font-size: 1.2rem;
            margin: 0;
            line-height: 1.5;
        }

        .speech-bubble .emoji {
            font-size: 1.4rem;
            vertical-align: middle;
            display: inline-block;
            animation: wave 1.5s infinite;
            transform-origin: 70% 70%;
        }

        @keyframes wave {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(14deg); }
            20% { transform: rotate(-8deg); }
            30% { transform: rotate(14deg); }
            40% { transform: rotate(-4deg); }
            50% { transform: rotate(10deg); }
            60% { transform: rotate(0deg); }
            100% { transform: rotate(0deg); }
        }

        .typing-effect {
            border-right: 3px solid #8D7151;
            white-space: nowrap;
            overflow: hidden;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
            display: inline-block;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #8D7151 }
        }

        .nutritionist-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(ellipse at center, rgba(179, 139, 79, 0.1) 0%, rgba(248, 244, 236, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Diet Type Options */
        .diet-type-options {
            display: flex;
            flex-wrap: nowrap;
            gap: 35px;
            margin-top: 20px;
            justify-content: center;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .diet-type-option {
            flex: 0 0 150px;
            max-width: 500px;     
            min-width: 150px;
            padding: 15px 10px;
            height: 190px;
            background-color: #ffffff;
            border: 2px solid #e6dfd1;
            border-radius: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(106, 72, 25, 0.1);
            position: relative;
            overflow: hidden;
        }

        .diet-type-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(106, 72, 25, 0.15);
            border-color: #b38b4f;
        }

        .diet-type-option.active {
            background-color: rgba(179, 139, 79, 0.05);
            border-color: #b38b4f;
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(106, 72, 25, 0.15);
        }

        .diet-image-container {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 10px;
            overflow: hidden;
            border: 2px solid #e6dfd1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f4ec;
        }

        .diet-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .diet-type-option h3 {
            font-size: 0.95rem;
            color: #6a4819;
            margin-bottom: 3px;
            font-weight: 600;
        }

        .option-desc {
            font-size: 0.75rem;
            color: #8c7851;
        }

        /* Buttons */
        .button-container {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }

        .next-btn {
            padding: 12px 30px;
            background-color: #8D7151;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .next-btn:hover {
            background-color: #6a4819;
            transform: translateY(-2px);
        }

        /* Plan Information */
        .plan-info-section {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid rgba(106, 72, 25, 0.2);
        }

        .info-section-title {
            text-align: center;
            margin-bottom: 30px;
            color: #6a4819;
            font-size: 1.5rem;
            position: relative;
        }

        .info-section-title:after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: #b38b4f;
        }

        .plan-info-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .plan-info-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: transparent;
        }

        .plan-info-card:hover {
            transform: translateY(-5px);
        }

        .plan-info-header {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            background-color: transparent;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s ease, border-radius 0.3s ease;
        }

        .plan-info-icon {
            background-color: #8D7151;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .plan-info-header h3 {
            flex-grow: 1;
            font-size: 1.1rem;
            color: #6a4819;
        }

        .expand-btn {
            background: none;
            border: none;
            color: #8D7151;
            cursor: pointer;
            font-size: 1.1rem;
            transition: transform 0.4s ease;
        }

        .expand-btn.active {
            transform: rotate(180deg);
        }

        .plan-info-content {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            visibility: hidden;
            background-color: #fff;
            border-radius: 0 0 10px 10px;
            margin-top: 0;
        }

        .plan-info-content p, 
        .plan-info-content ul {
            transition: opacity 0.4s ease 0.1s;
            opacity: 0;
        }

        .plan-info-content.active {
            padding: 20px;
            max-height: 500px; 
            opacity: 1;
            visibility: visible;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .plan-info-content.active p,
        .plan-info-content.active ul {
            opacity: 1;
        }

        .plan-info-card.active {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease;
        }

        .plan-info-card.active .plan-info-header {
            background-color: #f9f6f0;
            border-radius: 10px 10px 0 0;
        }

        .plan-info-content p {
            margin-bottom: 15px;
            color: #6a4819;
            line-height: 1.6;
        }

        .plan-features {
            list-style: none;
        }

        .plan-features li {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .plan-features li i {
            color: #8D7151;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .nutritionist-container {
                flex-direction: row;
                align-items: center;
                gap: 10px;
            }
            
            .nutritionist-avatar {
                margin-bottom: 0;
                width: 150px;
            }
            
            .speech-bubble {
                margin-left: 0;
                font-size: 0.95rem;
            }
            
            .speech-bubble:before {
                left: -10px;
                border-width: 10px 10px 10px 0;
            }
            
            .speech-bubble p {
                font-size: 1rem;
            }
            
            .diet-type-options {
                flex-direction: column;
                align-items: center;
            }
            
            .diet-type-option {
                width: 100%;
                max-width: 300px;
            }

            .plan-info-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-bar-active" id="progress-active"></div>
                <div class="step active">1</div>
                <div class="step">2</div>
                <div class="step">3</div>
            </div>
        </div>

        <div class="plan-header">
            <h1>Step 1: Choose Your Plan Type</h1>
        </div>

        <!-- Virtual Nutritionist Section -->
        <div class="nutritionist-section">
            <div class="nutritionist-container">
                <div class="nutritionist-avatar" id="nutritionist">
                    <img src="images/nutri.png" alt="Nutrition Coach">
                </div>
                <div class="speech-bubble" id="speech-bubble">
                    <p id="nutritionist-text">Hi! I'm your Nutritionist Celine. Let's get started for your Step 1.</p>
                </div>
            </div>
        </div>

        <section>
            <div class="diet-type-options">
                <div class="diet-type-option active" data-value="regular">
                    <div class="diet-image-container">
                        <img src="images/DP.PS.1.jpg" alt="Regular Diet" class="diet-image">
                    </div>
                    <h3>Regular</h3>
                    <div class="option-desc">(No restrictions)</div>
                </div>
                <div class="diet-type-option" data-value="keto">
                    <div class="diet-image-container">
                        <img src="images/DP.PS.2.jpg" alt="Keto Diet" class="diet-image">
                    </div>
                    <h3>Keto</h3>
                    <div class="option-desc">(Low carb, high fat)</div>
                </div>
                <div class="diet-type-option" data-value="vegan">
                    <div class="diet-image-container">
                        <img src="images/DP.PS.3.jpg" alt="Vegan Diet" class="diet-image">
                    </div>
                    <h3>Vegan</h3>
                    <div class="option-desc">(Plant-based only)</div>
                </div>
                <div class="diet-type-option" data-value="vegetarian">
                    <div class="diet-image-container">
                        <img src="images/DP.PS.4.jpg" alt="Vegetarian Diet" class="diet-image">
                    </div>
                    <h3>Vegetarian</h3>
                    <div class="option-desc">(No meat)</div>
                </div>
                <div class="diet-type-option" data-value="dairy-free">
                    <div class="diet-image-container">
                        <img src="images/DP.PS.5.jpeg" alt="Dairy-Free Diet" class="diet-image">
                    </div>
                    <h3>Dairy-Free</h3>
                    <div class="option-desc">(No dairy products)</div>
                </div>
                <div class="diet-type-option" data-value="gluten-free">
                    <div class="diet-image-container">
                        <img src="images/DP.PS.6.jpg" alt="Gluten-Free Diet" class="diet-image">
                    </div>
                    <h3>Gluten-Free</h3>
                    <div class="option-desc">(No gluten)</div>
                </div>
            </div>

            <div class="button-container">
                <button class="next-btn" id="next-step">Next Step</button>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('progress-active').style.width = '0%';
            
            // Diet type selection
            const dietOptions = document.querySelectorAll('.diet-type-option');
            let selectedDietType = 'regular';
            
            dietOptions.forEach(option => {
                option.addEventListener('click', function() {
                    dietOptions.forEach(opt => opt.classList.remove('active'));
                    
                    this.classList.add('active');
                    
                    selectedDietType = this.getAttribute('data-value');
                    
                    updateNutritionistMessage(selectedDietType);
                });
            });
            
            // Nutritionist interaction
            const nutritionist = document.getElementById('nutritionist');
            const speechBubble = document.getElementById('speech-bubble');
            const nutritionistText = document.getElementById('nutritionist-text');
            
            // Initial animation
            setTimeout(() => {
                nutritionistText.className = 'typing-effect';
            }, 500);
            
            // Click interaction
            nutritionist.addEventListener('click', function() {
                const messages = [
                    "Hi! I'm your Nutritionist Celine. Let's get started for your Step 1.",
                    "Choose the diet type that best fits your lifestyle and goals!",
                    "Each plan is designed to provide optimal nutrition for your needs.",
                    "Don't worry, you can always adjust your preferences later."
                ];
                
                // Get random message 
                let newMessage;
                do {
                    newMessage = messages[Math.floor(Math.random() * messages.length)];
                } while (newMessage === nutritionistText.textContent && messages.length > 1);
                
                speechBubble.style.animation = 'none';
                speechBubble.offsetHeight;
                speechBubble.style.animation = 'popOut 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                
                // text animation
                nutritionistText.className = '';
                setTimeout(() => {
                    nutritionistText.textContent = newMessage;
                    nutritionistText.className = 'typing-effect';
                }, 100);
                
                nutritionist.style.animation = 'none';
                nutritionist.offsetHeight; 
                nutritionist.style.animation = 'float 3s ease-in-out infinite';
            });
            
            // Speech bubble interaction
            speechBubble.addEventListener('click', function() {
                this.style.animation = 'none';
                this.offsetHeight; 
                this.style.animation = 'popOut 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                
                nutritionist.click();
            });
            
            function updateNutritionistMessage(dietType) {
                const dietMessages = {
                    'regular': "A flexible diet with no specific restrictions.",
                    'keto': "A low-carb, high-fat diet designed to promote ketosis.",
                    'vegan': "A plant-based diet that provides all essential nutrients.",
                    'vegetarian': "A nutrient-rich diet that excludes meat products.",
                    'dairy-free': "Excludes dairy products, with suitable alternatives provided.",
                    'gluten-free': "Excludes gluten, ideal for those with sensitivities."
                };
                
                speechBubble.style.animation = 'none';
                speechBubble.offsetHeight;
                speechBubble.style.animation = 'popOut 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                
                nutritionistText.className = '';
                setTimeout(() => {
                    nutritionistText.textContent = dietMessages[dietType] || "Great choice! Let's create your perfect meal plan.";
                    nutritionistText.className = 'typing-effect';
                }, 100);
            }
            
            // Next Button
            document.getElementById('next-step').addEventListener('click', function() {
                localStorage.setItem('ps_planType', selectedDietType);
                
                const progressBar = document.getElementById('progress-active');
                progressBar.style.width = '33%';
                
                setTimeout(() => {
                    window.location.href = 'DP.PS.step2.php';
                }, 300);
            });
        });
    </script>
</body>
</html> 
