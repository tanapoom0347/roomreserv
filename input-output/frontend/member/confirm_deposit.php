<?php require'header.php';require'../../../public/upload.php';require'../../../public/switch.php';?>
<?php 
  if(isset($_FILES['book_deposit_picture'])){
    $updep = Uploaddeposit($_FILES['book_deposit_picture']);
    $sql = "UPDATE book SET book_deposit_picture = '".$updep."' ";
    $sql .=", book_status_deposit = '2' ";
    $sql .=" WHERE  book_id = '".$_POST['book_id']."' ";
    $result = $db->query($sql);
    echo "<script>alert('อัพโหลดหลักฐานเรียบร้อยแล้ว');window.location='show_book.php';</script>";
  }
?>
<?php
$sqlx="SELECT * FROM  book WHERE book_id = '".$_GET['id']."' AND cus_id = '".$_SESSION["login_cus_id"]."'";
$resultx = $db->query($sqlx);
$rowx=$resultx->fetch_assoc();
$sqly="SELECT * FROM customer WHERE cus_id = '".$_SESSION["login_cus_id"]."' ";
$resulty = $db->query($sqly);
$rowy=$resulty->fetch_assoc();
?>
<h2 align="center">แจ้งหลักฐาน</h2>
<table width="" border="1" align="center">
    <tbody>
    <tr>
      <td colspan="2" width="317">รหัสการจอง BKN-<?=$rowx["book_id"];?></td>
    </tr>
    <tr>
      <td align="right" width="100">ชื่อผู้จอง&nbsp;</td>
      <td align="center" width="217"><?=$rowy["cus_name"];?></td>
    </tr>
    <tr>
      <td align="right">ที่อยู่&nbsp;</td>
      <td align="center"><?=$rowy["cus_address"];?></td>
    </tr>
    <tr>
      <td align="right">เบอร์โทรศัพท์&nbsp;</td>
      <td align="center"><?=$rowy["cus_phone"];?></td>
    </tr>
    <tr>
      <td align="right">อีเมล์&nbsp;</td>
      <td align="center"><?=$rowy["cus_email"];?></td>
    </tr>
    </tbody>
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
while($rowc=$resultc->fetch_assoc())
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
    <?php
 }?>
</table><br>
<div align="center">
  <form name="form1" method="post" action="confirm_deposit.php" enctype="multipart/form-data" onsubmit="return confirm('ท่านต้องการอัพโหลดหลักฐานใช่หรือไม่?');">
    <input type="hidden" name="book_id" value="<?=$rowx["book_id"];?>" >
    <table width="" border="1">
    <?php if($rowx["book_deposit_picture"] == ''){ ?>
      <tr height="70" align="center">
        <td width="130" align="center"><span style="color: green" >อัพโหลดหลักฐาน การชำระเงิน</span></td>
        <td width="" align="center"><input type="file" name="book_deposit_picture" value="" required="" /></td>
      </tr>
      <tr>
      <td colspan="2" align="center">
      <input class="btn btn-success pl-4 pr-4" name="submit" type="submit" id="button" value="บันทึก"/>
      <input class="btn btn-secondary pl-4 pr-4" name="reset" type="reset" id="button1" value="ล้างค่า"/>
      <input class="btn btn-danger pl-4 pr-4" name="button2" type="button" id="button2" onclick="window.location=('show_book.php');" value="ยกเลิก"/>
    </td>
    </tr>
    </table><p></p>
    <?php } else { ?>
      <tr height="" align="center">
        <td width="100" align="center"><span style="color: green" >หลักฐาน<p>การชำระเงิน</p></span></td>
        <td width="" align="center"><img src="../../../img/deposit/<?=$rowx["book_deposit_picture"]; ?>" width="300" height="300"></td>
      </tr><?php }?>  
    </table><p></p>
</div>
  </form>
</body>
</html>