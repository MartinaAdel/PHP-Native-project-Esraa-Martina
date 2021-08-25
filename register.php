<?php

require 'helpers/functions.php';
require 'helpers/dbConnection.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $errors = [];

    $firstname  = CleanInputs($_POST['firstName']);
    $lastName = CleanInputs($_POST['lastName']);
    $email = CleanInputs($_POST['email']);
    $password = CleanInputs($_POST['password']);
    $address = CleanInputs($_POST['address']);
    $phone = CleanInputs($_POST['phone']);
    $roleID   =  filter_var($_POST['role_id'], FILTER_SANITIZE_NUMBER_INT);

    if (empty($firstname)) {

        $errors['firstName'] = " Field Required";
    } elseif (!preg_match("/^[a-zA-Z\s*']+$/", $firstname)) {

        $errors['firstName'] = "Invalid String";
    }



    if (empty($email)) {

        $errors['Email'] = " Field Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Invalid Email";
    }


    if (empty($password)) {

        $errors['Password'] = " Field Required";
    } elseif (strlen($password < 6)) {

        $errors['Password'] = "Invalid Length";
    }


    if (!filter_var($roleID, FILTER_VALIDATE_INT)) {

        $errors['roleID'] = "Invalid Department id ";
    }




    if (count($errors) <= 0) {



        $password =   sha1($password); // md5


        // code 
        $sql = "insert into user (Fname ,Lnme,email,address,phone,password,roleID) values ('$firstname','$lastName','$email','$address','$phone','$password','$roleID')";

        $op =  mysqli_query($con, $sql);

        if ($op) {

            echo 'data Inserted';
            header("location: index.php");
        } else {
            // $errors['-'] = 'Error Try Again';

            $errors['sql'] =  mysqli_error($con);
            // exit();
        }
    }
}
# Fetch departments 

$sql = "select * from role";
$op  = mysqli_query($con, $sql);

mysqli_close($con);

require 'shared components/header.php';

?>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Bit</b> by <b>Bit</b></a>
            <small>E-Learning</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <div class="msg">Register a new membership</div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="firstName" placeholder="First Name" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="lastName" placeholder="LastName">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="email" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">home</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="address" placeholder="address">
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
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">call</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="phone" placeholder="phone">
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">assignment_ind</i>
                                </span>
                                <select name="role_id" class="form-control bootstrap-select show-tick">
                                    <option value="">-- Register as --</option>
                                    <?php

                                    while ($rows = mysqli_fetch_assoc($op)) {
                                        if ($rows['ID'] == 1)
                                            continue;
                                    ?>

                                        <option value="<?php echo $rows['ID']; ?>"> <?php echo ucfirst($rows['title']); ?></option>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg btn-success waves-effect" type="submit">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="index.php">You already have a membership?</a>
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