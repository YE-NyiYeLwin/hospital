<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
   if (!isset($_SESSION['staffid']))
      {
      	if (!isset($_SESSION['patientid']))
      	{
      		echo"<script> alert('Only Patient and Staff')</script>";
        		echo"<script> window.location='patientedit.php'</script>";
      	}  
      }
   if (isset($_GET['PaID']))
   {
   	$PaID=$_GET['PaID'];
   }
   else if (isset($_SESSION['patientid'])) {
   	$PaID=$_SESSION['patientid'];
   }
   if (isset($_GET['PaID']) || isset($_SESSION['patientid']))
   {
   	$select="SELECT * FROM dbpatient WHERE ID='$PaID'";
   	$run=mysqli_query($connect,$select);
   	$row=mysqli_fetch_array($run);
   	$ID=$row['ID'];
   	$name=$row['name'];
      $phnum=$row['phnum']; 
      $email=$row['email'];
      $address=$row['address'];
      $dob=$row['dob'];
      $password=$row['password'];
      $allergies=$row['allergies'];
      $createdby=$row['createdby'];
      if (isset($_POST['btnedit']))
      {
      	$name=$_POST['txtname'];
	      $phnum=$_POST['txtphnum']; 
	      $email=$_POST['txtemail'];
	      $address=$_POST['txtaddress'];
	      $dob=$_POST['txtdob'];
	      $password=$_POST['txtpassword'];
	      $allergies=$_POST['txtallergies'];

	      $update="UPDATE dbpatient SET name='$name', phnum='$phnum', email='$email', address='$address', dob='$dob', password='$password', allergies='$allergies'WHERE ID='$PaID'";
	      $run=mysqli_query($connect,$update);
         if ($run)
         {
            echo "<script>window.alert('Updated Successfully')</script>";
            echo"<script> window.location='patientedit.php?PaID=$PaID'
            </script>";
         }
         else
         {
            echo mysqli_error($connect);
         }
      }
      if (isset($_POST['btnchange']))
      {
      	$opassword=md5($_POST['txtoldpassword']);
      	if ($opassword==$password) 
      	{
      		$npassword=md5($_POST['txtnewpassword']);
      		$npassword2=md5($_POST['txtnewpassword2']);
      		if ($npassword==$npassword2)
      		{
      			$update="UPDATE dbpatient SET password='$npassword' WHERE ID='$ID'";
      			$run=mysqli_query($connect,$update);
		         if ($run)
		         {
		            echo "<script>window.alert('Updated Successfully')</script>";
		            echo"<script> window.location='patientedit.php?PaID=$ID'
		            </script>";
		         }
		         else
		         {
		            echo mysqli_error($connect);
		         }	
      		}
      		else
      		{
      			echo"<script> alert('New Passwords not Matching')</script>";
      		}
      	}
      	else
      	{
      		echo"<script> alert('Wrong Old Password')</script>";
      	}
      }
   }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Patient Edit</title>
</head>
<body>
	<h2>Patient <br>Edit </h2>
	<form class="book_now" action="#" method="post">
	  <div class="row">
	     <div class="col-sm-12">
	     	Name
	        <input class="contactus" placeholder="Name" value="<?php echo $name ?>" type="text" name="txtname" required>
	     </div>
	     <div class="col-sm-12">
	     	Phone Number
	        <input class="contactus" placeholder="Phone Number" value="<?php echo $phnum ?>" type="text" name="txtphnum" readonly>
	     </div>
	     <div class="col-sm-12">
	     	Email
	        <input class="contactus" placeholder="Email" type="text" value="<?php echo $email ?>" name="txtemail" required>
	     </div>
	     <div class="col-sm-12">
	     	Address
	        <textarea class="textarea" placeholder="Address" type="text" name="txtaddress"><?php echo $address ?></textarea>
	     </div>
	     <div class="col-sm-12">
	     	DOB
	        <input class="contactus" type="date" value="<?php echo $dob ?>" name="txtdob" required>
	     </div>
	     <div class="col-sm-12">
	     	Allergies
	        <textarea class="textarea" placeholder="Allergies" type="text" name="txtallergies"><?php echo $allergies ?></textarea>
	     </div>
	     <div class="col-sm-12">
	        <br>
	        <button class="send" type="submit" name="btnedit">Edit</button>
	     </div>

	     <h2>Change Password</h2>
	     <div class="col-sm-12">
	     		Old Password
	        <input placeholder="Old Password" type="text" name="txtoldpassword">
	        New Password
	        <input placeholder="New Password" type="text" name="txtnewpassword">
	        Confirm New Password
	        <input placeholder="New Password" type="text" name="txtnewpassword2">
	     </div>
	     <div class="col-sm-12">
	        <br>
	        <button class="send" type="submit" name="btnchange">Change</button>
	     </div>
	  </div>
	</form>
<?php include ('footer.php');?>
</body>
</html>