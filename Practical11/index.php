<?php
session_start();
require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") {
    http_response_code(403);
    exit("Admin access required. Sign in through Practical 10 with an admin account.");
}
function h($value) { return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8"); }
$q = trim($_GET["q"] ?? "");
if ($q !== "") {
    $stmt = $conn->prepare("SELECT * FROM practical11_students WHERE name LIKE ? OR email LIKE ? OR course LIKE ? ORDER BY id DESC");
    $like = "%".$q."%";
    $stmt->bind_param("sss", $like, $like, $like);
    $stmt->execute();
    $students = $stmt->get_result();
} else {
    $students = $conn->query("SELECT * FROM practical11_students ORDER BY id DESC");
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Practical 11 - Student CRUD</title>
<style>body{font-family:Arial;margin:30px;background:#f3f6fb;color:#172033}main{max-width:1100px;margin:auto}section{background:white;padding:20px;margin:15px 0;border-radius:10px}input,button{padding:9px;margin:4px}table{width:100%;border-collapse:collapse}td,th{padding:10px;border-bottom:1px solid #ddd;text-align:left}a{color:#1457a6}</style></head><body><main>
<h1>Practical 11: Student Management CRUD</h1><p>Signed in as <?=h($_SESSION["user_name"] ?? "Admin")?> (admin)</p>
<section><h2>Add student</h2><form method="post" action="save.php">
<input name="name" placeholder="Student name" required maxlength="100">
<input name="email" type="email" placeholder="Email" required maxlength="150">
<input name="course" placeholder="Course" required maxlength="100">
<input name="semester" type="number" min="1" max="12" value="3" required>
<button type="submit">Save student</button></form></section>
<section><h2>Search students</h2><form method="get"><input name="q" value="<?=h($q)?>" placeholder="Name, email, or course"><button>Search</button><a href="index.php">Clear</a></form>
<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Semester</th><th>Actions</th></tr>
<?php while($s = $students->fetch_assoc()): ?><tr>
<td><?=h($s["id"])?></td><td><?=h($s["name"])?></td><td><?=h($s["email"])?></td><td><?=h($s["course"])?></td><td><?=h($s["semester"])?></td>
<td><a href="edit.php?id=<?=$s["id"]?>">Edit</a>
<form method="post" action="delete.php" style="display:inline" onsubmit="return confirm('Delete this student?')"><input type="hidden" name="id" value="<?=$s["id"]?>"><button>Delete</button></form></td></tr><?php endwhile; ?>
</table></section><p><a href="../Practical10/dashboard.php">Back to dashboard</a> | <a href="../Practical10/logout.php">Logout</a></p></main></body></html>
