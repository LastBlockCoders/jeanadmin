<?php
include_once 'auth/session.php';
include_once 'auth/db.php';

if (!isset($_SESSION['sid'])) {
  header('location: logout.php');
  exit();
} 

if(isset($_POST['save'])){
  $uid=$_SESSION['gid'];
  $invoiceid=mt_rand(100000000, 999999999);
  $sid=$_POST['sids'];
  $reci=$_POST['reci'];
  for($i=0;$i<count($sid);$i++){
   $svid=$sid[$i];
   for($j=0;$j<count($reci);$j++){
    $rid = $reci[$j];
    if($rid>0){
   $ret=mysqli_query($con,"insert into tblinvoice(Userid,ServiceId,recipients,BillingId) values('$uid','$svid','$rid','$invoiceid');");
   echo "<script type='text/javascript'>
   Swal.fire({
     icon: 'success',
     title: 'Invoice Generated',
     text: '$invoiceid',
     showConfirmButton: false,
     timer: 3000
     });
     setTimeout(function(){window.open('invoices.php','_self')},1000);</script>";
   }}}
}
?>
<div class="card-body">
  <h4>Assign Services:</h4>
  <form method="post">
    <table class="table table-responsive"> 
      <thead>
       <tr>
        <th>Service</th><th>Recipients</th> <th>Price</th> <th>Action</th> 
      </tr> 
    </thead> 
    <tbody>
      <?php
      $eid=$_POST['edit_id'];
      $ret=mysqli_query($con,"select * from  tblcustomers where ID='$eid'");
      $cnt=1;
      while ($row=mysqli_fetch_array($ret)) 
      {
        $_SESSION['gid']=$row['ID'];
      }
      $ret=mysqli_query($con,"select *from  tblservices");
      $cnt=1;
      while ($row=mysqli_fetch_array($ret)) {
        ?>
        <tr> 
         
          <td><?php  echo $row['ServiceName'];?></td>
          <td><input name="reci[]" size="3"/></td>
          <td><?php  echo $row['Cost'];?></td>
          <td><input type="checkbox" name="sids[]" value="<?php  echo $row['ID'];?>" ></td> 
        </tr>   
        <?php 
        $cnt=$cnt+1;
      }?>
      <tr><td><input type="datetime" placeholder="Date"/></td></tr>
      <tr><td><input type="text" placeholder="Address"/></td></tr>
      <tr>
        <td colspan="4" align="center">
          <button type="submit" name="save" class="btn completeBtn">Submit</button>   
        </td>
      </tr>
    </tbody> 
  </table> 
</form>
</div>
  <!-- /.card-body -->