<?php
include_once 'auth/session.php';
include_once 'auth/db.php';
include_once 'includes/dbconnection.php';

if (isset($_SESSION['sid'])) {
    if (($_SESSION['permission'] != "Secretary")) {
      header('location: logout.php');
      exit();
      }
  }
  else{
    header('location:logout.php');
  }
  

?>
<?php if(isset($_POST['market'])){

    $m_image = $_FILES['m_image']['name'];

    $Mimage_tmp = $_FILES['m_image']['tmp_name'];

    move_uploaded_file ($Mimage_tmp,"marketing/{$m_image}");

    $sql = "INSERT INTO timages(name) VALUES('$m_image')";

    $add_image = mysqli_query($con, $sql);

    if ($add_image) {
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'success',
          title: 'Added',
          text: 'Marketing Updated',
          showConfirmButton: false,
          timer: 2000
          });
          setTimeout(function(){window.open('view_marketing.php','_self')},1500);
        </script>";
    }
    else
    {
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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Add Marketing</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row offset-md-2">
             <div class="col-md-6">
              <!-- general form elements -->
              <div class="card " style="background-color: peach; color: teal;">
                <div class="card-header"  style="background-color: teal; color: white;">
                  <h3 class="card-title">Add marketing</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST"  enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                  <div class="card-body">
                    <div class="form-group">
                      <input type="file" name="m_image">
                    </div>
                  </div>
                  <div class="card-footer"  style="background-color: teal; color: white;">
                    <button type="submit" name="market" class="btn viewBtn">Upload</button>
                  </div>
                </form>
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
</body>
</html>

