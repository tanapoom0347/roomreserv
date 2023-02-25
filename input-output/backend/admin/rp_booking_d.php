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
	<h4>รายงานการจองห้องพักประจำวัน</h4><p></p>
	<form method="post">
		<table border="0">
			<tbody align="center">
				<tr>
					<td><h4>ตั้งแต่วันที่</h4></td>
					<td><div id="hide1"><input type="date" name="day1" value="<?=$_POST['day1']?>" required></div>
						<div id="sh1"><b><?=dmy2($_POST['day1'])?></b></div>
					</td>
					<td><h4>ถึงวันที่</h4></td>
					<td><div id="hide2"><input type="date" name="day2" value="<?=$_POST['day2']?>" required></div>
						<div id="sh2"><b><?=dmy2($_POST['day2'])?></b></div>
					</td>
					<td><div id="div1"><input class="btn btn-outline-success" type="submit" name="submit" value="ค้นหา"></div></td>
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
			<table width="840"><td align="left"><?=printdate()?></td></table>
			<table border="1">
				<thead align="center">
					<tr>
						<th>วันที่จอง</th>
						<th width="100">รหัสการจอง</th>
						<th width="120">ชื่อลูกค้า</th>
						<th width="120">สถานะค่ามัดจำ</th>
						<th width="100">ชื่อห้องพัก</th>
						<th width="100">ประเภท</th>
						<th width="100">วันที่เข้าพัก</th>
						<th width="100">วันที่ย้ายออก</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php
					$str1 = "select book_date from book where book_date between '$day1' and '$day2' group by book_date";
					$res1 = $db->query($str1);
					while($gbd = $res1->fetch_assoc())
				 {?>
					<tr>
						<td colspan="8" align="left"><?=dmy($gbd['book_date'])?></td>
					</tr>
					<?php 
						$str2 = "select * from book where book_date = '".$gbd['book_date']."' ";
						$res2 = $db->query($str2);
						while($book=$res2->fetch_assoc())
					{
						$str3 = "select * from customer where cus_id = '".$book['cus_id']."' ";
						$res3 = $db->query($str3);
						$cust = $res3->fetch_assoc();
						?>
					<tr>
						<td width="100"></td>
						<td width="120">BKN-<?=$book['book_id']?></td>
						<td width="120"><?=$cust['cus_name']?></td>
						<td width="100"><?=status_deposit($book['book_status_deposit'])?></td>
						<td colspan="4"></td>
					</tr>
					<?php 
						$str4 = "select * from booklist where book_id = '".$book['book_id']."' ";
						$res4 = $db->query($str4);
						while($booklist=$res4->fetch_assoc())
					{
						if($book['book_status_deposit']=='0'){$cancel=$cancel+1;}
						elseif($book['book_status_deposit']=='1'){$notp=$notp+1;}
						elseif($book['book_status_deposit']=='2'){$confrm=$confrm+1;}
						else$succe=$succe+1;
						$str5 = "select * from room where room_id = '".$booklist['room_id']."' ";
						$res5 = $db->query($str5);
						$room = $res5->fetch_assoc();
						$s++;
						$t++;
						if ($room['room_category']==1) {
							$c1++;$c11++;
						}
						elseif ($room['room_category']==2) {
							$c2++;$c22++;
						}
						elseif ($room['room_category']==3) {
							$c3++;$c33++;
						}
						elseif ($room['room_category']==4) {
							$c4++;$c44++;
						}
						?>
					<tr>
						<td colspan="4"></td>
						<td width="100"><?=$room['room_name']?></td>
						<td width="100"><?=type_room($room['room_category'])?></td>
						<td width="100"><?=dmy($booklist['booklist_datein'])?></td>
						<td width="100"><?=dmy($booklist['booklist_dateout'])?></td>
					</tr>
				<?php }}?>
					<tr>
						<th></th>
						<th colspan="5">
							<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php 
								if ($c1!='') {
									echo "<font color='green'>Sea View ".$c1." ห้อง &nbsp;&nbsp;&nbsp;&nbsp;</font>";
								}
								if ($c2!='') {
									echo "<font color='red'>Top ".$c2." ห้อง &nbsp;&nbsp;&nbsp;&nbsp;</font>";
								}
								if ($c3!='') {
									echo "<font color='fuchsia'>Vip ".$c3." ห้อง &nbsp;&nbsp;&nbsp;&nbsp;</font>";
								}
								if ($c4!='') {
									echo "<font color='blue'>Big House ".$c4." ห้อง &nbsp;&nbsp;&nbsp;&nbsp;</font>";
								}
							?>
						</th></div>
						<th colspan="2"><div align="right"> รวมจอง <?=$s?> ห้อง</div></th>
					</tr>
				<?php
					$s=0;$c1=0;$c2=0;$c3=0;$c4=0;}
				?>
					<tr>
						<th>รวมทั้งหมด</th>
						<th colspan="5" width="500">
							<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php 
								if ($c11!='') {
									echo "<font color='green'>Sea View ".$c11." ห้อง &nbsp;&nbsp;&nbsp;&nbsp;</font>";
								}
								if ($c22!='') {
									echo "<font color='red'>Top ".$c22." ห้อง &nbsp;&nbsp;&nbsp;&nbsp;</font>";
								}
								if ($c33!='') {
									echo "<font color='fuchsia'>Vip ".$c33." ห้อง &nbsp;&nbsp;&nbsp;&nbsp;</font>";
								}
								if ($c44!='') {
									echo "<font color='blue'>Big House ".$c44." ห้อง &nbsp;&nbsp;&nbsp;&nbsp;</font>";
								}
							?>
						</th></div>
						<th colspan="2"><div align="right"><font color=""> รวมจองทั้งหมด <?=$t?> ห้อง</font></div>
						</th>
					</tr>
					<tr>
						<th colspan="6"></th>
						<th colspan="2" width="300"><div align="right"><font color="blue">รวมยกเลิกทั้งหมด <?=$cancel?> ห้อง</font></div></th>
					</tr>
					<tr>
						<th colspan="6"></th>
						<th colspan="2"><div align="right"><font color="red">รวมยังไม่ได้ชำระทั้งหมด <?=$notp?> ห้อง</font></div></th>
					</tr>
					<tr>
						<th colspan="6"></th>
						<th colspan="2"><div align="right"><font color="#F39C12">รวมรอการยืนยันทั้งหมด <?=$confrm?> ห้อง</font></div></th>
					</tr>
					<tr>
						<th colspan="6"></th>
						<th colspan="2"><div align="right"><font color="green">รวมชำระแล้วทั้งหมด <?=$succe?> ห้อง</font></div></th>
					</tr>
			</table><br><br><br><br><br><br>
		</div>



<?php
	}
?>
<!--<script type="text/javascript">
	jQuery(document).bind("keyup keydown", function (e) {
        if (e.ctrlKey && e.keyCode == 80) {
            $(".bodyb").hide();
            return false;
        }
    });
</script>-->
</center>
</body>
</html>