
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php?message=" . urlencode("Please login first."));
    exit;
}

if (time() - $_SESSION["last_activity"] > 900) {
    $_SESSION = [];
    session_destroy();

    header("Location: index.php?message=" . urlencode("Session expired. Please login again."));
    exit;
}

$_SESSION["last_activity"] = time();
?>
<!DOCTYPE html>
<html>
<head>
    <title>StudentHub Dashboard</title>
</head>
<body>
    <h2>Welcome to StudentHub</h2>

    <p>Name:
        <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
    </p>

    <p>Email:
        <?php echo htmlspecialchars($_SESSION["user_email"]); ?>
    </p>

    <p>Role:
        <?php echo htmlspecialchars($_SESSION["role"]); ?>
    </p>

    <?php if ($_SESSION["role"] == "admin") { ?>
        <h3>Admin Access</h3>
        <a href="../Practical11/index.php">Student Management</a>
    <?php } else { ?>
        <p>You are logged in as a student.</p>
    <?php } ?>

    <br><br>
    <a href="logout.php">Logout</a>
</body>
</html>
