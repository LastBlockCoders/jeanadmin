<?php

include_once 'auth/session.php';
include('includes/dbconnection.php');
if (!isset($_SESSION['sid'])) {
  header('location: logout.php');
  exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php @include("includes/header.php"); ?>
        <!-- Main Sidebar Container -->
        <?php @include("includes/sidebar.php"); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box" style="background-color: white; color: teal; border: 2px solid blue;">
                                    <?php
                                    $totalcust_recent = 0;
                                    $monthBegin = date('Y-m-01');
                                    $monthEnd = date('Y-m-t');
                                    $lastMonthBegin = date("Y-m-d",strtotime($monthBegin. '-1 months'));
                                    $lastMonthEnd = date('Y-m-t', strtotime($lastMonthBegin));

                                    $query1=mysqli_query($con,"SELECT * FROM tclients WHERE join_date BETWEEN '$monthBegin' AND '$monthEnd';");
                                    $totalcust_recent=mysqli_num_rows($query1);
                                    $lastCust = mysqli_query($con,"SELECT * FROM tclients WHERE join_date BETWEEN '$lastMonthBegin' AND '$lastMonthEnd';");
                                    $totalcust_last = mysqli_num_rows($lastCust);
                                    if($totalcust_last === 0){
                                        $totalcust_last = 1;
                                    }
                                    $c_increase = $totalcust_recent - $totalcust_last;
                                    $c_percentage = round(($c_increase / $totalcust_last) * 100);
                                    ?>
                                    <div class="inner">
                                        <h4>New Clients</h4>
                                        <span style='font-size: 32px; color: blue;'><?php echo $totalcust_recent;?></span><br>
                                        <?php
                                        if($c_percentage <= 0){
                                            echo "<span style='color: red;'><i class='fas fa-arrow-down'></i> ".$c_percentage." %</span>";
                                        }
                                        if($c_percentage > 0){
                                            echo "<span style='color: green;'><i class='fas fa-arrow-up'></i> ".$c_percentage." %</span>";
                                            }
                                        ?>
                                        <p style="color: teal; font-weight: 500;"> Compared to last month</p>
                                    </div>
                                    
                                </div>
                        </div>
                        <!-- ./col -->
                        

                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background-color: white; color: teal; border: 2px solid teal;">
                                
                                <div class="inner">
                                    <h4>Revenue</h4>
                                       <?php
                                      $monthBegin = date('Y-m-01');
                                      $monthEnd = date('Y-m-t');
                                      $lastMonthBegin = date("Y-m-d",strtotime($monthBegin. '-1 months'));
                                      $lastMonthEnd = date('Y-m-t', strtotime($lastMonthBegin));
                                        $query9 = mysqli_query($con,"SELECT sum(total) as total FROM tblappointment WHERE apt_date BETWEEN '$lastMonthBegin' AND '$lastMonthEnd' AND status='3';");
                                        $last_month = 1;
                                        while($row9=mysqli_fetch_array($query9))
                                        {   
                                            
                                            $last_month=$row9['total'];
                                            
                                        }
                                        if($last_month == 0){
                                            $last_month = 1;
                                        }
                                        $query8=mysqli_query($con,"SELECT sum(total) as total FROM tblappointment WHERE apt_date BETWEEN '$monthBegin' AND '$monthEnd' AND status='3';");
                                        $this_month=0;
                                        $percentage;
                                        while($row8=mysqli_fetch_array($query8))
                                        {
                                            $this_month=$row8['total'];
                                            if($last_month === 0){
                                                $last_month = 1;
                                            }
                                           
                                            $increase = $this_month - $last_month;
                                            $percentage = round(($increase / $last_month) * 100);
                                        }
                                        if($this_month == null){
                                            $this_month = 0;
                                        }
                                            echo "<span style='font-size: 32px; color: green;'><b>R ".$this_month."</b></span><br>";
                                
                                    ?> 
                                
                                
                                        <?php
                                        if($percentage <= 0){
                                            echo "<span style='color: red;'><i class='fas fa-arrow-down'></i> ".$percentage." %</span>";
                                        }
                                        if($percentage > 0){
                                            echo "<span style='color: green;'><i class='fas fa-arrow-up'></i> ".$percentage." %</span>";
                                            }
                                        ?>
                                <p style="color: teal; font-weight: 500;">Compared to last month</p>
                            </div>
                            
                        </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background-color: white; color: green; border: green 2px solid;">
                            <?php
                            $totalcomplete_last = 1;
                               $monthBegin = date('Y-m-01');
                               $monthEnd = date('Y-m-t');
                               $lastMonthBegin = date("Y-m-d",strtotime($monthBegin. '-1 months'));
                               $lastMonthEnd = date('Y-m-t', strtotime($lastMonthBegin));

                                $query3=mysqli_query($con,"SELECT * FROM tblappointment WHERE status='3' AND apt_date BETWEEN '$monthBegin' AND '$monthEnd';");
                                $totalcomplete=mysqli_num_rows($query3);
                                $completelast=mysqli_query($con,"SELECT * FROM tblappointment WHERE status='3' AND apt_date BETWEEN '$lastMonthBegin' AND '$lastMonthEnd';");
                                $totalcomplete_last=mysqli_num_rows( $completelast);

                                if($totalcomplete_last === 0){
                                    $totalcomplete_last = 1;
                                }
                                
                                $r_increase = $totalcomplete - $totalcomplete_last;
                                $r_percentage = round(($r_increase / $totalcomplete_last) * 100);
                                ?>
                                <div class="inner">
                                    <h4>Completed Requests</h4>
                                    <span style='font-size: 32px; color: green;'><?php echo $totalcomplete;?></span><br>
                                    <?php
                                        if($r_percentage <= 0){
                                            echo "<span style='color: red;'><i class='fas fa-arrow-down'></i> ".$r_percentage." %</span>";
                                        }
                                        if($r_percentage > 0){
                                            echo "<span style='color: green;'><i class='fas fa-arrow-up'></i> ".$r_percentage." %</span>";
                                            }
                                        ?>
                                    <p style="color: teal; font-weight: 500;"> Compared to last month</p>
                                </div>
                                
                        </div>
                                    </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row (main row) -->
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background-color: white; color: green; border: green 2px solid;">
                                <?php
                                $date_today = date('Y-m-d');
                                $query3=mysqli_query($con,"Select * from tblappointment where status='1' AND apt_date=$date_today;");
                                $totalaccapt=mysqli_num_rows($query3);
                                ?>
                                <div class="inner">
                                    <h3><?php echo $totalaccapt;?></h3>

                                    <p>Today's Schedule</p>
                                </div>
                                <a href="schedule.php" class="small-box-footer" style="background-color: green;">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                            <!-- ./col -->
                            <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box" style="background-color: white; color: red; border: red 2px solid;">
                                    <?php $query4=mysqli_query($con,"Select * from tblappointment where status='0'");
                                    $totalrejapt=mysqli_num_rows($query4);
                                    ?>
                                    <div class="inner">
                                        <h3><?php echo $totalrejapt;?></h3>

                                        <p>Declined Appointments</p>
                                    </div>
                                    <a href="rejected_appointment.php" class="small-box-footer" style="background-color: red;">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                        </div>

                        <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box" style="background-color: white; color: gold; border: gold 2px solid;">
                                    <?php $query2=mysqli_query($con,"Select * from tblappointment where status='4';");
                                    $totalappointment=mysqli_num_rows($query2);
                                    ?>
                                    <div class="inner">
                                        <h3><?php echo $totalappointment;?></h3>

                                        <p>Missed Appointments</p>
                                    </div>
                                    <a href="all_appointments.php" class="small-box-footer" style="background-color: gold">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                        </div>
                    </div>
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-wrapper -->
    <?php @include("includes/footer.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php @include("includes/foot.php"); ?>
</body>
</html>
