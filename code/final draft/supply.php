<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	include('header.php');
	if (!isset($_SESSION['staffid']) AND !isset($_SESSION['purchaseid']))
   {
      echo"<script> alert('Purchase Staff Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
   if (!isset($_SESSION['supply'])) {
	   $SupplyID=$connect->query("SELECT ID FROM dbsupply ORDER BY ID DESC LIMIT 1")->fetch_object()->ID;
	   if ($SupplyID==null)
	   	{ $SupplyID=1;}
	   else{$SupplyID=$SupplyID+1;}
	   $_SESSION['supply']=$SupplyID;
   }
   else
   {
   	$SupplyID=$_SESSION['supply'];
   }
   if (isset($_SESSION['supplierID'])) {
	   echo"<script> alert('SupplierLocked')</script>";
   }
   else
   {
   	$_SESSION['supplierID']=null;
   }
   if (isset($_GET['removeid']))
   {
   	$removeid=$_GET['removeid'];

   	$totalquan=$connect->query("SELECT quantity FROM dbproduct WHERE ID='$removeid'")->fetch_object()->quantity;
	   $quan=$connect->query("SELECT quantity FROM dbsupplydetail WHERE productID='$removeid' AND supplyID='$SupplyID'")->fetch_object()->quantity;
   	$leftquan=$totalquan-$quan;
   	$update="UPDATE dbproduct SET quantity = '$leftquan' WHERE ID='$removeid'";

   	$select="delete from dbsupplydetail WHERE supplyid='$SupplyID' AND productid='$removeid'";
	   $run=mysqli_query($connect,$select);

   	$run=mysqli_query($connect,$update);
   }
 ?>
 <!-- <script type="text/javascript">
 	function disable(){
	document.getElementById("suppliername").disabled = "true";
	document.getElementById("btnlock").disabled = "true";
  }
 </script> -->
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Product Supply</title>
 </head>
 <body>
 	<form action="" method="post"> 
 		<strong>Supplier: </strong><?php echo $_SESSION['supplierID']; ?>
 		<input type="text" list="suppliers" class="search" name="txtsname" id="suppliername" placeholder="name" />
 		<input name="btnlock" type="submit" id="btnlock" value="Lock">
 		<br>
		<datalist id="suppliers">
		  <?php 
	         $select="Select * from dbsupplier";
	         $run=mysqli_query($connect,$select);
	         $count=mysqli_num_rows($run);
	         for ($i=0; $i < $count; $i++) 
	         { 
	            $row=mysqli_fetch_array($run);
	            $SID=$row[0];
	            $Sname=$row[1];
	            echo "
	               <option value=$Sname></option>
	            ";
	         }
	      ?>
		</datalist>
		
		Search: 
		<input type="text" list="products" class="search" name="txtname" placeholder="name" />
		<datalist id="products">
		  <?php
		  		if (isset($_POST['btnlock'])) 
		  		{
		  			$supplier=$_POST['txtsname'];
		  			if ($_POST['txtsname']==null) {
		  				echo"<script> alert('Supplier Data Null')</script>";
		  			}
		  			else{
		  				$SupplierID=$connect->query("SELECT ID FROM dbsupplier WHERE companyname='$supplier'")->fetch_object()->ID;
	         		$_SESSION['supplierID']=$SupplierID;
	         		$select="Select * from dbproduct where suppliername='$SupplierID'";
		  			}
		  			
		  		}
		  		else{
		  			$select="Select * from dbproduct";
		  		}
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
		<td>Name <?php echo $SupplyID; ?></td>
		<td>Price/tablet</td>
		<td>Quantity</td>
		<td>Price</td>
		<td>Remove</td>

	</tr>
	<?php
		$sql = "SELECT * FROM dbsupplydetail WHERE supplyid='$SupplyID'";
		$r_query = mysqli_query($connect,$sql);
		$count=mysqli_num_rows($r_query);
		for ($i=0; $i < $count; $i++) { 
			$row = mysqli_fetch_array($r_query);
			$PID=$row['productID'];
			$name=$connect->query("SELECT name FROM dbproduct WHERE ID='$PID'")->fetch_object()->name;
			$rprice=$connect->query("SELECT supplierprice FROM dbproduct WHERE name='$name'")->fetch_object()->supplierprice;
	      $price=$row['price'];
	      $quan=$row['quantity'];
			echo"
			<tr id=$PID>
				<td> $name </td>
				<td> $rprice </td>
				<td> $quan </td>
				<td> $price </td>
				<td> <a href='supply.php?removeid=$PID'>Remove</a></td>
			</tr>
			";
		} 
		if (isset($_POST['btnadd']) && $_POST['txtname']!=null && $quan=$_POST['txtquan']!=null) {
			$name=$_POST['txtname'];
			$productID=$connect->query("SELECT ID FROM dbproduct WHERE name='$name'")->fetch_object()->ID;
			$quan=$_POST['txtquan'];
			$rprice=$connect->query("SELECT supplierprice FROM dbproduct WHERE name='$name'")->fetch_object()->supplierprice;
  			$price=$quan*$rprice;
  			$insert="INSERT into dbsupplydetail(supplyID,productID,quantity,price) values('$SupplyID','$productID','$quan','$price')";
      	$run=mysqli_query($connect,$insert);

      	$totalquan=$connect->query("SELECT quantity FROM dbproduct WHERE ID='$productID'")->fetch_object()->quantity;
      	$leftquan=$totalquan+$quan;
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
			$totalprice=$connect->query("SELECT SUM(price) AS price FROM `dbsupplydetail` WHERE supplyID='$SupplyID'")->fetch_object()->price;
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
		if(isset($_SESSION['saleid']))
		{
			$staffid=$_SESSION['saleid'];
		}
		else{
			$staffid=$_SESSION['staffid'];
		}
		$SupplierID=$_SESSION['supplierID'];
		$totalprice=$connect->query("SELECT SUM(price) AS price FROM `dbsupplydetail` WHERE supplyID='$SupplyID'")->fetch_object()->price;
		$insert="Insert into dbsupply(ID,supplierID,date,totalprice,staffid,time) values('$SupplyID','$SupplierID','$date','$totalprice','$staffid','$time')";
	   $run=mysqli_query($connect,$insert);
	   if ($run) {
	   	echo"<script> alert('Supply Recorded')</script>";
	   	unset($_SESSION['supply']);
	   	unset($_SESSION['supplierID']);
	   	header("Refresh:0");
	   }
	   else
	   {
	   	echo"<script> alert('Error')</script>";
	   }
		
	}
  ?>