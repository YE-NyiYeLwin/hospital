<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
	if (!isset($_SESSION['saleid']) AND !isset($_SESSION['staffid']))
   {
      echo"<script> alert('Staff Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
   if (!isset($_SESSION['sale'])) {
	   $SaleID=$connect->query("SELECT ID FROM dbsale ORDER BY ID DESC LIMIT 1")->fetch_object()->ID;
	   if ($SaleID==null)
	   	{ $SaleID=1;}
	   else{$SaleID=$SaleID+1;}
	   $_SESSION['sale']=$SaleID;
   }
   else
   {
   	$SaleID=$_SESSION['sale'];
   }
   if (isset($_GET['removeid']))
   {
   	$removeid=$_GET['removeid'];

   	$totalquan=$connect->query("SELECT quantity FROM dbproduct WHERE ID='$removeid'")->fetch_object()->quantity;
	   $quan=$connect->query("SELECT quantity FROM dbsaledetail WHERE productID='$removeid' AND saleID='$SaleID'")->fetch_object()->quantity;
   	$leftquan=$totalquan+$quan;
   	$update="UPDATE dbproduct SET quantity = '$leftquan' WHERE ID='$removeid'";

   	$select="delete from dbsaledetail WHERE saleid='$SaleID' AND productid='$removeid'";
	   $run=mysqli_query($connect,$select);

   	$run=mysqli_query($connect,$update);
   }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Product Sale</title>
 </head>
 <body>
 	<form action="" method="post">  
		<strong>Search:</strong>
		<input type="text" list="products" class="search" name="txtname" placeholder="name" />
		<datalist id="products">
		  <?php 
	         $select="Select * from dbproduct";
	         $run=mysqli_query($connect,$select);
	         $count=mysqli_num_rows($run);
	         for ($i=0; $i < $count; $i++) 
	         { 
	            $row=mysqli_fetch_array($run);
	            $PID=$row[0];
	            $Pname=$row[1];
	            echo "
	               <option value=$Pname></option>
	            ";
	         }
	      ?>
		</datalist>
		Amount: <input type="number" class="search" name="txtquan">
		<input type="submit" value="Add" name="btnadd" onclick="" />  
	<table width="100%" id="tableID">
	<tr>
		<td>Name <?php echo $SaleID; ?></td>
		<td>Price/tablet</td>
		<td>Quantity</td>
		<td>Price</td>
		<td>Remove</td>

	</tr>
	<?php
		$sql = "SELECT * FROM dbsaledetail WHERE saleID='$SaleID'";
		$r_query = mysqli_query($connect,$sql);
		$count=mysqli_num_rows($r_query);
		for ($i=0; $i < $count; $i++) { 
			$row = mysqli_fetch_array($r_query);
			$PID=$row['productID'];
			$name=$connect->query("SELECT name FROM dbproduct WHERE ID='$PID'")->fetch_object()->name;
			$rprice=$connect->query("SELECT retailprice FROM dbproduct WHERE name='$name'")->fetch_object()->retailprice;
	      $price=$row['price'];
	      $quan=$row['quantity'];
			echo"
			<tr id=$PID>
				<td> $name </td>
				<td> $rprice </td>
				<td> $quan </td>
				<td> $price </td>
				<td> <a href='productsale.php?removeid=$PID'>Remove</a></td>
			</tr>
			";
		} 
		if (isset($_POST['btnadd']) && $_POST['txtname']!=null && $quan=$_POST['txtquan']!=null) {
			$name=$_POST['txtname'];
			$productID=$connect->query("SELECT ID FROM dbproduct WHERE name='$name'")->fetch_object()->ID;
			$quan=$_POST['txtquan'];
			$rprice=$connect->query("SELECT retailprice FROM dbproduct WHERE name='$name'")->fetch_object()->retailprice;
  			$price=$quan*$rprice;
  			$insert="INSERT into dbsaledetail(saleID,productID,quantity,price) values('$SaleID','$productID','$quan','$price')";
      	$run=mysqli_query($connect,$insert);

      	$totalquan=$connect->query("SELECT quantity FROM dbproduct WHERE ID='$productID'")->fetch_object()->quantity;
      	$leftquan=$totalquan-$quan;
      	$update="UPDATE dbproduct SET quantity = '$leftquan' WHERE ID='$productID'";
      	$run=mysqli_query($connect,$update);

      	header("Refresh:0");
		}
	?>
	<tr>
		<td></td>
		<td></td>
		<td>Total:</td>
		<td>
			<?php
			$totalprice=$connect->query("SELECT SUM(price) AS price FROM `dbsaledetail` WHERE saleID='$SaleID'")->fetch_object()->price;
			echo $totalprice;
			?>
		</td>
		<td><input type="submit" value="Save" name="btnsave"></td>
	</tr>
	</table>
</form>
<?php include ('footer.php');?>
 </body>
 </html>
 <?php 
 if (isset($_POST['btnsave'])) {
		$date=date('Y-m-d');
		date_default_timezone_set('Asia/Yangon');
		$time=date("H:i:s");
		$staffid=$_SESSION['saleid'];
		$totalprice=$connect->query("SELECT SUM(price) AS price FROM `dbsaledetail` WHERE saleID='$SaleID'")->fetch_object()->price;
		$insert="Insert into dbsale(ID,date,totalprice,staffid,time) values('$SaleID','$date','$totalprice','$staffid','$time')";
	   $run=mysqli_query($connect,$insert);
	   if ($run) {
	   	echo"<script> alert('Sale Recorded')</script>";
	   	unset($_SESSION['sale']);
	   	header("Refresh:0");
	   }
	   else
	   {
	   	echo"<script> alert('Error')</script>";
	   }
		
	}
  ?>