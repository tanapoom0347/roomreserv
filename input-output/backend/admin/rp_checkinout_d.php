<?php require'header.php';require'../../../public/switch.php';require'../../../public/datediff.php';?>
<style type="text/css">
	table,th, td {
  border-left: none;
  border-right: none;
}
	td {
		border-top: none;
		border-bottom: none;
	}
	#sh1 ,#sh2 {
		display: none;
	}
</style>
<style>
@media print {
    #div1, #div2 ,#hide1, #hide2{
        display: none;
    }
    #sh1 ,#sh2 {
		display: block;
	}
}
</style>
<div align="center">
	<h4>แสงเทียน บีช รีสอร์ท</h4><p></p>
	<h4>รายงานการเข้าพัก/ย้ายออกประจำวัน</h4><p></p>
	<form method="post">
		<table border="0">
			<tbody align="center">
				<tr>
					<td><h4>ตั้งแต่วันที่</h4></td>
					<td><div id="hide1"><input type="date" name="day1" value="<?=$_POST['day1']?>" required></div>
						<div id="sh1"><b><?=dmy2($_POST['day1'])?></b></div></td>
					<td><h4>ถึงวันที่</h4></td>
					<td><div id="hide2"><input type="date" name="day2" value="<?=$_POST['day2']?>" required></div>
						<div id="sh2"><b><?=dmy2($_POST['day2'])?></b></div></td>
					<td><div id='div1'><input class="btn btn-outline-success" type="submit" name="submit" value="ค้นหา"></div></td>
				</tr>
			</tbody>
		</table><p></p>
	</form>
</div>
<?php 
	if(!empty($_POST['day1']) && !empty($_POST['day2']))
	{	
		$day1 = $_POST['day1'];
		$day2 = $_POST['day2'];
		?>
		

		<div align="center">
			<table width="915"><td align="left"><?=printdate()?></td></table>
			<table border="1">
				<thead align="center">
					<tr>
						<th width="135">วันที่เข้าพัก</th>
						<th width="100">รหัสการจอง</th>
						<th width="120">ชื่อผู้จอง</th>
						<th width="120">ชื่อผู้เข้าพัก</th>
						<th width="100">วันที่ย้ายออก</th>
						<th width="100">ชื่อห้องพัก</th>
						<th width="100">ประเภท</th>
						<th width="60">ผู้ใหญ่(คน)</th>
						<th width="60">เด็ก(คน)</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php
					$str1 = "select book_scheduled from book where (book_scheduled between '$day1' and '$day2') and (book_status_deposit NOT between 1 and 2) group by book_scheduled";
					$res1 = $db->query($str1);
					while($gbd = $res1->fetch_assoc())
				 {?>
					<tr>
						<td><?=dmy($gbd['book_scheduled'])?></td>
						<td colspan="7"></td>
					</tr>
					<?php 
						$str2 = "select * from book where (book_scheduled = '".$gbd['book_scheduled']."') and (book_status_deposit NOT between 1 and 2) ";
						$res2 = $db->query($str2);
						while($book=$res2->fetch_assoc())
					{
						$qcus1 = "select * from customer where cus_id = '".$book['cus_id']."' ";
						$rescus1 = $db->query($qcus1);
						$cust1 = $rescus1->fetch_assoc();
						$str3 = "select * from customer where cus_id = '".$book['cus_id_2']."' ";
						$res3 = $db->query($str3);
						$cust = $res3->fetch_assoc();
						?>
					<tr>
						<td></td>
						<td>BKN-<?=$book['book_id']?></td>
						<td><?=$cust1['cus_name']?></td>
						<td><?=$cust['cus_name']?></td>
						<td colspan="5"></td>
					</tr>
					<?php 
						$str4 = "select * from booklist where book_id = '".$book['book_id']."' ";
						$res4 = $db->query($str4);
						while($booklist=$res4->fetch_assoc())
					{
						$str5 = "select * from room where room_id = '".$booklist['room_id']."' ";
						$res5 = $db->query($str5);
						$room = $res5->fetch_assoc();
						$s++;
						$t++;
						if ($room['room_category']==1) {
							$c1++;$c11++;
						}
						if ($room['room_category']==2) {
							$c2++;$c22++;
						}
						if ($room['room_category']==3) {
							$c3++;$c33++;
						}
						if ($room['room_category']==4) {
							$c4++;$c44++;
						}
						?>
					<tr>
						<td colspan="4"></td>
						<?php if($booklist['booklist_checkout']=='0000-00-00'){echo "<td></td>";}else{?>
						<td><?=dmy($booklist['booklist_checkout'])?></td><?php }?>
						<td><?=$room['room_name']?></td>
						<td><?=type_room($room['room_category'])?></td>
						<td><?=$booklist['booklist_numadults']?></td>
						<td><?=$booklist['booklist_numchild']?></td>
					</tr>
				<?php }}?>
					<tr>
						<th colspan="10">รวม 
							<?php if($c1!=""){?><font color="green">Sea View <?=$c1?> ห้อง</font><?php }?>
							<?php if($c2!=""){?><font color="red">Top <?=$c2?> ห้อง</font><?php }?>
							<?php if($c3!=""){?><font color="fuchsia">Vip <?=$c3?> ห้อง</font><?php }?>
							<?php if($c4!=""){?><font color="blue">Big House <?=$c4?> ห้อง</font><?php }?>
						</th>
					</tr>
				<?php $s=0;$c1=0;$c2=0;$c3=0;$c4=0;}?>
					<tr>
						<th colspan="10" align="left"><font color="red">รวมทั้งหมด 
						</font>
						<font color="green">Sea View <?=$c11?> ห้อง</font>
						<font color="red">Top <?=$c22?> ห้อง</font>
						<font color="fuchsia">Vip <?=$c33?> ห้อง</font>
						<font color="blue">Big House <?=$c44?> ห้อง</font>
					</th>
					</tr>
				</tbody>
			</table><br><br><br><br><br><br>
		</div>



<?php
	}
?>
</center>
</body>
</html>