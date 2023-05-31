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
      $compname=$_POST['txtcompname'];
      $contactno=$_POST['txtcontactno']; 
      $email=$_POST['txtemail'];
      $address=$_POST['txtaddress'];

      $select="Select * from dbsupplier where email='$email'";
      $run=mysqli_query($connect, $select);
      $count=mysqli_num_rows($run);
      if($count>0)
      {
         echo"<script> alert('Email Already Registered')</script>";
      }
      else
      {
         $insert="INSERT into dbsupplier(companyname,contactno,email,address) values('$compname','$contactno','$email','$address')";
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
   <title>Supplier Register</title>
</head>
<body>
   <h2>Supplier<br><strong class="white "> Register</strong></h2>
   <form class="book_now" action="#" method="post">
      <div class="row">
         <div class="col-sm-12">
            <input class="contactus" placeholder="CompanyName" type="text" name="txtcompname" required>
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Contact Number" type="text" name="txtcontactno" required> 
         </div>
         <div class="col-sm-12">
            <input class="contactus" placeholder="Email" type="email" name="txtemail" required>
         </div>
         <div class="col-sm-12">
            <textarea placeholder="Address" name="txtaddress" required></textarea>
         </div>
         <div class="col-sm-12">
            <br>
            <button class="send" type="submit" name="btnreg">Register</button>
         </div>
      </div>
   </form>  
<?php include ('footer.php');?>   
</body>
</html>