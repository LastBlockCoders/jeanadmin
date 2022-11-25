<?php

include_once 'auth/session.php';
include_once 'auth/db.php';

if(isset($_SESSION['permission'])){
  if (($_SESSION['permission'] != "Superuser") && ($_SESSION['permission'] != "Admin")) {
  header('location: dashboard.php?error=denied');
  exit();
  }
  };

if(isset($_POST['submit']))
{
  $sername=$_POST['sername'];
  $price=$_POST['price'];
  $description=$_POST['description'];
  $duration=$_POST['duration'];

  $eid=$_SESSION['edid'];
  $query=mysqli_query($con, "update  tblservices set name='$sername',description='$description',price='$price',duration='$duration'  where ID='$eid';");
  if ($query) {
    //$msg="Service has been Updated.";
    echo "<script type='text/javascript'>
			Swal.fire({
				icon: 'success',
				title: 'Success',
				text: 'Service Updated',
        showConfirmButton: false,
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
        showConfirmButton: false,
				timer: 2000
			  });
			</script>";
    //$msg="Something Went Wrong. Please try again";
  }
}
?>
<h4 class="card-title">Update Service:</h4>
<form role="form" method="post">
  <?php
  $eid=$_POST['edit_id'];
  $ret=mysqli_query($con,"select * from  tblservices where id='$eid'");
  $cnt=1;
  while ($row=mysqli_fetch_array($ret))
  {
    $_SESSION['edid']=$row['ID'];
    ?> 
    <div class="card-body">
      <div class="form-group">
        
        <input type="text" class="form-control" id="sername" name="sername" placeholder="Service Name" value="<?php  echo $row['ServiceName'];?>" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Service Description" value="<?php  echo $row['description'];?>" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Price</label>
        <input type="text" id="cost" name="price" class="form-control" placeholder="Price" value="<?php  echo $row['Cost'];?>" required="true">
      </div>
      <div class="form-group">
        <label for="duration">Duration</label>
        <input type="text" id="duration" name="duration" class="form-control" placeholder="Duration" value="<?php  echo $row['duration'];?>" required="true">
      </div>
      <?php 
    } ?>
    <div class="card-footer">
      <button type="submit" name="submit" class="editBtn">Submit</button>
      <span style="float: right;">
        <button type="button" class="deleteBtn" data-dismiss="modal">Cancel</button>
      </span>
    </div>
  </div>
  <!-- /.card-body -->
</form>