<?php
session_start();
include("connection.php");
extract($_REQUEST);

if(!isset($_SESSION['admin']))
{
	header("location:admin.php");	
}
else
{
	$admin_username=$_SESSION['admin'];
}


if(isset($logout))
{
	unset ($_SESSION['admin']);
	setcookie('logout','loggedout successfully',time() +5);
	header("location:admin.php");
}


if(isset($delete))
{
	header("location:deletefood.php?id=$delete");
}


if(isset($deleteVendor))
{
	header("location:deleteVendor.php?Vendorid=$deleteVendor");
}

$admin_info=mysqli_query($con,"select * from tbadmin where fld_email='$admin_username'");
$row_admin=mysqli_fetch_array($admin_info);
$user= $row_admin['fld_email'];
$pass= $row_admin['fld_password'];


//update
if(isset($update))
{
	if(mysqli_query($con,"update tbadmin set fld_password='$password'"))
	{
		//$_SESSION['pas_update_success']="Password Updated Successfully Login with New Password";
	    unset ($_SESSION['admin']);
		header("location:admin_info_update.php");
	}
	else
	{
		echo "failed";
	}
}
?>
<html>
  <head>
     <title>Admin Panel</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">   
	  <link rel="stylesheet" href="css/style1.css">
   	 <link rel="stylesheet" href="css/style2.css"> 
	<link rel="stylesheet" href="css/style3.css"> 
	 

		 <style>
  ul li {list-style:none;}
  ul li a{color:black; font-weight:bold;}
  ul li a:hover{color:white; text-decoration:none;}

ul li a:hover{text-decoration:none;}
#social-fb,#social-tw,#social-gp,#social-em{color:blue;}
#social-fb:hover{color:#4267B2;}
#social-tw:hover{color:#1DA1F2;}
#social-gp:hover{color:#D0463B;}
#social-em:hover{color:#D0463B;}
	 </style>
	 <script>
			function delRecord(id)
			{
				//alert(id);
				
				var x=confirm("You want to delete this record? All Food Items Of that Vendor Will Also Be Deleted");
				if(x== true)
				{
					
					//document.getElementById("#result").innerHTML="success";
				  window.location.href='deleteVendor.php?Vendorid=' +id;		
				}
				else
				{
					window.location.href='#';
				}
				
			}
		</script>
  
  </head>
  
    
	<body>

	
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>
    <?php
	if(!empty($admin_username))
	{
	?>
	<!-- <a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user"> Admin</i></a> -->
	<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user"> <strong><?php echo " ",$row_admin['fld_name']; ?></strong></i></a>
	<?php
	}
	?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
		<?php
		if(isset($_SESSION['admin']))
		{
			?>
			<li class="nav-item">
            <a class="nav-link" href="">
		      <form method="post">
			    <button type="submit" name="logout" class="btn btn-outline-success">Log Out</button>
			  </form>
		    </a>
            </li>
			<?php
		}
		
		?>
		
      </ul>
	  
    </div>
	
</nav>
<!--navbar ends-->
<br><br><br><br>
<!--details section-->
 
<div class="container">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem" aria-selected="true">View Food Items</a>
          </li>
		  		<li class="nav-item">
              <a class="nav-link" id="ManageVendors-tab" data-toggle="tab" href="#ManageVendors" role="tab" aria-controls="ManageVendors" aria-selected="false">Manage Restaurant</a>
          </li>
		  		<li class="nav-item">
              <a class="nav-link" id="manageUser-tab" data-toggle="tab" href="#ManageUser" role="tab" aria-controls="ManageUser" aria-selected="false">Manage User</a>
          </li>
		  		<li class="nav-item">
              <a class="nav-link" id="orderstatus-tab" data-toggle="tab" href="#orderstatus" role="tab" aria-controls="orderstatus" aria-selected="false">Order Status</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="false">Account Settings</a>
          </li>
		  
       </ul>
	   <br><br>
	<!--tab 1 starts-->   
	   <div class="tab-content" id="myTabContent">
	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="viewitem-tab">
                 <div class="container">
	               <table class="table">
                 <thead>
                    <tr>
						<th scope="col">ID</th>
						<th scope="col" width="170px">Food View</th>
						<th scope="col">Food Cuisines</th>
						<th scope="col">Restaurant Name</th>
						<th scope="col">Food Id</th>
						<th scope="col">Remove Food</th>
                    </tr>
                 </thead>
				 <tbody>
	<?php
	$query=mysqli_query($con,"select tblvendor.fldvendor_id,tblvendor.restaurantName,tblvendor.fld_email,tbfood.food_id,tbfood.foodname,tbfood.cuisines,tbfood.fldimage from  tblvendor right join tbfood on tblvendor.fldvendor_id=tbfood.fldvendor_id");
	    while($row=mysqli_fetch_array($query))
		{
	
	?>			 
                
            <tr>
                <th scope="row"><?php echo $row['fldvendor_id'];?></th>
				<td><img src="image/restaurant/<?php echo $row['fld_email']."/foodimages/" .$row['fldimage'];?>" height="50px" width="100px">
				<br><?php echo $row['foodname'];?>
				</td>
				<td><?php echo $row['cuisines'];?></td>
                <td><?php echo $row['restaurantName'];?></td>
                <td><?php echo $row['food_id'];?></td>
                               
				<form method="post">
                <td><a href=""><button type="submit" value="<?php echo $row['food_id']; ?>" name="delete"  class="btn btn-danger">Remove </button></td>
                </form>
           </tr>
		<?php
		}
		?>		   
                </tbody>
           </table>
	 
	 </div>   	
		  
		   <span style="color:green; text-align:centre;"><?php if(isset($success)) { echo $success; }?></span>
			
		
      	    </div>	 
	  
<!--tab 1 ends-->	   

						 
	<!--tab 2 start-->
			 <div class="tab-pane fade" id="ManageVendors" role="tabpanel" aria-labelledby="ManageVendors-tab">
			    <div class="container">

				&nbsp;&nbsp;&nbsp;
    			<div class="container">
    				<div class="row mt-4">
        			<?php
            // $sql = "count(fldvendor_id) as Total_Restaurant from tblvendor";
            		$sql = "select fldvendor_id from tblvendor order by fldvendor_id";
            		$sql_run = mysqli_query($con,$sql);
            		$total = mysqli_num_rows($sql_run);
            		echo '<h1>'.$total.'&nbsp;&nbsp;Restaurants register</h1>'; 
        			?>
    				</div>
    			</div> 
				<br><br>  
	               <table class="table">
						<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Restaurant ID</th>
							<th scope="col">Name</th>          
							<th scope="col">Address</th>
							<th scope="col">Income</th>
							<th scope="col">Remove Restaurant</th>
						</tr>
						</thead>
				 <tbody>
	<?php
	$query=mysqli_query($con,"select  * from tblvendor");
	// $query = mysqli_query($con,"select tblvendor.restaurantName,tblvendor.fldvendor_id,tblvendor.fld_email,
	// 		tblvendor.restaurantMobile,tblvendor.restaurantAddress,tblvendor.restaurant_Image,tblorder.fld_payment from tblorder inner join tblvendor on tblvendor.fldvendor_id=tblorder.fldvendor_id where tblvendor.fld_email='$id'");

	    while($row=mysqli_fetch_array($query))
		{
	
	?>			 
                
                    <tr>
                        
						<td><img src="image/restaurant/<?php echo $row['fld_email']."/" .$row['restaurant_Image'];?>" height="50px" width="100px"></td>
                        <th scope="row"><?php echo $row['fldvendor_id'];?></th>
						<td><?php echo $row['restaurantName'];?></td>
						<td><?php echo $row['restaurantAddress'];?></td>
		<?php
			$vid = $row['fldvendor_id'];
			$qr=mysqli_query($con,"select SUM(fld_payment) from tblorder where fldvendor_id='$vid' AND (fldstatus='Delivered')");
	    	$abc=mysqli_fetch_array($qr)
				// $total_income1 = $row[]

			
		?>

						<td>&#x20b9; <?php if($abc['SUM(fld_payment)']==""){echo 00;}else{echo $abc['SUM(fld_payment)'];}?></td>						

						<form method="post">
                        <td><a href="#"  style="text-decoration:none; color:white;" onclick="delRecord(<?php echo $row['fldvendor_id']; ?>)"><button type="button" class="btn btn-danger">Remove</button></a></td>
                        </form>

                   </tr>
		<?php
		}
		?>		   
                </tbody>
           </table>
	 
	 </div>   	
			 </div>
	<!--tab 2 ends-->


 <!--tab 3 start-->
 	 <div class="tab-pane fade" id="ManageUser" role="tabpanel" aria-labelledby="manageUser-tab">
  <table class="table">
  	<thead align="center">
       	 <th>ID</th>
		 <th>User Name</th>
		 <th>Moobile No.</th>
		 <th>User Address</th>
		 <th>User Email</th>
		 <th colspan="2">Action</th>
	</thead>
			
			   	<?php
					  if($query=mysqli_query($con,"select * from tblcustomer"))
					  {
						  if(mysqli_num_rows($query))
						  {
						 while($row=mysqli_fetch_array($query))
						 {
							 
					?>
		
	<tbody>
	<tr>

		<td style="width:50px;"\><?php  echo $row['fld_cust_id']."<br>";?></td> 				 
		<td style="width:150px;"><?php  echo $row['fld_name']."<br>";?></td>
		<td align="center" style="width:150px;"><?php  echo $row['fld_mobile']."<br>";?></td>
		<td  align="center" style="width:150px;"><?php  echo $row['fld_address']."<br>";?></td>
		<td align="center" style="width:150px;"><?php  echo $row['fld_email']."<br>";?></td>
		
		<td align="center" style="width:150px;">
		
		<a href="userupdate.php?user_id=<?php echo $row['fld_cust_id'];?>"><button type="button" class="btn btn-warning">Update </button></a>
		
		</td>
		<td align="center" style="width:150px;">

        <a href="deleteUser.php?user_id=<?php echo $row['fld_cust_id'];	?>"><button type="button" class="btn btn-danger">Delete</button></a>
		
		</td>
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
					<tbody>
			 </table>
	</div>

	<!--tab 3 ends-->


			 <!--tab 4 start-->
			 <div class="tab-pane fade" id="orderstatus" role="tabpanel" aria-labelledby="orderstatus-tab">

				<table border="10" bordercolor="#F0F0F0" width="800px" cellpadding="50px">
			 <tr>
				<th>Total Orders Income
				<?php
				error_reporting(0);
					$income = mysqli_query($con,"select * from tblorder where fldstatus='Delivered'");
					while ($row = mysqli_fetch_array($income)) {
						$total_income += $row['fld_payment'];
					}
				?>
				<br><br>
				<?php
				// 	
				echo '<h1>&#x20b9;'.$total_income.'</h1>';
				?>
				</th>
				<th>Total Delivered Orders
				<?php
				// $status = mysqli_query($con,"select COUNT(fld_order_id) FROM tblorder WHERE fldvendor_id = 22 AND fldstatus='Delivered'");

                // $status = "select COUNT(fld_order_id) AS countdel FROM tblorder WHERE fldvendor_id = 22 AND fldstatus='Delivered'";
				$status = "select COUNT(fld_order_id) AS countdel FROM tblorder inner join tblvendor on tblvendor.fldvendor_id=tblorder.fldvendor_id where tblorder.fldstatus='Delivered'";
                $status_result = mysqli_query($con,$status);
				while ($row = mysqli_fetch_array($status_result)) {
					$total_del = $row['countdel'];
				}
				?>
				<br><br>
				<?php
				echo '<h1>'.$total_del.'</h1>';
				?>
				</th>
             
				<th>Total Inprocess Orders
				<?php
				$process_status = "select COUNT(fld_order_id) AS countdel FROM tblorder inner join tblvendor on tblvendor.fldvendor_id=tblorder.fldvendor_id where tblorder.fldstatus='In Process'";
                $status_result1 = mysqli_query($con,$process_status);
				while ($row = mysqli_fetch_array($status_result1)) {
					$total_del = $row['countdel'];
				}
				?>
				<br><br>
				<?php
				echo '<h1>'.$total_del.'</h1>';
				?>
				</th>
				<th>Total Cancel Orders
				<?php
				$process_status = "select COUNT(fld_order_id) AS countdel FROM tblorder inner join tblvendor on tblvendor.fldvendor_id=tblorder.fldvendor_id where tblorder.fldstatus='cancelled'";
                $status_result1 = mysqli_query($con,$process_status);
				while ($row = mysqli_fetch_array($status_result1)) {
					$total_del = $row['countdel'];
				}
				?>
				<br><br>
				<?php
				echo '<h1>'.$total_del.'</h1>';
				?>
				</th>
			</tr>
			 </table>
				

               <table class="table">
			   <th>Order Id</th>
			   <th>Food Id</th>
			   <th>Customer Email Id</th>
			   <th>Order Status</th>
			   <tbody>
			   <?php			   
			   $rr=mysqli_query($con,"select * from tblorder");
			   while($rrr=mysqli_fetch_array($rr))
			   {
				   $stat=$rrr['fldstatus'];
				   $foodid=$rrr['fld_food_id'];
				   $r_f=mysqli_query($con,"select * from tbfood where food_id='$foodid'");
				   $r_ff=mysqli_fetch_array($r_f);
				//    customer table
				//    $r_c=mysqli_query($con,"select * from tblcustomer");
				//    $r_cc=mysqli_fetch_array($r_f);
			   
			   ?>
			   <tr>
			   <td><?php echo $rrr['fld_order_id']; ?></td>
			   <td><a href="searchfood.php?food_id=<?php echo $rrr['fld_food_id']; ?>"><?php echo $rrr['fld_food_id']; ?></td>
			   <td><?php echo $rrr['fld_email_id']; ?></td>
			   <?php
			   if($stat=="cancelled" || $stat=="Out Of Stock")
			   {
			   ?>
			   <td><i style="color:orange;" class="fas fa-exclamation-triangle"></i>&nbsp;<span style="color:red;"><?php echo $rrr['fldstatus']; ?></span></td>
			   <?php
			   }
			   else
				   
			   {
			   ?>
			   <td><span style="color:green;"><?php echo $rrr['fldstatus']; ?></span></td>
			   <?php
			   }
			   ?>
			   
			   </tr>
			   <?php
			   }
			   ?>
			   </tbody>
			   </table>
			</div>
<!--tab 4 ends-->


			<!--tab 5 starts-->
            <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="manageaccount-tab">
			    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Email Id:</label>
                      <input type="text" id="username" value="<?php if(isset($user)){ echo $user;}?>" class="form-control" name="name" readonly="readonly"/>
                    </div>
					
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="password" class="form-control" value="<?php if(isset($pass)){ echo $pass;}?>" id="pwd" required/>
                   </div>
				   				   
 
                  <button type="submit" name="update" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
			 </form>
			</div>
			<!--tab 5 ends-->

	  </div>
	</div>	 
	<br><br><br>

<?php
	include("footer.php");
?>
		  
</body>
	
</html>	