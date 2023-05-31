<?php
	include('header.php');
	$connect=mysqli_connect('localhost','root','','db_draft');
	if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Authorized Personnel Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
   if (isset($_GET['PID']))
   {
   	$PID=$_GET['PID'];
   	$select="SELECT * FROM dbproduct WHERE ID='$PID'";
   	$run=mysqli_query($connect,$select);
   	$row = mysqli_fetch_array($run);
   	$name=$row['name'];
      $rprice=$row['retailprice'];
      $sprice=$row['supplierprice'];
      $sname=$row['suppliername'];
      $quantity=$row['quantity'];
      $descrip=$row['description'];
      if (isset($_POST['btnedit']))
       {
         $name=$_POST['txtname'];
         $rprice=$_POST['txtrprice'];
         $sprice=$_POST['txtsprice'];
         $sname=$_POST['txtsname'];
         $quantity=$_POST['txtquan'];
         $descrip=$_POST['txtdescrip'];
      
         $update="UPDATE dbproduct 
         SET name='$name',
         retailprice='$rprice',
         supplierprice='$sprice',
         suppliername='$sname',
         quantity='$quantity',
         description='$descrip'
         WHERE ID='$PID'";
         $run=mysqli_query($connect,$update);
         if ($run)
         {
            echo "<script>window.alert('Updated Successfully')</script>";
            echo"<script> window.location='productdisplay.php'
            </script>";
         }
         else
         {
            echo mysqli_error($connect);
         }
       }
   }
 ?>
<div id="booknow" class="contact">
         <div class="container-fluid">
            <div class="row">
               <div class="">
                  <div class="contact">
                     <div class="titlepage">
                        <h2>Medicine <br><strong class="white "> Edit</strong></h2>
                     </div>
<form class="book_now" action="#" method="post">
    <div class="row">
    	<div class="col-sm-12">
          <input class="contactus" value="<?php echo $PID ?>" type="text" name="txtid" readonly>
       </div>
       <div class="col-sm-12">
       		Name
          <input class="contactus" value="<?php echo $name ?>" type="text" name="txtname" required>
       </div>
       <div class="col-sm-12">
         Retail Price /tablet
          <input class="contactus" value="<?php echo $rprice ?>" type="text" name="txtrprice" required>
       </div>
       <div class="col-sm-12">
         Supplier Price /tablet
          <input class="contactus" value="<?php echo $sprice ?>" type="text" name="txtsprice" required>
       </div>
       <div class="col-sm-12">
         <select name="txtsname" required>
            <option value="<?php echo $sname ?>" disabled hidden selected=""><?php echo $sname ?></option>
            <?php 
            $select="Select * from dbsupplier";
            $run=mysqli_query($connect,$select);
            $count=mysqli_num_rows($run);
            for ($i=0; $i < $count; $i++) 
            { 
               $row=mysqli_fetch_array($run);
               $DID=$row[0];
               $Dname=$row[1];
               echo "
                  <option value=$DID>$Dname</option>
               ";
            }
             ?>
         </select>
      </div>
       <div class="col-sm-12">
         Quantity /tablet
          <input class="contactus" value="<?php echo $quantity ?>" type="number" name="txtquan" required>
       </div>
       <div class="col-sm-12">
         Description
          <textarea class="textarea" type="text" name="txtdescrip"><?php echo $descrip ?></textarea>
       </div>
       <div class="col-sm-12">
          <button class="send" type="submit" name="btnedit">Edit</button>
       </div>
    </div>
 </form>
</div>
               </div>
            </div>
         </div>
      </div>
<?php include ('footer.php');?>