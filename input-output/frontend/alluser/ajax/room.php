<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from room where (room_id LIKE '%$search%') OR (room_name LIKE '%$search%') OR 
		(room_rate LIKE '%$search%') ORDER BY room_id ASC LIMIT 0, 4";
	}
	else{
		$sql="select * from room";
	}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$output .= '

			<tr>
				<td>'.$row["room_id"].'</td>
				<td><img src="../../../img/room/'.$row["room_picture"].'" width="150" height="150"/></td>
				<td>'.$room_name = $row["room_name"].'</td>
				<td>'.type_room($row["room_category"]).'</td>
				<td>'.number_format($row["room_rate"],2).'</td>
				<td>'.$row["room_bed"].'</td>
				<td>'.number_format($row["room_price"],2).'</td>
			</tr>

			';
		}
		echo $output;
	}
?>