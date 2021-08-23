<?php 

require '../helpers/functions.php';
require '../helpers/dbConnection.php';

// function CleanInputs($input){

// // return stripslashes(htmlspecialchars(trim($input)));
// $input = trim($input);
// $input = stripslashes($input);
// $input = htmlspecialchars($input);

// return $input;
// }




if($_SERVER['REQUEST_METHOD'] == "POST"){

  $errors = [];

  $firstname  = CleanInputs($_POST['firstName']);
  $lastName = CleanInputs($_POST['lastName']) ;
  $email = CleanInputs($_POST['email']);
  $password = CleanInputs($_POST['password']) ;
  $address = CleanInputs($_POST['address']) ;
  $phone = CleanInputs($_POST['phone']) ;
  $roleID   =  filter_var($_POST['role_id'],FILTER_SANITIZE_NUMBER_INT);




  if(empty($firstname)){

    $errors['firstName'] = " Field Required";

  }elseif(!preg_match("/^[a-zA-Z\s*']+$/",$firstname)){

    $errors['firstName'] = "Invalid String";
  }



  if(empty($email)){

    $errors['Email'] = " Field Required";

  }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     $errors['Email'] = "Invalid Email";
  }


  if(empty($password)){

    $errors['Password'] = " Field Required";

  }elseif(strlen($password < 6)){

    $errors['Password'] = "Invalid Length";
  }


  if(!filter_var($roleID,FILTER_VALIDATE_INT)){

    $errors['roleID'] = "Invalid Department id ";

  }




    if(count($errors) > 0){

        foreach($errors as $key => $error){

            echo '* '.$key.' : '.$error.'<br>';
        }
     }else{

   $password =   sha1($password); // md5
      

   // code 
   $sql = "insert into user (Fname ,Lnme,email,address,phone,password,roleID) values ('$firstname','$lastName','$email','$address','$phone','$password','$roleID')";

    $op =  mysqli_query($con,$sql);

    if($op){

        echo 'data Inserted';
        header("location: login.php");

    }else{
        echo 'Error Try Again';

      echo  mysqli_error($con);
      exit();


    }


    }

   


}
  # Fetch departments 

  $sql = "select * from role";
  $op  = mysqli_query($con,$sql); 

  mysqli_close($con);

?>







<<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST">
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="firstName" placeholder="First Name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="lastName" placeholder="LastName" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons-round">home</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="address" placeholder="address" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <!-- <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                        </div>
                    </div> -->
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="material-icons">call</i>
                                    </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="phone" placeholder="phone" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons-round">role</i>
                        </span>
                        <select name="role_id" class="form-control">
                                <?php 
   
                                   while($rows = mysqli_fetch_assoc($op)){
                                ?>

                                <option value="<?php echo $rows['ID'];?>"> <?php echo $rows['title'];?> </option>

                                <?php } ?>

                            </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="sign-in.html">You already have a membership?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-up.js"></script>
</body>
</html>