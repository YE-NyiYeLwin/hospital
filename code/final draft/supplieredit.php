<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
   if (!isset($_SESSION['staffid']))
      {
      	echo"<script> alert('Admins Only')</script>";
        	echo"<script> window.location='stafflogin.php'</script>";  
      }
   if (isset($_GET['SID']))
   {
   	$SID=$_GET['SID'];
   	$select="SELECT * FROM dbsupplier WHERE ID='$SID'";
   	$run=mysqli_query($connect,$select);
   	$row=mysqli_fetch_array($run);
   	$SID=$row['ID'];
		$compname=$row['companyname'];
      $contactno=$row['contactno'];
      $email=$row['email'];
      $address=$row['address'];
      if (isset($_POST['btnedit']))
      {
      	$compname=$_POST['txtcompname'];
	      $contactno=$_POST['txtcontactno']; 
	      $email=$_POST['txtemail'];
	      $address=$_POST['txtaddress'];

	      $update="UPDATE dbsupplier SET companyname='$compname', contactno='$contactno', email='$email', address='$address' WHERE ID='$SID'";
	      $run=mysqli_query($connect,$update);
         if ($run)
         {
            echo "<script>window.alert('Updated Successfully')</script>";
            echo"<script> window.location='supplieredit.php?SID=$SID'
            </script>";
         }
         else
         {
            echo mysqli_error($connect);
         }
      }
   }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Supplier Edit</title>
</head>
<body>
	<h2>Supplier <br><strong class="white "> Edit</strong></h2>
	<form class="book_now" action="#" method="post">
	  <div class="row">
	     <div class="col-sm-12">
	     	  Company Name
	        <input class="contactus" placeholder="Name" value="<?php echo $compname ?>" type="text" name="txtcompname" required>
	     </div>
         <div class="col-sm-12">
         	Contact Number
            <input class="contactus" placeholder="Contact Number" value="<?php echo $contactno ?>" type="text" name="txtcontactno" required> 
         </div>
         <div class="col-sm-12">
         	Email
            <input class="contactus" placeholder="Email" value="<?php echo $email ?>" type="text" name="txtemail" required>
         </div>
         <div class="col-sm-12">
         	Address
            <textarea class="contactus" placeholder="Address"name="txtaddress" required><?php echo $address ?></textarea>
         </div>
	     <div class="col-sm-12">
	        <br>
	        <button class="send" type="submit" name="btnedit">Edit</button>
	     </div>
	  </div>
	</form>
<?php include ('footer.php');?>
</body>
</html>