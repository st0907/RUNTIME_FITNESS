<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.DF.Main.php
Description     : Diet Plans
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
    <title>Default Diet Plans - RunTime Fitness</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="DP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">
    <!-- Add jsPDF library for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            line-height: 1.6;
            color: #6a4819;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto 0;
            padding: 0 20px;
        }


        /* Tab Navigation */
        .tabimage.png-navigation {
            display: flex;
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 30px;
        }

        .tab-btn {
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 500;
            background: none;
            border: none;
            color: #6a4819;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            font-weight: bold;
        }

        .tab-btn.active:after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #b38b4f;
        }

        .tab-btn:hover {
            background-color: rgba(179, 139, 79, 0.1);
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Main Section Titles */
        h1 {
            font-family: 'Press Start 2P', cursive;
            font-size: 1.8rem;
            color: #8D7151;
            margin-bottom: 2rem;
            font-weight: normal;
            text-align: center;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        h2 {
            font-size: 1.8rem;
            color: #6a4819;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        h3 {
            font-size: 1.4rem;
            color: #6a4819;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        /* Section Title Styling */
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

        /* Plan Types Grid */
        .plan-type-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .plan-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: stretch;
            height: 200px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        .plan-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .plan-card.active {
            border-color: #b38b4f;
            box-shadow: 0 5px 15px rgba(179, 139, 79, 0.2);
        }

        .plan-card-image {
            width: 40%;
            height: 100%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .plan-card-content {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .plan-card h3 {
            color: #6a4819;
            margin-bottom: 10px;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .plan-card p {
            color: #777;
            font-size: 0.95rem;
            line-height: 1.5;
            margin: 0;
        }

        /* Meal Plan Section */
        .meal-plan-section {
            display: none;
            margin-top: 40px;
            background-color: #faf7f2;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .meal-plan-section.show {
            display: block;
        }
        
        .meal-plan-section h3 {
            color: #6a4819;
            margin-bottom: 25px;
            font-size: 1.8rem;
            text-align: center;
            position: relative;
        }
        
        .meal-plan-section h3:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 3px;
            background-color: #b38b4f;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .day-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            justify-content: center;
            border-bottom: none;
            padding-bottom: 10px;
            flex-wrap: wrap;
        }

        .day-tab {
            padding: 10px 20px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .day-tab.active {
            background-color: #8D7151;
            color: #fff;
            border-color: #8D7151;
            box-shadow: 0 4px 8px rgba(141, 113, 81, 0.3);
        }

        .day-tab:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
        }

        .day-tab.active:hover {
            background-color: #6a4819;
        }

        .meals-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        .meal {
            padding: 25px;
            border-bottom: 1px solid rgba(232, 232, 232, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .meal:hover {
            background-color: #faf7f2;
        }

        .meal:last-child {
            border-bottom: none;
        }

        .meal-info {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .meal-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background-color: #8D7151;
            color: white;
            font-size: 1.3rem;
            margin-right: 15px;
            flex-shrink: 0;
            box-shadow: 0 4px 8px rgba(141, 113, 81, 0.3);
        }

        .meal-image {
            display: none;
            width: 0;
            height: 0;
            overflow: hidden;
        }

        .meal-content {
            flex: 1;
            padding-left: 0;
        }

        .meal-type {
            font-weight: bold;
            margin-bottom: 10px;
            color: #6a4819;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        .meal-items {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }

        .meal-item {
            display: flex;
            align-items: center;
            gap: 5px;
            background-color: #f9f7f0;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            border: 1px solid rgba(229, 229, 229, 0.5);
            color: #513614;
            font-weight: 500;
        }

        .meal-item:hover {
            background-color: #f9f7f0;
            transform: none;
            box-shadow: none;
        }

        .meal-details {
            display: flex;
            gap: 20px;
            font-size: 1rem;
            color: #777;
            font-weight: 500;
            margin-top: 5px;
        }

        .meal-details span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .meal-details span:first-child:before {
            content: '\f56b';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: #b38b4f;
            font-size: 0.9rem;
        }
        
        .meal-details span:last-child:before {
            content: '\f3d1';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: #b38b4f;
            font-size: 0.9rem;
        }

        .meal-action {
            display: flex;
            gap: 10px;
        }

        .details-btn {
            padding: 10px 24px;
            background-color: #8D7151;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(141, 113, 81, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .details-btn:before {
            content: '\f06e';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .details-btn:hover {
            background-color: #6a4819;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(141, 113, 81, 0.4);
        }

        .daily-summary {
            background-color: #f9f7f0;
            border: none;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .summary-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        
        .summary-item:first-child:before {
            content: '\f56b';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 1.8rem;
            color: #8D7151;
            margin-bottom: 5px;
        }
        
        .summary-item:last-child:before {
            content: '\f3d1';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 1.8rem;
            color: #8D7151;
            margin-bottom: 5px;
        }

        .summary-label {
            display: block;
            color: #6a4819;
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .summary-value {
            display: block;
            color: #8D7151;
            font-size: 1.6rem;
            font-weight: bold;
        }

        .action-buttons {
            text-align: center;
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .action-btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .export-btn {
            background-color: #8D7151;
            color: #fff;
        }

        .export-btn:hover {
            background-color: #6a4819;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(141, 113, 81, 0.4);
        }

        .export-btn i {
            font-size: 1.1rem;
        }

        /* Food Details Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #e8e8e8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f4e8;
        }

        .modal-title {
            font-size: 1.5rem;
            color: #6a4819;
            font-weight: bold;
            margin-top: 15px;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #777;
            cursor: pointer;
        }

        .food-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .modal-body {
            padding: 25px;
            background-color: #fff;
        }

        .nutrition-section, .grocery-section {
            margin-bottom: 30px;
        }

        .food-details-section {
            margin-bottom: 30px;
            background-color: #f9f7f0;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #e8e8e8;
        }

        .section-title {
            font-size: 1.2rem;
            color: #6a4819;
            margin-bottom: 15px;
            font-weight: 600;
            padding-bottom: 5px;
            border-bottom: 1px solid #e8e8e8;
        }

        .grocery-list, .cooking-instructions {
            padding-left: 20px;
            margin-bottom: 20px;
            line-height: 1.6;
            color: #513614;
        }

        .grocery-list li, .cooking-item li {
            margin-bottom: 8px;
            color: #513614;
        }

        .nutrition-info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .nutrition-item {
            background-color: #f5f0e2;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #e8e8e8;
        }

        .nutrition-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #6a4819;
            margin-bottom: 5px;
        }

        .modal-footer {
            padding: 15px 25px;
            border-top: none;
            display: flex;
            justify-content: center;
            background-color: transparent;
            margin-top: 15px;
            gap: 15px;
        }

        .modal-btn {
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .modal-save-btn {
            background-color: #8D7151;
            color: #fff;
        }

        .modal-save-btn:hover {
            background-color: #6a4819;
        }

        .modal-swap-btn {
            background-color: #f5f0e2;
            color: #6a4819;
            border: 1px solid #e0e0e0;
        }

        .modal-swap-btn:hover {
            background-color: #e8e8e8;
        }

        .nutrition-table, .grocery-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            font-size: 0.9rem;
            color: #513614;
            background-color: #f9f7f0;
        }
        
        .nutrition-table th, .nutrition-table td,
        .grocery-table th, .grocery-table td {
            border: 1px solid #e0e0e079;
            padding: 8px 12px;
            text-align: left;
            background-color: #f9f7f0;
        }
        
        .nutrition-table th, .grocery-table th {
            background-color: #f9f7f0;
            font-weight: 700;
            color: #6a4819;
        }
        
        .nutrition-table .total-row {
            background-color: #f9f7f0;
            font-weight: bold;
        }
        
        .cooking-item {
            margin-bottom: 25px;
        }
        
        .cooking-item h6 {
            font-size: 1.05rem;
            color: #6a4819;
            margin-bottom: 10px;
        }
        
        .cooking-item p {
            margin-bottom: 8px;
            color: #513614;
        }
        
        .cooking-item ul, .cooking-item ol {
            padding-left: 20px;
            margin-bottom: 15px;
            color: #513614;
        }
        
        .cooking-item li {
            margin-bottom: 5px;
        }

        /* Export Modal Styles */
        .export-options {
            padding: 15px 0;
        }

        .export-option {
            margin-bottom: 25px;
        }

        .export-option h4 {
            font-size: 1.1rem;
            color: #6a4819;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .option-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .option-group label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 0.95rem;
            color: #555;
        }

        .option-group input[type="radio"],
        .option-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .modal-cancel-btn {
            background-color: #f5f5f5;
            color: #6a4819;
            border: 1px solid #e0e0e0;
        }

        .modal-cancel-btn:hover {
            background-color: #e8e8e8;
        }

        /* Action buttons */
        .action-buttons {
            text-align: center;
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .action-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .export-btn {
            background-color: #f5f5f5;
            color: #6a4819;
            border: 1px solid #e0e0e0;
        }

        .export-btn:hover {
            background-color: #e8e8e8;
            transform: translateY(-2px);
        }

        .export-btn i {
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .action-btn {
                width: 100%;
                max-width: 250px;
                justify-content: center;
            }
        }

        /* Print styles */
        @media print {
            body {
                background-color: #fff;
                color: #000;
                font-size: 12pt;
            }

            header, 
            .plan-type-grid, 
            .instructions-text, 
            .action-buttons, 
            .close-modal, 
            .modal-footer {
                display: none !important;
            }

            .container {
                width: 100%;
                max-width: 100%;
                padding: 0;
                margin: 0;
            }

            h1, h2, h3 {
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            .meals-container {
                page-break-inside: avoid;
                border: 1px solid #ddd;
            }

            .meal {
                page-break-inside: avoid;
            }

            .day-tabs {
                page-break-after: avoid;
                display: block;
                border: none;
            }

            .day-tab {
                display: none;
            }

            .day-tab.active {
                display: block;
                background: none;
                color: #000;
                border: none;
                font-size: 16pt;
                font-weight: bold;
                padding: 0;
                margin-bottom: 15px;
                text-align: center;
            }

            .daily-summary {
                page-break-before: avoid;
                page-break-inside: avoid;
                border: 1px solid #ddd;
                margin: 20px 0;
            }

            .modal.active {
                position: relative;
                display: block;
                background: none;
            }

            .modal-content {
                position: relative;
                width: 100%;
                max-height: none;
                box-shadow: none;
                margin: 0;
                padding: 0;
            }

            .modal-header {
                border-bottom: 2px solid #000;
                padding: 0 0 10px 0;
                margin-bottom: 15px;
            }

            .modal-body {
                padding: 0;
            }

            .food-details-section {
                page-break-inside: avoid;
                margin-bottom: 20px;
            }

            table {
                page-break-inside: avoid;
            }
        }

        .meal-icon + *:not(.meal-content) {
            display: none !important;
        }

        .meal-info::before,
        .meal-info::after,
        .meal-icon::before,
        .meal-icon::after {
            display: none !important;
            content: none !important;
        }

        .meal-icon ~ *:not(.meal-content):not(.meal-icon) {
            display: none !important;
        }

        .meal-info > *:not(.meal-icon):not(.meal-content) {
            display: none !important;
        }

        @media (max-width: 768px) {
            .meal-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
                margin-right: 10px;
            }
        }

        @media (max-width: 480px) {
            .meal-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
                margin-right: 8px;
            }
        }

        .instructions-text {
            text-align: center;
            color: #777;
            margin: 40px 0;
            font-style: italic;
            display: block; 
            font-size: 1.2rem;
        }

        /* responsive styles */
        @media (max-width: 1024px) {
            .plan-type-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .plan-type-grid {
                grid-template-columns: 1fr;
            }
            
            .meal {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .meal-info {
                width: 100%;
                margin-bottom: 15px;
            }
            
            .meal-action {
                margin-top: 15px;
                align-self: flex-end;
            }

            .day-tabs {
                overflow-x: auto;
                padding-bottom: 15px;
            }

            .day-tab {
                white-space: nowrap;
            }

            .plan-card {
                height: 160px;
            }

            .plan-card-image {
                width: 35%;
            }

            .plan-card h3 {
                font-size: 1.2rem;
                margin-bottom: 5px;
            }

            .plan-card p {
                font-size: 0.9rem;
                line-height: 1.3;
            }
        }

        @media (max-width: 480px) {
            .plan-card {
                height: 130px;
            }

            .plan-card-image {
                width: 30%;
            }

            .plan-card-content {
                padding: 15px;
            }

            .plan-card h3 {
                font-size: 1.1rem;
                margin-bottom: 5px;
            }

            .plan-card p {
                font-size: 0.8rem;
                line-height: 1.2;
            }
        }

        .daily-summary {
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .summary-item {
            text-align: center;
        }

        .summary-label {
            display: block;
            color: #6a4819;
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .summary-value {
            display: block;
            color: #b38b4f;
            font-size: 1.4rem;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .daily-summary {
                flex-direction: column;
                gap: 15px;
            }
        }

        .validation-error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 10px;
            display: none;
            text-align: center;
        }
        
        .validation-error.visible {
            display: block;
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
            <a href="DP.DF.Main.php" class="active">Diet Plans</a>
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

    <div class="container">
        <div class="page-title">
            <h1 style="font-family: 'Press Start 2P', cursive; font-size: 2rem; color: #8D7151; margin-bottom: 15px; text-shadow: 1px 1px 0 #b38b4f; animation: gentlePulse 3s infinite;">Plan Type</h1>
        </div>
        
        <div class="plan-type-grid">
            <div class="plan-card" data-plan="regular">
                <img src="images/DP.DF.1.jpg" class="plan-card-image">
                <div class="plan-card-content">
                <h3>Regular</h3>
                <p>Balanced nutrition with no dietary restrictions</p>
                </div>
            </div>
            <div class="plan-card" data-plan="keto">
                <img src="images/DP.DF.2.jpg" alt="Keto Plan" class="plan-card-image">
                <div class="plan-card-content">
                <h3>Keto</h3>
                <p>High-fat, low-carb for ketosis</p>
                </div>
            </div>
            <div class="plan-card" data-plan="vegan">
                <img src="images/DP.DF.3.png" alt="Vegan Plan" class="plan-card-image">
                <div class="plan-card-content">
                <h3>Vegan</h3>
                <p>Plant-based without animal products</p>
                </div>
            </div>
            <div class="plan-card" data-plan="vegetarian">
                <img src="images/DP.DF.4.jpg" alt="Vegetarian Plan" class="plan-card-image">
                <div class="plan-card-content">
                <h3>Vegetarian</h3>
                <p>Plant-focused with eggs and dairy</p>
                </div>
            </div>
            <div class="plan-card" data-plan="dairy-free">
                <img src="images/DP.DF.5.jpg" alt="Dairy-Free Plan" class="plan-card-image">
                <div class="plan-card-content">
                <h3>Dairy-Free</h3>
                <p>No milk, cheese, or dairy products</p>
                </div>
            </div>
            <div class="plan-card" data-plan="gluten-free">
                <img src="images/DP.DF.6.jpg" alt="Gluten-Free Plan" class="plan-card-image">
                <div class="plan-card-content">
                <h3>Gluten-Free</h3>
                <p>No wheat, barley, or rye products</p>
                </div>
            </div>
        </div>

        <div class="instructions-text" id="plan-instructions">
            Please select a plan type to view the meal plan.
        </div>

        <div class="meal-plan-section" id="meal-plan-section">
            <h3>7-Day Meal Plan</h3>
            
            <div class="day-tabs">
                <div class="day-tab active" data-day="monday">Monday</div>
                <div class="day-tab" data-day="tuesday">Tuesday</div>
                <div class="day-tab" data-day="wednesday">Wednesday</div>
                <div class="day-tab" data-day="thursday">Thursday</div>
                <div class="day-tab" data-day="friday">Friday</div>
                <div class="day-tab" data-day="saturday">Saturday</div>
                <div class="day-tab" data-day="sunday">Sunday</div>
            </div>

            <div class="meals-container">
                <!-- Breakfast -->
                <div class="meal">
                    <div class="meal-info">
                        <div class="meal-icon">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <div class="meal-content">
                            <div class="meal-type">Breakfast</div>
                            <div class="meal-items">
                            </div>
                            <div class="meal-details">
                                <span>0 calories</span>
                                <span>RM0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="meal-action">
                        <button class="details-btn">Details</button>
                    </div>
                </div>

                <!-- Lunch -->
                <div class="meal">
                    <div class="meal-info">
                        <div class="meal-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="meal-content">
                            <div class="meal-type">Lunch</div>
                            <div class="meal-items">
                            </div>
                            <div class="meal-details">
                                <span>0 calories</span>
                                <span>RM0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="meal-action">
                        <button class="details-btn">Details</button>
                    </div>
                </div>

                <!-- Dinner -->
                <div class="meal">
                    <div class="meal-info">
                        <div class="meal-icon">
                            <i class="fas fa-moon"></i>
                        </div>
                        <div class="meal-content">
                            <div class="meal-type">Dinner</div>
                            <div class="meal-items">
                            </div>
                            <div class="meal-details">
                                <span>0 calories</span>
                                <span>RM0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="meal-action">
                        <button class="details-btn">Details</button>
                    </div>
                </div>

                <!-- Snacks -->
                <div class="meal">
                    <div class="meal-info">
                        <div class="meal-icon">
                            <i class="fas fa-apple-alt"></i>
                        </div>
                        <div class="meal-content">
                            <div class="meal-type">Snacks</div>
                            <div class="meal-items">
                            </div>
                            <div class="meal-details">
                                <span>0 calories</span>
                                <span>RM0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="meal-action">
                        <button class="details-btn">Details</button>
                    </div>
                </div>
            </div>
            
            <div class="daily-summary">
                <div class="summary-item">
                    <span class="summary-label">Total Daily Calories:</span>
                    <span class="summary-value">0 calories</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Estimated Daily Cost:</span>
                    <span class="summary-value">RM0.00</span>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="action-btn export-btn" id="exportPdfBtn"><i class="fas fa-file-pdf"></i> Export as PDF</button>
            </div>
        </div>

        <!-- Export Modal -->
        <div class="modal" id="exportModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Export as PDF</h3>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="export-options">
                        <div class="export-option">
                            <h4>Content to Include</h4>
                            <div class="option-group">
                                <label>
                                    <input type="checkbox" name="includeContent" value="mealPlan" checked>
                                    Meal Plan
                                </label>
                                <label>
                                    <input type="checkbox" name="includeContent" value="nutritionInfo" checked>
                                    Nutrition Information
                                </label>
                                <label>
                                    <input type="checkbox" name="includeContent" value="groceryList" checked>
                                    Grocery Lists
                                </label>
                                <label>
                                    <input type="checkbox" name="includeContent" value="cookingInstructions">
                                    Cooking Instructions
                                </label>
                            </div>
                            </div>
                            </div>
                            </div>
                <div class="modal-footer">
                    <button class="modal-btn modal-save-btn" id="confirmExportBtn">Export</button>
                    <button class="modal-btn modal-cancel-btn">Cancel</button>
                            </div>
                <div class="validation-error" id="exportValidationError">
                    Please select at least one content option to include in the PDF.
                </div>
                        </div>
                    </div>

        <!-- Food Details Modal -->
        <div class="modal" id="foodDetailsModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Food Details</h3>
                    <button class="close-modal">&times;</button>
                    </div>
                <div class="modal-body">
                    <div class="nutrition-section">
                        <h4 class="section-title">Nutrition Information</h4>
                                <table class="nutrition-table">
                                    <thead>
                                        <tr>
                                            <th><strong>Item</strong></th>
                                            <th><strong>Quantity</strong></th>
                                            <th><strong>Calories</strong></th>
                                            <th><strong>Price (MYR)</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Avocado Toast</td>
                                            <td>1 slice</td>
                                            <td>250 kcal</td>
                                            <td>RM 7.00</td>
                                        </tr>
                                        <tr>
                                            <td>Boiled Eggs</td>
                                            <td>2 eggs</td>
                                            <td>140 kcal</td>
                                            <td>RM 0.80</td>
                                        </tr>
                                        <tr>
                                            <td>Orange Juice</td>
                                            <td>250 ml</td>
                                            <td>110 kcal</td>
                                            <td>RM 2.00</td>
                                        </tr>
                                        <tr class="total-row">
                                            <td><strong>Total</strong></td>
                                            <td></td>
                                            <td><strong>500 kcal</strong></td>
                                            <td><strong>RM 9.80</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                    </div>

                    <div class="grocery-section">
                        <h4 class="section-title">Grocery List</h4>
                                <table class="grocery-table">
                                    <thead>
                                        <tr>
                                            <th><strong>Item</strong></th>
                                            <th><strong>Quantity</strong></th>
                                            <th><strong>Notes</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Avocado</td>
                                            <td>1 ripe avocado</td>
                                            <td>Choose one that's slightly soft</td>
                                        </tr>
                                        <tr>
                                            <td>Bread (Whole Grain)</td>
                                            <td>2 slices</td>
                                            <td>Or multigrain toast</td>
                                        </tr>
                                        <tr>
                                            <td>Eggs</td>
                                            <td>2</td>
                                            <td>Any size (Grade A or B)</td>
                                        </tr>
                                        <tr>
                                            <td>Orange Juice</td>
                                            <td>1 small bottle (250 ml)</td>
                                            <td>Or buy fresh oranges (2–3)</td>
                                        </tr>
                                        <tr>
                                            <td>Optional: Salt, Pepper, Lemon</td>
                                            <td>–</td>
                                            <td>For seasoning the avocado toast</td>
                                        </tr>
                                    </tbody>
                                </table>
                    </div>

                    <div class="food-details-section">
                        <h4 class="section-title">Cooking Instructions</h4>
                                <div class="cooking-item">
                                    <h6>🥑 Avocado Toast</h6>
                                    <p><strong>Ingredients:</strong></p>
                                    <ul>
                                        <li>1 slice of whole grain bread</li>
                                        <li>½ ripe avocado</li>
                                        <li>Salt and pepper to taste</li>
                                        <li>Optional: Lemon juice or chili flakes</li>
                                    </ul>
                                    <p><strong>Instructions:</strong></p>
                                    <ol>
                                        <li>Toast the bread until golden and crispy.</li>
                                        <li>Cut the avocado in half, remove the seed, and scoop out the flesh into a bowl.</li>
                                        <li>Mash the avocado with a fork and season with a pinch of salt, pepper, and a squeeze of lemon.</li>
                                        <li>Spread the mashed avocado on the toast.</li>
                                        <li>Optional toppings: Sliced cherry tomatoes, poached egg, or chili flakes.</li>
                                    </ol>
                                </div>
                        
                                <div class="cooking-item">
                                    <h6>🥚 Boiled Eggs</h6>
                                    <p><strong>Ingredients:</strong></p>
                                    <ul>
                                        <li>2 eggs</li>
                                        <li>Water</li>
                                        <li>Optional: Salt</li>
                                    </ul>
                                    <p><strong>Instructions:</strong></p>
                                    <ol>
                                        <li>Place eggs in a small pot and cover with water.</li>
                                        <li>Bring the water to a boil over medium heat.</li>
                                        <li>Once boiling, reduce heat and simmer:
                                            <ul>
                                                <li>6–7 minutes for soft-boiled</li>
                                                <li>10–12 minutes for hard-boiled</li>
                                            </ul>
                                        </li>
                                        <li>Remove eggs and place in cold water for 2–3 minutes.</li>
                                        <li>Peel and serve with a little salt if desired.</li>
                                    </ol>
                                </div>
                        
                                <div class="cooking-item">
                                    <h6>🍊 Orange Juice</h6>
                                    <p><strong>Option 1: Store-bought</strong></p>
                                    <ul>
                                        <li>Just pour 250 ml of chilled juice into a glass.</li>
                                    </ul>
                                    <p><strong>Option 2: Freshly squeezed</strong></p>
                                    <ol>
                                        <li>Cut 2–3 oranges in half and squeeze out the juice using a citrus press or by hand.</li>
                                        <li>Strain if you prefer pulp-free juice.</li>
                                    </ol>
                                </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="modal-btn modal-save-btn" id="closeModalBtn">Close</button>
                </div>
                </div>
                </div>
                </div>

    <script src="DP.DF.Main.js"></script>
    
    <script src="DP.DF.simple.js"></script>


    <script>
        // close food details modal
        document.addEventListener('DOMContentLoaded', function() {
            const closeModalButtons = document.querySelectorAll('.close-modal');
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = button.closest('.modal');
                    if (modal) {
                        modal.classList.remove('active');
                    }
                });
            });
            
            const closeModalBtn = document.getElementById('closeModalBtn');
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    document.getElementById('foodDetailsModal').classList.remove('active');
                });
            }

            // PDF function
            const exportPdfBtn = document.getElementById('exportPdfBtn');
            const exportModal = document.getElementById('exportModal');
            
            if (exportPdfBtn && exportModal) {
                // Open export modal
                exportPdfBtn.addEventListener('click', function() {
                    exportModal.classList.add('active');
                });
                
                // Close export modal
                const cancelButtons = exportModal.querySelectorAll('.modal-cancel-btn');
                cancelButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        exportModal.classList.remove('active');
                    });
                });
                
                // Generate, download PDF 
                const confirmExportBtn = document.getElementById('confirmExportBtn');
                if (confirmExportBtn) {
                    confirmExportBtn.addEventListener('click', function() {
                        // Check if at least one content option is selected
                        const includeMealPlan = document.querySelector('input[value="mealPlan"]').checked;
                        const includeNutrition = document.querySelector('input[value="nutritionInfo"]').checked;
                        const includeGrocery = document.querySelector('input[value="groceryList"]').checked;
                        const includeCooking = document.querySelector('input[value="cookingInstructions"]').checked;
                        
                        const validationError = document.getElementById('exportValidationError');
                        if (!(includeMealPlan || includeNutrition || includeGrocery || includeCooking)) {
                            if (validationError) {
                                validationError.classList.add('visible');
                            }
                            return; 
                        }
                        
                        if (validationError) {
                            validationError.classList.remove('visible');
                        }
                        
                        generatePDF();
                        exportModal.classList.remove('active');
                    });
                }
            }
            
            // generate and download PDF
            function generatePDF() {
                const activePlanCard = document.querySelector('.plan-card.active');
                const activeDayTab = document.querySelector('.day-tab.active');
                
                if (!activePlanCard || !activeDayTab) {
                    alert('Please select a plan and day first.');
                    return;
                }
                
                const planType = activePlanCard.getAttribute('data-plan');
                const day = activeDayTab.getAttribute('data-day');
                
                // Get content options
                const includeMealPlan = document.querySelector('input[value="mealPlan"]').checked;
                const includeNutrition = document.querySelector('input[value="nutritionInfo"]').checked;
                const includeGrocery = document.querySelector('input[value="groceryList"]').checked;
                const includeCooking = document.querySelector('input[value="cookingInstructions"]').checked;
                
                // Initialize jsPDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                let yPosition = 20;
                const leftMargin = 15;
                
                // Add title to PDF
                doc.setFontSize(18);
                doc.setFont(undefined, 'bold');
                doc.text(`${planType.charAt(0).toUpperCase() + planType.slice(1)} Diet Plan - ${day.charAt(0).toUpperCase() + day.slice(1)}`, leftMargin, yPosition);
                yPosition += 15;
                
                // Add meals section if included
                if (includeMealPlan) {
                    doc.setFontSize(14);
                    doc.setFont(undefined, 'bold');
                    doc.text('Meal Plan', leftMargin, yPosition);
                    yPosition += 10;
                    doc.setFontSize(10);
                    doc.setFont(undefined, 'normal');
                    
                    // Get meal data
                    const meals = document.querySelectorAll('.meal');
                    meals.forEach((meal, index) => {
                        const mealType = meal.querySelector('.meal-type').textContent;
                        doc.setFont(undefined, 'bold');
                        doc.text(mealType, leftMargin, yPosition);
                        yPosition += 5;
                        
                        doc.setFont(undefined, 'normal');
                        
                        // Get items
                        const mealItems = meal.querySelectorAll('.meal-item');
                        let itemsText = '';
                        mealItems.forEach(item => {
                            itemsText += `- ${item.textContent}, `;
                        });
                        
                        // Trim trailing comma
                        itemsText = itemsText.substring(0, itemsText.length - 2);
                        
                        // Split text into lines if too long
                        const splitText = doc.splitTextToSize(itemsText, 180);
                        doc.text(splitText, leftMargin, yPosition);
                        yPosition += splitText.length * 5;
                        
                        // Add calories and price
                        const details = meal.querySelector('.meal-details');
                        if (details) {
                            const detailsText = details.textContent.trim().replace(/\s+/g, ' ');
                            doc.text(detailsText, leftMargin, yPosition);
                            yPosition += 10;
                        }
                        
                        if (index < meals.length - 1) {
                            yPosition += 5;
                        }
                        
                        if (yPosition > 270) {
                            doc.addPage();
                            yPosition = 20;
                        }
                    });
                    
                    // Daily summary
                    const dailySummary = document.querySelector('.daily-summary');
                    if (dailySummary) {
                        yPosition += 5;
                        doc.setFont(undefined, 'bold');
                        doc.text('Daily Summary', leftMargin, yPosition);
                        yPosition += 5;
                        
                        doc.setFont(undefined, 'normal');
                        const summaryItems = dailySummary.querySelectorAll('.summary-item');
                        summaryItems.forEach(item => {
                            const label = item.querySelector('.summary-label').textContent;
                            const value = item.querySelector('.summary-value').textContent;
                            doc.text(`${label} ${value}`, leftMargin, yPosition);
                            yPosition += 5;
                        });
                        
                        yPosition += 10;
                    }
                }
                
                if (includeNutrition || includeGrocery || includeCooking) {
                    if (yPosition > 200) {
                        doc.addPage();
                        yPosition = 20;
                    }
                    
                    // Get data from the mealPlans object 
                    if (window.mealPlans && window.mealPlans[planType] && window.mealPlans[planType][day]) {
                        const planData = window.mealPlans[planType][day];
                        
                        // Process each meal type
                        ['breakfast', 'lunch', 'dinner', 'snack'].forEach((mealType, index) => {
                            const mealData = planData[mealType];
                            if (!mealData) return;

                            if (yPosition > 250) {
                                doc.addPage();
                                yPosition = 20;
                            }

                            doc.setFontSize(14);
                            doc.setFont(undefined, 'bold');
                            doc.text(mealData.title || `${mealType.charAt(0).toUpperCase() + mealType.slice(1)}`, leftMargin, yPosition);
                            yPosition += 10;
                            doc.setFontSize(10);
                            
                            if (includeNutrition) {
                                doc.setFont(undefined, 'bold');
                                doc.text('Nutrition Information', leftMargin, yPosition);
                                yPosition += 5;
                                doc.setFont(undefined, 'normal');
                                
                                doc.text('Item', leftMargin, yPosition);
                                doc.text('Calories', leftMargin + 100, yPosition);
                                doc.text('Price', leftMargin + 130, yPosition);
                                yPosition += 5;
                                
                                mealData.items.forEach(item => {
                                    if (yPosition > 270) {
                                        doc.addPage();
                                        yPosition = 20;
                                    }
                                    
                                    const itemName = typeof item === 'string' ? item : item.name;
                                    doc.text(itemName, leftMargin, yPosition);
                                    doc.text(`${Math.round(mealData.calories / mealData.items.length)} kcal`, leftMargin + 100, yPosition);
                                    doc.text(`RM ${(mealData.price / mealData.items.length).toFixed(2)}`, leftMargin + 130, yPosition);
                                    yPosition += 5;
                                });
                                
                                doc.text(`Total: ${mealData.calories} kcal, RM ${mealData.price.toFixed(2)}`, leftMargin, yPosition);
                                yPosition += 10;
                            }
                            
                            // Add grocery list if included
                            if (includeGrocery && mealData.groceryList) {
                                if (yPosition > 250) {
                                    doc.addPage();
                                    yPosition = 20;
                                }
                                
                                doc.setFont(undefined, 'bold');
                                doc.text('Grocery List', leftMargin, yPosition);
                                yPosition += 5;
                                doc.setFont(undefined, 'normal');
                                
                                mealData.groceryList.forEach(item => {
                                    if (yPosition > 270) {
                                        doc.addPage();
                                        yPosition = 20;
                                    }
                                    
                                    doc.text(`- ${item.item} (${item.quantity})${item.notes ? ' - ' + item.notes : ''}`, leftMargin, yPosition);
                                    yPosition += 5;
                                });
                                
                                yPosition += 5;
                            }
                            
                            // Add cooking instructions if included
                            if (includeCooking && mealData.cookingInstructions) {
                                if (yPosition > 230) {
                                    doc.addPage();
                                    yPosition = 20;
                                }
                                
                                doc.setFont(undefined, 'bold');
                                doc.text('Cooking Instructions', leftMargin, yPosition);
                                yPosition += 5;
                                doc.setFont(undefined, 'normal');
                                
                                mealData.cookingInstructions.forEach(recipe => {
                                    if (yPosition > 260) {
                                        doc.addPage();
                                        yPosition = 20;
                                    }
                                    
                                    doc.setFont(undefined, 'bold');
                                    doc.text(recipe.title || 'Recipe', leftMargin, yPosition);
                                    yPosition += 5;
                                    doc.setFont(undefined, 'normal');
                                    
                                    // Ingredients
                                    doc.text('Ingredients:', leftMargin, yPosition);
                                    yPosition += 5;
                                    
                                    recipe.ingredients.forEach(ingredient => {
                                        if (yPosition > 270) {
                                            doc.addPage();
                                            yPosition = 20;
                                        }
                                        
                                        doc.text(`- ${ingredient}`, leftMargin + 5, yPosition);
                                        yPosition += 5;
                                    });
                                    
                                    yPosition += 3;
                                    
                                    // Instructions
                                    doc.text('Instructions:', leftMargin, yPosition);
                                    yPosition += 5;
                                    
                                    recipe.instructions.forEach((instruction, i) => {
                                        if (yPosition > 270) {
                                            doc.addPage();
                                            yPosition = 20;
                                        }
                                        
                                        const splitText = doc.splitTextToSize(`${i + 1}. ${instruction}`, 180);
                                        doc.text(splitText, leftMargin + 5, yPosition);
                                        yPosition += splitText.length * 5;
                                    });
                                    
                                    yPosition += 5;
                                });
                            }
                            
                            yPosition += 10;
                        });
                    }
                }
                
                // Generate filename with plan type and day
                const filename = `${planType}-diet-plan-${day}.pdf`;
                
                doc.save(filename);
            }
            
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
    <script src="DP.DF.Main.js"></script>
    <script src="DP.DF.simple.js"></script>

    <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
