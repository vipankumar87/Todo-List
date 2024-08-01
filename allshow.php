<?php
$dsn = 'mysql:host=localhost;dbname=todo_list';
$username = 'root';
$password = '';

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$sql = "SELECT GROUP_CONCAT(Tags SEPARATOR ',') AS Tags FROM entry_tags WHERE Entry_id = :entryId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':entryId', $entryId);

try {
    $stmt->execute();
    $tags = $stmt->fetchColumn();
    echo"<span style='margin: 0 auto'>" .$tags."</span>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>