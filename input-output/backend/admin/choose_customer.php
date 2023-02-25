<?php require'header.php';require'../../../public/switch.php';?>
<h2 align="center">เลือกลูกค้า</h2>
<div align="center">
	<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<table align="center" border="1" style="text-align:center;">
	<thead>
		<tr>
			<th width="100">รหัสลูกค้า</th>
			<th width="200">ชื่อลูกค้า</th>
			<th width="180">เบอร์โทรศัพท์</th>
			<th width="100">เลือก</th>

		</tr>
	</thead>
	<tbody> 
		<?php
			$a=1;
			$sql="SELECT * FROM customer";
			$result=$db->query($sql);
			while ($row=$result->fetch_assoc())	
			{
		?>

			<tr>
			<td><?=$row['cus_id']?></td>
			<td><?=$row['cus_name']?></td>
			<td><?=$row['cus_phone']?></td>
			<td><a class="btn btn-success" href="save_receipt.php?cus_id=<?=$row['cus_id']?>">เลือก</a></td>
		</tr>
		<?php }$result->free();$db->close();?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var search = $(this).val();
			$.ajax({
				url:'ajax/choosecus3.php',
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