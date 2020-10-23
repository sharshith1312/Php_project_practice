<?php

     // connecting to database
     $conn=mysqli_connect('localhost','harshith','qwerty123','todoapp');

     // check connection
     if(!$conn){
         echo 'connection error'.mysqli_connect_error();
     }
?>