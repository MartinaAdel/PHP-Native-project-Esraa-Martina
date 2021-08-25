<?php
require 'helpers/functions.php';
require 'helpers/dbConnection.php';

require 'shared components/header.php';
// require "shared components/nav.php";
require 'shared components/sidNav.php';
if (isset($_SESSION['user'])) {
    $userID =  $_SESSION['user']['ID'];
    $userPassword = $_SESSION['user']['password'];

    $FirstName = $_SESSION['user']['Fname'];
    $LastName =  $_SESSION['user']['Lnme'];
    $userName = $_SESSION['user']['Fname'] . ' ' . $_SESSION['user']['Lnme'];
    $userEmail = $_SESSION['user']['email'];
    $userRole = $_SESSION['user']['roleID'];
    $address = $_SESSION['user']['address'];
    $phone = $_SESSION['user']['phone'];
    $imgdir = $_SESSION['user']['img_dir'];
    $education = $_SESSION['user']['education'];
    $job = $_SESSION['user']['job'];
    $createdDate = $_SESSION['user']['createdDate'];
    $d=mktime(11, 14, 54, 8, 12, 2014);
$modifiedDate = date("Y-m-d h:i:sa", $d);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fName  = CleanInputs($_POST['firstName']);
    $Lname = CleanInputs($_POST['lastName']);
    $email = CleanInputs($_POST['Email']);
    $address = CleanInputs($_POST['address']);
    $phone = CleanInputs($_POST['phone']);
    $job = CleanInputs($_POST['job']);
    $education = CleanInputs($_POST['education']);
    // $createdDate = CleanInputs($_POST['createdDate']);
    $roleID   =  filter_var($_POST['role_id'], FILTER_SANITIZE_NUMBER_INT);
    // $createdDate =date("Y-m-d h:i:sa", $d);

    $oldpassword = CleanInputs($_POST['OldPassword']);

    $oldpassword = sha1($oldpassword);

    $newpassword = CleanInputs($_POST['NewPassword']);
    $newpassword = sha1($newpassword);
    if($oldpassword == $userPassword && $newpassword != $oldpassword){
        $sqlup = "update user set password='$newpassword' where ID = $userID";
        //      echo mysqli_error($con);
        // exit();
             $opup =  mysqli_query($con,$sqlup);
        
            if($opup){
        
                echo 'data updated';
                // header("Location: shared components/sidNav.php")
                // header("Location: profile.php");
        
            }else{
                echo mysqli_error($con);
        
                echo 'Error Try Again';
         } 
    }

if(!empty($_FILES['image']['name'])){
    $name = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];
    $type = $_FILES['image']['type'];
  
    $nameArray =  explode('/',$type);

    $extension =  strtolower($nameArray[1]);
  
    $FinalName = rand().time().'.'.$extension;

    $allowedExt = array('png','jpg','jpeg'); 

    if(in_array($extension,$allowedExt)){
         $folder = "./uploads/";

         $finalPath = $folder.$FinalName;

        if(move_uploaded_file($temp,$finalPath)){

          // echo 'File Uploaded';
          unlink($imgdir);

        }else{

          echo 'error try again';
        }
    }else{

      echo 'Invalid Extension';
    }
 }else{
      // echo 'File Required';
      $finalPath = $imgdir;
     }
     $sqlup = "update user set fname='$fName' , lnme='$Lname' , roleID =$roleID , img_dir='$finalPath',job='$job',education='$education',email='$email',phone='$phone'  where ID = $userID";
//      echo mysqli_error($con);
// exit();
     $opup =  mysqli_query($con,$sqlup);

    if($opup){

        echo 'data updated';
        // header("Location: shared components/sidNav.php")
        // header("Location: profile.php");

    }else{
        echo mysqli_error($con);

        echo 'Error Try Again';
 }  
    }
}


# Fetch departments 
// $sql = "select title from role where role)D = $userRole";
// $op1  = mysqli_query($con, $sql);


$sql = "select * from role";
$op  = mysqli_query($con, $sql);
?>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li> -->
                                    <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                                </ul>

                                <div class="tab-content">
                                    

                                    <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                                    <form id="edit" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" class="form-horizontal">
<?php echo $userID;?>

                                    <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">First Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $FirstName?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Last Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $LastName?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" value="<?php echo $userEmail?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputSkills" class="col-sm-2 control-label">Address</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $address;?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="InputSkills" class="col-sm-2 control-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="<?php echo $phone;?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="InputExperience" class="col-sm-2 control-label">Education</label>

                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <textarea class="form-control" id="education" name="education" placeholder="Education"><?php echo $education;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="job" class="col-sm-2 control-label">Job</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="job" name="job" placeholder="job" valu="<?php echo $job;?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="col-sm-2 control-label">Image</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="file" class="form-control" id="image" name="image" placeholder="image" value="<?php echo $imgdir?>">
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
                                    <option value="<?php echo $op1; ?>"></option>
                                        <option value="<?php echo $rows['ID']; ?>"> <?php echo ucfirst($rows['title']); ?></option>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="editsubmit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                                            <!-- //changepassword -->

                                    <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                    <form id="edit" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" placeholder="New Password (Confirm)" required>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" name="changepasssubmit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

    require 'shared components/footer.php';
    // session_destroy();
    // header("Location: index.php");

    ?>
