<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from book where (book_id LIKE '%$search%') and (book_status_deposit != 1) and (book_status_deposit != 5) and (book_status_deposit != 6)";
	}
	else{
		$sql="select * from book (book_status_deposit != 1) and (book_status_deposit != 5) and (book_status_deposit != 6)";
	}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$sql2="SELECT * FROM customer WHERE cus_id = '".$row["cus_id"]."' ";
			$result2=$db->query($sql2);
			$row2=$result2->fetch_assoc();
			$output .= '

		<tr>
			<td>BKN-'.$row['book_id'].'</td>
			<td>'.dmy($row['book_date']).'</td>
			<td>'.$row['cus_id'].'</td>
			<td>'.$row2['cus_name'].'</td>
			<td>'.$row2['cus_phone'].'</td>
			<td><a class="btn btn-success" href="save_servicecost.php?book_id='.$row['book_id'].'&rate=1">เลือก</a></td>
		</tr>

			';
		}
		echo $output;
	}

?>