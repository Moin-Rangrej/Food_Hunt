<?php
session_start();
include("connection.php");
extract($_REQUEST);

//Code for deletion
$rid=$_GET['cuisine_id'];
if(isset($_GET['cuisine_id']))
{
    if(mysqli_query($con,"delete from tblcuisine where cuisine_id=$rid"))
    {
        echo "<script>alert('Data deleted');</script>"; 
        echo "<script>window.location.href = 'food.php'</script>"; 
    }
    else{
       echo "<script>alert('Failed to delete');</script>"; 
    }
} 
else{
    echo "<script>alert('Not Get Cuisine ID');</script>";    
}
?>