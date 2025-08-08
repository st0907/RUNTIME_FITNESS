<!--
Programmer Name : Yap Xin Ling (TP077224), Sim Tian (TP077056)
Program Name    : P.editProfile.php
Description     : Allow the user of the system to edit their profile
First Written on: Sunday, 15-June-2025
Edited on: 10-July-2025
-->

<?php
    session_start();
    include 'config.php';

    if (!isset($_SESSION['usr_user_id'])) {
        header("Location: login.html");
        exit();
    }

    $user_id = $_SESSION['usr_user_id'];

    // Fetch user info
    $sql = "SELECT * FROM users u
            JOIN member_profiles p ON u.usr_user_id = p.mbp_user_ID
            WHERE u.usr_user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User data not found.";
        exit();
    }

    // Format DOB to dd/mm/yyyy
    $dob_formatted = '';
    if (!empty($user['mbp_dob'])) {
        $dob_date = new DateTime($user['mbp_dob']);
        $dob_formatted = $dob_date->format('d/m/Y');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runtime Fitness - Edit Profile</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="P.editProfile.css">
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.7/build/spline-viewer.js"></script>
    <style>
        .reset-password-btn {
            text-decoration: none; 
            color: #8E735B; 
            font-weight: bold; 
            border: 2px solid #8E735B; 
            padding: 0.5rem 1rem; 
            border-radius: 8px; 
            display: inline-block; 
            transition: all 0.3s ease;
        }
        
        .reset-password-btn:hover {
            background-color: #8E735B;
            color: white;
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
    </style>
</head>
<body>
    <a href="P.viewProfile.php" class="home-icon" title="BACK TO PROFILE">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="profile-container">
        <div class="avatar-section">
            <spline-viewer id="spline-avatar" events-target="global"></spline-viewer>
        </div>
    </div>

    <div class="container">
        <div class="editProfile-container">
            <h1 class="editProfile-title">Edit Profile</h1>
            <form id="editProfileForm" action="P.processEditProfile.php" method="POST" onsubmit="return validateForm(event)">
                <div class="user-details">
                    <div class="input-group">
                        <input type="text" id="username" name="username" 
                            value="<?php echo htmlspecialchars($user['usr_username']); ?>"
                            placeholder="USERNAME"
                            pattern="^\w{5,15}$"
                            title="Username must be 5-15 characters, letters/numbers/underscores only"
                            required>
                        <span class="message error" id="usernameError" style="display: none;">
                            Username must be 5-15 characters, letters/numbers/underscores only
                        </span>
                    </div>

                    <div class="input-group">
                        <input type="text" id="fullName" name="fullName" 
                            value="<?php echo htmlspecialchars($user['usr_full_name']); ?>"
                            placeholder="FULL NAME"
                            pattern="^[A-Za-z ]+$"
                            title="Full name must contain only letters and spaces"
                            required>
                        <span class="message error" id="fullnameError" style="display: none;">
                            Full name must contain only letters and spaces
                        </span>
                    </div>

                    <div class="input-group">
                        <input type="email" id="email" name="email" 
                            value="<?php echo htmlspecialchars($user['usr_email']); ?>"
                            placeholder="EMAIL" required>
                        <span class="message error" id="emailError" style="display: none;">
                            Invalid email format
                        </span>
                    </div>

                    <div class="input-group">
                        <input type="tel" id="phone" name="phone" 
                            value="<?php echo htmlspecialchars($user['usr_phone']); ?>"
                            placeholder="PHONE"
                            pattern="^01[0-9]-\d{7,8}$"
                            title="Phone number format: 012-3456789 or 011-23456789"
                            required>
                        <span class="message error" id="phoneError" style="display: none;">
                            Please match the format such as 012-3456789 or 011-23456789
                        </span>
                    </div>

                    <div class="input-group password-group">
                        <div class="password-flex">
                            <input type="password" id="password" name="password" 
                                value="<?php echo htmlspecialchars($user['usr_password']); ?>"
                                placeholder="PASSWORD"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\-_\.@*]{8,}$" 
                                title="Password must be at least 8 characters, contain both letters and numbers, and only these symbols: -_.@*" 
                                required>
                            <i class="password-toggle fas fa-eye" onclick="togglePassword('password', this)"></i>
                        </div>
                        <span class="message error" id="passwordError" style="display: none;">
                            Password must be at least 8 characters with letters and numbers
                        </span>
                    </div>

                    <div class="input-group password-group">
                        <div class="password-flex">
                            <input type="password" id="securityKeyword" name="security_keyword" 
                                value="<?php echo htmlspecialchars($user['usr_security_keyword']); ?>"
                                placeholder="SECURITY KEYWORD"
                                minlength="5"
                                title="Security keyword must be at least 5 characters"
                                required>
                            <i class="password-toggle fas fa-eye" onclick="togglePassword('securityKeyword', this)"></i>
                        </div>
                        <span class="message error" id="securityKeywordError" style="display: none;">
                            Security keyword must be at least 5 characters
                        </span>
                    </div>

                    <div class="input-group">
                        <div class="date-input-container">
                            <input type="text" id="dob" name="dob" class="styled-input" 
                                value="<?php echo htmlspecialchars($dob_formatted); ?>"
                                placeholder="DATE OF BIRTH">
                            <i class="calendar-icon fas fa-calendar-alt"></i>
                        </div>
                        <span class="message error" id="dobError" style="display: none;">Date of birth is required</span>
                    </div>

                    <div class="input-group">
                        <select id="gender" name="gender" class="form-select" required>
                            <option value="" disabled hidden>GENDER</option>
                            <option value="male" <?php if ($user['mbp_gender'] === 'male') echo 'selected'; ?>>MALE</option>
                            <option value="female" <?php if ($user['mbp_gender'] === 'female') echo 'selected'; ?>>FEMALE</option>
                        </select>
                        <span class="message error" id="genderError" style="display: none;">Gender is required</span>
                    </div>

                    <div class="input-group">
                        <input type="number" step="0.01" name="height" 
                            value="<?php echo htmlspecialchars($user['mbp_height']); ?>"
                            placeholder="HEIGHT (cm)" 
                            min="90" max="250"
                            required>
                        <span class="message error" id="heightError" style="display: none;">
                            Height must be between 90 to 250 cm
                        </span>
                    </div>

                    <div class="input-group">
                        <input type="number" step="0.01" name="weight"
                            value="<?php echo htmlspecialchars($user['mbp_weight']); ?>" 
                            placeholder="WEIGHT (kg)" 
                            min="25" max="300"
                            required>
                        <span class="message error" id="weightError" style="display: none;">
                            Weight must be between 25 to 300 kg
                        </span>
                    </div>

                    <div class="input-group">
                        <select id="goal" name="goal" class="form-select" required>
                            <option value="" disabled hidden>FITNESS GOAL</option>
                            <option value="Lose Weight" <?php if ($user['mbp_goal'] === 'Lose Weight') echo 'selected'; ?>>LOSE WEIGHT</option>
                            <option value="Maintain Weight" <?php if ($user['mbp_goal'] === 'Maintain Weight') echo 'selected'; ?>>MAINTAIN WEIGHT</option>
                            <option value="Gain Weight" <?php if ($user['mbp_goal'] === 'Gain Weight') echo 'selected'; ?>>GAIN WEIGHT</option>
                        </select>
                        <span class="message error" id="goalError" style="display: none;">Fitness goal is required</span>
                    </div>
                </div>

                <button type="submit" class="submit-btn">SAVE</button>

                <div class="links">
                    <div style="text-align: center">
                        <a href="" onclick="return deleteAccount()">DELETE ACCOUNT</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
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

        function loadAvatar(role, gender) {
            const viewer = document.getElementById("spline-avatar");
            let url = "";

            if (role === "member") {
                url = gender === "female"
                    ? "https://prod.spline.design/zQQIvkTiRez2eqPg/scene.splinecode"
                    : "https://prod.spline.design/nam4RXFcB01Zdnz1/scene.splinecode";
            }

            if (viewer && url) {
                viewer.removeAttribute("url");
                viewer.setAttribute("url", url);
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const userRole = "<?php echo htmlspecialchars($user['usr_role'] ?? 'member'); ?>";
            const genderSelect = document.getElementById("gender");

            // Load default avatar on page load
            loadAvatar(userRole, genderSelect.value);

            // Update avatar when gender is changed in dropdown
            genderSelect.addEventListener("change", function () {
                loadAvatar(userRole, genderSelect.value);
            });
        });

        function deleteAccount() {
            if (confirm("Are you sure you want to delete your account? This action is irreversible.")) {
                fetch('P.deleteAccount.php', {
                    method: 'POST',
                    credentials: 'include' // This is important to include the session cookie
                })
                .then(response => response.text())
                .then(data => {
                    console.log("Response:", data);
                    alert("Account deleted.");
                    window.location.href = 'homePage.php';
                })
                .catch(error => {
                    alert("Error deleting account.");
                    console.error(error);
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dobInput = document.getElementById('dob');
            const calendarIcon = document.querySelector('.calendar-icon');
            
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1;
            let dd = today.getDate();
            
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            
            const maxDate = yyyy + '-' + mm + '-' + dd;

            const hiddenDateInput = document.createElement('input');
            hiddenDateInput.type = 'date';
            hiddenDateInput.style.position = 'absolute';
            hiddenDateInput.style.opacity = '0';
            hiddenDateInput.style.height = '0';
            hiddenDateInput.style.width = '0';
            hiddenDateInput.style.zIndex = '-1';
            hiddenDateInput.max = maxDate;
            document.querySelector('.date-input-container').appendChild(hiddenDateInput);

            function formatDate(dateString) {
                if (!dateString) return '';
                
                const date = new Date(dateString);
                const day = date.getDate().toString().padStart(2, '0');
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const year = date.getFullYear();
                
                return `${day}/${month}/${year}`;
            }

            hiddenDateInput.addEventListener('change', function() {
                dobInput.value = formatDate(this.value);
                dobInput.classList.add('filled');
                
                const event = new Event('change');
                dobInput.dispatchEvent(event);
            });
            
            dobInput.addEventListener('click', function() {
                hiddenDateInput.showPicker();
            });
            
            calendarIcon.addEventListener('click', function() {
                hiddenDateInput.showPicker();
            });
        });

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
                document.getElementById("editProfileForm").submit();
            }
        }
    </script>
</body>
</html>
