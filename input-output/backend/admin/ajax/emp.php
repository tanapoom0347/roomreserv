<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from employee where (emp_name LIKE '%$search%') 
		OR (emp_citizenid LIKE '%$search%') 
		OR (emp_phone LIKE '%$search%') 
		OR (emp_salary LIKE '%$search%') 
		OR (emp_email LIKE '%$search%') 
		OR (emp_id LIKE '%$search%') 
		ORDER BY emp_id ASC LIMIT 0, 4";
	}
	else{
		$sql="select * from employee";
	}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$output .= '

		<tr>
			<td>'.$row["emp_id"].'</td>
			<td><img src="../../../img/emp/'.$row["emp_picture"].'" width="90" height="90"/></td>
			<td>'.$row["emp_name"].'</td>
			<td>'.$row["emp_citizenid"].'</td>
			<td>'.$row["emp_phone"].'</td>
			<td>'.dmy($row["emp_birthday"]).'</td>
			<td>'.number_format($row["emp_salary"],2).'</td>
			<td>'.$row["emp_email"].'</td>
			<td>'.status_emp($row["emp_status"]).'</td>
			<td>'.level_emp($row["emp_level"]).'</td>
			<td><a class="btn btn-danger" href="show_emp.php?id='.$row["emp_id"].'" onclick="return confirm("ต้องการลบข้อมูลพนักงานใช่หรือไม่?")">ลบ</a></td>
			<td><a class="btn btn-primary" href="edit_emp.php?id='.$row["emp_id"].'">แก้ไข</a></td>
		</tr>

			';
		}
		echo $output;
	}
?>