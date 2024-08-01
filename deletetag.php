<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'todo_list';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $entryId = $_POST['entry_id'];
        $deleteSql = "DELETE FROM entry_tags WHERE Entry_id='$entryId';";
        $deleteStmt = $conn->prepare($deleteSql);

       if ($deleteStmt->execute()) {
        
            header("Location: admin.php");
            exit;
        } else {
            echo "Error deleting record.";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
