<?php 
   $connect=mysqli_connect('localhost','root','','db_draft');
   include ('header.php');
   if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Authorized Personnel Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }
   if (isset($_POST['btnreg']))
   {
      $name=$_POST['txtname'];
      $rprice=$_POST['txtrprice'];
      $sprice=$_POST['txtsprice'];
      $sname=$_POST['txtsname'];
      $quantity=$_POST['txtquan'];
      $descrip=$_POST['txtdescrip'];

      $select="Select * from dbproduct where name='$name'";
      $run=mysqli_query($connect, $select);
      $count=mysqli_num_rows($run);
      if($count>0)
      {
         echo"<script> alert('Product Already Exist')</script>";
      }
      else
      {
         $insert="INSERT into dbproduct(name,retailprice,supplierprice,suppliername,quantity,description) values('$name','$rprice','$sprice','$sname','$quantity','$descrip')";
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
<h2>Medicine <br><strong class="white "> Register</strong></h2>
<form class="book_now" action="#" method="post">
      <div class="col-sm-12">
         <input class="contactus" placeholder="Name" type="text" name="txtname" required>
      </div>
      <div class="col-sm-12">
         <input class="contactus" placeholder="Retail Price /tablet" type="text" name="txtrprice" required>
      </div>
      <div class="col-sm-12">
         <input class="contactus" placeholder="Supplier Price /tablet" type="text" name="txtsprice" required>
      </div>
      <div class="col-sm-12">
         <select name="txtsname" required>
            <option value="" disabled hidden selected="">Supplier</option>
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
         <input class="contactus" placeholder="Quantity /tablet" type="number" name="txtquan" required>
      </div>
      <div class="col-sm-12">
         <textarea class="textarea" placeholder="Description" type="text" name="txtdescrip"></textarea>
      </div>
      <div class="col-sm-12">
         <button class="send" type="submit" name="btnreg">Register</button>
      </div>
</form>
<?php include ('footer.php');?>