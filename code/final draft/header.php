<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="site.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <meta charset="utf-8">
</head>
<body>
   <div class="topnav">
   <a href="" class="logo"><i class="fa fa-building-o"></i>&nbsp Hospital Sytem</a>
   <a href="" class="space">-</a>
   <?php 
      session_start();
      if (isset($_SESSION['staffid']))
      {
         echo "
         <a href='admin.php'>Menu</a> 
         <a href='productsale.php'>Sale</a> 
         <a href='productdisplay.php'>Supply</a> 
         <a href='staffdisplay.php'>Staff</a> 
         <a href='docdisplay.php'>Doctor</a> 
         <a href='logout.php'>LogOut</a> 
         ";
      }
      else if (isset($_SESSION['saleid']))
      {
         echo "
         <a href='stafflogin.php'>Home</a> 
         <a href='productsale.php'>Sales</a>
         <a href='staffedit.php'>Profile</a> 
         <a href='logout.php'>LogOut</a> 
         ";
      }
      else if (isset($_SESSION['doctorid']))
      {
         echo "
         <a href='tdybooking.php'>Today</a> 
         <a href='dochistory.php'>History</a> 
         <a href='docedit.php'>Edit Profile</a> 
         <a href='logout.php'>LogOut</a> 
         ";
      }
      else if (isset($_SESSION['purchaseid']))
      {
         echo "
         <a href='stafflogin.php'>Home</a> 
         <a href='supply.php'>Supply</a> 
         <a href='staffedit.php'>Edit Profile</a> 
         <a href='logout.php'>LogOut</a> 
         ";
      }
      else if (isset($_SESSION['patientid']))
      {
         echo "
         <a href='booking.php'>Booking</a> 
         <a href='patientlogin.php'>PatientLogin</a>
         <a href='docedit.php'>Edit Profile</a> 
         <a href='logout.php'>LogOut</a> 
         ";
      }
      else
      {
         echo "
         <a href='patientlogin.php'>Patient Login</a>
         <a href='patientreg.php'>Patient Register</a>
         <a href='stafflogin.php'>Employee</a>
         ";
      }
    ?>
    </div>
</body>
</html>