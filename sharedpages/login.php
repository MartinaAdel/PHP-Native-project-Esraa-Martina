<?php 

require '../helpers/functions.php';
require '../helpers/dbConnection.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $email = CleanInputs($_POST['email']) ;
    $password = $_POST['password'];

    $errors = [];
    if(!validate($email,1)){

       $errors['email'] = "Email Field Required";

    }elseif(!validate($email,3)){
      $errors['email']  = "Invalid Email";
    }


    if(!validate($password,1)){

       $errors['password'] = "Password Required";
    }


    if(count($errors) > 0){


     foreach ($errors as $key => $value) {
         # code...
         echo '*'.$value.'<br>';
     }

    }else{

       // code .... 
       $password = sha1($password);
       $sql = "select * from user where email = '$email' and password = '$password'";

       $op = mysqli_query($con,$sql);

       
    //    echo mysqli_error($con);
    //    exit();

       $num = mysqli_num_rows($op);

       if($num == 1){
         // code 
         $data = mysqli_fetch_assoc($op);

         $_SESSION['user'] = $data;

     header("location: ../Teacher/track/create.php");
        //  echo 'success';

       }else{
        //    echo mysqli_error($con);
        //    exit();

           echo 'error try again';
       }

    }
}
 require '../shared components/header.php';

?>
<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>E-Learning</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="register.php">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php 

require '../shared components/footer.php';
?>