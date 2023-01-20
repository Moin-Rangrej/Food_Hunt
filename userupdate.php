<?php
session_start();
include("connection.php");
extract($_REQUEST);

if(isset($_SESSION['admin']))
{
  if(!empty($_GET['user_id']))
  {
    $eid=$_GET['user_id'];
    $query=mysqli_query($con,"select * from tblcustomer where fld_cust_id='$eid'");
    if(mysqli_num_rows($query))
    {   
      $row=mysqli_fetch_array($query);
      $uid = $row['fld_cust_id'];
      $uName = $row['fld_name'];
      $uMobile = $row['fld_mobile'];
      $uAddress = $row['fld_address'];
      $uEmail = $row['fld_email'];
    }
    else
    {
      header("location:dashboard.php");
    }
  }
  else
  {
    header("location:dashboard.php");
  }
}
else
{
  header("location:index.php");
}


// error_reporting(0);


if(isset($_POST['updatee']))
{
  if(!empty($_SESSION['id'])) 
  {
    $userid =  $_POST['userid'];
    $username = $_POST['username'];
    $usermob = $_POST['usermob'];
    $useradd = $_POST['useradd'];
    $useremail = $_POST['useremail'];

    $query = "update tblcustomer set fld_name='$username',fld_mobile='$usermob',fld_address='$useradd',fld_email='$useremail' where fld_cust_id='$userid '";
    echo $query;
    
    $data = mysqli_query($con,$query);
    echo $data;
    if ($data) {
        echo "<script>alert('Record Updated')</script>";

    }
    else{
        echo "FAiled to Updated Record";
    }
  }
  else
  {
    header("location:admin.php");
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
      if(empty($_SESSION['admin']))
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

<div class="middle" style=" position:fixed; padding:40px; border:1px solid #ED2553;  width:100%;">
       <!--tab heading-->
     <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="home" aria-selected="true">Update User Account</a>
          </li>
         
              <a class="nav-link" style="color:white; font-weight:bold;" id="profile-tab"  aria-selected="false">User Details</a>
         
      
       </ul>
     <br><br>

  <!--tab 1 starts-->  

<?php
// $eid=$_GET['user_id'];
// $ret=mysqli_query($con,"select * from tblcustomer where fld_cust_id='$eid'");
// while ($row=mysqli_fetch_array($ret)) {
?>
     <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="home-tab">
  <form method="post" action="">
  <div class="form-group">
    <label for="user_id">User Id</label>
    <input type="text" class="form-control" value="<?php  echo $uid;?>"  name="userid">
  </div>
  <div class="form-group">
    <label for="user_name">User Name</label>
    <input type="text" class="form-control" value="<?php  echo $uName;?>"  name="username">
  </div>
  <div class="form-group">
    <label for="user_mobile">User Phone</label>
    <input type="tel" class="form-control" value="<?php  echo $uMobile;?>"  name="usermob">
  </div>
  <div class="form-group">
    <label for="user_address">User Address</label>
    <input type="text" class="form-control" value="<?php  echo $uAddress;?>"  name="useradd">
  </div>
  <div class="form-group">
    <label for="user_email">User Email</label>
    <input type="text" class="form-control" value="<?php  echo $uEmail;?>"  name="useremail">
  </div>

  <button type="submit" name="updatee" class="btn btn-primary">Update data</button>



  </form>
</div>
</div>

</div>

</body>
</html>



    

