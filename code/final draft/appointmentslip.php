<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	include ('header.php');
	$tdydate=date('Y-m-d');
	$DID=$_SESSION['doctorid'];
	$Dname = $connect->query("SELECT name FROM dbdoctor WHERE ID='$DID'")->fetch_object()->name;
	$price = $connect->query("SELECT price FROM dbdoctor WHERE ID='$DID'")->fetch_object()->price;
	$bookingID=$_SESSION['booking'];
	$PaID = $connect->query("SELECT PatientID FROM dbboooking WHERE ID='$bookingID'")->fetch_object()->PatientID;
	$Paname = $connect->query("SELECT name FROM dbpatient WHERE ID='$PaID'")->fetch_object()->name;
	$select2="SELECT * FROM dbappointment WHERE BookingID='$bookingID'";
   	$run=mysqli_query($connect,$select2);
   	$row2=mysqli_fetch_array($run);
   	$symptom=$row2['symptom'];
   	$cause=$row2['suspectedcause'];
   	$prescription=$row2['prescription'];
   	$notes=$row2['doctornote'];
   	if ($notes=='') {
   		$notes='none';
   	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Appointment Slip</title>
 </head>
 <body>
 	<div style="width: 100%; text-align: center;">

<table style="margin-left: 18em;width: 60%; text-align: center;">
	<tr>
		<td colspan="2">
			<h1>Appointment Slip</h1>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<h2>Hospital Name</h2>
		</td>
	</tr>
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
		<td>Price:</td>
		<td><?php echo $price ?></td>
	</tr>
	<tr>
		<td>Symptom:</td>
		<td><?php echo $symptom ?></td>
	</tr>
	<tr>
		<td>Cause:</td>
		<td><?php echo $cause ?></td>
	</tr>
	<tr>
		<td>Doctor's Notes:</td>
		<td><?php echo $notes ?></td>
	</tr>
	<tr>
		<td>Prescription:</td>
		<td><?php echo $prescription ?></td>
	</tr>
	<tr>
		<td>Date:</td>
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
 </body>
 </html>