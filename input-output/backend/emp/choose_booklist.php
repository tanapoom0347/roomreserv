<?php require'header.php';require'../../../public/switch.php';?>
<h1 align="center">เลือกรายการจอง</h1><p></p>
<form class="form-inline justify-content-center"><div align="center">
<input class="form-control" type="search" size="40" placeholder="รหัสการจอง (กรอกเฉพาะตัวเลขหลังBKN-)" aria-label="Search"  id="search_text">
<input class="btn btn-primary ml-1 pl-5 pr-5" type="submit" name="Submit" id="button" value="ค้นหา"></div></form><p></p>
<div align="center">
<table align="center" border="1" style="text-align:center;">
	<thead>
		<tr>
			<th width="100">รหัสการจอง</th>
			<th width="100">วันที่จอง</th>
			<th width="100">รหัสลูกค้า</th>
			<th width="200">ชื่อลูกค้าจอง</th>
			<th width="180">เบอร์โทรศัพท์</th>
			<th width="100">เลือก</th>

		</tr>
	</thead>
	<tbody> 
		<?php
			$a=1;
			$sql="SELECT * FROM book where (book_status_deposit != 1) and (book_status_deposit != 5) and (book_status_deposit != 6) ORDER BY book_id DESC;";
			$result=$db->query($sql);
			while ($row=$result->fetch_assoc())
					
				{

				$sql2="SELECT * FROM customer WHERE cus_id = '".$row["cus_id"]."' ";
					$result2=$db->query($sql2);
					$row2=$result2->fetch_assoc();	

		?>
			<tr>
			<td>BKN-<?=$row['book_id']?></td>
			<td><?=dmy($row['book_date'])?></td>
			<td><?=$row['cus_id']?></td>
			<td><?=$row2['cus_name']?></td>
			<td><?=$row2['cus_phone']?></td>
			<td><a class="btn btn-success" href="save_servicecost.php?book_id=<?=$row['book_id']?>&rate=1">เลือก</a></td>
		</tr>
		<?php }$result->free();$db->close();?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var search = $(this).val();
			$.ajax({
				url:'ajax/choosebook.php',
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