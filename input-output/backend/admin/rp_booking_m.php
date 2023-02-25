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
	<h4>รายงานการจองห้องพักประจำเดือน</h4><p></p>
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
						</select>
						</div>
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
						</select>
						</div>
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
			<table width="900"><td align="left"><?=printdate()?></td></table>
			<table border="1">
				<thead align="center">
					<tr>
						<th width="100">วันที่จอง</th>
						<th width="100">รหัสการจอง</th>
						<th width="120">ชื่อลูกค้า</th>
						<th width="120">เบอร์โทรศัพท์</th>
						<th width="120">สถานะค่ามัดจำ</th>
						<th width="100">วันที่กำหนดเข้าพัก</th>
						<th width="130">ยอดชำระ(บาท)</th>
						<th width="130">ค่ามัดจำ(บาท)</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php
					$str1 = "select book_date from book where MONTH(book_date) = '$month' AND YEAR(book_date) = '$year' group by book_date";
					$res1 = $db->query($str1);
					while($gbd = $res1->fetch_assoc())
				 {?>
					<tr>
						<td colspan="8" align="left">&nbsp;<?=dmy($gbd['book_date'])?></td>
					</tr>
					<?php 
						$str2 = "select * from book where book_date = '".$gbd['book_date']."' ";
						$res2 = $db->query($str2);
						while($book=$res2->fetch_assoc())
					{
						$ne = $ne + $book['book_total'];
						$de = $de + $book['book_deposit'];
						$tne = $tne + $book['book_total'];
						$tde = $tde + $book['book_deposit'];
						$str3 = "select * from customer where cus_id = '".$book['cus_id']."' ";
						$res3 = $db->query($str3);
						$cust = $res3->fetch_assoc();
						$s++;
						$t++;
						if ($book['book_status_deposit']==0) {
							$c4++;$c44++;
							$i1 = $i1 + $book['book_total'];
							$i2 = $i2 + $book['book_deposit'];
						}
						elseif ($book['book_status_deposit']==1) {
							$c1++;$c11++;
							$v1 = $v1 + $book['book_total'];
							$v2 = $v2 + $book['book_deposit'];
						}
						elseif ($book['book_status_deposit']==2) {
							$c2++;$c22++;
							$j1 = $j1 + $book['book_total'];
							$j2 = $j2 + $book['book_deposit'];
						}
						elseif ($book['book_status_deposit']==3) {
							$c3++;$c33++;
							$x1 = $x1 + $book['book_total'];
							$x2 = $x2 + $book['book_deposit'];
						}
						elseif ($book['book_status_deposit']==4) {
							$c3++;$c33++;
							$x1 = $x1 + $book['book_total'];
							$x2 = $x2 + $book['book_deposit'];
						}
						elseif ($book['book_status_deposit']==5) {
							$c3++;$c33++;
							$x1 = $x1 + $book['book_total'];
							$x2 = $x2 + $book['book_deposit'];
						}
						elseif ($book['book_status_deposit']==6) {
							$c3++;$c33++;
							$x1 = $x1 + $book['book_total'];
							$x2 = $x2 + $book['book_deposit'];
						}
						
						?>
					<tr>
						<td></td>
						<td>BKN-<?=$book['book_id']?></td>
						<td><?=$cust['cus_name']?></td>
						<td><?=$cust['cus_phone']?></td>
						<td><?=status_deposit($book['book_status_deposit'])?></td>
						<td><?=dmy($book['book_scheduled'])?></td>
						<td align="right"><?=number_format($book['book_total'],2)?>&nbsp;&nbsp;&nbsp;</td>
						<td align="right"><?=number_format($book['book_deposit'],2)?>&nbsp;&nbsp;&nbsp;</td>
					</tr>
				<?php } ?>
					<tr>
						<th></th>
						<th colspan="5"><div align="right">รวม</div></th>
						<th><div align="right"><?=number_format($ne,2)?>&nbsp;&nbsp;&nbsp;</div></th>
						<th><div align="right"><?=number_format($de,2)?>&nbsp;&nbsp;&nbsp;</div></th>
					</tr>
					</thead>
			<?php $s=0;$c1=0;$c2=0;$c3=0;$c4=0;$ne=0;$de=0;}?>
					<tr>
						<th colspan="6"><div align="right">รวมทั้งหมด</div></th>
						<th><div align="right"><font color=""><?=number_format($tne,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
						<th><div align="right"><font color=""><?=number_format($tde,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
					</tr>
					<tr>
						<th colspan="6"><div align="right"><font color="#F39C12">รวมรอการยืนยันทั้งหมด(บาท)</font></div></th>
						<th><div align="right"><font color="#F39C12"><?=number_format($j1,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
						<th><div align="right"><font color="#F39C12"><?=number_format($j2,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
					</tr>
					<tr>
						<th colspan="6"><div align="right"><font color="blue">รวมยกเลิกทั้งหมด(บาท)</font></div></th>
						<th><div align="right"><font color="blue"><?=number_format($i1,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
						<th><div align="right"><font color="blue"><?=number_format($i2,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
					</tr>
					<tr>
						<th colspan="6"><div align="right"><font color="green">รวมชำระแล้วทั้งหมด(บาท)</font></div></th>
						<th><div align="right"><font color="green"><?=number_format($x1,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
						<th><div align="right"><font color="green"><?=number_format($x2,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
					</tr>
					<tr>
						<th colspan="6"><div align="right"><font color="red">รวมยังไม่ได้ชำระทั้งหมด(บาท)</font></div></th>
						<th><div align="right"><font color="red"><?=number_format($v1,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
						<th><div align="right"><font color="red"><?=number_format($v2,2)?></font>&nbsp;&nbsp;&nbsp;</div></th>
					</tr>
			</table><br><br><br><br><br><br>
		</div>




<?php
	}
?>
</center>
</body>
</html>