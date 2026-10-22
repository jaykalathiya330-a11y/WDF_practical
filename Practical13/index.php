<?php
session_start();
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { http_response_code(403); exit("Admin access required. Sign in through Practical 10 as admin."); }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Practical 13 - Fetch API</title>
<style>body{font-family:Arial;margin:30px;background:#f4f7fb;color:#172033}main{max-width:900px;margin:auto}section{background:white;padding:20px;border-radius:10px;margin:15px 0}input,textarea,button{padding:9px;margin:5px}li{margin:12px 0;padding:12px;background:#fff;border:1px solid #ddd}small{color:#555}</style></head><body><main>
<h1>Practical 13: JSON API and Fetch API CRUD</h1><p>Records update without reloading the page.</p>
<section><h2>Add / Edit item</h2><input type="hidden" id="itemId"><input id="title" placeholder="Title" required><br><textarea id="details" placeholder="Details" rows="3" cols="50"></textarea><br><button id="save">Save item</button><button id="clear">Clear form</button><p id="message"></p></section>
<section><h2>Items</h2><button id="refresh">Refresh list</button><ul id="items"></ul></section><p><a href="../Practical10/dashboard.php">Back to dashboard</a></p>
<script>
const api = "api.php";
const titleInput=document.getElementById("title"), detailsInput=document.getElementById("details"), idInput=document.getElementById("itemId");
const message=document.getElementById("message"), list=document.getElementById("items");
async function request(method,data){const options={method,headers:{"Content-Type":"application/json"}};if(data)options.body=JSON.stringify(data);const response=await fetch(api,options);const result=await response.json();if(!response.ok)throw new Error(result.error||"Request failed");return result;}
async function loadItems(){list.innerHTML="";try{const items=await request("GET");items.forEach(item=>{const li=document.createElement("li");const heading=document.createElement("strong");heading.textContent=item.title+" ";const desc=document.createElement("span");desc.textContent=item.details+" ";const edit=document.createElement("button");edit.textContent="Edit";edit.onclick=()=>{idInput.value=item.id;titleInput.value=item.title;detailsInput.value=item.details;};const del=document.createElement("button");del.textContent="Delete";del.onclick=async()=>{if(confirm("Delete this item?")){try{await request("DELETE",{id:item.id});await loadItems();}catch(e){message.textContent=e.message;}}};li.append(heading,desc,edit,del);list.appendChild(li);});}catch(e){message.textContent=e.message;}}
document.getElementById("save").onclick=async()=>{try{const data={title:titleInput.value.trim(),details:detailsInput.value.trim()};if(!data.title||!data.details){message.textContent="Enter title and details.";return;}if(idInput.value){data.id=Number(idInput.value);await request("PUT",data);}else{await request("POST",data);}message.textContent="Saved successfully.";idInput.value="";titleInput.value="";detailsInput.value="";await loadItems();}catch(e){message.textContent=e.message;}};
document.getElementById("clear").onclick=()=>{idInput.value="";titleInput.value="";detailsInput.value="";message.textContent="";};
document.getElementById("refresh").onclick=loadItems;loadItems();
</script></main></body></html>
