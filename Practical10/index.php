
<?php
$message = "";

if (isset($_GET["message"])) {
    $message = $_GET["message"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>StudentHub Login</title>
</head>
<body>
    <h2>StudentHub Login</h2>

    <?php if ($message != "") { ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php } ?>

    <form action="login.php" method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required>
        <br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required>
        <br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
