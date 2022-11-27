<?php
include_once 'auth/session.php';
include_once 'auth/db.php';

if (isset($_SESSION['sid'])) {
  if(isset($_SESSION['permission'])){
    if (($_SESSION['permission'] != "Superuser") && ($_SESSION['permission'] != "Admin")) {
    header('location: logout.php');
    exit();
    }
    }
}else{
  header('location:logout.php');
}
include('includes/dbconnection.php');
// if (strlen($_SESSION['bpmsaid']==0)) {
//   header('location:logout.php');
// } 
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
    <div class="content-wrapper" style="font-size: smaller">
      <!-- Content Header (Page header) -->
      <section class="content-header" style="font-size: smaller">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3>Appointments</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Search appointments</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
              
            <div id="editData" class="modal fade">
             <div class="modal-dialog modal-lg ">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">View Appointment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="info_update">
                  <?php @include("view_appointment.php");?>
                </div>
                <div class="modal-footer ">
                </div>
                <!-- /.modal-content -->
                </div>
           
              </div>
            <!-- /.modal -->
          </div>
      </div>
          <!--   end modal -->
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <!-- Input addon -->
              <div class="card card-info">
                <div class="card-header" style="background-color: teal;">
                  <h3 class="card-title">Search Appointment</h3>
                </div>
                <div class="card-body" style ="background-color: teal;">
                 <form method="post" name="search" action="">
                  <div class="input-group input-group-md">
                    <input type="text" id="searchdata"  name="searchdata" required="true" class="form-control">
                    <span class="input-group-append">
                      <button type="submit" name="search"  class="btn btn-flat" style="background-color:gold; color: teal;">Go!</button>
                    </span>
                  </div>
                </form>
                <!-- /input-group -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="row">
          <div class="col-md-6">
          <div class="card-body">
            <?php
            if(isset($_POST['search']))
            { 

              $sdata=$_POST['searchdata'];
              ?>
              <h5 align="center" style="color: teal;" class="mb-3">Result against "<?php echo $sdata;?>" keyword </h4> 
              <table id="" class="table  table-hover"> 
                <thead> 
                  <tr> 
                    <th>#</th> 
                   
                    <th>Name</th>
                    <th>Phone</th> 
                    <th>Date</th>
                    <th>Time</th>
                    <th> Status</th> 
                    <th>Action</th> 
                  </tr> 
                </thead> 
                <tbody>
                  <?php
                  $ret=mysqli_query($con,"select *from  tblappointment where name like '%$sdata%' || email like '%$sdata%' || phone like '%$sdata%'");
                  $num=mysqli_num_rows($ret);
                  if($num>0){
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {

                      ?>

                      <tr> 
                        <th scope="row"><?php echo $cnt;?></th> 
                       
                        <td><?php  echo $row['name'];?></td>
                        <td><?php  echo $row['phone'];?></td>
                        <td><?php  echo $row['apt_date'];?></td> 
                        <td><?php  echo $row['start_time'];?></td>
                        <td><?php  echo $row['status'];?></td> 
                        <td><a href="#" class=" edit_data" id="<?php echo  $row['id']; ?>" title="click for edit">View</a></td>  
                        </tr>   <?php 
                        $cnt=$cnt+1;
                      } 
                    } else { ?>
                      <tr>
                        <td colspan="8"> No record found against this search</td>

                      </tr>

                    <?php } 
                  }?>
                </tbody> 
              </table> 
            </div>
         
          <!-- /.row -->
             
               
                </div>
        </div><!-- /.container-fluid -->
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
          url:"view_appointment.php",
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
