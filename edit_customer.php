<?php
include_once 'auth/session.php';
include_once 'auth/db.php';
include('includes/dbconnection.php');

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

if(isset($_POST['submit']))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $mobilenum=$_POST['mobilenum'];
  $details=$_POST['details'];
  $cid=$_SESSION['edid'];
  $query=mysqli_query($con, "update  tblcustomers set name='$name',email='$email',mobilenumber='$mobilenum' where id='$cid' ");
  if ($query) {
    echo "<script type='text/javascript'>
    Swal.fire({
      icon: 'success',
      title: 'Details Updated Successfully!',
      showConfirmButton: false,
      timer: 2000
      });
      setTimeout(function(){window.open('customer_list.php','_self')},1500);
    </script>";
  }
  else
  {
    echo "<script type='text/javascript'>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong, please try again',
      timer: 2000
      });
    </script>";
  }
}
?>
<h4 class="card-title">Update Customer Details </h4>
<form method="post">
  <?php
  $eid=$_POST['edit_id'];
  $ret=mysqli_query($con,"select * from  tblcustomers where ID='$eid'");
  $cnt=1;
  while ($row=mysqli_fetch_array($ret)) 
  {
    $_SESSION['edid']=$row['ID'];
    ?> 
    <div class="card-body">
      <div class="form-group"> 
        <label for="exampleInputEmail1">Name</label> 
        <input type="text" class="form-control" id="name" name="name"  value="<?php  echo $row['name'];?>" required="true"> 
      </div> 
      <div class="form-group"> 
        <label for="exampleInputPassword1">Email</label> 
        <input type="text" id="email" name="email" class="form-control"  value="<?php  echo $row['email'];?>" required="true"> 
      </div>
      <div class="form-group"> 
        <label for="exampleInputPassword1">Mobile Number</label> 
        <input type="text" id="mobilenum" name="mobilenum" class="form-control"  value="<?php  echo $row['mobilenumber'];?>" required="true"> 
      </div>
      <div class="form-group"> 
        <label for="exampleInputEmail1">Address</label> 
        <textarea type="text" class="form-control" id="details" name="details" placeholder="Details" required="true" rows="4" cols="4"><?php  echo $row['Details'];?></textarea> 
      </div>
      <div class="form-group"> 
        <label for="exampleInputPassword1">Creation Date</label> 
        <input type="text" id="" name="" class="form-control"  value="<?php  echo $row['created_at'];?>" readonly='true'> 
      </div>
      <?php
    } ?>
    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary">Update</button>
      <span style="float: right;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </span>
    </div>
  </div>
</form>
