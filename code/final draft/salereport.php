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
 	<title>Sales Display</title>
 </head>
 <body>
 	<form action="" method="post"><br>
		<h3>Sales Report</h3>
		<input type="text" name="term" class="search" placeholder="Search SaleID or Date" />
		<input type="submit" value="Search" />  
	
	<table width="100%">
	<tr style="outline: thin solid">
		<td>ID</td>
		<td>Date</td>
		<td>Time</td>
		<td>Staff ID- Name</td>
		<td>TotalPrice</td>
	</tr>
	<?php
		if (!empty($_REQUEST['term'])) {

			$term = mysqli_real_escape_string($connect,$_REQUEST['term']);     

			$sql = "SELECT * FROM dbsale WHERE ID LIKE '%".$term."%' OR date LIKE '%".$term."%' "; 
			$r_query = mysqli_query($connect,$sql); 

			while ($row = mysqli_fetch_array($r_query))
			{
				$ID=$row['ID'];
				$date=$row['date'];
		      $time=$row['time'];
		      $staffid=$row['staffid'];
		      $totalprice=$row['totalprice'];

		      $staffname=$connect->query("SELECT name FROM dbstaff where ID='$staffid'")->fetch_object()->name;
		      
				echo"
				<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				</tr>
				<tr style='outline: thin solid'>
				<td>$ID</td>
				<td>$date</td>
				<td>$time</td>
				<td>$staffid - $staffname</td>
				<td>$totalprice</td>
				</tr>
				";
				$sql2 = "SELECT * FROM dbsaledetail where saleID='$ID'";
				$r_query2 = mysqli_query($connect,$sql2); 
				$count2=mysqli_num_rows($r_query2);
				for ($j=0; $j < $count2; $j++) { 
					$row2 = mysqli_fetch_array($r_query2);
					$productID=$row2['productID'];
					$quantity=$row2['quantity'];
			      $price=$row2['price'];

					$productname=$connect->query("SELECT name FROM dbproduct where ID='$productID'")->fetch_object()->name;

					echo"
					<tr style='outline: thin solid'>
					<td></td>
					<td>Product: $productID - $productname</td>
					<td>Quantity: $quantity</td>
					<td>Price: $price</td>
					<td></td>
					</tr>
					";
					
				}
			}
		}
		else
		{
			$sql = "SELECT * FROM dbsale ORDER BY ID";
			$r_query = mysqli_query($connect,$sql); 
			$count=mysqli_num_rows($r_query);
			for ($i=0; $i < $count; $i++) { 
				$row = mysqli_fetch_array($r_query);
				$ID=$row['ID'];
				$date=$row['date'];
		      $time=$row['time'];
		      $staffid=$row['staffid'];
		      $totalprice=$row['totalprice'];

				$staffname=$connect->query("SELECT name FROM dbstaff where ID='$staffid'")->fetch_object()->name;

				echo"
				<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				</tr>
				<tr style='outline: thin solid'>
				<td>$ID</td>
				<td>$date</td>
				<td>$time</td>
				<td>$staffid - $staffname</td>
				<td>$totalprice</td>
				</tr>
				";
				$sql2 = "SELECT * FROM dbsaledetail where saleID='$ID'";
				$r_query2 = mysqli_query($connect,$sql2); 
				$count2=mysqli_num_rows($r_query2);
				for ($j=0; $j < $count2; $j++) { 
					$row2 = mysqli_fetch_array($r_query2);
					$productID=$row2['productID'];
					$quantity=$row2['quantity'];
			      $price=$row2['price'];

					$productname=$connect->query("SELECT name FROM dbproduct where ID='$productID'")->fetch_object()->name;

					echo"
					<tr style='outline: thin solid'>
					<td></td>
					<td>Product: $productID - $productname</td>
					<td>Quantity: $quantity</td>
					<td>Price: $price</td>
					<td></td>
					</tr>
					";
					
				}
			}
		}
	?>
	</table>  
	</form>
<?php include ('footer.php');?>
 </body>
 </html>