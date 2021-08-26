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



$no_track = true;

$sql = "SELECT track.* , user.Fname as teacherID FROM `track` inner join `user` on track.teacherID =user.ID";

$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) > 0) {
    // code 
    $no_track = false;
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
                        <h2>
                            All tracks
                        </h2>

                    </div>
                </div>
                <?php
                if ($no_track) {
                    echo "There are no tracks available";
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
                                <div class="body " style="min-height: 100px;">
                                    <p>
                                        created by <?php echo $row['teacherID']?>
                                    </p>
                                        <a href='enroll.php?id=<?php echo $row['ID']; ?>' class='btn btn-primary m-r-1em pull-right'>show students</a>

                                        
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