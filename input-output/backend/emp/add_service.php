<?php require'header.php';require'../../../public/Upload.php';
if(isset($_POST['submit']))
{$svlist_name=$_POST['svlist_name'];
$svlist_price=$_POST['svlist_price'];
$svlist_unit=$_POST['svlist_unit'];
$svlist_picture=Uploadservice($_FILES['svlist_picture']);
$svlist_place=$_POST['svlist_place'];
$svlist_statsv=$_POST['svlist_statsv'];
$sql=" insert into servicelist(svlist_name,svlist_price,svlist_unit,svlist_picture,svlist_place,svlist_statsv)";
$sql.=" values ('$svlist_name','$svlist_price','$svlist_unit','$svlist_picture','$svlist_place','$svlist_statsv')";
if($db->query($sql)==true){
	$last_id = $db->insert_id;
alert_message('เพิ่มข้อมูลสำเร็จ รหัสรายการบริการ : '.$last_id);
goto_url('show_service.php');}}?>
<h1 align="center">เพิ่มข้อมูลรายการบริการ</h1><p></p>
<form method="post" enctype="multipart/form-data" onsubmit="return confirm('ต้องการเพิ่มข้อมูลรายการบริการใช่หรือไม่?');">
	<table border="1" align="center" width="400">
		<tr>
			<td width="100" align="left">&nbsp;ชื่อบริการ<span style="color:red">*</span></td>
			<td><input type="text" name="svlist_name" size="20" minlength="3" maxlength="20" required></td>
		</tr>
		<tr>
			<td align="left">&nbsp;ราคา<span style="color:red">*</span></td>
			<td><input onkeypress="validate(event)" type="text" name="svlist_price" size="5" maxlength="5" required>&nbsp;บาท</td>
		</tr>
		<tr>
			<td align="left">&nbsp;หน่วยนับ<span style="color:red">*</span></td>
			<td><input type="text" name="svlist_unit" size="10" maxlength="10" required></td>
		</tr>
		<tr>
			<td align="left">&nbsp;สถานที่<span style="color:red">*</span></td>
			<td><input type="text" name="svlist_place" size="20" maxlength="20" required></td>
		</tr>
		<tr>
			<td align="left">&nbsp;สถานะบริการ</td>
			<td><select name="svlist_statsv">
				<option value="1">ใช้งาน</option>
				<option value="2">ไม่ใช้งาน</option>
			</select></td>
		</tr>
		<tr>
			<td align="left">&nbsp;รูปภาพ</td>
			<td><input type="file" name="svlist_picture"></td>
		</tr>
		<tr height="45"><td colspan="2" align="center">
			<input class="btn btn-success" type="submit" name="submit" value="บันทึก">&nbsp;&nbsp;
			<input class="btn btn-secondary" type="reset" name="reset" value="ล้างค่า">&nbsp;&nbsp;
			<a class="btn btn-danger" href="show_service.php">ยกเลิก</a>
		</td></tr>
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