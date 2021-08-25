<?php 

require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';

$id = Sanitize($_GET['id'],1);


 if(!validate($id,2)){
 
     $message = "Invalid Id";

 }else{

   $sql = "delete from track where ID = $id";
   $op  = mysqli_query($con,$sql);

   if($op){
       $message = "item Deleted";
    //    echo '<script type="text/javascript">toastr.success('item Deleted')</script>';
   }else{
       $message = "error try again";
   }

   
    $_SESSION['messages'] = $message;

    header("Location: index.php");


 }




?>