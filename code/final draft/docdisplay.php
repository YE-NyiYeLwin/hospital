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
 	<title>Doctor Display</title>
 </head>
 <body>
 	<form action="" method="post">
		<input type="text" class="search" name="term" placeholder="Search Name or Department" /> 
		<input type="submit" value="Search" />
	
	<table width="100%">
	<tr>
		<td>Name</td>
		<td>SSN</td>
		<td>Phone Number</td>
		<td>Degree</td>
		<td>D.O.B</td>
		<td>Department</td>
		<td>Price</td>
		<td>Salary</td>
		<td>Email</td>
		<td>Status</td>
		<td>Edit</td>
	</tr>
	<?php
		if (!empty($_REQUEST['term'])) {

			$term = mysqli_real_escape_string($connect,$_REQUEST['term']);     

			$sql = "SELECT d.* FROM dbdoctor AS d,dbdepartment AS t WHERE (d.name LIKE '%".$term."%' OR t.Name LIKE '%".$term."%') AND d.DepartmentID=t.ID"; 
			$r_query = mysqli_query($connect,$sql); 

			while ($row = mysqli_fetch_array($r_query)){
			$DID=$row['ID'];
			$name=$row['name'];
	      $ssn=$row['ssn'];
	      $phnum=$row['phnum']; 
	      $degree=$row['degree'];
	      $dob=$row['dob'];
	      $departmentid=$row['DepartmentID'];
	      $price=$row['price'];
	      $salary=$row['salary'];
	      $email=$row['email'];
	      $status=$row['status'];

	      $dsql="SELECT Name FROM dbdepartment WHERE ID='$departmentid'";
		   $run=mysqli_query($connect,$dsql);
	     	$row=mysqli_fetch_array($run);
	     	$department=$row[0];

			echo"
				<tr>
				<td>$name</td>
				<td>$ssn</td>
				<td>$phnum</td>
				<td>$degree</td>
				<td>$dob</td>
				<td>$department</td>
				<td>$price</td>
				<td>$salary</td>
				<td>$email</td>
				<td>$status</td>
				<td> <a href='docedit.php?DID=$DID'> Profile</a>
				<br> <a href='docschedule.php?DID=$DID'> Schedule</a>
				 </td>
				</tr>
			";
			}
		}
		else
		{
			$sql = "SELECT * FROM dbdoctor ORDER BY name";
			$r_query = mysqli_query($connect,$sql); 
			$count=mysqli_num_rows($r_query);
			for ($i=0; $i < $count; $i++) { 
				$row = mysqli_fetch_array($r_query);
				$DID=$row['ID'];
				$name=$row['name'];
		      $ssn=$row['ssn'];
		      $phnum=$row['phnum']; 
		      $degree=$row['degree'];
		      $dob=$row['dob'];
		      $departmentid=$row['DepartmentID'];
		      $price=$row['price'];
		      $salary=$row['salary'];
		      $email=$row['email'];
		      $status=$row['status'];

		      // $dsql="SELECT Name FROM department WHERE ID='$departmentid'";
		      // $run=mysqli_query($connect,$dsql);
	     	 // 	$row=mysqli_fetch_array($run);
	     		// $department=$row[0];

	     		$department = $connect->query("SELECT Name FROM dbdepartment WHERE ID='$departmentid'")->fetch_object()->Name;

				echo"
				<tr>
				<td>$name</td>
				<td>$ssn</td>
				<td>$phnum</td>
				<td>$degree</td>
				<td>$dob</td>
				<td>$department</td>
				<td>$price</td>
				<td>$salary</td>
				<td>$email</td>
				<td>$status</td>
				<td> <a href='docedit.php?DID=$DID'> Profile</a>
				<br> <a href='docschedule.php?DID=$DID'> Schedule</a> </td>
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