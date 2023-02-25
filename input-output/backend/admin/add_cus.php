<?php require'header.php';
if(isset($_POST['submit'])){
	$check = $_POST['cus_citizenid'];
    $sql="SELECT * FROM customer WHERE cus_citizenid='$check'";
    $result = $db->query($sql);
    $numrows = $result->num_rows;
    if($numrows>=1){
      echo "<script>";
      echo "alert('รหัสบัตรประชาขนซ้ำ กรุณาเปลี่ยนเลขบัตรประชาชน');";
      echo "window.history.back();";
      echo "</script>";
    }
    else {
$cus_citizenid=$_POST['cus_citizenid'];
$cus_name=$_POST['cus_name'];
$cus_address=$_POST['cus_address'];
$cus_phone=$_POST['cus_phone'];
$cus_birthday=$_POST['cus_birthday'];
$cus_email=$_POST['cus_email'];
$cus_status=$_POST['cus_status'];
$cus_type=$_POST['cus_type'];
$sql=" insert into customer(cus_citizenid,cus_username,cus_name,cus_address,cus_phone,cus_birthday,cus_password,cus_email,cus_status,cus_type)";
$sql.=" values ('$cus_citizenid','$cus_citizenid','$cus_name','$cus_address','$cus_phone','$cus_birthday','$cus_citizenid','$cus_email','$cus_status','$cus_type')";
if($db->query($sql)==true){
	$last_id = $db->insert_id;
alert_message('เพิ่มข้อมูลสำเร็จ รหัสลูกค้า : '.$last_id);
goto_url('show_cus.php');}
else{alert_message('บันทึกข้อมูลไม่สำเร็จ');echo $sql;}}}?>
<h1 align="center">เพิ่มข้อมูลลูกค้า</h1><p></p>
<form method="post" enctype="multipart/form-data" onsubmit="return confirm('ต้องการเเพิ่มข้อมูลลูกค้าใช่หรือไม่?');">
	<table align="center" border="1" width="550">
		<tr>
			<td width="125" align="right">ชื่อลูกค้า<span style="color:red">*</span></td>
			<td><input type="text" name="cus_name" size="30" maxlength="30" required>&nbsp;<span style="color:red">(ไม่เกิน50ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">เลขบัตรประชาชน<span style="color:red">*</span></td>
			<td><input type="text" onkeypress="validate(event)" name="cus_citizenid" size="13" maxlength="13" required>&nbsp;<span style="color:red">(เลขบัตรประชาชน13หลัก)</span></td>
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
			<td><textarea name="cus_address" cols="30" rows="5"></textarea></td>
		</tr>
		<tr>
			<td align="right">เบอร์โทรศัพท์</td>
			<td><input type="text" name="cus_phone" size="15" maxlength="15"></td>
		</tr>
		<tr>
			<td align="right">วันเกิด</td>
			<td><input type="date" min="1950-01-01" max="2007-12-31" name="cus_birthday"></td>
		</tr>
		<tr>
			<td align="right">อีเมล<span style="color:red">*</span></td>
			<td><input type="email" name="cus_email" size="30" maxlength="30" required>&nbsp;<span style="color:red">(ไม่เกิน30ตัวอักษร)</span></td>
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
			<input class="btn btn-secondary" type="reset" name="reset" value="ล้างค่า">&nbsp;&nbsp;
			<a class="btn btn-danger" href="show_cus.php">ยกเลิก</a>
		</td></tr>
	</table>
</form>
</body>
</html>