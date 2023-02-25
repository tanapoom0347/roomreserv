<?php require'header.php';require'../../../public/switch.php';?>
<?php $sqlx = "SELECT * FROM  book WHERE  book_id = '".$_GET['id']."'";
$resultx = $db->query($sqlx);
$rowx = $resultx->fetch_assoc();
$sqly = "SELECT * FROM customer WHERE cus_id = '".$rowx["cus_id"]."'";
$resulty = $db->query($sqly);
$rowy = $resulty->fetch_assoc();
?>
<table width="" border="1" align="center">
    <tr>
      <td colspan="2" width="317">รหัสการจอง BKN<?=$rowx["book_id"];?></td>
    </tr>
    <tr>
      <td align="center" width="100">ชื่อผู้จอง</td>
      <td align="center" width="217"><?=$rowy["cus_name"];?></td>
    </tr>
    <tr>
      <td align="center">ที่อยู่</td>
      <td align="center"><?=$rowy["cus_address"];?></td>
    </tr>
    <tr>
      <td align="center">เบอร์โทรศัพท์</td>
      <td align="center"><?=$rowy["cus_phone"];?></td>
    </tr>
    <tr>
      <td align="center">อีเมล์</td>
      <td align="center"><?=$rowy["cus_email"];?></td>
    </tr>
  </table>
<table align="center" width=""  border="1">
  <tr>
    <td align="center" width="90">ลำดับ</td>
    <td align="center" width="200">ชื่อห้อง</td>
    <td align="center" width="200">วันที่เข้าพัก</td>
    <td align="center" width="200">วันที่ย้ายออก</td>
  </tr>
<h2 align="center" style="color:blue;">รายละเอียด</h2>
<?php

$a=1;

$sqlc = "SELECT * FROM booklist WHERE book_id = '".$_GET["id"]."' ";
$resultc = $db->query($sqlc);

while($rowc = $resultc->fetch_assoc())
{
    $sqld = "SELECT * FROM room WHERE room_id = '".$rowc["room_id"]."' ";
    $resultd = $db->query($sqld);
    $rowd = $resultd->fetch_assoc();
    ?>
    <tr>
      <td align="center"><?=$a++;?></td>
    <td align="center"><?=$rowd["room_name"];?></td>
    <td align="center"><?=dmy($rowc["booklist_datein"]);?></td>
    <td align="center"><?=dmy($rowc["booklist_dateout"]);?></td>
    </tr>
    <?php }$resultx->free();$resulty->free();$resultc->free();$resultd->free();$db->close();?>
</table><br>
</body>
<div align="center"><input class="btn btn-danger" name="button2" type="submit" id="button2" onclick="window.location=('show_book.php');" value="ย้อนกลับ" /></td></div>
</html>