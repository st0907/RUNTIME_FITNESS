<!--
Programmer Name : Siew Zhen Lynn (TP076386), Sim Tian (TP077056)
Program Name    : DP.PS.step1.php
Description     : Personalized Diet Plan - Step 2 Set your goals
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
    <title>Set Your Goals - RunTime Fitness</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="DP.css">
    <style>
        /* Back Button */
        .back-button {
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
            color: #8D7151;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .back-button:hover {
            color: #6a4819;
        }

        .back-button i {
            margin-right: 5px;
        }

        /* Plan Header */
        .plan-header {
            text-align: center;
            margin: 20px 0 30px;
        }

        .plan-header h1 {
            color: #6a4819;
            margin-bottom: 10px;
            font-size: 2rem;
        }

        .chat-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 28px;
            gap: 18px;
        }
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 8px rgba(106,72,25,0.10);
            flex-shrink: 0;
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .bubble {
            background: #fff;
            border-radius: 18px 18px 18px 4px;
            box-shadow: 0 2px 8px rgba(106,72,25,0.08);
            padding: 18px 22px;
            font-size: 1.08rem;
            max-width: 350px;
            position: relative;
            margin-left: 0;
            margin-right: auto;
            animation: popIn 0.5s;
        }
        @keyframes popIn {
            0% { transform: scale(0.8); opacity: 0;}
            100% { transform: scale(1); opacity: 1;}
        }
        .bubble:before {
            content: '';
            position: absolute;
            left: -12px;
            bottom: 18px;
            border-width: 10px 12px 10px 0;
            border-style: solid;
            border-color: transparent #fff transparent transparent;
        }
        .user-row {
            justify-content: flex-end;
        }
        .user-bubble {
            background: #e8d7be;
            color: #6a4819;
            border-radius: 18px 18px 4px 18px;
            padding: 14px 20px;
            font-size: 1.08rem;
            max-width: 350px;
            margin-left: auto;
            margin-right: 0;
            animation: popIn 0.5s;
        }
        .input-row {
            display: flex;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 35px; 
            gap: 10px;
        }
        .input-row input, .input-row select {
            padding: 12px 14px;
            border: 1.5px solid #e8d7be;
            border-radius: 8px;
            font-size: 1rem;
            color: #6a4819;
            background: #f8f4ec;
            outline: none;
            flex: 1;
            transition: border 0.2s;
        }
        .input-row input:focus, .input-row select:focus {
            border-color: #b38b4f;
        }
        .input-row button {
            background: #8D7151;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .input-row button:hover {
            background: #6a4819;
        }
        .next-btn {
            display: block;
            margin: 0 auto 25px auto;
            background: #8D7151;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 14px 36px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(106,72,25,0.08);
        }
        .next-btn:disabled {
            background: #e8d7be;
            color: #b9a789;
            cursor: not-allowed;
        }
        @media (max-width: 700px) {
            .container { padding: 12px 2vw 24px 2vw;}
            .avatar { width: 60px; height: 60px;}
            .bubble, .user-bubble { font-size: 1rem; max-width: 90vw;}
        }
    </style>
</head>
<body>
    <main class="container">
        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-bar-active" id="progress-active"></div>
                <div class="step completed">1</div>
                <div class="step active">2</div>
                <div class="step">3</div>
            </div>
        </div>

        <a href="DP.PS.step1.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <div class="plan-header">
            <h1>Step 2: Set Your Goals</h1>
        </div>

        <!-- Chat Block -->
        <div id="chat-container">
        </div>
    </main>
    <script>
        const questions = [
            {
                key: 'height',
                prompt: 'What is your height in cm?',
                input: { type: 'number', placeholder: 'e.g. 170', min: 80, max: 250, required: true }
            },
            {
                key: 'weight',
                prompt: 'What is your weight in kg?',
                input: { type: 'number', placeholder: 'e.g. 60', min: 20, max: 250, required: true }
            },
            {
                key: 'age',
                prompt: 'How old are you?',
                input: { type: 'number', placeholder: 'e.g. 25', min: 5, max: 120, required: true }
            },
            {
                key: 'gender',
                prompt: 'What is your gender?',
                input: { type: 'select', options: [
                    { value: '', label: 'Select gender' },
                    { value: 'male', label: 'Male' },
                    { value: 'female', label: 'Female' }
                ], required: true }
            },
            {
                key: 'activity',
                prompt: 'How active are you usually?',
                input: { type: 'select', options: [
                    { value: '', label: 'Select activity level' },
                    { value: '1.2', label: 'Sedentary (little or no exercise)' },
                    { value: '1.375', label: 'Lightly active (light exercise 1-3 days/week)' },
                    { value: '1.55', label: 'Moderately active (3-5 days/week)' },
                    { value: '1.725', label: 'Very active (6-7 days/week)' },
                    { value: '1.9', label: 'Extra active (very hard exercise & physical job)' }
                ], required: true }
            },
            {
                key: 'goal',
                prompt: 'What is your main goal?',
                input: { type: 'select', options: [
                    { value: '', label: 'Select your goal' },
                    { value: 'lose', label: 'Lose Weight' },
                    { value: 'maintain', label: 'Maintain Weight' },
                    { value: 'gain', label: 'Gain Weight' }
                ], required: true }
            },
            {
                key: 'budget',
                prompt: 'What is your daily food budget (RM)?',
                input: { type: 'number', placeholder: 'e.g. 30', min: 1, max: 999, required: true }
            }
        ];

        const chatContainer = document.getElementById('chat-container');
        const answers = {};
        let current = 0;

        function renderGreeting() {
            chatContainer.innerHTML = `
                <div class="chat-row">
                    <div class="avatar">
                        <img src="images/nutri.png" alt="Nutritionist">
                    </div>
                    <div class="bubble">
                        Great! Now let's personalize your plan. I'll just need a few details from you <span class="emoji">😊</span>
                    </div>
                </div>
            `;
            setTimeout(() => fetchLatestDataAndAsk(), 800);
        }

        function fetchLatestDataAndAsk() {
            fetch('DP.PS.GetMemberData.php')
                .then(response => response.text())
                .then(data => {
                    if (data.startsWith("ERROR")) {
                        renderUseLatestQuestion(); 
                        return;
                    }

                    const [height, weight, age, gender] = data.trim().split(',');
                    localStorage.setItem('ps_height', height);
                    localStorage.setItem('ps_weight', weight);
                    localStorage.setItem('ps_age', age);
                    localStorage.setItem('ps_gender', gender);

                    // Show nutritionist bubble with latest data
                    const row = document.createElement('div');
                    row.className = 'chat-row';
                    row.innerHTML = `
                        <div class="avatar">
                            <img src="images/nutri.png" alt="Nutritionist">
                        </div>
                        <div class="bubble">
                            <div>These are the most recent details we’ve saved for you:</div>
                            <table style="margin-top:10px; border-collapse: collapse; font-size: 0.95rem;">
                                <tr>
                                    <td style="padding: 4px 8px; font-weight: bold;">Height:</td>
                                    <td style="padding: 4px 8px;">${height} cm</td>
                                </tr>
                                <tr>
                                    <td style="padding: 4px 8px; font-weight: bold;">Weight:</td>
                                    <td style="padding: 4px 8px;">${weight} kg</td>
                                </tr>
                                <tr>
                                    <td style="padding: 4px 8px; font-weight: bold;">Age:</td>
                                    <td style="padding: 4px 8px;">${age}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 4px 8px; font-weight: bold;">Gender:</td>
                                    <td style="padding: 4px 8px;">${gender.charAt(0).toUpperCase() + gender.slice(1)}</td>
                                </tr>
                            </table>
                        </div>
                    `;
                    chatContainer.appendChild(row);

                    setTimeout(renderUseLatestQuestion, 600);
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                })
                .catch(error => {
                    alert("Error fetching latest data");
                    renderUseLatestQuestion(); 
                });
        }

        function renderUseLatestQuestion() {
            const row = document.createElement('div');
            row.className = 'chat-row';
            row.innerHTML = `
                <div class="avatar">
                    <img src="images/nutri.png" alt="Nutritionist">
                </div>
                <div class="bubble">
                    Would you like to use your recorded details?
                </div>
            `;
            chatContainer.appendChild(row);

            const form = document.createElement('form');
            form.className = 'input-row';

            const select = document.createElement('select');
            select.required = true;
            select.innerHTML = `
                <option value="">Select your choice</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            `;

            const submitBtn = document.createElement('button');
            submitBtn.type = 'submit';
            submitBtn.textContent = 'Send';

            form.appendChild(select);
            form.appendChild(submitBtn);
            chatContainer.appendChild(form);

            form.onsubmit = (e) => {
                e.preventDefault();
                const value = select.value;

                if (!value) {
                    select.style.borderColor = '#e74c3c';
                    return;
                }

                const userRow = document.createElement('div');
                userRow.className = 'chat-row user-row';
                userRow.innerHTML = `<div class="user-bubble">${value === 'yes' ? 'Yes' : 'No'}</div>`;
                chatContainer.appendChild(userRow);
                form.remove();

                if (value === 'yes') {
                    answers.height = localStorage.getItem('ps_height');
                    answers.weight = localStorage.getItem('ps_weight');
                    answers.age = localStorage.getItem('ps_age');
                    answers.gender = localStorage.getItem('ps_gender');
                    localStorage.removeItem('generatedMealPlan');
                    renderQuestion(4); 
                } else {
                    renderQuestion(0);
                }

                chatContainer.scrollTop = chatContainer.scrollHeight;
            };
        }
        
        function renderQuestion(index) {
            const q = questions[index];
            const row = document.createElement('div');
            row.className = 'chat-row';
            row.innerHTML = `
                <div class="avatar">
                    <img src="images/nutri.png" alt="Nutritionist">
                </div>
                <div class="bubble">${q.prompt}</div>
            `;
            chatContainer.appendChild(row);

            // Input row
            const inputRow = document.createElement('form');
            inputRow.className = 'input-row';
            inputRow.autocomplete = 'off';

            let inputEl;
            if (q.input.type === 'select') {
                inputEl = document.createElement('select');
                q.input.options.forEach(opt => {
                    const option = document.createElement('option');
                    option.value = opt.value;
                    option.textContent = opt.label;
                    inputEl.appendChild(option);
                });
            } else {
                inputEl = document.createElement('input');
                inputEl.type = q.input.type;
                inputEl.placeholder = q.input.placeholder || '';
                if (q.input.min) inputEl.min = q.input.min;
                if (q.input.max) inputEl.max = q.input.max;
            }
            inputEl.required = true;
            inputEl.name = q.key;
            inputEl.style.flex = '1';

            const submitBtn = document.createElement('button');
            submitBtn.type = 'submit';
            submitBtn.textContent = 'Send';

            inputRow.appendChild(inputEl);
            inputRow.appendChild(submitBtn);

            chatContainer.appendChild(inputRow);
            inputEl.focus();

            inputRow.onsubmit = function(e) {
                e.preventDefault();
                let value = inputEl.value;
                if (q.input.type === 'select' && value === '') {
                    inputEl.style.borderColor = '#e74c3c';
                    return;
                }
                if (q.input.type === 'number' && (value === '' || isNaN(value))) {
                    inputEl.style.borderColor = '#e74c3c';
                    return;
                }

                if (q.key === 'budget' && parseFloat(value) < 20) {
                    alert('Please set budget up to RM20.');
                    return;
                }

                inputEl.style.borderColor = '#e8d7be';

                // Save answer
                answers[q.key] = value;

                // Show user answer as a chat bubble
                const userRow = document.createElement('div');
                userRow.className = 'chat-row user-row';
                userRow.innerHTML = `<div class="user-bubble">${q.input.type === 'select'
                    ? q.input.options.find(opt => opt.value === value)?.label
                    : value}</div>`;
                chatContainer.appendChild(userRow);

                inputRow.remove();

                // Next question or finish
                if (index + 1 < questions.length) {
                    setTimeout(() => renderQuestion(index + 1), 500);
                } else {
                    setTimeout(renderNextButton, 600);
                }
                chatContainer.scrollTop = chatContainer.scrollHeight;
            };
        }

        function renderNextButton() {
            const btn = document.createElement('button');
            btn.className = 'next-btn';
            btn.textContent = 'Next Step';
            btn.onclick = function() {
                localStorage.setItem('ps_height', answers.height);
                localStorage.setItem('ps_weight', answers.weight);
                localStorage.setItem('ps_age', answers.age);
                localStorage.setItem('ps_gender', answers.gender);
                localStorage.setItem('ps_activity', answers.activity);
                localStorage.setItem('ps_goal', answers.goal);
                localStorage.setItem('ps_budget', answers.budget);
                window.location.href = 'DP.PS.step3.php';
            };
            chatContainer.appendChild(btn);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        renderGreeting();

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.diet-type-option').forEach(option => {
                option.addEventListener('click', function () {
                    document.querySelectorAll('.diet-type-option').forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            const nextStepBtn = document.getElementById('next-step');
            if (nextStepBtn) {
                nextStepBtn.addEventListener('click', function () {
                    const selected = document.querySelector('.diet-type-option.active');
                    if (!selected) {
                        alert('Please select a diet type first!');
                        return;
                    }
                    const dietType = selected.dataset.value;
                    localStorage.setItem('ps_diet_type', dietType);
                    window.location.href = 'DP.PS.step2.php'; 
                });
            }
        });
    </script>
</body>
</html> 