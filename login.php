<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Development Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">WebDevNotes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="contact.php">Contact Us</a>
                </li>

            </ul>
            <?php
             if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true){

                echo '
                <button type="submit" class="btn btn-outline-danger mx-2"><a class="text-decoration-none text-light" href="/webdev/login.php">Login</a></button>
                <button  type="submit" class="btn btn-outline-danger  " ><a class="text-decoration-none text-light" href="/webdev/signup.php">Sign Up</a></button>';
              }else{
  
                echo '
                <button type="submit" class="btn btn-outline-danger mx-2"><a class="text-decoration-none text-light" href="/webdev/logout.php">Logout</a></button>';
              }
  

        ?>
        </div>
    </div>
</nav>
<?php
   
     if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "notes";
     
     //Create a connection
        $conn = mysqli_connect($servername,$username,$password,$database);
       
        if (!$conn){
       //Die if connection was not successful
            die("Sorry we failed to connect: ".mysqli_connect_error());
        }
        $uname = $_POST['uname'];
        $pass = $_POST['mypass'];
        $sql = "SELECT * FROM user WHERE `username` = '$uname' AND `password` = '$pass'";
        $result = mysqli_query($conn,$sql);
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows == 1)
        {
            session_start();
            $_SESSION['logged'] = true;
            header('location:home.php');
        }
        else{
            header('location:signup.php');
        }

     }

?>
<div class="container my-4">
    <h1 class="text-center">Login</h1>
    <form action="login.php" method='post'>

        <div class="mb-3">
            <label for="uname" class="form-label">UserName</label>
            <input type="text" class="form-control" id="uname" name="uname" placeholder="uname@11" required>
        </div>
        <div class="mb-3">
            <label for="mypass" class="form-label">Password</label>
            <input type="password" class="form-control" id="mypass" name="mypass" placeholder="123ABC**" required>
        </div>
        <button type="submit" class="btn btn-outline-danger text-center">Login</button>




    </form>






</div>


<body>