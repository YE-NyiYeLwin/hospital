<?php
	$connect=mysqli_connect('localhost','root','','db_draft');
	include ('header.php');
	if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Authorized Personnel Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
   if (isset($_POST['btnaddsch']))
   {
      $DID=$_GET['DID'];
      $day=$_POST['txtday'];
      $timestart=$_POST['txttstart'];
      $timeend=$_POST['txttend'];
      $patientlimit=$_POST['txtplimit'];
      $insert="INSERT into dbschedule(DoctorID,day,timestart,timeend,patientlimit) values('$DID','$day','$timestart','$timeend','$patientlimit')";
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
   if (isset($_POST['btnschedit']))
   {
      $SchID=$_GET['SchID'];
      $day=$_POST['txtday'];
      $timestart=$_POST['txttstart'];
      $timeend=$_POST['txttend'];
      $patientlimit=$_POST['txtplimit'];
      $update="UPDATE dbschedule SET day='$day', timestart='$timestart', timeend='$timeend', patientlimit='$patientlimit' WHERE ID='$SchID'";
         $run=mysqli_query($connect,$update);

      if ($run) 
      {
         echo"<script> alert('Successfully Updated')</script>";
      }
      else
      {
         echo mysqli_error($connect);
      }
   }
 ?>
 <head>
   <meta charset="utf-8">
   <title>Doctor Schedule</title>
 </head>
 <body>
    
    <!-- The Modal -->
   <div id="myModal" class="modal">

     <!-- Modal content -->
     <div class="modal-content">
       <span class="close">&times;</span>
       <h2>Add Schedule</h2>
         <form class="book_now" action="#" method="post">
            <div class="row">
               <div>
               Day
               <select name='txtday' required>
                 <option value='Sunday'>Sunday</option>
                 <option value='Monday'>Monday</option>
                 <option value='Tuesday'>Tuesday</option>
                 <option value='Wednesday'>Wednesday</option>
                 <option value='Thursday'>Thursday</option>
                 <option value='Friday'>Friday</option>
                 <option value='Saturday'>Saturday</option>
               </select>
               </div>
               <div>
                  Time Start
                 <input placeholder='Time Start' type='text' name='txttstart' required>
               </div>
               <div>
                  Time End
                 <input placeholder='Time End' type='text' name='txttend' required>
               </div>
               <div>
                  Patient Limit
                 <input placeholder='Patient Limit' type='number' name='txtplimit' required>
               </div>
                  <br>
                  <button class="send" type="submit" name="btnaddsch">Add</button>
            </div>
         </form>   
     </div>

   </div>
   <form action="" method="post">
      <strong>Doctor Schedule: </strong>
     <a id="myBtn" class="topbutton">Add New</a><br><br>
   <?php 
      if (isset($_GET['SchID'])) {
         $SchID=$_GET['SchID'];
         $select="SELECT * FROM dbschedule WHERE ID='$SchID'";
         $run=mysqli_query($connect,$select);
         $row=mysqli_fetch_array($run);
         $day=$row['day'];
         $DID=$row['DoctorID'];
         $timestart=$row['timestart'];
         $timeend=$row['timeend'];
         $patientlimit=$row['patientlimit'];
         echo "
         <div>
         ID
           <input placeholder='ID' value='$SchID' type='text' name='txtschid' disabled required>
         DoctorID
           <input placeholder='DoctorID' value='$DID' type='text' name='txtdid' disabled required>
         </div>
         <div>
         Day
            <select name='txtday' required>
              <option value='$day' hidden selected>$day</option>
              <option value='Sunday'>Sunday</option>
              <option value='Monday'>Monday</option>
              <option value='Tuesday'>Tuesday</option>
              <option value='Wednesday'>Wednesday</option>
              <option value='Thursday'>Thursday</option>
              <option value='Friday'>Friday</option>
              <option value='Saturday'>Saturday</option>
            </select>
         </div>
         <div>
            Time Start
           <input placeholder='Time Start' value='$timestart' type='text' name='txttstart' required>
         </div>
         <div>
            Time End
           <input placeholder='Time End' value='$timeend' type='text' name='txttend' required>
         </div>
         <div>
            Patient Limit
           <input placeholder='Patient Limit' value='$patientlimit' type='number' name='txtplimit' required>
         </div>
         <button type='submit' name='btnschedit'>Edit</button>
         ";
      }
    ?>
<table width="100%">
   <tr>
      <td>Sch ID</td>
      <td>Day</td>
      <td>Time Start</td>
      <td>Time End</td>
      <td>Patient Limit</td>
      <td>Edit</td>
   </tr>
   <?php 
   if (isset($_GET['DID'])) {
      $DID=$_GET['DID'];
      $select="SELECT * FROM dbschedule WHERE DoctorID='$DID'";
      $run=mysqli_query($connect,$select);
      while ($row=mysqli_fetch_array($run)){
         $ID=$row['ID'];
         $day=$row['day'];
         $timestart=$row['timestart'];
         $timeend=$row['timeend'];
         $patientlimit=$row['patientlimit'];
         echo"
         <tr>
         <td> $ID </td>
         <td> $day </td>
         <td> $timestart </td>
         <td> $timeend </td>
         <td> $patientlimit </td>
         <td> <a href='docschedule.php?SchID=$ID&DID=$DID'> Edit</a> </td>
         </tr>
         ";
      }
   } ?>
</table>
</form>
<script>
   // Get the modal
   var modal = document.getElementById("myModal");

   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");

   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];

   // When the user clicks the button, open the modal 
   btn.onclick = function() {
     modal.style.display = "block";
   }

   // When the user clicks on <span> (x), close the modal
   span.onclick = function() {
     modal.style.display = "none";
   }

   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
     if (event.target == modal) {
       modal.style.display = "none";
     }
   }
   </script>
   </body>