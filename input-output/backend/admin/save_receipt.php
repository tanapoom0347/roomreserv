<?php require'header.php';?>
<?php 
if(isset($_POST['submit']))
{
	$s_n = $_POST['s_n'];
	$s_d = $_POST['s_d'];
	$sql1="
	INSERT INTO receipt (receipt_net,receipt_discount,receipt_outdate,receipt_status,cus_id)
	VALUES
	('$s_n','$s_d','".date("Y-m-d H:i:s")."',0,'".$_POST['cus_id']."')
	";
	if($db->query($sql1)==TRUE)
	{
		$insert_num = $db->insert_id;
	}
	else
	{
		echo $sql1;
	}

	  for($i=0;$i<=(int)$_SESSION["intLine3"];$i++)
  {
	  if($_SESSION["strProductID3"][$i] != "")
	  {
			  $strSQL = "
				UPDATE servicecost
				SET receipt_id = '".$insert_num."'
				WHERE svcost_id = '".$_SESSION["strProductID3"][$i]."'
			  ";
			if($db->query($strSQL)==FALSE)
			{
				echo $strSQL;
			}
	  }
  }
  unset($_SESSION["strSUMtotal"]);
  unset($_SESSION["strSumD"]);
  unset($_SESSION["strSumN"]);
  unset($_SESSION["intLine3"]);
  unset($_SESSION["strProductID3"]);
  unset($_SESSION["strQty3"]);
  unset($_SESSION["SumTotal2"]);

  alert_message('บันทึกการชำระ '.$insert_num.' สำเร็จ');
  goto_url('show_receipt.php');
  //header("location:show_receipt.php");

}
?>
<?php 
if(isset($_GET['cus_id']))
{
	$cus_id = $_GET['cus_id'];
}
?>
<h1 align="center" style="color:black">บันทึกแจ้งชำระ</h1>
<h3 align="center" style="color:black">รายการค่าใช้จ่าย</h3>
<table align="center" border="1">
	<thead align="center">
	<tr>
		<th width="110" align="center">รหัสค่าใช้จ่าย</th>
		<th width="110" align="center">รหัสค่าการจอง</th>
		<th width="140" align="center">ชือลูกค้า</th>
		<th width="100" align="center">รวม(บาท)</th>
		<th width="100" align="center">ส่วนลด(บาท)</th>
		<th width="100" align="center">สุทธิ(บาท)</th>
	</tr>
	</thead>
<?php
$Total = 0;
$SumTotal = 0;
  for($i=0;$i<=(int)$_SESSION["intLine3"];$i++)
  {
	  if($_SESSION["strProductID3"][$i] != "")
	  {
		$strSQL3 = "SELECT * FROM servicecost WHERE svcost_id = '".$_SESSION["strProductID3"][$i]."' ";
		$objQuery3 = $db->query($strSQL3);
		$row3 = $objQuery3->fetch_assoc();
		$str1 = "select * from book where book_id = '".$row3["book_id"]."' ";
		$result1 = $db->query($str1);
		$row1 = $result1->fetch_assoc();
		$str2 = "select * from customer where cus_id = '".$row1["cus_id"]."'";
		$result2 = $db->query($str2);
		$row2 = $result2->fetch_assoc();
		$Total2 = $row3["svcost_total"];
		$SumTotal2 = $SumTotal2 + $Total2;
?>
	<tr>
		<td align="center">SVC-<?=$_SESSION["strProductID3"][$i];?></td>
		<td align="center">BKN-<?=$row1["book_id"]?></td>
		<td align="center"><?=$row2["cus_name"]?></td>
		<td align="right"><?=number_format($row3["svcost_total"],2);?>&nbsp;&nbsp;&nbsp;</td>
		<td align="right"><?=number_format($row3["svcost_total"]-$row3["svcost_net"],2);?>&nbsp;&nbsp;&nbsp;</td>
		<td align="right"><?=number_format($row3["svcost_net"],2);?>&nbsp;&nbsp;&nbsp;</td>
	</tr>
	<?php
	  }
  } $_SESSION["SumTotal2"]=$SumTotal2;
  ?>
</table><p></p>

<table border="0" align="center">
	<tr>
		<td width="100" align="right"><b>รวมทั้งหมด</b></td>
		<td width="130" align="right"><?=number_format($_SESSION['strSUMtotal'],2)?> บาท</td>
	</tr>
	<tr>
		<td align="right"><b>ส่วนลด</b></td>
		<td align="right"><?=number_format($_SESSION['strSumD'],2)?> บาท</td>
	</tr>
	<tr>
		<td align="right"><b>ยอดชำระ</b></td>
		<td align="right"><?=number_format($_SESSION['strSumN'],2)?> บาท</td>
		
	</tr>
</table>

<p></p>
<form method="post">
<table align="center" border="1">
	<tr height="50">
		<td width="100">&nbsp;รหัสลูกค้า<span style="color:red">*</span></td>
		<?php if(isset($cus_id))	{	
			$sql="SELECT * FROM customer where cus_id = '".$cus_id."'";
			$result=$db->query($sql);
			$row=$result->fetch_assoc();
		?>
		<td width="200" align="center"><?=$cus_id;?></td>
		</tr>
		<tr height="50">
				<input type="hidden" name="cus_id" value="<?=$cus_id;?>">
				<input type="hidden" name="id" value="<?=$_GET['id']?>">
				<input type="hidden" name="s_d" value="<?=$_SESSION['strSumD']?>">
				<input type="hidden" name="s_n" value="<?=$_SESSION['strSumN']?>">
				<td width="100" align="center">&nbsp;ชื่อลูกค้า</td>
				<td width="200" align="center"><?=$row['cus_name']?></td>
			</tr>
		<?php }
		else { ?>
		<td width="200" align="center"><a class="btn btn-primary" href="choose_customer.php">เลือก</a></td>
		<?php } ?>

	</tr>
</table>
<table align="center" border="0">
	<tr height="50" align="center">
		<td width="500">
			<input <?php if($_GET['cus_id']=='')echo "disabled";?> class="btn btn-success" type="submit" onclick="return confirm('ต้องการบันทึกใช่หรือไม่?')" name="submit" value="บันทึก">
			<a class="btn btn-secondary" href="save_receipt.php">ล้างค่า</a>
			<a class="btn btn-danger" href="cart_receipt.php">ยกเลิก</a>
		</td>
	</tr>
</table>
</form>
</body>
</html>