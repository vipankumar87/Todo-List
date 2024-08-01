<?php
session_start();
include 'functions.php';

if (!checkLogin()) {
    header("Location: login.php");
    exit;
}

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'todo_list';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $mail = $_SESSION['mail']; // Assuming user email is stored in the session

        if ($new_password != $confirm_password) {
            echo '<script>';
            echo 'alert("New password and confirm password do not match!");';
            echo 'window.location.href = "password.php";';
            echo '</script>';
            exit;
        }

        // Check if old password is correct
        $checkSql = "SELECT * FROM users WHERE mail = :mail and user_password= '$old_password'";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':mail', $mail);
        $checkStmt->execute();

        if ($checkStmt->rowCount() > 0) {

                $updateSql = "UPDATE users SET user_password = '$new_password' WHERE mail = '$mail'";
                $updateStmt = $conn->prepare($updateSql);

                if ($updateStmt->execute()) {
                    echo '<script>';
                    echo 'alert("User Password Changed Successfully.");';
                    echo 'window.location.href = "admin.php";';
                    echo '</script>';
                    exit;
                } else {
                    echo '<script>';
                    echo 'alert("Error updating record.");';
                    echo 'window.location.href = "password.php";';
                    echo '</script>';
                    exit;
                }
            } else {
                echo '<script>';
                echo 'alert("Old password is incorrect!");';
                echo 'window.location.href = "password.php";';
                echo '</script>';
                exit;
            }
        } else {
            echo '<script>';
            echo 'alert("User not found!");';
            echo 'window.location.href = "password.php";';
            echo '</script>';
            exit;
        }
    }catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
