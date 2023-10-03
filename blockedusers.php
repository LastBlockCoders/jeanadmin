
<?php 
include_once 'auth/session.php';
include_once 'includes/dbconnection.php';
?>
<div class="card-body">
 <table class="table table-bordered table-responsive">
  <thead>
    <tr>
      <th class="text-center">Name</th>
      <th class="text-center">Mobile</th>
      <th class="text-center">Email</th>
      <th class="text-center">Permission</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
   <?php
   
   $sql="SELECT * from tblusers where status='0'";
   $query = $dbh -> prepare($sql);
   $query->execute();
   $results=$query->fetchAll(PDO::FETCH_OBJ);
   $cnt=1;
   if($query->rowCount() > 0)
   {
    foreach($results as $row)
      {?>
       <tr>
         <td><a href="#"><?php  echo htmlentities($row->firstname);?> <?php  echo htmlentities($row->lastname);?></a></td>
         <td class="text-left"><?php  echo htmlentities($row->phone);?></td>
         <td class="text-left" ><?php  echo htmlentities($row->email);?></td>
         <td class="text-left"><?php  echo htmlentities($row->permission);?></td>
         <td class="text-left">
          <form action='includes/restore.inc.php' method='post'>
           <input type="hidden" name="blockid" value="<?php echo ($row->id);?>"/>
           <button type="submit" name="submit" class="editBtn">Unblock</button>
          </form>
         </td>
       </tr>
       <?php 
     }
   }; ?>
 </tbody>
</table>
</div>
<!-- /.card-body -->
