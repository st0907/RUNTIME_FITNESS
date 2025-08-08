<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.indexMain.php
Description     : Loading Page which will lead members to Member Homepage
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
    <title>RUNTIME FITNESS - Welcome</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #f3ede3;
            color: #6a4819;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .splash-container {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
        }

        .splash-video-container {
            width: 1000px;
            height: 580px;
            overflow: hidden;
            position: relative;
            opacity: 0;
            animation: scaleIn 1s forwards 0.5s;
        }

        .splash-video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .splash-spinner {
            margin-top: 25px;
            color: #8D7151;
            opacity: 0;
            animation: fadeIn 1s forwards 1.5s, spin 1.5s infinite linear;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scaleIn {
            from { 
                opacity: 0; 
                transform: scale(0.8);
            }
            to { 
                opacity: 1; 
                transform: scale(1);
            }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        body.transition-out .splash-container {
            animation: fadeOut 1s forwards;
        }
        
        body.transition-out .splash-video-container {
            animation: shrink 1s forwards;
            position: fixed;
            z-index: 1000;
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        
        @keyframes shrink {
            to { 
                transform: scale(0.8);
                opacity: 0.8;
            }
        }
    </style>
</head>
<body>
    <div class="splash-container">
        <div class="splash-video-container">
            <video id="splash-video" autoplay loop muted playsinline>
                <source src="images/DPindex.mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="splash-spinner">
            <i class="fas fa-spinner" style="font-size: 2rem;"></i>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const splashVideo = document.getElementById('splash-video');
            const videoContainer = document.querySelector('.splash-video-container');
            
            function startTransition() {
                const rect = videoContainer.getBoundingClientRect();
                
                // Store position data for the main page
                sessionStorage.setItem('splashVideoTop', rect.top);
                sessionStorage.setItem('splashVideoLeft', rect.left);
                sessionStorage.setItem('splashVideoWidth', rect.width);
                sessionStorage.setItem('splashVideoHeight', rect.height);
                sessionStorage.setItem('splashVideoTime', splashVideo.currentTime);
                sessionStorage.setItem('splashVideoPlayed', 'true');
                sessionStorage.setItem('transitionAnimation', 'true');
                
                document.body.classList.add('transition-out');
                
                setTimeout(function() {
                    window.location.href = 'DP.MAIN.php';
                }, 1000);
            }
            
            const redirectTimeout = setTimeout(function() {
                startTransition();
            }, 5000);

            splashVideo.addEventListener('timeupdate', function() {
                sessionStorage.setItem('videoTime', splashVideo.currentTime);
            });
        });
    </script>
</body>
</html>
