<?php require'header.php';require'../../../public/switch.php';?>
<?php 
  if(isset($_GET['confirmid']))
  {
    $confirmid = $_GET['confirmid'];
    $sql = "UPDATE book SET book_status_deposit = '3',book_debt = book_total/2 WHERE book_id = '".$confirmid."'";
    if($result=$db->query($sql)){alert_message('ยืนยันหลักฐานรหัสการจอง '.$confirmid.' สำเร็จ');goto_url('show_book.php');}
  }
?>
<?php 
  if(isset($_GET['checkoutid']))
  {
    $book_id = $_GET['checkoutid'];
    $sql=" UPDATE book SET";
    $sql.=" book_status_deposit = '6' ";
    $sql.=", book_status_pay = '2' ";
    $sql.=" WHERE book_id = '$book_id' ";
    if($db->query($sql)==TRUE)
    {
      alert_message('บันทึกการย้ายออกรหัสการจอง '.$book_id.' สำเร็จ');
      goto_url('show_book.php');
    }
    else
    {
      echo $sql;
    }
  }
?>
<?php 
	if(isset($_GET['id'])){
		$sql = "UPDATE book SET book_status_deposit = '0' WHERE book_id = '".$_GET['id']."' ;";
    if($db->query($sql)==TRUE){
      alert_message('ยกเลิกรหัสการจอง '.$_GET['id'].' สำเร็จ');
      goto_url('show_book.php');
    }
	}
?>
<h1 align="center">แสดง/ยกเลิกการจองห้องพัก</h1>
<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" size="50" placeholder="รหัสการจอง (กรอกเฉพาะตัวเลขหลังBKN-) , รหัสลูกค้า" aria-label="Search"  id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<table align="center" width="" border="1">
  <thead>
  <tr>
      <th width="100"><div align="center">เลขที่ใบจอง</div></th>
      <th width="150"><div align="center">วันที่จอง</div></th>
      <th width="130"><div align="center">รหัสลูกค้า</div></th>
      <th width="130"><div align="center">ชื่อลูกค้า</div></th>
      <th width="140"><div align="center">วันที่กำหนดเข้าพัก</div></th>
      <th width="120"><div align="center">ราคารวม(บาท)</div></th>
      <th width="100"><div align="center" style="color:blue">ส่วนลด(บาท)</div></th>
      <th width="120"><div align="center">ค่ามัดจำ(บาท)</div></th>
      <th width="120"><div align="center">สถานะค่ามัดจำ</div></th>
      <th width="120"><div align="center">ค้างชำระ(บาท)</div></th>
      <th width="120"><div align="center">สถานะค้างชำระ</div></th>
      <th width="120"><div align="center">หลักฐาน</div></th>
      <th width="124"><div align="center"></div></th>
      <th width="100"><div align="center"></div></th>
  </tr>
  </thead>
  <tbody>
<?php
$sql = " SELECT  * FROM  book";
$result = $db->query($sql);
$numrows = $result->num_rows;
$Per_Page = 8;   // Per Page
$Page = $_GET["page"];
if(!$_GET["page"])
{$Page=1;}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($numrows<=$Per_Page)
{$Num_Pages =1;}
else if(($numrows % $Per_Page)==0)
{$Num_Pages =($numrows/$Per_Page) ;}
else
{$Num_Pages =($numrows/$Per_Page)+1;
$Num_Pages = (int)$Num_Pages;}
$sql .=" ORDER BY book_id DESC LIMIT $Page_Start , $Per_Page";
$result = $db->query($sql);
while($row = $result->fetch_assoc())
{
$sql2 = "SELECT * FROM customer WHERE cus_id = '".$row["cus_id"]."' ";
$result2 = $db->query($sql2);
$row2 = $result2->fetch_assoc();
    ?>
    <tr height="35">
    <td align="center"><a href="show_book_detail.php?id=<?=$row["book_id"]?>">BKN-<?=$row["book_id"];?></a></td>
    <td align="center"><?=dmy($row["book_date"]);?></td>
    <td align="center"><?=$row2["cus_id"];?></td>
    <td align="center"><?=$row2["cus_name"];?></td>
    <td align="center"><?=dmy($row["book_scheduled"]);?></td>
    <td align="right"><?=number_format($row["book_total"],2);?></td>
    <td align="right"><font color="blue"><?=number_format($row['book_discount'],2)?></font></td>
    <td align="right"><?=number_format($row["book_deposit"],2);?></td>
    <td align="center"><?=status_deposit($row["book_status_deposit"]);?></td>
    <td align="right"><font color="red"><?=number_format($row["book_debt"],2)?></font></td>
    <td align="center"><?=status_pay($row["book_status_pay"]);?></td>
    <?php if($row['book_status_deposit']==2) {?>
    <td align="center"><a href="../../../img/deposit/<?=$row['book_deposit_picture']?>" target="_blank"><img src="../../../img/deposit/<?=$row['book_deposit_picture']?>" width="90" height="90"/></a></td><?php }
    else {?><td></td><?php }?>
    <?php if($row['book_status_deposit']==2) {?>
    <td align="center"><a class="btn btn-info" href="?confirmid=<?=$row["book_id"];?>" onclick="return confirm('ต้องการยืนยันหลักฐานใช่หรือไม่?')">ยืนยันหลักฐาน</a></td><?php }
    elseif($row['book_status_deposit']==3){?>
      <td align="center"><a class="btn btn-success" href="confirm_checkin.php?id=<?=$row["book_id"]?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เข้าพัก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td><?php }
    elseif($row['book_status_deposit']==4){?>
      <td align="center"></td><?php }
    elseif($row['book_status_deposit']==5){?>
      <td align="center"><a class="btn btn-danger" href="confirm_checkout.php?id=<?=$row['book_id']?>">&nbsp;&nbsp;&nbsp;ย้ายออก&nbsp;&nbsp;&nbsp;</a></td><?php }
    elseif($row['book_status_deposit']==6){?>
      <td align="center"></td><?php }
    else {?>
      <td></td><?php }?>
    <?php 
    if(($row['book_status_deposit']==1)||($row['book_status_deposit']==2)) {?>
      <td align="center"><a class="btn btn-danger" href="JavaScript:if(confirm('ยกเลิกใบจอง') == true){window.location='show_book.php?id=<?=$row["book_id"];?>';}">ยกเลิกจอง</a></td><?php } 
    elseif($row['book_status_deposit']==0) {?>
      <td align="center"></td><?php } 
    else {?>
      <td  align="center"><a class="btn btn-warning" href="bill_reservation.php?id=<?=$row['book_id']?>" target="_blank">ใบจอง</a></td> <?php }?>
    </tr>
    <?php
 }
  ?>

</tbody>
</table>

<p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="show_book.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="show_book.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="show_book.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
  $(document).ready(function(){
    $('#search_text').keyup(function(){
      var search = $(this).val();
      $.ajax({
        url:'ajax/book.php',
        method:'post',
        data:{query:search},
        success:function(response){
          $('tbody').html(response);
        }
      })
    })
  })
</script>

</body>
</html>