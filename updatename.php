<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'todo_list';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mail = $_SESSION['mail'];
        $new_username = $_POST['name'];

        // Check if mail exists in the database
        $checkSql = "SELECT * FROM users WHERE mail = :mail";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $checkStmt->execute();

        if ($checkStmt->rowCount() > 0) {
            $updateSql = "UPDATE users SET user_name = :new_username WHERE mail = :mail";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':new_username', $new_username, PDO::PARAM_STR);
            $updateStmt->bindParam(':mail', $mail, PDO::PARAM_STR);

            if ($updateStmt->execute()) {
                echo '<script type="text/javascript">';  
                echo 'alert("Username Changed Successfully.");'; 
                echo '</script>'; 
                include("admin.php");
                exit;
            } else {
                echo '<script type="text/javascript">';  
                echo 'alert("Error updating record.");'; 
                echo '</script>';
                include("username.php");
                exit;
            }
        } else {
            echo '<script type="text/javascript">';  
            echo 'alert("Please check Your Mail id .Your Mail id is not Found..!");'; 
            echo '</script>';
            include("username.php");
            exit;
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Invalid request method.");';
        echo '</script>';
        include("username.php");
        exit;
    }
} catch (PDOException $e) {
    echo "Database error: ". $e->getMessage();
}
?>