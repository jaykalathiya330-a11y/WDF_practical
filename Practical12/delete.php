<?php
session_start(); require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); exit("Admin access required."); }
if($_SERVER["REQUEST_METHOD"]!=="POST") {http_response_code(405);exit("POST required.");}
$id=filter_input(INPUT_POST,"id",FILTER_VALIDATE_INT); if(!$id) exit("Invalid event ID.");
$stmt=$conn->prepare("SELECT poster FROM practical12_events WHERE id=?"); $stmt->bind_param("i",$id); $stmt->execute(); $event=$stmt->get_result()->fetch_assoc();
$stmt=$conn->prepare("DELETE FROM practical12_events WHERE id=?"); $stmt->bind_param("i",$id); $stmt->execute();
if($event && $event["poster"] && is_file(__DIR__."/uploads/".$event["poster"])) unlink(__DIR__."/uploads/".$event["poster"]);
header("Location: index.php?msg=".urlencode("Event deleted.")); exit;
