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
 	<title>Product Display</title>
 </head>
 <body>
 	<form action="" method="post">  
		<strong>Search:</strong> <input class="search" type="text" name="term" placeholder="name" />
		<input type="submit" value="Search" />  
	
	<table width="100%">
	<tr>
		<td>Name</td>
		<td>Retail Price</td>
		<td>Supplier Price</td>
		<td>SupplierID</td>
		<td>Quantity</td>
		<td>Description</td>
		<td>Edit</td>
	</tr>
	<?php
		if (!empty($_REQUEST['term'])) {

			$term = mysqli_real_escape_string($connect,$_REQUEST['term']);     

			$sql = "SELECT * FROM dbproduct WHERE name LIKE '%".$term."%' ORDER BY name"; 
			$r_query = mysqli_query($connect,$sql); 

			while ($row = mysqli_fetch_array($r_query)){
			$name=$row['name'];
	      $rprice=$row['retailprice'];
	      $sprice=$row['supplierprice'];
	      $sname=$row['suppliername'];
	      $quantity=$row['quantity'];
	      $descrip=$row['description'];
	      $ProductID=$row['ID'];
			echo"
			<tr>
			<td> $name </td>
			<td> $rprice </td>
			<td> $sprice </td>
			<td> $sname </td>
			<td> $quantity </td>
			<td> $descrip </td>
			<td> <a href='productedit.php?PID=$ProductID'> Edit</a> </td>
			</tr>
			";
			}
		}
		else
		{
			$sql = "SELECT * FROM dbproduct ORDER BY name";
			$r_query = mysqli_query($connect,$sql); 
			$count=mysqli_num_rows($r_query);
			for ($i=0; $i < $count; $i++) { 
				$row = mysqli_fetch_array($r_query);
				$name=$row['name'];
		      $rprice=$row['retailprice'];
		      $sprice=$row['supplierprice'];
		      $sname=$row['suppliername'];
		      $quantity=$row['quantity'];
		      $descrip=$row['description'];
		      $ProductID=$row['ID'];
				echo"
				<tr>
				<td> $name </td>
				<td> $rprice </td>
				<td> $sprice </td>
				<td> $sname </td>
				<td> $quantity </td>
				<td> $descrip </td>
				<td> <a href='productedit.php?PID=$ProductID'> Edit</a> </td>
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