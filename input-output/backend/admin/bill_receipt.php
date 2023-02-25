<?php require'../../../conn.php';require'../../../public/switch.php';?>
<?php 
if(isset($_GET['id'])){
  $receipt_id = $_GET['id'];
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="../../../public/css/fontawesome.css">
<link rel="stylesheet" href="../../../public/css/bootstrap.css">
<script src="../../../public/js/jquery-3.4.1.js"></script>
<script src="../../../public/js/bootstrap.bundle.js"></script>
<title>ใบเสร็จรับเงิน</title></head>
<body>
  <?php 
    $str1 = "select * from receipt where receipt_id = '".$receipt_id."' ";
    $res1 = $db->query($str1);
    $row1 = $res1->fetch_assoc();
    $str2 = "select * from customer where cus_id = '".$row1["cus_id"]."' ";
    $res2 = $db->query($str2);
    $row2 = $res2->fetch_assoc();
    $str3 = "select * from employee where emp_id = '".$row1["emp_id"]."' ";
    $res3 = $db->query($str3);
    $row3 = $res3->fetch_assoc();
  ?>
<div align="center"><br>
<div  align="center" style="border: 1px solid; width: 1000px;">
  <br>
  <h2>ใบเสร็จรับเงิน</h2>
  <p> แสงเทียน บีช รีสอร์ท<br>
   88 หมู่ 4 เกาะเสม็ดอ่าวแสงเทียน ต.เพ อ.เมือง จ.ระยอง 21160<br>
   Tel. 038-644-255 , 081-2959567
  </p>
  <hr>
  <table border="0">
    <thead>
      <tr>
        <th width="200">รหัสใบเสร็จรับเงิน</th>
        <th width="200">RC-<?=$row1["receipt_id"]?></th>
        <th width="200">วันที่ออก</th>
        <th width="200"><?=dmy($row1["receipt_dateout"])?></th>
      </tr>
      <tr>
        <th width="200">ชื่อลูกค้า</th>
        <th width="200"><?=$row2["cus_name"]?></th>
        <th width="200">ชื่อพนักงาน</th>
        <th width="200"><?=$row3["emp_name"]?></th>
      </tr>
      <tr>
        <th width="200">เบอร์โทรศัพท์</th>
        <th width="200"><?=$row2["cus_phone"]?></th>
        <th width="200"></th>
        <th width="200"></th>
      </tr>
    </thead>
  </table><p></p>

  <table border="1">
    
    <?php 
    $sql = "select * from servicecost where receipt_id = '".$receipt_id."' ";
    $result = $db->query($sql);
    while($row=$result->fetch_assoc()) {?>
      <thead align="center">
      <tr>
        <th width="200">รหัสค่าใช้จ่าย</th>
        <th width="200">ราคารวม(บาท)</th>
        <th width="200">ส่วนลด(บาท)</th>
        <th width="200">รวมสุทธิ(บาท)</th>
      </tr>
    </thead>
    <tbody align="center">
      <tr>
        <td>SVC-<?=$row['svcost_id']?></td>
        <td align="right"><?=number_format($row['svcost_total'],2)?></td>
        <td align="right"><?=number_format($row['svcost_total']-$row['svcost_net'],2)?></td>
        <td align="right"><?=number_format($row['svcost_net'],2)?></td>
      </tr>
        <tr>
          <td width="800" colspan="4">รายละเอียดค่าใช้จ่าย</td>
        </tr>
        <tr>
          <td width="100">ชื่อบริการ</td>
          <td width="100">ราคา(บาท)</td>
          <td width="100">จำนวน</td>
          <td width="100">ราคารวม(บาท)</td>
        </tr>
      <?php 
        $svdeid = $row['svcost_id'];
        $str5 = "select * from servicedetail where svcost_id = '$svdeid'";
        $res5 = $db->query($str5);
        while ($row5 = $res5->fetch_assoc())
      {
        $svserid = $row5['svlist_id'];
        $str6 = "select * from servicelist where svlist_id = '$svserid'";
        $res6 = $db->query($str6);
        $row6 = $res6->fetch_assoc();
        ?>
        <tr>
          <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$row6['svlist_name']?></td>
          <td align="right"><?=number_format($row5['svdetail_price'],2)?></td>
          <td align=""><?=$row5['svdetail_num']?></td>
          <td align="right"><?=number_format($row5['svdetail_num']*$row5['svdetail_price'],2)?></td>
        </tr>
      
    <?php }}?>
    </tbody>
  </table>
  <p></p>
<table>
  <thead align="right">
    <tr>
      <th width="0"></th>
      <th width="0"></th>
      <th width="200">ประเภทการชำระ</th>
      <th width="200" align="right"><?=pay_type($row1['receipt_paymenttype'])?></th>
    </tr>
    <tr>
      <th width="200"></th>
      <th width="200"></th>
      <th width="200">รวมทั้งหมด</th>
      <th width="200" align="right"><?=number_format($row1['receipt_net']+$row1['receipt_discount'],2)?> บาท</th>
    </tr>
    <tr>
      <th width="0"></th>
      <th width="0"></th>
      <th width="200">ส่วนลด</th>
      <th width="200" align="right"><?=number_format($row1['receipt_discount'],2)?> บาท</th>
    </tr>
    <tr>
      <th width="0"></th>
      <th width="0"></th>
      <th width="200">ยอดชำระ</th>
      <th width="200" align="right"><?=number_format($row1['receipt_net'],2)?> บาท</th>
    </tr>
  </thead>
</table>
<br><br>

</div>
</div>
</body>
</html>