<?php 
include_once '../auth/session.php';
include_once '../auth/db.php';

if(isset($_POST['submit'])){

$g_image = $_FILES['g_image']['name'];

$Gimage_tmp = $_FILES['g_image']['tmp_name'];

move_uploaded_file ($Gimage_tmp,"gallery/{$g_image}");

$sql = "INSERT INTO tblgallery(name) VALUES ('$g_image')";

$gallery = mysqli_query($con, $sql);


if ($gallery) {

header("location: ../add_gallery.php?action=uploaded");
exit();

}
else
{
    header("location: ../add_gallery.php?action=error");
    exit();
}

}





?>