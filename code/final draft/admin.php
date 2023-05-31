<?php 
include ('header.php');
$connect=mysqli_connect('localhost','root','','db_draft');
	if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Authorized Personnel Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
 ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
   <form style="text-align: center;" method="post"><strong class="menu">
      <br>
   <a href='productreg.php'><i class="fa fa-plus"></i>&nbspProduct Add</a>
   <a href='productdisplay.php'><i class="fa fa-folder-open"></i>&nbspProduct Display</a>
   <br><br>
   <a href="productsale.php"><i class="fa fa-usd"></i>&nbspMake Sale</a> 
   <a href="supply.php"><i class="fa fa-plus"></i>&nbspAdd Stock</a>
   <br><br>
   <a href='staffreg.php'><i class="fa fa-id-badge"></i>&nbspStaff Register</a>
   <a href='staffdisplay.php'><i class="fa fa-folder-open"></i>&nbspStaff Display</a>
   <br><br>
   <a href='supplierreg.php'><i class="fa fa-plus"></i>&nbspSupplier Record</a>
   <a href='supplierdisplay.php'><i class="fa fa-folder-open"></i>&nbspSupplier Display</a>
   <br><br>
   <a href='salereport.php'><i class="fa fa-bar-chart"></i>&nbspSale Report</a>
   <a href='supplyreport.php'><i class="fa fa-bar-chart"></i>&nbspSupply Report</a>
   <br><br>
   <a href='docreg.php'><i class="fa fa-id-badge"></i>&nbspDoctor Register</a> 
   <a href='docdisplay.php'><i class="fa fa-folder-open"></i>&nbspDoctor Display</a>
   <br><br>
   <a id="myBtn"><i class="fa fa-id-badge"></i>&nbspDepartment Register</a>
   <a href='db.php'><i class="fa fa-bar-chart"></i>&nbspGraph Report</a>
   <br><br>
   <a href='patientreg.php'><i class="fa fa-id-badge"></i>&nbspPatient Register</a> 
   <a href='patientdisplay.php'><i class="fa fa-folder-open"></i>&nbspPatient Display</a>
   <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Department<strong class="white "> Register</strong></h2>
      <div class="row">
         <div class="col-sm-12">
            <input class="contactus" placeholder="Department Name" type="text" name="txtdepname" required>
         </div>
            <br>
         <button type="submit" name="btndepreg">Register</button>
      </div>
      <?php 
      if (isset($_POST['btndepreg']))
      {
         $name=$_POST['txtdepname'];
         $select="Select * from dbdepartment where Name='$name'";
         $run=mysqli_query($connect, $select);
         $count=mysqli_num_rows($run);
         if($count>0)
         {
            echo"<script> alert('Department Already Exist')</script>";
         }
         else
         {
            $insert="INSERT into dbdepartment(Name) values('$name')";
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
      } ?>
  </div>

</div>

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
</strong></form>
<?php 
include ('footer.php');
 ?>
</body>
</html>