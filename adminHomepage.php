<!--
Programmer Name : Serene Loh Zi Ting (TP075920)
Program Name    : adminHomepage.php
Description     : Admin Dashboard for RUNTIME FITNESS
First Written on: Tuesday, 01-July-2025
Edited on: Saturday, 12-July-2025
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - RUNTIME FITNESS</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #fdf8f2;
            color: #333;
            line-height: 1.6;
            animation: fadeInBody 1s ease-in;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        @keyframes fadeInBody {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        header {
            background-color: #fff;
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-title {
            font-size: 1.6rem;
            font-weight: bold;
            color: #836953;
        }
        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .nav-buttons span {
            font-weight: 500;
        }
        .logout {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            cursor: pointer;
        }
        .dashboard-container {
            padding: 3rem 8%;
            flex: 1;
        }
        .dashboard-header {
            font-size: 2.2rem;
            color: #4d3d36;
            margin-bottom: 1.5rem;
            animation: slideIn 1s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateX(-40px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            animation: fadeInCards 1.2s ease;
        }
        @keyframes fadeInCards {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.07);
            transition: 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin-bottom: 1rem;
            color: #5a4033;
        }
        .card p {
            font-size: 0.95rem;
            color: #333;
        }
        .card button {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: #836953;
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .card button:hover {
            background-color: #a5836b;
        }
        footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #fff7f1;
            color: #7c6b60;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="nav-title">RUNTIME Admin Panel</div>
        <div class="nav-buttons">
            <span>Welcome back, <strong>Admin</strong></span> <!--I USE THE HARDCODED ADMIN-->
            <!--no more profile for admin-->
            <form action="homepage.php" method="POST">
                <button class="logout">Logout</button>
            </form>
        </div>
    </header>

    <section class="dashboard-container">
        <h1 class="dashboard-header">Admin Dashboard</h1>
        <div class="dashboard-grid">
            <div class="card">
                <h3>View Member Profiles</h3>
                <p>Browse all registered users, edit profiles, or deactivate accounts.</p>
                <button onclick="window.location.href='view_members.php'">View Members</button>
            </div>

            <div class="card">
                <h3>Registration Report</h3>
                <p>Generate the number of members registered — weekly, monthly, or annually.</p>
                <button onclick="window.location.href='report_registration.php'">Generate Report</button>
            </div>

            <div class="card">
                <h3>Activity Report</h3>
                <p>Check how many members actively tracked progress in a time frame.</p>
                <button onclick="window.location.href='report_activity.php'">Generate Report</button>
            </div>
        </div>
    </section>

    <footer>
        &copy; 2025 RUNTIME FITNESS Admin Portal. All rights reserved.
    </footer>
</body>
</html>
