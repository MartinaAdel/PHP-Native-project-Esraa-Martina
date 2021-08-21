<?php 

  $server = "localhost";
  $dbName = "E-learning_Project";
  $dbUser = "root";
  $dbPassword = "";


    $con =  mysqli_connect($server,$dbUser,$dbPassword,$dbName);

    if(!$con){

        die("Error : ".mysqli_connect_error());
    }


?>