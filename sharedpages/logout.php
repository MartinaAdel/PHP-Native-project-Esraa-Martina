<?php 

   require './helpers/functions.php';

   require './helpers/dbConnection.php';

   session_destroy();

   header("Location: ".url('login.php'));


?>