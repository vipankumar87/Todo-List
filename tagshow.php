<?php
require_once 'functions.php';

if (checkLogin()) {
    echo "";
}

$dsn = 'mysql:host=localhost;dbname=todo_list';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT GROUP_CONCAT(tag_name SEPARATOR ', ') AS tag_names FROM tag;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $tagNames = explode(', ', $results['tag_names']);

    $entryId ;

    echo "<button type='button'  data-bs-toggle='modal' style='border:none; background-color: rgb(232, 232, 232);font-weight: bold;' data-bs-target='#exampleModal-$entryId' id='tags-button-$entryId'>Tags</button>
    <div class='modal fade' id='exampleModal-$entryId' tabindex='-1' aria-labelledby='exampleModalLabel-$entryId' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <center><h3 class='modal-title' id='exampleModalLabel-$entryId'>Tags</h3></center>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>";

    foreach ($tagNames as $tagName) {
        echo "<div class='form-check'>
            <input class='form-check-input tag-checkbox' type='checkbox' value='$tagName' id='$tagName-$entryId'>
            <label class='form-check-label' for='$tagName-$entryId'>
                $tagName
            </label>
        </div>";
    }

    echo "</div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-dark' data-bs-dismiss='modal'>Close</button>
                    <button type='button' class='btn btn-dark' onclick='submitCheckedTags($entryId)'>Submit</button>
                </div>
            </div>
        </div>
    </div>";

    echo "<a href='#'><button style='border:none; background-color: rgb(232, 232, 232);' data-bs-toggle='modal' data-bs-target='#exampleModal-$entryId' id='checked-tags-$entryId'></button></a>";
} catch (PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo "<p>There was an error processing your request. Please try again later.</p>";
}
?>
<script>
function submitCheckedTags(entryId) {
    var checkboxes = document.querySelectorAll('#exampleModal-' + entryId + ' .tag-checkbox');
    var checkedTags = [];
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            checkedTags.push(checkbox.value);
        }
    });

    if (checkedTags.length > 0) {
        var formData = new FormData();
        formData.append('entry_id', entryId);
        formData.append('tags', checkedTags.join(','));

        fetch('stored.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            displayCheckedTags(entryId, checkedTags);
            var modal = document.getElementById('exampleModal-' + entryId);
            var modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error submitting the tags.');
        });
    } else {
        alert('Please select at least one tag to submit.');
    }
}

function displayCheckedTags(entryId, checkedTags) {
    var displayDiv = document.getElementById('checked-tags-' + entryId);
    displayDiv.innerHTML = '&nbsp;&nbsp;&nbsp;' + checkedTags.join(', ');
    var tagsButton = document.getElementById('tags-button-' + entryId);
    tagsButton.style.display = 'none';

}
</script>