<?php

include_once 'auth/session.php';
include_once 'auth/db.php';
include_once 'functions/functions.php';
?>
<div class="card-body">
  <div class="table-responsive bs-example widget-shadow">
    <?php
    $cid=$_POST['edit_id'];
    $ret=mysqli_query($con,"select * from tblappointment where ID='$cid'");
    $cnt=1;
    while ($row=mysqli_fetch_array($ret)) {
     $_SESSION['aid']=$row['ID'];

     ?>
     <table class="table table-bordered">
     <tr>
        <th>Service</th>
        <td style='color: teal;'><?php  echo GetServiceName($con,$row['Services']);?></td>
      </tr>
      <tr>
        <th>Recipients</th>
        <td style='color: teal;'><?php  echo $row['recipients'];?></td>
      </tr>
      <tr>
        <th>Client</th>
        <td style='color: teal;'><?php  echo $row['Name'];?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td style='color: teal;'><?php  echo $row['Email'];?></td>
      </tr>
      <tr>
        <th>Mobile Number</th>
        <td style='color: teal;'><?php  echo $row['PhoneNumber'];?></td>
      </tr>
      <tr>
        <th>Date</th>
        <td style='color: teal;'><?php  echo $row['AptDate'];?></td>
      </tr>

      <tr>
        <th>Start Time</th>
        <td style='color: teal;'><?php  echo $row['AptTime'];?></td>
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
        <td style='color: teal;'><?php  echo $row['location'];?></td>
      </tr>
      <tr>
        <th>Distance(from office) </th>
        <td style='color: teal;'><?php  echo $row['loc_distance'].' km away and '.$row['loc_time'].' minutes drive';?></td>
      </tr>
      <tr>
        <th>Total</th>
        <td style='color: teal;'><?php  echo "<p style='color: green'><b>R ".$row['total']."</b></p>";?></td>
      </tr>

      <tr>
        <th>Status</th>
        <td> <?php 
          if($row['Status']=="0")
          {
            echo "<button class='deleteLabel'>Declined</button>";
          } 
        if($row['Status']=="1")
        {
          echo "<button class='scheduledLabel'>Scheduled</button>";
        }
        if($row['Status']=="2")
        {
          echo "<button class='pendingLabel'>Pending</button>";
        }
        if($row['Status']=="3")
        {
          echo "<button class='completeLabel'>Completed</button>";
        }
        if($row['Status']=="4")
        {
          echo "<button class='missedLabel'>Missed</button>";
        }
        ;?></td>
      </tr>
    </table>
    <!--make radio buttons----> <!--add name and email as hidden inputs--->
    <div class="container">
    <?php 
          if($row['Status']=="2"){ ?>
        <form name="update" method="post" action="includes/reply.inc.php">    
          <div class="row mb-3">';
          <label> Reply :</label><select name="status" class="form-control wd-450" required="true">
          <option value="1" selected="true">Schedule</option>
          <option value="0">Decline</option>
          </select>;
         </div>;
         
        <input type="hidden" name="name" value= <?php echo $row['Name']; ?>>
        <input type="hidden" name="email" value=<?php  echo $row['Email'];?>>
        
        <input type="hidden" name="date" value= <?php echo $row['AptDate']; ?>>
        <input type="hidden" name="time" value= <?php echo $row['AptTime']; ?>>
        <input type="hidden" name="service" value= <?php echo $row['Services']; ?>>
        <input type="hidden" name="recipients" value= <?php echo $row['recipients']; ?>>
        <input type="hidden" name="total" value= <?php echo $row['total']; ?>>
        <div class="row centered">
          <button type="submit" name="save2" class="btn editBtn">Submit</button>
        </div>
      </form>
    <?php }
          ?>
     </div>
    
    <?php } ?>
  </div>
</div>
