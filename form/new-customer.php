<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
    <title>User</title>

<?php
session_start();
include("../connection.php");
extract($_REQUEST);

if(isset($register))
{
	$query=mysqli_query($con,"select * from tblcustomer where fld_email='$email'");
	$row=mysqli_num_rows($query);
	if($row)
	{
		// $ermsg2="Email alredy registered with us";
		?>
		<script type="text/javascript">alert("Email alredy registered with us")</script>
		<?php		
	}
	else
	{
		if($password==$confirm_password)
		{
				if(mysqli_query($con,"insert into tblcustomer (fld_name,fld_mobile,fld_address,fld_email,password) values('$name','$mobile','$address','$email','$password')"))
		    {
				$_SESSION['cust_id']=$email;
				if(!empty($customer_email && $product_id))
				{
					$_SESSION['cust_id']=$customer_email;
					header("location:cart.php?product='$product_id'");
					
				}
				else
				{
					$_SESSION['cust_id']=$email;
					header("location:../index.php");
				}			
			}
			else
			{
				echo "fail";
				echo $name;
				echo $mobile;
				echo $address;
				echo $email;
				echo $password;
			}

		}
		else
		{
				// $ermsg3="Password and Confirm Password does not match";
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
1
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="../index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Food Hunt</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../search.php">Search</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../index.php">Offers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact.php">Help</a>
        </li>
      </ul>
	  
    </div>
	
</nav>
<br><br><br><br><br>
<div class="middle" style="margin:0px auto; border:1px solid #F8F9FA;  width:800px;">
       <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="newAccount-tab" data-toggle="tab" href="#newAccount" role="tab" aria-controls="newAccount" aria-selected="true">Create New Account</a>
          </li>
		  		<li class="nav-item">
             <a class="nav-link " id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Log In</a>
          </li>
       </ul>
	   <br><br>
	   <div class="tab-content" id="myTabContent">
	   			
			<!--new account Section-- starts-->
            <div class="tab-pane fade show active" id="newAccount" role="tabpanel" aria-labelledby="profile-tab">
			    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Enter Full Name:</label>
                      <input type="text" id="name"  class="form-control" name="name" required="required"/>
                    </div>

								   <div class="form-group">
                      <label for="mobile">Enter Mobile:</label>
                      <input type="tel" id="mobile" class="form-control" name="mobile" pattern="[6-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" placeholder="" required>
                    </div>
					
                    <div class="form-group">
                      <label for="name">Enter Address:</label>
                      <input type="text" id="address"  class="form-control" name="address" required="required"/>
                    </div>

										<div class="form-group">
                      <label for="email">Enter Email:</label>
                      <input type="email" id="email" name="email" class="form-control"  required/>
                    </div>
					
                   <div class="form-group">
                      <label for="pwd">Enter Password:</label>
                     <input type="password" name="password" class="form-control" id="pwd" required/>
                   </div>
				    
                   <div class="form-group">
                      <label for="pwd">Enter Confirm Password:</label>
                     <input type="password" name="confirm_password" class="form-control" id="cpwd" required/>
                   </div>

                  <button type="submit" name="register" style=" border:1px solid #ED2553;" class="btn btn-primary">Submit</button>
                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?><?php if(isset($ermsg3)) { echo $ermsg3; }?></div>
			 </form>
			</div>
			<!--new account Section-- end--> 

			<div class="tab-pane fade show" id="login" role="tabpanel" aria-labelledby="home-tab">
			   <a href="login.php"><button type="button" style="padding:10px;  width:200px; margin-top:30%; margin-left:40%; margin:0px auto;" class="btn btn-outline-primary" name="login" value="Log In">Log In</button></a>
			   <br><br><br> <br><br><br> <br><br><br><br><br><br> <br><br><br> <br><br><br>
			</div>           
    </div>
	</div>
<br><br> <br><br> <br><br>
<?php
include("footer.php");
?>
	   
</body>
