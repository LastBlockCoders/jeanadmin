<?php

include_once 'dbconnection.php';

if(isset($_POST['submit'])){
if(isset($_POST['delid']))
{
  $rid=$_POST['delid'];
  $sql="update tblusers set status='0' where id=:rid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':rid',$rid,PDO::PARAM_INT);
  $query->execute();

  header('location: ../userregister.php?action=blocked');
  exit();
}
}
?>