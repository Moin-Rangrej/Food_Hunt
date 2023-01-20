<?php
//database connection  file
include('connection.php');
//Code for deletion
if(isset($_GET['user_id']))
{
$rid=intval($_GET['user_id']);
$sql=mysqli_query($con,"delete from tblcustomer where fld_cust_id=$rid");
echo "<script>alert('Data deleted');</script>"; 
echo "<script>window.location.href = 'dashboard.php'</script>";     
} 
?>