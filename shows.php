<?php
require_once 'functions.php';

if (checkLogin()) {
    echo "";
}

$servername = 'localhost';
$username = "root";
$password = "";
$database = "todo_list";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  

    $sql = "SELECT id, tag_name FROM tag";
    $stmt = $conn->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo "<h2 style='margin-left: 20px;margin-left:150px;'>Tags</h2>";

    foreach ($res as $row) {
        echo "<div class='card mb-2' id='card-{$row['id']}' style='width: 350px; background-color: rgb(232, 232, 232); margin-left: 20px;'>";
        echo "<div class='card-body d-flex align-items-center'>";
        echo "<p class='card-text' style='flex: 1; text-align: left; padding: 0 5px; margin: 0;'>";
        echo "<button data-bs-toggle='collapse' data-bs-target='#btn-{$row['id']}' style='border: none; background: none;'>";
        echo "<input type='checkbox' class='form-check-input' id='btns-".$row['id']."'onclick==\"myFunction(".$row['id'].") style='border:1px solid black;
accent-color: green;
}
'> &nbsp;&nbsp;";
        echo "</button>";
       echo "<b><button id='btns-".$row['id']."' onclick=\"showing(".$row['id']."); showsing('".str_replace(array('"', ','), '', $row['tag_name'])."');\" style='border: none; background: none;'>&nbsp;&nbsp;".str_replace(array('"', ','), '', $row['tag_name'])."</button>";
        echo "</p>";

        echo "<span style='margin-left: auto; margin-right: 15px;'>";

              echo "</span>";
        
        echo "<div id='btn-".$row["id"]."' class='collapse'><center>
                <div style='padding-top:10px;'>
                <form method='post' action='deletes.php'  onsubmit='return confirmSubmit()'>
                    <input type='hidden' value='".$row["id"]."' form-control' id='delete' name='data' placeholder='ID' required>
                    <button class='btn btn-dark' type='submit'>Delete</button>
                </form></div></div></div></div>";
        }
        
    }
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<Script>
    function confirmSubmit() {
        if (confirm("Are you sure you want to Delete?")) {
            return true;
        } else {
            return false;
        }
    }
    function showing(id) {
    document.getElementById('ids').value = id; 
}

function showsing(data) {
    document.getElementById('tags').value = data;
}
function myFunction(id) {
  var checkBox = document.getElementById(id);
  var text = document.getElementById(id+"_text");
  if (checkBox.checked == true) {
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
  
}
</Script>