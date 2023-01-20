<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <title>Restaurant Registration Form</title>

<?php
session_start();
include("connection.php");
extract($_REQUEST);
    if(isset($_SESSION['id']))
{
	header("location:food.php");
}

if(isset($register))
{
	$sql=mysqli_query($con,"select * from tblvendor where fld_email='$email'");
	if(mysqli_num_rows($sql))
	{
		// $email_error="This Email Id is laready registered with us";
	?>
	<script type="text/javascript">alert("This Email Id is already registered with us")</script>
	<?php
	}
	else
	{
		if($pswd==$confirm_pswd)
		{
			$logo=$_FILES['logo']['name'];
			$sql=mysqli_query($con,"insert into tblvendor 
			(fld_email,fld_password,vendorMobile,restaurantName,restaurantMobile,restaurantAddress,restaurant_Image) 
			values('$email','$pswd',0,'$res_name','$res_mobile','$res_address','$logo')");

			if($sql)
			{
				mkdir("image/restaurant");
				mkdir("image/restaurant/$email");
				move_uploaded_file($_FILES['logo']['tmp_name'],"image/restaurant/$email/".$_FILES['logo']['name']);
			}
			$_SESSION['id']=$email;
			header("location:food.php");

		}
		else
		{		
			?>
			<script type="text/javascript">alert("Password and Confirm Password does not match")</script>
			<?php
		}
	}
}
  
?>
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
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	  
    </div>
	
</nav>
<br><br><br>
<div class="middle" style="margin:0px auto; border:1px solid #F8F9FA;  width:800px;">
       <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true">Register Your Restaurant</a>
          </li>
		  		<li class="nav-item">
             <a class="nav-link " id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Log In</a>
          </li>
       </ul>
	   <br><br>

	   <!--tab 1 starsts-->
	   <div class="tab-content" id="myTabContent">
	       <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="home-tab">
			    <div class="footer" style="color:red;"><?php if(isset($loginmsg)){ echo $loginmsg;}?></div>
			    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="r_name">Restaurant Name:</label>
                          <input type="text" class="form-control" id="r_name" value="<?php if(isset($res_name)) { echo $res_name;}?>" placeholder="Enter Restaurant Name" name="res_name" required/>
                      </div>
	                 <div class="form-group">
                          <label for="r_phone">Restaurant Mobile No.:</label>
                          <input type="tel" class="form-control" pattern="[6-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" id="r_phone" value="<?php if(isset($res_mobile)) { echo $res_mobile;}?>" placeholder="Enter Restaurant Mobile Number" name="res_mobile" required>
                     </div>
	                 <div class="form-group">
                          <label for="r_address">Restaurant Address:</label>
                          <input type="text" class="form-control" id="r_address" placeholder="Enter Restaurant Address" value="<?php if(isset($res_address)) { echo $res_address;}?>" name="res_address" required>
                     </div>
	                  <div class="form-group">
                          <label for="r_email">Email Id:</label>
                          <input type="email" class="form-control" id="r_email" value="<?php if(isset($email)) { echo $email;}?>" placeholder="Enter Email" name="email" required/>
                          <span style="color:red;"><?php if(isset($email_error)){ echo $email_error;} ?></span>
	                  </div>
	                 <div class="form-group">
                         <label for="pswd">Password:</label>
                         <input type="password" class="form-control" id="pswd" placeholder="Enter Password" name="pswd" required/>
                     </div>
	                 <div class="form-group">
                         <label for="cpswd">Confirm Password:</label>
                         <input type="password" class="form-control" id="cpswd" placeholder="Enter Confirm Password" name="confirm_pswd" required/>
                     </div>
                      <div class="form-group">
	                 				<label for="upload">Choose Restaurant Image:</label><br>
                          <input type="file"  name="logo" id="upload" required> 
                     </div>
                     <button type="submit" id="register" name="register" class="btn btn-outline-primary">Register</button>
                     
                </form>
				<br>
			</div>
			<div class="tab-pane fade show" id="login" role="tabpanel" aria-labelledby="home-tab">
			   <a href="vendor_login.php"><button type="button" style="padding:10px;  width:200px; margin-top:30%; margin-left:40%; margin:0px auto;" class="btn btn-outline-primary" name="login" value="Log In">Log In</button></a>
			   <br><br><br> <br><br><br> <br><br><br><br><br><br> <br><br><br> <br><br><br>
			</div>
	   </div>
	</div>
	<br>
	 <?php
			include("footer.php");
			?>
	 
</body>
</html>