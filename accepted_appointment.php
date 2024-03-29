<?php

include_once 'auth/session.php';
include_once 'includes/dbconnection.php';

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
              <h1 style="font-size: x-larger">Scheduled Appointments</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Scheduled Appointments</li>
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
                  <h3 class="card-title">Scheduled Appointments</h3>
                </div>
                <!-- /.card-header -->
                <div id="editData" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Scheduled appointments</h5>
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
               <?php
               include_once 'functions/functions.php';
               ?>
               <div class="card-body">
                <table id="example1" class="table table-hover">
                  <thead> 
                    <tr> 
                    <th>Service</th> 
                    <th>Client</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Total</th>
                    </tr> 
                  </thead> 
                  <tbody>
                    <?php
                    $ret=mysqli_query($con,"select *from  tblappointment where status='1'");
             
                    while ($row=mysqli_fetch_array($ret)) {

                      ?>

                      <tr> 
                        <td><?php  echo GetServiceName($con,$row['services']);?></td>
                        <td><a class="myLink" href= <?php $str = $row['phone'];
                              $number= ltrim($str, "0");
                               echo "https://wa.me/27{$number}?text=Good%20day%2C%20This%20is%20Jeans%20Mobile%20Beauty%20and%20Wellness";?>>
                               <?php  echo $row['name'];?></a></td>
                        <td><?php  echo $row['apt_date'];?></td> 
                        <td><?php  echo $row['start_time'].' - '.$row['end_time'];?></td>
                      
                        <td ><a class="myLink" href=  <?php 
                        $address = $row['location'];
                          $removeSpace = str_replace(" ","+",$address);
                          $url = str_replace(",","%2C",$removeSpace);
                          echo "https://www.google.com/maps/search/?api=1&query={$url}";
                        ?>> <?php  echo $row['location'];?></a></td>
                        <td><?php  echo "R. ".$row['total'];?></td> 
                        <td>
                          <button class="viewBtn"><a href="#" class=" edit_data" id="<?php echo  $row['id']; ?>" title="click for edit">View</a></button></td> 
                      </tr>   
                      <?php 
                   
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
  <script type='text/javascript'>
			Swal.fire({
        position: 'top-end',
				icon: 'question',
				title: 'Client Check',
				text: 'Remember to follow up with clients regarding their appointment by clicking their name for a WHatsApp chat.',
				timer: 3500,
        showConfirmButton:false,
			  });
			</script>
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
<?php
  if(isset($_GET['error'])){
    if($_GET['error'] == 'none'){
      echo "<script type='text/javascript'>
      Swal.fire({
        icon: 'success',
        title: 'Request Closed',
        showConfirmButton: false,
        timer: 2000
        });</script>";
    }
    elseif($_GET['error'] == 'somethingwentwrong'){
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