<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	include ('header.php');
	if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Authorized Personnel Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Patient Display</title>
 </head>
 <body>
 	<form action="" method="post">  
		<input type="text" class="search" name="term" placeholder="Search Name" /> 
		<input type="submit" value="Search" />  
	
	<table width="100%">
	<tr>
		<td>Name</td>
		<td>Phone Number</td>
		<td>Email</td>
		<td>Address</td>
		<td>D.O.B</td>
		<td>Allergies</td>
		<td>CreatedBy</td>
		<td>Edit</td>
	</tr>
	<?php
		if (!empty($_REQUEST['term'])) {

			$term = mysqli_real_escape_string($connect,$_REQUEST['term']);

			$sql = "SELECT * FROM dbpatient WHERE name LIKE '%".$term."%' ORDER BY name"; 
			$r_query = mysqli_query($connect,$sql); 

			while ($row = mysqli_fetch_array($r_query)){
			$PaID=$row['ID'];
			$name=$row['name'];
	      $phnum=$row['phnum'];
	      $email=$row['email']; 
	      $address=$row['address'];
	      $dob=$row['dob'];
	      $allergies=$row['allergies'];
	      $createdby=$row['createdby'];

			echo"
				<tr>
				<td>$name</td>
				<td>$phnum</td>
				<td>$email</td>
				<td>$address</td>
				<td>$dob</td>
				<td>$allergies</td>
				<td>$createdby</td>
				<td> <a href='patientedit.php?PaID=$PaID'> Edit</a> </td>
				</tr>
			";
			}
		}
		else
		{
			$sql = "SELECT * FROM dbpatient ORDER BY name";
			$r_query = mysqli_query($connect,$sql); 
			$count=mysqli_num_rows($r_query);
			for ($i=0; $i < $count; $i++) { 
				$row = mysqli_fetch_array($r_query);
				$PaID=$row['ID'];
				$name=$row['name'];
		      $phnum=$row['phnum'];
		      $email=$row['email']; 
		      $address=$row['address'];
		      $dob=$row['dob'];
		      $allergies=$row['allergies'];
		      $createdby=$row['createdby'];

				echo"
					<tr>
					<td>$name</td>
					<td>$phnum</td>
					<td>$email</td>
					<td>$address</td>
					<td>$dob</td>
					<td>$allergies</td>
					<td>$createdby</td>
					<td> <a href='patientedit.php?PaID=$PaID'> Edit</a> </td>
					</tr>
				";
			}
		}
	?>
	</table>  
	</form>
	</body>
<?php include ('footer.php');?>
 
 </html>