    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            h1 {
                text-align: center;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            }
            .aa {
                text-decoration: none;
            }
            .texts {
                font-size: 20px;
                font-family: 'Times New Roman', Times, serif;
            }
            .rad {
                border-radius: 15px;
            }
            body {
                background-color: rgb(235, 224, 224);
            }
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            body {
                font-family: Arial, sans-serif;
                font-size: 16px;
                line-height: 1.5;
                color: #333;
                background-color: #fff;
            }
            .container {
                max-width: 400px;
                margin: 40px auto;
                padding: 20px;
                background-color: #fff;
            }
            .signup-form {
                padding: 10px;
            }
            .signup-form h1 {
                font-size: 26px;
                margin-bottom: 10px;
            }
            .signup-form p {
                margin-bottom: 20px;
            }
            .signup-form input[type="text"],
            .signup-form input[type="email"],
            .signup-form input[type="password"] {
                width: 100%;
                height: 60px;
                margin-bottom: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
            }
            .signup-form input[type="text"]:focus,
            .signup-form input[type="email"]:focus,
            .signup-form input[type="password"]:focus {
                border-color: #aaa;
                box-shadow: 0 0 10px rgba(26, 23, 23, 0.1);
            }
            .signup-form button[type="submit"] {
                width: 100%;
                margin-top: 10px;
                height: 60px;
                background-color: #0d0d0d;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 20px;
            }
            .signup-form button[type="submit"]:hover {
                background-color: #0f0909;
            }
            .signup-form p a {
                text-decoration: none;
                color: #0e6dcd;
            }
            .signup-form p a:hover {
                color: #0e6dcd;
            }
            @media (max-width: 768px) {
                .container {
                    max-width: 300px;
                }
            }
            @media (max-width: 480px) {
                .container {
                    max-width: 250px;
                }
                .signup-form input[type="text"],
                .signup-form input[type="email"],
                .signup-form input[type="password"] {
                    height: 30px;
                    padding: 5px;
                }
                .signup-form button[type="submit"] {
                    height: 30px;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm fixed-top bg-dark">
            <div class="container-fluid">
                <h1 class="text-white mx-auto">To-Do List</h1>
            </div>
        </nav>
        <br><br><br><br><br>
        <div class="container mt-3">
            <div class="signup-form">
                <div class="form-group text-center">
                    <h1 style="margin: 10px 0;" class="head">Create Account </h1>
                </div>
                <?php

                if (!empty($_SESSION['success_message'])) {
                    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                    unset($_SESSION['success_message']);
                }
                if (!empty($error_message)) {
                    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error_message) . '</div>';
                }
                ?>
                <form method="POST" action="action.php">
                    <input type="text" name="username" placeholder="Username" required id="username"><br>
                    <input type="email" name="mail" placeholder="Mail" required id="mail"><br>
                    <input type="password" name="password" placeholder="Password" required id="password"><br>
                    <input type="checkbox" onclick="myFunction()">Show Password
                    <button type="submit">Login</button><br><br>
                </form>
            <center> <p id="account" style="color: rgb(131, 127, 127);">Already Have Account <a href="login.php">Log In</a></p></center>
            </div>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </body>
    </html>
    <?php
    if (!empty($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
    unset($_SESSION['error_message']);
}
?>


