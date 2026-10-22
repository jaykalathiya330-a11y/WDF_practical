
function validateLogin() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    if (username == "" || password == "" || confirmPassword == "") {
        alert("Please fill all fields");
        return false;
    }

    if (password != confirmPassword) {
        alert("Password and Confirm Password do not match");
        return false;
    }

    alert("Login successful");
    return true;
}



function registerUser() {
    let username = document.getElementById("regUsername").value;
    let password = document.getElementById("regPassword").value;
    let confirmPassword = document.getElementById("regConfirmPassword").value;
    let email = document.getElementById("regEmail").value;
    let mobile = document.getElementById("mobile").value;
    let id = document.getElementById("studentId").value;

    if (username == "" || password == "" || confirmPassword == "" ||
        email == "" || mobile == "" || id == "") {
        alert("Please fill all fields");
        return false;
    }

    if (password != confirmPassword) {
        alert("Passwords do not match");
        return false;
    }

    if (mobile.length != 10) {
        alert("Mobile number must contain 10 digits");
        return false;
    }

    alert("Registration successful");
    return true;
}



function sendMessage() {
    let name = document.getElementById("contactName").value;
    let email = document.getElementById("contactEmail").value;
    let message = document.getElementById("message").value;

    if (name == "" || email == "" || message == "") {
        alert("Please fill all fields");
        return false;
    }

    alert("Your message has been sent successfully");
    return true;
}



function submitProfile() {
    let name = document.getElementById("profileName").value;
    let id = document.getElementById("profileId").value;
    let college = document.getElementById("college").value;
    let email = document.getElementById("profileEmail").value;

    if (name == "" || id == "" || college == "" || email == "") {
        alert("Please fill all profile details");
        return false;
    }

    alert("Profile submitted successfully");
    return true;
}



function searchMaterial() {
    let subject = document.getElementById("subject").value;
    let semester = document.getElementById("semester").value;

    if (subject == "" || semester == "") {
        alert("Please enter subject and semester");
    }
    else {
        alert("Searching material for " + subject +
              " - Semester " + semester);
    }
}


function checkResult() {
    let id = document.getElementById("resultId").value;
    let semester = document.getElementById("resultSemester").value;

    if (id == "" || semester == "") {
        alert("Please enter ID and Semester");
    }
    else {
        alert("Result found for ID " + id +
              " and Semester " + semester);
    }
}



function payFees() {
    let pending = 3500;

    if (pending > 0) {
        alert("Pending fees: ₹" + pending);
    }
    else {
        alert("No pending fees");
    }
}


function checkAttendance() {
    let total = 5;
    let present = 4;

    let percentage = (present / total) * 100;

    alert("Your attendance is " + percentage + "%");
}


function checkAssignment() {
    let pending = 2;

    if (pending == 0) {
        alert("All assignments are submitted");
    }
    else {
        alert("You have " + pending + " pending assignments");
    }
}