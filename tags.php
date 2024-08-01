<?php
require_once 'functions.php';

if (checkLogin()) {
    echo "";
}

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'todo_list';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, tag_name FROM tag";
    $stmt = $conn->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2 style='margin-left: 20px;margin-left:150px;'>Tags</h2>";
    echo "<button id='showButton' style='display:none; margin-left: 20px;' onclick='showSelectedTags()'>Show</button>";

    foreach ($res as $row) {
        echo "<div class='card mb-2' id='card-{$row['id']}' style='width: 350px; background-color: rgb(232, 232, 232); margin-left: 20px;'>";
        echo "<div class='card-body d-flex align-items-center'>";
        echo "<p class='card-text' style='flex: 1; text-align: left; padding: 0 5px; margin: 0;'>";
        echo "<input type='checkbox' class='form-check-input' id='btns-{$row['id']}' onclick='toggleShowButton()' data-tag-name='".str_replace(array('"', ','), '', $row['tag_name'])."' style='border:1px solid black; accent-color: green;'> &nbsp;&nbsp;";
        echo "<b><button id='btns-{$row['id']}' onclick=\"showing({$row['id']}); showsing('".str_replace(array('"', ','), '', $row['tag_name'])."');\" style='border: none; background: none;'>&nbsp;&nbsp;".str_replace(array('"', ','), '', $row['tag_name'])."</button>";
        echo "</p>";
        echo "<span style='margin-left: auto; margin-right: 15px;'></span>";
        echo "<div id='btn-{$row["id"]}' class='collapse'><center>
                <div style='padding-top:10px;'>
                <form method='post' action='deletes.php' onsubmit='return confirmSubmit()'>
                    <input type='hidden' value='{$row["id"]}' form-control' id='delete' name='data' placeholder='ID' required>
                    <button class='btn btn-dark' type='submit'>Delete</button>
                </form></div></div></div></div>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<script>
function toggleShowButton() {
    const checkboxes = document.querySelectorAll('.form-check-input');
    const showButton = document.getElementById('showButton');
    let anyChecked = false;

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            anyChecked = true;
        }
    });

    showButton.style.display = anyChecked ? 'block' : 'none';
}

function showSelectedTags() {
    const checkboxes = document.querySelectorAll('.form-check-input');
    let selectedTags = [];

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            selectedTags.push(checkbox.getAttribute('data-tag-name'));
        }
    });

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'store_tags.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Tags saved to session. You can now view them on another page.');
        } else {
            alert('An error occurred while saving tags.');
        }
    };
    xhr.send('tags=' + JSON.stringify(selectedTags));
}

function confirmSubmit() {
    return confirm("Are you sure you want to Delete?");
}
</script>

