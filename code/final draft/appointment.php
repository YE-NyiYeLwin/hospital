<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	include ('header.php');
	if (!isset($_SESSION['doctorid']))
   {
      echo"<script> alert('Doctors Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
   $bookingID=$_GET['BID'];
   $patientid=$_GET['PID'];
   if (isset($_POST['btnprocess'])) 
   {
      $symptoms=$_POST['txtsymptoms'];
      $cause=$_POST['txtcause'];
      $prescription=$_POST['txtprescription'];
      $notes=$_POST['txtdocnote'];
      $tdydate=date('Y-m-d');
      $insert="INSERT into dbappointment(BookingID,doctornote,symptom,suspectedcause,prescription,date) values('$bookingID','$notes','$symptoms','$cause','$prescription','$tdydate')";
      $run=mysqli_query($connect,$insert);
      $update="UPDATE dbboooking SET status='done' WHERE ID='$bookingID'";
      $run2=mysqli_query($connect,$update);
      $_SESSION['booking']=$bookingID;
      if ($run) 
      {
         echo"<script> alert('Appointment Successful')</script>";
         echo"<script> window.location='appointmentslip.php'</script>";
      }
      else
      {
         echo mysqli_error($connect);
      }
   }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment</title>
 </head>
 <body>
   <form action="" method="post">
      <strong>Patient Info</strong>
      <table>
      <tr>
      <td>Name</td>
      <td>Phone Number</td>
      <td>Email</td>
      <td>Address</td>
      <td>D.O.B</td>
      <td>Allergies</td>
   </tr>
   <?php 
      $sql="SELECT * FROM dbpatient WHERE ID='$patientid'";
      $r_query = mysqli_query($connect,$sql); 
      $row = mysqli_fetch_array($r_query);
      $PaID=$row['ID'];
      $name=$row['name'];
      $phnum=$row['phnum'];
      $email=$row['email']; 
      $address=$row['address'];
      $dob=$row['dob'];
      $allergies=$row['allergies'];

      echo"
         <tr>
         <td>$name</td>
         <td>$phnum</td>
         <td>$email</td>
         <td>$address</td>
         <td>$dob</td>
         <td>$allergies</td>
         </tr>
      ";
    ?>
    </table><br>
    <strong>Appointment Info</strong><br><br>
   <div class="col-sm-12">
      Symptoms
      <textarea placeholder="Symptoms" name="txtsymptoms" required></textarea>
   </div>
   <div class="col-sm-12">
      Suspected Cause
      <textarea placeholder="Suspected Cause" name="txtcause" required></textarea>
   </div>
   <div class="col-sm-12">
      Prescription
      <textarea placeholder="Prescription" name="txtprescription" required></textarea>
   </div>
   <div class="col-sm-12">
      Doctor's Notes
      <textarea placeholder="Doctor's Notes" name="txtdocnote" required></textarea>
   </div>
   <div class="col-sm-12">
      <br>
      <button class="send" type="submit" name="btnprocess">Process</button>
   </div>
   </form>
   <?php include('footer.php'); ?>
 </body>
 </html>