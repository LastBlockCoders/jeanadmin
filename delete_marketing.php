<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('auth/db.php')
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
} 
if(isset($_POST['submit']))
{
  $image=$_POST['image'];
  
  $cid=$_SESSION['edid'];
  $query=mysqli_query($con, "UPDATE  'marketingimgs' SET 'image'='$image' where id='$cid'");
  if ($query) {
    echo '<script>alert("Marketing Detail has been Updated.")</script>';
    echo "<script>window.location.href = 'view_marketing.php'</script>"; 
  }
  else
  {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}
?>
<h4 class="card-title">Delete Marketing Image</h4>
<form method="post">
  <p style="font-size:16px; color:red" align="center">
    <?php 
    if($msg){
      echo $msg;
    }  ?>
  </p>
  <?php
  $eid=$_POST['edit_id'];
  $ret=mysqli_query($con,"SELECT * FROM  'marketingimgs' WHERE id='$eid'");
  $cnt=1;
  while ($row=mysqli_fetch_array($ret)) 
  {
    $_SESSION['edid']=$row['id'];
    //code to delete here
 
    } ?>
    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary">Delete</button>
      <span style="float: right;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </span>
    </div>
  </div>
</form>
