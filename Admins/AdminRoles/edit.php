<?php 

require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';

# Validate & Sanitize id 

    $id = Sanitize($_GET['id'],1);


    if(!validate($id,2)){
    
        $_SESSION['messages'] = "invalid id ";
        header("Location: index.php");
       }





 # Form Logic ... 

 if($_SERVER['REQUEST_METHOD'] == "POST"){

    // CODE .... 

    $title = CleanInputs($_POST['title']);

     $erros = [];
     # Validate Input ... 
    if(!validate($title,1))
    {
      $erros['title'] = "Title Field Required";
    }

    if(count($erros) > 0){

        $_SESSION['errormessages'] = $erros;
    }else{

   # db Logic 
   $sql = "update role set title = '$title' where ID = $id";
   $op = mysqli_query($con,$sql);

     if($op){
        
        $_SESSION['messages'] = 'Record Updated';

         header("location: index.php");
     }else{
         $_SESSION['errormessages'] = ['error try again'];
      }

    }


 }



# Fetch data ... 
$sql  = "select * from role where ID=$id";
$op   = mysqli_query($con,$sql);
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
                            update role
                        </h2>

                    </div>
                    <div class="body">
                        <form method="post" action="edit.php?id=<?php echo $data['ID'];?>" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" value="<?php echo $data['title']; ?>">
                                            <label class="form-label">Role Title</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">update</button>
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