<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from customer where (cus_id LIKE '%$search%') 
		OR (cus_name LIKE '%$search%') 
		OR (cus_phone LIKE '%$search%')";
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

		<tr>
			<td>'.$row['cus_id'].'</td>
			<td>'.$row['cus_name'].'</td>
			<td>'.$row['cus_phone'].'</td>
			<td><a class="btn btn-success" href="save_booking.php?cus_id='.$row['cus_id'].'">เลือก</a></td>
		</tr>

			';
		}
		echo $output;
	}

?>