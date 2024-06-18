const forms = document.querySelector(".forms");
const pwShowHide = document.querySelectorAll(".eye-icon");
const links = document.querySelectorAll(".link");

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
        })
    });
});

links.forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault(); // Preventing default link behavior
        forms.classList.toggle("show-signup");
    });
});

// Handle form submission for the signup form
const signupForm = document.querySelector('.form.signup form');
signupForm.addEventListener('submit', e => {
    e.preventDefault(); // Prevent default form submission behavior

    // Perform any necessary actions here (e.g., validation, sending data to server, etc.)
    console.log('Signup form submitted!');
    // You can add your form submission logic here
});
