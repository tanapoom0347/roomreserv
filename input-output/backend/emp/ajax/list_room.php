<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from room where (room_id LIKE '%$search%') OR (room_name LIKE '%$search%') OR 
		(room_rate LIKE '%$search%') ORDER BY room_id ASC LIMIT 0, 3";
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
				<td><div align="center">'.$row['room_id'].'</div></td>
				<td><div align="center"><img src="../../../img/room/'.$row['room_picture'] .'" width="150" height="150" /></div></td>
		        <td><div align="center">'.$row['room_name'] .'</div></td>
		        <td><div align="center">'.number_format($row['room_rate'],2) .'</div></td>
		        <td><div align="center">'.type_room($row['room_category']).'</div></td>
		        <td><div align="center">'.$row['room_bed'].' ท่าน</div></td>
		        <td><div align="center"><a class="btn btn btn-outline-success" href="search_room.php" role="button">เลือก</a></div></td>
			</tr>

			';
		}
		echo $output;
	}
?>