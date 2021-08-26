<?php
require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';
require '../../shared components/header.php';
require "../../shared components/nav.php";
require '../../shared components/sidNav.php';


$id = Sanitize($_GET['id'], 1);


if (!validate($id, 2)) {

    $_SESSION['messages'] = "invalid id ";
    header("Location: ../track/index.php");
}


$no_questions = true;

$sql = "SELECT * FROM `questions` WHERE `lessonID` = $id";

$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) > 0) {
    // code 
    $no_questions = false;
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
                            Exam questions

                            <a href='create.php?lessonID=<?php echo $id; ?>' class='btn btn-warning m-r-1em waves-effect pull-right'>
                                <i class="material-icons">add_box</i>
                                <span>Add question</span>
                            </a>

                        </h2>

                    </div>
                </div>
                <?php
                if ($no_questions) {
                    echo "There are no questions available";
                    // 
                } else { ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Answer 1</th>
                                            <th>Answer 2</th>
                                            <th>Answer 3</th>
                                            <th>Answer 4</th>
                                            <th>Right answer</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($rows = mysqli_fetch_assoc($op)) {

                                        ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $rows['question']; ?></td>
                                                <td><?php echo $rows['answer1']; ?></td>
                                                <td><?php echo $rows['answer2']; ?></td>
                                                <td><?php echo $rows['answer3']; ?></td>
                                                <td><?php echo $rows['answer4']; ?></td>
                                                <td><?php echo $rows['right_answer']; ?></td>

                                                <td>
                                                    <a href='edit.php?id=<?php echo $rows['ID']; ?>&lessonID=<?php echo $id; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                                    <a href='delete.php?id=<?php echo $rows['ID']; ?>&lessonID=<?php echo $id; ?>' class='btn btn-danger m-r-1em'>Delete</a>

                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php  } ?>
            </div>
        </div>




    </div>
    <!-- #END# Inline Layout | With Floating Label -->

    </div>
</section>


<?php

require '../../shared components/footer.php';
?>