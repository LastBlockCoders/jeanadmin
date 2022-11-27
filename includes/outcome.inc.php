<?php

include_once '../auth/session.php';
include_once '../auth/db.php';
if(!isset($_SESSION['sid'])){
    header('location: logout.php');
    exit();
}

if(isset($_POST['outcome'])){

    $newStatus = $_POST['outcome'];
    $id = $_POST['id'];

    try{
        $sql = "update  tblappointment set Status=? where ID=?;";
        $stmt = mysqli_stmt_init($con);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"si",$newStatus,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../accepted_appointment.php?error=none");
        exit();
    }
    catch(mysqli_sql_exception $e){
        header("location: ../accepted_appointment.php?error=somethingwentwrong");
        exit();
    }
}
?>