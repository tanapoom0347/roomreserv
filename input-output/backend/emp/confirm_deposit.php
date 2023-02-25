<?php require('header.php');require('../../../public/upload.php');?>
<?php 
  if(isset($_POST['submit'])){
    $sql = "UPDATE book SET book_status_deposit = '3' WHERE book_id = '".$_POST['confirm']."'";
    if($result=$db->query($sql)){alert_message('ยืนยันหลักฐานการชำระสำเร็จ');goto_url('show_book.php');}
  }
?>
<?php
$strSQL = "SELECT * FROM book WHERE book_id = '".$_GET['id']."' ";
$objQuery = $db->query($strSQL);
$objResult = $objQuery->fetch_assoc();
$strSQL2 = "SELECT * FROM customer WHERE cus_id = '".$objResult["cus_id"]."' ";
$objQuery2 = $db->query($strSQL2);
$objResult2 = $objQuery2->fetch_assoc();
?>
 <table width="" border="1" align="center">
    <tr>
      <td colspan="2" width="317" align="center">Book_No.<?=$objResult["book_id"];?></td>
    </tr>
    <tr>
      <td align="center" width="100">ชื่อผู้จอง</td>
      <td align="center" width="217"><?=$objResult2["cus_name"];?></td>
    </tr>
    <tr>
      <td align="center">ที่อยู่</td>
      <td align="center"><?=$objResult2["cus_address"];?></td>
    </tr>
    <tr>
      <td align="center">เบอร์โทรศัพท์</td>
      <td align="center"><?=$objResult2["cus_phone"];?></td>
    </tr>
    <tr>
      <td align="center">อีเมล์</td>
      <td align="center"><?=$objResult2["cus_email"];?></td>
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

$strSQL3 = "SELECT * FROM booklist WHERE book_id = '".$_GET["id"]."' ";
$objQuery3 = $db->query($strSQL3);

while($row3 = $objQuery3->fetch_assoc())
{
    $strSQL4 = "SELECT * FROM room WHERE room_id = '".$row3["room_id"]."' ";
    $objQuery4 = $db->query($strSQL4);
    $objResult4 = $objQuery4->fetch_assoc();
    ?>
    <tr>
      <td align="center"><?=$a++;?></td>
    <td align="center"><?=$objResult4["room_name"];?></td>
    <td align="center"><?=$row3["booklist_datein"];?></td>
    <td align="center"><?=$row3["booklist_dateout"];?></td>
    </tr>
    <?php
 }
  ?>
</table><br>
<div align="center">
  <form name="form1" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="confirm" value="<?=$objResult["book_id"];?>" >
    <table width="" border="1">
      <?php if($objResult["book_deposit_picture"] == ''){ ?>
      <tr height="70" align="center">
        <td width="130" align="center"><span style="color: green" >อัพโหลดหลักฐาน การชำระเงิน</span></td>
        <td width="" align="center"><input type="file" name="book_deposit_picture" value="" /></td>
      </tr>
      <?php } else { ?>
      <tr height="" align="center">
        <td width="100" align="center"><span style="color: green" >หลักฐาน<p>การชำระเงิน</p></span></td>
        <td width="" align="center"><img src="../../../img/deposit/<?=$objResult["book_deposit_picture"]; ?>" width="300" height="300"></td>
      </tr>
      <?php } ?>
      
    </table><p></p>
    <tr>
      <!--<td><input class="btn btn-success pl-4 pr-4" name="submit" type="submit" id="button" value="ยืนยัน" /></td>
      <td><input class="btn btn-secondary pl-4 pr-4" name="reset" type="reset" id="button1" value="ล้างค่า" /></td>
      <td><input class="btn btn-danger" name="button2" type="button" id="button2" onclick="window.location='show_book.php'" value="ย้อนกลับ" /></td>-->
      <td><input class="btn btn-success pl-4 pr-4" name="submit" type="submit" id="button" value="บันทึกการรับชำระ" onclick="return confirm('ท่านต้องการยืนยันการรับชำระหรือไม่?');"/></td>
    </tr>
</div>
  </form>
</body>
</html>