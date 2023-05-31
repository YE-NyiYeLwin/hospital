<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');

   if (isset($_POST['btnlogin']))
   {
      $email=$_POST['txtemail'];
      $password=md5($_POST['txtpassword']);

      $select="Select * from dbpatient where email='$email' and password='$password'";
      $run=mysqli_query($connect, $select);

      if(mysqli_num_rows($run)>0)
      {
         $row=mysqli_fetch_array($run);
         $patientID=$row[0];
         $_SESSION['patientid']=$patientID;
         echo "<script>window.alert('Patient Logged In')</script>";
            echo"<script> window.location='booking.php'</script>";
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
   <h2>Patient <br> Login</h2>
   <div class="col-sm-12">
      <input class="contactus" placeholder="Email" type="email" name="txtemail" required>
   </div>
   <div class="col-sm-12">
      <input class="contactus" placeholder="Password" type="password" name="txtpassword" required id="myInput">
      <input type="checkbox" onclick="myFunction()"> Show Password 👁 
      <br><a href='patientreg.php'>Register</a>
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