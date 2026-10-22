<?php
session_start();
require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); exit("Admin access required."); }
if ($_SERVER["REQUEST_METHOD"] !== "POST") { http_response_code(405); exit("POST required."); }
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
if (!$id) exit("Invalid student ID.");
$stmt = $conn->prepare("DELETE FROM practical11_students WHERE id=?");
$stmt->bind_param("i", $id); $stmt->execute();
header("Location: index.php"); exit;
