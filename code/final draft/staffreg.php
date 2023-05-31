<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
   if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Admins Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
   if (isset($_POST['btnreg']))
   {
      $name=$_POST['txtname'];
      $phnum=$_POST['txtphnum']; 
      $type=$_POST['txttype'];
      $salary=$_POST['txtsalary'];
      $email=$_POST['txtemail'];
      $password=md5($_POST['txtpassword']);

      $select="Select * from dbstaff where email='$email'";
      $run=mysqli_query($connect, $select);
      $count=mysqli_num_rows($run);
      if($count>0)
      {
         echo"<script> alert('Staff Already Exist')</script>";
      }
      else
      {
         $insert="INSERT into dbstaff(name,phnum,type,salary,email,password) values('$name','$phnum','$type','$salary','$email','$password')";
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
   <title>Staff Register</title>
</head>
<body>
   <h2>Staff <br>Register</h2>
   <form class="book_now" action="#" method="post">
      <div class="row">
         <div class="col-sm-12">
            <input class="contactus" placeholder="Name" type="text" name="txtname" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Phone Number" type="text" name="txtphnum" required> 
         </div>
         <div class="col-sm-12">
            <select name="txttype" required>
               <option value="" disabled hidden selected="">Staff Type</option>
               <option value="admin">Admin</option>
               <option value="sale" >Sales</option>
               <option value="purchase" >Purchase</option>
            </select>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Salary" type="text" name="txtsalary" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Email" type="email" name="txtemail" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Password" type="password" name="txtpassword" required id="myInput">
            <input type="checkbox" onclick="myFunction()"> Show Password 👁 
            <br><a href='stafflogin.php'>Login</a>
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
            <button class="send" type="submit" name="btnreg"><i class="fa fa-address-book-o"></i>&nbspRegister</button>
         </div>
      </div>
   </form>  
<?php include ('footer.php');?>   
</body>
</html>