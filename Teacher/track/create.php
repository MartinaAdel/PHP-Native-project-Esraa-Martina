<?php
require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';
require '../../shared components/header.php';
require "../../shared components/nav.php";
require '../../shared components/sidNav.php';


# Form Logic ... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {




    // CODE .... 

    $title = CleanInputs($_POST['title']);

    $erros = [];
    # Validate Input ... 
    if (!validate($title, 1)) {
        $erros['title'] = "Title Field Required";
    }

    if (count($erros) > 0) {

        $_SESSION['messages'] = $erros;
    } else {

        # db Logic 


        if (isset($_SESSION['user'])) {
            $userID =  $_SESSION['user']['ID'];
            $sql = "INSERT INTO `track`(`teacherID`, `title`) VALUES ( $userID,'$title')";

            $op = mysqli_query($con, $sql);

            if ($op) {
                header("location: index.php");
            } else {
                $_SESSION['messages'] = mysqli_error($con);
                exit();
            }
        } else {
            $_SESSION['messages'] = ['error try again'];
        }
    }
}


?>



<section class="content">
    <div class="container-fluid">

        <!-- Inline Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add new track
                        </h2>

                    </div>
                    <div class="body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title">
                                            <label class="form-label">Track Title</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php
                    # Dispaly error messages .... 

                    if (isset($_SESSION['messages'])) {
                        foreach ($_SESSION['messages'] as  $value) {
                            # code...
                            echo '
                            <div class="form-group form-float">
                                    <div class="form-line focused error">
                                        <input type="text" class="form-control" name="error" value="' . $value . '" >
                                    </div>
                                </div>
                            
                            
                            ';
                        }

                        unset($_SESSION['messages']);
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