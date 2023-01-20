<?php
include("connection.php");
extract($_REQUEST);
session_start();
if(isset($_SESSION['cust_id']))
{
	 $cust_id=$_SESSION['cust_id'];
	 $qq=mysqli_query($con,"select * from tblcustomer where fld_email='$cust_id'");
	 $qqr= mysqli_fetch_array($qq);
}
else
{
	$cust_id="";
}
if(isset($food_id))
{
$fid= $food_id;
}
else
{
	header("location:index.php");
}
if(isset($login))
 {
	 header("location:form/login.php");
 }
 if(isset($logout))
 {
	 session_destroy();
	 header("location:index.php");
 }


$query=mysqli_query($con,"select tbfood.foodname,tbfood.fldvendor_id,tbfood.cost,tbfood.cuisines,tbfood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbfood inner  join tblcart on tbfood.food_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
  $re=mysqli_num_rows($query);
?>
<html>
  <head>
     <title>Home</title>
	 <!--bootstrap files-->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <!--bootstrap files-->
	 
	 <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	 
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
	    <link rel="stylesheet" href="css/style1.css"/>
   	 <link rel="stylesheet" href="css/style2.css"/> 
	<link rel="stylesheet" href="css/style3.css"/> 
	 
<style>
#aboutus{
     background-image:url("img/main_spice2.jpg");
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	  background-position: center;
  
}

ul li {list-style:none;}
ul li a{color:white; font-weight:bold;}
ul li a:hover{text-decoration:none;}
ul form li{float: left; padding: 10px 0px 10px 15px;}

</style>
  </head>
  
    
	<body>
	

<div id="result" style="position:fixed;top:100; right:50;z-index: 3000;width:350px;background:white;"></div>

<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:lightgreen;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand" style="color:white; text-decoratio:none;"><i class="far fa-user"><?php if(isset($cust_id)) { echo " ".$qqr['fld_name']; }?></i></a>
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
            <a class="nav-link" style="color: white;" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: white;" href="search.php">Search</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: white;" href="index.php">Offers</a>
        </li>
    <?php
        if(empty($cust_id))
        {
    ?>  
        <li class="nav-item">
            <a class="nav-link" style="color: white;" href="contact.php">Help</a>
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
            <a class="nav-link" style="color: white;" href="userProfile.php">Profile</a>
        </li>  
        <li class="nav-item">
            <a class="nav-link" style="color: white;" href="userOrders.php">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: white;" href="contact.php">Help</a>
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
<br><br><br><br>
<!--menu ends-->

<div class="container-fluid" >
<br><br>
<div class="row">
   <div class="col-sm-1"></div>
   <div class="col-sm-9" >
   <?php
	  
	$query=mysqli_query($con,"select tblvendor.fld_email,tblvendor.restaurantName,tblvendor.restaurantMobile,tblvendor.restaurantAddress,tblvendor.fldvendor_id,tblvendor.restaurant_Image,tbfood.food_id,tbfood.foodname,tbfood.cost,tbfood.fooddetails,tbfood.cuisines,tblfoodcategory.Foodcategory_name,tbfood.paymentmode,tbfood.fldimage from tblvendor inner join tbfood on tbfood.fldvendor_id=tblvendor.fldvendor_id inner join tblfoodcategory on tbfood.foodcategory=tblfoodcategory.Foodcategory_Id where tbfood.food_id='$fid'");
	  if(mysqli_num_rows($query))
	  {
	  while($res=mysqli_fetch_assoc($query))
	  {
		   $hotel_logo= "image/restaurant/".$res['fld_email']."/".$res['restaurant_Image'];
		   $food_pic= "image/restaurant/".$res['fld_email']."/foodimages/".$res['fldimage'];
	  ?>


<div class="container mt-4">
        <div class="card mt">
            <div class="row">
                <div class="col-md-5">   
                <img class="card-img-top" src="<?php echo$food_pic ?>"  alt="Restaurant Images">
                </div>
                <div class="col-md-7">
                <div class="card-title">
                    <h4 class="card-title text-left" style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#000000;"><?php echo $res['restaurantName']?></h4>  

                    <h5><span style="font-family: 'Miriam Libre', sans-serif; font-size:26px;color:#CB202D;"><?php echo $res['foodname']; ?></span></h5>
                </div>
				<!-- <div class="rating-box">
                      <div class="rating-stars d-inline-block position-relative mr-2">
                        <img src="images/grey-star.svg" alt="">
                        <div class="filled-star" style="width:76%"></div>
                      </div>
                      <a href="#!" class="text-muted"><small>2,144 Reviews</small></a>
                    </div> -->
                <div class="d-flex justify-content-between"> 
                <div style="color: #566573"><h5><?php echo $res['fooddetails']; ?></h5></div>
                <div>
                </div>
                  </div>
                  <div class="food-card_order-count">
                      <div class="input-group mb-3">
                      <h5 class="card-text">₹ <?php echo $res['cost']; ?></h5>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                            if($res['Foodcategory_name']=="Veg"){
                    ?>
                      <h2 style="font-size: 15px;" class="badge badge-success">Veg</h2>
                    <?php
                            }
                            else{
                    ?>
                      <h2 style="font-size: 15px;" class="badge badge-danger">Non-veg</h2>
                    <?php
                            }
                    ?>
                      </div>
                    </div>
                        <a href="form/cart.php?product=<?php echo $res['food_id']; ?>"><button type="submit" name="addtocart"  class="btn btn-success" )>Add to Cart</button></a>
               </div>
            </div>
        </div>
    </div>
	
	<?php
        }
	  }
	  else
	  {
	?>
	<div class="row"><div class="col-sm-12" style="color:red;"><?php echo "sorry No Record Found For This Order";?></div></div>
	<?php
	  }
	?>
	</div>
</div>

   
   <div class="col-sm-3"></div>
</div>
</div>
<br><br>
<div class="container">
    <div class="row">
	    <div class="col-sm-4">
		
		</div>
		<div class="col-sm-4">
		
		</div>
		<div class="col-sm-4">
		
		</div>
	</div>
</div>
<!--footer primary-->
	     <?php
		 include("footer.php");
		 ?>
</body>

</html>