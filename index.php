<?php
session_start();
include("connection.php");
extract($_REQUEST);
$arr=array();

if(isset($_GET['msg']))
{
	$loginmsg=$_GET['msg'];
}
else
{
	$loginmsg="";
}

if(isset($_SESSION['cust_id']))
{
	 $cust_id=$_SESSION['cust_id'];
	 $cquery=mysqli_query($con,"select * from tblcustomer where fld_email='$cust_id'");
	 $cresult=mysqli_fetch_array($cquery);
}
else
{
	$cust_id="";
}
 
$query=mysqli_query($con,"select  tblvendor.restaurantName,tblvendor.fldvendor_id,tblvendor.fld_email,
tblvendor.restaurantMobile,tblvendor.restaurantAddress,tblvendor.restaurant_Image,tbfood.food_id,tbfood.foodname,tbfood.cost,tbfood.cuisines,tbfood.paymentmode from tblvendor inner join tbfood on tblvendor.fldvendor_id=tbfood.fldvendor_id;");

while($row=mysqli_fetch_array($query))
{
	$arr[]=$row['food_id'];
	shuffle($arr);
}

//print_r($arr);

 if(isset($addtocart))
 {
	 
	if(!empty($_SESSION['cust_id']))
	{
		 
		header("location:form/cart.php?product=$addtocart");
	}
	else
	{
		header("location:form/cart.php?product=$addtocart");
	}
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
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
     <link rel="stylesheet" href="css/style1.css">
   	 <link rel="stylesheet" href="css/style2.css"> 
	<link rel="stylesheet" href="css/style3.css"/> 
	 
<style>
//body{
     background-image:url("img/about.bmp");
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

<!-- <nav class="sidenav" data-mdb-right="true"> -->

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:red;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>
    <!-- <span style="color:green;font-family: 'Permanent Marker', cursive;">Food Hunt</span> -->
	  <?php
			if(!empty($cust_id))
			{
		?>
		<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user"><?php echo " ",$cresult['fld_name']; ?></i></a>
		<?php
			}
		?>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
<div class="collapse navbar-collapse" id="navbarResponsive">    
<ul class="navbar-nav ml-auto">
    <form method="post">
        <li class="nav-item active">
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
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/11.jpg" alt="Los Angeles" class="d-block w-100" width="200" height="500">
      <div class="carousel-caption">
       
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/12.jpg" alt="Chicago" class="d-block w-100" width="200" height="500">
      <div class="carousel-caption">
        
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/13.jpg" alt="New York" class="d-block w-100" width="200" height="500">
      <div class="carousel-caption">
        
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>




<!--slider ends-->

&nbsp;&nbsp;&nbsp;
    <div class="container">
    <div class="row mt-4">
        <?php
            // $sql = "count(fldvendor_id) as Total_Restaurant from tblvendor";
            $sql = "select fldvendor_id from tblvendor order by fldvendor_id";
            $sql_run = mysqli_query($con,$sql);
            $total = mysqli_num_rows($sql_run);
            echo '<h1>'.$total.'&nbsp;&nbsp;Restaurants</h1>'; 
        ?>
    </div>
    </div>       

    <!-- card start here -->

    <div class="container">
        <div class="row mt-4">
            <?php
            $query = "select * from tblvendor";
            $query_run = mysqli_query($con, $query);
            $check_vendor = mysqli_num_rows($query_run) > 0;
            if ($check_vendor) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $hotel_logo = "image/restaurant/" . $row['fld_email'] . "/" . $row['restaurant_Image'];
            ?>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                            <div class="inners">
                            <img class="card-img-top image-resize" src="<?php echo $hotel_logo; ?>"  alt="Restaurant Images">
                            </div>
                                <!-- <h5><a href="new_search1.php?vendor_id=<?php echo $row['fldvendor_id']; ?>"><span style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;">
                                            </span></a></h5> -->
                                <a href="new_search1.php?vendor_id=<?php echo $row['fldvendor_id']; ?>"><span style="font-family: 'Miriam Libre', sans-serif; font-size:20px;color:#CB202D;"><?php echo $row['restaurantName']; ?></span></a>           
                                <hr>
                                <h5 class="card-title">Mo.: <?php echo $row['restaurantMobile']; ?></h5>
                                <p class="card-text">
                                    <?php echo $row['restaurantAddress']; ?>
                                </p>
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
    </div>

    <!-- card end here -->

<!--footer primary-->
	     
    <?php
		include("footer1.php");
	?>
			 			 

	</body>
</html>