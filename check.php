
<?php
session_start(); 

$dsn = 'mysql:host=localhost;dbname=todo_list';
$username = 'root';
$password = '';
try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: ". $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['mail'];
    $pass = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, user_name, user_password FROM users WHERE mail = :username AND user_password = :password");
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':password', $pass);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
        $user_id = $result[0]['id'];
        $_SESSION['loggedin'] = true;
        $_SESSION['mail'] = $user; 
        $_SESSION['user_id'] = $user_id; // Store the user ID in the session
        echo '<script language="javascript">';
        echo 'alert("Login successful ");';
        echo 'window.location.href = "admin.php";';
        echo '</script>';
        exit();
    } else {
        echo '<script language="javascript">';
        echo 'alert("Password is Wrong");';
        echo 'window.location.href = "login.php";';
        echo '</script>';
        exit();
    }
    $stmt->closeCursor();
}
$conn = null;
?>
