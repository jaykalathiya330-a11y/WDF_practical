
let form = document.getElementById("registrationForm");


let password = document.getElementById("password");


password.addEventListener("keyup", function () {

    let value = password.value;
    let strengthText = document.getElementById("strengthText");

    if (value.length == 0) {
        strengthText.innerHTML = "None";
    }
    else if (value.length < 6) {
        strengthText.innerHTML = "Weak";
    }
    else if (value.length >= 8 &&
             /[A-Z]/.test(value) &&
             /[0-9]/.test(value) &&
             /[!@#$%^&*]/.test(value)) {

        strengthText.innerHTML = "Strong";
    }
    else {
        strengthText.innerHTML = "Medium";
    }
});



form.addEventListener("submit", function(event) {

    event.preventDefault();

    
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let mobile = document.getElementById("mobile").value.trim();
    let passwordValue = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let course = document.getElementById("course").value;
    let year = document.getElementById("year").value;

    let gender = document.querySelector(
        'input[name="gender"]:checked'
    );

    let terms = document.getElementById("terms").checked;


   
    let nameError = document.getElementById("nameError");
    let emailError = document.getElementById("emailError");
    let mobileError = document.getElementById("mobileError");
    let passwordError = document.getElementById("passwordError");
    let confirmPasswordError =
        document.getElementById("confirmPasswordError");

    let courseError = document.getElementById("courseError");
    let yearError = document.getElementById("yearError");
    let genderError = document.getElementById("genderError");
    let termsError = document.getElementById("termsError");

    let successMessage =
        document.getElementById("successMessage");


    
    nameError.innerHTML = "";
    emailError.innerHTML = "";
    mobileError.innerHTML = "";
    passwordError.innerHTML = "";
    confirmPasswordError.innerHTML = "";
    courseError.innerHTML = "";
    yearError.innerHTML = "";
    genderError.innerHTML = "";
    termsError.innerHTML = "";
    successMessage.innerHTML = "";


    let valid = true;


    
    let namePattern = /^[A-Za-z ]+$/;

    if (name == "") {
        nameError.innerHTML = "Name is required";
        valid = false;
    }
    else if (!namePattern.test(name)) {
        nameError.innerHTML =
            "Name should contain only letters";
        valid = false;
    }


    
    let emailPattern =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email == "") {
        emailError.innerHTML = "Email is required";
        valid = false;
    }
    else if (!emailPattern.test(email)) {
        emailError.innerHTML =
            "Enter a valid email address";
        valid = false;
    }


    
    let mobilePattern = /^[0-9]{10}$/;

    if (mobile == "") {
        mobileError.innerHTML =
            "Mobile number is required";
        valid = false;
    }
    else if (!mobilePattern.test(mobile)) {
        mobileError.innerHTML =
            "Mobile number must contain 10 digits";
        valid = false;
    }


    let passwordPattern =
        /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/;

    if (passwordValue == "") {
        passwordError.innerHTML =
            "Password is required";
        valid = false;
    }
    else if (!passwordPattern.test(passwordValue)) {
        passwordError.innerHTML =
            "Password must have 8 characters, " +
            "one uppercase letter, one number " +
            "and one special character";
        valid = false;
    }


    
    if (confirmPassword == "") {
        confirmPasswordError.innerHTML =
            "Please confirm your password";
        valid = false;
    }
    else if (passwordValue != confirmPassword) {
        confirmPasswordError.innerHTML =
            "Passwords do not match";
        valid = false;
    }


    
    if (course == "") {
        courseError.innerHTML =
            "Please select your course";
        valid = false;
    }


  
    if (year == "") {
        yearError.innerHTML =
            "Please select your year";
        valid = false;
    }


    
    if (!gender) {
        genderError.innerHTML =
            "Please select your gender";
        valid = false;
    }


   
    if (!terms) {
        termsError.innerHTML =
            "You must accept the terms and conditions";
        valid = false;
    }


    
    if (valid) {

        successMessage.innerHTML =
            "Registration successful!";

        alert("Registration successful!");
    }

});