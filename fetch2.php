<?php
include("connection.php");
$output = '';
if(isset($_POST["query"]) != ""){
	if(isset($_POST["query"]))
	{
		$search = mysqli_real_escape_string($con, $_POST["query"]);
		
		$query = "SELECT * FROM tbfood 
		WHERE foodname LIKE '%".$search."%'
		OR Cuisines LIKE '%".$search."%' ";
	}
	else
	{
		$query = "SELECT * FROM tbfood ";
	}
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)
	{
		$output .= '';
		while($row = mysqli_fetch_array($result))
		{
			$food_id= $row['food_id'];
			$output .= '
				<tr style="width:100%;background:white; border:1px solid black;">
					<td style="border-bottom:solid 1px black;padding:10px; width: 600px;">
						<a href="searchfood.php?food_id='.$food_id.'" style="text-decoration:none;font-weight:bold; color:black;padding:10px;">'.$row["foodname"].'</a>
					</td>
				</tr>
			';
		}
		echo $output;
	}
	else
	{
		echo 'Data Not Found';
	}
}
?>