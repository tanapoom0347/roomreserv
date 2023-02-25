<?php require'header.php';require'../../../public/switch.php';?>


<?php 
	$rcid1=$_GET['id'];
	$q1 = "select * from receipt where receipt_id = '$rcid1'";
	$resx = $db->query($q1);
	$rowx = $resx->fetch_assoc();
	$cusid1=$rowx['cus_id'];
	$q2 = "select * from customer where cus_id = '$cusid1'";
	$resy = $db->query($q2);
	$rowy = $resy->fetch_assoc();
?>

<h2 align="center">รายละเอียดการชำระ</h2>
<table width="" border="1" align="center">
    <tbody align="right">
    <tr>
      <td align="center" colspan="2" width="317"><b>รหัสการชำระ RC-<?=$rowx["receipt_id"];?></b></td>
    </tr>
    <tr>
      <td align="" width="200">รหัสลูกค้า&nbsp;&nbsp;</td>
      <td align="" width="290"><?=$rowy["cus_id"];?>&nbsp;</td>
    </tr>
    <tr>
      <td align="">ชื่อลูกค้า&nbsp;&nbsp;</td>
      <td align=""><?=$rowy["cus_name"];?>&nbsp;</td>
    </tr>
    <tr>
      <td align="">เบอร์โทรศัพท์&nbsp;&nbsp;</td>
      <td align=""><?=$rowy["cus_phone"];?>&nbsp;</td>
    </tr>
    <tr>
      <td align="">ที่อยู่&nbsp;&nbsp;</td>
      <td align=""><?=$rowy["cus_address"];?>&nbsp;</td>
    </tr>
    <tr>
      <td align="">ราคารวม(บาท)&nbsp;&nbsp;</td>
      <td align=""><?=number_format($rowx["receipt_net"]+$rowx["receipt_discount"],2);?>&nbsp;</td>
    </tr>
    <tr>
      <td align="">ส่วนลด(บาท)&nbsp;&nbsp;</td>
      <td align=""><?=number_format($rowx["receipt_discount"],2);?>&nbsp;</td>
    </tr>
    <tr>
      <td align="">ยอดชำระ(บาท)&nbsp;&nbsp;</td>
      <td align=""><?=number_format($rowx["receipt_net"],2);?>&nbsp;</td>
    </tr>
    </tbody>
  </table>


  <table align="center" width=""  border="1">
  <tr>
    <td align="center" width="150">รหัสค่าใช้จ่าย</td>
    <td align="center" width="150">รหัสการจอง</td>
    <td align="center" width="200">ชื่อลูกค้า</td>
    <td align="center" width="100">ราคา(บาท)</td>
    <td align="center" width="100">ส่วนลด(บาท)</td>
    <td align="center" width="100">สุทธิ(บาท)</td>
  </tr>
<h2 align="center" style="color:;">รายละเอียด</h2>
<?php
$a=1;
$sqlc = "SELECT * FROM servicecost WHERE receipt_id = '".$_GET["id"]."' ";
$resultc = $db->query($sqlc);
while($rowc=$resultc->fetch_assoc())
{
    $sqld = "SELECT * FROM servicelist WHERE svlist_id = '".$rowc["svlist_id"]."' ";
    $resultd = $db->query($sqld);
    $rowd = $resultd->fetch_assoc();
    $bookid22=$rowc['book_id'];
    $q3="select * from book where book_id = '$bookid22'";
    $res333=$db->query($q3);
    $book=$res333->fetch_assoc();
    $idcust44=$book['cus_id_2'];
    $q4="select * from customer where cus_id = '$idcust44'";
    $res444=$db->query($q4);
    $customer=$res444->fetch_assoc();
    ?>
    <tr>
    <td align="center">SVC-<?=$rowc['svcost_id'];?></td>
    <td align="center">BKN-<?=$book["book_id"];?></td>
    <td align="center"><?=$customer["cus_name"];?></td>
    <td align="right"><?=number_format($rowc["svcost_total"],2);?>&nbsp;&nbsp;</td>
    <td align="right"><?=number_format($rowc["svcost_total"]-$rowc["svcost_net"],2);?>&nbsp;&nbsp;</td>
    <td align="right"><?=number_format($rowc["svcost_net"],2);?>&nbsp;&nbsp;</td>
    </tr>
    <?php
 }?>
</table><br>
<div align="center">
  <input class="btn btn-danger pl-4 pr-4" name="button2" type="button" id="button2" onclick="window.location=('show_receipt.php');" value="ยกเลิก"/>
</div>

</body>
</html>