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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        h1 { text-align: center; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; }
        .aa { text-decoration: none; }
        .texts { font-size: 20px; font-family: 'Times New Roman', Times, serif; }
        .ac { text-decoration: none; font-family: 'Times New Roman', Times, serif; font-size: 25px; color: black; }
        .heads { justify-content: right; }
        hr {
  color: black;
}
.heading{
}
    </style>
</head>

<body style="background-color:rgb(245,245,245)">
    
    <nav class="navbar navbar-expand-sm fixed-top bg-dark" style="position:fixed;">
        <div class="container-fluid mt-3">
            <h1 class="text-white" style="padding-left: 450px;">To-Do List</h1>
            <div class="dropdown">
  <button type="button" class="btn btn-light " data-bs-toggle="dropdown" style="margin-left: 560px;">
  <i class="bi bi-tag"></i>
    </button>
    <ul class="dropdown-menu" style="margin-left: 200px;width:400px" >
    <li>
    <form action="tag.php" method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1" style="border-top-style: hidden;"><i class="bi bi-plus"></i></span>
                <input type="hidden" id="ids" name="ids">
                <input type="text" class="form-control fixed-top" id="tags" name="tags" placeholder="New Tag" aria-label="tags" aria-describedby="basic-addon1" style="width: 25%;border-top-style: hidden;" required>
                <button type="submit" class="btn btn-dark btn-lg" hidden></button>
            </div>
        </form>

  </li>
      <li> <?php include("shows.php") ?></li>
     
    </ul>
  </div>
            <button class="heads btn btn-light" type="button" data-bs-toggle="offcanvas" style="margin-left: 0px;" data-bs-target="#demo">Menu</button>
              </div>
    </nav>
    
<br><br><br><br><br><br>


<h1 class="heading mt-3">Welcome To The Todo List </h1>

    <div class="offcanvas offcanvas-end" id="demo" style="width:300px"> 
        <div class="offcanvas-header">
            
            <h2 class="offcanvas-title mx-auto">Menu</h2>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body"  >
            <a class="ac link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="admin.php">Home</a><br><hr> 
            <a class="ac link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="https://en.wikipedia.org/wiki/Wikipedia:To-do_list">About us</a><br><hr>
            <a class="ac link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="https://www.instagram.com/">Contact us</a><br><hr>
            <div class="dropdown">
  <button type="button" class="btn ac " data-bs-toggle="dropdown" style='border: none; background: none; color-black; '>
  <b>Update Profile </b>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="username.php">Change User Name</a></li><hr>
    <li><a class="dropdown-item" href="password.php">Change Password</a></li>
    
  </ul>
</div> <hr>
            <a class="ac link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="logout.php">Log Out</a><br><hr>
        </div>
    </div>
    <form class="forms" method="post" action="homepagestore.php" id="myform" onsubmit="return confirmSubmit()">
           <div class="mb-3 mt-3">
            <center>
                <label for="data" class="form-label ac">Your Data Title</label>
                <div class="input-group mb-3" style="width: 900px; padding-left:50px">
                    <input type="hidden" id="id" name="id" >
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" readonly>

                    <input type="hidden" id="datetime" name="datetime" required>
                    <input type="text" class="form-control text-center" id="data" name="data" style="background-color:rgb(232,232,232);text-size:14px ;border-top-left-radius: 10px;border-bottom-left-radius: 10px;width:170px" aria-describedby="inputGroupFileAddon04" aria-label="Upload" placeholder="Type Here" required onkeypress="if (event.key === 'Enter') { event.preventDefault(); }" autofocus>
                    <input type="text" class="form-control text-center" id="display" name="display"style="background-color:rgb(232,232,232);text-size:14px ;" placeholder="Time"  readonly>
                    <button class="btn btn-dark" type="submit" id="inputGroupFileAddon04" style="border-top-right-radius:10px;border-bottom-right-radius:10px;"><i class="bi bi-play"></i></button>
                    <div id="display" class="texts"></div>
                     
                </div>
            </center>
        </div>
    </form>
    <div id="display"></div>
    <br><br>
    <center>
            <h2 class="heading" >Your Data is Here</h2>
            <hr style="width:300px">
    </center>
        <ul class="texts" id="list">
        <?php include("show.php") ?>
    </ul>
<div class="container-fluid my-5">





</div>
    <script>
   document.getElementById("myform").addEventListener("submit", function(event) {
    const date = new Date();
    const formattedDate = date.getFullYear() + '-' + 
                          ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
                          ('0' + date.getDate()).slice(-2) + ' ' + 
                          ('0' + date.getHours()).slice(-2) + ':' + 
                          ('0' + date.getMinutes()).slice(-2) + ':' + 
                          ('0' + date.getSeconds()).slice(-2);
    document.getElementById("datetime").value = formattedDate;
});
document.getElementById("id").defaultValue = "0"; 
document.getElementById("ids").defaultValue = "0"; 
    function show(id) {
        document.getElementById('id').value = id; 
    }
    
    function shows(data) {
        document.getElementById('data').value =data;
    }
       let timerId;
let hours = 0;
let seconds = 0;
let minutes = 0;
let timerRunning = false;
let display = document.querySelector('#display');

document.getElementById("data").addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    if (!timerRunning) {
      timerId = setInterval(function() {
        seconds++;
        if (seconds === 60) {
          seconds = 00;
          minutes++;
        } if (minutes === 60) {
          minutes = 00;
          hours++;
        }
        document.getElementById("display").value ="Time: "+ hours+":"+minutes + ':' + seconds;
      }, 1000);
      timerRunning = true;
    }
  }
});
function confirmSubmit() {
        if (confirm("Are you sure you want to submit?")) {
            return true;
        } else {
            return false;
        }
    }
    

document.getElementById("myform").addEventListener("submit", function(event) {
  if (!timerRunning) {
    event.preventDefault();
    alert("Press Enter key to Start the Timer!");
  } else {
    const date = new Date();
    const formattedDate = date.getFullYear() + '-' + 
                          ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
                          ('0' + date.getDate()).slice(-2) + ' ' + 
                          ('0' + date.getHours()).slice(-2) + ':' + 
                          ('0' + date.getMinutes()).slice(-2) + ':' + 
                          ('0' + date.getSeconds()).slice(-2);
    document.getElementById("datetime").value = formattedDate;
  }
});

    function confirmSubmit() {
        return confirm("Are you sure you want to delete?");
    }

    function showing(id) {
        document.getElementById('ids').value = id; 
    }

    function showsing(data) {
        document.getElementById('tags').value = data;
    }

    function myFunction(id) {
        var checkBox = document.getElementById('btns-' + id);
        var text = document.getElementById('btn-' + id);
        if (checkBox.checked) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }

        
    </script>
</body>
</html>

