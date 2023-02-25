<?php require'../../../conn.php';require'../../../public/switch.php';require'../../../public/datediff.php';?>
<?php 
if(isset($_GET['id'])){
  $book_id = $_GET['id'];
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="../../../public/css/fontawesome.css">
<link rel="stylesheet" href="../../../public/css/bootstrap.css">
<script src="../../../public/js/jquery-3.4.1.js"></script>
<script src="../../../public/js/bootstrap.bundle.js"></script>
<title>ใบเสร็จการจอง</title></head>
<body>

<div align="center">
  <br>
  <h2>ใบเสร็จการจอง</h2>
  <p> แสงเทียน บีช รีสอร์ท<br>
   88 หมู่ 4 เกาะเสม็ดอ่าวแสงเทียน ต.เพ อ.เมือง จ.ระยอง 21160<br>
   Tel. 038-644-255 , 081-2959567
  </p>
  <hr>
  <table border="0">
    <thead>
      <?php 
        $sql = "select * from book where book_id = '".$book_id."' ";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $sqlc = "select * from customer where cus_id = '".$row["cus_id"]."' ";
        $resultc = $db->query($sqlc);
        $rowc = $resultc->fetch_assoc();
      ?>
      <tr>
        <th width="200">รหัสใบจอง</th>
        <th width="200">BKN-<?=$book_id?></th>
        <th width="200">ชื่อลูกค้า</th>
        <th width="200"><?=$rowc['cus_name']?></th>
      </tr>
      <tr>
        <th width="200">วันที่ออกใบจอง</th>
        <th width="200"><?=dmy(date("Y-m-d"))?></th>
        <th width="200">เบอร์โทรศัพท์</th>
        <th width="200"><?=$rowc['cus_phone']?></th>
      </tr>
    </thead>
  </table><p></p>

  <table border="1">
    <thead align="center">
      <tr>
        <th colspan="6">รายละเอียดการจอง</th>
      </tr>
      <tr>
        <th width="120">ชื่อห้องพัก</th>
        <th width="120">วันที่เข้า</th>
        <th width="120">วันที่ย้ายออก</th>
        <th width="120">ราคา(บาท)</th>
        <th width="100">จำนวน(วัน)</th>
        <th width="120">ราคารวม(บาท)</th>
      </tr>
    </thead>
    <tbody align="center">
    <?php 
    $str1 = "select * from booklist where book_id = '".$book_id."' ";
    $res1 = $db->query($str1);
    while($row1=$res1->fetch_assoc()) {
    $str2 = "select * from room where room_id = '".$row1["room_id"]."' ";
    $res2 = $db->query($str2);
    $row2 = $res2->fetch_assoc();
    $datediff = datediff($row1['booklist_datein'],$row1['booklist_dateout']);
    $total = $row2['room_rate']*$datediff;
    ?>
      <tr>
        <td><?=$row2['room_name']?></td>
        <td><?=dmy($row1['booklist_datein'])?></td>
        <td><?=dmy($row1['booklist_dateout'])?></td>
        <td><?=number_format($row2['room_rate'],2)?></td>
        <td><?=$datediff?></td>
        <td><?=number_format($total,2)?></td>
      </tr>
    <?php }?>
    </tbody>
  </table><p></p>

<table border="0">
  <thead>
    <tr>
      <th width="250"></th>
      <th width="250"></th>
      <th width="215">รวมทั้งหมด</th>
      <th width="250" align="right"><?=number_format($row['book_total'],2)?> บาท</th>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th>ชำระแล้ว</th>
      <th align="right"><?=number_format($row['book_deposit'],2)?> บาท</th>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th>ยอดสุทธิ</th>
      <th align="right"><?=number_format($row['book_deposit'],2)?> บาท</th>
    </tr>
  </thead>
</table>


</div>
</body>
</html>