<?php require'header.php';require'../../../public/Upload.php';
if(isset($_POST['submit']))
{$room_name=$_POST['room_name'];
$room_category=$_POST['room_category'];
$room_price=$_POST['room_price'];
$room_picture=Uploadroom($_FILES['room_picture']);
$room_bed=$_POST['room_bed'];
$room_rate=$_POST['room_rate'];
$room_statsv=$_POST['room_statsv'];
$room_id=$_POST['room_id'];
if($_FILES['room_picture']['name']!='')
{$sql=" UPDATE room SET";
$sql.=" room_name = '$room_name' ";
$sql.=" ,room_category = '$room_category' ";
$sql.=" ,room_price = '$room_price' ";
$sql.=" ,room_picture = '$room_picture' ";
$sql.=" ,room_bed = '$room_bed' ";
$sql.=" ,room_rate = '$room_rate' ";
$sql.=" ,room_statsv = '$room_statsv' ";
$sql.=" WHERE room_id = '$room_id' ";}
else{$sql=" UPDATE room SET";
$sql.=" room_name = '$room_name' ";
$sql.=" ,room_category = '$room_category' ";
$sql.=" ,room_price = '$room_price' ";
$sql.=" ,room_bed = '$room_bed' ";
$sql.=" ,room_rate = '$room_rate' ";
$sql.=" ,room_statsv = '$room_statsv' ";
$sql.=" WHERE room_id = '$room_id' ";}
if($db->query($sql)==true){
alert_message('แก้ไขข้อมูลสำเร็จ รหัสห้องพัก : '.$_POST['room_id']);
goto_url('show_room.php');}}
if(isset($_GET['id'])){$id=$_GET['id'];
$sql2="SELECT * FROM room WHERE room_id = '$id' ";
$result2=$db->query($sql2);
$row2=$result2->fetch_assoc();
$result2->free();}?>
<h1 align="center">แก้ไขข้อมูลห้องพัก</h1><p></p>
<form method="post" enctype="multipart/form-data" onsubmit="return confirm('ต้องการแก้ไขข้อมูลห้องพักใช่หรือไม่?');">
	<table border="1" align="center" width="475">
		<thead>
			<tr>
				<th colspan="2">&nbsp;รหัสห้องพัก <?=$row2['room_id']?></th>
			</tr>
		</thead>
		<input type="hidden" name="room_id" value="<?=$row2['room_id']?>">
		<tr>
			<td width="120" align="left">&nbsp;ชื่อห้องพัก<span style="color:red">*</span></td>
			<td><input type="text" name="room_name" size="25" minlength="3" maxlength="25" required value="<?=$row2['room_name']?>"></td>
		</tr>
		<tr>
			<td align="left">&nbsp;ประเภท<span style="color:red">*</span></td>
			<td><select name="room_category">
				<option value="1">Sea View</option>
				<option value="2">Top</option>
				<option value="3">Vip</option>
				<option value="4">Big House</option>
			</select></td>
		</tr>
		<tr>
			<td align="left">&nbsp;ราคา<span style="color:red">*</span></td>
			<td><input onkeypress="validate(event)" type="text" name="room_rate" size="5" maxlength="5" required value="<?=$row2['room_rate']?>">&nbsp;บาท</td>
		</tr>
		<tr>
			<td align="left">&nbsp;จำนวนเตียง<span style="color:red">*</span></td>
			<td><input onkeypress="validate(event)" onkeypress="validate(event)" type="text" name="room_bed" size="2" maxlength="2" required value="<?=$row2['room_bed']?>"></td>
		</tr>
		<tr>
			<td align="left">&nbsp;ราคาเตียงเสริม<span style="color:red">*</span></td>
			<td><input type="text" name="room_price" size="3" maxlength="3" required value="<?=$row2['room_price']?>">&nbsp;บาท</td>
		</tr>
		<tr>
			<td align="left">&nbsp;สถานะบริการ</td>
			<td><select name="room_statsv">
				<option value="1">เปิดใช้บริการ</option>
				<option value="2">ปิดปรับปรุง</option>
			</select></td>
		</tr>
		<tr>
			<td align="left">&nbsp;รูปภาพ</td>
			<td><?php if($row2['room_picture']!=''){echo '<img src="../../../img/room/'.$row2['room_picture'].'" width="150" height="150"/><br>';}?>
				<input type="file" name="room_picture"></td>
		</tr>
		<tr height="45"><td colspan="2" align="center">
			<input class="btn btn-success" type="submit" name="submit" value="บันทึก">&nbsp;&nbsp;
			<input class="btn btn-secondary" type="reset" name="reset" value="คืนค่า">&nbsp;&nbsp;
			<a class="btn btn-danger" href="show_room.php">ยกเลิก</a>
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