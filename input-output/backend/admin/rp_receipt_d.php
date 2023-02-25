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
	<h4>รายงานการรับชำระประจำวัน</h4><p></p>
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
			<table width="1425"><td align="left"><?=printdate()?></td></table>
			<table border="1">
				<thead align="center">
					<tr>
						<th width="90">วันที่รับชำระ</th>
						<th width="95">รหัสใบเสร็จ</th>
						<th width="140">ชื่อลูกค้า</th>
						<th width="110">เบอร์โทรศัพท์</th>
						<th width="135">ประเภทการชำระ</th>
						<th width="190">รวมชำระ(บาท)</th>
						<th width="120">ส่วนลด(บาท)</th>
						<th width="120">ชำระสุทธิ(บาท)</th>
						<th width="125">รหัสค่าใช้จ่าย</th>
						<th width="100">รวม(บาท)</th>
						<th width="100">ส่วนลด(บาท)</th>
						<th width="100">สุทธิ(บาท)</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php
					$str1 = "select receipt_outdate from receipt where receipt_outdate between '$day1' and '$day2' group by receipt_outdate";
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
						$str3 = "select * from customer where cus_id = '".$receipt['cus_id']."' ";
						$res3 = $db->query($str3);
						$cust = $res3->fetch_assoc();
						$t=$t+$receipt['receipt_net'];
						$s=$s+$receipt['receipt_net'];
						$t2=$t2+$receipt['receipt_discount'];
						$s2=$s2+$receipt['receipt_discount'];
						$t1=$t1+($receipt['receipt_net']+$receipt['receipt_discount']);
						$s1=$s1+($receipt['receipt_net']+$receipt['receipt_discount']);
						if ($receipt['receipt_paymenttype']==1) {
							$c1=$c1+$receipt['receipt_net'];
							$c11=$c11+$receipt['receipt_net'];
						}
						elseif ($receipt['receipt_paymenttype']==2) {
							$c2=$c2+$receipt['receipt_net'];
							$c22=$c22+$receipt['receipt_net'];
						}
						elseif ($receipt['receipt_paymenttype']==3) {
							$c3=$c3+$receipt['receipt_net'];
							$c33=$c33+$receipt['receipt_net'];
						}
						?>
					<tr>
						<td></td>
						<td>RC-<?=$receipt['receipt_id']?></td>
						<td><?=$cust['cus_name']?></td>
						<td><?=$cust['cus_phone']?></td>
						<td><?=pay_type($receipt['receipt_paymenttype'])?></td>
						<td align="right"><?=number_format($receipt['receipt_net']+$receipt['receipt_discount'],2)?>&nbsp;&nbsp;</td>
						<td align="right"><?=number_format($receipt['receipt_discount'],2)?>&nbsp;&nbsp;</td>
						<td align="right"><font color="<?php 
						if($receipt['receipt_paymenttype']=='1')echo 'red';
						elseif($receipt['receipt_paymenttype']=='2')echo '#3498DB';
						elseif($receipt['receipt_paymenttype']=='3') echo '#8E44AD';?>"><?=number_format($receipt['receipt_net'],2)?>&nbsp;&nbsp;</font></td>
						<td colspan="2"></td>
					</tr>
					<?php 
						$str4 = "select * from servicecost where receipt_id = '".$receipt['receipt_id']."' ";
						$res4 = $db->query($str4);
						while($svcost=$res4->fetch_assoc())
					{
						?>
					<tr>
						<td colspan="8"></td>
						<td>SVC-<?=$svcost['svcost_id']?></td>
						<td align="right"><?=number_format($svcost['svcost_total'],2)?>&nbsp;&nbsp;</td>
						<td align="right"><?=number_format($svcost['svcost_total']-$svcost['svcost_net'],2)?>&nbsp;&nbsp;</td>
						<td align="right"><?=number_format($svcost['svcost_net'],2)?>&nbsp;&nbsp;</td>
					</tr>
				<?php }?><?php }?>
					<tr>
						<th colspan="5"><div align="left">
							<?php
								
								if ($c1!='') {
									echo "<font color='red'>เงินสด ".number_format($c1,2)." บาท&nbsp;</font>";
								}
								else $spa = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								if ($c2!='') {
									$spa = "";
									echo $spa."<font color='#3498DB'>เงินโอน ".number_format($c2,2)." บาท&nbsp;</font>";
								}
								else $spa = "";
								if ($c3!='') {
									echo $spa."<font color='#8E44AD'>บัตรเครดิต ".number_format($c3,2)." บาท&nbsp;</font>";
								}
							?></div>
						 </th>
						 <th><div align="right">รวม <?=number_format($s1,2)?>&nbsp;&nbsp;&nbsp;</div></th>
						 <th><div align="right"><?=number_format($s2,2)?>&nbsp;&nbsp;</div></th>
						 <th><div align="right"><?=number_format($s,2)?>&nbsp;&nbsp;</div></th>
						 <th colspan="4"></th>
					</tr>
				<?php $s1=0;$s2=0;$s=0;$c1=0;$c2=0;$c3=0;}?>
					<tr>
						 <th colspan="5" width=""><div align="left">
						 	<?php 
								if ($c11!='') {
									echo "<font color='red'>เงินสด ".number_format($c11,2)." บาท&nbsp;</font>";
								}
								if ($c22!='') {
									echo "<font color='#3498DB'>เงินโอน ".number_format($c22,2)." บาท&nbsp;</font>";
								}
								if ($c33!='') {
									echo "<font color='#8E44AD'>บัตรเครดิต ".number_format($c33,2)." บาท&nbsp;</font>";
								}
							?>&nbsp;
						 </div>
						 </th>
						 <th><font color="">&nbsp;รวมทั้งหมด <?=number_format($t1,2)?></font></th>
						 <th align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($t2,2)?></th>
						 <th align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($t,2)?></th>
						<th colspan="4"></th>
					</tr>
			</table>
		</div>




<?php
	}
?>
</center>
</body>
</html>