<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="select * from book where (book_id LIKE '%$search%') OR (cus_id LIKE '%$search%') ORDER BY book_id DESC LIMIT 0, 8";
	}
	else{
		$sql="select * from book";
	}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$sql2 = "SELECT * FROM customer WHERE cus_id = '".$row["cus_id"]."' ";
			$result2 = $db->query($sql2);
			$row2 = $result2->fetch_assoc();
			$output .= '

			<tr>
				<td align="center"><a href="show_book_detail.php?id='.$row["book_id"].'">BKN-'.$row["book_id"].'</a></td>
			    <td align="center">'.dmy($row["book_date"]).'</td>
			    <td align="center">'.$row2["cus_id"].'</td>
			    <td align="center">'.$row2["cus_name"].'</td>
			    <td align="center">'.dmy($row["book_scheduled"]).'</td>
			    <td align="right">'.number_format($row["book_total"],2).'</td>
			    <td align="right"><font color="blue">'.number_format($row['book_discount'],2).'</font></td>
			    <td align="right">'.number_format($row["book_deposit"],2).'</td>
			    <td align="center">'.status_deposit($row["book_status_deposit"]).'</td>
			    <td align="right"><font color="red">'.number_format($row["book_debt"],2).'</font></td>
			    <td align="center">'.status_pay($row["book_status_pay"]).'</td>';
			    if($row["book_status_deposit"]==2)
			    	$output.='<td align="center"><a href="../../../img/deposit/'.$row["book_deposit_picture"].'" target="_blank"><img src="../../../img/deposit/'.$row["book_deposit_picture"].'" width="90" height="90"/></a></td>';
			    else $output.='<td></td>';
			    if($row["book_status_deposit"]==2) 
			    	$output.='<td align="center"><a class="btn btn-info" href="?confirmid='.$row["book_id"].'" onclick="return confirm("ต้องการยืนยันหลักฐานใช่หรือไม่?")">ยืนยันหลักฐาน</a></td>';
			    elseif($row["book_status_deposit"]==3) $output.='
			      <td align="center"><a class="btn btn-success" href="confirm_checkin.php?id='.$row["book_id"].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เข้าพัก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>';
			    elseif($row["book_status_deposit"]==4) $output.='
			      <td align="center"></td>';
			    elseif($row["book_status_deposit"]==5) $output.='
			      <td align="center"><a class="btn btn-danger" href="confirm_checkout.php?id='.$row["book_id"].'">&nbsp;&nbsp;&nbsp;ย้ายออก&nbsp;&nbsp;&nbsp;</a></td>';
			    elseif($row["book_status_deposit"]==6) $output.='
			      <td align="center"></td>';
			    else $output.='
			      <td></td>';
			    
			    if(($row["book_status_deposit"]==1)||($row["book_status_deposit"]==2)) $output.='
			      <td align="center"><a class="btn btn-danger" href="JavaScript:if(confirm("ยกเลิกใบจอง") == true){window.location="show_book.php?id='.$row["book_id"].'";}">ยกเลิก</a></td>';
			    elseif($row["book_status_deposit"]==0) $output.='
			      <td align="center"></td>';
			    else $output.='
			      <td  align="center"><a class="btn btn-warning" href="bill_reservation.php?id='.$row["book_id"].'" target="_blank">ใบจอง</a></td>
			</tr>

			';
		}
		echo $output;
	}
?>