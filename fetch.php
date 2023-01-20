<?php
include("connection.php");
$output = '';
if(isset($_POST["query"]) != ""){
	if(isset($_POST["query"]))
	{
		$search = mysqli_real_escape_string($con, $_POST["query"]);
		
		$query = "SELECT * FROM tblvendor 
		WHERE restaurantName LIKE '%".$search."%' 
		OR restaurantAddress LIKE '%".$search."%' ";
	}
	else
	{
		$query = "SELECT * FROM tblvendor ";
	}
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)
	{
		$output .= '';
		while($row = mysqli_fetch_array($result))
		{
			$vendor_id= $row['fldvendor_id'];
			$output .= '
				<tr style="width:100%;background:white; border:1px solid black;">
					<td style="border-bottom:solid 1px black;padding:10px; width: 600px;">
						<a href="new_search1.php?vendor_id='.$vendor_id.'" style="text-decoration:none;font-weight:bold; color:black;padding:10px;">'.$row["restaurantName"].'</a>
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