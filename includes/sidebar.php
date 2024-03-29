 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: teal;">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <span class="brand-text font-weight-bold">Jean's Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <?php
      $eid=$_SESSION['sid'];
      $sql="SELECT * from tblusers   where id=:eid;";                                    
      $query = $dbh -> prepare($sql);
      $query-> bindParam(':eid', $eid, PDO::PARAM_INT);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);

      $cnt=1;
      if($query->rowCount() > 0)
      {
        foreach($results as $row)
        {    
          ?>
          <div class="image">
            <img class="img-circle"
            src="staff_images/<?php echo htmlentities($row->userimage);?>" width="90px" height="90px" class="user-image"
            alt="User profile picture">
          </div>
          <div class="info">
            <a href="profile.php" class="d-block"><?php echo ($row->name); ?> <?php echo ($row->lastname); ?></a>
          </div>
          <?php 
        }
      } ?>

    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-header">QUICK MENU</li>
        <li class="nav-item has-treeview menu-open">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php if (($_SESSION['permission'] == "Admin")|| ($_SESSION['permission'] == "Superuser")) echo '
        <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-calendar"></i>
          <p>
            Appointments
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="new_appointment.php" class="nav-link">
              <i class="fa fa-clock-o nav-icon"></i>
              <p>New</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="accepted_appointment.php" class="nav-link">
              <i class="fa fa-calendar-check-o nav-icon"></i>
              <p>Scheduled</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="all_appointments.php" class="nav-link">
              <i class="far fa-history nav-icon"></i>
              <p>History</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="rejected_appointment.php" class="nav-link">
              <i class="fa fa-calendar-times-o nav-icon"></i>
              <p>Declined</p>
            </a>
          </li>
        </ul>
      </li>';?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-shopping-basket"></i>
            <p>
              Services
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_service.php" class="nav-link">
                <i class="fa fa-plus nav-icon"></i>
                <p>Add Services</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="manage_service.php" class="nav-link">
                <i class="fa fa-pencil-square-o nav-icon"></i>
                <p>Manage Services</p>
              </a>
            </li>
          </ul>
        </li>
        <?php if (($_SESSION['permission'] == "Secretary")|| ($_SESSION['permission'] == "Superuser")) echo '
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-picture-o"></i>
            <p>
              Marketing
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_marketing.php" class="nav-link">
                <i class="fa fa-plus nav-icon"></i>
                <p>Add images</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="view_marketing.php" class="nav-link">
                <i class="fa fa-pencil-square-o nav-icon"></i>
                <p>Manage Images</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-picture-o"></i>
            <p>
              Client Gallery
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_gallery.php" class="nav-link">
                <i class="fa fa-plus nav-icon"></i>
                <p>Add images</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="view_gallery.php" class="nav-link">
                <i class="fa fa-pencil-square-o nav-icon"></i>
                <p>Manage Gallery</p>
              </a>
            </li>
          </ul>
        </li>';
        ?>
        <?php if (($_SESSION['permission'] == "Superuser") || ($_SESSION['permission'] == "Admin")) echo '
      <li class="nav-header">FIND</li>
      <li class="nav-item has-treeview">
        <a href="search_appointment.php" class="nav-link">
          <i class="nav-icon fa fa-search"></i>
          <p>
            Appointments
          </p>
        </a>
      </li>';
      ?>
       <?php if (($_SESSION['permission'] == "Superuser")) echo '
      <li class="nav-header">USER MANAGEMENT</li>
      <!-- User Menu -->
      <li class="nav-item">
        <a href="userregister.php" class="nav-link">
         <i class="far fa-user nav-icon"></i>
         <p>
          Users
         </p>
        </a>
      </li><!-- /.user menu -->
      ';?>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
