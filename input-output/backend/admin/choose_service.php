<?php require'header.php';require'../../../public/switch.php';?>
<h1 align="center">แสดงรายการบริการ</h1><p></p>
<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<div align="center">
	<a class="btn btn-success" href="cart_servicecost.php">เลือก/ยกเลิกรายการบริการ</a><p></p>
<table align="center" border="1" style="text-align:center;">
	<thead>
		<tr>
			<th width="150">รหัสรายการบริการ</th>
			<th width="100">รูป</th>
			<th width="175">ชื่อรายการบริการ</th>
			<th width="130">ราคา(บาท)</th>
			<th width="110">หน่วยนับ</th>
			<th width="100">สถานที่</th>
			<th width="85">สถานะบริการ</th>
			<th width="100">เลือก</th>

		</tr>
	</thead>
	<tbody> 
		<?php
			$a=1;
			$sql="SELECT * FROM servicelist";
			$result=$db->query($sql);
$numrows = $result->num_rows;
$Per_Page = 3;   // Per Page
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
$sql .=" ORDER BY svlist_id ASC LIMIT $Page_Start , $Per_Page";
$result = $db->query($sql);
			while ($row=$result->fetch_assoc()){?>
		<tr>
			<td><?=$row['svlist_id']?></td>
			<td><img src="../../../img/service/<?=$row['svlist_picture']?>" width="90" height="90"/></td>
			<td><?=$row['svlist_name']?></td>
			<td><?=number_format($row['svlist_price'],2)?></td>
			<td><?=$row['svlist_unit']?></td>
			<td><?=$row['svlist_place']?></td>
			<td><?=status_service($row['svlist_statsv'])?></td>
			<td><a class="btn btn-success" href="cart_servicecost.php?svlist_id=<?=$row['svlist_id']?>">เลือก</a></td>
		</tr>
		<?php }$result->free();$db->close();?>
	</tbody>
</table>
<p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="choose_service.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="choose_service.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="choose_service.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var search = $(this).val();
			$.ajax({
				url:'ajax/list_service.php',
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