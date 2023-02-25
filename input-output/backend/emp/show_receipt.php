<?php require'header.php';require'../../../public/switch.php';?>
<h1 align="center" style="color:black">แสดงการชำระ</h1>
<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" size="42" placeholder="รหัสใบเสร็จรับเงิน  (กรอกเฉพาะตัวเลขหลังRC-)" aria-label="Search"  id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<div align="center">
<table width="" border="1">
<thead>
  <tr>
  	  <th width="140"><div align="center">รหัสใบเสร็จรับเงิน</div></th>
      <th width="130" ><div align="center">รหัสลูกค้า</div></th>
      <th width="130" ><div align="center">ชื่อลูกค้า</div></th>
      <th width="130" ><div align="center">เบอร์โทรศัพท์</div></th>
      <th width="140" ><div align="center">วันที่ออกใบเสร็จ</div></th>
      <th width="120"><div align="center">ราคารวม(บาท)</div></th> 
      <th width="120"><div align="center">ส่วนลด(บาท)</div></th>
      <th width="120"><div align="center">ยอดชำระ(บาท)</div></th>
      <th width="100"><div align="center">สถานะ</div></th>
      <th width="70"><div align="center">ชำระ</div></th>
      <th width="70"><div align="center">ใบเสร็จรับเงิน</div></th>
  </tr>
  </thead>
  <tbody>
    <?php
    $sql = "select * from receipt";
    $result = $db->query($sql);
$numrows = $result->num_rows;
$Per_Page = 6;   // Per Page
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
$sql .=" ORDER BY receipt_id DESC LIMIT $Page_Start , $Per_Page";
$result = $db->query($sql);
    while ($row = $result->fetch_assoc())
    {
      $sql2 = "select * from customer where cus_id = '".$row["cus_id"]."'";
      $result2 = $db->query($sql2);
      $row2 = $result2->fetch_assoc();
    ?>
  	<tr height="35">
  		<td align="center"><a href="show_receipt_detail.php?id=<?=$row["receipt_id"]?>">RC-<?=$row["receipt_id"]?></a></td>
      <td align="center"><?=$row["cus_id"]?></td>
  		<td align="center"><?=$row2["cus_name"]?></td>
      <td align="center"><?=$row2["cus_phone"]?></td>
      <td align="center"><?=dmy($row["receipt_outdate"])?></td>
  		<td align="right"><?=number_format($row["receipt_net"]+$row["receipt_discount"],2)?>&nbsp;&nbsp;</td>
      <td align="right"><?=number_format($row["receipt_discount"],2)?>&nbsp;&nbsp;</td>
      <td align="right"><?=number_format($row["receipt_net"],2)?>&nbsp;&nbsp;</td>
  		<td align="center"><?=status_receipt($row["receipt_status"])?></td>
      <?php  if($row["receipt_status"]==0){?>
      <td align="center"><a class="btn btn-success" href="pay_receipt.php?id=<?=$row["receipt_id"]?>&pay=cash">ชำระ</a></td> <?php }
      else { ?> <td></td> <?php }?>
      <?php  if($row["receipt_status"]==1){?>
      <td align="center"><a class="btn btn-primary" href="bill_receipt.php?id=<?=$row['receipt_id']?>" target="_blank">พิมพ์</a></td> <?php }
      else { ?> <td></td> <?php }?>
  	</tr>
    <?php 
    }
    ?>
  </tbody>
</table></div>

<p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="show_receipt.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="show_receipt.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="show_receipt.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
  $(document).ready(function(){
    $('#search_text').keyup(function(){
      var search = $(this).val();
      $.ajax({
        url:'ajax/receipt.php',
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