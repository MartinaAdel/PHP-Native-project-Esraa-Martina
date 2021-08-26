<?php


require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';

require '../../shared components/header.php';
require "../../shared components/nav.php";

$sql = "select * from adminstype";
$op  =  mysqli_query($con, $sql);

$sql = "select * from role";
$op  =  mysqli_query($con, $sql);
?>

<?php
require '../../shared components/sidNav.php';
?>






<section class="content">
    <div class="container-fluid">

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                <h3>Users role</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            while ($rows = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $rows['title']; ?></td>

                                    <td>
                                        <!-- <a href='delete.php?id=<?php echo $rows['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a> -->
                                        <a href='edit.php?id=<?php echo $rows['ID']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <lo>
            <?php
            # Dispaly error messages .... 

            if (isset($_SESSION['messages'])) {

                # code...
                echo '<li class="breadcrumb-item active">' . $_SESSION['messages'] . '</li>';

                unset($_SESSION['messages']);
            } 

            ?>

            </ol>
    </div>
</section>


<?php

require '../../shared components/footer.php';
?>