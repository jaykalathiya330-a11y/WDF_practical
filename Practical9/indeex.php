
<!DOCTYPE html>
<html>
<head>
    <title>StudentHub Registration</title>
</head>
<body>
    <h2>StudentHub Registration Form</h2>

    <form action="register.php" method="post">
        <label>Full Name:</label>
        <input type="text" name="name" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Password:</label>
        <input type="password" name="password" minlength="8" required>
        <br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
