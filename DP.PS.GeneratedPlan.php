<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.PS.GeneratedPlan.php
Description     : Personalized Diet Plan - Display Generated Meals Plan for Members
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
    $user_id = $_SESSION['usr_user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Generated Meal Plan - RunTime Fitness</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&family=Segoe+UI&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="DP.css">
    <!-- Add jsPDF library for PDF generation -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        const USER_ID = <?php echo json_encode($user_id); ?>;
    </script>
    <style>
        /* Subtle Grid Background */
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

        .header {
            background: linear-gradient(to right, #8D7151, #b38b4f);
            padding: 20px 0;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            box-shadow: 0 4px 10px rgba(106, 72, 25, 0.15);
        }
        
        .header h1 {
            color: white;
            margin: 0;
            font-family: 'Press Start 2P', cursive;
            font-size: 1.8rem;
            text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }
        
        .plan-overview {
            background-color: #ffffff;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 5px 15px rgba(106, 72, 25, 0.08);
            border: none;
            position: relative;
        }
        
        .plan-overview h2 {
            color: #6a4819;
            margin-top: 0;
            margin-bottom: 30px;
            font-family: 'Segoe UI', sans-serif;
            font-size: 2rem;
            font-weight: 600;
            padding-bottom: 10px;
            border-bottom: 2px solid #e6dfd1;
        }
        
        .plan-overview .info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .plan-overview .info-item {
            background: #f9f6f0;
            padding: 20px;
            border-radius: 10px;
            margin: 0;
            box-shadow: 0 2px 4px rgba(106, 72, 25, 0.05);
            border: none;
            transition: all 0.3s ease;
        }
        
        .info-item strong {
            display: block;
            font-size: 1rem;
            color: #8c7851;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-item span {
            font-size: 1.5rem;
            color: #6a4819;
            font-weight: 700;
        }
        
        .days-container {
            margin: 40px 0;
            position: relative;
        }
        
        /* Day Tabs Navigation */
        .days-tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            background-color: #f9f6f0;
            border-radius: 10px 10px 0 0;
            border: 2px solid #e6dfd1;
            border-bottom: none;
            position: sticky;
            top: 10px;
            z-index: 10;
            scrollbar-width: thin;
            scrollbar-color: #b38b4f #f9f6f0;
        }
        
        .days-tabs::-webkit-scrollbar {
            height: 6px;
        }
        
        .days-tabs::-webkit-scrollbar-track {
            background: #f9f6f0;
            border-radius: 10px;
        }
        
        .days-tabs::-webkit-scrollbar-thumb {
            background-color: #b38b4f;
            border-radius: 10px;
        }
        
        .day-tab {
            padding: 15px 25px;
            white-space: nowrap;
            font-weight: 600;
            color: #8c7851;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            min-width: 100px;
            text-align: center;
            font-family: 'VT323', monospace;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }
        
        .day-tab.active {
            color: #6a4819;
            border-bottom-color: #8D7151;
            background: linear-gradient(to bottom, rgba(141, 113, 81, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
        }
        
        .day-tab:hover {
            color: #6a4819;
            border-bottom-color: #b38b4f;
            background-color: rgba(141, 113, 81, 0.05);
        }
        
        .day-tab::after {
            content: '';
            position: absolute;
            right: 0;
            top: 20%;
            height: 60%;
            width: 1px;
            background-color: #e6dfd1;
        }
        
        .day-tab:last-child::after {
            display: none;
        }
        
        .days-content {
            position: relative;
            min-height: 300px;
        }
        
        .day-card {
            background: white;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 5px 15px rgba(106, 72, 25, 0.08);
            overflow: hidden;
            border: 2px solid #e6dfd1;
            transition: all 0.3s ease;
            display: none;
        }
        
        .day-card.active {
            display: block;
        }
        
        .day-card:hover {
            box-shadow: 0 8px 20px rgba(106, 72, 25, 0.12);
            border-color: #b38b4f;
        }
        
        /* Days Navigation Controls */
        .days-navigation {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            gap: 10px;
        }
        
        .nav-button {
            background: linear-gradient(to right, #8D7151, #b38b4f);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 3px 8px rgba(106, 72, 25, 0.1);
        }
        
        .nav-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 72, 25, 0.15);
        }
        
        .nav-button:disabled {
            background: #e6dfd1;
            color: #8c7851;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        /* Mobile Optimization */
        @media (max-width: 768px) {
            .days-tabs {
                justify-content: flex-start;
                padding-bottom: 3px;
            }
            
            .day-tab {
            padding: 12px 20px;
                min-width: 80px;
                font-size: 1.1rem;
            }
        }
        
        .meal-container {
            padding: 20px 25px;
        }
        
        .meal {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(106, 72, 25, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .meal-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .meal-icon {
            width: 50px;
            height: 50px;
            background: #f8f4ec;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8D7151;
            font-size: 1.5rem;
        }
        
        .meal-content {
            flex-grow: 1;
        }
        
        .meal-title {
            color: #6a4819;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .meal-items {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .meal-item {
            background: #f8f4ec;
            padding: 8px 15px;
            border-radius: 20px;
            color: #8D7151;
            font-size: 0.95rem;
        }
        
        .meal-info {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 15px;
            color: #8c7851;
        }
        
        .meal-info span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .meal-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .btn-details,
        .btn-swap {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 120px;
        }
        
        .btn-details {
            background: #8D7151;
            color: white;
            border: none;
        }
        
        .btn-details:hover {
            background: #6a4819;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(106, 72, 25, 0.2);
        }
        
        .btn-swap {
            background: transparent;
            color: #8D7151;
            border: 1px solid #8D7151;
        }
        
        .btn-swap:hover {
            background: #8D7151;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(106, 72, 25, 0.2);
        }
        
        /* Nutrition Facts Table */
        .nutrition-facts {
            border: 1px solid #333;
            padding: 0.5rem;
            width: 100%;
            font-family: 'Helvetica', Arial, sans-serif;
            background: white;
        }

        .nutrition-facts-header {
            border-bottom: 8px solid #333;
            padding-bottom: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .nutrition-facts-title {
            font-size: 2rem;
            font-weight: bold;
        }

        .nutrition-facts-serving {
            font-size: 0.85rem;
            padding: 0.25rem 0;
        }

        .nutrition-facts-line {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #333;
            padding: 0.5rem 0;
            font-size: 0.85rem;
        }

        .nutrition-facts-line.thick {
            border-top-width: 4px;
        }

        .nutrition-facts-line.no-border {
            border-top: none;
        }

        .nutrition-facts-calories {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .nutrition-facts-daily-value {
            font-size: 0.7rem;
            text-align: right;
            margin-top: 0.5rem;
            border-top: 4px solid #333;
            padding-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .meal-items {
                grid-template-columns: 1fr;
            }
            
            .meal-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .food-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
        
        .plan-actions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 40px 0;
        }
        
        .plan-actions .btn {
            padding: 12px 25px;
            font-size: 16px;
            min-width: 160px;
        }
        
        .btn-save {
            background: #8D7151;
            color: white;
        }
        
        .btn-save:hover {
            background: #6a4819;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(141, 113, 81, 0.2);
        }
        
        .btn-regenerate {
            background: #FF5722;
            color: white;
        }
        
        .btn-regenerate:hover {
            background: #f4511e;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(255, 87, 34, 0.2);
        }
        
        .btn-view {
            background: #b38b4f;
            color: white;
        }
        
        .btn-view:hover {
            background: #9c774a;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(179, 139, 79, 0.2);
        }
        
        .btn-back {
            background: #6a4819;
            color: white;
        }
        
        .btn-back:hover {
            background: #543a14;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(106, 72, 25, 0.2);
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
        }
        
        .modal-content {
            position: relative;
            background-color: white;
            margin: 50px auto;
            padding: 0;
            border-radius: 12px;
            width: 90%;
            max-width: 800px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            animation: modalopen 0.4s ease;
            border: 2px solid #e6dfd1;
        }
        
        .modal-header {
            padding: 15px 20px;
            background: linear-gradient(to right, #8D7151, #b38b4f);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h3 {
            margin: 0;
            font-family: 'VT323', monospace;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }
        
        .close-modal {
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            transition: all 0.3s ease;
        }
        
        .close-modal:hover {
            transform: scale(1.1);
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .modal-section {
            margin-bottom: 30px;
        }
        
        .modal-section h4 {
            border-bottom: 2px dashed #e6dfd1;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #6a4819;
            font-family: 'VT323', monospace;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }
        
        .nutrition-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 12px;
        }
        
        .nutrition-item {
            background: #f9f6f0;
            padding: 12px 18px;
            border-radius: 8px;
            width: calc(25% - 10px);
            text-align: center;
            border: 1px solid #e6dfd1;
            transition: all 0.3s ease;
        }
        
        .nutrition-item:hover {
            transform: none;
            box-shadow: 0 2px 4px rgba(106, 72, 25, 0.05);
            border-color: #e6dfd1;
            background: #f9f6f0;
            cursor: default;
        }
        
        @media (max-width: 768px) {
            .nutrition-item {
                width: calc(50% - 10px);
            }
        }
        
        .nutrition-item strong {
            display: block;
            font-size: 14px;
            color: #8c7851;
            margin-bottom: 5px;
        }
        
        .nutrition-item span {
            font-size: 16px;
            color: #6a4819;
            font-weight: 600;
        }
        
        .grocery-list {
            list-style-type: none;
            padding: 0;
        }
        
        .grocery-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #e6dfd1;
            transition: background-color 0.2s ease;
        }
        
        .grocery-item:last-child {
            border-bottom: none;
        }
        
        .grocery-item:hover {
            background-color: #f9f6f0;
        }
        
        .grocery-checkbox {
            margin-right: 12px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .grocery-name {
            flex-grow: 1;
            color: #6a4819;
        }
        
        .grocery-quantity {
            color: #8c7851;
            font-size: 14px;
            font-weight: 500;
        }
        
        .cooking-steps {
            counter-reset: step-counter;
            list-style-type: none;
            padding: 0;
        }
        
        .cooking-step {
            margin-bottom: 15px;
            padding-left: 45px;
            position: relative;
            color: #6a4819;
        }
        
        .cooking-step::before {
            content: counter(step-counter);
            counter-increment: step-counter;
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background: linear-gradient(to right, #8D7151, #b38b4f);
            color: white;
            border-radius: 50%;
            font-weight: bold;
            font-family: 'VT323', monospace;
            font-size: 1.1rem;
        }
        
        .loading-indicator {
            text-align: center;
            padding: 40px 20px;
            color: #8c7851;
        }
        
        .loading-indicator p {
            margin-bottom: 15px;
            font-size: 1.1rem;
            font-family: 'VT323', monospace;
            letter-spacing: 1px;
        }
        
        .progress-bar {
            width: 100%;
            height: 10px;
            background-color: #e6dfd1;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 2px 5px rgba(106, 72, 25, 0.1) inset;
        }
        
        .progress-fill {
            height: 100%;
            width: 0;
            background: linear-gradient(to right, #8D7151, #b38b4f);
            border-radius: 10px;
            animation: progress 2s ease infinite, shimmer 2s infinite;
            background-size: 200% 100%;
        }
        
        @keyframes progress {
            0% { width: 0; }
            50% { width: 70%; }
            100% { width: 100%; }
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        @keyframes modalopen {
            from {opacity: 0; transform: translateY(-60px);}
            to {opacity: 1; transform: translateY(0);}
        }

        /* Nutritionist Avatar Styles */
        .nutritionist-container {
            margin: 30px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            background: transparent;
        }

        .nutritionist-avatar {
            width: 120px;
            height: auto;
            border-radius: 0;
            overflow: visible;
            border: none;
            box-shadow: none;
            margin-right: 20px;
        }

        .nutritionist-avatar img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .speech-bubble {
            position: relative;
            background: #ffffff;
            border-radius: 15px;
            padding: 15px 20px;
            font-size: 1.1rem;
            color: #6a4819;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
        }

        .speech-bubble:after {
            content: '';
            position: absolute;
            left: -15px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 10px;
            border-style: solid;
            border-color: transparent #ffffff transparent transparent;
        }

        @media (max-width: 768px) {
            .nutritionist-container {
                flex-direction: column;
                text-align: center;
            }

            .nutritionist-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .speech-bubble {
                margin-bottom: 15px;
            }

            .speech-bubble:after {
                left: 50%;
                top: -15px;
                transform: translateX(-50%) rotate(90deg);
            }
        }

        /* Swap Modal */
        #swap-modal .modal-content {
            border-radius: 18px;
            box-shadow: 0 10px 32px rgba(141, 113, 81, 0.18);
            border: 2px solid #e6dfd1;
            background: linear-gradient(135deg, #fff8f0 0%, #f9f6f0 100%);
            padding: 0;
            overflow: hidden;
        }
        #swap-modal .modal-header {
            background: linear-gradient(90deg, #8D7151 0%, #b38b4f 100%);
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            border-bottom: 1.5px solid #e6dfd1;
            color: #fff;
            padding: 22px 32px 18px 32px;
            box-shadow: 0 2px 8px rgba(141, 113, 81, 0.08);
        }
        #swap-modal .modal-header h3 {
            font-family: 'VT323', monospace;
            font-size: 1.6rem;
            letter-spacing: 1px;
            color: #fff;
        }
        #swap-modal .close-modal {
            color: #fff;
            font-size: 2rem;
            font-weight: bold;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0 8px;
        }
        #swap-modal .close-modal:hover {
            color: #ffe6b3;
        }
        #swap-modal .modal-body {
            padding: 36px 32px 28px 32px;
            background: #fff8f0;
        }
        #swap-modal .modal-section h4 {
            color: #8D7151;
            font-family: 'Segoe UI', sans-serif;
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 18px;
            border-bottom: 1.5px solid #e6dfd1;
            padding-bottom: 7px;
        }
        #swap-modal .alternatives-container {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 10px;
        }
        #swap-modal .alternatives-container > * {
            background: #f9f6f0;
            border: 1.5px solid #e6dfd1;
            border-radius: 10px;
            padding: 14px 20px;
            font-size: 1.05rem;
            color: #6a4819;
            transition: box-shadow 0.2s, border-color 0.2s, transform 0.2s;
            box-shadow: 0 2px 8px rgba(141, 113, 81, 0.06);
            cursor: pointer;
        }
        #swap-modal .alternatives-container > *:hover {
            border-color: #b38b4f;
            box-shadow: 0 6px 18px rgba(179, 139, 79, 0.18);
            transform: translateY(-2px) scale(1.03);
            background: #f9f6f0;
        }
        #swap-modal .modal-footer {
            background: #f9f6f0;
            border-top: 1.5px solid #e6dfd1;
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
            padding: 18px 32px;
            text-align: right;
        }
        #swap-modal .btn-cancel {
            background: linear-gradient(90deg, #e6dfd1 0%, #fff8f0 100%);
            color: #8D7151;
            border: 1.5px solid #b38b4f;
            border-radius: 7px;
            padding: 10px 28px;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(141, 113, 81, 0.07);
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        #swap-modal .btn-cancel:hover {
            background: #b38b4f;
            color: #fff;
            border-color: #8D7151;
        }
        .nutrition-item,
        .nutrition-item:hover {
            box-shadow: 0 2px 4px rgba(106, 72, 25, 0.05);
            border-color: #e6dfd1;
            transform: none;
            background: #f9f6f0;
            cursor: default;
        }
        @media (max-width: 600px) {
            #swap-modal .modal-content {
                border-radius: 10px;
            }
            #swap-modal .modal-header, #swap-modal .modal-footer {
                padding: 14px 10px;
            }
            #swap-modal .modal-body {
                padding: 18px 10px 14px 10px;
            }
            #swap-modal .alternatives-container {
                gap: 10px;
            }
        }

        #swap-modal .alternatives-container > * button {
            min-height: 40px; 
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            white-space: nowrap; 
            padding: 8px 15px; 
            font-size: 0.9rem; 
            width: 100%; 
        }
        
    </style>
</head>
<body>
    <div class="grid-lines"></div>
    
    <div class="header">
        <div class="container">
            <h1>Your Personalized Meal Plan</h1>
        </div>
    </div>

    <div class="nutritionist-container">
        <div class="nutritionist-avatar">
            <img src="images/nutri.png" alt="Friendly Nutritionist" class="floating">
        </div>
        <div class="welcome-message">
            <div class="speech-bubble">
                Here's your personalized plan! Let's eat healthy 😊
            </div>
        </div>
    </div>

    <div class="container">
        <div class="plan-overview">
            <h2>Plan Overview</h2>
            <div class="info">
                <div class="info-item">
                    <strong>Diet Type</strong>
                    <span id="diet-type">Regular Diet</span>
                </div>
                <div class="info-item">
                    <strong>Daily Calories</strong>
                    <span id="daily-calories">8 cal</span>
                </div>
                <div class="info-item">
                    <strong>Daily Budget</strong>
                    <span id="daily-budget">RM</span>
                </div>
                <div class="info-item">
                    <strong>Duration</strong>
                    <span id="plan-duration">7 Days</span>
                </div>
                <div class="info-item">
                    <strong>Protein</strong>
                    <span id="daily-protein">0g</span>
                </div>
                <div class="info-item">
                    <strong>Carbs</strong>
                    <span id="daily-carbs">1g</span>
                </div>
                <div class="info-item">
                    <strong>Fat</strong>
                    <span id="daily-fat">0g</span>
                </div>
            </div>
        </div>
        
        
        <div class="days-container" id="meal-plan-container">
            <!-- Day tabs navigation -->
            <div class="days-tabs" id="days-tabs">
                <!-- Tabs will be generated by JavaScript -->
            </div>
            
            <!-- Days content -->
            <div class="days-content" id="days-content">
                <!-- Day cards will be inserted here by JavaScript -->
            </div>
            
            <!-- Days navigation controls -->
            <div class="days-navigation">
                <button id="prev-day" class="nav-button" disabled>
                    <i class="fas fa-chevron-left"></i> Previous Day
                </button>
                <button id="next-day" class="nav-button">
                    Next Day <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
            <div class="loading-indicator" id="loading-indicator">
                <p>Generating your personalized meal plan<span class="retro-cursor"></span></p>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>
        </div>
        
        <div class="plan-actions">
            <button class="btn btn-save" id="save-plan-btn">
                <i class="fas fa-save"></i> Save Plan
            </button>
            <button class="btn btn-regenerate" id="regenerate-plan-btn">
                <i class="fas fa-sync-alt"></i> Regenerate
            </button>
            <button class="btn btn-view" id="view-plan-btn">
                <i class="fa fa-eye"></i> View Saved Plans
            </button>
            <button class="btn btn-back" id="new-plan-btn">
                <i class="fas fa-arrow-left"></i> New Plan
            </button>
        </div>
    </div>
    
    <!-- Details Modal -->
    <div id="details-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-meal-title">Meal Details</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Nutrition Information</h4>
                    <div class="nutrition-facts">
                        <div class="nutrition-facts-header">
                            <div class="nutrition-facts-title">Nutrition Facts</div>
                            <div class="nutrition-facts-serving">1 serving</div>
                        </div>
                        <div class="nutrition-facts-line thick">
                            <span>Calories</span>
                            <span class="nutrition-facts-calories" id="modal-calories">230</span>
                        </div>
                        <div class="nutrition-facts-line">
                            <span>Total Fat</span>
                            <span id="modal-fat">8g</span>
                        </div>
                        
                        <div class="nutrition-facts-line">
                            <span>Total Carbohydrate</span>
                            <span id="modal-carbs">37g</span>
                        </div>
                        <div class="nutrition-facts-line">
                            <span>Protein</span>
                            <span id="modal-protein">3g</span>
                        </div>
                    </div>
                </div>
                
                <div class="modal-section">
                    <h4>Grocery List</h4>
                    <ul class="grocery-list" id="modal-grocery">
                        <!-- Grocery items will be inserted here -->
                    </ul>
                </div>
                
                <div class="modal-section">
                    <h4>Cooking Instructions</h4>
                    <ol class="cooking-steps" id="modal-instructions">
                        <!-- Cooking instructions will be inserted here -->
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Grocery Checklist Notice Modal -->
    <div id="grocery-notice-modal" class="modal">
        <div class="modal-content" style="max-width: 400px;">
            <div class="modal-header">
                <h3>Grocery Checklist</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p>To use the grocery checklist feature, please save your plan first and then access it from your profile under "My Plans".</p>
                <button class="btn btn-save" id="confirm-grocery-notice-btn" style="margin-top: 15px;">
                    <i class="fas fa-check"></i> OK
                </button>
            </div>
        </div>
    </div>
    
    <!-- Swap Food Modal -->
    <div id="swap-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="swap-modal-title">Swap Food</h3>
                <button class="close-modal" onclick="document.getElementById('swap-modal').style.display='none'">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Available Alternatives</h4>
                    <div id="food-alternatives" class="alternatives-container">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 15px; text-align: right; border-top: 1px solid #e6dfd1;">
                <button class="btn btn-cancel" onclick="document.getElementById('swap-modal').style.display='none'" style="background-color: #e6e6e6; color: #333; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Cancel</button>
            </div>
        </div>
    </div>
    
    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved.</p>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script id="food-db-script" src="DP.PS.FoodDB.js?v=<?php echo time(); ?>"></script>
    <script src="DP.PS.Generator.js?v=<?php echo time(); ?>"></script>
    <script id="food-swapper-script" src="DP.PS.FoodSwapper.js?v=<?php echo time(); ?>"></script>
    <script src="DP.PS.GeneratedPlan.js?v=<?php echo time(); ?>"></script>
    

</body>
</html>
