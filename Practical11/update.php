<?php
session_start();
require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); exit("Admin access required."); }
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$name = trim($_POST["name"] ?? ""); $email = trim($_POST["email"] ?? "");
$course = trim($_POST["course"] ?? ""); $semester = filter_input(INPUT_POST, "semester", FILTER_VALIDATE_INT);
if (!$id || $name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $course === "" || !$semester || $semester < 1 || $semester > 12) exit("Invalid input.");
$stmt = $conn->prepare("UPDATE practical11_students SET name=?, email=?, course=?, semester=? WHERE id=?");
$stmt->bind_param("sssii", $name, $email, $course, $semester, $id);
if (!$stmt->execute()) exit("Could not update. Email may already exist.");
header("Location: index.php"); exit;
