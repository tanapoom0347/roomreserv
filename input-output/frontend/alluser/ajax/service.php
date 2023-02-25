<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from servicelist where (svlist_id LIKE '%$search%') OR (svlist_name LIKE '%$search%') OR 
		(svlist_price LIKE '%$search%') OR (svlist_place LIKE '%$search%') ORDER BY svlist_id ASC LIMIT 0, 3";
	}
	else{
		$sql="select * from servicelist";
	}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$output .= '

			<tr height="180">
				<td>'.$row["svlist_id"].'</td>
				<td><img src="../../../img/service/'.$row["svlist_picture"].'" width="170" height="170"/></td>
				<td>'.$row["svlist_name"].'</td>
				<td>'.number_format($row["svlist_price"],2).'</td>
				<td>'.$row["svlist_unit"].'</td>
				<td>'.$row["svlist_place"].'</td>
			</tr>

			';
		}
		echo $output;
	}
?>