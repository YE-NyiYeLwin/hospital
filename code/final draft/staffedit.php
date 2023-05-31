<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
   if (!isset($_SESSION['staffid']) && !isset($_SESSION['saleid'])&& !isset($_SESSION['purchaseid']))
      {
      	echo"<script> alert('Authorized Personnel Only')</script>";
        	echo"<script> window.location='stafflogin.php'</script>";  
      }
   if (isset($_GET['SID']))
   {
   	$SID=$_GET['SID'];
   }
   else if (isset($_SESSION['staffid'])) {
   	$SID=$_SESSION['staffid'];
   }
   else if (isset($_SESSION['saleid'])) {
   	$SID=$_SESSION['saleid'];
   }
   else if (isset($_SESSION['purchaseid'])) {
   	$SID=$_SESSION['purchaseid'];
   }
   if (isset($_GET['SID']) || isset($_SESSION['saleid']) || isset($_SESSION['staffid'])|| isset($_SESSION['purchaseid']))
   {
   	$select="SELECT * FROM dbstaff WHERE ID='$SID'";
   	$run=mysqli_query($connect,$select);
   	$row=mysqli_fetch_array($run);
   	$ID=$row['ID'];
		$name=$row['name'];
      $phnum=$row['phnum'];
      $type=$row['type'];
      $salary=$row['salary'];
      $email=$row['email'];
      $password=$row['password'];
      if (isset($_POST['btnedit']))
      {
      	$name=$_POST['txtname'];
	      $phnum=$_POST['txtphnum']; 
	      $type=$_POST['txttype'];
	      $salary=$_POST['txtsalary'];
	      $email=$_POST['txtemail'];

	      $update="UPDATE dbstaff SET name='$name', phnum='$phnum', type='$type', salary='$salary', email='$email' WHERE ID='$ID'";
	      $run=mysqli_query($connect,$update);
         if ($run)
         {
            echo "<script>window.alert('Updated Successfully')</script>";
            echo"<script> window.location='staffedit.php?SID=$ID'
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
      			$update="UPDATE dbstaff SET password='$npassword' WHERE ID='$ID'";
      			$run=mysqli_query($connect,$update);
		         if ($run)
		         {
		            echo "<script>window.alert('Updated Successfully')</script>";
		            echo"<script> window.location='staffedit.php?SID=$ID'
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
	<title>Staff Edit</title>
</head>
<body>
	<h2>Staff <br><strong class="white "> Edit</strong></h2>
	<form class="book_now" action="#" method="post">
	  <div class="row">
	     <div class="col-sm-12">
	     	Name
	        <input class="contactus" placeholder="Name" value="<?php echo $name ?>" type="text" name="txtname" required>
	     </div>
         <div class="col-sm-12">
         	Phone Number
            <input class="contactus" placeholder="Phone Number" value="<?php echo $phnum ?>" type="text" name="txtphnum" required> 
         </div>
         <div class="col-sm-12">
         	Staff Type
            <select name="txttype" required>
               <option value="<?php echo $type ?>" hidden selected=""><?php echo $type ?></option>
               <option value="admin">admin</option>
               <option value="sale" >sale</option>
               <option value="purchase" >purchase</option>
            </select>
         </div>
         <div class="col-sm-12">
         	Salary
            <input class="contactus" placeholder="Salary" value="<?php echo $salary ?>" type="text" name="txtsalary" required>
         </div>
         <div class="col-sm-12">
         	Email
            <input class="contactus" placeholder="Email" value="<?php echo $email ?>" type="email" name="txtemail" required>
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