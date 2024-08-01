<?php
session_start();
include 'functions.php';

if (checkLogin()) {
    header("location:admin.php");
}
?>
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'todo_list';
date_default_timezone_set('Asia/Kolkata');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST['data'];
        $id = $_POST['id'];
        $datetime = $_POST['datetime'];
        $timess = $_POST['display'];
        $user_id=$_POST['user_id'];
        $date = date('Y-m-d', strtotime($datetime));
        $time = date('H:i:s', strtotime($datetime));

        $stmt = $conn->prepare("INSERT INTO datas (id, info, entry_date, times, Running_time,User_id) 
                                VALUES (:id, :data, :entry_date, :entry_time, :timess,'$user_id')
                                ON DUPLICATE KEY UPDATE info = :data, entry_date = :entry_date, update_time = :entry_time, Running_time = :timess");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':entry_date', $date);
        $stmt->bindParam(':entry_time', $time);
        $stmt->bindParam(':timess', $timess);

        if ($stmt->execute()) {
            $updateStmt = $conn->prepare("UPDATE datas SET difference = TIMEDIFF(update_time, times) WHERE id = :id");
            $updateStmt->bindParam(':id', $id);
            $updateStmt->execute();

            header('Location: admin.php');
            exit();
        } else {
            echo "Error: Could not execute the query.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
