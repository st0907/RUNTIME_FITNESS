document.addEventListener('DOMContentLoaded', function() {
    const togglePasswordVisibility = (passwordInput, toggleButton) => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleButton.classList.toggle('fa-eye');
        toggleButton.classList.toggle('fa-eye-slash');
    };

    // Login password 
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    togglePassword.addEventListener('click', () => togglePasswordVisibility(passwordInput, togglePassword));

    // Login form error handling
    const loginForm = document.querySelector('.login-container form');
    const loginUsernameInput = document.getElementById('loginUsername');
    const loginPasswordInput = document.getElementById('password');
    const loginUsernameGroup = document.getElementById('loginUsernameGroup');
    const loginPasswordGroup = document.getElementById('loginPasswordGroup');
    const loginUsernameError = document.getElementById('loginUsernameError');
    const loginPasswordError = document.getElementById('loginPasswordError');
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const username = loginUsernameInput.value;
        const password = loginPasswordInput.value;
        // Replace with real authentication logic
        if (username !== 'correctUsername' || password !== 'correctPassword') {
            loginUsernameGroup.classList.add('error');
            loginPasswordGroup.classList.add('error');
            loginUsernameError.style.display = 'block';
            loginPasswordError.style.display = 'block';
        } else {
            loginUsernameGroup.classList.remove('error');
            loginPasswordGroup.classList.remove('error');
            loginUsernameError.style.display = 'none';
            loginPasswordError.style.display = 'none';
            // Proceed with successful login actions
        }
    });
}); 