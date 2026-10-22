
<?php
session_start();
require_once __DIR__ . "/../Practical10/db_mysqli.php";


if (!isset($_SESSION["user_id"]) ||
    ($_SESSION["role"] ?? "") !== "admin") {
    http_response_code(403);
    exit("Admin access required. Sign in as admin.");
}

function countRows($conn, $table) {
    $allowedTables = [
        "practical11_students",
        "practical12_events",
        "practical13_items",
        "practical9_users",
        "registrations"
    ];

    if (!in_array($table, $allowedTables, true)) {
        return "Unavailable";
    }

    try {
        $result = $conn->query(
            "SELECT COUNT(*) AS total FROM `$table`"
        );

        $row = $result->fetch_assoc();
        return $row["total"];
    } catch (Throwable $e) {
        return "Unavailable";
    }
}

$students = countRows($conn, "practical11_students");
$events = countRows($conn, "practical12_events");
$items = countRows($conn, "practical13_items");
$users = countRows($conn, "practical9_users");
$registrations = countRows($conn, "registrations");

$recent = false;

try {
    $recent = $conn->query(
        "SELECT id, name, email, created_at
         FROM practical9_users
         ORDER BY id DESC LIMIT 5"
    );
} catch (Throwable $e) {
    $recent = false;
}

function h($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Practical 14 - Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            margin: 30px;
            background: #f3f6fb;
            color: #172033;
        }
        main {
            max-width: 1000px;
            margin: auto;
        }
        .cards {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        .card, section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 10px 0;
            flex: 1;
            min-width: 140px;
        }
        .number {
            font-size: 30px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        a {
            color: #1457a6;
        }
    </style>
</head>
<body>
<main>
    <h1>Practical 14: Admin Dashboard</h1>

    <p>
        Welcome, <?= h($_SESSION["user_name"] ?? "Admin") ?>.
        Role: <?= h($_SESSION["role"] ?? "") ?>
    </p>

    <div class="cards">
        <div class="card">
            Students
            <div class="number"><?= h($students) ?></div>
            <a href="../Practical11/index.php">Manage students</a>
        </div>

        <div class="card">
            Events
            <div class="number"><?= h($events) ?></div>
            <a href="../Practical12/index.php">Manage events</a>
        </div>

        <div class="card">
            API items
            <div class="number"><?= h($items) ?></div>
            <a href="../Practical13/index.php">Manage API items</a>
        </div>

        <div class="card">
            Registered users
            <div class="number"><?= h($users) ?></div>
        </div>

        <div class="card">
            Registrations
            <div class="number"><?= h($registrations) ?></div>
        </div>
    </div>

    <section>
        <h2>Recently registered users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
            </tr>

            <?php if ($recent): ?>
                <?php while ($r = $recent->fetch_assoc()): ?>
                    <tr>
                        <td><?= h($r["id"]) ?></td>
                        <td><?= h($r["name"]) ?></td>
                        <td><?= h($r["email"]) ?></td>
                        <td><?= h($r["created_at"] ?? "") ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>
    </section>

    <p>
        <a href="../Practical10/dashboard.php">Back to login dashboard</a>
        |
        <a href="../Practical10/logout.php">Logout</a>
    </p>
</main>
</body>
</html>
