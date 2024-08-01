<?php
session_start();

$dsn = 'mysql:host=localhost;dbname=todo_list';
$username = 'root';
$password = "";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = $_POST['tags'];
    $id=$_POST['ids'];

    if ($tag) {
        $stmt = $conn->prepare("INSERT INTO tag (id,tag_name) VALUES ('$id',:tag) ON DUPLICATE KEY UPDATE tag_name = :tag");
        $stmt->bindParam(':tag', $tag);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Tag created/updated successfully.';
        } else {
            $_SESSION['error_message'] = 'Problem in creating/updating tag.';
        }
    } else {
        $_SESSION['error_message'] = 'Invalid input data.';
    }
    header("Location: admin.php");
    exit();
}

$conn = null;
?>

