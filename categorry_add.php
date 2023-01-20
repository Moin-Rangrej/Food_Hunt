<?php include("connection.php");?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Category Table</title>
  </head>
  <body>
            <div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
		<div class="col-md-4">
        <?php
        error_reporting(0);
            if (isset($_POST['submit'])) {
               $cat = $_POST['category_name'];
               $food = $_POST['category'];

               $sql = "insert into tblcuisine(Cuisine_name,FoodCategory_Id) values('$cat','$food')";
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
        <div class="col">
            <form action="" method="post">
            <div class="form-group">    
                <label for="">Cuisine Name:</label>
                <input type="text" name="category_name" class="form-control"/>
            </div>

            <div class="form-group">    
                <label for="">Category Name:</label>
                <select name="category" id="" class="form-control">
                    <option value="1">vegetarian</option>
                    <option value="2">Non-vegetarian</option>
                </select>
            </div>
            
            <div class="for-group">
                <input type="submit" name="submit" value="Add cuisine" class="btn btn-success"/>
            </div>
  
            </form>
			
			</div>
        </div>
    </div>             
</div> 
<!-- Table Panel -->
<br><br><br>
<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Cuisine_Name</th>
									<th class="text-center">FoodCategory_Id</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php
					  if($query=mysqli_query($con,"SELECT * FROM tblcuisine order by cuisine_id asc"))
					  {
						  if(mysqli_num_rows($query))
						  {
						 while($row=mysqli_fetch_array($query))
						 {
							 
					?>
			     <tr>
				 				 
				<td style="width:150px;"><?php  echo $row['Cuisine_name']."<br>";?></td>
				<td align="center" style="width:150px;"><?php  echo $row['FoodCategory_Id']."<br>";?></td>
				<td align="center" style="width:150px;">
				
				<a href="Category_delete_food.php?Delete_cat_id=<?php echo $row['cuisine_id'];?>"><button type="button" class="btn btn-warning">Delete </button></a>
				
				<a href="Category_update_food.php?Update_cat_id=<?php echo $row['cuisine_id'];?>"><button type="button" class="btn btn-danger">Update </button></a>
				
				</td>
				</tr>
				
				<?php 
					
                    					
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
			</div>
			<!-- Table Panel --> 

        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>




