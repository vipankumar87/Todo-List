<?php
session_start();
include 'functions.php';

if (checkLogin()) {
    echo "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        h1 { text-align: center; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; }
        .aa { text-decoration: none; }
        .texts { font-size: 20px; font-family: 'Times New Roman', Times, serif; }
        .ac { text-decoration: none; font-family: 'Times New Roman', Times, serif; font-size: 25px; color: black; }
        .heads { justify-content: right; }
        input {
            text-align: center;
            margin: 0 auto;
            padding-top: 30px;
            background-color: white;
        }
        .abhi {
            width: 400px;
        }
    </style>
</head>
<body style="background-color: rgb(245,245,245)">
    <nav class="navbar navbar-expand-sm fixed-top bg-dark">
        <div class="container-fluid">
            <h1 class="text-white" style="margin-left: 550px;">To-Do List</h1>
            <button class="heads btn bg-white" type="button" data-bs-toggle="offcanvas" style="margin-left: 450px;" data-bs-target="#demo">Menu</button>
            <button class="heads btn bg-white" type="button"><a href="admin.php" class="aa" style="color:black">Home</a></button>
        </div>
    </nav>
    <br><br><br><br><br>
    <div class="container">
        <h1 class="heading mt-3">Change Password</h1><br>
        <div class="offcanvas offcanvas-end" id="demo">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title mx-auto">Menu</h1>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <a class="ac link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="admin.php">Home</a><br><hr>
                <a class="ac link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="#">About us</a><br><hr>
                <a class="ac link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="#">Contact us</a><br><hr>
                <div class="dropdown">
                    <button type="button" class="btn ac" data-bs-toggle="dropdown" style="border: none; background: none; color-black;">
                        Update Profile 
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="username.php">Change User Name</a></li><hr>
                        <li><a class="dropdown-item" href="password.php">Change Password</a></li>
                    </ul>
                </div>
                <hr>
                <a class="ac link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="logout.php">Log Out</a><br><hr>
            </div>
        </div>
        <form class="forms" method="post" action="pswrdchange.php" onsubmit="return checkPassword()">
    <input type="password" class="form-control abhi" id="old_password" name="old_password" placeholder="Old Password" aria-label="Type Here" required autofocus>
    <input type="checkbox" onclick="myFunction()" style="margin-left:360px;">Show Password<br><br>
    <input type="password" class="form-control abhi" id="new_password" name="new_password" placeholder="New Password" aria-label="Type Here" required><br>
    <input type="password" class="form-control abhi" id="confirm_password" name="confirm_password" placeholder="Confirm Password" aria-label="Type Here" required>
    <input type="checkbox" onclick="show()" style="margin-left:360px;">Show Password<br><br>
    <center><button class="btn btn-outline-dark" type="submit">Update</button></center>
</form>
    </div>
    <script>
        function myFunction() {
            var oldPassword = document.getElementById("old_password");   
            if (oldPassword.type === "password") {
                oldPassword.type = "text";           
            } else {
                oldPassword.type = "password";        
            }
        }
        function show() {
            var newPassword = document.getElementById("new_password");   
            var confirmPassword = document.getElementById("confirm_password");  
            if (newPassword.type === "password") {
                newPassword.type = "text";           
                confirmPassword.type = "text";
            } else {
                newPassword.type = "password";        
                confirmPassword.type = "password";
            }
        }
    </script>
</body>
</html>