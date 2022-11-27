<?php
include_once 'auth/db.php';
include_once 'includes/dbconnection.php';

 
if (isset($_SESSION['sid'])) {
  header('location: logout.php');
  exit();
}  
else

  if(isset($_POST['submit']))
  {
    $cat_id = $_POST['category'];
    $name=$_POST['sername'];
    $description=$_POST['description'];
    $price=$_POST['cost'];
    $duration=$_POST['duration'];
    $promo_price = $_POST['promo_price'];
    $on_promo = $_POST['on_promo'];
    $query=mysqli_query($con, "insert into  tblservices(cat_id,name,description,price,promo_price,on_promo,duration) values($cat_id,'$name','$description',$price, $promo_price,$on_promo,$duration);");
    if ($query) {
      echo "<script type='text/javascript'>
			Swal.fire({
				icon: 'success',
				title: 'Success',
				text: 'New Service Added',
				timer: 2000
			  });
			</script>";
    }
    else
    {
      echo "<script type='text/javascript'>
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Something went wrong',
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
                  <li class="breadcrumb-item active">Add Service</li>
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
              <div class="card rounded" style="background: teal; color: white;">
                <div class="card-header">
                  <h3 class="card-title">Add Beauty/Wellness Service</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Category</label>
                      <select name="category" id="category" class="form-control"required>
												<option value="">Select Service Category</option>
												<?php $query=mysqli_query($con,"select * from servicecategory");
												while($row=mysqli_fetch_array($query))
												{
													?>
													<option style="color: teal; text-transform: capitalize;" value="<?php echo $row['id'];?>" ><?php echo $row['name'];?></option>
													<?php
												} ?> 
												</select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="sername" name="sername" placeholder="Enter service name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" class="form-control" id="description" name="description" placeholder="Enter description of service">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Price</label>
                      <input type="text" class="form-control" id="cost" name="cost" placeholder="Price">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Promotional Price</label>
                      <input type="text" class="form-control" id="promo_price" name="pomo_price" placeholder="Price when on promotion">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Duration (in minutes)</label>
                      <input type="number" class="form-control" id="duration" name="duration" placeholder="Enter duration of service">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Activate Promotion</label>
                      <select name="on_promo" class="form-control">
                      <option value="0" selected="true">No</option>
                      <option value="1">Yes</option>
                      </select>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn ResBtn">Submit</button>
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

