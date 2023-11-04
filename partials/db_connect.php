<?php

$servername = "localhost";
     $username = "root";
     $password = "";
     $database = "notes";
     
     //Create a connection
     $conn = mysqli_connect($servername,$username,$password,$database);
     $delete_post = FALSE;
     if (!$conn){
       //Die if connection was not successful
        die("Sorry we failed to connect: ".mysqli_connect_error());
     }
?>