<?php require'header.php';require'../../../public/switch.php';
if(isset($_GET['id'])){$sql="DELETE FROM customer WHERE cus_id='".$_GET['id']."'";if($db->query($sql)==TRUE){alert_message('ลบข้อมูลสำเร็จ รหัสลูกค้า : '.$_GET['id']);goto_url('show_cus.php');}else {alert_message('ไม่สามารถลบรายการข้อมูลที่เลือก');goto_url('show_cus.php');}}?>
<h1 align="center">แสดง/ลบข้อมูลลูกค้า</h1>
<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search"  id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<p align="center"><a class="btn btn-success pl-3 pr-3" href="add_cus.php">เพิ่มข้อมูลลูกค้า<a></p>
<table align="center" border="1" style="text-align:center;">
	<thead>
		<tr>
			<th width="80">รหัสลูกค้า</th>
			<th width="120">ชื่อลูกค้า</th>
			<th width="140">บัตรประชาชน</th>
			<th width="225">ที่อยู่</th>
			<th width="140">อีเมล์</th>
			<th width="100">วันเกิด</th>
			<th width="120">เบอร์โทรศัพท์</th>
			<th width="80">สถานะ</th>
			<th width="80">ประเภท</th>
			<th width="70">ลบ</th>
			<th width="70">แก้ไข</th>
		</tr>
	</thead>
	<tbody> 
		<?php
			$a=1;
			$sql="SELECT * FROM customer";
			$result=$db->query($sql);
$numrows = $result->num_rows;
$Per_Page = 4;   // Per Page
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
$sql .=" ORDER BY cus_id ASC LIMIT $Page_Start , $Per_Page";
$result = $db->query($sql);
			while ($row=$result->fetch_assoc()){?>
		<tr height="70">
			<td><?=$row['cus_id']?></td>
			<td align="left">&nbsp;<?=$row['cus_name']?></td>
			<td><?=$row['cus_citizenid']?></td>
			<td align="left">&nbsp;<?=$row['cus_address']?></td>
			<td><?=$row['cus_email']?></td>
			<?php if($row['cus_birthday']=='0000-00-00'){ echo "<td></td>";} else {?>
			<td><?=dmy($row['cus_birthday'])?></td>  <?php }?>
			<td><?=$row['cus_phone']?></td>
			<td><?=status_cus($row['cus_status'])?></td>
			<td><?=type_cus($row['cus_type'])?></td>
			<td><a class="btn btn-danger" href="show_cus.php?id=<?=$row['cus_id'];?>" onclick="return confirm('ต้องการลบข้อมูลลูกค้าใช่หรือไม่?')">ลบ</a></td>
			<td><a class="btn btn-primary" href="edit_cus.php?id=<?=$row['cus_id'];?>">แก้ไข</a></td>
		</tr>
		<?php }$result->free();$db->close();?>
	</tbody>
</table>
<p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="show_cus.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="show_cus.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="show_cus.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var search = $(this).val();
			$.ajax({
				url:'ajax/cus.php',
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