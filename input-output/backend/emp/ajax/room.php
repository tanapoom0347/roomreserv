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
				<td>'.$row['room_id'].'</td>
				<td><img src="../../../img/room/'.$row['room_picture'].'" width="90" height="90"/></td>
				<td>'.$row['room_name'].'</td>
				<td>'.type_room($row['room_category']).'</td>
				<td>'.number_format($row['room_rate'],2).'</td>
				<td>'.$row['room_bed'].'</td>
				<td>'.number_format($row['room_price'],2).'</td>
				<td>'.status_room($row['room_statsv']).'</td>
				<td><a class="btn btn-danger" href="show_room.php?id='.$row['room_id'].'" onclick="return confirm("ต้องการลบข้อมูลห้องพักใช่หรือไม่?")">ลบ</a></td>
				<td><a class="btn btn-primary" href="edit_room.php?id='.$row['room_id'].'">แก้ไข</a></td>
			</tr>

			';
		}
		echo $output;
	}
?>