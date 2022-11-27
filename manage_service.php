<?php
include_once 'auth/session.php';
include('includes/dbconnection.php');

if(!isset($_SESSION['sid'])){
  header('location: logout.php');
  exit();
  };
?>
<!DOCTYPE html>
<html>
<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini">
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
              <h1>Jean's Mobile Beauty and Wellness Services</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Manage Services</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Services</h3>
                </div>
                <!-- /.card-header -->
                <div id="editData" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="info_update">
                       <?php @include("edit_service.php");?>
                     </div>
                     <div class="modal-footer ">
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </div>
              <!--   end modal -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th></th> 
                      <th>Name</th>
                      <th>Description</th>
                      <th>Price</th> 
                      <th>Duration</th>
                      <th>Action</th> 
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $ret=mysqli_query($con,"select * from  tblservices");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
                      ?>
                      <tr>
                        <th scope="row"><?php echo $cnt;?></th> 
                        <td><?php  echo $row['ServiceName'];?></td>
                        <td><?php  echo $row['description'];?></td>
                        <td><?php echo  'R'. htmlentities(number_format($row['Cost'], 0, '.', ','));?></td>
                        <td><?php  echo $row['duration'].' minutes';?></td> 
                        <td>
                         <button class="editBtn"><a href="#"  class=" edit_data" id="<?php echo  $row['ID']; ?>" title="click for edit">Edit</i></a></button>
                         <form method="post">
                          <button class="deleteBtn" type="submit" name="delete">Delete</button>
                          <input type="hidden" name="id" value="<?php echo  $row['ID']; ?>"/>
                        </form>
                        </td>
                      </tr>   
                      <?php 
                      $cnt=$cnt+1;
                    }?>

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
  <?php @include("includes/footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- ./wrapper -->
<?php @include("includes/foot.php"); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data',function(){
      var edit_id=$(this).attr('id');
      $.ajax({
        url:"edit_service.php",
        type:"post",
        data:{edit_id:edit_id},
        success:function(data){
          $("#info_update").html(data);
          $("#editData").modal('show');
        }
      });
    });
  });
</script>
</body>
</html>
<?php

  if(isset($_POST['delete'])){

    $seid= $_POST['id'];

    $query = mysqli_query($con, "DELETE FROM  tbleservices where ID=$seid;");

    if($query){
      echo "<script type='text/javascript'>
    Swal.fire({
      icon: 'success',
      title: 'Deleted',
      text: 'Services Updated',
      showConfirmButton: false,
      timer: 2000
      });</script>"; }
    else{
      echo "<script type='text/javascript'>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong',
      showConfirmButton: false,
      timer: 2000
      });
    </script>";
    }

  }

?>