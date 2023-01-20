<?php
session_start();
include("connection.php");
extract($_REQUEST);

if(isset($_SESSION['cust_id']))
{
	$cust_id=$_SESSION['cust_id'];
	$qq=mysqli_query($con,"select * from tblcustomer where fld_email='$cust_id'");
	$qqr= mysqli_fetch_array($qq);
}

if(empty($cust_id))
{
	header("location:login.php?msg=You must login first");
}
 
if(isset($logout))
{
 session_destroy();
 header("location:index.php");
}

if(isset($login))
{
 session_destroy(); 
 header("location:index.php");
}
 
 //update section
  $cust_details=mysqli_query($con,"select * from tblcustomer where fld_email='$cust_id'");
  $det_res=mysqli_fetch_array($cust_details);
  $fld_name=$det_res['fld_name'];
  $fld_mobile=$det_res['fld_mobile'];
  $fld_address=$det_res['fld_address'];
  $fld_email=$det_res['fld_email'];
  $fld_password=$det_res['password'];
  if(isset($update))
  {
	   
	 if(mysqli_query($con,"update tblcustomer set fld_name='$name',fld_mobile='$mobile',fld_address='$address',password='$pswd' where fld_email='$fld_email'"))
      {
	   header("location:form/customerupdate.php");
	  }
  }
  
$query=mysqli_query($con,"select tbfood.foodname,tbfood.fldvendor_id,tbfood.cost,tbfood.cuisines,tbfood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbfood inner  join tblcart on tbfood.food_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
$re=mysqli_num_rows($query);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>
  ul li {list-style:none;}
  ul li a{color:black; font-weight:bold;}
  ul li a:hover{color:white; text-decoration:none;}

/*--CSS For Menu--*/
ul form li{float: left; padding: 10px 0px 10px 15px;}

</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="../index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user"><?php if(isset($cust_id)) { echo " ".$qqr['fld_name']; }?></i></a>
	<?php
	}
	?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
<div class="collapse navbar-collapse" id="navbarResponsive">    
<ul class="navbar-nav ml-auto">
    <form method="post">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="search.php">Search</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Offers</a>
        </li>
    <?php
        if(empty($cust_id))
        {
    ?>  
        <li class="nav-item">
            <a class="nav-link" href="contact.php">Help</a>
        </li>  
        <li class="nav-item">
            <a href="form/login.php?msg=You must be login first"><span style="color:red; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:red;" id="cart" class="badge badge-light">0</span></i></span></a>
        </li>  
        <li class="nav-item">
            <button class="btn btn-outline-danger my-2 my-sm-0" name="login" type="submit">Log In</button>&nbsp;&nbsp;&nbsp;
        </li>
    <?php
        }
        else
        {
    ?>
        <li class="nav-item active">
            <a class="nav-link" href="userProfile.php">Profile</a>
        </li>  
        <li class="nav-item">
            <a class="nav-link" href="userOrders.php">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contact.php">Help</a>
        </li>  
        <li class="nav-item">
            <a href="form/cart.php"><span style=" color:green; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:green;" id="cart"  class="badge badge-light"><?php if(isset($re)) { echo $re; }?></span></i></span></a>
        </li>  
        <li class="nav-item">
            <button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>&nbsp;&nbsp;&nbsp;
        </li>
    <?php
        }
    ?>
    </form>
</ul>
      
</div>
	
</nav>

<!--navbar ends-->


<br><br>
<div class="middle" style="  padding:60px; border:1px solid #ED2553;  width:100%;">
   <!--tab heading-->
   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
      <li class="nav-item">
          <a class="nav-link active" id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="true">Account Settings</a>
      </li>
   </ul>
   <br><br>   
			
			
<!--tab 1 starts-->
    <div class="tab-pane fade show active" id="manageaccount" role="tabpanel" aria-labelledby="home-tab">
	    <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" value="<?php if(isset($fld_name)){ echo $fld_name;}?>" class="form-control" required/>
            </div>
			<div class="form-group">
              <label for="mobile">Mobile:</label>
              <input type="tel" id="mobile" class="form-control" name="mobile" pattern="[6-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" value="<?php if(isset($fld_mobile)){ echo $fld_mobile;}?>" required/>
            </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <input type="text" id="address" name="address" value="<?php if(isset($fld_address)){ echo $fld_address;}?>" class="form-control" required/>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" value="<?php if(isset($fld_email)){ echo $fld_email;}?>" class="form-control" readonly/>
            </div>
           <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" name="pswd" value="<?php if(isset($fld_password)) { echo $fld_password; }?>"class="form-control"  id="pwd" required/>
           </div>
		   

          <button type="submit" name="update" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
          <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
	 </form>
	</div>
<!--tab 1 ends-->

</div>	  
<br><br><br><br><br><br>

<!--footer primary-->     
  <?php
		include("footer.php");
	?>
		
</body>
</html>