<?php
session_start();
include("connection.php");
extract($_REQUEST);

if(isset($_GET['product']))//product id
{
	$product_id=$_GET['product'];
}
else
{
	$product_id="";
}

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

if(!empty($product_id && $cust_id ))
{
	if(mysqli_query($con,"insert into tblcart (fld_product_id,fld_customer_id) values ('$product_id','$cust_id') "))
	{
		echo "success";
		$product_id="";
		header("location:form/cart.php");
	}
	else
	{
		echo "failed";
	}
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
  
$query=mysqli_query($con,"select tbfood.foodname,tbfood.fldvendor_id,tbfood.cost,tbfood.cuisines,tbfood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbfood inner  join tblcart on tbfood.food_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
$re=mysqli_num_rows($query);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Orders</title>
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
	 	<script>
		  function del(id)
		  {
			  if(confirm('are you sure you want to cancel order')== true)
			  {
				  window.location.href='form/cancelorder.php?id=' +id;
			  }
		  }
		</script>

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
        <li class="nav-item">
            <a class="nav-link" href="userProfile.php">Profile</a>
        </li>  
        <li class="nav-item active">
            <a class="nav-link" href="userOrders.php">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contact.php">Help</a>
        </li>  
        <li class="nav-item active">
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
              <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Orders</a>
          </li>
		  
       </ul>
	   <br><br>

<!--tab 1 starts-->
<div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="home-tab">
    <table class="table">
			<th>Order Number</th>
			<th>Item Name</th>
			<th>Price</th>
			<th>Cancel order</th>
	    <tbody>
		<?php
		$quer_res=mysqli_query($con,"select * from tblorder where fld_email_id='$cust_id' && fldstatus='In Process'");
		while($roww=mysqli_fetch_array($quer_res))
		{   
	         $fid=$roww['fld_food_id'];
	         $qr=mysqli_query($con,"select * from tbfood where food_id='$fid'");
			 $qrr=mysqli_fetch_array($qr);
			
		  
		?>
		   <tr>
		   <td><?php echo $roww['fld_order_id']; ?></td>
		   <?php
		   if(empty($qrr['foodname']))
		   {
		   ?>
		   <td><span style="color:red;">Product Not Available Now</span></td>
		   <?php
		   }
		   else
		   {
			   ?>
			    <td><?php echo $qrr['foodname']; ?></td>
			   <?php
		   }
		   ?>
		  
		   <td><?php echo $qrr['cost']; ?></td>
		   <td><a href="#" onclick="del(<?php echo $roww['fld_order_id'];?>);"><button type="button" class="btn btn-danger">Cancel Order</button></a></td>
		   </tr>
		 <?php
		}
		 ?>  
		</tbody>
	</table>
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