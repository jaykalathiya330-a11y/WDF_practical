
<?php
session_start();
require "db_mysqli.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

$stmt = $conn->prepare(
    "SELECT id, name, email, password_hash, role
     FROM practical9_users
     WHERE email = ?"
);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user["password_hash"])) {
    session_regenerate_id(true);

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["user_name"] = $user["name"];
    $_SESSION["user_email"] = $user["email"];
    $_SESSION["role"] = $user["role"];
    $_SESSION["last_activity"] = time();

    $stmt->close();

    header("Location: dashboard.php");
    exit;
}

$stmt->close();

header("Location: index.php?message=" . urlencode("Invalid email or password."));
exit;
?>
