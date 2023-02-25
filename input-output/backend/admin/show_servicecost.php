<?php require'header.php';require'../../../public/switch.php';?>
<h1 align="center" style="color:black">แสดงค่าใช้จ่าย</h1>
<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" size="38" placeholder="รหัสค่าใช้จ่าย (กรอกเฉพาะตัวเลขหลังSVC-)" aria-label="Search" id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<div align="center">
  <a class="btn btn-success" href="cart_receipt.php">เลือก/ยกเลิกค่าใช้จ่าย</a><p></p>
<table width="" border="1">
<thead>
  <tr>
  	  <th width="120"><div align="center">รหัสค่าใช้จ่าย</div></th>
      <th width="150" ><div align="center">รหัสการจอง</div></th>
      <th width="160" ><div align="center">วันที่</div></th>
      <th width="160" ><div align="center">ชื่อลูกค้า</div></th>
      <th width="160" ><div align="center">เบอร์โทรศัพท์</div></th>
      <th width="180"><div align="center">ราคารวม(บาท)</div></th>
      <th width="80"><div align="center">ส่วนลด(บาท)</div></th>
      <th width="120"><div align="center">ยอดสุทธิ(บาท)</div></th>
      <th width="120"><div align="center">สถานะ</div></th>
      <th width="100"><div align="center"></div></th>
  </tr>
  </thead>
  <tbody>
    <?php 
      $Total = 0;
      $SumTotal = 0;

      $sql = "select * from servicecost";
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
$sql .=" ORDER BY svcost_id DESC LIMIT $Page_Start , $Per_Page";
$result = $db->query($sql);
      while ($row=$result->fetch_assoc()) {
      $sql1 = "select * from book where book_id = '".$row["book_id"]."' ";
      $result1 = $db->query($sql1);
      $row1 = $result1->fetch_assoc();
      $sql2 = "select * from customer where cus_id = '".$row1["cus_id"]."' ";
      $result2 = $db->query($sql2);
      $row2 = $result2->fetch_assoc();
?>
  	<tr height="40">
  		<td align="center"><a href="show_servicecost_detail.php?id=<?=$row['svcost_id']?>">SVC-<?=$row['svcost_id']?></a></td>
  		<td align="center">BKN-<?=$row['book_id']?></td>
      <td align="center"><?=dmy($row['svcost_date'])?></td>
  		<td align="center"><?=$row2['cus_name']?></td>
      <td align="center"><?=$row2['cus_phone']?></td>
  		<td align="right"><?=number_format($row['svcost_total'],2)?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="right"><font color="red"><?=number_format($row['svcost_discount'],2)?></font>&nbsp;</td>
      <td align="right"><?=number_format($row['svcost_net'],2)?>&nbsp;</td>
  		<td align="center"><?=status_svcost($row['svcost_status'])?></td>
      <?php 
      if($row['svcost_status']==0){ ?>
      <td align="center"><a class="btn btn-success" href="cart_receipt.php?svcost_id=<?=$row['svcost_id']?>">เลือก</a></td>
    <?php }
      else echo "<td></td>";
    ?>

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
    <li class="page-item"><a class="page-link" href="show_servicecost.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="show_servicecost.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="show_servicecost.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
  $(document).ready(function(){
    $('#search_text').keyup(function(){
      var search = $(this).val();
      $.ajax({
        url:'ajax/servicecost.php',
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