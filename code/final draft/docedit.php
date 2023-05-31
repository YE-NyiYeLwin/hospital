<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
   if (!isset($_SESSION['staffid']))
      {
      	if (!isset($_SESSION['doctorid'])) 
      	{
      		echo"<script> alert('Only Admin and Doctor')</script>";
        		echo"<script> window.location='stafflogin.php'</script>";
      	}  
      }
   if (isset($_GET['DID']))
   {
   	$DID=$_GET['DID'];
   }
   else if (isset($_SESSION['doctorid'])) {
   	$DID=$_SESSION['doctorid'];
   }
   if (isset($_GET['DID']) || isset($_SESSION['doctorid']))
   {
   	$select="SELECT * FROM dbdoctor WHERE ID='$DID'";
   	$run=mysqli_query($connect,$select);
   	$row=mysqli_fetch_array($run);
   	$ID=$row['ID'];
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
      $password=$row['password'];
      $department = $connect->query("SELECT Name FROM dbdepartment WHERE ID='$departmentid'")->fetch_object()->Name;
      if (isset($_POST['btnedit']))
      {
      	$name=$_POST['txtname'];
	      $ssn=$_POST['txtssn'];
	      $phnum=$_POST['txtphnum']; 
	      $degree=$_POST['txtdegree'];
	      $dob=$_POST['txtdob'];
	      $department=$_POST['txtdepartment'];
	      $price=$_POST['txtprice'];
	      $salary=$_POST['txtsalary'];
	      $email=$_POST['txtemail'];
	      $status=$_POST['txtstatus'];

	      $update="UPDATE dbdoctor SET name='$name', ssn='$ssn', phnum='$phnum', degree='$degree', dob='$dob', DepartmentID='$department', price='$price', salary='$salary', email='$email', status='$status' WHERE ID='$DID'";
	      $run=mysqli_query($connect,$update);
         if ($run)
         {
            echo "<script>window.alert('Updated Successfully')</script>";
            echo"<script> window.location='docedit.php?DID=$DID'
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
      			$update="UPDATE dbdoctor SET password='$npassword' WHERE ID='$ID'";
      			$run=mysqli_query($connect,$update);
		         if ($run)
		         {
		            echo "<script>window.alert('Updated Successfully')</script>";
		            echo"<script> window.location='docedit.php?DID=$ID'
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
	<title>Doctor Edit</title>
</head>
<body>
	<h2>Doctor <br><strong class="white "> Edit</strong></h2>
	<form class="book_now" action="#" method="post">
	  <div class="row">
	     <div class="col-sm-12">
	     	Name
	        <input class="contactus" placeholder="Name" value="<?php echo $name ?>" type="text" name="txtname" required>
	     </div>
	     <div class="col-sm-12">
	     	Department
	        <select name="txtdepartment" required>
	           <option value="<?php echo $departmentid ?>" hidden selected=""><?php echo $department ?></option>
	           <?php 
	           $select="Select * from dbdepartment";
	           $run=mysqli_query($connect,$select);
	           $count=mysqli_num_rows($run);
	           for ($i=0; $i < $count; $i++) 
	           { 
	              $row=mysqli_fetch_array($run);
	              $DeID=$row[0];
	              $Dname=$row[1];
	              echo "
	                 <option value=$DeID>$Dname</option>
	              ";
	           }
	            ?>
	        </select>
	     </div>
	     <div class="col-sm-12">
	     	SSN
	        <input class="contactus" placeholder="SSN" value="<?php echo $ssn ?>" type="text" name="txtssn" readonly>
	     </div>
	     <div class="col-sm-12">
	     	Degree
	        <textarea class="textarea" placeholder="Degree" type="text" name="txtdegree"><?php echo $degree ?></textarea>
	     </div>
	     <div class="col-sm-12">
	     	DOB
	        <input class="contactus" placeholder="D.O.B" type="date" value="<?php echo $dob ?>" name="txtdob" required>
	     </div>
	     <div class="col-sm-12">
	     	Phone Number
	        <input class="contactus" placeholder="Phone Number" type="text" value="<?php echo $phnum ?>" name="txtphnum" required>
	     </div>
	     <div class="col-sm-12">
	     	Price
	        <input class="contactus" placeholder="Price" type="text" name="txtprice" value="<?php echo $price ?>" required>
	     </div>
	     <div class="col-sm-12">
	     	Salary
	        <input class="contactus" placeholder="Salary" type="text" name="txtsalary" value="<?php echo $salary ?>" required>
	     </div>
	     <div class="col-sm-12">
	     	Email
	        <input class="contactus" placeholder="Email" type="email" name="txtemail" value="<?php echo $email ?>" required>
	     </div>
	     <div class="col-sm-12">
	     	Status
            <select required name="txtstatus">
            	<option value="<?php echo $status ?>" hidden selected=""><?php echo $status ?></option>
               <option value="active">active</option>
               <option value="inactive">inactive</option>
            </select>
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