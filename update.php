<?php
session_start();
include("connection.php");
extract($_REQUEST);

if(isset($_SESSION['id']))
{
 $id=$_SESSION['id'];
 $vq=mysqli_query($con,"select * from tblvendor where fld_email='$id'");
 $vr=mysqli_fetch_array($vq);
 $vrid=$vr['fldvendor_id'];
}

if(isset($_SESSION['id']))
{
	if(!empty($_GET['food_id']))
	{
		$food_id=$_GET['food_id'];
		
		$query=mysqli_query($con,"select tblvendor.fldvendor_id,tblvendor.fld_email,tblvendor.restaurantName,tbfood.food_id,tbfood.foodname,tbfood.cost,tbfood.fooddetails,tblfoodcategory.Foodcategory_name,tblcuisine.Cuisine_name,tblstatus.foodstatus,tbfood.paymentmode,tbfood.fldimage from tblvendor inner join tbfood on tblvendor.fldvendor_id=tbfood.fldvendor_id inner join tblfoodcategory on tbfood.foodcategory=tblfoodcategory.Foodcategory_Id inner join tblcuisine on tbfood.cuisines=tblcuisine.cuisine_id inner join tblstatus on tbfood.status=tblstatus.status_id where tbfood.food_id='$food_id'");
		if(mysqli_num_rows($query))
		{   
		 	$row=mysqli_fetch_array($query);
	    $rfoodname=$row['foodname'];
	    $rcost=$row['cost'];
	    $rcuisines=$row['Cuisine_name'];
	    $rcategory=$row['Foodcategory_name'];
	    $rstatus=$row['foodstatus'];
	    $rdetails=$row['fooddetails'];
	    $rpaymentmode=$row['paymentmode'];
	    $rfldimageold=$row['fldimage'];
		 	$em=$_SESSION['id'];	
		}
		else
		{
			header("location:food.php");
		}
	}
	else
	{
		header("location:food.php");
	}
}
else
{
	header("location:vendor_login.php");
}


if(isset($update))
{
	if(!empty($_SESSION['id']))	
	{
		$paymentmode=implode(",",$chk);
		$img_name=$_FILES['food_pic']['name'];

		if(!empty($chk)) 
		{
			if(!empty($stk))
			{
				$paymentmode=implode(",",$chk);
				$foodstatus=implode(",",$stk);

				$ab=mysqli_query($con,"select * from tblfoodcategory where Foodcategory_name='$foodcategory'");
 				$bc=mysqli_fetch_array($ab);
 				$foodcategory_id=$bc['Foodcategory_Id'];

				$cd=mysqli_query($con,"select * from tblcuisine where Cuisine_name='$cuisiness' AND fldvendor_id='$vrid'");
 				$de=mysqli_fetch_array($cd);
 				$cuisine_id=$de['cuisine_id'];

				$ef=mysqli_query($con,"select * from tblstatus where foodstatus='$foodstatus'");
 				$fg=mysqli_fetch_array($ef);
 				$status_id=$fg['status_id'];

				if(empty($img_name))	
				{
					if(mysqli_query($con,"update tbfood SET foodname='$food_name',cost='$cost',fooddetails='$foodDetails',foodcategory='$foodcategory_id',cuisines='$cuisine_id',status='$status_id',paymentmode='$paymentmode' where food_id='$food_id'"))
					{
						header("location:update_food.php?food_id=$food_id");
						//echo "update with old pic";
						//move_uploaded_file($_FILES['food_pic']['tmp_name'],"../image/restaurant/$em/foodimages/".$_FILES['food_pic']['name']);
					}
					else{
						echo "failed";
					}
				}
				else{
					if(mysqli_query($con,"update tbfood SET foodname='$food_name',cost='$cost',fooddetails='$foodDetails',foodcategory='$foodcategory_id',cuisines='$cuisine_id',status='$status_id',paymentmode='$paymentmode',fldimage='$img_name' where food_id='$food_id'"))
					{
						echo "Update with new pic";
						move_uploaded_file($_FILES['food_pic']['tmp_name'],"image/restaurant/$em/foodimages/".$_FILES['food_pic']['name']);
						unlink("image/restaurant/$em/foodimages/$rfldimageold");
						header("location:update_food.php?food_id=$food_id");
					}
					else{
						echo "Failed to upload new pic";
					}					 
				}
			}
			else{
				$stat="Please select food status";
			}
		}
		else{
			$paymessage="Please select a payment mode";
		}
	}
	else{
		header("location:vendor_login.php");
	}
}

if(isset($logout))
{
	session_destroy();
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Restaurant Food</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <style>
    ul li{}
    ul li a {color:black; font-weight:bold; }
    ul li a:hover {color:white;}
	 </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="../index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="search.php">Search</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Offers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Help</a>
        </li>
		<li class="nav-item">
		  <form method="post">
          <?php
			if(empty($_SESSION['id']))
			{
			?>
		   <button class="btn btn-outline-danger my-2 my-sm-0" name="login">Log In</button>&nbsp;&nbsp;&nbsp;
            <?php
			}
			else
			{
			?>
			
			<button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>&nbsp;&nbsp;&nbsp;
			<?php
			}
			?>
			</form>
        </li>
      </ul>
    </div>
	
</nav>

<!--navbar ends-->


<br><br>
<div class="middle" style=" padding:40px; border:1px solid #ED2553;  width:100%;">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="home" aria-selected="true">Update Food</a>
          </li>
         
              <a class="nav-link" style="color:white; font-weight:bold;" id="profile-tab"  aria-selected="false">Food Details</a>
         
		  
       </ul>
	   <br><br>

	<!--tab 1 starts-->   
	   <div class="tab-content" id="myTabContent">
	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="home-tab">
	<!--add Product-->
	  <form action="" method="post" enctype="multipart/form-data">
			
			<div class="form-group"><!--food_name-->
				<label for="food_name">Food Name:</label>
				<input type="text" class="form-control" id="food_name" value="<?php if(isset($rfoodname)) { echo $rfoodname;}?>" placeholder="Enter Food Name" name="food_name" required>
			</div>

			<div class="form-group"><!--cost-->
				<label for="cost">Food Price :</label>
				<input type="number" class="form-control" id="cost"  value="<?php if(isset($rcost)) { echo $rcost;}?>" placeholder="10000" name="cost" required>
			</div>

        <!-- Food Cateogary -->
							<div class="form-group"><!--cuisines-->
                        <label for="category">Select Veg/Non-veg :</label>
                        <select class="form-control" id="category" name="foodcategory" required>
                        	<option></option>	
		  <?php
			  if($query=mysqli_query($con,"SELECT * FROM tblfoodcategory"))
			  {
				  if(mysqli_num_rows($query))
				  {
						while($row=mysqli_fetch_array($query))
						{
			?>		
                    <option><?php echo $row['Foodcategory_name']; ?></option>
<?php 				}
					 }
					 else{
						  $msg="Not find data";
					 }
			 }
			 else{
				 echo "failed";
			 }			 
?>	 
                        </select>
               </div>

			<div class="form-group"><!--cuisines-->
				<label for="cuisines">Select Cuisines :</label>
				<select class="form-control" id="cuisines" name="cuisiness" required>
					<option></option>	
	<?php
	  if($query=mysqli_query($con,"SELECT * FROM tblcuisine where fldvendor_id=$vrid"))
	  {
		  if(mysqli_num_rows($query)){
				while($row=mysqli_fetch_array($query)){
	?>		
					<option><?php echo $row['Cuisine_name']; ?></option>
  <?php 		
				}
			}
			else{
				  $msg="Please add some Items";
			}
	 }
	 else{
		 echo "failed";
	 }		

  ?>	 
					</select>
    </div>
             <div class="form-group"><!--food_name-->
             <label for="food_details">Food Details :</label>
                <input type="text" class="form-control" id="food_details" name="foodDetails" value="<?php if(isset($rdetails)) { echo $rdetails;}?>" required/>
             </div>

		<div class="form-group"><!--payment_mode-->
				<?php
					$pay=explode(",",$rpaymentmode);
				?>
				<input type="checkbox" <?php if(in_array("COD",$pay)) { echo "checked"; } ?> name="chk[]" value="COD"/> Cash On Delivery
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" <?php if(in_array("Online Payment",$pay)) { echo "checked"; } ?> name="chk[]" value="Online Payment"/> Online Payment
				<br>
				<span style="color:red;"><?php if(isset($paymessage)){ echo $paymessage;}?></span>
			</div>

			<div class="form-group"><!--payment_mode-->
				<?php
					$sts=explode(",",$rstatus);
				?>
				<input type="radio" <?php if(in_array("In Stock",$sts)) { echo "checked"; } ?> name="stk[]" value="In Stock"/> In Stock
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" <?php if(in_array("Out of Stock",$sts)) { echo "checked"; } ?> name="stk[]" value="Out of Stock"/> Out of Stock
				<br>
				<span style="color:red;"><?php if(isset($stat)){ echo $stat;}?></span>
			</div>

			<div class="form-group">
				<label for="snaps">Food Snaps :</label><br>
				<input type="file" accept="image/*" name="food_pic"/> 
			</div>

			<button type="submit" name="update" class="btn btn-primary">Update Food</button>
			<br>
			
	          </form>      	 
	  </div>
<!--tab 1 ends-->	   
			
			
			
			 
      
	  </div>
	</div>  
	
</body>
</html>