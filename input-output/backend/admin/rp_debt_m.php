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
}
</style>
<div align="center">
	<h4>แสงเทียน บีช รีสอร์ท</h4><p></p>
	<h4>รายงานหนี้ค้างชำระประจำเดือน</h4><p></p>
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
			<table width="920"><td align="left"><?=printdate()?></td></table>
			<table border="1">
				<thead align="center">
					<tr>
						<th width="130">วันที่แจ้งชำระ</th>
						<th width="130">รหัสใบเสร็จรับเงิน</th>
						<th width="85">รหัสลูกค้า</th>
						<th width="130">ชื่อลูกค้า</th>
						<th width="110">เบอร์โทรศัพท์</th>
						<th width="140">รวมค้างชำระ(บาท)</th>
						<th width="100">ส่วนลด(บาท)</th>
						<th width="100">ยอดค้างชำระสุทธิ(บาท)</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php
					$str1 = "select receipt_outdate from receipt where MONTH(receipt_outdate) = '$month' AND YEAR(receipt_outdate) = '$year' group by receipt_outdate";
					$res1 = $db->query($str1);
					while($gbd = $res1->fetch_assoc())
				 {
				 	$sql = "select * from receipt where (receipt_outdate = '".$gbd['receipt_outdate']."') and (receipt_status = '0') ";
					$result = $db->query($sql);
					$numrows = $result->num_rows;
				 	if($numrows>=1){
				 	?>
					<tr>
						<td><?=dmy($gbd['receipt_outdate'])?></td>
						<td colspan="7"></td>
					</tr>
					<?php 
						$str2 = "select * from receipt where (receipt_outdate = '".$gbd['receipt_outdate']."') and (receipt_status = '0') ";
						$res2 = $db->query($str2);
						while($receipt=$res2->fetch_assoc())
					{
						$str3 = "select * from customer where cus_id = '".$receipt['cus_id']."' ";
						$res3 = $db->query($str3);
						$cust = $res3->fetch_assoc();
						?>
					<tr>
						<td></td>
						<td>RC-<?=$receipt['receipt_id']?></td>
						<td><?=$cust['cus_id']?></td>
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$cust['cus_name']?></td>
						<td><?=$cust['cus_phone']?></td>
						<td align="right"><?=number_format($receipt['receipt_net']+$receipt['receipt_discount'],2)?></td>
						<td align="right"><?=number_format($receipt['receipt_discount'],2)?></td>
						<td align="right"><?=number_format($receipt['receipt_net'],2)?></td>
					</tr>
				<?php
						$t=$t+$receipt['receipt_net'];
						$s=$s+$receipt['receipt_net'];
						$t2=$t2+$receipt['receipt_discount'];
						$s2=$s2+$receipt['receipt_discount'];
						$t1=$t1+($receipt['receipt_net']+$receipt['receipt_discount']);
						$s1=$s1+($receipt['receipt_net']+$receipt['receipt_discount']);
				}}if($s!=0){?>
					<tr>
						<th colspan="5"><div align="right">รวม</div></th>
						<th><div align="right"><?=number_format($s1,2)?></div></th>
						<th><div align="right"><?=number_format($s2,2)?></div></th>
						<th><div align="right"><?=number_format($s,2)?></div></th>
					</tr>
				<?php }$s=0;$s2=0;$s1=0;}?>
					<tr>
						<th colspan="5"><div align="right"><font color="red">รวมทั้งหมด</font></div></th>
						<th><div align="right"><font color="red"><?=number_format($t1,2)?></font></div></th>
						<th><div align="right"><font color="red"><?=number_format($t2,2)?></font></div></th>
						<th><div align="right"><font color="red"><?=number_format($t,2)?></font></div></th>
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