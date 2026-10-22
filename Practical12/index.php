<?php
session_start(); require "../Practical10/db_mysqli.php";
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); exit("Admin access required. Sign in as admin through Practical 10."); }
function h($v){return htmlspecialchars((string)$v,ENT_QUOTES,"UTF-8");}
$uploadDir = __DIR__ . "/uploads";
if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }
$msg = $_GET["msg"] ?? "";
$events = $conn->query("SELECT * FROM practical12_events ORDER BY event_date DESC, id DESC");
?>
<!doctype html><html><head><meta charset="utf-8"><title>Practical 12 - Event CRUD</title>
<style>body{font-family:Arial;margin:30px;background:#f4f7fb;color:#172033}main{max-width:1000px;margin:auto}section{background:white;padding:20px;margin:15px 0;border-radius:10px}input,textarea,button{padding:9px;margin:5px}table{width:100%;border-collapse:collapse}td,th{padding:10px;border-bottom:1px solid #ddd;text-align:left}img{max-width:100px}</style></head><body><main>
<h1>Practical 12: Event Management and Poster Upload</h1><?php if($msg) echo "<p>".h($msg)."</p>";?>
<section><h2>Add event</h2><form action="save.php" method="post" enctype="multipart/form-data">
<input name="title" placeholder="Event title" required maxlength="150"><input type="date" name="event_date" required>
<br><textarea name="description" placeholder="Event description" required rows="3" cols="60"></textarea><br>
<label>Poster (JPG, PNG, WEBP; max 2 MB): <input type="file" name="poster" accept=".jpg,.jpeg,.png,.webp"></label><button>Save event</button></form></section>
<section><h2>Events</h2><table><tr><th>ID</th><th>Title</th><th>Date</th><th>Description</th><th>Poster</th><th>Delete</th></tr>
<?php while($e=$events->fetch_assoc()):?><tr><td><?=h($e["id"])?></td><td><?=h($e["title"])?></td><td><?=h($e["event_date"])?></td><td><?=h($e["description"])?></td><td><?php if($e["poster"]):?><a href="uploads/<?=rawurlencode($e["poster"])?>" target="_blank">View poster</a><?php endif;?></td>
<td><form method="post" action="delete.php" onsubmit="return confirm('Delete this event?')"><input type="hidden" name="id" value="<?=$e["id"]?>"><button>Delete</button></form></td></tr><?php endwhile;?></table></section>
<p><a href="../Practical10/dashboard.php">Back to dashboard</a></p></main></body></html>
