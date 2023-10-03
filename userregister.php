<?php 

include_once 'auth/session.php';
include_once 'auth/db.php';

include_once 'includes/dbconnection.php';

if (!isset($_SESSION['sid']) || ($_SESSION['permission'] != "Superuser")) {
  header('location: logout.php');
  exit();
} 
?>

<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php @include("includes/header.php"); ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php @include("includes/sidebar.php"); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="font-size: small">
      <!-- Content Header (Page header) -->
      <section class="content-header" style="font-size: small">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <h1>DataTables</h1> -->
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User Management</li>
              </ol>
            </div>
          </div>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <?php
                  $sql ="SELECT id from tblusers";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $count=$query->rowCount();
                  ?>
                  <h3 class=""><?php echo htmlentities($count);?></h3>
                  <p>Total Users</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <?php
                  $sql ="SELECT id from tblusers where gender='male'";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $count=$query->rowCount();
                  ?>
                  <h3 class=""><?php echo htmlentities($count);?></h3>
                  <p>Male</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <?php
                  $sql ="SELECT id from tblusers where gender='female'";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $count=$query->rowCount();
                  ?>
                  <h3 class=""><?php echo htmlentities($count);?></h3>
                  <p>Female</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <?php
                  $sql ="SELECT id from tblusers  where status='1'";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $count=$query->rowCount();
                  ?>
                  <h3 class=""><?php echo htmlentities($count);?></h3>    

                  <p>Active Users</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section><!-- /.section -->
      <!-- /.content-wrapper -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="">

          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">User Management</h3><br>
                  <div class="card-tools">
                   <button type="button" class="btn btn-sm deleteBtn" data-toggle="modal" data-target="#delete" ></i> See blocked users
                   </button>
                   <button type="button" class="btn btn-sm editBtn" data-toggle="modal" data-target="#deposit" ><i class="fas fa-plus" ></i> Register New User
                   </button>
                 </div>
               </div>
               <!-- /.card-header -->
               <div class="modal fade" id="deposit">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Register New User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- <p>One fine body&hellip;</p> -->
                      <?php @include("newuser-form.php");?>
                    </div>
                      <!-- <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div> -->
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <div class="modal fade" id="delete">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Blocked User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- <p>One fine body&hellip;</p> -->
                        <?php @include("blockedusers.php");?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


                <div class="card-body">
                  <table id="example1" class="table table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Permission</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                     $aid=$_SESSION['sid'];
                     $sql="SELECT * from tblusers where status='1'";
                     $query = $dbh -> prepare($sql);
                     $query->execute();
                     $results=$query->fetchAll(PDO::FETCH_OBJ);

                     $cnt=1;
                     if($query->rowCount() > 0)
                     {
                      foreach($results as $row)
                        {               ?>
                         <tr>
                          <td class="text-left"><?php  echo "$row->firstname"." "."$row->lastname";?></td>
                          <td class="text-left"><?php  echo htmlentities($row->phone);?></td>
                          <td class="text-left" ><?php  echo htmlentities($row->email);?></td>
                          <td class="text-left"><?php  echo htmlentities($row->permission);?></td>
                          <td class="text-left">
                          <form action="includes/block.inc.php" method="post">
                            <input type="hidden" name="delid" value="<?php echo $row->id; ?>">
                            <button type="submit" name="submit" class="deleteBtn">Block</button>
                          </form>
                         </td>
                       </tr>

                       <?php 
                     }
                   }; ?>
                 </tbody>

               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->
     </div>
     <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 <?php
    if(isset($_GET['action'])){
      if($_GET['action'] == 'blocked'){
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'success',
          title: 'User Blocked',
          showConfirmButton: false,
          timer: 2500
          });
        </script>";
      }
      elseif($_GET['action'] == 'restored'){
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'success',
          title: 'User Unblocked',
          showConfirmButton: false,
          timer: 2500
          });
        </script>";
      }
    }
?>
 <?php @include("includes/footer.php"); ?>

 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<!-- ./wrapper -->
<?php @include("includes/foot.php"); ?>
<!-- page script -->
</body>
</html>

