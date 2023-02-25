<?php require'header.php';require'../../../public/Upload.php';
if(isset($_POST['submit']))
{$emp_id=$_POST['emp_id'];
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
if($_FILES['emp_picture']['name']!='')
{$sql=" UPDATE employee SET";
$sql.=" emp_citizenid = '$emp_citizenid' ";
$sql.=" ,emp_name = '$emp_name' ";
$sql.=" ,emp_address = '$emp_address' ";
$sql.=" ,emp_phone = '$emp_phone' ";
$sql.=" ,emp_birthday = '$emp_birthday' ";
$sql.=" ,emp_salary = '$emp_salary' ";
$sql.=" ,emp_email = '$emp_email' ";
$sql.=" ,emp_status = '$emp_status' ";
$sql.=" ,emp_level = '$emp_level' ";
$sql.=" ,emp_picture = '$emp_picture' ";
$sql.=" WHERE emp_id = '$emp_id' ";}
else{$sql=" UPDATE employee SET";
$sql.=" emp_citizenid = '$emp_citizenid' ";
$sql.=" ,emp_name = '$emp_name' ";
$sql.=" ,emp_address = '$emp_address' ";
$sql.=" ,emp_phone = '$emp_phone' ";
$sql.=" ,emp_birthday = '$emp_birthday' ";
$sql.=" ,emp_salary = '$emp_salary' ";
$sql.=" ,emp_email = '$emp_email' ";
$sql.=" ,emp_status = '$emp_status' ";
$sql.=" ,emp_level = '$emp_level' ";
$sql.=" WHERE emp_id = '$emp_id' ";}
if($db->query($sql)==true){
alert_message('แก้ไขข้อมูลสำเร็จ รหัสพนักงาน : '.$_POST['emp_id']);
goto_url('show_emp.php');}}
if(isset($_GET['id'])){$id=$_GET['id'];
$sql2="SELECT * FROM employee WHERE emp_id = '$id' ";
$result2=$db->query($sql2);
$row2=$result2->fetch_assoc();
$result2->free();}?>
<h1 align="center">แก้ไขข้อมูลพนักงาน</h1><p></p>
<form method="post" enctype="multipart/form-data" onsubmit="return confirm('ท่านต้องการแก้ไขข้อมูลพนักงานใช่หรือไม่?');">
	<table align="center" border="1" width="550">
		<thead>
			<tr>
				<th colspan="2">รหัสพนักงาน <?=$row2['emp_id']?></th>
			</tr>
		</thead>
		<tbody>
		<input type="hidden" name="emp_id" value="<?=$row2['emp_id']?>">
		<tr>
			<td width="120" align="right">ชื่อพนักงาน<span style="color:red">*</span></td>
			<td><input type="text" name="emp_name" size="30" maxlength="50" required value="<?=$row2['emp_name']?>">&nbsp;<span style="color:red">(ไม่เกิน50ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">บัตรประชาชน<span style="color:red">*</span></td>
			<td><input type="text" onkeypress="validate(event)" name="emp_citizenid" size="13" maxlength="13"
			 onkeypress="validate(event)"
			 required value="<?=$row2['emp_citizenid']?>">&nbsp;<span style="color:red">(เลขบัตรประชาชน13หลัก)</span></td>
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
			<td><textarea name="emp_address" cols="30" rows="5"><?=$row2['emp_address']?></textarea></td>
		</tr>
		<tr>
			<td align="right">เบอร์โทรศัพท์<span style="color:red">*</span></td>
			<td><input type="text" name="emp_phone" size="11" maxlength="11" required value="<?=$row2['emp_phone']?>">&nbsp;<span style="color:red"></span></td>
		</tr>
		<tr>
			<td align="right">วันเกิด</td>
			<td><input type="date" name="emp_birthday" value="<?=$row2['emp_birthday']?>" min="1955-01-01" max="2002-12-31"></td>
		</tr>
		<tr>
			<td align="right">เงินเดือน<span style="color:red"></span></td>
			<td><input type="text" name="emp_salary" size="5" maxlength="5" value="<?=$row2['emp_salary']?>">&nbsp;<span style="color:red">(ไม่เกิน5หลัก)</span></td>
		</tr>
		<tr>
			<td align="right">อีเมล<span style="color:red">*</span></td>
			<td><input type="email" name="emp_email" size="30" maxlength="30" required value="<?=$row2['emp_email']?>">&nbsp;<span style="color:red">(ไม่เกิน30ตัวอักษร)</span></td>
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
			<td><?php if($row2['emp_picture']!=''){echo '<img src="../../../img/emp/'.$row2['emp_picture'].'" width="150" height="150"/><br>';}?>

				<input type="file" name="emp_picture"></td>
		</tr>
		<tr height="45"><td colspan="2" align="center">
			<input class="btn btn-success" type="submit" name="submit" value="บันทึก">&nbsp;&nbsp;
			<input class="btn btn-secondary" type="reset" name="reset" value="คืนค่า">&nbsp;&nbsp;
			<a class="btn btn-danger" href="show_emp.php">ยกเลิก</a>
		</td></tr>
		</tbody>
	</table>
</form>
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
</body>
</html>