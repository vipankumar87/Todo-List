    <?php
    session_start();

    $dsn = 'mysql:host=localhost;dbname=todo_list';
    $username = 'root';
    $password = '';
    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $error_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST['username']) || empty($_POST['mail']) || empty($_POST['password'])){
            $_SESSION['flash_message'] = ['error'=> "Invalid date", 'old_data'=> serialize($_POST)];
            die(header('location: '.$_SERVER['HTTP_REFERER']));
        }
        $user = htmlspecialchars($_POST['username']);
        $mail = htmlspecialchars($_POST['mail']);
        $pass = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count > 0) {   
            
            echo "<script>alert('E-mail Id is Already Existed!!'); window.location.href='create.php';</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_password, mail) VALUES (:user, :pass, :mail)");
            $stmt->bindParam(':user', $user);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':mail', $mail);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = 'Account created successfully. Please log in.';
                header("Location: login.php");
            
                exit();
            } else {
                $error_message = 'Problem in creating account';
            }
        }
    }
    $conn = null;
    ?>
