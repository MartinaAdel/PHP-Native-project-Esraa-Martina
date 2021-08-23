<?php 

require '../helpers/functions.php';
require '../helpers/dbConnection.php';


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
  require '../shared components/header.php';

?>
<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>E-Learning</small>
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

    <?php 

require '../shared components/footer.php';
?>