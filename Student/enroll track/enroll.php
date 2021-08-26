<?php

require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';


# Validate & Sanitize id 

$id = Sanitize($_GET['id'], 1);

if (!validate($id, 2)) {

    $_SESSION['messages'] = "invalid id ";
    header("Location: index.php");
}

if (isset($_SESSION['user'])) {
    $userID =  $_SESSION['user']['ID'];
}

# Form Logic ... 


    $erros = [];
   
    if (count($erros) > 0) {

        $_SESSION['errormessages'] = $erros;
    } else {

        # db Logic 
        $sql = "INSERT INTO `study`(`studentID`, `trackID`) VALUES ('$userID','$id')";
        $op = mysqli_query($con, $sql);

        if ($op) {
            $_SESSION['messages'] = 'Record inserted';

            header("Location: index.php");
        } else {
            echo mysqli_error($con);
            $_SESSION['messages'] = mysqli_error($con);
            $_SESSION['errormessages'] = ['error try again'];
        }
    }

