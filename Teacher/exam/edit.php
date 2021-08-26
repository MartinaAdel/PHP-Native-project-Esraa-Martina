<?php

require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';


# Validate & Sanitize id 

$id = Sanitize($_GET['id'], 1);

$lessonID = Sanitize($_GET['lessonID'], 1);

if (!validate($id, 2)) {

    $_SESSION['messages'] = "invalid id ";
    header("Location: index.php");
}





# Form Logic ... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE .... 
    $question = CleanInputs($_POST['question']);
    $answer1 = CleanInputs($_POST['answer1']);
    $answer2 = CleanInputs($_POST['answer2']);
    $answer3 = CleanInputs($_POST['answer3']);
    $answer4 = CleanInputs($_POST['answer4']);

    $right_answer = $_POST['right_answer'];

    $erros = [];
    # Validate Input ... 
    if (!validate($question, 1)) {
        $erros['question'] = "question Field Required";
    }
    if (!validate($answer1, 1)) {
        $erros['answer1'] = "answer1 Field Required";
    }
    if (!validate($answer2, 1)) {
        $erros['answer2'] = "answer2 Field Required";
    }
    if (!validate($answer3, 1)) {
        $erros['answer3'] = "answer3 Field Required";
    }
    if (!validate($answer4, 1)) {
        $erros['answer4'] = "answer4 Field Required";
    }
    if (count($erros) > 0) {

        $_SESSION['messages'] = $erros;
    } else {

        # db Logic 
        $sql = "UPDATE `questions` SET `question`='$question',`answer1`='$answer1',`answer2`='$answer2',`answer3`='$answer3',`answer4`='$answer4',`right_answer`=$right_answer WHERE `ID`= $id";
        $op = mysqli_query($con, $sql);

        if ($op) {

            $_SESSION['messages'] = 'Record Updated';

            header("Location: index.php?id=$lessonID");
        } else {
            $_SESSION['messages'] = mysqli_error($con);
            $_SESSION['errormessages'] = ['error try again'];
        }
    }
}



# Fetch data ... 
$sql  = "select * from questions where ID=$id";
$op   = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op);




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
                            update question
                        </h2>

                    </div>
                    <div class="body">
                        <form method="post" action="edit.php?id=<?php echo $data['ID']; ?>&lessonID=<?php echo $lessonID; ?>" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="question" value="<?php echo $data['question']; ?>">
                                            <label class="form-label">Question</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="answer1" value="<?php echo $data['answer1']; ?>">
                                            <label class="form-label">Answer 1</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="answer2" value="<?php echo $data['answer2']; ?>">
                                            <label class="form-label">Answer 2</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="answer3" value="<?php echo $data['answer3']; ?>">
                                            <label class="form-label">Answer 3</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="answer4" value="<?php echo $data['answer4']; ?>">
                                            <label class="form-label">Answer 4</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="">
                                            <div class="demo-radio-button pull-right">

                                                <?php
                                                for ($i = 1; $i < 5; $i++) {
                                                    # code...
                                                    echo '
                                                    <input name="right_answer" value="' . $i . '" type="radio" class="with-gap radio-col-light-green" id="radio_' . $i . '" ';
                                                    if ($data['right_answer'] == $i) {
                                                        echo 'checked';
                                                    }
                                                    echo '/>
                                                    <label for="radio_' . $i . '">Answer ' . $i . '</label>
                                                    ';
                                                }

                                                ?>

                                                <!-- <input name="right_answer" value="1" type="radio" class="with-gap radio-col-light-green" id="radio_1" checked/>
                                                <label for="radio_1">Answer 1</label>
                                                <input name="right_answer" value="2" type="radio" id="radio_2" class="with-gap radio-col-light-green" />
                                                <label for="radio_2">Answer 2</label>
                                                <input name="right_answer" value="3" type="radio" class="with-gap radio-col-light-green" id="radio_3" />
                                                <label for="radio_3">Answer 3</label>
                                                <input name="right_answer" value="4" type="radio" id="radio_4" class="with-gap radio-col-light-green" />
                                                <label for="radio_4">Answer 4</label> -->

                                            </div>

                                            <label class="form-label">Right Answer</label>
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