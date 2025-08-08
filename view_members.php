<!--
Programmer Name : Yong Xuan Lyn (TP076797)
Program Name    : view_members.php
Description     : Allow admin to view all registered members
First Written on: Wednesday, 09-July-2025
Edited on: Saturday, 12-July-2025
-->

<?php
session_start();
include 'config.php';

$result = mysqli_query($con, "SELECT usr_user_id, usr_username, usr_email, usr_phone FROM users");
if(!$result) {
    die("Query failed: " . mysqli_error($con));
}
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<html lang="en">
<head>    
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        header {
            background-color: #fff;
            padding: 1.3rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 90%;
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

        body {
            background: #fdf8f2;
            margin: 0%;
            font-family: sans-serif;
        }

        .dashboard-container {
            padding: 3rem 8%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        th, td{
            padding: 1rem;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #e5d5c5;
            color: #5a4033
        }

        tr:hover {
            background-color: #f9f1e7;
        }

        h2 {
            color: #4d3d36;
        }

        a:link, a:visited {
            color: #836953;
            text-decoration: none;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #fff7f1;
            margin-top: 2rem;
            color: #7c6b60;
        }

        .home-icon {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(106, 72, 25, 0.15);
            color: #8D7151;
            text-decoration: none;
            font-size: 22px;
            transition: all 0.3s ease;
            z-index: 2001;
            border: 2px solid rgba(141, 113, 81, 0.1);
        }
        .home-icon:hover {
            color: #fff;
            background-color: #8D7151;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(106, 72, 25, 0.2);
        }
        .home-icon:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(106, 72, 25, 0.15);
        }
    </style>
</head>
<body>
    <a href="adminHomepage.php" class="home-icon" title="Back to Admin Home" tabindex="0">
        <i class="fas fa-home"></i>
    </a>

    <header>
        <div></div>
        <div class="nav-buttons">
            <form action="homepage.php" method="POST">
                <button class="logout">Logout</button>
            </form>
        </div>
    </header>

    <section class="dashboard-container">
    <h2>Registered Member Profiles</h2>
    <table>
        <tr><th>ID</th><th>Username</th><th>Email</th><th>Phone Number</th><th>Action</th></tr>
        <?php foreach ($users as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['usr_user_id']) ?></td>
            <td><?= htmlspecialchars($row['usr_username']) ?></td>
            <td><?= htmlspecialchars($row['usr_email']) ?></td>
            <td><?= htmlspecialchars($row['usr_phone']) ?></td>
            <td>
                <a href="edit_member.php?id=<?= $row['usr_user_id'] ?>">Edit</a> |
                <a href="deactivate_member.php?id=<?= $row['usr_user_id'] ?>" onclick="return confirm('Are you sure that you want to delete this member? This action cannot be reversed.')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </section>
    <footer>
        &copy; 2025 RUNTIME FITNESS Admin Portal. All rights reserved.
    </footer>
</body>
</html>
