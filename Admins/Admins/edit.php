<?php

require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';

# Validate & Sanitize id 

$id = Sanitize($_GET['id'], 1);


if (!validate($id, 2)) {

    $_SESSION['messages'] = "invalid id ";
    header("Location: index.php");
}





# Form Logic ... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE .... 

    $role = $_POST['roleID'];

    $erros = [];
    # Validate Input ... 
    if (!validate($role, 2)) {
        $erros['role'] = " invalid role id";
    }

    if (count($erros) > 0) {

        $_SESSION['errormessages'] = $erros;
    } else {

        # db Logic 
        $sql = "UPDATE `user` SET `roleID`=$role WHERE `ID`= $id";
        $op = mysqli_query($con, $sql);

        if ($op) {
            echo $sql;

            $_SESSION['messages'] = 'Record Updated';

            header("location: index.php");
        } else {
            $_SESSION['errormessages'] = ['error try again'];
        }
    }
}



# Fetch data ... 
$sql  = "select roleID from user where ID=$id";
$op   = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op);


$sql2  = "select * from role";
$op2   = mysqli_query($con, $sql2);

require '../../shared components/header.php';
require "../../shared components/nav.php";
require '../../shared components/sidNav.php';
?>


<section class="content">
    <div class="container-fluid">

        <!-- Inline Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            update role
                        </h2>

                    </div>
                    <div class="body">
                        <form method="post" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                            <div class="row clearfix">
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="">
                                            <div class="demo-radio-button pull-right">

                                                <?php
                                                while ($rows = mysqli_fetch_assoc($op2)) {
                                                    
                                                    echo '
                                                    <input name="roleID" value="' . $rows['ID'] . '" type="radio" class="with-gap radio-col-light-green" id="radio_' . $rows['ID'] . '" ';
                                                    if ($data['roleID'] == $rows['ID']) {
                                                        echo 'checked';
                                                    }
                                                    echo '/>
                                                    <label for="radio_' . $rows['ID'] . '"> ' . $rows['title'] . '</label>
                                                    ';
                                                }

                                                ?>

                                               
                                            </div>

                                            <label class="form-label">Role</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <button type="submit" class="btn btn-primary btn-block btn-lg m-l-15 pull-right waves-effect">Update</button>
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