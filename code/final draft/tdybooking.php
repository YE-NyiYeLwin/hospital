<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	include ('header.php');
	if (!isset($_SESSION['doctorid']))
   {
      echo"<script> alert('Doctors Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Today's Booking</title>
 </head>
 <body>
 	<form action="" method="post">  
		<strong>Today's Booking</strong> 
	
	<table width="100%">
	<tr>
		<td>Patient Name</td>
		<td>Patient Contact No</td>
		<td>Session Time</td>
		<td>Booking Number</td>
		<td>Status</td>
		<td>Created Date</td>
		<td>Process</td>
	</tr>
	<?php
		$DID=$_SESSION['doctorid'];
		$tdy=date("D");
		switch ($tdy) {
			case 'Sat':
				$tdy="Saturday";
				break;
			case 'Sun':
				$tdy="Sunday";
				break;
			case 'Mon':
				$tdy="Monday";
				break;
			case 'Tue':
				$tdy="Tuesday";
				break;
			case 'Wed':
				$tdy="Wednesday";
				break;
			case 'Thur':
				$tdy="Thursday";
				break;
			case 'Fri':
				$tdy="Friday";
				break;
		}
		$sql1 = "SELECT * FROM dbschedule WHERE DoctorID='$DID' AND day='$tdy'";
		$r_query1 = mysqli_query($connect,$sql1);
		$count1=mysqli_num_rows($r_query1);
		for ($i=0; $i < $count1; $i++) { 
			$row1 = mysqli_fetch_array($r_query1);
			$SchID=$row1['ID'];
			$timestart=$row1['timestart'];
			$timeend=$row1['timeend'];
			$sql = "SELECT * FROM dbboooking WHERE ScheduleID='$SchID' AND status='booked'";
			$r_query = mysqli_query($connect,$sql);
			$count=mysqli_num_rows($r_query);
			for ($j=0; $j < $count; $j++) { 
				$row = mysqli_fetch_array($r_query);
				$bookingid=$row['ID'];
				$PatientID=$row['PatientID'];
				$bookingnumber=$row['bookingnumber'];
				$status=$row['status'];
				$createddate=$row['createddate'];
				$patient = $connect->query("SELECT name FROM dbpatient WHERE ID='$PatientID'")->fetch_object()->name;
				$phnum = $connect->query("SELECT phnum FROM dbpatient WHERE ID='$PatientID'")->fetch_object()->phnum;
				echo"
				<tr>
				<td>$patient</td>
				<td>$phnum</td>
				<td>$timestart - $timeend</td>
				<td>$bookingnumber</td>
				<td>$status</td>
				<td>$createddate</td>
				<td><a href='appointment.php?BID=$bookingid&PID=$PatientID'> Process</a></td></tr>";
			}
		}
	?>
	</table>  
	</form>
	</body>
<?php include ('footer.php');?>
 
 </html>