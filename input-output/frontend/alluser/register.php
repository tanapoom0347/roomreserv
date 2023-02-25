<?php require'header.php';
	if(isset($_POST['submit'])){
    $username = $_POST['cus_username'];
    $sql="SELECT * FROM customer WHERE cus_username='$username'";
    $result = $db->query($sql);
    $numrows = $result->num_rows;
    if($numrows>=1){
      echo "<script>";
      echo "alert('ชื่อผู้ใช้ซ้ำ กณุราเปลี่ยนชื่อผู้ใช้ใหม่');";
      echo "window.history.back();";
      echo "</script>";
    }
    else {
		$cus_citizenid=$_POST['cus_citizenid'];
		$cus_username=$_POST['cus_username'];
		$cus_name=$_POST['cus_name'];
		$cus_address=$_POST['cus_address'];
		$cus_phone=$_POST['cus_phone'];
		$cus_password=$_POST['cus_password'];
		$cus_birthday=$_POST['cus_birthday'];
		$cus_email=$_POST['cus_email'];
		$sql=" insert into customer(cus_citizenid,cus_username,cus_name,cus_address,cus_phone,cus_password,cus_birthday,cus_email,cus_status,cus_type)";
		$sql.=" values ('$cus_citizenid','$cus_username','$cus_name','$cus_address','$cus_phone','$cus_password','$cus_birthday','$cus_email','1','1')";
		if($db->query($sql)==true){
      $insertid = $db->insert_id;
      $db->close();
			alert_message('สมัครสมาชิกสำเร็จรหัส '.$insertid);
			goto_url('login.php');/*echo $sql;*/
		}else{alert_message('บันทึกข้อมูลไม่สำเร็จ');echo $sql;}}}?>
<h1 style="text-align: center"><span style="color: blue" >สมัครสมาชิก</span></h1>
<form method="post" onsubmit="return confirm('ต้องการบันทึกใช่หรือไม่?');">
  <table border="1" align="center">
    <tr valign="baseline">
      <td width="104" align="right" nowrap="nowrap">ชื่อผู้ใช้:</td>
      <td width="440"><input name="cus_username" type="text" value="" size="20" minlength="6" required="required"/><span style="color: #F00">*(6-20ตัวอักษร)</span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">รหัสผ่าน:</td>
      <td><input id="password" name="cus_password" type="password" value="" size="20" minlength="6" required="required"/><span style="color: #F00">*(6-20ตัวอักษร)</span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ยืนยันรหัสผ่าน:</td>
      <td>
      <input id="password_confirm" oninput="check(this)" name="textfield" type="password" size="20" minength="6" required="required"/><span style="color: #F00">*(6-20ตัวอักษร)</span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ชื่อ-นามสกุล:</td>
      <td><input name="cus_name" type="text" value="" size="32" maxlength="50" required="required"/><span style="color: #F00">*(ไม่เกิน50ตัวอักษร)</span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">เลขบัตรประชาชน:</td>
      <td><input name="cus_citizenid" type="text" value="" size="13" minlength="13" maxlength="13"
       onkeypress="validate(event)"
      /><span style="color: #F00"></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">ที่อยู่:</td>
      <td><textarea name="cus_address" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">เบอร์โทรศัพท์:</td>
      <td><input name="cus_phone" type="text" value="" size="10" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">วันเกิด:</td>
      <td><input type="date" name="cus_birthday" min="1955-01-01" max="2007-12-31" class="datepicker" value="" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">อีเมล:</td>
      <td><input name="cus_email" type="email" value="" size="32" maxlength="30" required="required"/><span style="color: #F00">*(ไม่เกิน30ตัวอักษร)</span></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" style="text-align: center">
        <input class="btn btn-success" type="submit" name="submit" value="บันทึก"/>
        <input class="btn btn-secondary" type="reset" name="Reset" id="button" value="ล้างค่า"/>
        <input class="btn btn-danger" name="button2" type="button" id="button2" onclick="window.location='../../../';" value="ยกเลิก"/></td>
    </tr>
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