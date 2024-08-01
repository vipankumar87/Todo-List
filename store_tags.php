<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tags'])) {
        $tags = json_decode($_POST['tags'], true);
        $_SESSION['selected_tags'] = $tags;
        echo 'Tags stored in session';
    } else {
        echo 'No tags received';
    }
} else {
    echo 'Invalid request method';
}
?>
