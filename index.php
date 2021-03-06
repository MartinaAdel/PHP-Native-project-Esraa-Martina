<?php

require 'helpers/functions.php';
require 'helpers/dbConnection.php';
$errors = [];


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = CleanInputs($_POST['email']);
    $password = $_POST['password'];

    if (!validate($email, 1)) {

        $errors['email'] = "Email Field Required";
    } elseif (!validate($email, 3)) {
        $errors['email']  = "Invalid Email";
    }


    if (!validate($password, 1)) {

        $errors['password'] = "Password Required";
    }


    if (count($errors) <= 0) {

        // code .... 
        $password = sha1($password);
        $sql = "select * from user where email = '$email' and password = '$password'";

        $op = mysqli_query($con, $sql);


        //    echo mysqli_error($con);
        //    exit();

        $num = mysqli_num_rows($op);

        if ($num == 1) {
            // code 
            $data = mysqli_fetch_assoc($op);

            $_SESSION['user'] = $data;
            if ($data['roleID'] == 1) {
                header("location: Admins/Admins/index.php");
            } elseif ($data['roleID'] == 2) {
                header("location: Teacher/track/index.php");
            } else {
                header("location: Student/enroll track/index.php");
            }
        } else {
            //    echo mysqli_error($con);
            //    exit();
            $errors['sql'] = "error try again";
            //    echo 'error try again';
        }
    }
}
require 'shared components/header.php';

?>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Bit</b> by <b>Bit</b></a>
            <small>E-Learning</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" placeholder="email" autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <!-- <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label> -->
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-success  waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="register.php">Register Now!</a>
                        </div>
                        <!-- <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div> -->
                    </div>
                </form>

                <!-- show errors  -->
                <div class=" m-t-15">
                    <?php
                    if (count($errors) > 0) {


                        foreach ($errors as $key => $value) {
                            # code...

                            echo '
                            <div class="alert alert-danger">
                            <strong>' . $key . ': </strong> ' . $value .
                                ' </div>' . '<br>';
                        }
                    }
                    ?>
                </div>


            </div>
        </div>
    </div>

    <?php

    require 'shared components/footer.php';
    ?>