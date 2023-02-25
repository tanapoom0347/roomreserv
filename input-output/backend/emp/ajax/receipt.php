<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from receipt where (receipt_id LIKE '%$search%') 
		
		ORDER BY receipt_id DESC LIMIT 0, 7";
	}
	else{
		$sql="select * from receipt";
	}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$sql2 = "select * from customer where cus_id = '".$row["cus_id"]."'";
			$res2 = $db->query($sql2);
			$row2 = $res2->fetch_assoc();
			$output .= '

			<tr>
				<td align="center"><a href="show_receipt_detail.php?id='.$row["receipt_id"].'">RC-'.$row["receipt_id"].'</a></td>
			    <td align="center">'.$row["cus_id"].'</td>
			  	<td align="center">'.$row2["cus_name"].'</td>
			    <td align="center">'.$row2["cus_phone"].'</td>
			    <td align="center">'.dmy($row["receipt_outdate"]).'</td>
			  	<td align="right">'.number_format($row["receipt_net"]+$row["receipt_discount"],2).'&nbsp;&nbsp;</td>
      			<td align="right">'.number_format($row["receipt_discount"],2).'&nbsp;&nbsp;</td>
      			<td align="right">'.number_format($row["receipt_net"],2).'&nbsp;&nbsp;</td>
			  	<td align="center">'.status_receipt($row["receipt_status"]).'</td>
			      ';
			     if($row["receipt_status"]==0) 
			     	$output.='<td align="center"><a class="btn btn-success" href="pay_receipt.php?id='.$row["receipt_id"].'">ชำระ</a></td> ';
			     else $output.=' <td></td>';
			     if($row["receipt_status"]==1) 
			     	$output.='<td align="center"><a class="btn btn-primary" href="bill_receipt.php?id='.$row["receipt_id"].'" target="_blank">พิมพ์</a></td> ';
			     else $output.=' <td></td>
			</tr>

			';
		}
		echo $output;
	}
?>