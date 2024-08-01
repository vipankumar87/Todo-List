<?php
session_start(); // Start the session

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'todo_list';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['delete'];
        $checkSql = "SELECT tag_name FROM tag WHERE id = :id";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $checkStmt->execute();
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $_SESSION['tag_name'] = $result['tag_name'];
            header("Location: admin.php");
        } else {
            echo "No tag found with id $id";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
