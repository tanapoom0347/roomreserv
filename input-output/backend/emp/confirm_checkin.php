<?php require'header.php';require'../../../public/switch.php';?>

<?php 
	if(isset($_POST['submit']))
	{
		$book_id = $_POST['book_id'];
		$cus_id_2 = $_POST['cus_id_2'];
		$sql=" UPDATE book SET";
		$sql.=" book_status_deposit = '4' ";
		$sql.=", cus_id_2 = '$cus_id_2' ";
		$sql.=" WHERE book_id = '$book_id' ";
		$nowdate = date("Y-m-d H:i:s");
		$db->query("UPDATE booklist SET booklist_checkin = '$nowdate' where book_id = '$book_id'");
		if($db->query($sql)==TRUE)
		{
			alert_message('บันทึกการเข้าพักรหัสการจอง '.$book_id.' สำเร็จ');
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
<h1>บันทึกการเข้าพัก</h1><p></p>
<table border="1">
	<?php 
		$str1 = "select * from book where book_id = '".$book_id."' ";
		$res1 = $db->query($str1);
		$row1 = $res1->fetch_assoc();
		$str2 = "select * from customer where cus_id = '".$row1["cus_id"]."' ";
		$res2 = $db->query($str2);
		$row2 = $res2->fetch_assoc();
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
	</tbody>
</table>

<table align="center" width=""  border="1">
  <tr>
    <td align="center" width="90">รหัสห้องพัก</td>
    <td align="center" width="200">ชื่อห้อง</td>
    <td align="center" width="120">ผู้ใหญ่(คน)</td>
    <td align="center" width="120">เด็ก(คน)</td>
  </tr>
<h4 align="center" style="color:;">รายละเอียด</h4>
<?php
$a=1;
$sqlc = "SELECT * FROM booklist WHERE book_id = '".$_GET["id"]."' ";
$resultc = $db->query($sqlc);
while($rowc=$resultc->fetch_assoc())
{
    $sqld = "SELECT * FROM room WHERE room_id = '".$rowc["room_id"]."' ";
    $resultd = $db->query($sqld);
    $rowd = $resultd->fetch_assoc();
    ?>
    <tr>
      <td align="center"><?=$rowd["room_id"]?></td>
    <td align="center"><?=$rowd["room_name"];?></td>
    <td align="center"><?=$rowc["booklist_numadults"];?></td>
    <td align="center"><?=$rowc["booklist_numchild"];?></td>
    </tr>
    <?php
 }?>
</table><br>

<form method="post">
	<table border="1">
		<tbody align="center">
			<tr>
				<td width="300">รหัสผู้เข้าพัก</td>

<?php 
	if(isset($_GET['cus_id_2'])){
		$cus_id_2 = $_GET['cus_id_2'];
		$sql = "select * from customer where cus_id = '".$cus_id_2."' ";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
?>
				<td width="300"><?=$row['cus_id']?></td>
			</tr>
			<tr>
				<input type="hidden" name="book_id" value="<?=$book_id?>">
				<input type="hidden" name="cus_id_2" value="<?=$row['cus_id']?>">
				<td width="300">ชื่อผู้เข้าพัก</td>
				<td width="300"><?=$row['cus_name']?></td>
			</tr>
<?php } 
	else {?>
	<td width="300"><a class="btn btn-success" href="choose_cus_checkin.php?id=<?=$row1['book_id']?>">เลือก</a></td><tr>
<?php }?>
	<td colspan="2">
		<input
		<?php if($_GET['cus_id_2']==NULL)echo "disabled";?>
		 class="btn btn-success" type="submit" onclick="return confirm('ต้องการบันทึกใช่หรือไม่?')" name="submit" value="บันทึก">
		<a class="btn btn-secondary" href="confirm_checkin.php?id=<?=$row1['book_id']?>">ล้างค่า</a>
		<a class="btn btn-danger" href="show_book.php">ยกเลิก</a>
	</td>
		</tbody>
	</table>
</form>


</div>



</body>
</html>