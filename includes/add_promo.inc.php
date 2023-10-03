<?php
include_once '../auth/session.php';
include_once '../auth/db.php';

    if(isset($_POST['market'])){

        $m_image = $_FILES['m_image']['name'];
    
        $Mimage_tmp = $_FILES['m_image']['tmp_name'];
    
        move_uploaded_file ($Mimage_tmp,"../marketing/{$m_image}");
    
        $sql = "INSERT INTO tblmarketing(name) VALUES('$m_image')";
    
        $add_image = mysqli_query($con, $sql);
    
        header("location:  ../add_marketing.php?action=uploaded");
        exit();
        
    
      }

?>