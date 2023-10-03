<?php

include_once 'auth/session.php';

include 'includes/dbconnection.php';

include 'auth/db.php';



if (isset($_SESSION['sid'])) {

  if (($_SESSION['permission'] != "Secretary") && ($_SESSION['permission'] != "Superuser")) {

    header('location: logout.php');

    exit();

    }

}

else{

  header('location:logout.php');

}





if(isset($_POST['submit']))

{

  $image=$_POST['image'];

  

  $cid=$_SESSION['edid'];

  $query=mysqli_query($con, "DELETE FROM tblmarketing where id=$cid;");

  if ($query) {

    echo "<script type='text/javascript'>

    Swal.fire({

      icon: 'success',

      title: 'DELETED',

      text: 'Marketing Updated',

      showConfirmButton: false,

      timer: 2000

      });

      setTimeout(function(){window.open('view_gallery.php','_self')},1500);

    </script>"; 

  }

  else

  {

    echo "<script type='text/javascript'>

    Swal.fire({

      icon: 'error',

      title: 'Oops...',

      text: 'Something went wrong',

      showConfirmButton: false,

      timer: 2000

      });

    </script>";

  }

}

?>

<h4 class="card-title">Delete Marketing Image</h4>

<form method="post">

 

  <?php

  $eid=$_POST['edit_id'];

  $ret=mysqli_query($con,"SELECT * FROM  tblmarketing WHERE id= '$eid';");

  $cnt=1;

  while ($row=mysqli_fetch_array($ret)) 

  {

    $_SESSION['edid']=$row['id'];

    //code to delete here

 

    } ?>

    <div class="card-footer">

      <button type="submit" name="submit" class="btn deleteBtn">Delete</button>

    </div>

  </div>

</form>

