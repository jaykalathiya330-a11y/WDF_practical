<?php
session_start();
require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); exit("Admin access required."); }
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$course = trim($_POST["course"] ?? "");
$semester = filter_input(INPUT_POST, "semester", FILTER_VALIDATE_INT);
if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $course === "" || !$semester || $semester < 1 || $semester > 12) { exit("Invalid input. Go back and check all fields."); }
$stmt = $conn->prepare("INSERT INTO practical11_students (name,email,course,semester) VALUES (?,?,?,?)");
$stmt->bind_param("sssi", $name, $email, $course, $semester);
if (!$stmt->execute()) { exit("Could not save. The email may already exist. <a href='index.php'>Return</a>"); }
header("Location: index.php"); exit;
