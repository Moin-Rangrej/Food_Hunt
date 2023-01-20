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
else
{
	$cust_id="";
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
     <title>Search</title>
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
	      <link rel="stylesheet" href="css/style3.css">

 
<style>
ul li {list-style:none;}
ul li a{color:black; font-weight:bold;}
ul li a:hover{color: white; text-decoration:none;}

/*--CSS For Menu--*/
ul form li{float: left; padding: 10px 0px 0px 15px;}
</style>

	<script>
			//search product function
			$(document).ready(function()
			{
				$("#search_text").keypress(function()
				{
			   	load_data();
			   	function load_data(query)
			    {
			      $.ajax({
				    	url:"fetch2.php",
				    	method:"post",
				    	data:{query:query},
				    	success:function(data)
							{
								$('#result').html(data);
							}
						});
					}

			  $('#search_text').keyup(function(){
			     var search = $(this).val();
							if(search != '')
							{
								load_data(search);
							}
							else
							{
								load_data();			
							}
			    });
				});
			});

			//hotel search
			$(document).ready(function()
			{
			  $("#search_restaurant").keypress(function()
			  {
			   	load_data();
			 		function load_data(query)
			    {
			    	$.ajax({
							url:"fetch.php",
							method:"post",
							data:{query:query},
							success:function(data)
			       	{
			       		$('#resulthotel').html(data);
			        }
			    	});
			    }

			    $('#search_restaurant').keyup(function(){
			   		var search = $(this).val();
			      if(search != '')
			     	{
			     		load_data(search);
			      }
			      else
			      {
			       	load_data();			
			      }
			    });	
			  });
			});
	</script>	
</head>
  

<body>

<!--navbar start-->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user"> <?php if(isset($cust_id)) { echo $qqr['fld_name']; }?></i></a>
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
        <li class="nav-item active">
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
<!--navbar ends-->
<br><br>

<div style=" padding:80px 40px 0px 40px;  width:1300px;">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="restaurant-tab" data-toggle="tab" href="#restaurant" role="tab" aria-controls="restaurant" aria-selected="true">Search Restaurant</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="food-tab" data-toggle="tab" href="#food" role="tab" aria-controls="food" aria-selected="false">Search Food</a>
          </li>
		  
       </ul>
  </div>
<br><br>

<div id="result" style="position:absolute; margin: 90px 0px 0px 45px; background:white; z-index: 3000;"></div>

<div id="resulthotel" style="position:absolute; margin: 90px 0px 0px 45px; background:white; z-index: 3000;"></div>

<div class="tab-content" id="myTabContent">

<!-- tab-1 Start -->
	<div class="tab-pane fade show active" id="restaurant" role="tabpanel" aria-labelledby="restaurant-tab" style="padding-left: 35px; padding-right: 40px;">

		  <a href="#" class="nav-link"><form method="post"><input type="text" name="search_restaurant" id="search_restaurant" autocomplete="off" placeholder="Search For Restaurants" class="form-control" /></form></a>

	</div>
<!-- tab-1 end -->


<!-- tab-2 Start -->
	<div class="tab-pane fade" id="food" role="tabpanel" aria-labelledby="food-tab" style="padding-left: 35px; padding-right: 40px;">

			<a href="#" class="nav-link"><form method="post"><input type="text" name="search_text" id="search_text" autocomplete="off" placeholder="Search For Food" class="form-control " /></form></a>

	</div>
<!-- tab-2 end -->

</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
		include("footer.php");
?>

	</body>
</html>