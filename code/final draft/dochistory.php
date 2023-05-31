<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	include ('header.php');
	if (!isset($_SESSION['doctorid']) AND !isset($_SESSION['staffid']))
   {
      echo"<script> alert('Authorized Account Required')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Appointment History</title>
</head>
<body>
   <form action="" method="post">  
   <strong>Appointment History</strong> 
   <?php 
      if (isset($_SESSION['staffid'])) 
      {
         echo "<input type='text' class='search' name='term' placeholder='Search Doctor Name' /> 
         <input type='submit' value='Search' />";
      }
      else
      { 

         $DID=$_SESSION['doctorid'];
         echo "<input type='text' class='search' name='term' placeholder='Search Patient Name' /> 
         <input type='submit' value='Search' />";
      }
    ?>
   <table width="100%">
   <tr>
      <td>Patient Name</td>
      <td>ContactNo</td>
      <td>Session</td>
      <td>BookingNo</td>
      <td>Symptom</td>
      <td>Suspected Cause</td>
      <td>Prescription</td>
      <td>Doctor's Notes</td>
      <td>Date</td>
   </tr>
   <?php 
      if (isset($_SESSION['staffid'])) 
      {
         if (!empty($_REQUEST['term'])) {
            $term = mysqli_real_escape_string($connect,$_REQUEST['term']);  
            $DID = $connect->query("SELECT ID FROM dbdoctor WHERE name LIKE '%".$term."%'")->fetch_object()->ID;
            if ($DID=='') {
               $patient="";
            }
            $sql1 = "SELECT * FROM dbschedule WHERE DoctorID='$DID'";
            
         }
         else{
            $sql1 = "SELECT * FROM dbschedule";
         }
      }
      else
      {
         $sql1 = "SELECT * FROM dbschedule WHERE DoctorID='$DID'";
      }
      $r_query1 = mysqli_query($connect,$sql1);
      $count1=mysqli_num_rows($r_query1);
      for ($i=0; $i < $count1; $i++) { 
         $row1 = mysqli_fetch_array($r_query1);
         $SchID=$row1['ID'];
         $timestart=$row1['timestart'];
         $timeend=$row1['timeend'];
         $sql = "SELECT * FROM dbboooking WHERE ScheduleID='$SchID' AND status='done'";
         $r_query = mysqli_query($connect,$sql);
         $count=mysqli_num_rows($r_query);
         for ($j=0; $j < $count; $j++) { 
            $row = mysqli_fetch_array($r_query);
            $bookingid=$row['ID'];
            $PatientID=$row['PatientID'];
            $bookingnumber=$row['bookingnumber'];
            $patient = $connect->query("SELECT name FROM dbpatient WHERE ID='$PatientID'")->fetch_object()->name;
            $phnum = $connect->query("SELECT phnum FROM dbpatient WHERE ID='$PatientID'")->fetch_object()->phnum;
            $sql3 = "SELECT * FROM dbappointment WHERE BookingID='$bookingid'";
            $r_query3 = mysqli_query($connect,$sql3);
            $row3 = mysqli_fetch_array($r_query3);
            $symptom=$row3['symptom'];
            $cause=$row3['suspectedcause'];
            $prescription=$row3['prescription'];
            $notes=$row3['doctornote'];
            $date=$row3['date'];
            echo"
            <tr>
            <td>$patient</td>
            <td>$phnum</td>
            <td>$timestart - $timeend</td>
            <td>$bookingnumber</td>
            <td>$symptom</td>
            <td>$cause</td>
            <td>$prescription</td>
            <td>$notes</td>
            <td>$date</td>
            </tr>";
         }
      }
    ?>
</table>
</form>
</body>
<?php include ('footer.php'); ?>
</html>