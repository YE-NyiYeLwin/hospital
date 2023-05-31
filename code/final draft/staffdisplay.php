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
 	<title>Staff Display</title>
 </head>
 <body>
 	<form action="" method="post">
		<input class="search" type="text" name="term" placeholder="Search Name or Type" />
		<input type="submit" value="Search" />  
	
	<table width="100%">
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Phone Number</td>
		<td>Staff Type</td>
		<td>Salary</td>		
		<td>Email</td>
		<td>Edit</td>
	</tr>
	<?php
		if (!empty($_REQUEST['term'])) {

			$term = mysqli_real_escape_string($connect,$_REQUEST['term']);     

			$sql = "SELECT * FROM dbstaff WHERE name LIKE '%".$term."%' OR type LIKE '%".$term."%' ORDER BY name"; 
			$r_query = mysqli_query($connect,$sql); 

			while ($row = mysqli_fetch_array($r_query))
			{
				$ID=$row['ID'];
				$name=$row['name'];
		      $phnum=$row['phnum'];
		      $type=$row['type'];
		      $salary=$row['salary'];
		      $email=$row['email'];

				echo"
				<tr>
				<td>$ID</td>
				<td>$name</td>
				<td>$phnum</td>
				<td>$type</td>
				<td>$salary</td>
				<td>$email</td>
				<td> <a href='staffedit.php?SID=$ID'> Edit</a> </td>
				</tr>
			";
			}
		}
		else
		{
			$sql = "SELECT * FROM dbstaff ORDER BY name";
			$r_query = mysqli_query($connect,$sql); 
			$count=mysqli_num_rows($r_query);
			for ($i=0; $i < $count; $i++) { 
				$row = mysqli_fetch_array($r_query);
				$ID=$row['ID'];
				$name=$row['name'];
		      $phnum=$row['phnum'];
		      $type=$row['type'];
		      $salary=$row['salary'];
		      $email=$row['email'];

				echo"
				<tr>
				<td>$ID</td>
				<td>$name</td>
				<td>$phnum</td>
				<td>$type</td>
				<td>$salary</td>
				<td>$email</td>
				<td> <a href='staffedit.php?SID=$ID'> Edit</a> </td>
				</tr>
				";
			}
		}
	?>
	</table> 
	</form> 
<?php 
include ('footer.php');
?>
 </body>
 </html>