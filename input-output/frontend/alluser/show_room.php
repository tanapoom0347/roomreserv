<?php require'header.php';require'../../../public/switch.php';?>
<?php 
	$sql="SELECT * FROM room ";
	if(isset($_GET['type'])){
		$t=$_GET['type'];
		if ($t==0) {
			$sql="SELECT * FROM room ";
		}
		else {
			$sql="SELECT * FROM room  where room_category = '$t' ";
		}
	}
?>
<h1 align="center">แสดงห้องพัก</h1>
<form class="form-inline justify-content-center"><div align="center">
<input class="form-control" type="text" placeholder="Search" aria-label="Search" id="search_text">
<input class="btn btn-primary ml-1 pl-5 pr-5" type="button" name="button1" id="button1" value="ค้นหา"></div>
<label for="type"><b>&nbsp;&nbsp;&nbsp;ประเภท&nbsp;</b></label>
<select name="type" onchange="this.form.submit()">
			<option <?php if($_GET['type']==0){echo 'selected';}?> value="0">ทั้งหมด</option>
			<option <?php if($_GET['type']==1){echo 'selected';}?> value="1">Sea view</option>
			<option <?php if($_GET['type']==2){echo 'selected';}?> value="2">Top</option>
			<option <?php if($_GET['type']==3){echo 'selected';}?> value="3">Vip</option>
			<option <?php if($_GET['type']==4){echo 'selected';}?> value="4">Big House</option>
		</select>
</form><p></p>
<p></p>
<table align="center" border="1" style="text-align:center;" id="table-data">
	<thead>
		<tr>
			<th width="100">รหัสห้องพัก</th>
			<th width="100">รูปภาพ</th>
			<th width="100">ชื่อห้องพัก</th>
			<th width="115">ประเภท</th>
			<th width="115">ราคา(บาท)</th>
			<th width="90">จำนวนเตียง</th>
			<th width="115">ราคาเตียงเสริม</th>
		</tr>
	</thead>
	<tbody> 
		<?php
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
			while ($row = $result->fetch_assoc()){?>
		<tr>
			<td><?=$row['room_id'];?></td>
			<td><img src="../../../img/room/<?=$row['room_picture'];?>" width="150" height="150"/></td>
			<td><?=$row['room_name'];?></td>
			<td><?=type_room($row['room_category']);?></td>
			<td><?=number_format($row['room_rate'],2);?></td>
			<td><?=$row['room_bed'];?></td>
			<td><?=number_format($row['room_price'],2);?></td>
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