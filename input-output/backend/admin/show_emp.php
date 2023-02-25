<?php require'header.php';require'../../../public/switch.php';
if(isset($_GET['id'])){$sql="DELETE FROM employee WHERE emp_id='".$_GET['id']."'";
if($db->query($sql)==TRUE){alert_message('ลบข้อมูลสำเร็จ รหัสพนักงาน : '.$_GET['id']);goto_url('show_emp.php');}
else {alert_message('ไม่สามารถลบรายการข้อมูลที่เลือก');goto_url('show_emp.php');}
}?>
<h1 align="center">แสดง/ลบข้อมูลพนักงาน</h1>
<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<p align="center"><a class="btn btn-success pl-3 pr-3" href="add_emp.php">เพิ่มข้อมูลพนักงาน<a></p>
<table align="center" border="1" style="text-align:center;" id="table-data">	
	<thead>
		<tr>
			<th width="100">รหัสพนักงาน</th>
			<th width="100">รูป</th>
			<th width="175">ชื่อพนักงาน</th>
			<th width="130">บัตรประชาชน</th>
			<th width="110">เบอร์โทรศัพท์</th>
			<th width="100">วันเกิด</th>
			<th width="205">อีเมล์</th>
			<th width="80">สถานะ</th>
			<th width="100">ระดับ</th>
			<th width="80">ลบ</th>
			<th width="80">แก้ไข</th>
		</tr>
	</thead>
	<tbody> 
		<?php
			$a=1;
			$sql="SELECT * FROM employee";
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
$sql .=" ORDER BY emp_id ASC LIMIT $Page_Start , $Per_Page";
$result = $db->query($sql);
			while ($row=$result->fetch_assoc()){?>
		<tr>
			<td><?=$row['emp_id']?></td>
			<td><img src="../../../img/emp/<?=$row['emp_picture']?>" width="90" height="90"/></td>
			<td><?=$row['emp_name']?></td>
			<td><?=$row['emp_citizenid']?></td>
			<td><?=$row['emp_phone']?></td>
			<?php if($row['emp_birthday']=='0000-00-00'){ echo "<td></td>";} else {?>
			<td><?=dmy($row['emp_birthday'])?></td> <?php }?>
			<td><?=$row['emp_email']?></td>
			<td><?=status_emp($row['emp_status'])?></td>
			<td><?=level_emp($row['emp_level'])?></td>
			<td><a class="btn btn-danger" href="show_emp.php?id=<?=$row['emp_id']; ?>" onclick="return confirm('ต้องการลบข้อมูลพนักงานใช่หรือไม่?')">ลบ</a></td>
			<td><a class="btn btn-primary" href="edit_emp.php?id=<?=$row['emp_id']; ?>">แก้ไข</a></td>
		</tr>
		<?php }$result->free();$db->close();?>
	</tbody>
</table>
<p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="show_emp.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="show_emp.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="show_emp.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var search = $(this).val();
			$.ajax({
				url:'ajax/emp.php',
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