<?php
$dsn = 'mysql:host=localhost;dbname=todo_list';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

$stmt = $pdo->query('SELECT Tags FROM entry_tags');


$array = $stmt->fetchAll(PDO::FETCH_NUM);


$pdo = null;


print_r($array);
?>