<?php require'../../../../conn.php';require'../../../../public/switch.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$c2=$_SESSION["login_cus_id"];
		$sql="select * from book where (cus_id = '$c2') AND (book_id LIKE '%$search%') ORDER BY book_id DESC LIMIT 0, 8";
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

			<tr height="40">
			    <td align="center"><a href="show_book_detail.php?id='.$row["book_id"].'">BKN-'.$row["book_id"].'</a></td>
			    <td align="center">'.$row["book_date"].'</td>
			    <td align="center">'.$row["book_scheduled"].'</td>
			    <td align="center">'.$row["book_adult"].'</td>
			    <td align="center">'.$row["book_child"].'</td>
			    <td align="right">'.number_format($row["book_total"],2).'</td>
			    <td align="right"><font color="blue">'.number_format($row['book_discount'],2).'</font></td>
			    <td align="right">'.number_format($row["book_deposit"],2).'</td>
			    <td align="center">'.status_deposit($row["book_status_deposit"]).'</td>
			    <td align="right"><font color="red">'.number_format($row["book_debt"],2).'&nbsp;&nbsp;</font></td>';
			    if($row['book_status_deposit']==1) {
			    	$output .= '<td align="center"><a class="btn btn-primary" href="confirm_deposit.php?id='.$row["book_id"].'">แจ้งหลักฐาน</a><?php }?></td>';
			    }
			    else {
			    	$output .= '<td></td>';
			    }
			$output .= '
		    </tr>

			';
		}
		echo $output;
	}
?>