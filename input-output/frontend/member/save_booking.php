<?php require'header.php';require'../../../public/switch.php';?>
<?php if(isset($_POST['submit'])){

  $c2=$_SESSION["login_cus_id"];
$TotalAdult = $_POST['SumTotalAdult'];
$TotalChild = $_POST['SumTotalChild'];
$SumTotal = $_SESSION['sum'];
$Deposit = $SumTotal/2;
$Debt = $SumTotal;
$BookDiscount = $_SESSION['book_discount'];
$sqlr = "INSERT INTO book ";
$sqlr.="(book_date,book_adult,book_child,book_scheduled,book_deposit,book_total,book_discount,book_status_deposit,book_status_pay,book_debt,book_note,cus_id) ";
$sqlr.="VALUES ";
$sqlr.="('".date("Y-m-d H:i:s")."' ";
$sqlr.=",'".$TotalAdult."' ";
$sqlr.=",'".$TotalChild."' ";
$sqlr.=",'".$_SESSION["strbooklist_datein"][0]."' ";
$sqlr.=",'".$Deposit."' ";
$sqlr.=",'".$SumTotal."' ";
$sqlr.=",'".$BookDiscount."' ";
$sqlr.=",'1' ";
$sqlr.=",'1' ";
$sqlr.=",'".$Debt."' ";
$sqlr.=",'".$_POST["book_note"]."' ";
$sqlr.=",'".$c2."')";
if($db->query($sqlr)==TRUE)
$strbook_id=$db->insert_id;
for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
    if($_SESSION["strroom_id"][$i] != "")
    {
$sqlb = "SELECT * FROM room WHERE room_id = '".$_SESSION["strroom_id"][$i]."'";
$resultb = $db->query($sqlb);
$rowd = $resultb->fetch_assoc();
$sqlx = "INSERT INTO booklist ";
$sqlx.="(booklist_datein,booklist_dateout,booklist_price,booklist_numadults,booklist_numchild,book_id,room_id) ";
$sqlx.="VALUES ";
$sqlx.="('".$_SESSION["strbooklist_datein"][$i]."' ";
$sqlx.=",'".$_SESSION["strbooklist_dateout"][$i]."' ";
$sqlx.=",'".$rowd['room_rate']."' ";
$sqlx.=",'".$_SESSION["strAdultQty"][$i]."' ";
$sqlx.=",'".$_SESSION["strChildQty"][$i]."' ";
$sqlx.=",'".$strbook_id."' ";
$sqlx.=",'".$_SESSION["strroom_id"][$i]."')";

        $db->query($sqlx);
    }
  }
  $db->close();
unset($_SESSION["intLine"]);
unset($_SESSION["strroom_id"]);
unset($_SESSION["strbooklist_datein"]);
unset($_SESSION["strbooklist_dateout"]);
unset($_SESSION["strbooklist_dateout2"]);
unset($_SESSION["checkin"]);
unset($_SESSION["checkout"]);
unset($_SESSION["num_days"]);
unset($_SESSION['sum']);
unset($_SESSION['book_discount']);
unset($_SESSION['aaa']);
unset($_SESSION['ddd']);
unset($_SESSION['bbb']);
//header("location:cart.php");
//echo $sqlr;
alert_message('บันทึกการจองรหัส'.$strbook_id.'สำเร็จ');
goto_url("show_book.php");
}
   
?>
<?php
$result4 = $db->query("
SELECT `AUTO_INCREMENT`
FROM  INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'roomreserv'
AND   TABLE_NAME   = 'book'
");
$row4 = $result4->fetch_assoc();
$insert_num = $row4['AUTO_INCREMENT'];
?>
<h2 align="center">บันทึกการจอง</h2>
<div align="center">
<table width="927" border="0">
  <thead align="left">
    <tr>
      <td>รหัสการจอง BKN-<?=$insert_num?></td>
    </tr>
  </thead>
</table>
<table width=""  border="1">
  <thead align="center">
  <tr>
      <th ><div align="center">ลำดับ</div></th>
      <th ><div align="center">รูปห้องพัก</div></th>
      <th ><div align="center">ชื่อห้องพัก</div></th>
      <th ><div align="center">ราคาห้องพัก</div></th>
      <th width="80"><div align="center">ประเภท</div></th>
      <th width="70"><div align="center">ขนาด</div></th>
      <th width="100"><div align="center">วันที่เข้าพัก</div></th>
      <th width="100"><div align="center">วันที่ย้ายออก</div></th>
      <th width="50">ผู้ใหญ่</th>
      <th width="50">เด็ก</th>
      <th width="70"><div align="center">จำนวน</div></th>
      <th width="70"><div align="center">ราคา(บาท)</div></th>
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
    $sql = "SELECT * FROM room WHERE room_id = '".$_SESSION["strroom_id"][$i]."' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $Total = $row["room_rate"]*$_SESSION["strbooklist_dateout2"][$i];
    $SumTotal = $SumTotal + $Total;
    $TotalAdult = $_SESSION["strAdultQty"][$i];
    $SumTotalAdult = $SumTotalAdult + $TotalAdult;
    $TotalChild = $_SESSION["strChildQty"][$i];
    $SumTotalChild = $SumTotalChild + $TotalChild;
    ?>
    <tr>
      <td style="display:none;"><?=$_SESSION["strroom_id"][$i];?></td>
      <td align="center"><?=$a;?></td>
      <td align="center"><img src="../../../img/room/<?=$row['room_picture'];?>"width="100"height="100"/></td>
      <td align="center"><?=$row['room_name']; ?></td>
      <td align="center"><?=number_format($row['room_rate'],2); ?></td>
      <td align="center"><?=type_room($row['room_category']); ?></td>
      <td align="center"><?=$row['room_bed']*2;echo" ท่าน"; ?></td>
      <td align="center"><?=dmy($_SESSION["strbooklist_datein"][$i]);?></td>
      <td align="center"><?=dmy($_SESSION["strbooklist_dateout"][$i]);?></td>
      <td align="center"><?=$_SESSION["strAdultQty"][$i]?></td>
      <td align="center"><?=$_SESSION["strChildQty"][$i]?></td>
      <td align="center"><?=$_SESSION["strbooklist_dateout2"][$i]." วัน";?></td>
      <td align="center"><?=number_format($row['room_rate']*$_SESSION["strbooklist_dateout2"][$i],2); ?></td>
    </tr>
    <?php }}?>
</tbody>
</table>

<table width="930" border="0">
  <tr>
    <td></td>
    <?php 
        $c1=$_SESSION["login_cus_id"];
        $q1="select * from customer where cus_id = '$c1' ";
        $res1=$db->query($q1);
        $customer = $res1->fetch_assoc();

        if($customer['cus_type']==1)
          $_SESSION['book_discount']=0;
        else
          $_SESSION['book_discount']=$SumTotal*0.3;
        $_SESSION['sum']=$SumTotal-$_SESSION['book_discount'];
    ?>
    <td width="100" align="right">ประเภท</td>
    <td width="120" align="right"><?=type_cus($customer['cus_type'])?></td>
    
  </tr>
  <tr>
    <td></td>
    <td width="100" align="right">รวมทั้งหมด</td>
    <td width="120" align="right"><?=number_format($SumTotal,2);?> บาท</td>
    
  </tr>
  <tr>
    <td></td>
    <td align="right">ส่วนลด</td>
    <td align="right"><?=number_format($_SESSION['book_discount'],2);?> บาท</td>
    
  </tr>
  <tr>
    <td></td>
    <td align="right">รวมสุทธิ</td>
    <td align="right"><?=number_format($_SESSION['sum'],2);?> บาท</td>
    
  </tr>
  <tr>
    <td></td>
    <td align="right">ค่ามัดจำ</td>
    <td align="right"><font color="red"><?=number_format($_SESSION['sum']/2,2);?></font> บาท</td>
    
  </tr>
</table>
<font size="5" align="center">รายละเอียดการจอง</font>
<form name="form1" method="POST" action="save_booking.php">
  <table width="" border="1">
    <tr>
      <input type="hidden" name="SumTotalAdult" value="<?=$SumTotalAdult?>">
      <input type="hidden" name="SumTotalChild" value="<?=$SumTotalChild?>">
      <td align="center">หมายเหตุ</td>
      <td><div align="left"><textarea name="book_note" rows="4" cols="28"></textarea></div></td>  
    </tr>
  </table>
    <input class="btn btn-success" type="submit" name="submit" <?php if($_SESSION['sum']==0)echo "disabled";?> value="บันทึก" onclick="return confirm('ต้องการบันทึกการจองใช่หรือไม่?');" >
    <input class="btn btn-secondary" type="reset" name="reset" value="ล้างค่า">
    <input class="btn btn-danger" name="button2" type="button" id="button2" onclick="window.location=('cart_room.php');" value="ยกเลิก" />
</form>
</div>
</body>
</html>