<?php require'header.php';require'../../../public/switch.php';?>
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
<h2 align="center">รายละเอียดการจอง</h2>
<table width="" border="1" align="center">
    <tbody>
    <tr>
      <td colspan="2" width="317">รหัสการจอง BKN-<?=$rowx["book_id"];?></td>
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
    <tr>
      <td align="center">ผู้ใหญ่</td>
      <td align="center"><?=$rowx["book_adult"];?></td>
    </tr>
    <tr>
      <td align="center">เด็ก</td>
      <td align="center"><?=$rowx["book_child"];?></td>
    </tr>
    </tbody>
  </table>


<table align="center" width=""  border="1">
  <tr>
    <td align="center" width="90">ลำดับ</td>
    <td align="center" width="200">ชื่อห้อง</td>
    <td align="center" width="200">วันที่เข้าพัก</td>
    <td align="center" width="200">วันที่ย้ายออก</td>
    <td align="center" width="120">ผู้ใหญ่(คน)</td>
    <td align="center" width="120">เด็ก(คน)</td>
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
    <td align="center"><?=$rowc["booklist_numadults"];?></td>
    <td align="center"><?=$rowc["booklist_numchild"];?></td>
    </tr>
    <?php
 }?>
</table><br>
<div align="center">
  <input class="btn btn-danger pl-4 pr-4" name="button2" type="button" id="button2" onclick="window.location=('show_book.php');" value="ยกเลิก"/>
</div>
  </form>
</body>
</html>