<?php require'header.php';require'../../../public/switch.php';?>
<h1 align="center">แสดงรายการจอง</h1>
<form class="form-inline justify-content-center"><div align="center">
<input class="form-control" type="text" size="35" placeholder="รหัสการจอง (กรอกเฉพาะตัวเลขหลังBKN-)" aria-label="Search" id="search_text">
<input class="btn btn-primary ml-1 pl-5 pr-5" type="button" name="Submit" id="button" value="ค้นหา"></div></form>
<p></p>
<table align="center" width="" border="1">
  <thead align="center">
  <tr>
      <th width="100"><div align="center">รหัสการจอง</div></th>
      <th width="150"><div align="center">วันที่จอง</div></th>
      <th width="140"><div align="center">วันที่กำหนดเข้าพัก</div></th>
      <th width="50"><div align="center">ผู้ใหญ่</div></th>
      <th width="50"><div align="center">เด็ก</div></th>
      <th width="110"><div align="center">ราคารวม(บาท)</div></th>
      <th width="100"><div align="center" style="color:blue">ส่วนลด(บาท)</div></th>
      <th width="110"><div align="center">ค่ามัดจำ(บาท)</div></th>
      <th width="120"><div align="center">สถานะค่ามัดจำ</div></th>
      <th width="130">ค้างชำระ(บาท)</th>
      <th width="120"><div align="center">แจ้งหลักฐาน</div></th>
  </tr>
  </thead>
<tbody>
<?php
$c2=$_SESSION["login_cus_id"];
$sql = "SELECT  * FROM  book WHERE cus_id='".$c2."' order by book_id desc";
$result=$db->query($sql);
while($row = $result->fetch_assoc())
{
    ?>
    <tr height="40">
    <td align="center"><a href="show_book_detail.php?id=<?=$row["book_id"]?>">BKN-<?=$row["book_id"];?></a></td>
    <td align="center"><?=$row["book_date"];?></td>
    <td align="center"><?=$row["book_scheduled"];?></td>
    <td align="center"><?=$row["book_adult"];?></td>
    <td align="center"><?=$row["book_child"];?></td>
    <td align="right"><?=number_format($row["book_total"],2);?></td>
    <td align="right"><font color="blue"><?=number_format($row['book_discount'],2)?></font></td>
    <td align="right"><?=number_format($row["book_deposit"],2);?></td>
    <td align="center"><?=status_deposit($row["book_status_deposit"]);?></td>
    <td align="right"><font color="red"><?=number_format($row["book_debt"],2)?>&nbsp;&nbsp;</font></td>
    <td align="center"><?php if($row['book_status_deposit']==1){?><a class="btn btn-primary" href="confirm_deposit.php?id=<?=$row["book_id"];?>">แจ้งหลักฐาน</a><?php }?></td>
    </tr>
    <?php
 }$result->free();$db->close();
  ?>

</tbody>
</table>

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