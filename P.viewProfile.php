<!--
Programmer Name : Yap Xin Ling (TP077224)
Program Name    : P.viewProfile.php
Description     : Allow the user of the system to view their profile
First Written on: Friday, 13-June-2025
-->

<?php
    session_start();
    include 'config.php';

    if (!isset($_SESSION['usr_user_id'])) {
        echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
        exit;
    }

    $userID = $_SESSION['usr_user_id'];

    // Join both user and memberprofile tables
    $sql = "
        SELECT 
            u.usr_username, u.usr_full_name, u.usr_email, u.usr_phone, u.usr_role,
            m.mbp_dob, m.mbp_gender, m.mbp_height, m.mbp_weight, m.mbp_goal
        FROM users u
        LEFT JOIN member_profiles m ON u.usr_user_id = m.mbp_user_ID
        WHERE u.usr_user_id = ?
    ";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    if (!$userData) {
        echo "<script>alert('User profile not found.'); window.location.href='login.php';</script>";
        exit;
    }

    $userDataJson = json_encode([
        'username' => $userData['usr_username'],
        'fullName' => $userData['usr_full_name'],
        'email' => $userData['usr_email'],
        'phone' => $userData['usr_phone'],
        'dob' => $userData['mbp_dob'],
        'gender' => $userData['mbp_gender'],
        'height' => $userData['mbp_height'],
        'weight' => $userData['mbp_weight'],
        'goal' => $userData['mbp_goal'],
        'role' => $userData['usr_role']
    ]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runtime Fitness - View Profile</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="P.profile.css">
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.7/build/spline-viewer.js"></script>
</head>

<body>
    <a href="memberHomepage.php" class="home-icon" title="BACK TO MAIN PAGE">
        <i class="fas fa-home"></i>
    </a>

    <div class="profile-container">
        <div class="avatar-section">
            <spline-viewer id="spline-avatar" events-target="global"></spline-viewer>
        </div>

        <div class="user-details">
            <div class="input-group">
                <label for="username">USERNAME</label>
                <input type="text" id="username" value="" readonly />
            </div>
            <div class="input-group">
                <label for="fullName">FULL NAME</label>
                <input type="text" id="fullName" value="" readonly />
            </div>
            <div class="input-group">
                <label for="email">EMAIL</label>
                <input type="email" id="email" value="" readonly />
            </div>
            <div class="input-group">
                <label for="phone">PHONE</label>
                <input type="tel" id="phone" value="" readonly />
            </div>
            <div class="input-group">
                <label for="dob">DATE OF BIRTH</label>
                <input type="text" id="dob" readonly />
            </div>
            <div class="input-group">
                <label for="gender">GENDER</label>
                <input type="text" id="gender" readonly />
            </div>
            <div class="input-group">
                <label for="height">HEIGHT</label>
                <input type="number" id="height" readonly />
            </div>
            <div class="input-group">
                <label for="weight">WEIGHT</label>
                <input type="number" id="weight" readonly />
            </div>
            <div class="input-group">
                <label for="goal">FITNESS GOAL</label>
                <input type="text" id="goal" readonly />
            </div>
        </div>

        <button class="edit-btn" onclick="toggleEdit()">EDIT</button>
    </div>

    <script>
        const userData = <?php echo $userDataJson; ?>;

        document.addEventListener("DOMContentLoaded", () => {
            updateProfile(userData);
        });

        function updateProfile(data) {
            document.getElementById("username").value = data.username;
            document.getElementById("fullName").value = data.fullName;
            document.getElementById("email").value = data.email;
            document.getElementById("phone").value = data.phone;
            document.getElementById("dob").value = data.dob;
            document.getElementById("gender").value = data.gender;
            document.getElementById("height").value = data.height;
            document.getElementById("weight").value = data.weight;
            document.getElementById("goal").value = data.goal;

            loadAvatar(data.role, data.gender);
        }

        function loadAvatar(role, gender) {
            const viewer = document.getElementById("spline-avatar");
            let url = "";

            if (role === "member") {
                url = gender === "female"
                    ? "https://prod.spline.design/zQQIvkTiRez2eqPg/scene.splinecode"
                    : "https://prod.spline.design/nam4RXFcB01Zdnz1/scene.splinecode";
                viewer.setAttribute("url", url);
            }
        }

        function toggleEdit() {
            window.location.href = "P.editProfile.php";
        }
    </script>
</body>
</html>
