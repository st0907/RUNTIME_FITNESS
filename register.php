<!--
Programmer Name : Yap Xin Ling (TP077224), Sim Tian (TP077056)
Program Name    : register.php
Description     : PHP - Member Registration Form
First Written on: Monday, 26-May-2025
Edited on : Sunday, 13-July-2025
-->

<?php
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//xlyn: added column 'user_reg_date' in users. auto records registration timestamp.
function sanitize($data, $con) {
    return mysqli_real_escape_string($con, trim($data));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get and sanitize form data
    $username = sanitize($_POST['username'], $con);
    $fullName = sanitize($_POST['fullName'], $con);
    $email = sanitize($_POST['email'], $con);
    $phone = sanitize($_POST['phone'], $con);
    $password = sanitize($_POST['password'], $con);
    $confirmPassword = sanitize($_POST['confirmPassword'], $con);
    $securityKeyword = sanitize($_POST['security_keyword'], $con);
    $role = 'member'; // Fixed as member

    // Password match check
    if ($password !== $confirmPassword) {
        echo "<script>
                alert('Passwords do not match.');
                window.location.replace('register.php');
            </script>";
        exit;
    }

    // Username uniqueness check
    $checkUserQuery = "SELECT * FROM users WHERE usr_username = '$username'";
    $result = $con->query($checkUserQuery);
    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username already taken.');
                window.location.replace('register.php');
            </script>";
        exit;
    }

    // Insert into users table
    $stmt = $con->prepare("INSERT INTO users (usr_username, usr_full_name, usr_email, usr_phone, usr_password, usr_security_keyword, usr_role) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $fullName, $email, $phone, $password, $securityKeyword, $role);

    if ($stmt->execute()) {
        $userID = $stmt->insert_id;

        // Get and validate member fields
        $dobInput = $_POST['dob'];
        $dob = DateTime::createFromFormat('d/m/Y', $dobInput);
        if (!$dob) {
            echo "<script>
                    alert('Invalid date format. Please use DD/MM/YYYY.');
                    window.location.replace('register.php');
                  </script>";
            exit;
        }
        $dobFormatted = $dob->format('Y-m-d');
        $gender = sanitize($_POST['gender'], $con);
        $height = (float) $_POST['height'];
        $weight = (float) $_POST['weight'];
        $goal = sanitize($_POST['goal'], $con);

        // Insert into member_profiles table
        $stmt_member = $con->prepare("INSERT INTO member_profiles (mbp_user_ID, mbp_dob, mbp_gender, mbp_height, mbp_weight, mbp_goal) 
                                      VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_member->bind_param("issdds", $userID, $dobFormatted, $gender, $height, $weight, $goal);

        if ($stmt_member->execute()) {
            echo "<script>
                    alert('Registration successful!');
                    window.location.replace('login.html');
                </script>";
        } else {
            echo "<script>
                    alert('Member profile insert failed: " . $stmt_member->error . "');
                    window.location.replace('register.php');
                  </script>";
        }
    } else {
        echo "<script>
                alert('User insert failed: " . $stmt->error . "');
                window.location.replace('register.php');
              </script>";
    }

    $con->close();
    exit; // Exit after POST processing
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runtime Fitness - Registration</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="register.css">
    <style>
        .role-selection-header {
            text-align: center;
            margin-bottom: 20px;
            animation: fadeIn 0.8s ease-out;
        }

        .role-selection-header h1 {
            color: #8D7151;
            font-size: 2.2rem;
            margin-bottom: 8px;
        }

        .role-selection-header p {
            color: #6a4819;
            font-size: 1rem;
            opacity: 0.8;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .role-container {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-container {
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .date-input-container {
            position: relative;
            display: inline-block;
        }

        .styled-input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }

        .calendar-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            color: #777;
        }

        .role-box {
            pointer-events: none;
            cursor: default !important;
        }
        .role-box:hover, .role-box:active, .role-box:focus {
            box-shadow: none !important;
            border: none !important;
            background: none !important;
            transform: none !important;
        }
    </style>
</head>
<body>
    <a href="HomePage.php" class="home-icon" title="BACK TO MAIN PAGE">
        <i class="fas fa-home"></i>
    </a>
    <div class="role-container" style="margin-bottom: 20px; text-align: center;">
        <div class="role-box">
            <img src="images/reg.member.png" alt="Member" class="default-img">
            <span>MEMBER</span>
            <div class="role-description">Join us to get fit-tastic!</div>
        </div>
        <div class="role-box">
            <img src="images/reg.coach.png" alt="Coach" class="default-img">
            <span>WORKOUT</span>
            <div class="role-description">Wanna lift? Let's go!</div>
        </div>
        <div class="role-box">
            <img src="images/reg.nutritionist.png" alt="Nutritionist" class="default-img">
            <span>DIET PLAN</span>
            <div class="role-description">Fork it, eat healthy!</div>
        </div>
    </div>
    <div class="container">
        <div class="register-container">
            <h1 class="register-title">REGISTRATION</h1>
            <form id="registrationForm" action="register.php" method="POST" enctype="multipart/form-data" onsubmit="validateForm(event)" novalidate>
                <input type="hidden" name="role" value="member">
    
                <div class="user-details">
                    <div class="input-group">
                        <input type="text" id="username" name="username" 
                            pattern="[\w]{5,15}" 
                            placeholder="USERNAME" required>
                        <span class="message error" id="usernameError" style="display: none;">Username must be 5-15 characters, letters/numbers/underscores only</span>
                    </div>
                    <div class="input-group">
                        <input type="text" id="fullName" name="fullName" 
                            pattern="[A-Za-z\s]+" 
                            placeholder="FULL NAME" required>
                        <span class="message error" id="fullnameError" style="display: none;">Full name must contain only letters and spaces</span>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="EMAIL" required>
                        <span class="message error" id="emailError" style="display: none;">Invalid email format</span>
                    </div>
                    <div class="input-group">
                        <input type="tel" id="phone" name="phone" placeholder="PHONE" 
                            pattern="[0-9]{3}-[0-9]{7,8}"
                            required>
                        <span class="message error" id="phoneError" style="display: none;">Please match the format such as 012-3456789 or 011-23456789</span>
                    </div>
                    <div class="input-group password-group">
                        <div class="password-flex">
                            <input type="password" id="password" name="password" placeholder="PASSWORD"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\-_\.@*]{8,}$" 
                                title="Password must be at least 8 characters, contain both letters and numbers, and only these symbols: -_.@*" 
                                required>
                            <i class="password-toggle fas fa-eye" onclick="togglePassword('password', this)"></i>
                        </div>
                        <span class="message error" id="passwordError" style="display: none;">Password must be at least 8 characters with uppercase, lowercase, number, and special character</span>
                    </div>
                    <div class="input-group password-group">
                        <div class="password-flex">
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="CONFIRM PASSWORD" 
                            title="Confirm Password must match Password" required>
                            <i class="password-toggle fas fa-eye" onclick="togglePassword('confirmPassword', this)"></i>
                        </div>
                        <span class="message error" id="confirmPasswordError" style="display: none;">Passwords do not match</span>
                    </div>
                    <div class="input-group password-group">
                        <div class="password-flex">
                            <input type="password" id="securityKeyword" name="security_keyword" placeholder="SECURITY KEYWORD" required>
                            <i class="password-toggle fas fa-eye" onclick="togglePassword('securityKeyword', this)"></i>
                        </div>
                        <span class="message error" id="securityKeywordError" style="display: none;">Security keyword must be at least 5 characters</span>
                    </div>
                    <div class="input-group">
                        <div class="date-input-container">
                            <input type="text" id="dob" name="dob" class="styled-input" placeholder="DATE OF BIRTH">
                            <i class="calendar-icon fas fa-calendar-alt"></i>
                        </div>
                        <span class="message error" id="dobError" style="display: none;">Date of birth is required</span>
                    </div>
                    <div class="input-group">
                        <select id="gender" name="gender" class="form-select">
                            <option value="" disabled selected hidden>GENDER</option>
                            <option value="male">MALE</option>
                            <option value="female">FEMALE</option>
                        </select>
                        <span class="message error" id="genderError" style="display: none;">Gender is required</span>
                    </div>
                    <div class="input-group">
                        <input type="number" step="0.01" name="height" placeholder="HEIGHT (cm)" min="90" max="250">
                        <span class="message error" id="heightError" style="display: none;">Height must be between 90 to 250 cm</span>
                    </div>
                    <div class="input-group">
                        <input type="number" step="0.01" name="weight" placeholder="WEIGHT (kg)" min="25" max="300">
                        <span class="message error" id="weightError" style="display: none;">Weight must be between 25 to 300 kg</span>
                    </div>
                    <div class="input-group">
                        <select id="goal" name="goal" class="form-select" required>
                            <option value="" disabled selected hidden>FITNESS GOAL</option>
                            <option value="Lose Weight">LOSE WEIGHT</option>
                            <option value="Maintain Weight">MAINTAIN WEIGHT</option>
                            <option value="Gain Weight">GAIN WEIGHT</option>
                        </select>
                        <span class="message error" id="goalError" style="display: none;">Fitness goal is required</span>
                    </div>
                </div>

                <button type="submit" class="submit-btn">REGISTER</button>
                
                <div class="links">
                    <div style="text-align: center">
                        <span style="color: #b38b4f; font-size: 14px;">Already have an account? <a href="login.html" style="color: #b38b4f; text-decoration: underline; cursor: pointer;">LOGIN</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Date picker functionality
            const dobInput = document.getElementById('dob');
            const calendarIcon = document.querySelector('.calendar-icon');
            
            // Set today as max date
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1;
            let dd = today.getDate();
            
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            
            const maxDate = yyyy + '-' + mm + '-' + dd;
            
            // Create hidden date input for actual date picking
            const hiddenDateInput = document.createElement('input');
            hiddenDateInput.type = 'date';
            hiddenDateInput.style.position = 'absolute';
            hiddenDateInput.style.opacity = '0';
            hiddenDateInput.style.height = '0';
            hiddenDateInput.style.width = '0';
            hiddenDateInput.style.zIndex = '-1';
            hiddenDateInput.max = maxDate;
            document.querySelector('.date-input-container').appendChild(hiddenDateInput);
            
            // Format date as dd/mm/yyyy
            function formatDate(dateString) {
                if (!dateString) return '';
                
                const date = new Date(dateString);
                const day = date.getDate().toString().padStart(2, '0');
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const year = date.getFullYear();
                
                return `${day}/${month}/${year}`;
            }
            
            // Update visible input when hidden date is selected
            hiddenDateInput.addEventListener('change', function() {
                dobInput.value = formatDate(this.value);
                dobInput.classList.add('filled');
                
                // Trigger change event on original input
                const event = new Event('change');
                dobInput.dispatchEvent(event);
            });
            
            // Open date picker when clicking on input or icon
            dobInput.addEventListener('click', function() {
                hiddenDateInput.showPicker();
            });
            
            calendarIcon.addEventListener('click', function() {
                hiddenDateInput.showPicker();
            });
        }); 

        // Toggle password visibility
        function togglePassword(id, icon) {
            const passwordField = document.getElementById(id);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        function validateForm(event) {
            event.preventDefault(); // Prevent form from submitting until validated

            let isValid = true;

            // Validate Username
            const username = document.getElementById("username");
            const usernameError = document.getElementById("usernameError");
            if (!username.checkValidity()) {
                usernameError.style.display = "block";
                isValid = false;
            } else {
                usernameError.style.display = "none";
            }

            // Validate Full Name
            const fullName = document.getElementById("fullName");
            const fullnameError = document.getElementById("fullnameError");
            if (!fullName.checkValidity()) {
                fullnameError.style.display = "block";
                isValid = false;
            } else {
                fullnameError.style.display = "none";
            }

            // Validate Email
            const email = document.getElementById("email");
            const emailError = document.getElementById("emailError");
            if (!email.checkValidity()) {
                emailError.style.display = "block";
                isValid = false;
            } else {
                emailError.style.display = "none";
            }

            // Validate Phone
            const phone = document.getElementById("phone");
            const phoneError = document.getElementById("phoneError");
            if (!phone.checkValidity()) {
                phoneError.style.display = "block";
                isValid = false;
            } else {
                phoneError.style.display = "none";
            }

            // Validate Password
            const password = document.getElementById("password");
            const passwordError = document.getElementById("passwordError");
            if (!password.checkValidity()) {
                passwordError.style.display = "block";
                isValid = false;
            } else {
                passwordError.style.display = "none";
            }

            // Confirm Password
            const confirmPassword = document.getElementById("confirmPassword");
            const confirmPasswordError = document.getElementById("confirmPasswordError");
            if (confirmPassword.value !== password.value || confirmPassword.value === "") {
                confirmPasswordError.style.display = "block";
                isValid = false;
            } else {
                confirmPasswordError.style.display = "none";
            }

            // Validate Security Keyword
            const securityKeyword = document.getElementById("securityKeyword");
            const securityKeywordError = document.getElementById("securityKeywordError");
            if (securityKeyword.value.trim().length < 5) {
                securityKeywordError.style.display = "block";
                isValid = false;
            } else {
                securityKeywordError.style.display = "none";
            }

            // Validate Date of Birth
            const dob = document.getElementById("dob");
            const dobError = document.getElementById("dobError");
            if (dob.value.trim() === "") {
                dobError.style.display = "block";
                isValid = false;
            } else {
                dobError.style.display = "none";
            }

            // Validate Gender
            const gender = document.getElementById("gender");
            const genderError = document.getElementById("genderError");
            if (gender.value === "") {
                genderError.style.display = "block";
                isValid = false;
            } else {
                genderError.style.display = "none";
            }

            // Validate Height
            const height = document.querySelector("input[name='height']");
            const heightError = document.getElementById("heightError");
            if (height.value.trim() === "" || parseFloat(height.value) <= 0) {
                heightError.style.display = "block";
                isValid = false;
            } else {
                heightError.style.display = "none";
            }

            // Validate Weight
            const weight = document.querySelector("input[name='weight']");
            const weightError = document.getElementById("weightError");
            if (weight.value.trim() === "" || parseFloat(weight.value) <= 0) {
                weightError.style.display = "block";
                isValid = false;
            } else {
                weightError.style.display = "none";
            }

            // Validate Goal
            const goal = document.getElementById("goal");

            const goalError = document.getElementById("goalError");
            if (goal.value.trim() === "") {
                goalError.style.display = "block";
                isValid = false;
            } else {
                goalError.style.display = "none";
            }

            // Submit form if valid
            if (isValid) {
                document.getElementById("registrationForm").submit();
            }
        }

        // Add active-role class style dynamically for visual highlight
        const style = document.createElement('style');
        style.textContent = `
            .active-role {
                border: 2px solid #8D7151;
                transform: scale(1.03);
                box-shadow: 0 4px 12px rgba(141, 113, 81, 0.4);
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
