<?php require'header.php';require'../../../public/switch.php';?>
<?php 
if(isset($_POST['submit'])){
  $re_bank = $_POST['re_bank'];
  $re_branch = $_POST['re_branch'];
  $re_detail = $_POST['re_detail'];
  $receipt_id = $_POST['receipt_id'];
  $receipt_numcheck = $_POST['receipt_numcheck'];
  $receipt_detail = $_POST['receipt_detail'];
  $receipt_bank = $_POST['receipt_bank'];
  $receipt_branch = $_POST['receipt_branch'];
  $receipt_paymenttype = $_POST['receipt_paymenttype'];
  $receipt_discount = $_POST['receipt_discount'];
  $date = date("Y-m-d H:i:s");
  $emp_id = $_POST['emp_id'];
  $sql=" UPDATE receipt SET";
  $sql.=" receipt_status = '1' ";
  $sql.=" ,receipt_numcheck = '$receipt_numcheck' ";
  $sql.=" ,receipt_detail = '$re_detail' ";
  $sql.=" ,receipt_bank = '$re_bank' ";
  $sql.=" ,receipt_branch = '$re_branch' ";
  $sql.=" ,receipt_paymenttype = '$receipt_paymenttype' ";
  $sql.=" ,receipt_date = '$date' ";
  $sql.=" ,emp_id = '$emp_id' ";
  $sql.=" WHERE receipt_id = '$receipt_id' ";
  $db->query("UPDATE servicecost SET svcost_status = '1' WHERE receipt_id = '$receipt_id'");
  if($db->query($sql)==TRUE)
  {
    $q1 = "select * from servicecost where receipt_id = '$receipt_id' ";
    $res1 = $db->query($q1);
    while ($svc = $res1->fetch_assoc()) {
      $book_id = $svc['book_id'];
      
      //echo $book_id;
      $q2 = "select * from book where book_id = '$book_id' ";
      $res2 = $db->query($q2);
      $book = $res2->fetch_assoc();
      $bk_id = $book['book_id'];
      //echo '<br>'.$bk_id;
      if ($svc['svcost_status']==1) {
        $q3 = "UPDATE book SET book_status_deposit = '5', book_status_pay = '2',book_debt = 0 WHERE book_id = '$bk_id' ";
      }
      else {
        $q3 = "UPDATE book SET book_status_deposit = '5', book_status_pay = '3',book_debt = 0 WHERE book_id = '$bk_id' ";
      }
      
      //echo '<br>'.$q3;
      $db->query($q3);
    }
    alert_message('บันทึกการชำระ RC-'.$receipt_id.' สำเร็จ');
    goto_url('show_receipt.php');
  }
  else
  {
    echo $sql;
  }
}
?>
<?php 
if(isset($_GET['id'])){
  $receipt_id = $_GET['id'];
}
?>
<h1 align="center" style="color:black">บันทึกการรับชำระ</h1>
<div align="center">
<table border="1">
  <thead align="center">
    <tr>
      <th width="140">รหัสค่าใช้จ่าย</th>
      <th width="140">วันที่ใช้บริการ</th>
<!--      <th width="160">รหัสการจอง</th>
      <th width="160">ชื่อลูกค้า</th> -->
      <th width="140">รวม(บาท)</th>
      <th width="140">ส่วนลด(บาท)</th>
      <th width="140">สุทธิ(บาท)</th>
    </tr>
  </thead>
  <tbody align="center">
    <?php
    $str1 = "select * from servicecost where receipt_id = '".$receipt_id."' ";
    $res1 = $db->query($str1);
    while ($row1 = $res1->fetch_assoc()) { 
    $str2 = "select * from book where book_id = '".$row1['book_id']."' ";
    $res2 = $db->query($str2);
    $row2 = $res2->fetch_assoc();
    $str3 = "select * from customer where cus_id = '".$row2['cus_id']."' ";
    $res3 = $db->query($str3);
    $row3 = $res3->fetch_assoc();
    ?>
    <tr>
      <td>SVC-<?=$row1['svcost_id']?></td>
      <td><?=dmy($row1['svcost_date'])?></td>
<!--      <td>BKN-<?=$row2['book_id']?></td>
      <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$row3['cus_name']?></td> -->
      <td align="right"><?=number_format($row1['svcost_total'],2)?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="right"><?=number_format($row1['svcost_total']-$row1['svcost_net'],2)?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="right"><?=number_format($row1['svcost_net'],2)?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <?php }?>
  </tbody>
</table><p></p>
<?php
  $str4 = "select * from receipt where receipt_id = '".$receipt_id."' ";
  $res4 = $db->query($str4);
  $row4 = $res4->fetch_assoc();
  $str5 = "select * from customer where cus_id = '".$row4['cus_id']."' ";
  $res5 = $db->query($str5);
  $row5 = $res5->fetch_assoc();
 ?>

<table border="0" align="center">
  <tr>
    <td width="100" align="right"><b>รวมทั้งหมด</b></td>
    <td width="130" align="right"><?=number_format($row4['receipt_net']+$row4['receipt_discount'],2)?> บาท</td>
  </tr>
  <tr>
    <td align="right"><b>ส่วนลด</b></td>
    <td align="right"><?=number_format($row4['receipt_discount'],2)?> บาท</td>
  </tr>
  <tr>
    <td align="right"><b>ยอดชำระ</b></td>
    <td align="right"><?=number_format($row4['receipt_net'],2)?> บาท</td>
    
  </tr>
</table>

<p></p>


<form method="post">
  <table border="1">
    <tbody align="right">
      <tr>
        <input type="hidden" name="receipt_id" value="<?=$row4['receipt_id']?>">
        <input type="hidden" name="emp_id" value="<?=$_SESSION['login_emp_id']?>">
        <td width="325" colspan="2" align="center">รหัส RC-<?=$row4['receipt_id']?></td>
      </tr>
      <tr>
        <td width="135">ชื่อลูกกค้า&nbsp;</td>
        <td align="left">&nbsp;<?=$row5['cus_name']?></td>
      </tr>
      <tr>
        <td>ประเภทการชำระ<span style="color:red">*</span>&nbsp;</td>
        <td align="left">
          <select name="receipt_paymenttype" onchange="document.location.href=this.value">
            <option <?php if($_GET['pay']=='cash')echo "selected";?> value="pay_receipt.php?id=<?=$_GET['id']?>&pay=cash">เงินสด</option>
            <option <?php if($_GET['pay']=='bank')echo "selected";?> value="pay_receipt.php?id=<?=$_GET['id']?>&pay=bank">เงินโอน</option>
            <option <?php if($_GET['pay']=='check')echo "selected";?> value="pay_receipt.php?id=<?=$_GET['id']?>&pay=check">เช็ค</option>
          </select>
        </td>
      </tr>
      <?php 
      if($_GET['pay']=='bank'){ ?>
        <tr>
          <td>ธนาคาร<span style="color:red">*</span>&nbsp;</td>
          <td align="left"><input type="" name="re_bank" size="15" required=""></td>
        </tr>
        <tr>
          <td>สาขา<span style="color:red">*</span>&nbsp;</td>
          <td align="left"><input type="" name="re_branch" size="10" required=""></td>
        </tr>
<?php 
      }
      elseif ($_GET['pay']=='check') { ?>
        <tr>
          <td>เลขที่เช็ค<span style="color:red">*</span>&nbsp;</td>
          <td align="left"><input type="" name="re_detail" size="15" required=""></td>
        </tr>
<?php 
      }
      if($_GET['pay']=='cash') echo "<input name='receipt_paymenttype' type='hidden' value='1'>";
      elseif ($_GET['pay']=='bank') echo "<input name='receipt_paymenttype' type='hidden' value='2'>";
      else echo "<input name='receipt_paymenttype' type='hidden' value='3'>";
      ?>

      <tr height="50">
        <td colspan="2" align="center">
          <input class="btn btn-success" type="submit" onclick="return confirm('ต้องการบันทึกใช่หรือไม่?')" name="submit" value="บันทึก">
          <input class="btn btn-secondary" type="reset" value="ล้างค่า">
          <a class="btn btn-danger" href="show_receipt.php">ยกเลิก</a>
        </td>
      </tr>
    </tbody>
  </table>
</form>

</div>
</body>
</html>