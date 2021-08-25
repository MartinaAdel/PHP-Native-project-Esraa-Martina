
<?php 

require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';


 # fetch all admins Role ... 

 $sql = "select user.*,role.title as title   from user join role on user.roleID = role.ID";
 $op  =  mysqli_query($con,$sql);

//    echo  mysqli_error($con); 
//    exit();

require '../../shared components/header.php';
require '../../shared components/nav.php';
?>

<div id="layoutSidenav">
        
<?php 
 require '../../shared components/sidNav.php';
 ?>
           <div id="layoutSidenav_content">
               <main>                  
               <div class="container-fluid">
                       <h1 class="mt-4">Dashboard</h1>
                       <ol class="breadcrumb mb-4">
                           

                           <?php 
                       # Dispaly error messages .... 

                       if(isset($_SESSION['messages'])){
                          
                               # code...
                               echo '<li class="breadcrumb-item active">'.$_SESSION['messages'].'</li>';

                               unset($_SESSION['messages']);
                       }else{
                       echo '<li class="breadcrumb-item active">Display Roles</li>';

                       }
                  
                  ?>

                       </ol>
                      



                       <div class="card mb-4">
                           <div class="card-header">
                               <i class="fas fa-table mr-1"></i>
                               DataTable Example
                           </div>
                           <div class="card-body">
                               <div class="table-responsive">
                                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                       <thead>
                                           <tr>
                                               <th>#</th>
                                               <th>Name</th>
                                               <th>Email</th>
                                               <th>Type</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
           
                                       <tbody>
                                <?php 
                                   $i = 1;
                                   while($rows = mysqli_fetch_assoc($op)){
                                 
                                ?>         
                                       <tr>
                                               <td><?php echo $i++; ?></td>
                                               <td><?php echo $rows['Fname']. ' ' . $rows['Lnme'];?></td>
                                               <td><?php echo $rows['email'];?></td>                                               
                                               <td><?php echo $rows['title'];?></td>
                                               
                <td>
                <a href='delete.php?id=<?php echo $rows['ID'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                <!-- <a href='edit.php?id=<?php echo $rows['ID'];?>' class='btn btn-primary m-r-1em'>Edit</a>        -->
               </td> 
                                          
                                           </tr>
                                 <?php } ?>         
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
               </main>
              
              
          
               
<?php 

require '../../shared components/footer.php';
?>