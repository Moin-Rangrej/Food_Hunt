<?php
session_start();
include("../connection.php");
extract($_REQUEST);
$gtotal=array();
$ar=array();
$total=0;

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
		header("location:cart.php");
	}
	else
	{
		echo "failed";
	}
}

if(isset($del))
{
	
	//echo $del;
	if(mysqli_query($con,"delete from tblcart where fld_cart_id='$del' && fld_customer_id='$cust_id'"))
	{
		header("location:deletecart.php");
	}	
}
 
if(isset($logout))
{
 session_destroy();
 header("location:../index.php");
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
	<title>Cart </title>
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
		  window.location.href='cancelorder.php?id=' +id;
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
            <a class="nav-link" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../search.php">Search</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../index.php">Offers</a>
        </li>
    <?php
        if(empty($cust_id))
        {
    ?>  
        <li class="nav-item">
            <a class="nav-link" href="../contact.php">Help</a>
        </li>  
        <li class="nav-item">
            <a href="login.php?msg=you must be login first"><span style="color:red; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:red;" id="cart" class="badge badge-light">0</span></i></span></a>
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
            <a class="nav-link" href="../userProfile.php">Profile</a>
        </li>  
        <li class="nav-item">
            <a class="nav-link" href="../userOrders.php">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../contact.php">Help</a>
        </li>  
        <li class="nav-item active">
            <a href="cart.php"><span style=" color:green; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:green;" id="cart"  class="badge badge-light"><?php if(isset($re)) { echo $re; }?></span></i></span></a>
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
             <a class="nav-link active" id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem" aria-selected="true">View Cart</a>
          </li>
		  
       </ul>
<br><br>

<!-- <div class = "dashboard-order">
	<h3>List of Orders</h3>
	<div class="order-address">
		<p>Address Delivery</p>
		<h6>vijay char rasta,</h6>
		<h6>near soda vala,</h6>
		<h6>Ahmedabad</h6>
	</div>
	<div class="order-time">
		<span class="fas fa-clock"></span> 30 min &nbsp;&nbsp;&nbsp;    <span class="fas fa-map-marker-alt"></span> 2 km
	</div> -->

<!--tab 1 starts-->   
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="home-tab">
	     <table class="table">
	      <tbody>
	       <?php
	          $query=mysqli_query($con,"select tbfood.foodname,tbfood.fldvendor_id,tbfood.cost,tbfood.cuisines,tbfood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbfood inner  join tblcart on tbfood.food_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
	          $re=mysqli_num_rows($query);
	           if($re)
	            {
	             while($res=mysqli_fetch_array($query))
	              {
	                $vendor_id=$res['fldvendor_id'];
	               $v_query=mysqli_query($con,"select * from tblvendor where fldvendor_id='$vendor_id'");
	               $v_row=mysqli_fetch_array($v_query);
	               $em=$v_row['fld_email'];
	               $nm=$v_row['restaurantName'];
	        ?>
	          <tr>
	             <td><image src="../image/restaurant/<?php echo $em."/foodimages/".$res['fldimage'];?>" height="80px" width="100px"></td>
	             <td><?php echo $res['foodname'];?></td>
	             <td><?php echo "RS ".$res['cost'];?></td>
	             <td><?php echo $res['cuisines'];?></td>
	             <td><?php echo $nm; ?></td>
	            <form method="post" enctype="multipart/form-data">
	               <td><button type="submit" name="del"  value="<?php echo $res['fld_cart_id']?>" class="btn btn-danger">Delete</button></td>
	            </form>
	            <td><?php $total=$total+$res['cost']; $gtotal[]=$total;  ?></td>
	          </tr>
			  
			  
	       <?php
	            }
				?>
				<tr>
			  <td>
			  <h5 style="color:red;">Grand total</h5>
			  </td>
			  <td>
			  <h5><i class="fas fa-rupee-sign"></i>&nbsp;<?php echo end($gtotal); ?></h5>
			  </td>
			  <td>
			  
			  </td>
			  <td></td>
			  
			  <td style="padding:30px; text-align:center;">
			  <a href="order.php?cust_id=<?php echo $cust_id; ?>"><button type="button" style=" color:white; font-weight:bold; text-transform:uppercase;" class="btn btn-warning">Proceed to checkout</button></a>
			  </td>
			  <td></td>
			  </tr>

			  
				
				<?php

	          }
			  else
			  {
				  

	         ?>
			 <tr><button type="button" class="btn btn-outline-success"><a href="../index.php" style="color:green; text-decoration:none;">No Items In cart Let's Shop Now</a></button></tr>
			 
			 <?php
			  }
			 ?>
	     </tbody>
	</table>	

	<span style="color:green; text-align:centre;"><?php if(isset($success)) { echo $success; }?></span>
	<br><br><br><br><br><br><br>
	</div>	 

<!--tab 1 ends-->	   
			
	</div>
</div>  
<br><br><br><br><br><br>

<!--footer primary-->     
  <?php
		include("footer.php");
	?>
		
</body>
</html>

