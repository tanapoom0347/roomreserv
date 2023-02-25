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

			<tr>
				<td>'.$row['svlist_id'].'</td>
				<td><img src="../../../img/service/'.$row['svlist_picture'].'" width="90" height="90"/></td>
				<td>'.$row['svlist_name'].'</td>
				<td>'.number_format($row['svlist_price'],2).'</td>
				<td>'.$row['svlist_unit'].'</td>
				<td>'.$row['svlist_place'].'</td>
				<td>'.status_service($row['svlist_statsv']).'</td>
				<td><a class="btn btn-danger" href="show_service.php?id='.$row['svlist_id'] .'" onclick="return confirm("ต้องการลบข้อมูลบริการใช่หรือไม่?")">ลบ</a></td>
				<td><a class="btn btn-primary" href="edit_service.php?id='.$row['svlist_id'] .'">แก้ไข</a></td>
			</tr>

			';
		}
		echo $output;
	}
?>