<?php
include_once 'auth/db.php';
include_once 'includes/dbconnection.php';
include_once 'auth/session.php';
include_once 'functions/functions.php';

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
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Add Call-in Client</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row offset-md-1">
             <div class="col-md-8 mr-3">
              <!-- general form elements -->
              <div class="card rounded" style="background: teal; color: white;">
                <div class="card-header  rounded">
                  <h3 class="card-title">Add Call-in Client</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" class="rounded" action="includes/ad_cus.inc.php">
                  <div class="card-body">
                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Name</label> 
                      <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="" required="true"> 
                    </div> 
                    <div class="form-group"> 
                      <label for="exampleInputPassword1">Email</label> 
                      <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="" required="true"> 
                    </div>
                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Mobile Number</label> 
                      <input type="text" class="form-control" id="mobilenum" name="mobilenum" placeholder="Mobile Number" value="" required="true" >
                    </div>
                    <button type="submit" name="submit" class="btn ResBtn">Add</button>
                  </form> 
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php if(isset($_GET['error'])){
          if($_GET['error'] == 'number'){
            echo "<script type='text/javascript'>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Incorrect number',
              showConfirmButton: false,
              timer: 2000
              });
            </script>";
          }elseif($_GET['error'] == 'email'){
            echo "<script type='text/javascript'>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Incorrect email',
        showConfirmButton: false,
        timer: 2000
        });
      </script>";  
          }
      }

      ?>
      <?php @include("includes/footer.php"); ?>
    </div>
    <!-- ./wrapper -->
    <?php @include("includes/foot.php"); ?>
  </body>
  </html>
 
