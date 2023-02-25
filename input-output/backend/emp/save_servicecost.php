<?php require'header.php';?>
<?php 
if(isset($_POST['book_id']))
{
	$bk_id = $_POST["book_id"];
	$q2 = "select * from book where book_id = '$bk_id'";
	$res2 = $db->query($q2);
	$bk = $res2->fetch_assoc();
	if($bk['book_status_pay']==3){
		$sql1="
		INSERT INTO servicecost (svcost_date,svcost_status,svcost_total,book_id,receipt_id,svcost_discount,svcost_net)
		VALUES
		('".date("Y-m-d H:i:s")."','0','".$_SESSION["SumTotal"]."','".$_POST["book_id"]."',NULL,'".$_SESSION["Dis"]."','".$_SESSION["Net"]."')
		";
	}
	else {
		$sql1="
		INSERT INTO servicecost (svcost_date,svcost_status,svcost_total,book_id,receipt_id,svcost_discount,svcost_net)
		VALUES
		('".date("Y-m-d H:i:s")."','0','".$_SESSION["SumTotal"]."','".$_POST["book_id"]."',NULL,'".$_SESSION["Dis"]."','".$_SESSION["Net"]."')
		";
	}
	

	if($db->query($sql1)==TRUE)
	{
		$insert_num = $db->insert_id;
	}
	else
	{
		echo $sql1;
	}

	  for($i=0;$i<=(int)$_SESSION["intLine2"];$i++)
  {
	  if($_SESSION["strProductID2"][$i] != "")
	  {
	  		$sqlb = "SELECT * FROM servicelist WHERE svlist_id = '".$_SESSION["strProductID2"][$i]."'";
	  		$resultb = $db->query($sqlb);
			$rowd = $resultb->fetch_assoc();
			  $strSQL = "
				INSERT INTO servicedetail (svdetail_num,svdetail_price,svdetail_detail,svcost_id,svlist_id)
				VALUES
				('".$_SESSION["strQty2"][$i]."','".$rowd['svlist_price']."','','".$insert_num."','".$_SESSION["strProductID2"][$i]."')
			  ";
			if($db->query($strSQL)==FALSE)
			{
				echo $strSQL;
			}
	  }
  }

  if($_SESSION['priceplus']!=0)
	{
		$plus = $_SESSION['priceplus'];
		$q5 = "INSERT INTO servicedetail (svdetail_num,svdetail_price,svdetail_detail,svcost_id,svlist_id) VALUES ('1','$plus','','$insert_num','4')";
		$db->query($q5);
	}

  unset($_SESSION["intLine2"]);
  unset($_SESSION["strProductID2"]);
  unset($_SESSION["strQty2"]);
  unset($_SESSION["SumTotal"]);
  	
	$q1 = "UPDATE book SET book_status_pay = '3' WHERE book_id = '$bk_id'";
	if ($db->query($q1)==TRUE) {
		//echo $bk_id;
		//echo $q1;
	  alert_message('บันทึกค่าใช้จ่ายรหัส '.$insert_num.' สำเร็จ');
	  goto_url('show_servicecost.php');
	}
	else {
	  echo $q1;
	}
}
?>
<?php 
if(isset($_GET['book_id']))
{
	$book_id = $_GET['book_id'];
}
?>
<h1 align="center" style="color:black">บันทึกค่าใช้จ่าย</h1>
<h3 align="center" style="color:black">รายการค่าใช้จ่าย</h3>
<table align="center" border="1">
	<tr>
		<td width="140" align="center">รหัสรายการบริการ</td>
		<td width="100" align="center">ชื่อบริการ</td>
		<td width="100" align="center">ราคา</td>
		<td width="100" align="center">จำนวน</td>
		<td width="100" align="center">ราคารวม</td>
	</tr>
<?php
  $_SESSION['priceplus'] = 0;
  $Total = 0;
  $SumTotal = 0;
  for($i=0;$i<=(int)$_SESSION["intLine2"];$i++)
  {
  if($_SESSION["strProductID2"][$i] != "")
	  {
		$strSQL2 = "SELECT * FROM servicelist WHERE svlist_id = '".$_SESSION["strProductID2"][$i]."' ";
		$objQuery2 = $db->query($strSQL2);
		$row2 = $objQuery2->fetch_assoc();
		$Total2 = $_SESSION["strQty2"][$i] * $row2["svlist_price"];
		$SumTotal2 = $SumTotal2 + $Total2;
 ?>
	<tr>
		<td width="100" align="center"><?=$_SESSION["strProductID2"][$i];?></td>
		<td width="100" align="center"><?=$row2["svlist_name"]?></td>
		<td width="100" align="center"><?=$row2["svlist_price"]?></td>
		<td width="100" align="center"><?=$_SESSION["strQty2"][$i];?></td>
		<td width="100" align="center"><?=number_format($Total2,2);?></td>
	</tr>
	<?php
	  }
	} $_SESSION["SumTotal"]=$SumTotal2;
  ?>
</table><p></p>

<form method="post">
<table align="center" border="1">
	<tr height="50">
		<td width="100" align="center">&nbsp;รหัสการจอง<span style="color:red">*</span></td>
		<?php if(isset($book_id))	{	
			$sql="SELECT * FROM book where book_id = '".$book_id."'";
			$result=$db->query($sql);
			$row=$result->fetch_assoc();
			$sql1="SELECT * FROM customer WHERE cus_id = '".$row["cus_id"]."'";
			$result1=$db->query($sql1);
			$row1=$result1->fetch_assoc();
		?>
		<td width="200" align="center">BKN-<?=$row["book_id"];?></td>
		</tr>
		<?php if ($row['book_status_pay']!=3) { 
			$_SESSION['priceplus'] = $row['book_debt'];
			?>
			<tr height="50">
			<td width="120" align="center">&nbsp;ค้างชำระ(บาท)<span style="color:red">*</span></td>
			<td width="200" align="center"><font color="red"><?=number_format($row['book_debt'],2)?></font></td>
		</tr>
		<?php } ?>
		
		<tr height="50">
			<td width="100" align="center">&nbsp;รหัสลูกค้า</td>
			<td width="200" align="center"><?=$row1['cus_id']?></td>
		</tr>
		<tr height="50">
				<input type="hidden" name="book_id" value="<?=$book_id;?>">
				<td width="100" align="center">&nbsp;ชื่อลูกค้า</td>
				<td width="200" align="center"><?=$row1['cus_name']?></td>
			</tr>
		<tr>
			<td align="center">ส่วนลด</td>
			<td align="center"><select name="CostDiscount" onchange="document.location.href=this.value">
				<option <?php if($_GET['rate']==1)echo "selected";?> value="save_servicecost.php?book_id=<?=$_GET['book_id']?>&rate=1">-ไม่มีส่วนลด-</option>
				<option <?php if($_GET['rate']==0.95)echo "selected";?> value="save_servicecost.php?book_id=<?=$_GET['book_id']?>&rate=0.95">5%</option>
				<option <?php if($_GET['rate']==0.9)echo "selected";?> value="save_servicecost.php?book_id=<?=$_GET['book_id']?>&rate=0.9">10%</option>
			</select></td>
		</tr>
		<?php }
		else { ?>
		<td width="200" align="center"><a class="btn btn-primary" href="choose_booklist.php">เลือก</a></td>
		<?php } ?>

	</tr>
</table><p></p>
<?php 
	if ($row['book_status_pay']!=3) {
		$_SESSION["SumTotal"] = $_SESSION["SumTotal"]+$row['book_debt'] ;
	}
?>
<?php
	$_SESSION["Dis"] = (1-$_GET['rate'])*$_SESSION["SumTotal"];
	$_SESSION["Net"] = $_SESSION["SumTotal"]-$_SESSION["Dis"];
?>
<table border="0" align="center">
	<tr>
		<td align="right" width="300"><h4>ราคารวม <?=number_format($_SESSION["SumTotal"],2)?> บาท</h4></td>
	</tr>
<?php 
	if(isset($_GET['book_id'])){
?>
	<tr>
		<td align="right"><h4><font color="red">ส่วนลด <?=number_format($_SESSION["Dis"],2)?> บาท</font></h4></td>
	</tr>
	<tr>
		<td align="right"><h4>ยอดสุทธิ <?=number_format($_SESSION["Net"],2)?> บาท</h4></td>
	</tr>
<?php 
	}
?>
</table>
<table align="center" border="0">
	<tr height="50" align="center">
		<td width="500">
			<input 
			<?php if($_GET['book_id']==NULL) echo "disabled"; ?> 
			class="btn btn-success" type="submit" onclick="return confirm('ต้องการบันทึกค่าใช้จ่ายใช่หรือไม่?')" name="submit" value="บันทึก">
			<a class="btn btn-secondary" href="save_servicecost.php">ล้างค่า</a>
			<a class="btn btn-danger" href="cart_servicecost.php">ยกเลิก</a>
		</td>
	</tr>
</table>
</form>
</body>
</html>