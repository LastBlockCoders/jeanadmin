<!-- Navbar -->
<?php
include_once 'auth/db.php';

  ?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="dashboard.php" class="nav-link">Home</a>
    </li>
  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <?php
        $ret1=mysqli_query($con,"select ID,Name from  tblappointment where Status='2'");
        $num=mysqli_num_rows($ret1);
        ?>  
        <span class="badge badge-warning navbar-badge" style="font-size: 13px;"><?php echo $num ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"><?php echo $num;?> Notifications</span>
        <div class="dropdown-divider"></div>
        <?php 
        $ret=mysqli_query($con,"select ID,Name from  tblappointment where Status='2' ORDER BY ID DESC LIMIT 5");
        $num2=mysqli_num_rows($ret);
        if($num2>0){
          while($result=mysqli_fetch_array($ret))
          {
            ?>
            <a href="new_appointment.php" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> Request from <?php echo $result['Name'];?>
            </a>
            <div class="dropdown-divider"></div>
            <?php
          }
        } else {?>
          <a class="dropdown-item" href="all_appointments.php">No New Appointment Received</a>
          <?php 
        } ?>


        <div class="dropdown-divider"></div>
        <a href="new_appointment.php" class="dropdown-item dropdown-footer">See All Appointment</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i> </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="profile.php" class="dropdown-item">
          <i class="fa fa-user mr-2"></i> profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="changepassword.php" class="dropdown-item">
          <i class="fa fa-cog mr-2"></i> settings 
        </a>
        <div class="dropdown-divider"></div>
        <a href="logout.php" class="dropdown-item">
          <i class="fa fa-sign-in mr-2"></i> logout 
        </a>
      </div>
    </li>
  </ul>
</nav>
    <!-- /.navbar -->