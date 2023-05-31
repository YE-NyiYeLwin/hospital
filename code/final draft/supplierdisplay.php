<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	include ('header.php');
	if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Admins Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Supplier Display</title>
 </head>
 <body>
 	<form action="" method="post">
 		<strong>Supplier Display:</strong>
		<input type="text" class="search" name="term" placeholder="Search Company Name" />
		<input type="submit" value="Search" />  
	
	<table width="100%">
	<tr>
		<td>ID</td>
		<td>Company Name</td>
		<td>Contact Number</td>
		<td>Email</td>
		<td>Address</td>
		<td>Edit</td>
	</tr>
	<?php
		if (!empty($_REQUEST['term'])) {

			$term = mysqli_real_escape_string($connect,$_REQUEST['term']);     

			$sql = "SELECT * FROM dbsupplier WHERE companyname LIKE '%".$term."%'"; 
			$r_query = mysqli_query($connect,$sql); 

			while ($row = mysqli_fetch_array($r_query))
			{
				$ID=$row['ID'];
				$compname=$row['companyname'];
		      $contactno=$row['contactno'];
		      $email=$row['email'];
		      $address=$row['address'];
		      $email=$row['email'];

				echo"
				<tr>
				<td>$ID</td>
				<td>$compname</td>
				<td>$contactno</td>
				<td>$email</td>
				<td>$address</td>
				<td> <a href='supplieredit.php?SID=$ID'> Edit</a> </td>
				</tr>
				";
			}
		}
		else
		{
			$sql = "SELECT * FROM dbsupplier ORDER BY companyname";
			$r_query = mysqli_query($connect,$sql); 
			$count=mysqli_num_rows($r_query);
			for ($i=0; $i < $count; $i++) { 
				$row = mysqli_fetch_array($r_query);
				$ID=$row['ID'];
				$compname=$row['companyname'];
		      $contactno=$row['contactno'];
		      $email=$row['email'];
		      $address=$row['address'];
		      $email=$row['email'];

				echo"
				<tr>
				<td>$ID</td>
				<td>$compname</td>
				<td>$contactno</td>
				<td>$email</td>
				<td>$address</td>
				<td> <a href='supplieredit.php?SID=$ID'> Edit</a> </td>
				</tr>
				";
			}
		}
	?>
	</table> 
	</form> 
<?php include ('footer.php');?>
 </body>
 </html>