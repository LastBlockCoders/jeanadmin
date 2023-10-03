<?php
include_once 'auth/session.php';
include_once 'auth/db.php';

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

if(isset($_POST['save'])){
  $uid=$_SESSION['gid'];
  $invoiceid=mt_rand(100000000, 999999999);
  $sid=$_POST['sids'];
  $distance=round($_POST['distance']);
  

$newArray = array_diff($reci, array("0"));
  
  for($i=0;$i<count($sid);$i++){
   $svid=$sid[$i];
    $rid = $newArray[$i];
    
   $ret=mysqli_query($con,"insert into tblinvoice(Userid,ServiceId,recipients,BillingId, distance) values('$uid','$svid','$rid','$invoiceid','$distance);");
   echo "<script type='text/javascript'>
   Swal.fire({
     icon: 'success',
     title: 'succcess',
     text: 'Invoice #'.'$invoiceid',
     showConfirmButton: false,
     timer: 3000
     });
     setTimeout(function(){window.open('invoices.php','_self')},1000);</script>";
   }
}
?>
<div class="card-body">
  <h4>Pick Services:</h4>
  <form method="post">
    <table class="table table-responsive"> 
      <thead>
       <tr>
        <th>Service</th><th>Recipients</th> <th>Price</th> <th>Action</th> 
      </tr> 
    </thead> 
    <tbody>
      <?php
      $eid=$_POST['edit_id'];
      $ret=mysqli_query($con,"select * from  tblcustomers where id='$eid'");
      $cnt=1;
      while ($row=mysqli_fetch_array($ret)) 
      {
        $_SESSION['gid']=$row['id'];
      }
      $ret=mysqli_query($con,"select *from  tblservices");
      $cnt=1;
      while ($row=mysqli_fetch_array($ret)) {
        ?>
        <tr> 
         
          <td><?php  echo $row['name'];?></td>
          <td><?php  echo $row['price'];?></td>
          <td><input type="checkbox" name="sids[]" value="<?php  echo $row['id'];?>" ></td> 
        </tr>   
        <?php 
        $cnt=$cnt+1;
      }?>

      <tr><td><input type="text" id="Autocomplete" placeholder="Enter the address"/></td></tr>
      <input type="hidden" name="distance" id="distance" />
      <tr>
        <td colspan="4" align="center">
          <button type="submit" name="save" class="btn completeBtn">Submit</button>   
        </td>
      </tr>
    </tbody> 
  </table> 
</form>
</div>
  <!-- /.card-body -->
  <script> 
		let autocomplete;
		function initAutocomplete(){
			autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'),{
				types: ['address'],
				componentRestrictions: {'country': ['ZA']},
				fields: ['place_id', 'geometry', 'name', 'formatted_address']	
			
		});

			autocomplete.addListener('place_changed', onPlaceChanged);
		}
		
		function onPlaceChanged(){
			var place = autocomplete.getPlace();

			if(!place.geometry){

				document.getElementById('autocomplete').placeholder = 'Enter the street address';
			}
			else{
				var origin1 = {lat:-26.121182572150143, lng: 28.083971661384528};
				var destination = place.formatted_address

				var service = new google.maps.DistanceMatrixService();
				service.getDistanceMatrix({
					origins: [origin1],
    				destinations: [destination],
					travelMode: 'DRIVING',
					drivingOptions: {
						departureTime: new Date(Date.now()),
						trafficModel: 'optimistic'
					},
					unitSystem: google.maps.UnitSystem.METRIC
			}, callback);

			function callback(response, status) {
  				if (status == 'OK') {
					var distance = response.rows[0].elements[0].distance.value/1000;
				

					document.getElementById('distance').value= distance; 

			
				}
				else{
					console.log("error with distance matrix");
				};
				
				
			};
		}
		}
	</script>
	<script 
    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRikmoLd46-E8itNk9N-lpecdZqmc8Nd4&libraries=places&callback=initAutocomplete" async defer>
	</script>
	