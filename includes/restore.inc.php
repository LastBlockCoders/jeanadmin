<?php
include_once '../auth/session.php';
include_once 'dbconnection.php';


if(isset($_POST['submit'])){
if(isset($_POST['blockid']))
{
  $blockedid=intval($_POST['blockid']);
  $sql="update tblusers set status='1' where id=:blockedid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':blockedid',$blockedid,PDO::PARAM_STR);
  $query->execute();
  
  header('location: ../userregister.php?action=restored');
  exit();
}
}

?>