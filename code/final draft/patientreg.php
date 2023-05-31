<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
   if (isset($_POST['btnreg']))
   {
      $name=$_POST['txtname'];
      $phnum=$_POST['txtphnum'];
      $email=$_POST['txtemail'];
      $address=$_POST['txtaddress'];
      $dob=$_POST['txtdob'];
      $allergies=$_POST['txtallergies'];
      $password=md5($_POST['txtpassword']);

      if (isset($_SESSION['staffid']))
      {
      $createdby=$_SESSION['staffid'];
      }
      else
      {
      $createdby=$name;
      }

      $select="Select * from dbpatient where email='$email' or phnum='$phnum'";
      $run=mysqli_query($connect, $select);
      $count=mysqli_num_rows($run);
      if($count>0)
      {
         echo"<script> alert('Patient Already Registered')</script>";
      }
      else
      {
         $insert="INSERT into dbpatient(name,phnum,email,address,dob,allergies,password,createdby) values('$name','$phnum','$email','$address','$dob','$allergies','$password','$createdby')";
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
   <title>Patient Register</title>
</head>
<body>
   <h2>Patient <br>Register</h2>
   <form class="book_now" action="#" method="post">
      <div class="row">
         <div class="col-sm-12">
            <input class="contactus" placeholder="Name" type="text" name="txtname" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Phone Number" type="text" name="txtphnum" required> 
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Email" type="email" name="txtemail" required>
         </div>
         <div class="col-sm-12">
            <textarea name="txtaddress" placeholder="Address" required></textarea>
         </div>
         <div class="col-sm-12">
            <input class="contactus" type="date" name="txtdob" required>
         </div>
         <div class="col-sm-12">
            <textarea name="txtallergies" placeholder="Allergies" required></textarea>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Password" type="password" name="txtpassword" required id="myInput">
            <input type="checkbox" onclick="myFunction()"> Show Password 👁 
            <br><a href='patientlogin.php'>Login</a>
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