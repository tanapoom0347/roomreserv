<?php require'header.php';
if(isset($_POST['submit'])){
$sql=" UPDATE customer SET";
$sql.=" cus_citizenid='".$_POST['cus_citizenid']."'";
$sql.=",cus_name='".$_POST['cus_name']."'";
$sql.=",cus_address='".$_POST['cus_address']."'";
$sql.=",cus_phone='".$_POST['cus_phone']."'";
$sql.=",cus_birthday='".$_POST['cus_birthday']."'";
$sql.=",cus_email='".$_POST['cus_password']."'";
$sql.=",cus_email='".$_POST['cus_email']."'";
$sql.=" WHERE cus_id='".$_POST['cus_id']."'";
if($db->query($sql)==true){
alert_message('รหัสลูกค้า '.$_POST['cus_id'].' แก้ไขข้อมูลสำเร็จ');
goto_url('home.php');
//echo $sql;
}
else{alert_message('บันทึกข้อมูลไม่สำเร็จ');echo $sql;}}
if(isset($_GET['id'])){
$sql2="SELECT * FROM customer WHERE cus_id = '".$_GET['id']."' ";
$result2=$db->query($sql2);
$row2=$result2->fetch_assoc();
$result2->free();}?>
<h1 align="center">แก้ไขข้อมูลผู้ใช้</h1><p></p>
<form method="post" enctype="multipart/form-data" onsubmit="return confirm('ต้องการแก้ไขข้อมูลผู้ใช้ใช่หรือไม่?');">
	<table align="center" border="1" width="550">
		<thead>
			<tr>
				<th colspan="2">รหัสลูกค้า <?=$row2['cus_id']?></th>
			</tr>
		</thead>
		<input type="hidden" name="cus_id" value="<?=$row2['cus_id']?>">
		<tr>
			<td width="130" align="right">ชื่อผู้ใช้<span style="color:red"></span></td>
			<td><input disabled type="text" name="cus_username" size="20" minlength="6" maxlength="20" required value="<?=$row2['cus_username']?>">&nbsp;<span style="color:red"></span></td>
		</tr>
		<tr>
			<td align="right">รหัสผ่าน<span style="color:red">*</span></td>
			<td><input id="password" type="password" name="cus_password" size="20" minlength="6" maxlength="20" required value="<?=$row2['cus_password']?>">&nbsp;<span style="color:red">(6-20ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">ยืนยันรหัสผ่าน<span style="color:red">*</span></td>
			<td><input id="password_confirm" oninput="check(this)" type="password" name="pconfirm" size="20" minlength="6" maxlength="20" required value="<?=$row2['cus_password']?>">&nbsp;<span style="color:red">(6-20ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">ชื่อลูกค้า<span style="color:red">*</span></td>
			<td><input type="text" name="cus_name" size="30" maxlength="50" required value="<?=$row2['cus_name']?>">&nbsp;<span style="color:red">(ไม่เกิน50ตัวอักษร)</span></td>
		</tr>
		<tr>
			<td align="right">เลขบัตรประชาชน<span style="color:red"></span></td>
			<td><input type="text" name="cus_citizenid" size="13" minlength="13" maxlength="13"
			 onkeypress="validate(event)"
			 value="<?=$row2['cus_citizenid']?>">&nbsp;<span style="color:red"></span></td>
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
			<td><input type="date" name="cus_birthday" value="<?=$row2['cus_birthday']?>" min="1955-01-01" max="2007-12-31"></td>
		</tr>
		<tr>
			<td align="right">อีเมล<span style="color:red">*</span></td>
			<td><input type="email" name="cus_email" size="30" maxlength="30" required value="<?=$row2['cus_email']?>">&nbsp;<span style="color:red">(ไม่เกิน30ตัวอักษร)</span></td>
		</tr>
		<tr height="45"><td colspan="2" align="center">
			<input class="btn btn-success" type="submit" name="submit" value="บันทึก">&nbsp;&nbsp;
			<input class="btn btn-secondary" type="reset" name="reset" value="คืนค่า">&nbsp;&nbsp;
			<input class="btn btn-danger" type="button" name="button" value="ยกเลิก" onclick="if(window.confirm('ท่านต้องการออกจากหน้านี้หรือไม่?')==true)window.location='home.php';">
		</td></tr>
	</table>
</form>
<script language='javascript' type='text/javascript'>
    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('Password Must be Matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
</script>
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