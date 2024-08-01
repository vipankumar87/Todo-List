<?php
require_once 'functions.php';
session_start();

if (!checkLogin()) {
    echo json_encode(['success' => false]);
    exit;
}

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'todo_list';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['ids']) && is_array(json_decode($_POST['ids']))) {
        $ids = json_decode($_POST['ids']);
        $ids = array_map('intval', $ids); 

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $conn->prepare("DELETE FROM datas WHERE id IN ($placeholders)");
        $stmt->execute($ids);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false]);
}
?>
