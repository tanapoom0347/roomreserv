<?php require'header.php';require'../../../public/switch.php';?>
<h1 align="center">แสดงรายการบริการ</h1>
<form class="form-inline justify-content-center"><div align="center">
<input class="form-control" type="text" placeholder="Search" aria-label="Search" id="search_text">
<input class="btn btn-primary ml-1 pl-5 pr-5" type="button" name="Submit" id="button" value="ค้นหา"></div></form><p></p>
<table align="center" border="1" style="text-align:center;">
	<thead>
		<tr>
			<th width="100">รหัสบริการ</th>
			<th width="180">รูป</th>
			<th width="150">ชื่อรายการบริการ</th>
			<th width="130">ราคา(บาท)</th>
			<th width="110">หน่วยนับ</th>
			<th width="100">สถานที่</th>
		</tr>
	</thead>
	<tbody> 
		<?php
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
		<tr height="180">
			<td><?=$row['svlist_id'];?></td>
			<td><img src="../../../img/service/<?=$row['svlist_picture'];?>" width="170" height="170"/></td>
			<td><?=$row['svlist_name'];?></td>
			<td><?=number_format($row['svlist_price'],2);?></td>
			<td><?=$row['svlist_unit'];?></td>
			<td><?=$row['svlist_place'];?></td>
		</tr>
		<?php }$result->free();$db->close();?>
	</tbody>
</table>
<p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="show_service.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="show_service.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="show_service.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var search = $(this).val();
			$.ajax({
				url:'ajax/service.php',
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