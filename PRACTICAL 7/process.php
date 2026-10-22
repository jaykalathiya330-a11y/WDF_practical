<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $mobile = trim($_POST["mobile"]);
    $password = trim($_POST["password"]);
    $course = trim($_POST["course"]);
    $year = trim($_POST["year"]);
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $terms = isset($_POST["terms"]) ? $_POST["terms"] : "";

    $errors = array();

    

    if ($name == "") {
        $errors[] = "Name is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $errors[] = "Mobile number must contain 10 digits.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($course == "") {
        $errors[] = "Please select a course.";
    }

    if ($year == "") {
        $errors[] = "Please select your year.";
    }

    if ($gender == "") {
        $errors[] = "Please select gender.";
    }

    if ($terms == "") {
        $errors[] = "Please accept the terms and conditions.";
    }

    

    if (count($errors) > 0) {

        echo "<h2>Registration Failed</h2>";

        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }

        echo "<a href='register.html'>Go Back</a>";

    } else {

       

        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $mobile = htmlspecialchars($mobile);
        $course = htmlspecialchars($course);
        $year = htmlspecialchars($year);
        $gender = htmlspecialchars($gender);


        $file = "registrations.csv";

        

        if (!file_exists($file)) {

            $handle = fopen($file, "w");

            fputcsv($handle, array(
                "Name",
                "Email",
                "Mobile",
                "Course",
                "Year",
                "Gender"
            ));

            fclose($handle);
        }

        

        $handle = fopen($file, "a");

        fputcsv($handle, array(
            $name,
            $email,
            $mobile,
            $course,
            $year,
            $gender
        ));

        fclose($handle);

        echo "<h2>Registration Successful!</h2>";
        echo "<p>Your data has been stored successfully.</p>";
        echo "<a href='register.html'>Register Another Student</a>";
    }

} else {

    echo "<h2>Invalid Request</h2>";
    echo "<p>Please submit the form using POST.</p>";

}

?>
