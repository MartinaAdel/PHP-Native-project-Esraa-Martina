<?php
require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';
require '../../shared components/header.php';
require "../../shared components/nav.php";
require '../../shared components/sidNav.php';

if (isset($_SESSION['user'])) {
    $userID =  $_SESSION['user']['ID'];
    $userName = $_SESSION['user']['Fname'] . ' ' . $_SESSION['user']['Lname'];
    $userEmail = $_SESSION['user']['email'];
    $userRole = $_SESSION['user']['roleID'];
}

$trackID = Sanitize($_GET['trackID'], 1);


if (!validate($id, 2)) {

    $_SESSION['messages'] = "invalid id ";
    header("Location: ../track/index.php");
}


$no_lesson = true;

$sql = "SELECT * FROM `lessons` WHERE `trackID` = $trackID";

$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) > 0) {
    // code 
    $no_lesson = false;
}

mysqli_close($con);

?>


<section class="content">
    <div class="container-fluid">

        <!-- Inline Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="p-b-15">
                            All lessons

                            <?php if($userRole == 2) { ?>
                            <a href='create.php?trackID=<?php echo $trackID; ?>' class='btn btn-warning m-r-1em waves-effect pull-right'>
                                <i class="material-icons">add_box</i>
                                <span>Add lesson</span>
                            </a>
                            <?php }?>

                        </h2>

                    </div>
                </div>
                <?php
                if ($no_lesson) {
                    echo "There are no lessons available";
                    // 
                } else {
                    while ($row = mysqli_fetch_assoc($op)) { ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="header bg-green">
                                    <h2>
                                        <?php echo $row['title']; ?>
                                    </h2>
                                </div>
                                <div class="body align-right">
                                    <a href='../exam/index.php?id=<?php echo $row['ID']; ?>' class='btn btn-warning m-r-1em '>Show</a>

                                    <a href='edit.php?id=<?php echo $row['ID']; ?>&trackID=<?php echo $trackID; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                    <a href='delete.php?id=<?php echo $row['ID']; ?>&trackID=<?php echo $trackID; ?>' class='btn btn-danger m-r-1em'>Delete</a>

                                </div>
                            </div>
                        </div>

                <?php }
                }
                ?>
            </div>
        </div>




    </div>
    <!-- #END# Inline Layout | With Floating Label -->

    </div>
</section>


<?php

require '../../shared components/footer.php';
?>