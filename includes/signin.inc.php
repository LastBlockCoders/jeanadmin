<?php
include_once '../auth/session.php';
include_once 'dbconnection.php';
include_once '../functions/functions.php';


if(isset($_POST['login'])){

  $username=test_input($_POST['username']);
  $password=md5(test_input($_POST['password']));
  try{
  $sql ="SELECT * FROM tblusers WHERE email=:email and password=:password ";
  $query=$dbh->prepare($sql);
  $query-> bindParam(':email', $username, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0){ 

    foreach ($results as $result) {
      $_SESSION['sid']=$result->id;
      $_SESSION['name']=$result->name;
      $_SESSION['lastname']=$result->lastname;
      $_SESSION['permission']=$result->permission;
      $_SESSION['email']=$result->email;

      header("location: ../index.php?error=none");
      exit();

    }

    if(!empty($_POST["remember"])) {
      //COOKIES for username
      setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
      //COOKIES for password
      setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
    } else {
      if(isset($_COOKIE["user_login"])) {
        setcookie ("user_login","");
        if(isset($_COOKIE["userpassword"])) {
          setcookie ("userpassword","");
        }
      }
    }

  

    /* $aa= $_SESSION['sid'];
    $sql="SELECT * from tblusers  where id=:aa";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':aa',$aa,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    $cnt=1;
    if($query->rowCount() > 0) {
      foreach($results as $row)
      {               

        if($row->status=="1"){ 
          $extra="dashboard.php";
          $username=$_POST['username'];
          $email=$_SESSION['email'];
          $name=$_SESSION['name'];
          $lastname=$_SESSION['lastname'];
          $_SESSION['login']=$_POST['username'];
          $_SESSION['id']=$num['id'];
          $_SESSION['username']=$num['name'];
          $uip=$_SERVER['REMOTE_ADDR'];
          $status=1;
          $sql="insert into userlog(userEmail,userip,status,username,name,lastname)values(:email,:uip,:status,:username,:name,:lastname)";
          $query=$dbh->prepare($sql);
          $query->bindParam(':username',$username,PDO::PARAM_STR);
          $query->bindParam(':name',$name,PDO::PARAM_STR);
          $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
          $query->bindParam(':email',$email,PDO::PARAM_STR);
          $query->bindParam(':uip',$uip,PDO::PARAM_STR);
          $query->bindParam(':status',$status,PDO::PARAM_STR);
          $query->execute();
          $host=$_SERVER['HTTP_HOST'];
          $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
          header("location:http://$host$uri/$extra");
          exit();                 
        } else { 
          echo "<script>alert('Your account was blocked please approach Admin');document.location ='index.php';</script>";                                        
        }  

      } } 
    }else{ 
      $extra="index.php";
      $username=$_POST['username'];
      $uip=$_SERVER['REMOTE_ADDR'];
      $status=0;
      $email='Not registered in system';
      $name='Potential Hacker';
      $sql="insert into userlog(userEmail,userip,status,username,name)values(:email,:uip,:status,:username,:name)";
      $query=$dbh->prepare($sql);
      $query->bindParam(':username',$username,PDO::PARAM_STR);
      $query->bindParam(':name',$name,PDO::PARAM_STR);
      $query->bindParam(':email',$email,PDO::PARAM_STR);
      $query->bindParam(':uip',$uip,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
      echo "<script>alert('Username or Password is incorrect');document.location ='http://$host$uri/$extra';</script>";
    } */
}
else{
    header("location: ../index.php?error=nosuchuser");
    exit();
}
  }
  catch(PDOException $ex){
    header("location: ../index.php?error=nosuchuserdb");
    exit();
  }
}

