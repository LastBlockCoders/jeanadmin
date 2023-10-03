<?php
  if(isset($_POST['submit']))
  {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobilenum=$_POST['mobilenum'];
    $filtered_phone_number = filter_var($mobilenum, FILTER_SANITIZE_NUMBER_INT);
    $phone = str_replace("-", "", $mobilenum);
 

    if (strlen($phone) < 10 || strlen($phone) > 10) {
        

        header("location :../add_customer.php?error=number");
        exit();
    }
    if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
        header("location :../add_customer.php?error=number");
        exit();
    }

    $sql = "INSERT INTO tblcustomers(name,email,mobilenumber) VALUES (:name,:email,:mobilenumber)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':email',$email,PDO::PARAM_STR);
    $stmt->bindParam(':mobilenumber',$phone,PDO::PARAM_STR);
    $stmt->execute();

    if( $stmt->rowCount() == 1 ){
      echo "<script type='text/javascript'>
      Swal.fire({
        icon: 'success',
        title: 'Client Added!',
        showConfirmButton: false,
        timer: 2000
        });
        setTimeout(function(){window.open('customer_list.php','_self')},1500);
      </script>";
    }
 else {
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