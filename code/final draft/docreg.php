<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
   if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Only Admin can Register')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
   if (isset($_POST['btnreg']))
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
      $password=md5($_POST['txtpassword']);
      $status=$_POST['txtstatus'];

      $select="Select * from dbdoctor where email='$email'";
      $run=mysqli_query($connect, $select);
      $count=mysqli_num_rows($run);
      if($count>0)
      {
         echo"<script> alert('Doctor Already Exist')</script>";
      }
      else
      {
         $insert="INSERT into dbdoctor(name,DepartmentID,phnum,ssn, degree, dob, price, salary,email,password,status) values('$name','$department','$phnum','$ssn','$degree','$dob','$price','$salary','$email','$password','$status')";
         $run=mysqli_query($connect,$insert);

         if ($run) 
         {
            echo"<script> alert('Successfully Registered')</script>";
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
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Doctor Register</title>
</head>
<body>
   <h2>Doctor <br><strong class="white "> Register</strong></h2>
   <form class="book_now" action="#" method="post">
      <div class="row">
         <div class="col-sm-12">
            <input class="contactus" placeholder="Name" type="text" name="txtname" required>
         </div>
         <div class="col-sm-12">
            <select name="txtdepartment" required>
               <option value="" disabled hidden selected="">Department</option>
               <?php 
               $select="Select * from dbdepartment";
               $run=mysqli_query($connect,$select);
               $count=mysqli_num_rows($run);
               for ($i=0; $i < $count; $i++) 
               { 
                  $row=mysqli_fetch_array($run);
                  $DID=$row[0];
                  $Dname=$row[1];
                  echo "
                     <option value=$DID>$Dname</option>
                  ";
               }
                ?>
            </select>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="SSN" type="text" name="txtssn" required>
         </div>
         <div class="col-sm-12">
            <textarea class="textarea" placeholder="Degree" type="text" name="txtdegree"></textarea>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="D.O.B" type="date" name="txtdob" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Phone Number" type="text" name="txtphnum" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Price" type="text" name="txtprice" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Salary" type="text" name="txtsalary" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Email" type="email" name="txtemail" required>
         </div>
         <div class="col-sm-12">
            <select required name="txtstatus">
               <option value="active">active</option>
               <option value="inactive">inactive</option>
            </select>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Password" type="password" name="txtpassword" required id="myInput">
            <input type="checkbox" onclick="myFunction()"> Show Password 👁 
            <script>
               function myFunction() {
                  var x = document.getElementById("myInput");
                  if (x.type === "password") {
                     x.type = "text";
                  } else {
                     x.type = "password";
                  }
               }
            </script>
         </div>
         <div class="col-sm-12">
            <br>
            <button class="send" type="submit" name="btnreg">Register</button>
            <a href='stafflogin.php'>Login</a>
         </div>
      </div>
   </form>   
<?php include ('footer.php');?>  
</body>
</html>