<?php

if(isset($_POST['submit']))
  {
    $cat_id = $_POST['category'];
    $name=$_POST['sername'];
    $description=$_POST['description'];
    $price=$_POST['cost'];
    $duration=$_POST['duration'];
    $promo_price = $_POST['promo_price'];
    $on_promo = $_POST['on_promo'];
    $query=mysqli_query($con, "insert into  tblservices(cat_id,name,description,price,promo_price,on_promo,duration) values($cat_id,'$name','$description',$price, $promo_price,$on_promo,$duration);");
    if ($query) {
     header("location:  ../add_service.php?error=none");
     exit();
    }
    else
    {
        header("location:  ../add_service.php?error=somethingwentwrong");
        exit();   
    }
  }