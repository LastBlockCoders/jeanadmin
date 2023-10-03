<?php
include_once 'auth/session.php';
include('auth/db.php');

if (isset($_SESSION['sid'])) {
	if(isset($_SESSION['permission'])){
	  if (($_SESSION['permission'] != "Superuser") && ($_SESSION['permission'] != "Admin")) {
	  header('location: logout.php');
	  exit();
	  }
	  }
  }else{
	header('location:logout.php');
  }
?>
<div id="page-wrapper">
	<div class="main-page">
		<div class="tables" id="exampl">
			<h3 class="title1">Invoice Details</h3>
			<div class="table-responsive bs-example widget-shadow">
				<?php
				$invid=$_POST['edit_id'];
				$ret=mysqli_query($con,"select DISTINCT  tblinvoice.PostingDate, tblcustomers.name,tblcustomers.email,tblcustomers.mobilenumber
					from  tblinvoice 
					join tblcustomers on tblcustomers.id=tblinvoice.Userid 
					where tblinvoice.BillingId='$invid'");
				$cnt=1;
				while ($row=mysqli_fetch_array($ret)) 
				{
					?>		
					<h4>Invoice #<?php echo $invid;?></h4>
					<table class="table table-bordered" width="100%" border="1"> 
						<tr>
							<th colspan="6">Client Details</th>	
						</tr>
						<tr> 
							<th>Name</th> 
							<td><?php echo $row['name']?></td> 
							<th>Contact no.</th> 
							<td><?php echo $row['mobilenumber']?></td>
							<th>Email </th> 
							<td><?php echo $row['email']?></td>
						</tr> 
						<tr>
							<th colspan="6">Address</th>
							<td> N/A </td>	
						</tr>
					</table> 
					<?php 
				}?>
				<table class="table table-bordered" width="100%" border="1"> 
					<tr>
						<th colspan="3">Services Details</th>	
					</tr>
					<tr>
						<th>#</th>	
						<th>Service</th>
						<th>Cost</th>
					</tr>

					<?php
					
					$ret=mysqli_query($con,"select tblservices.name,tblservices.price  
						from  tblinvoice 
						join tblservices on tblservices.id=tblinvoice.ServiceId 
						where tblinvoice.BillingId='$invid'");
					$cnt=1;
					$gtotal=0;
					while ($row=mysqli_fetch_array($ret)) {
						?>
						<tr>
							<th><?php echo $cnt;?></th>
							<td><?php echo $row['name']?></td>	
							<td><?php echo 'R '.$subtotal=$row['price']?></td>
						</tr>
						<?php 
						
						$cnt=$cnt+1;
						$gtotal +=$subtotal;
					} ?>
					<tr>
						<th colspan="2" style="text-align:center">Grand Total</th>
						<th><?php echo 'R '.$gtotal?></th>
					</tr>
				</table>
				<p style="margin-top:1%"  align="center">
					<i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
				</p>
			</div>
		</div>
	</div>
</div>

<script>
	function CallPrint(strid) {
		var prtContent = document.getElementById("exampl");
		var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
</script>