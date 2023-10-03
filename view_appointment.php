<?php

include_once 'auth/session.php';
include_once 'auth/db.php';
include_once 'functions/functions.php';

if (isset($_SESSION['sid'])) {
  if(isset($_SESSION['permission'])){
    if (($_SESSION['permission'] != "Superuser") && ($_SESSION['permission'] != "Admin")) {
    header('location: logout.php');
    exit();
    }
    }
}
else{
  header('location:logout.php');
}
?>
<div class="card-body" style="font-size: smaller">
  <div class="table-responsive bs-example widget-shadow">
    <?php
    $cid=$_POST['edit_id'];
    $ret=mysqli_query($con,"select * from tblappointment where id='$cid'");
    $cnt=1;
    while ($row=mysqli_fetch_array($ret)) {
     $_SESSION['aid']=$row['id'];

     ?>
     <table class="table table-bordered">
     <tr>
        <th>Service</th>
        <td style='color: teal;'><?php  echo GetServiceName($con,$row['services']);?></td>
      </tr>
      <tr>
        <th>Recipients</th>
        <td style='color: teal;'><?php  echo $row['recipients'];?></td>
      </tr>
      <tr>
        <th>Client</th>
        <td style='color: teal;'><a class="myLink" href= <?php $str = $row['phone'];
                              $number= ltrim($str, "0");
                               echo "https://wa.me/27{$number}?text=Good%20day%2C%20This%20is%20Jeans%20Mobile%20Beauty%20and%20Wellness";?>>
                               <?php  echo $row['name'];?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td style='color: teal;'><?php  echo $row['email'];?></td>
      </tr>
      <tr>
        <th>Mobile Number</th>
        <td style='color: teal;'><a class="myLink" href= <?php $str = $row['phone'];
                              $number= ltrim($str, "0");
                               echo "https://wa.me/27{$number}?text=Good%20day%2C%20This%20is%20Jeans%20Mobile%20Beauty%20and%20Wellness";?>>
                               <?php  echo $row['phone'];?></td>
      </tr>
      <tr>
        <th>Date</th>
        <td style='color: teal;'><?php  echo $row['apt_date'];?></td>
      </tr>

      <tr>
        <th>Start Time</th>
        <td style='color: teal;'><?php  echo $row['start_time'];?></td>
      </tr>
      <tr>
        <th>End Time</th>
        <td style='color: teal;'><?php  echo $row['end_time'];?></td>
      </tr>
      <tr>
        <th>Overall Duration</th>
        <td style='color: teal;'><?php  echo $row['total_duration']." minutes";?></td>
      </tr>
      <tr>
        <th>Address</th>
        <td style='color: teal;'><a class="myLink" href=  <?php 
                        $address = $row['location'];
                          $removeSpace = str_replace(" ","+",$address);
                          $url = str_replace(",","%2C",$removeSpace);
                          echo "https://www.google.com/maps/search/?api=1&query={$url}";
                        ?>> <?php  echo $row['location'];?></a></td>
      </tr>
      <tr>
        <th>Distance(from office) </th>
        <td style='color: teal;'><?php  echo $row['loc_distance'].' km away and '.$row['time_travel'].' minutes drive';?></td>
      </tr>
      <tr>
        <th>Total</th>
        <td style='color: teal;'><?php  echo "<p style='color: green'><b>R ".$row['total']."</b></p>";?></td>
      </tr>

      <tr>
        <th>Status</th>
        <td> <?php 
          if($row['status']=="0")
          {
            echo "<button class='deleteLabel'>Declined</button>";
          } 
        if($row['status']=="1")
        {
          echo "<button class='scheduledLabel'>Scheduled</button>";
        }
        if($row['status']=="2")
        {
          echo "<button class='pendingLabel'>Pending</button>";
        }
        if($row['status']=="3")
        {
          echo "<button class='completeLabel'>Completed</button>";
        }
        if($row['status']=="4")
        {
          echo "<button class='missedLabel'>Missed</button>";
        }
        ;?></td>
      </tr>
    </table>
    <!--make radio buttons----> <!--add name and email as hidden inputs--->
    <div class="container">
    <?php 
          if($row['status']=="2"){ ?>
        <form name="update" method="post" action="includes/reply.inc.php">    
          <div class="row mb-3">';
          <label> Reply :</label><select name="status" class="form-control wd-450" required="true">
          <option value="1" selected="true">Schedule</option>
          <option value="0">Decline</option>
          </select>;
         </div>;
         
        <input type="hidden" name="name" value= <?php echo $row['name']; ?>>
        <input type="hidden" name="email" value=<?php  echo $row['email'];?>>
        
        <input type="hidden" name="date" value= <?php echo $row['apt_date']; ?>>
        <input type="hidden" name="time" value= <?php echo $row['start_time']; ?>>
        <input type="hidden" name="service" value= <?php echo $row['services']; ?>>
        <input type="hidden" name="recipients" value= <?php echo $row['recipients']; ?>>
        <input type="hidden" name="total" value= <?php echo $row['total']; ?>>
        <div class="row centered">
          <button type="submit" name="reply" class="btn editBtn">Submit</button>
        </div>
      </form>
    <?php }
    ?><?php if($row['status']=="1"){
          ?>
          <form name="update" method="post" action="includes/outcome.inc.php">    
          <div class="row mb-3">';
          <label> Outcome :</label><select name="status" class="form-control wd-450" required="true">
          <option value="3" selected="true">Completed</option>
          <option value="4">Missed</option>
          </select>;
         </div>;
         
        <input type="hidden" name="id" value= <?php echo $row['id']; ?>>
        
        <div class="row centered">
          <button type="submit" name="outcome" class="btn editBtn">Save</button>
        </div>
      </form>
      <?php 
    }; ?>
     </div>
    
    <?php } ?>
  </div>
</div>
