<!--Programmer Name: Yap Xin Ling (TP077224)
Program Name: dietPlan.html
Description: Preview Diet Plan page for users before logging into the system
First Written on: Wednesday, 18-June-2025
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
    <title>Runtime Fitness - Loading</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #F8F5F0;
            background-image: radial-gradient(circle at 10% 20%, rgba(216, 201, 180, 0.1) 0%, rgba(216, 201, 180, 0) 80%),
                             linear-gradient(120deg, #F8F5F0 0%, #EFE8DE 100%);
            color: #5A4128;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%238d7151' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 52px;
            width: 52px;
            border-radius: 50%;
            margin-right: 16px;
            box-shadow: 0 3px 15px rgba(137, 113, 81, 0.15);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #715B3F;
            letter-spacing: 0.5px;
        }

        .loading-container {
            text-align: center;
            position: relative;
            z-index: 1;
            max-width: 500px;
            padding: 0 20px;
        }

        .video-container {
            width: 320px;
            height: 320px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 50px;
            border: 10px solid rgba(229, 219, 199, 0.8);
            position: relative;
            box-shadow: 0 10px 30px rgba(106, 72, 25, 0.15), 
                       inset 0 0 15px rgba(255, 255, 255, 0.8);
            animation: pulseGlow 3s infinite alternate;
        }

        @keyframes pulseGlow {
            0% {
                box-shadow: 0 10px 30px rgba(106, 72, 25, 0.15), 
                           inset 0 0 15px rgba(255, 255, 255, 0.8);
            }
            100% {
                box-shadow: 0 10px 30px rgba(106, 72, 25, 0.25), 
                           inset 0 0 25px rgba(255, 255, 255, 0.9);
            }
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .loading-bar-container {
            width: 80%;
            max-width: 400px;
            height: 8px;
            background-color: rgba(229, 219, 199, 0.6);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            margin: 0 auto;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .loading-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #8D7151 0%, #A68566 100%);
            border-radius: 20px;
            transition: width 0.15s ease-out;
            position: relative;
        }

        .loading-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, 
                        rgba(255, 255, 255, 0) 0%, 
                        rgba(255, 255, 255, 0.3) 50%, 
                        rgba(255, 255, 255, 0) 100%);
            animation: shimmer 1.5s infinite;
            background-size: 200% 100%;
        }

        @keyframes shimmer {
            0% { background-position: -100% 0; }
            100% { background-position: 100% 0; }
        }

        .loading-text {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #715B3F;
            font-weight: 500;
            letter-spacing: 5px;
            text-transform: uppercase;
            opacity: 0;
            animation: fadeInOut 2s infinite;
        }

        @keyframes fadeInOut {
            0% { opacity: 0.4; }
            50% { opacity: 0.9; }
            100% { opacity: 0.4; }
        }

        .progress-percentage {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            color: #715B3F;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .tagline {
            position: absolute;
            bottom: 40px;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-style: italic;
            color: #8D7151;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .video-container {
                width: 260px;
                height: 260px;
                margin-bottom: 40px;
            }
            
            .logo-text {
                font-size: 1.8rem;
            }
            
            .progress-percentage {
                top: -24px;
                font-size: 0.9rem;
            }
            
            .tagline {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <div class="video-container">
            <video autoplay loop muted playsinline>
                <source src="images/loading.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        
        <div class="loading-bar-container">
            <div class="loading-bar" id="loadingBar"></div>
            <div class="progress-percentage" id="progressText">0%</div>
        </div>
        
        <div class="loading-text">LOADING</div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadingBar = document.getElementById('loadingBar');
            const progressText = document.getElementById('progressText');
            let progress = 50; // Start at 50%
            loadingBar.style.width = `${progress}%`;
            progressText.textContent = `${Math.floor(progress)}%`;
            const interval = setInterval(() => {
                const increment = Math.random() * 1.2 + 0.4;
                progress += increment;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    // Small pause at 100% for better UX
                    setTimeout(() => {
                        window.location.href = "memberHomepage.php";
                    }, 800);
                }
                loadingBar.style.width = `${progress}%`;
                progressText.textContent = `${Math.floor(progress)}%`;
            }, 25);  // Loading Speed
        });
    </script>
</body>
</html> 
