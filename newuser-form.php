<?php 
include_once 'auth/session.php';
include_once 'auth/db.php';
include('includes/dbconnection.php');

if (isset($_SESSION['sid'])) {
  if(isset($_SESSION['permission'])){
    if (($_SESSION['permission'] != "Superuser")) {
    header('location: logout.php');
    exit();
    }
    }
}else{
  header('location:logout.php');
}

if(isset($_POST['submit']))
{
  $password1=($_POST['password']); 
  $password2=($_POST['password1']); 

  if($password1 != $password2) {
    echo "<script type='text/javascript'>
    Swal.fire({
      icon: 'error',
      title: 'error.',
      text: 'Passwords don't match',
      showConfirmButton: false,
      timer: 2000
      });
    </script>";
  }else
  {
    $name=$_POST['name'];
    $lastname=$_POST['lastname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $permission=$_POST['permission'];
    $sex=$_POST['sex'];
    $mobile=$_POST['mobile'];
    $password=md5($_POST['password']);
    $status=1; 
    $sql="INSERT INTO  tblusers(name,username,email,password,status,mobile,sex,lastname,permission) VALUES(:name,:username,:email,:password,:status,:mobile,:sex,:lastname,:permission)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
    $query->bindParam(':sex',$sex,PDO::PARAM_STR);
    $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':permission',$permission,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      echo "<script type='text/javascript'>
      Swal.fire({
        icon: 'success',
        title: 'Added Successfully!',
        showConfirmButton: false,
        timer: 2000
        });
        setTimeout(function(){window.open('userregister.php','_self')},1500);
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
}
?>

<form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal"  >
  <div class="card-body">
    <div class="row">
      <div class="form-group col-md-4">
        <label for="feFirstName">First Name</label>
        <input type="text" name="name" class="form-control"  placeholder="First Name" value="" required>
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Lastname</label>
        <input type="text" name="lastname" class="form-control"  placeholder="Last Name" value="" required>
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Username</label>
        <input type="text" name="username" class="form-control"  placeholder="Username" value="" required>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-4">
        <label class="" for="register1-email">Permission:</label>
        <select name="permission" class="form-control" required>
          <option value="Super User">Super User</option>
          <option value="Admin">Admin</option>
          <option value="User">User</option>
        </select>
      </div>
      <div class="form-group col-4">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control"  placeholder="Enter email" value="" required>
      </div>
      <div class="form-group col-4">
        <label for="exampleInputEmail1">Mobile</label>
        <input type="text" name="mobile" class="form-control"  placeholder="Enter mobile" value="" required>
      </div>
    </div>
    
    <div class="row">
      <div class="form-group col-md-4">
        <label for="feFirstName">password</label>
        <input type="password" name="password" class="form-control" placeholder="password" value="" required>
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">confirm password</label>
        <input type="password" name="password1" class="form-control" placeholder="confirm password" value="" required>
      </div>
      <div class="form-group col-4">
        <label class="" for="register1-email">Gender:</label>
        <select name="sex" class="form-control" required>
          <option value="">Select Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
    </div>
   
  </div>  
  <!-- /.card-body -->
  <div class="modal-footer text-right">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="submit" name="submit" class="btn editBtn">Submit</button>
  </div>
</form>