<?php 
   $con=mysqli_connect("localhost", "jeansmob_admin", "JeanApp2022* ", "jeansmob_applicationjean");

   if(mysqli_connect_errno()){

    exit();

   }

    $date = date("Y-m-d");
    $time = date("H:i");
    $status = '0';
    $sql = "UPDATE tblappointment SET status = ? WHERE apt_date = ? AND start_time < ?;";

        $stmt = mysqli_stmt_init($con);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"sss",$status,$date, $time);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        


?>