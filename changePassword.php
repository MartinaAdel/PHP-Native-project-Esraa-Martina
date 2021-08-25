
<?php
require 'helpers/functions.php';
require 'helpers/dbConnection.php';

require 'shared components/header.php';
require "shared components/nav.php";
require 'shared components/sidNav.php';
if (isset($_SESSION['user'])) {
    $userID =  $_SESSION['user']['ID'];

$userPassword = $_SESSION['user']['password'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
   
    }
}
?>
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
                                        <?php
                                        require 'shared components/footer.php';
                                        ?>