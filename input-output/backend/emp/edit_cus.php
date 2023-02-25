<?php require'header.php';
if(isset($_POST['submit'])){
$sql=" UPDATE customer SET";
$sql.=" cus_citizenid='".$_POST['cus_citizenid']."'";
$sql.=",cus_name='".$_POST['cus_name']."'";
$sql.=",cus_address='".$_POST['cus_address']."'";
$sql.=",cus_phone='".$_POST['cus_phone']."'";
$sql.=",cus_birthday='".$_POST['cus_birthday']."'";
$sql.=",cus_email='".$_POST['cus_email']."'";
$sql.=",cus_status='".$_POST['cus_status']."'";
$sql.=",cus_type='".$_POST['cus_type']."'";
$sql.=" WHERE cus_id='".$_POST['cus_id']."'";
if($db->query($sql)==true){
alert_message('แก้ไขข้อมูลสำเร็จ รหัสลูกค้า : '.$_POST['cus_id']);
goto_url('show_cus.php');}
else{alert_message('บันทึกข้อมูลไม่สำเร็จ');echo $sql;}}
if(isset($_GET['id'])){
$sql2="SELECT * FROM customer WHERE cus_id = '".$_GET['id']."' ";
$result2=$db->query($sql2);
$row2=$result2->fetch_assoc();
$result2->free();}?>
<h1 align="center">แก้ไขข้อมูลลูกค้า</h1><p></p>
<form method="post" enctype="multipart/form-data" onsubmit="return confirm('ต้องการแก้ไขข้อมูลลูกค้าใช่หรือไม่?');">
	<table align="center" border="1" width="550">
		<thead>
			<tr>
				<th colspan="2">รหัสลูกค้า <?=$row2['cus_id']?></th>
			</tr>
		</thead>
		<tbody>
		<input type="hidden" name="cus_id" value="<?=$row2['cus_id']?>">
		<tr>
			<td width="125" align="right">ชื่อลูกค้า<span style="color:red">*</span></td>
			<td><input type="text" name="cus_name" size="30" maxlength="30" required value="<?=$row2['cus_name']?>">&nbsp;<span style="color:red">(ไม่เกิน50ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">เลขบัตรประชาชน<span style="color:red">*</span></td>
			<td><input type="text" onkeypress="validate(event)" name="cus_citizenid" size="13" maxlength="13" required value="<?=$row2['cus_citizenid']?>">&nbsp;<span style="color:red">(เลขบัตรประชาชน13หลัก)</span></td>
<script type="text/javascript">
  function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
		</tr>
		<tr>
			<td align="right" valign="top">ที่อยู่</td>
			<td><textarea name="cus_address" cols="30" rows="5"><?=$row2['cus_address']?></textarea></td>
		</tr>
		<tr>
			<td align="right">เบอร์โทรศัพท์</td>
			<td><input type="text" name="cus_phone" size="15" maxlength="15" value="<?=$row2['cus_phone']?>"></td>
		</tr>
		<tr>
			<td align="right">วันเกิด</td>
			<td><input type="date" name="cus_birthday" value="<?=$row2['cus_birthday']?>"></td>
		</tr>
		<tr>
			<td align="right">อีเมล<span style="color:red">*</span></td>
			<td><input type="email" name="cus_email" size="30" maxlength="30" required value="<?=$row2['cus_email']?>">&nbsp;<span style="color:red">(ไม่เกิน30ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">สถานะทำงาน<span style="color:red">*</span></td>
			<td><select name="cus_status">
				<option value="1">ปกติ</option>
				<option value="2">แบล็คลิสต์</option>
			</select></td>
		</tr>
		<tr>
			<td align="right">ระดับ<span style="color:red">*</span></td>
			<td><select name="cus_type">
				<option value="1">ทั่วไป</option>
				<option value="2">กรุ๊ปทัวร์</option>
			</select></td>
		</tr>
		<tr height="45"><td colspan="2" align="center">
			<input class="btn btn-success" type="submit" name="submit" value="บันทึก">&nbsp;&nbsp;
			<input class="btn btn-secondary" type="reset" name="reset" value="คืนค่า">&nbsp;&nbsp;
			<a class="btn btn-danger" href="show_cus.php">ยกเลิก</a>
		</td></tr>
		</tbody>
	</table>
</form>
</body>
</html>