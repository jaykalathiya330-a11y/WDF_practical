<?php
session_start(); require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); exit("Admin access required."); }
$title=trim($_POST["title"]??""); $date=$_POST["event_date"]??""; $description=trim($_POST["description"]??"");
if($title==="" || $description==="" || !preg_match('/^\d{4}-\d{2}-\d{2}$/',$date)) exit("Please provide a title, valid date, and description.");
$posterName=null;
if(isset($_FILES["poster"]) && $_FILES["poster"]["error"] !== UPLOAD_ERR_NO_FILE){
  if($_FILES["poster"]["error"]!==UPLOAD_ERR_OK || $_FILES["poster"]["size"]>2*1024*1024) exit("Upload failed or file exceeds 2 MB.");
  $finfo=new finfo(FILEINFO_MIME_TYPE); $mime=$finfo->file($_FILES["poster"]["tmp_name"]);
  $allowed=["image/jpeg"=>"jpg","image/png"=>"png","image/webp"=>"webp"];
  if(!isset($allowed[$mime])) exit("Only JPG, PNG, or WEBP images are allowed.");
  $dir=__DIR__."/uploads"; if(!is_dir($dir)) mkdir($dir,0755,true);
  $posterName=bin2hex(random_bytes(12)).".".$allowed[$mime];
  if(!move_uploaded_file($_FILES["poster"]["tmp_name"],$dir."/".$posterName)) exit("Could not save uploaded poster.");
}
$stmt=$conn->prepare("INSERT INTO practical12_events(title,event_date,description,poster) VALUES(?,?,?,?)");
$stmt->bind_param("ssss",$title,$date,$description,$posterName);
if(!$stmt->execute()) exit("Could not save event.");
header("Location: index.php?msg=".urlencode("Event saved successfully.")); exit;
