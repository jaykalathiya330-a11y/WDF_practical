
<?php
require_once "db_mysqli.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($name == "" || $email == "" || $password == "") {
        die("Please fill in all fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address.");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters.");
    }

    $check = $conn->prepare(
        "SELECT id FROM practical9_users WHERE email = ?"
    );

    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $check->close();
        $conn->close();
        die("This email is already registered.");
    }

    $check->close();

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO practical9_users (name, email, password_hash)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sss", $name, $email, $passwordHash);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Registration failed.";
    }

    $stmt->close();
    $conn->close();

} else {
    echo "Please submit the registration form.";
}
?>
