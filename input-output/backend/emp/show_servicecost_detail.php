<?php require'header.php';require'../../../public/switch.php';?>

<?php 
	$svid1=$_GET['id'];
	$q1 = "select * from servicecost where svcost_id = '$svid1'";
	$resx = $db->query($q1);
	$rowx = $resx->fetch_assoc();
	$svcostid1=$rowx['book_id'];
	$q2 = "select * from book where book_id = '$svcostid1'";
	$resy = $db->query($q2);
	$rowy = $resy->fetch_assoc();
	$cusq1 = $rowy['cus_id'];
	$cusq2 = $rowy['cus_id_2'];
	$q3 = "select * from customer where cus_id = '$cusq1'";
	$cust11 = $db->query($q3);
	$cust1 = $cust11->fetch_assoc();
	$q4 = "select * from customer where cus_id = '$cusq2'";
	$cust22 = $db->query($q4);
	$cust2 = $cust22->fetch_assoc();
?>

<h2 align="center">รายละเอียดค่าใช้จ่าย</h2>
<table width="" border="1" align="center">
    <tbody align="right">
    <tr>
      <td align="center" colspan="2" width="317"><b>รหัสค่าใช้จ่าย SVC-<?=$rowx["svcost_id"];?></b></td>
    </tr>
    <tr>
      <td align="" width="200">รหัสการจอง</td>
      <td align="" width="200"><?=$rowy["book_id"];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td align="">ชื่อผู้จอง</td>
      <td align=""><?=$cust1["cus_name"];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td align="">ชื่อผู้เข้าพัก</td>
      <td align=""><?=$cust2["cus_name"];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td align="">ราคารวม(บาท)</td>
      <td align=""><?=number_format($rowx["svcost_total"],2);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td align="">ส่วนลด(บาท)</td>
      <td align=""><?=number_format($rowx["svcost_total"]-$rowx["svcost_net"],2);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td align="">ยอดสุทธิ(บาท)</td>
      <td align=""><?=number_format($rowx["svcost_net"],2);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    </tbody>
  </table>


  <table align="center" width=""  border="1">
  <tr>
    <td align="center" width="90">รหัสบริการ</td>
    <td align="center" width="140">ชื่อบริการ</td>
    <td align="center" width="120">ราคา(บาท)</td>
    <td align="center" width="110">จำนวน</td>
    <td align="center" width="120">ราคารวม(บาท)</td>
  </tr>
<h2 align="center" style="color:;"><font color="red">รายละเอียด</font></h2>
<?php
$a=1;
$sqlc = "SELECT * FROM servicedetail WHERE svcost_id = '".$_GET["id"]."' ";
$resultc = $db->query($sqlc);
while($rowc=$resultc->fetch_assoc())
{
    $sqld = "SELECT * FROM servicelist WHERE svlist_id = '".$rowc["svlist_id"]."' ";
    $resultd = $db->query($sqld);
    $rowd = $resultd->fetch_assoc();
    ?>
    <tr>
      <td align="center"><?=$rowd['svlist_id'];?></td>
    <td align="center"><?=$rowd["svlist_name"];?></td>
    <td align="center"><?=number_format($rowc["svdetail_price"],2);?></td>
    <td align="center"><?=$rowc["svdetail_num"];?></td>
    <td align="center"><?=number_format($rowc["svdetail_price"]*$rowc["svdetail_num"],2);?></td>
    </tr>
    <?php
 }?>
</table><br>
<div align="center">
  <input class="btn btn-danger pl-4 pr-4" name="button2" type="button" id="button2" onclick="window.location=('show_servicecost.php');" value="ยกเลิก"/>
</div>


</body>
</html>