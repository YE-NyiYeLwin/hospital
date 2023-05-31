<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	session_start();
	$SchID=$_GET['SchID'];
	$select="SELECT * FROM dbschedule WHERE ID='$SchID'";
   	$run=mysqli_query($connect,$select);
   	$row=mysqli_fetch_array($run);
   	$DID=$row['DoctorID'];
   	$day=$row['day'];
   	$timestart=$row['timestart'];
   	$timeend=$row['timeend'];
   	$patientlimit=$row['patientlimit'];
   	$tdydate=date('Y-m-d');
   	$status='booked';
   	$date='next '.$day.' from '.$tdydate;

   	$select2="SELECT * FROM dbboooking WHERE ScheduleID='$SchID' AND date='$date' ORDER BY ID DESC LIMIT 1";
   	$run=mysqli_query($connect,$select2);
   	$row2=mysqli_fetch_array($run);
   	if ($row2) {
   		$bookingnumber=$row2['bookingnumber'];
   		$bookingnumber=$bookingnumber+1;
   		echo"<script> alert('Booked')</script>";
   	}
   	else{
   		$bookingnumber='1';
   		echo"<script> alert('First Booking')</script>";
   	}

	date_default_timezone_set('Asia/Yangon');
   	//$alrdybooked="SELECT * FROM dbbooking WHERE ScheduleID='$SchID' AND date='$'";
	$PaID=$_SESSION['patientid'];
	$Paname = $connect->query("SELECT name FROM dbpatient WHERE ID='$PaID'")->fetch_object()->name;
	$Dname = $connect->query("SELECT name FROM dbdoctor WHERE ID='$DID'")->fetch_object()->name;

   	$insert="INSERT into dbboooking(PatientID,ScheduleID,date,bookingnumber,status,createddate) values('$PaID','$SchID','$date','$bookingnumber','$status','$tdydate')";
    $run=mysqli_query($connect,$insert);
	echo"<script> alert('Booking Made, Please Save this slip')</script>";
 ?>
<head>
	<link rel="stylesheet" type="text/css" href="site.css">
</head>
<div style="width: 100%; text-align: center;">
<h1>Booking Slip</h1>
<h2>Hospital Name</h2>
<table style="margin-left: 15em;width: 60%; text-align: center;">
	<tr>
		<td colspan="2"><h3>Address: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h3></td>
	</tr>
	<tr>
		<td>Patient Name:</td>
		<td><?php echo $Paname ?></td>
	</tr>
	<tr>
		<td>Doctor Name:</td>
		<td><?php echo $Dname ?></td>
	</tr>
	<tr>
		<td>Schedule:</td>
		<td><?php echo $SchID ?>.&nbsp; .<?php echo $date ?>.</td>
	</tr>
	<tr>
		<td>Time:</td>
		<td>During.&nbsp; .<?php echo $timestart ?>. - 
		.<?php echo $timeend ?>.</td>
	</tr>
	<tr>
		<td>Booking Number:</td>
		<td><?php echo $bookingnumber ?></td>
	</tr>
	<tr>
		<td>Booking Created Date:</td>
		<td><?php echo $tdydate ?></td>
	</tr>
	<tr>
		
	</tr>
	<tr>
		<td colspan="2">Please keep a copy of this booking slip, if any sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
	</tr>
</table>
</div>