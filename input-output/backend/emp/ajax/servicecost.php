<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from servicecost where (receipt_id IS NULL) AND (svcost_id LIKE '%$search%') ORDER BY svcost_id DESC LIMIT 0, 6";
	}
	else{
		$sql="select * from servicecost where (receipt_id IS NULL)";
	}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$sql1 = "select * from book where book_id = '".$row["book_id"]."' ";
		    $result1 = $db->query($sql1);
		    $row1 = $result1->fetch_assoc();
			$sql2 = "select * from customer where cus_id = '".$row1["cus_id"]."' ";
		    $result2 = $db->query($sql2);
		    $row2 = $result2->fetch_assoc();
			$output .= '

			<tr>
				<td align="center"><a href="show_servicecost_detail.php?id='.$row['svcost_id'].'">SVC-'.$row['svcost_id'].'</a></td>
		  		<td align="center">BKN-'.$row['book_id'].'</td>
		      	<td align="center">'.dmy($row['svcost_date']).'</td>
		  		<td align="center">'.$row2['cus_name'].'</td>
		      	<td align="center">'.$row2['cus_phone'].'</td>
		  		<td align="right">'.number_format($row['svcost_total'],2).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
		  		<td align="right"><font color="red">'.number_format($row['svcost_discount'],2).'</font>&nbsp;</td>
      			<td align="right">'.number_format($row['svcost_net'],2).'&nbsp;</td>
		  		<td align="center">'.status_svcost($row['svcost_status']).'</td>
		      	<td align="center"><a class="btn btn-success" href="cart_receipt.php?svcost_id='.$row['svcost_id'].'">เลือก</a></td>
			</tr>

			';
		}
		echo $output;
	}
?>