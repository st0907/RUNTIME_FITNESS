<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.PS.Loading.php
Description     : Loading page while generating meals plan
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
    <title>RunTime Fitness - Personalized Diet Plan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&family=Segoe+UI&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="DP.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            background-image: 
                linear-gradient(rgba(248, 244, 236, 0.9), rgba(248, 244, 236, 0.9)),
                url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="%23b38b4f" stroke-width="0.5"/></svg>');
        }
        
        .grid-lines {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(rgba(179, 139, 79, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(179, 139, 79, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
            z-index: -1;
        }
        
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            z-index: 2;
            width: 80%;
            max-width: 500px;
        }
        
        .logo {
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(-30px);
            animation: fadeInDown 1s ease forwards 0.5s;
        }
        
        .logo img {
            width: 120px;
            height: auto;
            border-radius: 10px;
            border: 2px solid #e6dfd1;
            padding: 5px;
            background-color: rgba(255, 255, 255, 0.7);
            box-shadow: 0 4px 10px rgba(106, 72, 25, 0.1);
        }
        
        .logo h1 {
            margin-top: 15px;
            font-family: 'Press Start 2P', cursive;
            font-size: 1.5rem;
            color: #8D7151;
            text-shadow: 1px 1px 0 #b38b4f;
            letter-spacing: 1px;
        }
        
        .loading-title {
            margin-bottom: 30px;
            opacity: 0;
            animation: fadeIn 1s ease forwards 1s;
        }
        
        .loading-title h2 {
            font-size: 1.5rem;
            color: #6a4819;
            margin-bottom: 10px;
            font-family: 'VT323', monospace;
            letter-spacing: 1px;
        }
        
        .loading-title p {
            font-size: 1rem;
            color: #8c7851;
        }
        
        .loading-bar-container {
            width: 100%;
            height: 10px;
            background-color: #e6dfd1;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
            opacity: 0;
            animation: fadeIn 1s ease forwards 1.5s;
            position: relative;
            box-shadow: 0 2px 5px rgba(106, 72, 25, 0.1) inset;
        }
        
        .loading-bar {
            height: 100%;
            width: 0;
            background: linear-gradient(to right, #8D7151, #b38b4f);
            border-radius: 10px;
            transition: width 0.3s ease;
            animation: loadingProgress 3s ease forwards 1.8s, shimmer 2s infinite;
            background-size: 200% 100%;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .loading-percentage {
            font-size: 1.2rem;
            color: #8D7151;
            font-weight: 600;
            opacity: 0;
            animation: fadeIn 1s ease forwards 1.5s;
            margin-bottom: 25px;
            font-family: 'VT323', monospace;
            letter-spacing: 1px;
        }
        
        .food-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.15;
            pointer-events: none;
        }
        
        .food-icon {
            position: absolute;
            font-size: 24px;
            color: #8D7151;
            opacity: 0;
            animation: floatIcon 15s linear infinite;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeInDown {
            from { 
                opacity: 0;
                transform: translateY(-30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes loadingProgress {
            from { width: 0; }
            to { width: 100%; }
        }
        
        @keyframes floatIcon {
            0% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            90% {
                opacity: 0.8;
            }
            100% {
                transform: translate(var(--move-x), var(--move-y)) rotate(var(--rotate-deg));
                opacity: 0;
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        
        @media (max-width: 768px) {
            .loading-container {
                width: 90%;
            }
            
            .logo img {
                width: 80px;
            }
            
            .logo h1 {
                font-size: 1.2rem;
            }
            
            .loading-title h2 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="grid-lines"></div>
    
    <!-- Background Food Icons -->
    <div class="food-icons" id="food-icons"></div>
    
    <div class="loading-container">
        <div class="loading-title">
            <h2>Loading your personalized plan...</h2>
            <p>Please wait while we generate it for you.</p>
        </div>
        <div class="nutritionist-avatar" style="width: 110px; height: 110px; border-radius: 18px; overflow: hidden; background: #fff; box-shadow: 0 2px 8px rgba(106,72,25,0.10); margin: 0 auto 18px auto; display: flex; align-items: center; justify-content: center;">
            <img src="images/nutri.png" alt="Nutritionist" style="width: 100%; height: 100%; object-fit: cover; display: block;">
        </div>
        <div class="nutritionist-bubble" style="background: #fff; border-radius: 18px 18px 18px 4px; box-shadow: 0 2px 8px rgba(106,72,25,0.08); padding: 18px 22px; font-size: 1.08rem; max-width: 600px; min-width: 320px; position: relative; margin: 0 auto 18px auto;">
            Almost done! Your plan is being generated...
        </div>
        <div class="loading-bar-container">
            <div class="loading-bar" id="loading-bar"></div>
        </div>
        <div class="loading-percentage" id="loading-percentage">0%</div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate food icons
            const foodIcons = document.getElementById('food-icons');
            const icons = [
                'fa-apple-alt', 'fa-carrot', 'fa-fish', 'fa-drumstick-bite',
                'fa-egg', 'fa-bread-slice', 'fa-cheese', 'fa-pizza-slice',
                'fa-hamburger', 'fa-cookie', 'fa-ice-cream', 'fa-lemon'
            ];
            
            // Create 20 random food icons
            for (let i = 0; i < 20; i++) {
                const icon = document.createElement('i');
                icon.className = `fas ${icons[Math.floor(Math.random() * icons.length)]} food-icon`;
                
                const top = Math.random() * 100;
                const left = Math.random() * 100;
                
                const moveX = (Math.random() * 200 - 100) + 'px';
                const moveY = (Math.random() * 200 - 100) + 'px';
                const rotateDeg = (Math.random() * 360) + 'deg';

                icon.style.setProperty('--move-x', moveX);
                icon.style.setProperty('--move-y', moveY);
                icon.style.setProperty('--rotate-deg', rotateDeg);
                
                icon.style.top = top + '%';
                icon.style.left = left + '%';
                
                icon.style.animationDelay = (Math.random() * 5) + 's';
                
                foodIcons.appendChild(icon);
            }
            
            // Loading bar progress
            const loadingBar = document.getElementById('loading-bar');
            const loadingPercentage = document.getElementById('loading-percentage');
            let progress = 0;
            
            // Update loading progress
            function updateProgress() {
                if (progress < 100) {
                    progress++;
                    loadingPercentage.textContent = progress + '%';
                    
                    if (progress === 100) {
                        setTimeout(function() {
                            window.location.href = 'DP.PS.GeneratedPlan.php';
                        }, 500);
                    }
                    
                    setTimeout(updateProgress, 30); 
                }
            }
            
            setTimeout(updateProgress, 1000);
            
            const title = document.querySelector('.loading-title h2');
            const originalText = title.textContent;
            title.textContent = '';
            
            let i = 0;
            function typeWriter() {
                if (i < originalText.length) {
                    title.textContent += originalText.charAt(i);
                    i++;
                    setTimeout(typeWriter, 80);
                }
            }
            
            setTimeout(typeWriter, 300);

            setTimeout(() => {
                const cursor = document.createElement('span');
                cursor.className = 'retro-cursor';
                title.appendChild(cursor);
            }, (originalText.length * 80) + 300);
        });
    </script>
</body>
</html> 
