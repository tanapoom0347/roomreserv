<?php require'header.php';require'../../../public/switch.php';
if(isset($_GET['id'])){$sql="DELETE FROM room WHERE room_id='".$_GET['id']."'";if($db->query($sql)==TRUE){alert_message('ลบข้อมูลสำเร็จ รหัสห้องพัก : '.$_GET['id']);goto_url('show_room.php');}else {alert_message('ไม่สามารถลบรายการข้อมูลที่เลือก');goto_url('show_room.php');}}?>
<h1 align="center">แสดง/ลบข้อมูลห้องพัก</h1>
<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<p align="center"><a class="btn btn-success pl-3 pr-3" href="add_room.php">เพิ่มข้อมูลห้องพัก<a></p>
<table align="center" border="1" style="text-align:center;">
	<thead>
		<tr>
			<th width="90">รหัสห้องพัก</th>
			<th width="100">รูปภาพ</th>
			<th width="100">ชื่อห้องพัก</th>
			<th width="115">ประเภท</th>
			<th width="115">ราคา(บาท)</th>
			<th width="90">จำนวนเตียง</th>
			<th width="115">ราคาเตียงเสริม (บาท)</th>
			<th width="80">สถานะบริการ</th>
			<th width="70">ลบ</th>
			<th width="70">แก้ไข</th>
		</tr>
	</thead>
	<tbody> 
		<?php
			$a=1;
			$sql="SELECT * FROM room";
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
$sql .=" ORDER BY room_id ASC LIMIT $Page_Start , $Per_Page";
$result = $db->query($sql);
			while ($row=$result->fetch_assoc()){?>
		<tr>
			<td><?=$row['room_id']?></td>
			<td><img src="../../../img/room/<?=$row['room_picture'];?>" width="90" height="90"/></td>
			<td><?=$row['room_name']?></td>
			<td><?=type_room($row['room_category'])?></td>
			<td><?=number_format($row['room_rate'],2)?></td>
			<td><?=$row['room_bed']?></td>
			<td><?=number_format($row['room_price'],2)?></td>
			<td><?=status_room($row['room_statsv'])?></td>
			<td><a class="btn btn-danger" href="show_room.php?id=<?=$row['room_id']; ?>" onclick="return confirm('ต้องการลบข้อมูลห้องพักใช่หรือไม่?')">ลบ</a></td>
			<td><a class="btn btn-primary" href="edit_room.php?id=<?=$row['room_id']; ?>">แก้ไข</a></td>
		</tr>
		<?php }$result->free();$db->close();?>
	</tbody>
</table>
<p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="show_room.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="show_room.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="show_room.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var search = $(this).val();
			$.ajax({
				url:'ajax/room.php',
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