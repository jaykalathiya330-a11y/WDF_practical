<?php
session_start(); header("Content-Type: application/json; charset=utf-8");
require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); echo json_encode(["error"=>"Admin access required"]); exit; }
$method=$_SERVER["REQUEST_METHOD"];
if($method==="GET"){
  $res=$conn->query("SELECT id,title,details,created_at FROM practical13_items ORDER BY id DESC"); $items=[];
  while($row=$res->fetch_assoc()) $items[]=$row;
  echo json_encode($items); exit;
}
$input=json_decode(file_get_contents("php://input"),true) ?? [];
if($method==="POST"){
  $title=trim($input["title"]??""); $details=trim($input["details"]??"");
  if($title===""||$details===""){http_response_code(400);echo json_encode(["error"=>"Title and details are required"]);exit;}
  $stmt=$conn->prepare("INSERT INTO practical13_items(title,details) VALUES(?,?)");$stmt->bind_param("ss",$title,$details);$stmt->execute();
  echo json_encode(["success"=>true,"id"=>$stmt->insert_id]);exit;
}
if($method==="PUT"){
  $id=(int)($input["id"]??0);$title=trim($input["title"]??"");$details=trim($input["details"]??"");
  if(!$id||$title===""||$details===""){http_response_code(400);echo json_encode(["error"=>"ID, title, and details are required"]);exit;}
  $stmt=$conn->prepare("UPDATE practical13_items SET title=?,details=? WHERE id=?");$stmt->bind_param("ssi",$title,$details,$id);$stmt->execute();
  echo json_encode(["success"=>true]);exit;
}
if($method==="DELETE"){
  $id=(int)($input["id"]??0);if(!$id){http_response_code(400);echo json_encode(["error"=>"ID is required"]);exit;}
  $stmt=$conn->prepare("DELETE FROM practical13_items WHERE id=?");$stmt->bind_param("i",$id);$stmt->execute();
  echo json_encode(["success"=>true]);exit;
}
http_response_code(405);echo json_encode(["error"=>"Method not allowed"]);
