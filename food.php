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

if(!isset($_SESSION['id']))
{
	header("location:vendor_login.php?msg=Please Login To continue");
}
else
{
	$query=mysqli_query($con,"select * from tblvendor where fld_email='$id'");
	if(mysqli_num_rows($query))
	{   
		if(!file_exists("image/restaurant/".$id."/foodimages"))
		{
			$dir=mkdir("image/restaurant/".$id."/foodimages");
		}
		$row=mysqli_fetch_array($query);
	  $v_id=$row['fldvendor_id'];
	}
	else
	{
		header("location:index.php");	
	}
}


if(isset($add))
{   
	if(isset($_SESSION['id']))
	{
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

				$cd=mysqli_query($con,"select * from tblcuisine where Cuisine_name='$cuisines' AND fldvendor_id='$v_id'");
 				$de=mysqli_fetch_array($cd);
 				$cuisine_id=$de['cuisine_id'];

				$ef=mysqli_query($con,"select * from tblstatus where foodstatus='$foodstatus'");
 				$fg=mysqli_fetch_array($ef);
 				$status_id=$fg['status_id'];

				if(mysqli_query($con,"insert into tbfood(foodname,cost,fooddetails,fldvendor_id,foodcategory,cuisines,status,paymentmode,fldimage) values('$food_name','$cost','$foodDetails','$v_id','$foodcategory_id','$cuisine_id','$status_id','$paymentmode','$img_name')"))
				{
					move_uploaded_file($_FILES['food_pic']['tmp_name'],"image/restaurant/$id/foodimages/".$_FILES['food_pic']['name']);
				}
				else{
					echo "failed";
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
	header("location:vendor_login.php");
}


if(isset($upd_account))
{
	
	//echo $fn;
	//echo $emm;
	//echo $add;
	if(mysqlI_query($con,"update tblvendor set restaurantName='$fn',fld_email='$emm',restaurantAddress='$add',restaurantMobile='$mob',fld_password='$pwsd' where fld_email='$id'"))
  	{
		 header("location:infoUpdate.php");
	}
}


if(isset($upd_logo))
{
	if(isset($_SESSION['id']))
	{
		$log_img=mysqli_query($con,"select * from tblvendor where fld_email='$id'");
		$log_img_row=mysqli_fetch_array($log_img);
		$old_logo=$log_img_row['restaurant_Image'];
		$new_img_name=$_FILES['logo_pic']['name'];

		if(mysqli_query($con,"update tblvendor set restaurant_Image='$new_img_name' where fld_email='$id'"))
		{
			unlink("image/restaurant/$id/$old_logo");
			move_uploaded_file($_FILES['logo_pic']['tmp_name'],"image/restaurant/$id/".$_FILES['logo_pic']['name']);
			header("location:update_food.php");
		}
	}
	else
	{
		header("location:vendor_login.php?msg=Please Login To continue");
	}
}

if(isset($_POST['updCuisine']))
{
	echo "<script>alert('update working');</script>";
	$cid = $_POST['cid'];
	$cname = $_POST['cname'];
	$cquery = "update tblcuisine SET Cuisine_name='$cname' where cuisine_id=$cid";
	if(mysqli_query($con,$cquery))
	{
		echo "<script>alert('You have successfully updated cuisine name');</script>";    
	}
	else
	{
		echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}
}		  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Restaurant Vendor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="css/font.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	 <link rel="stylesheet" href="css/style1.css">
   	 <link rel="stylesheet" href="css/style2.css"> 
	<link rel="stylesheet" href="css/style3.css">

 	<style>
	ul li {list-style:none;}
	ul li a{color:black; font-weight:bold;}
	ul li a:hover{color:white; text-decoration:none;}
	</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>
    <?php
	if(!empty($id))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoration:none;"><i class="far fa-user"><?php if(isset($id)) { echo " ".$vr['restaurantName']; }?></i></a>
	<?php
	}
	?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
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
<div style=" padding:40px; padding-bottom: 0px;  width:1300px;">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="home" aria-selected="true">Manage Food Menu</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="profile" aria-selected="false">Add Food</a>
          </li>
				  <li class="nav-item">
              <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Order Status</a>
          </li>
				  <li class="nav-item">
              <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logo" role="tab" aria-controls="logo" aria-selected="false">Update Logo</a>
          </li>
			<li class="nav-item">
              <a class="nav-link" id="accountsettings-tab" data-toggle="tab" href="#accountsettings" role="tab" aria-controls="accountsettings" aria-selected="false">Account Settings</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" id="foodcuisines-tab" data-toggle="tab" href="#foodcuisines" role="tab" aria-controls="foodcuisines" aria-selected="false">Manage Cuisines</a>
          </li>
		  
       </ul>
  </div>
	   <br><br>
 
	   <div class="tab-content" id="myTabContent">
	<!--tab 1 starts-->  	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="home-tab" style="padding-left: 35px; padding-right: 40px;">
        	<div class="container" style="margin:0px;"> 

			 <table border="1" bordercolor="#F0F0F0" width="1220px" cellpadding="20px" >
			 	<thead align="center" height="40px">
			 <th>Food Image</th>
			 <th>Food Name</th>
			 <th>Food Price</th>
			 <th>Food Cuisines</th>
			 <th>Food Category</th>
			 <th>Food Status</th>
			 <th>Food Details</th>
			 <th>Payment Mode</th>
			 <th colspan="2">Action</th>
			</thead>

			   	<?php
					  if($query=mysqli_query($con,"select tblvendor.fldvendor_id,tblvendor.fld_email,tblvendor.restaurantName,tbfood.food_id,tbfood.foodname,tbfood.cost,tbfood.fooddetails,tblfoodcategory.Foodcategory_name,tblcuisine.Cuisine_name,tblstatus.foodstatus,tbfood.paymentmode,tbfood.fldimage from tblvendor inner join tbfood on tblvendor.fldvendor_id=tbfood.fldvendor_id inner join tblfoodcategory on tbfood.foodcategory=tblfoodcategory.Foodcategory_Id inner join tblcuisine on tbfood.cuisines=tblcuisine.cuisine_id inner join tblstatus on tbfood.status=tblstatus.status_id where tblvendor.fld_email='$id'"))
					  {
						  if(mysqli_num_rows($query))
						  {
						 while($row=mysqli_fetch_array($query))
						 {
							 
					?>
					<tbody>
			     <tr>
				<td height="110px"><img src="<?php echo 'image/restaurant/'.$id.'/foodimages/'.$row['fldimage'];?>" height="100px" width="150px"></td>
				<td style="width:250px; padding-left: 15px;"><?php  echo " ".$row['foodname'];?></td>
				<td align="center" style="width:150px;">₹ <?php  echo $row['cost'];?></td>
				<td align="center" style="width:150px;"><?php  echo $row['Cuisine_name'];?></td>
				<td align="center" style="width:150px;"><?php  echo $row['Foodcategory_name'];?></td>
				<td align="center" style="width:200px;"><?php  echo $row['foodstatus'];?></td>
				<td style="width:400px;"><?php  echo $row['fooddetails'];?></td>

				<td align="center" style="width:150px;"><?php  echo $row['paymentmode'];?></td>

				<td align="center" style="width:150px;">
				<a href="update.php?food_id=<?php echo $row['food_id'];?>"><button type="button" class="btn btn-warning">Update </button></a></td>
				
				<td align="center" style="width:150px;">
				<a href="vendor_delete_food.php?food_id=<?php echo $row['food_id'];?>"><button type="button" class="btn btn-danger">Delete </button></a></td>
				
				</tr>
			
				<?php 
					
                    $foodname="";
                    $cuisines="";
                    $cost="";					
						 }
					  }
					  else 
						  
						  {
							   $msg="please add some Items";
						  }
					  }
					  else 
					  {
						  echo "failed";
					  }
					  
					  ?>
					</tbody>
			 </table>
			 </div>    	 
	        </div>
<!--tab 1 ends-->	   
			
			
<!--tab 2 starts-->
      <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="profile-tab" style="padding-left: 40px; padding-right: 40px;">
         <!--add Product-->
                  <form action="" method="post" enctype="multipart/form-data">
                               <div class="form-group"><!--food_name-->
                               <label for="food_name">Enter Food Name:</label>
                                      <input type="text" class="form-control" id="food_name" value="<?php if(isset($food_name)) { echo $food_name;}?>" name="food_name" required>
                               </div>
						 
						 
                               <div class="form-group"><!--cost-->
                                      <label for="cost">Enter Food Price :</label>
                                      <input type="number" class="form-control" id="cost"  value="<?php if(isset($cost)) { echo $cost;}?>" name="cost" required>
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
					 else 				 
					 {
						  $msg="Not find data";
					 }
			 }
			 else 
			 {
				 echo "failed";
			 }			 
?>	 
                        </select>
               </div>

					  			<!-- food Cuisine -->
							<div class="form-group">
                        <label for="cuisines">Select Cuisines :</label>
                        <select class="form-control" id="cuisines" name="cuisines" required>
                        	<option></option>	

		  <?php
			  if($query=mysqli_query($con,"SELECT * FROM tblcuisine where fldvendor_id=$vrid"))
			  {
				  if(mysqli_num_rows($query))
				  {
						while($row=mysqli_fetch_array($query))
						{
			?>		
                    <option><?php echo $row['Cuisine_name']; ?></option>
<?php 				}
					 }
					 else 				 
					 {
						  $msg="Please add some Items";
					 }
			 }
			 else 
			 {
				 echo "failed";
			 }			 
?>	 
                        </select>
               </div>
					
					<!-- <div class="form-group">
                                      <label for="cuisines">Cuisines :</label>
                                      <input type="text" class="form-control" id="cuisines" value="<?php if(isset($cuisines)) { echo $cuisines;}?>" placeholder="Enter Cuisines" name="cuisines" required>
                    </div>	           -->
             <div class="form-group"><!--food_name-->
             <label for="food_details">Enter Food Details :</label>
                <textarea class="form-control" id="food_details" placeholder="Food Details*" name="foodDetails" rows="3" col="10" required/></textarea/>
             </div>

				        
				        <div class="form-group"><!--payment_mode-->
                       					<input type="checkbox" name="chk[]" value="COD"/> Cash On Delivery
                       		&nbsp;&nbsp;&nbsp;&nbsp;
                             <input type="checkbox" name="chk[]" value="Online Payment"/> Online Payment
					         <br>
					        <span style="color:red;"><?php if(isset($paymessage)){ echo $paymessage;}?></span>
      			        </div>

				        <div class="form-group"><!--payment_mode-->
                       					<input type="radio" name="stk[]" value="In Stock"/> In Stock
                       		&nbsp;&nbsp;&nbsp;&nbsp;
                             <input type="radio" name="stk[]" value="Out of Stock"/> Out of Stock
					         <br>
					        <span style="color:red;"><?php if(isset($stat)){ echo $stat;}?></span>
      			        </div>
				   
                      <div class="form-group">
                      	<label for="foodsnap">Food Snaps :</label><br>
                             <input type="file" accept="image/*" name="food_pic" required/>
                        </div>

                        <button type="submit" name="add" class="btn btn-primary">ADD Item</button>
						<br>
						<span style="color:red;"><?php if (isset($msg)){ echo $msg;}?></span>
                         </form>
	   
</div>
<!--tab 2 ends-->
			
			
			 <!--tab 3-- starts-->
			 <div class="tab-pane fade" id="accountsettings" role="tabpanel" aria-labelledby="accountsettings-tab" style="padding-left: 40px; padding-right: 40px;">
			    <form method="post" enctype="multipart/form-data">
				<?php
			    $upd_info=mysqli_query($con,"select * from tblvendor where fld_email='$id'");
				$upd_info_row=mysqlI_fetch_array($upd_info);
				$nm=$upd_info_row['restaurantName'];
				$emm=$upd_info_row['fld_email'];
				$log=$upd_info_row['restaurant_Image'];
				$ad=$upd_info_row['restaurantAddress'];
				$mb=$upd_info_row['restaurantMobile'];
				$psd=$upd_info_row['fld_password'];
				
				?>
				
                    <div class="form-group">
                      <label for="name">Restaurant Name</label>
                      <input type="text" id="username" value="<?php if(isset($nm)){ echo $nm;}?>" class="form-control" name="fn" />
                    </div>
					<div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" id="email" value="<?php if(isset($emm)){ echo $emm;}?>" class="form-control" name="emm" readonly="readonly"/>
                    </div>
					<div class="form-group">
                      <label for="address">Restaurant Address</label>
                      <input type="text" id="address" value="<?php if(isset($ad)){ echo $ad;}?>" class="form-control" name="add" required/>
                    </div>
					<div class="form-group">
                      <label for="mobile">Restaurant Mobile No.</label>
                      <input type="text" id="mobile" pattern="[6-9]{1}[0-9]{9}" value="<?php if(isset($mb)){ echo $mb;}?>" class="form-control" name="mob" required/>
                    </div>
					
                   <div class="form-group">
                      <label for="pwd">Password</label>
                     <input type="password" name="pwsd" class="form-control" value="<?php if(isset($psd)){ echo $psd;}?>" id="pwd" required/>
                   </div>
				   
				   
 
                  <button type="submit" name="upd_account" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                  
			 </form>
			</div>
			<!--tab 3-- end-->

		    <!--tab 4-- starts-->
			<div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab" style="padding-left: 35px;">
                <div class="container">
				    <form class="form" method="post" enctype="multipart/form-data">
				       <input type="file" name="logo_pic" accept="image/*" required/>
					   <button type="submit" name="upd_logo" class="btn btn-outline-primary">Update Logo</button>
			        </form>
				</div>
<br><br><br><br><br><br><br><br>
			</div>
			<!--tab 4-- end--> 


			<!--tab 5-- starts-->
			 <div class="tab-pane fade " id="status" role="tabpanel" aria-labelledby="status-tab" style="padding-left: 40px; padding-right: 40px;">
			<table border="1" bordercolor="#F0F0F0" width="800px" cellpadding="20px">
			 <tr>
				<th>Total Orders Income
				<?php
				// error_reporting(0);
					$income = mysqli_query($con,"select SUM(tblorder.fld_payment),tblorder.fldstatus,tblvendor.fld_email from tblorder inner join tblvendor on tblvendor.fldvendor_id=tblorder.fldvendor_id where tblorder.fldstatus='Delivered' AND tblvendor.fld_email='$id'");
					while ($row = mysqli_fetch_array($income)) {
						$total_income = $row['SUM(tblorder.fld_payment)'];
					}
					if($total_income==''){
						echo '<h1>'.'0'.'</h1>';}
						else{
							echo '<h1>₹'.$total_income.'</h1>';}
				
				?>
				</th>
				<th>Total Delivered Orders
				<?php
				// $status = mysqli_query($con,"select COUNT(fld_order_id) FROM tblorder WHERE fldvendor_id = 22 AND fldstatus='Delivered'");

                // $status = "select COUNT(fld_order_id) AS countdel FROM tblorder WHERE fldvendor_id = 22 AND fldstatus='Delivered'";
				$status = "select COUNT(fld_order_id) AS countdel FROM tblorder inner join tblvendor on tblvendor.fldvendor_id=tblorder.fldvendor_id where tblvendor.fld_email='$id' AND tblorder.fldstatus='Delivered'";
                $status_result = mysqli_query($con,$status);
				while ($row = mysqli_fetch_array($status_result)) {
					$total_del = $row['countdel'];
				}
				echo '<h1>'.$total_del.'</h1>';
				?>
				</th>
             
				<th>Total In Process Orders
				<?php
				$process_status = "select COUNT(fld_order_id) AS countdel FROM tblorder inner join tblvendor on tblvendor.fldvendor_id=tblorder.fldvendor_id where tblvendor.fld_email='$id' AND tblorder.fldstatus='In Process'";
                $status_result1 = mysqli_query($con,$process_status);
				while ($row = mysqli_fetch_array($status_result1)) {
					$total_del = $row['countdel'];
				}
				echo '<h1>'.$total_del.'</h1>';
				?>
				</th>
				<th>Total Cancel Orders
				<?php
				$process_status = "select COUNT(fld_order_id) AS countdel FROM tblorder inner join tblvendor on tblvendor.fldvendor_id=tblorder.fldvendor_id where tblvendor.fld_email='$id' AND tblorder.fldstatus='cancelled'";
                $status_result1 = mysqli_query($con,$process_status);
				while ($row = mysqli_fetch_array($status_result1)) {
					$total_del = $row['countdel'];
				}
				echo '<h1>'.$total_del.'</h1>';
				?>
				</th>
			</tr>
			 </table>
    <br><br>         


	            <table class="table">
				<tbody>
				<th>Order Id</th>
				<th>Customer Email</th>
				<th>Food Id</th>
				<th>Order Status</th>
				<th>Update Status</th>
				<?php
				$orderquery=mysqli_query($con,"select * from tblorder where fldvendor_id='$vrid'");
				if(mysqli_num_rows($orderquery))
				{
					while($orderrow=mysqli_fetch_array($orderquery))
					{
						$stat=$orderrow['fldstatus'];
						?>
						<tr>
						<td><?php echo $orderrow['fld_order_id']; ?></td>
						<td><?php echo $orderrow['fld_email_id']; ?></td>
						<td><?php echo $orderrow['fld_food_id']; ?></td>
						<?php
			   if($stat=="cancelled" || $stat=="Out Of Stock")
			   {
			   ?>
			   <td><i style="color:orange;" class="fas fa-exclamation-triangle"></i>&nbsp;<span style="color:red;"><?php echo $orderrow['fldstatus']; ?></span></td>
			   <?php
			   }
			   else
				   
			   {
			   ?>
			   <td><span style="color:green;"><?php echo $orderrow['fldstatus']; ?></span></td>
			   <?php
			   }
			   ?>
						<form method="post">
						<td><a href="changestatus.php?order_id=<?php echo $orderrow['fld_order_id']; ?>"><button type="button" name="changestatus" class="btn btn-primary">Update Status</button></a></td>
						</form>
						<tr>
						<?php
					}
				}
				?>
				</tbody>
				</table>
			 </div>
			 <!--tab 5-- end-->
			 
			 <!--tab 6-- start-->
			 <div class="tab-pane fade" id="foodcuisines" role="tabpanel" aria-labelledby="foodcuisines-tab" style="padding-left: 35px;">
			 <div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
		<div class="col-md-4">
        <?php
        error_reporting(0);
            if (isset($_POST['AddCuisine'])) 
            {
               $cat = $_POST['category_name'];

               $sql = "insert into tblcuisine(Cuisine_name,fldvendor_id) values('$cat','$v_id')";
               $sql_result = mysqli_query($con,$sql);
               if($sql_result === true){
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo "Data Inserted Successfully";?>
                </div>
                <?php
               }
               else{
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Data Not Inserted";?>
                </div>
                <?php
               }
            }    
        
        ?>
    <div class="row">
            <form action="" method="post">
            <div class="form-group">    
                <label for="">Enter Cuisine Name:</label>
                <input type="text" name="category_name" class="form-control" required />
            </div>
            
            <div class="for-group">
                <input type="submit" name="AddCuisine" value="Add cuisine" class="btn btn-success"/>
            </div>
  
            </form>
			
        </div>
		
    </div> 
</div> 
<br>
<div class="col-md-10">
				<div class="card">
					<div class="card-body">
						<form method="post" action="">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Sr.</th>
									<th class="text-center">Cuisine_ID</th>
									<th class="text-center">Cuisine Name</th>
									<th class="text-center" colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
        <?php

					  if($query=mysqli_query($con,"SELECT * FROM tblcuisine where fldvendor_id='$vrid'"))
					  {
					  	$i=1;
						  if(mysqli_num_rows($query))
						  {
						 while($roww=mysqli_fetch_array($query))
						 {
						
						 	// $cid=$roww['cuisine_id'];
					?>
			     <tr>
				<td align="center"><?php  echo $i."<br>";?></td>
				<td align="center"><?php echo $roww['cuisine_id']; ?></td>		
				<td><?php echo $roww['Cuisine_name']; ?></td>

				<!-- <td align="center"><button type="button" name="updCuisine" class="btn btn-warning">Update </button></td> -->

				<td align="center"><a href="updateCuisine.php?cuisine_id=<?php echo $roww['cuisine_id'];?>"><button type="button" class="btn btn-warning">Update </button></a></td>

				<td align="center"><a href="deleteCuisine.php?cuisine_id=<?php echo $roww['cuisine_id'];?>"><button type="button" class="btn btn-danger">Delete </button></a>
				
				
				</td>
				</tr>
				
				<?php 
					 		$i++;       					
						 }
					  }
					  else 
						  {
							   $msg="please add some Items";
						  }
					  }
					  else 
					  {
						  echo "failed";
					  }
					  
					  ?>
							</tbody>
						</table>
					</form>
					</div>
				</div>
			</div>            

			</div>
			<!--tab 6-- end-->
	  </div>
	</div> 
</div>
<br>
<hr>
<br>
<!--footer primary-->
	     
    <?php
		include("footer.php");
	?>
			 			 

</body>
</html>