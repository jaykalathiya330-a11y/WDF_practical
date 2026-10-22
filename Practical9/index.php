<?php
$message = isset($_GET["message"]) ? $_GET["message"] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StudentHub - Secure Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eaf3ff;
            margin: 0;
            padding: 40px 15px;
        }
        .form-box {
            width: 100%;
            max-width: 420px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
            box-sizing: border-box;
        }
        h2 { text-align: center; color: #1e5aa8; }
        label { display: block; margin-top: 14px; }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 11px;
            border: 0;
            border-radius: 4px;
            background: #1e5aa8;
            color: white;
            cursor: pointer;
        }
        .message { text-align: center; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>StudentHub Registration</h2>

        <?php if ($message !== ""): ?>
            <p class="message">
                <?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?>
            </p>
        <?php endif; ?>

        <form action="register.php" method="post">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required maxlength="100">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required maxlength="190">

            <label for="password">Password (at least 8 characters)</label>
            <input type="password" id="password" name="password" required minlength="8">

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
