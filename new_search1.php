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
if(Isset($vendor_id))
{
$vid= $vendor_id;
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

$query=mysqli_query($con,"select * from tblvendor where fldvendor_id='$vid'");
$row=mysqli_fetch_array($query);

$query=mysqli_query($con,"select tbfood.foodname,tbfood.fldvendor_id,tbfood.cost,tbfood.cuisines,tbfood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbfood inner join tblcart on tbfood.food_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
$re=mysqli_num_rows($query);

?>
<html>
  <head>
     <title>Food Menu</title>
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
	 <link rel="stylesheet" href="css/style1.css">
   	 <link rel="stylesheet" href="css/style2.css"> 
	<link rel="stylesheet" href="css/style3.css"> 

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Food Order Card UI Design</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="css1/style.css">
	 
<style>
#aboutus{
     background-image:url("img/main_spice2.jpg");
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	  background-position: center;
  
}


/*--CSS For Menu--*/
ul li {list-style:none;}
ul li a{color:black; font-weight:bold;}
ul li a:hover{text-decoration:none;}
ul form li{float: left; padding: 10px 0px 10px 15px;}

</style>
</head>
    
<body>
	

<div id="result" style="position:fixed;top:100; right:50;z-index: 3000;width:350px;background:white;"></div>

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top"> -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

    <a class="navbar-brand" href="index.php"><span style="color:green; font-family:'Impact', cursive;">Food Hunt</span></a>
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand"><i class="far fa-user"><?php if(isset($cust_id)) { echo " ".$qqr['fld_name']; }?></i></a>
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

<!--menu ends-->
<div class="container" >
    <?php
$hotel_logo = "image/restaurant/" . $row['fld_email'] . "/" . $row['restaurant_Image'];    ?>
<!-- <img src="<?php echo$hotel_logo ?>" alt="no Pic Available" height="400px" width="100%"> -->
</div>
<div class="container" >
<br><br>
<div class="row">
   <div class="col-sm-1"></div>
   <!-- <div class="col-sm-10" >
   <h3 style="color:#01C699;text-transform:uppercase;"><?php echo $row['restaurantName']; ?></h3><br><br>
   <span style="color:#A5A5A5;font-size:25px;text-transform:uppercase;"><i class="fas fa-home"></i></span>&nbsp;&nbsp;<span style="font-family: '', serif; font-weight:bold;font-size:25px; color:black;"><?php echo $row['restaurantAddress']?></span><br><br>
   <span style="color:#A5A5A5;font-size:25px;"><i class="fas fa-phone"></i></span>&nbsp;&nbsp;<span style=" font-size:25px; color:black;"><?php echo $row['restaurantMobile']?></span><br><br>
   <span style="color:#A5A5A5;font-size:25px;"><i class="fas fa-at"></i></span>&nbsp;&nbsp;<span style=" font-size:25px; color:black;"><?php echo $row['fld_email']?></span><br><br>
</div> -->

<div class="container mt-4">
        <div class="card mt">
            <div class="row">
                <div class="col-md-4">   
                <img class="card-img-top" src="<?php echo$hotel_logo ?>"  alt="Restaurant Images">
                </div>
                <div class="col-md-5">
                <div class="card-title">
                <h2 style="color:black;text-transform:uppercase;"><?php echo $row['restaurantName']; ?></h2>
                <span style="color:#A5A5A5;font-size:25px;text-transform:uppercase;"><i class="fas fa-home"></i></span>&nbsp;&nbsp;<span style="font-family: '', serif; font-weight:bold;font-size:25px; color:black;"><?php echo $row['restaurantAddress']?></span>
                </div>
                <div class="rating-box">
                      <div class="rating-stars d-inline-block position-relative mr-2">
                        <img src="images/grey-star.svg" alt="">
                        <div class="filled-star" style="width:76%"></div>
                      </div>
                      <a href="#!" class="text-muted"><small>2,144 Reviews</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
</div>
<hr style="border: 1px solid black;">
<!-- card start here -->
    <?php
            // $food_id = $arr[1];
        $AA_query = mysqli_query($con,"select * from tblcuisine where fldvendor_id='$vid'");
        while ($arow = mysqli_fetch_assoc($AA_query)) {
            $cid=$arow['cuisine_id'];
            $cname=$arow['Cuisine_name'];
    ?>
<div class="container">
    <h3><?php echo $cname;?> :</h3>
        <div class="row mt-2">

            <?php
            // $food_id = $arr[1];
    $query = "select tblvendor.fld_email,tblvendor.restaurantName,tblvendor.restaurantMobile,tblvendor.restaurantAddress,tblvendor.fldvendor_id,tblvendor.restaurant_Image,tbfood.food_id,tbfood.foodname,tbfood.cost,tbfood.fooddetails,tbfood.cuisines,tblfoodcategory.Foodcategory_name,tbfood.paymentmode,tbfood.fldimage from tblvendor inner join tbfood on tbfood.fldvendor_id=tblvendor.fldvendor_id inner join tblfoodcategory on tbfood.foodcategory=tblfoodcategory.Foodcategory_Id WHERE tbfood.cuisines='$cid'";

            $query_run = mysqli_query($con, $query);
            $check_vendor = mysqli_num_rows($query_run) > 0;
            if ($check_vendor) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $food_pic = "image/restaurant/" . $row['fld_email'] . "/foodimages/" . $row['fldimage'];
            ?>
                    <!-- <div class="col-md-3"> -->
                
                    <!-- <div class="col-12 col-md-3 col-lg-4">
                        <div class="card shadow" style="width: 20rem; height: 31rem;">
                            <div class="card-body text-left">
                            <div class="inners">
                            <img class="card-img-top image-resize" src="<?php echo$food_pic ?>"  alt="Restaurant Images" height="100vh">
                            </div>
                            <div class="title">
                            <h4 class="card-title text-left">Name:<?php echo $row['restaurantName'];?></h4></div>
                                <!-- <h5 ><a href="searchfood.php?food_id=<?php echo $row['food_id']; ?>"><span style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;"> -->
                                            <!-- <?php echo $row['foodname']; ?></span></a></h5>
                                <hr>
                                <h5 class="card-text">cost:<?php echo $row['cost']; ?></h5>
                                <p class="card-text">
                                    <?php echo $row['cuisines']; ?>
                                </p>
                                <!-- <div class="col-sm-2" style="text-align:left;padding:10px; font-size:25px;"><button type="submit" name="addtocart" value="<?php echo $res['food_id']; ?>"><span style="color:green;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span></button></div> -->
                                <!-- <a href="form/cart.php?product=<?php echo $row['food_id']; ?>"><button type="submit" name="addtocart"  class="btn btn-success" )>Add Cart</button></a>
                                <a href="searchfood.php?food_id=<?php echo $row['food_id']; ?>" class="btn btn-primary">BuyNow</a> -->
                            <!-- </div> -->
                        <!-- </div> -->
                    <!-- </div> --> 
                    
                    <!-- Horizontal card start here -->
    <div class="container mt-4">

        <div class="card mt">
            <div class="row">
                <div class="col-md-4">   
                <img class="card-img-top" src="<?php echo$food_pic ?>"  alt="Restaurant Images">
                </div>
                <div class="col-md-5">
                <div class="card-title">

                <h5 ><a href="searchfood.php?food_id=<?php echo $row['food_id']; ?>"><span style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;">
                    <?php echo $row['foodname']; ?></span></a></h5>

                </div>
                    <div style="color: #566573"><h5><?php echo $row['fooddetails']; ?></h5></div>

                  <div class="food-card_order-count">
                      <div class="input-group mb-0">
                      
                      <h5 class="card-text">₹ <?php echo $row['cost']; ?></h5>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                            if($row['Foodcategory_name']=="Veg"){
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
                        <!-- <div class="input-group-prepend">
                          <button class="btn btn-outline-secondary minus-btn" type="button" id="button-addon1"><i class="fa fa-minus"></i></button>
                        </div> -->
                        <!-- <input type="text" class="form-control input-manulator" placeholder="" aria-label="Example text with button addon"
                          aria-describedby="button-addon1" value="0"> -->
                        <!-- <div class="input-group-append">
                          <button class="btn btn-outline-secondary add-btn" type="button" id="button-addon1"><i class="fa fa-plus"></i></button>
                        </div> -->
                      </div>

                    </div>
                    <div class="rating-box">
                      <div class="rating-stars d-inline-block position-relative mr-2">
                        <img src="images/grey-star.svg" alt="">
                        <div class="filled-star" style="width:76%"></div>
                      </div>
                    <a href="#!" class="text-muted"><small>2,144 Reviews</small></a>
                    </div>
                    <br>
                        <a href="form/cart.php?product=<?php echo $row['food_id']; ?>"><button type="submit" name="addtocart"  class="btn btn-success" )>Add to Cart</button></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="searchfood.php?food_id=<?php echo $row['food_id']; ?>" class="btn btn-primary">Buy Now</a>
                </div>
            </div>
        </div>
    </div>

                
            <?php

                }
            } else {
                echo "no record Found";
            }
            ?>

        </div>
<hr style="border: 1px solid black;">
    </div>

            <?php

                }
            ?>

<!-- card end here -->


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
		 include("footer1.php");
		 ?>

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
</body>

</html>