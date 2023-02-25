<?php require'header.php';require'../../../public/switch.php';?>
<style type="text/css">
	table,th, td {
  border-left: none;
  border-right: none;
}
	td {
		border-top: none;
		border-bottom: none;
	}
</style>
<style>
@media print {
    #div1, .div2 {
        display: none;
    }
}
</style>
<div align="center">
	<h4>แสงเทียน บีช รีสอร์ท</h4><p></p>
	<h4>รายงานห้องพักแยกตามประเภท</h4><p></p>
	<table width="900"><td align="left"><?=printdate()?></td></table>
	<table border="1">
		<thead align="center">
			<tr>
				<th width="150">ชื่อประเภท</th>
				<th width="150">รหัสห้องพัก</th>
				<th width="150">ชื่อห้องพัก</th>
				<th width="150">จำนวนเตียง</th>
				<th width="150">สถานะใช้งาน</th>
				<th width="150">ราคา(บาท)</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php 
			$sql = "select * from room where room_category = 1";
			$res = $db->query($sql);
			?>
			<tr>
				<td align="left" colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=type_room(1)?></td>
			</tr>
			<?php 
			while ($row = $res->fetch_assoc()) { ?>
			<tr>
				<td></td>
				<td><?=$row["room_id"]?></td>
				<td><?=$row["room_name"]?></td>
				<td><?=$row["room_bed"]?></td>
				<td><?=status_room($row["room_status"])?></td>
				<td><?=number_format($row["room_rate"],2)?></td>
			</tr>
			<?php 
			}
			$str = "SELECT
						count(room_id)
					AS
						total
					FROM
						room
					WHERE
						room_category = 1";
			$obj = $db->query($str);
			$sel = $obj->fetch_assoc();
			$count1 = $sel['total'];
			?>
			<tr>
				<th align="right" colspan="6">รวม <?=$count1?> ห้อง&nbsp;&nbsp;</th>
			</tr>
			
			<?php 
			$sql = "select * from room where room_category = 2";
			$res = $db->query($sql);
			?>
			<tr>
				<td align="left" colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=type_room(2)?></td>
			</tr>
			<?php 
			while ($row = $res->fetch_assoc()) { ?>
			<tr>
				<td></td>
				<td><?=$row["room_id"]?></td>
				<td><?=$row["room_name"]?></td>
				<td><?=$row["room_bed"]?></td>
				<td><?=status_room($row["room_status"])?></td>
				<td><?=number_format($row["room_rate"],2)?></td>
			</tr>
			<?php 
			}
			$str = "SELECT
						count(room_id)
					AS
						total
					FROM
						room
					WHERE
						room_category = 2";
			$obj = $db->query($str);
			$sel = $obj->fetch_assoc();
			$count2 = $sel['total'];
			?>
			<tr>
				<th align="right" colspan="6">รวม <?=$count2?> ห้อง&nbsp;&nbsp;</th>
			</tr>

			<?php 
			$sql = "select * from room where room_category = 3";
			$res = $db->query($sql);
			?>
			<tr>
				<td align="left" colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=type_room(3)?></td>
			</tr>
			<?php 
			while ($row = $res->fetch_assoc()) { ?>
			<tr>
				<td></td>
				<td><?=$row["room_id"]?></td>
				<td><?=$row["room_name"]?></td>
				<td><?=$row["room_bed"]?></td>
				<td><?=status_room($row["room_status"])?></td>
				<td><?=number_format($row["room_rate"],2)?></td>
			</tr>
			<?php 
			}
			$str = "SELECT
						count(room_id)
					AS
						total
					FROM
						room
					WHERE
						room_category = 3";
			$obj = $db->query($str);
			$sel = $obj->fetch_assoc();
			$count3 = $sel['total'];
			?>
			<tr>
				<th align="right" colspan="6">รวม <?=$count3?> ห้อง&nbsp;&nbsp;</th>
			</tr>

			<?php 
			$sql = "select * from room where room_category = 4";
			$res = $db->query($sql);
			?>
			<tr>
				<td align="left" colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=type_room(4)?></td>
			</tr>
			<?php 
			while ($row = $res->fetch_assoc()) { ?>
			<tr>
				<td></td>
				<td><?=$row["room_id"]?></td>
				<td><?=$row["room_name"]?></td>
				<td><?=$row["room_bed"]?></td>
				<td><?=status_room($row["room_status"])?></td>
				<td><?=number_format($row["room_rate"],2)?></td>
			</tr>
			<?php 
			}
			$str = "SELECT
						count(room_id)
					AS
						total
					FROM
						room
					WHERE
						room_category = 4";
			$obj = $db->query($str);
			$sel = $obj->fetch_assoc();
			$count4 = $sel['total'];
			?>
			<tr>
				<th align="right" colspan="6">รวม <?=$count4?> ห้อง&nbsp;&nbsp;</th>
			</tr>
			<?php
			$str = "SELECT
						count(room_id)
					AS
						total
					FROM
						room";
			$obj = $db->query($str);
			$sel = $obj->fetch_assoc();
			$count = $sel['total'];
			?>
			<tr>
				<th align="right" colspan="6"><font color="red">รวมทั้งหมด <?=$count?> ห้อง</font>&nbsp;&nbsp;</th>
			</tr>
		</tbody>
	</table>
	<font color="green">รวม <?=type_room(1)?> ทั้งหมด <?=$count1?> ห้อง</font>&nbsp;&nbsp;
	<font color="red">รวม <?=type_room(2)?> ทั้งหมด <?=$count2?> ห้อง</font>&nbsp;&nbsp;
	<font color="fuchsia">รวม <?=type_room(3)?> ทั้งหมด <?=$count3?> ห้อง</font>&nbsp;&nbsp;
	<font color="blue">รวม <?=type_room(4)?> ทั้งหมด <?=$count4?> ห้อง</font>&nbsp;&nbsp;
</div>
</body>
</html>