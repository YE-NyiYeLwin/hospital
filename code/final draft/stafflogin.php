<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');

   if (isset($_POST['btnlogin']))
   {
      $email=$_POST['txtemail'];
      $password=md5($_POST['txtpassword']);

      $select="Select * from dbstaff where email='$email' and password='$password'";
      $run=mysqli_query($connect, $select);

      $select2="Select * from dbdoctor where email='$email' and password='$password'";
      $run2=mysqli_query($connect, $select2);

      if(mysqli_num_rows($run)>0)
      {
         $row=mysqli_fetch_array($run);
         $StaffID=$row[0];
         $select="Select type from dbstaff where ID='$StaffID'";
         $rn=mysqli_query($connect, $select);
         $row=mysqli_fetch_array($rn);
         $run=$row[0];
         if ($run=='admin')
         {
            $_SESSION['staffid']=$StaffID;
            $date=date('Y-m-d');
            $UID=$_SESSION['staffid'];
            echo "<script>window.alert('Admin Staff Logged In')</script>";
            echo"<script> window.location='admin.php'</script>";
         }
         else if ($run=='sale')
         {
            $_SESSION['saleid']=$StaffID;
            echo "<script>window.alert('Sale Staff Logged In')</script>";
            echo"<script> window.location='productsale.php'</script>";
         }
         else if ($run=='purchase')
         {
            $_SESSION['purchaseid']=$StaffID;
            echo "<script>window.alert('Purchase Staff Logged In')</script>";
            echo"<script> window.location='supply.php'</script>";
         }
      }  
      else if (mysqli_num_rows($run2)>0) 
      {
         $row2=mysqli_fetch_array($run2);
         $DocID=$row2[0];
         $_SESSION['doctorid']=$DocID;
         echo "<script>window.alert('Doctor Logged In')</script>";
         echo"<script> window.location='docedit.php'</script>";
      }
      else
      {
         if (!isset($_SESSION['count'])) 
            {
               $_SESSION['count']=1;
            }
            else if($_SESSION['count']<3)
            {
               $_SESSION['count']+=1;
            }
            if($_SESSION['count']>=3)
            {
               echo "<script>window.alert('Disabled for 10 Minutes')</script>";
               $_SESSION['check']=1;
            }
            else
            {
               echo "<script> alert ('Try Again'); </script>";
               //echo mysqli_error($connect) ;
            }
      }
   }
?>
<!----Timer Code---->
   
   <style type="text/css">
      .timer 
      {
          width: 100px;
          font-size: 2.5em;
          text-align: center;
      }
   </style>
   <script type="text/javascript">

      var seconds = 5; //timerseconds
      
      function secondPassed() 
      {
          var minutes = Math.round((seconds - 30)/60),
          remainingSeconds = seconds % 60;

          if (remainingSeconds < 10) 
          {
              remainingSeconds = "0" + remainingSeconds;
          }          

          document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;

          if (seconds == 0) 
          {
             clearInterval(countdownTimer);
             //form1 is your form name
             window.location.href = "stafflogin.php";
          }
          else 
          {
              seconds--;
          }
      }
      var countdownTimer = setInterval('secondPassed()', 1000);
   </script>
   <?php 
      if (isset($_SESSION['check']))
      {
         echo "<div class='timer'>
            <time id='countdown'>10:00</time>
            </div>
         ";
         unset($_SESSION['check']);
         unset($_SESSION['count']); 
      }
      else
      {
    ?>

<form class="book_now" action="#" method="post">
   <h2>Staff <br> Login</h2>
   <div class="col-sm-12">
      <input class="contactus" placeholder="Email" type="email" name="txtemail" required>
   </div>
   <div class="col-sm-12">
      <input class="contactus" placeholder="Password" type="password" name="txtpassword" required id="myInput">
      <input type="checkbox" onclick="myFunction()"> Show Password 👁 
      <br><a href='staffreg.php'>Register</a>
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
      <button class="send" type="submit" name="btnlogin"><i class="fa fa-id-badge"></i>&nbspLogin</button>
   </div>
</form>
<?php include ('footer.php');?>
      <?php } ?>