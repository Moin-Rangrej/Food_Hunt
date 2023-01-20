<head>
  <meta charset="UTF-8">
    <title>Restaurant Vendor</title>

<?php
session_start();
include("connection.php");
extract($_REQUEST);

if(isset($_SESSION['id']))
{
	header("location:food.php");
}


if(isset($login))
{
	$sql=mysqli_query($con,"select * from tblvendor where fld_email='$username' && fld_password='$pswd' ");
    if(mysqli_num_rows($sql))
	{
	 $_SESSION['id']=$username;
	 header('location:food.php');	
	}
	else
	{
    ?>
    <script type="text/javascript">alert("Invalid Email Id or Password")</script>
    <?php
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
<br><br><br><br>
<h2 align="center">Log In to your restaurant</h2><br>


<div class="middle" style=" padding:20px; border:1px solid #ED2553; margin:0px auto; width:500px;">
    <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Log In</a>
          </li>
          <li class="nav-item">
             <a class="nav-link" id="forgot-tab" data-toggle="tab" href="#forgot" role="tab" aria-controls="forgot" aria-selected="true">Forgot Password</a>
          </li>
    </ul>
	<br><br>
    <div class="tab-content" id="myTabContent">

      <!--login Section-- starts-->
      <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
			    <div class="footer" style="color:red;"><?php if(isset($admin_login_error)){ echo $admin_login_error;}?></div>
			   <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                   <label for="username">Enter Email Id:</label>
                   <input type="text" class="form-control" id="username" name="username" required/>
                </div>
                <div class="form-group">
                   <label for="pwd">Enter Password:</label>
                   <input type="password" class="form-control" id="pwd" name="pswd" required/>
                </div>
                
                  <button type="submit" name="login" class="btn btn-primary">Log In</button>
                  
                  <a href="vendor-new.php"><button type="button" name="new" class="btn btn-warning">Register your restaurant on Food Hunt</button></a>
          </form>
			</div>
			<!--login Section-- ends-->
      
     <!--Forgot Password Section-- starts-->
     <div class="tab-pane fade" id="forgot" role="tabpanel" aria-labelledby="home-tab">
        <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="email">Enter Email Id:</label>
                      <input type="email" class="form-control" name="email" id="email" required/>
                    </div>

                  <button type="submit" name="forgot" class="btn btn-success">Search</button>
                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
       </form>
      </div>
      <!--Forgot Password Section-- ends-->

    </div>
  </div>

<br><br> <br><br> <br><br>
<?php
include("footer.php");
?>

</body>
