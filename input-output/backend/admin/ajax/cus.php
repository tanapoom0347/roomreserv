<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from customer where (cus_id LIKE '%$search%') 
		OR (cus_citizenid LIKE '%$search%') 
		OR (cus_name LIKE '%$search%') 
		OR (cus_phone LIKE '%$search%') 
		OR (cus_email LIKE '%$search%') 
		ORDER BY cus_id ASC LIMIT 0, 4";
	}
	else{
		$sql="select * from customer";
	}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$output .= '

		<tr height="70">
			<td>'.$row['cus_id'].'</td>
			<td align="left">&nbsp;'.$row['cus_name'].'</td>
			<td>'.$row['cus_citizenid'].'</td>
			<td align="left">&nbsp;'.$row['cus_address'].'</td>
			<td>'.$row['cus_email'].'</td>
			<td>'.dmy($row['cus_birthday']).'</td>
			<td>'.$row['cus_phone'].'</td>
			<td>'.status_cus($row['cus_status']).'</td>
			<td>'.type_cus($row['cus_type']).'</td>
			<td><a class="btn btn-danger" href="show_cus.php?id='.$row['cus_id'].'" onclick="return confirm("ต้องการลบข้อมูลลูกค้าใช่หรือไม่?")">ลบ</a></td>
			<td><a class="btn btn-primary" href="edit_cus.php?id='.$row['cus_id'].'">แก้ไข</a></td>
		</tr>

			';
		}
		echo $output;
	}

?>