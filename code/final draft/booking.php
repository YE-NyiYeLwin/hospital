<?php 
	$connect=mysqli_connect('localhost','root','','db_draft');
	include ('header.php');
	if (!isset($_SESSION['patientid']))
   {
      echo"<script> alert('Patient Account Required')</script>";
      echo"<script> window.location='patientlogin.php'</script>";
   }
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Booking</title>
</head>
<body>
   <form action="" method="post">  
      Search Doctor
      <input type="text" class="search" name="term" placeholder="Search Name or Department" /> 
      <input type="submit" value="Search" />  
   
   <table width="100%">
   <tr>
      <td>Name</td>
      <td>Degree</td>
      <td>Department</td>
      <td>Price/Session</td>
      <td>Email</td>
      <td>Status</td>
      <td>Book</td>
   </tr>
   <?php
      if (!empty($_REQUEST['term'])) {

         $term = mysqli_real_escape_string($connect,$_REQUEST['term']);     

         $sql = "SELECT d.* FROM dbdoctor AS d,dbdepartment AS t WHERE (d.name LIKE '%".$term."%' OR t.Name LIKE '%".$term."%') AND d.DepartmentID=t.ID AND d.status='active'"; 
         $r_query = mysqli_query($connect,$sql); 

         while ($row = mysqli_fetch_array($r_query)){
         $DID=$row['ID'];
         $name=$row['name'];
         $phnum=$row['phnum']; 
         $degree=$row['degree'];
         $dob=$row['dob'];
         $departmentid=$row['DepartmentID'];
         $price=$row['price'];
         $email=$row['email'];
         $status=$row['status'];

         $dsql="SELECT Name FROM dbdepartment WHERE ID='$departmentid'";
         $run=mysqli_query($connect,$dsql);
         $row=mysqli_fetch_array($run);
         $department=$row[0];

         echo"
            <tr>
               <td>-</td>
               <td>-</td>
               <td>-</td>
               <td>-</td>
               <td>-</td>
               <td>-</td>
               <td>-</td>
            </tr>
            <tr style='outline: thin solid'>
            <td>$name</td>
            <td>$degree</td>
            <td>$department</td>
            <td>$price</td>
            <td>$email</td>
            <td>$status</td>
            <td></td>
            </tr>
         ";
         $sql2="SELECT * FROM dbschedule WHERE DoctorID='$DID'";
         $r_query2 = mysqli_query($connect,$sql2); 
         $count2=mysqli_num_rows($r_query2);
         for ($j=0; $j < $count2; $j++) { 
            $row2 = mysqli_fetch_array($r_query2);
            $SchID=$row2['ID'];
            $day=$row2['day'];
            $timestart=$row2['timestart'];
            $timeend=$row2['timeend'];
            $patientlimit=$row2['patientlimit'];

            echo"
               <tr>
               <td></td>
               <td>ID: $SchID</td>
               <td>$day</td>
               <td>$timestart</td>
               <td>$timeend</td>
               <td>Limit: $patientlimit</td>
               <td><a href='bookingslip.php?SchID=$SchID'> Book</a></td>
               </tr>
            ";
            }
         }
      }
      else
      {
         $sql = "SELECT * FROM dbdoctor WHERE status='active'ORDER BY name";
         $r_query = mysqli_query($connect,$sql); 
         $count=mysqli_num_rows($r_query);
         for ($i=0; $i < $count; $i++) { 
            $row = mysqli_fetch_array($r_query);
            $DID=$row['ID'];
            $name=$row['name'];
            $phnum=$row['phnum']; 
            $degree=$row['degree'];
            $dob=$row['dob'];
            $departmentid=$row['DepartmentID'];
            $price=$row['price'];
            $email=$row['email'];
            $status=$row['status'];

            // $dsql="SELECT Name FROM department WHERE ID='$departmentid'";
            // $run=mysqli_query($connect,$dsql);
          //   $row=mysqli_fetch_array($run);
            // $department=$row[0];

            $department = $connect->query("SELECT Name FROM dbdepartment WHERE ID='$departmentid'")->fetch_object()->Name;

            echo"
            <tr>
               <td>-</td>
               <td>-</td>
               <td>-</td>
               <td>-</td>
               <td>-</td>
               <td>-</td>
               <td>-</td>
            </tr>
            <tr style='outline: thin solid'>
            <td>$name</td>
            <td>$degree</td>
            <td>$department</td>
            <td>$price</td>
            <td>$email</td>
            <td>$status</td>
            <td></td>
            </tr>
            ";
            $sql2="SELECT * FROM dbschedule WHERE DoctorID='$DID'";
            $r_query2 = mysqli_query($connect,$sql2); 
            $count2=mysqli_num_rows($r_query2);
            for ($j=0; $j < $count2; $j++) { 
               $row2 = mysqli_fetch_array($r_query2);
               $SchID=$row2['ID'];
               $day=$row2['day'];
               $timestart=$row2['timestart'];
               $timeend=$row2['timeend'];
               $patientlimit=$row2['patientlimit'];

               echo"
                  <tr>
                  <td></td>
                  <td>ID: $SchID</td>
                  <td>$day</td>
                  <td>$timestart</td>
                  <td>$timeend</td>
                  <td>Limit: $patientlimit</td>
                  <td><a href='bookingslip.php?SchID=$SchID'> Book</a></td>
                  </tr>
               ";
            }
         }
      }
   ?>
   </table>  
   </form>
</body>
<?php include ('footer.php');?>
</html>