<?php
session_start();
require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); exit("Admin access required."); }
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$stmt = $conn->prepare("SELECT * FROM practical11_students WHERE id=?");
$stmt->bind_param("i", $id); $stmt->execute(); $student = $stmt->get_result()->fetch_assoc();
if (!$student) exit("Student not found. <a href='index.php'>Return</a>");
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, "UTF-8"); }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit student</title></head><body>
<h1>Edit student</h1><form method="post" action="update.php">
<input type="hidden" name="id" value="<?=h($student["id"])?>">
<label>Name <input name="name" required value="<?=h($student["name"])?>"></label><br>
<label>Email <input type="email" name="email" required value="<?=h($student["email"])?>"></label><br>
<label>Course <input name="course" required value="<?=h($student["course"])?>"></label><br>
<label>Semester <input type="number" name="semester" min="1" max="12" required value="<?=h($student["semester"])?>"></label><br>
<button>Update</button></form><a href="index.php">Cancel</a></body></html>
