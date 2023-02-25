<?php require'header.php';require'../../../public/switch.php';require'../../../public/datediff.php';?>
<?php
	if(isset($_GET['clearcart']))
{
	unset($_SESSION["intLine"]);
	unset($_SESSION["strroom_id"]);
	unset($_SESSION["strbooklist_datein"]);
	unset($_SESSION["strbooklist_dateout"]);
	unset($_SESSION["strbooklist_dateout2"]);
	unset($_SESSION["checkin"]);
	unset($_SESSION["checkout"]);
	unset($_SESSION["num_days"]);
	unset($_SESSION['sum']);
	unset($_SESSION['ddd']);
	unset($_SESSION['aaa']);
	unset($_SESSION['bbb']);
	header("location:cart_room.php");
}
	if(isset($_GET['Line']))
{
	$Line = $_GET["Line"];
	$_SESSION["strroom_id"][$Line] = "";
	$_SESSION["strbooklist_datein"][$Line] = "";
	$_SESSION["strbooklist_dateout"][$Line] = "";
	$_SESSION["strAdultQty"][$Line] = "";
	$_SESSION["strChildQty"][$Line] = "";
	header("location:cart_room.php");
}
?>
<form method="post" action="update_qty.php">
<h1 align="center" style="color:black">เลือก/ยกเลิกห้องพัก</h1>
<div align="center"><a class="btn btn-primary" href="search_room.php">เพิ่มห้องพัก</a>  |  <a class="btn btn-danger" href="cart_room.php?clearcart" onclick="return confirm('ท่านต้องการล้างตะกร้าใช่หรือไม่?');">ล้างตะกร้า</a>  |  <input class="btn btn-success" type="submit" value="ยืนยันการจอง"></div>
<br>
<ul id="MenuBar1" class="MenuBarHorizontal">
<div align="center">
<table width="" border="1">
<thead align="center">
  <tr>
  	  <th ><div align="center">ลำดับ</div></th>
      <th ><div align="center">รูปห้องพัก</div></th>
      <th ><div align="center">ชื่อห้องพัก</div></th>
      <th width="120"><div align="center">ราคาห้องพัก(บาท)</div></th>
      <th width="80"><div align="center">ประเภท</div></th>
      <th width="70"><div align="center">ขนาด</div></th>
      <th width="100"><div align="center">วันที่เข้าพัก</div></th>
      <th width="100"><div align="center">วันที่ย้ายออก</div></th>
      <th width="70"><div align="center">จำนวน</div></th>
      <th width="70"><div align="center">ราคา(บาท)</div></th>
      <th width="70">ผู้ใหญ่</th>
      <th width="70">เด็ก</th>
      <th width="80"><div align="center"></div></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $Total = 0;
  $SumTotal = 0;
  $a=0;
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {	
	  if($_SESSION["strroom_id"][$i] != "")
	  {
	  	$a++;
		$sql="SELECT * FROM room WHERE room_id = '".$_SESSION["strroom_id"][$i]."' ";
		$result=$db->query($sql);
		$row=$result->fetch_assoc();$result->free();
		$Total=$row["room_rate"]*$_SESSION["strbooklist_dateout2"][$i];
		$SumTotal=$SumTotal + $Total;
	  ?>
	  <tr height="140">
		<td style="display:none;"><?=$_SESSION["strroom_id"][$i];?></td>
		<td align="center"><?=$a;?></td>
		<td align="center"><img src="../../../img/room/<?=$row['room_picture'];?>"width="100"height="100"/></td>
		<td align="center"><?=$row['room_name'];?></td>
        <td align="center"><?=number_format($row['room_rate'],2); ?></td>
        <td align="center"><?=type_room($row['room_category']); ?></td>
        <td align="center"><?=$row['room_bed']*2;echo" ท่าน"; ?></td>
        <td align="center"><?=dmy($_SESSION["strbooklist_datein"][$i])?></td>
        <td align="center"><?=dmy($_SESSION["strbooklist_dateout"][$i])?></td>
        <td align="center"><?=$_SESSION["strbooklist_dateout2"][$i]." วัน";?></td>
        <td align="center"><?=number_format($row['room_rate']*$_SESSION["strbooklist_dateout2"][$i],2); ?></td>
        <td align="center"><input type="text" name="adultvalue<?=$i?>" size="2" maxlength="2" value="<?=$row['room_bed']*2?>"  onkeypress="validate(event)"></td>
        <td align="center"><input type="text" name="childvalue<?=$i?>" size="2" maxlength="2" value="0"  onkeypress="validate(event)"></td>
		<td align="center"><a href="cart_room.php?Line=<?=$i;?>">ยกเลิก</a></td>
	  </tr>
	  <?php }}$db->close();?>
</tbody></table></div></ul>
<table width="1120"  border="0" align="center">
  <tr>
  <td></td>
  <td></td>
  <td align="right">รวมทั้งหมด&nbsp;&nbsp; <span style="color: #F00"><?php echo number_format($SumTotal,2);?></span> บาท</td>
  </tr>
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