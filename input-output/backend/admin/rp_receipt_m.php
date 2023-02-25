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
	<h4>รายงานการรับชำระประจำเดือน</h4><p></p>
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
			<table width="1285"><td align="left"><?=printdate()?></td></table>
			<table border="1">
				<thead align="center">
					<tr>
						<th width="90">วันที่รับชำระ</th>
						<th width="95">รหัสใบเสร็จ</th>
						<th width="80">รหัสลูกค้า</th>
						<th width="130">ชื่อลูกค้า</th>
						<th width="110">เบอร์โทรศัพท์</th>
						<th width="100">รหัสพนักงาน</th>
						<th width="195">ชื่อพนักงาน</th>
						<th width="130">ประเภทการชำระ</th>
						<th width="120">รวมชำระ(บาท)</th>
						<th width="120">ส่วนลด(บาท)</th>
						<th width="120">ชำระสุทธิ(บาท)</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php
					$str1 = "select receipt_outdate from receipt where MONTH(receipt_outdate) = '$month' AND YEAR(receipt_outdate) = '$year' group by receipt_outdate";
					$res1 = $db->query($str1);
					while($gbd = $res1->fetch_assoc())
				 {?>
					<tr>
						<td><?=dmy($gbd['receipt_outdate'])?></td>
						<td colspan="7"></td>
					</tr>
					<?php 
						$str2 = "select * from receipt where (receipt_outdate = '".$gbd['receipt_outdate']."') and (receipt_status = '1') ";
						$res2 = $db->query($str2);
						while($receipt=$res2->fetch_assoc())
					{
						$ped = $ped + $receipt['receipt_net'];
						$tped = $tped + $receipt['receipt_net'];
						$ped2 = $ped2 + $receipt['receipt_discount'];
						$tped2 = $tped2 + $receipt['receipt_discount'];
						$ped1 = $ped1 + ($receipt['receipt_net']+$receipt['receipt_discount']);
						$tped1 = $tped1 + ($receipt['receipt_net']+$receipt['receipt_discount']);
						$str3 = "select * from customer where cus_id = '".$receipt['cus_id']."' ";
						$res3 = $db->query($str3);
						$cust = $res3->fetch_assoc();
						$str4 = "select * from employee where emp_id = '".$receipt['emp_id']."' ";
						$res4 = $db->query($str4);
						$emp = $res4->fetch_assoc();
						if($receipt['receipt_paymenttype']==1){$at=$at+$receipt['receipt_net'];$as=$as+$receipt['receipt_net'];}
						elseif($receipt['receipt_paymenttype']==2){$bt=$bt+$receipt['receipt_net'];$bs=$bs+$receipt['receipt_net'];}
						else{$ct=$ct+$receipt['receipt_net'];$cs=$cs+$receipt['receipt_net'];}
						?>
					<tr>
						<td></td>
						<td>RC-<?=$receipt['receipt_id']?></td>
						<td><?=$cust['cus_id']?></td>
						<td align="left">&nbsp;&nbsp;&nbsp;<?=$cust['cus_name']?></td>
						<td><?=$cust['cus_phone']?></td>
						<td><?=$emp['emp_id']?></td>
						<td align="left">&nbsp;&nbsp;<?=$emp['emp_name']?></td>
						<td><?=pay_type($receipt['receipt_paymenttype'])?></td>
						<td align="right"><?=number_format($receipt['receipt_net']+$receipt['receipt_discount'],2)?>&nbsp;&nbsp;</td>
						<td align="right"><?=number_format($receipt['receipt_discount'],2)?>&nbsp;&nbsp;</td>
						<td align="right"><font color="<?php 
						if($receipt['receipt_paymenttype']=='1')echo 'red';
						elseif($receipt['receipt_paymenttype']=='2')echo '#3498DB';
						elseif($receipt['receipt_paymenttype']=='3') echo '#8E44AD';?>"><?=number_format($receipt['receipt_net'],2)?>&nbsp;&nbsp;</font></td>
					</tr>
				<?php }?>
					<tr>
						<th colspan="2"><div align="right"></div></th>
						<th colspan="2"><div align="left"><?php 
							if ($as!="") {
						?> &nbsp;&nbsp;&nbsp;<font color=""><font color="red">เงินสด <?=number_format($as,2)?> บาท</font><?php }?></div></th>
						<th colspan="2"><div align="left"><?php 
							if ($bs!="") {
						?><font color="#3498DB">&nbsp;เงินโอน <?=number_format($bs,2)?> บาท</font><?php }?></div></th>
						<th><font color="#8E44AD"><div align="left"><?php 
							if ($cs!="") {
						?>บัตรเครดิต <?=number_format($cs,2)?> บาท</font><?php }?></div></th>
						<th><div align="right">รวม</div></th>
						<th><div align="right"><?=number_format($ped1,2)?>&nbsp;&nbsp;</div></th>
						<th><div align="right"><?=number_format($ped2,2)?>&nbsp;&nbsp;</div></th>
						<th><div align="right"><?=number_format($ped,2)?>&nbsp;&nbsp;</div></th>
					</tr>
				<?php $as=0;$bs=0;$cs=0;$ped=0;$ped2=0;$ped1=0;}?>
					<tr>
						<th colspan="2"><div align="right"></div></th>
						<th colspan="2"><div align="left"> &nbsp;&nbsp;&nbsp;<font color=""><font color="red">เงินสด <?=number_format($at,2)?> บาท</font></div></th>
						<th colspan="2"><div align="left"><font color="#3498DB">&nbsp;เงินโอน <?=number_format($bt,2)?> บาท</font></div></th>
						<th><font color="#8E44AD"><div align="left">บัตรเครดิต <?=number_format($ct,2)?> บาท</font></div></th>
						<th><div align="right">รวมทั้งหมด</div></th>
						<th><div align="right"><?=number_format($tped1,2)?>&nbsp;&nbsp;</div></th>
						<th><div align="right"><?=number_format($tped2,2)?>&nbsp;&nbsp;</div></th>
						<th><div align="right"><?=number_format($tped,2)?>&nbsp;&nbsp;</div></th>
					</tr>
			</table><br><br><br><br><br><br>
		</div>




<?php
	}
?>
</center>
</body>
</html>