    <?php
    require_once 'functions.php';


    $user_id = $_SESSION['user_id']; 

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

        $stmt = $conn->prepare("SELECT * FROM datas WHERE User_id = :user_id ORDER BY Entry_date DESC, times DESC");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $entries_by_date = array();

        foreach ($res as $row) {
            $Entry_date = htmlspecialchars($row['Entry_date'], ENT_QUOTES, 'UTF-8');
            $id = (int)$row['id'];
            $time = htmlspecialchars($row['times'], ENT_QUOTES, 'UTF-8');
            $data = htmlspecialchars($row['info'], ENT_QUOTES, 'UTF-8');
            $update_time = htmlspecialchars($row['update_time'], ENT_QUOTES, 'UTF-8');
            $ontime = $row['difference'];
            $timess = htmlspecialchars($row['Running_time'], ENT_QUOTES, 'UTF-8');
            $user_id = (int)$row['User_id'];

            if (!isset($entries_by_date[$Entry_date])) {
                $entries_by_date[$Entry_date] = array();
            }
            $entries_by_date[$Entry_date][] = array(
                'times' => $time,
                'info' => $data,
                'id' => $id,
                'Entry_date' => $Entry_date,
                'update_time' => $update_time,
                'ontime' => $ontime,
                'Running_time' => $timess,
                'User_id' => $user_id
            );
        }
        echo "<button class='btn btn-outline-danger' id='delete-all-btn' onclick='deleteAllChecked()'>Delete All Checked</button>";
        foreach ($entries_by_date as $date => $entries) {
            echo "<h2>$date</h2>";
            echo "<div class='card-container mt-3'>";
            foreach ($entries as $entry) {
                $entryId = $entry['id'];
                echo "<div class='card' id='card-$entryId'>";
                echo "<div class='card-body'>";
                echo "<div class='card-header'>";
                echo "<button type='button' data-bs-toggle='collapse' data-bs-target='#btn-$entryId' onclick='toggleDropdown($entryId)' style='border: none; background: none;'>";
                echo "<input type='checkbox' class='form-check-input' id='checkbox-$entryId' style='border:1px solid black;'> ";
                echo "</button>";
                echo "<button id='btns-$entryId' onclick=\"show($entryId); shows('".htmlspecialchars($entry['info'], ENT_QUOTES, 'UTF-8')."');\" style='border: none; background: none;'>&nbsp;&nbsp;".htmlspecialchars($entry['info'], ENT_QUOTES, 'UTF-8')."</button>";
              echo"<span>";  include "tagshow.php";  
              echo '<div class="dropdown" >
              <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><button id="btns-'.$entryId.'" onclick="show('.$entryId.'); shows(\''.htmlspecialchars($entry['info']).'\');" style="border: none; background: none;">Update</button></li>
                <li>
                  <form method="post" action="delete.php">
                    <input type="hidden" value="'.$entryId.'" name="data" required>
                    <button class="btn" type="submit">Delete</button>
                  </form>
                </li>
                <li><a class="dropdown-item" href="#data">New Data</a></li>
              </ul>
            </div>';
            echo"</span>";
            
                echo "</div>";
        
                echo "<div class='card-footer'>";
                if ($entry['times'] !== '00:00:00') {
                    echo "<span class='entry-time'>Entry Date & Time:&nbsp;&nbsp;".$date." {$entry['times']}</span>";
                }
                if ($entry['Running_time'] !== '00:00:00') {
                    echo "<span class='running-time'>Running {$entry['Running_time']}</span>";
                }
                if ($entry['update_time'] !== '00:00:00') {
                    echo "<span class='update-time'>Difference: {$entry['ontime']}</span>";
                }
                echo "<div id='btn-$entryId' class='collapse'>
                <form method='post' action='delete.php' onsubmit='return confir()'>
                    <input type='hidden' value='$entryId' name='data' required>
                    <button class='btn btn-dark' type='submit'>Delete</button>
                </form>
                </div>";
                echo "</div>";
        
               
                echo "</div>";
                echo "</div>";
            }
            echo "</div>"; 
            echo "<hr>";
        }
        

        
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>



    <style>
    .card-container {
        display: flex;
        flex-direction: column;
        row-gap: 2px; /* Adjust as needed */
    }

    .card {
    width: 90%;
    background-color: rgb(232, 232, 232);
    margin: 0 auto;
    box-sizing: border-box;
    border-radius:20px;
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
}

.card-body {
    padding: 10px;
    flex: 1;
}
.card-footer {
    border: 2px solid rgb(200,200,200);
    background-color: rgb(200,200,200);

}
.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Ensures space between left, center, and right content */
    background-color: rgb(232, 232, 232);
    border: none;
    padding: 10px;
}

.card-header .left-content {
    display: flex;
    align-items: center;
}

.card-header .center-content {
    flex: 1;
    text-align: center; /* Center aligns the content in the center section */
}

.card-header .right-content {
    display: flex;
    align-items: center;
    gap: 0px; /* Adjust the gap between items as needed */
}

.card-header button {
    margin-left: 10px;
}

.card-header span {
    display: flex;
    align-items: center;
}


.entry-time, .running-time, .update-time {
    margin-left: 20px;
}
h2 {
    margin-left: 50px;
}
.card-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
#delete-all-btn {
    display: none; /* Initially hidden */
}
.dropdown

    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.form-check-input');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteAllButtonVisibility);
        });

        function updateDeleteAllButtonVisibility() {
            const checkedCheckboxes = document.querySelectorAll('.form-check-input:checked');
            const deleteAllBtn = document.getElementById('delete-all-btn');
            
            if (checkedCheckboxes.length > 0) {
                deleteAllBtn.style.display = 'block';
            } else {
                deleteAllBtn.style.display = 'none';
            }
        }

        function deleteAllChecked() {
            const checkboxes = document.querySelectorAll('.form-check-input');
            const idsToDelete = [];

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    const entryId = checkbox.id.split('-')[1];
                    idsToDelete.push(entryId);
                }
            });

            if (idsToDelete.length === 0) {
                alert('No items selected for deletion.');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_all.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        idsToDelete.forEach(id => {
                            const card = document.getElementById(`card-${id}`);
                            if (card) {
                                card.remove();
                            }
                        });
                        updateDeleteAllButtonVisibility(); // Update button visibility after deletion
                    } else {
                        alert('Failed to delete items.');
                    }
                } else {
                    alert('Failed to communicate with server.');
                }
            };
            xhr.send('ids=' + JSON.stringify(idsToDelete));
        }

        window.deleteAllChecked = deleteAllChecked; // Make function globally accessible
        window.updateDeleteAllButtonVisibility = updateDeleteAllButtonVisibility; // Make function globally accessible
    });


    function toggleDropdown(entryId) {
        const collapseDiv = document.getElementById(`btn-${entryId}`);

        if (lastOpenedDropdown && lastOpenedDropdown !== collapseDiv) {
            lastOpenedDropdown.style.display = 'none';
        }

        collapseDiv.style.display = collapseDiv.style.display === 'block' ? 'none' : 'block';

        lastOpenedDropdown = collapseDiv;
    }

    function toggleRowVisibility(entryId) {
        const checkbox = document.getElementById(`checkbox-${entryId}`);
        const card = document.getElementById(`card-${entryId}`);

        card.style.display = checkbox.checked ? 'block' : 'none';
    }

    function show(id) {
        document.getElementById('id').value = id; 
    }

    function shows(data) {
        document.getElementById('data').value = JSON.stringify(data);
    }

    function confir() {
        return confirm("Are you sure you want to Delete?");
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
                const responseData = JSON.parse(xhr.responseText);
                displayDataBasedOnTags(responseData);
            } else {
                alert('Failed to load data');
            }
        };
        xhr.send('tags=' + JSON.stringify(selectedTags));
    }

    function displayDataBasedOnTags(data) {
        const allCards = document.querySelectorAll('.card');
        allCards.forEach(card => {
            card.style.display = 'none';
        });

        data.forEach(item => {
            const card = document.getElementById(`card-${item.id}`);
            if (card) {
                card.style.display = 'block';
            }
        });
    }
    </script>