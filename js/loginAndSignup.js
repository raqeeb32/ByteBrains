const forms = document.querySelector(".forms");
const pwShowHide = document.querySelectorAll(".eye-icon");
const links = document.querySelectorAll(".link");

// Password toggle
pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

        pwFields.forEach(password => {
            if (password.type === "password") {
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        });
    });
});

// Form switch
links.forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault();
        forms.classList.toggle("show-signup");
    });
});

// Signup form validation
const signupForm = document.querySelector('.form.signup form');
signupForm.addEventListener('submit', e => {
    e.preventDefault(); // Prevent actual form submission

    const username = document.getElementById('stuname').value.trim();
    const email = document.getElementById('stuemail').value.trim();
    const password = document.getElementById('stupass').value.trim();
    const confirmPassword = document.getElementById('stuconfirmpass').value.trim();

    const statusMsg1 = document.getElementById('statusMsq1');
    const statusMsg2 = document.getElementById('statusMsq2');
    const statusMsg3 = document.getElementById('statusMsq3');
    const statusMsg4 = document.getElementById('statusMsq4');

    // Clear messages
    statusMsg1.textContent = '';
    statusMsg2.textContent = '';
    statusMsg3.textContent = '';
    statusMsg4.textContent = '';

    let hasError = false;

    if (username === '') {
        statusMsg1.textContent = 'Username is required';
        hasError = true;
    }

    if (email === '') {
        statusMsg2.textContent = 'Email is required';
        hasError = true;
    }

    if (password === '') {
        statusMsg3.textContent = 'Password is required';
        hasError = true;
    }

    if (confirmPassword === '') {
        statusMsg4.textContent = 'Confirm password is required';
        hasError = true;
    }

    if (password && confirmPassword && password !== confirmPassword) {
        statusMsg4.textContent = 'Passwords do not match';
        hasError = true;
    }

    if (!hasError) {
        // Validation passed — now call signup handler
        addstu();
    }
});
