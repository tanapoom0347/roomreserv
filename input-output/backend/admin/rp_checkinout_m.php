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
	#sh1 ,#sh2 ,#sh3{
		display: none;
	}
</style>
<style>
@media print {
    #div1, .div2 ,#hide1, #hide2, #hide3{
        display: none;
    }
    #sh1 ,#sh2 ,#sh3{
		display: block;
	}
</style>
<div align="center">
	<h4>แสงเทียน บีช รีสอร์ท</h4><p></p>
	<h4>รายงานการเข้าพัก/ย้ายออกประจำเดือน</h4><p></p>
	<form method="post">
		<table border="0">
			<tbody align="center">
				<tr>
					<td><h4>เดือน&nbsp;</h4></td>
					<td><div id="hide1">
						<select name="month" required><?php if(empty($_POST['month'])){?>
							<option value=""></option><?php }?>
							<option <?php if($_POST['month']=='01') echo 'selected';?> value="01">มกราคม</option>
							<option <?php if($_POST['month']=='02') echo 'selected';?> value="02">กุมภาพันธ์</option>
							<option <?php if($_POST['month']=='03') echo 'selected';?> value="03">มีนาคม</option>
							<option <?php if($_POST['month']=='04') echo 'selected';?> value="04">เมษายน</option>
							<option <?php if($_POST['month']=='05') echo 'selected';?> value="05">พฤษภาคม</option>
							<option <?php if($_POST['month']=='06') echo 'selected';?> value="06">มิถุนายน</option>
							<option <?php if($_POST['month']=='07') echo 'selected';?> value="07">กรกฏาคม</option>
							<option <?php if($_POST['month']=='08') echo 'selected';?> value="08">สิงหาคม</option>
							<option <?php if($_POST['month']=='09') echo 'selected';?> value="09">กันยายน</option>
							<option <?php if($_POST['month']=='10') echo 'selected';?> value="10">ตุลาคม</option>
							<option <?php if($_POST['month']=='11') echo 'selected';?> value="11">พฤศจิกายน</option>
							<option <?php if($_POST['month']=='12') echo 'selected';?> value="12">ธันวาคม</option>
						</select></div>
					<div id="sh1">
							<?php 
								switch ($_POST['month']) {
									case '01':echo "<h4>มกราคม</h4>";break;
									case '02':echo "<h4>กุมภาพันธ์</h4>";break;
									case '03':echo "<h4>มีนาคม</h4>";break;
									case '04':echo "<h4>เมษายน</h4>";break;
									case '05':echo "<h4>พฤษภาคม</h4>";break;
									case '06':echo "<h4>มิถุนายน</h4>";break;
									case '07':echo "<h4>กรกฏาคม</h4>";break;
									case '08':echo "<h4>สิงหาคม</h4>";break;
									case '09':echo "<h4>กันยายน</h4>";break;
									case '10':echo "<h4>ตุลาคม</h4>";break;
									case '11':echo "<h4>พฤศจิกายน</h4>";break;
									case '12':echo "<h4>ธันวาคม</h4>";break;
								}
							?>
					</div>
					</td>
					<td><h4><div id="hide3">&nbsp;ปี&nbsp;</div><div id="sh3">&nbsp;ค.ศ.&nbsp;</div></h4></td>
					<td><div id="hide2">
						<select name="year">
							<option <?php if($_POST['year']=='2020') echo 'selected';?> value="2020">2020</option>
							<option <?php if($_POST['year']=='2021') echo 'selected';?> value="2021">2021</option>
							<option <?php if($_POST['year']=='2022') echo 'selected';?> value="2022">2022</option>
							<option <?php if($_POST['year']=='2023') echo 'selected';?> value="2023">2023</option>
							<option <?php if($_POST['year']=='2024') echo 'selected';?> value="2024">2024</option>
							<option <?php if($_POST['year']=='2025') echo 'selected';?> value="2025">2025</option>
						</select></div>
					<div id="sh2">
							<?php 
								switch ($_POST['year']) {
									case '2020':echo "<h4>2020</h4>";break;
									case '2021':echo "<h4>2021</h4>";break;
									case '2022':echo "<h4>2022</h4>";break;
									case '2023':echo "<h4>2023</h4>";break;
									case '2024':echo "<h4>2024</h4>";break;
									case '2025':echo "<h4>2025</h4>";break;

								}
							?>
					</div>
					</td>
					<td><div id="div1">&nbsp;<input class="btn btn-outline-success" type="submit" name="submit" value="ค้นหา"></div></td>
				</tr>
			</tbody>
		</table><p></p>
	</form>
</div>
<?php 
	if(!empty($_POST['month']) && !empty($_POST['year']))
	{	
		$month = $_POST['month'];
		$year = $_POST['year'];
		?>
		

		<div align="center">
			<table width="1225"><td align="left"><?=printdate()?></td></table>
			<table border="1">
				<thead align="center">
					<tr>
						<th width="135">วันที่เข้าพัก</th>
						<th width="100">รหัสการจอง</th>
						<th width="80">รหัสผู้จอง</th>
						<th width="120">ชื่อผู้จอง</th>
						<th width="100">รหัสผู้เข้าพัก</th>
						<th width="120">ชื่อผู้เข้าพัก</th>
						<th width="120">เบอร์โทรศัพท์</th>
						<th width="55">ผู้ใหญ่(คน)</th>
						<th width="55">เด็ก(คน)</th>
						<th width="100">วันที่ย้ายออก</th>
						<th width="100">ชื่อห้องพัก</th>
						<th width="100">ประเภท</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php
					$str1 = "select book_scheduled from book where MONTH(book_scheduled) = '$month' AND YEAR(book_scheduled) = '$year' group by book_scheduled";
					$res1 = $db->query($str1);
					while($gbd = $res1->fetch_assoc())
				 {?>
					<tr>
						<td><?=dmy($gbd['book_scheduled'])?></td>
						<td colspan="7"></td>
					</tr>
					<?php 
						$str2 = "select * from book where book_scheduled = '".$gbd['book_scheduled']."' ";
						$res2 = $db->query($str2);
						while($book=$res2->fetch_assoc())
					{
						$asum = $asum + $book['book_adult'];
						$tasum = $tasum + $book['book_adult'];
						$csum = $csum + $book['book_child'];
						$tcsum = $tcsum + $book['book_child'];
						$str3 = "select * from customer where cus_id = '".$book['cus_id_2']."' ";
						$res3 = $db->query($str3);
						$cust = $res3->fetch_assoc();
						$str4 = "select * from customer where cus_id = '".$book['cus_id']."' ";
						$res4 = $db->query($str3);
						$cust2 = $res4->fetch_assoc();
						$bs=0;
						if($book['book_status_pay']==2){$at++;$as++;}
						else{$bt++;$bs++;}
						?>
					<tr>
						<td></td>
						<td>BKN-<?=$book['book_id']?></td>
						<td><?=$cust2['cus_id']?></td>
						<td align="left">&nbsp;&nbsp;<?=$cust2['cus_name']?></td>
						<td><?=$cust['cus_id']?></td>
						<td align="left">&nbsp;&nbsp;<?=$cust['cus_name']?></td>
						<td><?=$cust['cus_phone']?></td>
						<td><?=$book['book_adult']?></td>
						<td><?=$book['book_child']?></td>
						<td colspan="2"></td>
					</tr>
				<?php 
					$str5 = "select * from booklist where book_id = '".$book['book_id']."' ";
					$res5 = $db->query($str5);
					while ($booklist=$res5->fetch_assoc()) 
				{
					$str6 = "select * from room where room_id = '".$booklist['room_id']."' ";
					$res6 = $db->query($str6);
					$room = $res6->fetch_assoc();
					?>
					<tr>
						<td colspan="9"></td>
						<?php if($booklist['booklist_checkout']=='0000-00-00'){echo "<td></td>";}else{?>
						<td><?=dmy($booklist['booklist_checkout'])?></td><?php }?>
						<td><?=$room['room_name']?></td>
						<td><?=type_room($room['room_category'])?></td>
					</tr>
				<?php }}?>
					<tr>
						<th colspan="7"><div align="right">รวม</div></th>
						<th><font color="red"><?=$asum?></font></th>
						<th><font color="red"><?=$csum?></font></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				<?php $asum=0;$csum=0;}?>
					<tr>
						<th colspan="7"><div align="right">รวมทั้งหมด</div></th>
						<th><font color="blue"><?=$tasum?></font></th>
						<th><font color="blue"><?=$tcsum?></font></th>
						<th></th>
						<th></th>
						<th></th>
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