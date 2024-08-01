<?php
require_once 'functions.php';

// Establish a database connection
$servername = 'localhost';
$username = "root";
$password = "";
$database = "todo_list";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['data'])) {
        $id = (int) $_POST['data'];
        $deleteSql = "DELETE FROM tag WHERE id = :id";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($deleteStmt->execute()) {
            header("Location: admin.php");
            exit;
        } else {
            logError("Error deleting record.");
            header('Location: error.php');
            exit;
        }
    } else {
        logError("Invalid request.");
        header('Location: error.php');
        exit;
    }
} catch (PDOException $e) {
    logError("Error: " . $e->getMessage());
    header('Location: error.php');
    exit;
}
?>