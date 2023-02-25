<?php require'header.php';require'../../../public/Upload.php';
if(isset($_POST['submit']))
{
	$check = $_POST['emp_citizenid'];
    $sql="SELECT * FROM employee WHERE emp_citizenid='$check'";
    $result = $db->query($sql);
    $numrows = $result->num_rows;
    if($numrows>=1){
      echo "<script>";
      echo "alert('รหัสบัตรประชาขนซ้ำ กรุณาเปลี่ยนเลขบัตรประชาชน');";
      echo "window.history.back();";
      echo "</script>";
    }
    else {
$emp_citizenid=$_POST['emp_citizenid'];
$emp_name=$_POST['emp_name'];
$emp_address=$_POST['emp_address'];
$emp_phone=$_POST['emp_phone'];
$emp_birthday=$_POST['emp_birthday'];
$emp_salary=$_POST['emp_salary'];
$emp_email=$_POST['emp_email'];
$emp_status=$_POST['emp_status'];
$emp_level=$_POST['emp_level'];
$emp_picture=Uploademp($_FILES['emp_picture']);
$sql=" insert into employee(emp_citizenid,emp_username,emp_name,emp_address,emp_phone,emp_birthday,emp_password,emp_salary,emp_email,emp_status,emp_level,emp_picture)";
$sql.=" values ('$emp_citizenid','$emp_citizenid','$emp_name','$emp_address','$emp_phone','$emp_birthday','$emp_citizenid','$emp_salary','$emp_email','$emp_status','$emp_level','$emp_picture')";
if($db->query($sql)==true){
	$last_id = $db->insert_id;
alert_message('เพิ่มข้อมูลสำเร็จ รหัสพนักงาน : '.$last_id);
goto_url('show_emp.php');/*echo $sql*/;}
else{alert_message('บันทึกข้อมูลไม่สำเร็จ');echo $sql;}}}?>
<h1 align="center">เพิ่มข้อมูลพนักงาน</h1><p></p>
<form method="post" enctype="multipart/form-data" onsubmit="return confirm('ท่านต้องการเพิ่มข้อมูลพนักงานใช่หรือไม่?');">
	<table align="center" border="1" width="550">
		<tr>
			<td width="130" align="right">ชื่อพนักงาน<span style="color:red">*</span></td>
			<td><input type="text" name="emp_name" size="30" minlength="" maxlength="50" required>&nbsp;<span style="color:red">(ไม่เกิน50ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">เลขบัตรประชาชน<span style="color:red">*</span></td>
			<td><input type="text" onkeypress="validate(event)" name="emp_citizenid" size="13" minlength="13" maxlength="13"
			 onkeypress="validate(event)"
			 required>&nbsp;<span style="color:red">(เลขบัตรประชาชน13หลัก)</span></td>
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
			<td><textarea name="emp_address" cols="30" rows="5"></textarea></td>
		</tr>
		<tr>
			<td align="right">เบอร์โทรศัพท์<span style="color:red">*</span></td>
			<td><input type="text" name="emp_phone" size="11" maxlength="11" required>&nbsp;<span style="color:red"></span></td>
		</tr>
		<tr>
			<td align="right">วันเกิด</td>
			<td><input type="date" min="1955-01-01" max="2002-12-31" name="emp_birthday"></td>
		</tr>
		<tr>
			<td align="right">เงินเดือน</td>
			<td><input type="text" name="emp_salary" size="5" maxlength="5">&nbsp;<span style="color:red"></span></td>
		</tr>
		<tr>
			<td align="right">อีเมล<span style="color:red">*</span></td>
			<td><input type="email" name="emp_email" size="30" maxlength="30" required>&nbsp;<span style="color:red">(ไม่เกิน30ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">สถานะทำงาน<span style="color:red">*</span></td>
			<td><select name="emp_status">
				<option value="1">ทำงาน</option>
				<option value="2">ลาออก</option>
			</select></td>
		</tr>
		<tr>
			<td align="right">ระดับ<span style="color:red">*</span></td>
			<td><select name="emp_level">
				<option value="1">พนักงาน</option>
				<option value="2">เจ้าของกิจการ</option>
			</select></td>
		</tr>
		<tr>
			<td align="right">รูปภาพ</td>
			<td><input type="file" name="emp_picture"></td>
		</tr>
		<tr height="45"><td colspan="2" align="center">
			<input class="btn btn-success" type="submit" name="submit" value="บันทึก">&nbsp;&nbsp;
			<input class="btn btn-secondary" type="reset" name="reset" value="ล้างค่า">&nbsp;&nbsp;
			<a class="btn btn-danger" href="show_emp.php">ยกเลิก</a>
		</td></tr>
	</table>
</form>
</body>
</html>