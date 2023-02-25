<?php require'header.php';require'../../../public/Upload.php';
if(isset($_POST['submit']))
{$svlist_name=$_POST['svlist_name'];
$svlist_price=$_POST['svlist_price'];
$svlist_unit=$_POST['svlist_unit'];
$svlist_picture=Uploadservice($_FILES['svlist_picture']);
$svlist_place=$_POST['svlist_place'];
$svlist_statsv=$_POST['svlist_statsv'];
$svlist_id=$_POST['svlist_id'];
if($_FILES['svlist_picture']['name']!='')
{$sql=" UPDATE servicelist SET";
$sql.=" svlist_name = '$svlist_name' ";
$sql.=" ,svlist_price = '$svlist_price' ";
$sql.=" ,svlist_unit = '$svlist_unit' ";
$sql.=" ,svlist_picture = '$svlist_picture' ";
$sql.=" ,svlist_place = '$svlist_place' ";
$sql.=" ,svlist_statsv = '$svlist_statsv' ";
$sql.=" WHERE svlist_id = '$svlist_id' ";}
else{$sql=" UPDATE servicelist SET";
$sql.=" svlist_name = '$svlist_name' ";
$sql.=" ,svlist_price = '$svlist_price' ";
$sql.=" ,svlist_unit = '$svlist_unit' ";
$sql.=" ,svlist_place = '$svlist_place' ";
$sql.=" ,svlist_statsv = '$svlist_statsv' ";
$sql.=" WHERE svlist_id = '$svlist_id' ";}
if($db->query($sql)==true){
alert_message('แก้ไขข้อมูลสำเร็จ รหัสรายการบริการ : '.$_POST['svlist_id']);
goto_url('show_service.php');}}
if(isset($_GET['id'])){$id=$_GET['id'];
$sql2="SELECT * FROM servicelist WHERE svlist_id = '$id' ";
$result2=$db->query($sql2);
$row2=$result2->fetch_assoc();
$result2->free();}?>
<h1 align="center">แก้ไขข้อมูลรายการบริการ</h1><p></p>
<form method="post" enctype="multipart/form-data" onsubmit="return confirm('ต้องการแก้ไขข้อมูลรายการบริการใช่หรือไม่?');">
	<table border="1" align="center" width="450">
		<thead>
			<tr>
				<th colspan="2">&nbsp;รหัสห้องบริการ <?=$row2['svlist_id']?></th>
			</tr>
		</thead>
		<input type="hidden" name="svlist_id" value="<?=$row2['svlist_id']?>">
		<tr>
			<td width="120" align="left">&nbsp;ชื่อบริการ<span style="color:red">*</span></td>
			<td><input type="text" name="svlist_name" size="20" minlength="3" maxlength="20" required value="<?=$row2['svlist_name']?>"></td>
		</tr>
		<tr>
			<td align="left">&nbsp;ราคา<span style="color:red">*</span></td>
			<td><input onkeypress="validate(event)" type="text" name="svlist_price" size="5" maxlength="5" required value="<?=$row2['svlist_price']?>">&nbsp;บาท</td>
		</tr>
		<tr>
			<td align="left">&nbsp;หน่วยนับ<span style="color:red">*</span></td>
			<td><input type="text" name="svlist_unit" size="10" maxlength="10" required value="<?=$row2['svlist_unit']?>"></td>
		</tr>
		<tr>
			<td align="left">&nbsp;สถานที่<span style="color:red">*</span></td>
			<td><input type="text" name="svlist_place" size="20" maxlength="20" required value="<?=$row2['svlist_place']?>"></td>
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
			<td><?php if($row2['svlist_picture']!=''){echo '<img src="../../../img/service/'.$row2['svlist_picture'].'" width="150" height="150"/><br>';}?>
				<input type="file" name="svlist_picture"></td>
		</tr>
		<tr height="45"><td colspan="2" align="center">
			<input class="btn btn-success" type="submit" name="submit" value="บันทึก">&nbsp;&nbsp;
			<input class="btn btn-secondary" type="reset" name="reset" value="คืนค่า">&nbsp;&nbsp;
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