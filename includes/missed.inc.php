<?php

$ret=mysqli_query($con,"select * from  tblappointment where Status='2';");

while ($row=mysqli_fetch_array($ret)) {

    $d=strtotime("{$row['date']} {$row['start_time']}");
    $date = date("Y-m-d h:i:sa", $d);
    If($date < date("Y-m-d h:i:sa")){
        $sql = "update  tblappointment set Status='4' where ID={$row[id]};";
        $query = mysqli_query($con,$sql);   
    }

}
 
?>