<?php require'../../../../conn.php';require'../../../../public/switch.php'; ob_start();session_start();
	$output = '';
	if(isset($_POST['query'])){
		$id2=$_POST['id3'];
		$search=$_POST['query'];
		$sql="select * from customer where (cus_id LIKE '%$search%') 
		OR (cus_name LIKE '%$search%') 
		OR (cus_phone LIKE '%$search%')";
	}
	else{
		$sql="select * from customer";
	}

	$res=$db->query($sql);
	$id2 = $_GET['id'];
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
			<td><a class="btn btn-success" href="confirm_checkin.php?id='.$_SESSION['temp_id1'].'&cus_id_2='.$row['cus_id'].'">เลือก</a></td>
		</tr>

			';
		}
		echo $output;
	}

?>