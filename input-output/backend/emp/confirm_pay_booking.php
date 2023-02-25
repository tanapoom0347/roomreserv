<?php require'header.php';require'../../../public/switch.php';?>
<?php 
	if(isset($_POST['book_id'])){
		$book_id = $_POST['book_id'];
		$sql=" UPDATE book SET";
		$sql.=" book_status_deposit = '5' ";
		$sql.=", book_status_pay = '2' ";
		$sql.=" WHERE book_id = '$book_id' ";
		if($db->query($sql)==TRUE)
		{
			alert_message('บันทึกการชำระรหัสการจอง '.$book_id.' สำเร็จ');
			goto_url('show_book.php');
		}
		else
		{
			echo $sql;
		}
	}
?>
<?php 
if(isset($_GET['id'])){
	$book_id = $_GET['id'];
}
?>
<div align="center">
<h1>การรับชำระการจอง</h1><p></p>
<table border="1">
	<?php 
		$str1 = "select * from book where book_id = '".$book_id."' ";
		$res1 = $db->query($str1);
		$row1 = $res1->fetch_assoc();
		$str2 = "select * from customer where cus_id = '".$row1["cus_id"]."' ";
		$res2 = $db->query($str2);
		$row2 = $res2->fetch_assoc();
		$str3 = "select * from customer where cus_id = '".$row1["cus_id_2"]."' ";
		$res3 = $db->query($str3);
		$row3 = $res3->fetch_assoc();
	?>
	<tbody align="center">
		<tr>
			<td width="300">รหัสการจอง</td>
			<td width="300">BKN-<?=$book_id?></td>
		</tr>
		<tr>
			<td width="300">รหัสผู้จอง</td>
			<td width="300"><?=$row1['cus_id']?></td>
		</tr>
		<tr>
			<td width="300">ชื่อผู้จอง</td>
			<td width="300"><?=$row2['cus_name']?></td>
		</tr>
		<tr>
			<td width="300">เบอร์โทรศัพท์</td>
			<td width="300"><?=$row2['cus_phone']?></td>
		</tr>
		<tr>
			<td width="300">วันที่กำหนดเข้าพัก</td>
			<td width="300"><?=dmy($row1['book_scheduled'])?></td>
		</tr>
		<tr>
			<td width="300">รหัสผู้เข้าพัก</td>
			<td width="300"><?=$row3['cus_id']?></td>
		</tr>
		<tr>
			<td width="300">ชื่อผู้เข้าพัก</td>
			<td width="300"><?=$row3['cus_name']?></td>
		</tr>
	</tbody>
</table><br>

<form method="post">
	<table border="1">
		<tbody align="center">
			<tr>
				<input type="hidden" name="book_id" value="<?=$row1['book_id']?>">
				<td width="300" style='color:blue;'>ราคารวม</td>
				<td width="300" style='color:blue;'><?=number_format($row1['book_total'],2)?> บาท</td>
			</tr>
			<tr>
				<td style='color:red;'>ชำระแล้ว</td>
				<td style='color:red;'><?=number_format($row1['book_deposit'],2)?>  บาท</td>
			</tr>
			<tr>
				<td style='color:green;'>ยอดชำระสุทธิ</td>
				<td style='color:green;'><?=number_format($row1['book_deposit'],2)?>  บาท</td>
			</tr>
			<tr>
	<td colspan="2">
		<input class="btn btn-success" type="submit" onclick="return confirm('ต้องการบันทึกใช่หรือไม่?')" name="submit" value="บันทึก">
		<a class="btn btn-secondary" href="confirm_pay_booking.php?id=<?=$row1['book_id']?>">ล้างค่า</a>
		<a class="btn btn-danger" href="show_book.php">ยกเลิก</a>
	</td>
</tr>
		</tbody>
	</table>
</form>

</div>

</body>
</html>