<?php require'header.php';?>
<?php 

if(isset($_GET['clear']))
{
	unset($_SESSION["intLine3"]);
	unset($_SESSION["strProductID3"]);
	unset($_SESSION["strQty3"]);
	header("location:cart_receipt.php");
}

if(isset($_GET["Line3"]))
	{
		$Line3 = $_GET["Line3"];
		$_SESSION["strProductID3"][$Line3] = "";
		$_SESSION["strQty3"][$Line3] = "";
		header("location:cart_receipt.php");
	}

if(!isset($_SESSION["intLine3"]))
{
	if(isset($_GET["svcost_id"]))
	{
		 $_SESSION["intLine3"] = 0;
		 $_SESSION["strProductID3"][0] = $_GET["svcost_id"];
		 $_SESSION["strQty3"][0] = 1;
		 header("location:cart_receipt.php");
	}
}
else
{	
	if(isset($_GET["svcost_id"]))
	{
		 $_SESSION["intLine3"] = $_SESSION["intLine3"] + 1;
		 $intNewLine3 = $_SESSION["intLine3"];
		 $_SESSION["strProductID3"][$intNewLine3] = $_GET["svcost_id"];
		 $_SESSION["strQty3"][$intNewLine3] = 1;
		 header("location:cart_receipt.php");
	}
}

?>

<h1 align="center" style="color:black">เลือก/ยกเลิกค่าใช้จ่าย</h1><p></p>
<form action="update_qty.php" method="post">
<table align="center" border="1">
	<thead align="center">
	<tr>
		<th width="120" align="center">รหัสค่าใช้จ่าย</th>
		<th width="120" align="center">รหัสการจอง</th>
		<th width="140" align="center">ชือลูกค้า</th>
		<th width="100" align="center">รวม(บาท)</th>
		<th width="100" align="center">ส่วนลด(บาท)</th>
		<th width="100" align="center">สุทธิ(บาท)</th>
		<th width="80" align="center"></th>
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
		$Total = $row3["svcost_total"];
		$SumTotal = $SumTotal + $Total;
		$SumN = $SumN + $row3["svcost_net"];
?>
	<tr>
		<td align="center">SVC-<?=$_SESSION["strProductID3"][$i];?></td>
		<td align="center">BKN-<?=$row1["book_id"]?></td>
		<td align="center"><?=$row2["cus_name"]?></td>
		<td align="right"><?=number_format($row3["svcost_total"],2);?>&nbsp;&nbsp;</td>
		<td align="right"><?=number_format($row3["svcost_total"]-$row3["svcost_net"],2);?>&nbsp;&nbsp;</td>
		<td align="right"><?=number_format($row3["svcost_net"],2);?>&nbsp;&nbsp;</td>
		<td align="center"><a class="btn btn-danger" href="cart_receipt.php?Line3=<?=$i;?>">ยกเลิก</a></td>
	</tr>
	<?php
	  }
  }
  ?>
</table><p></p>
 
<table border="0" align="center">
	<tr>
		<td width="100" align="right"><b>รวมทั้งหมด</b></td>
		<td width="130" align="right"><?=number_format($SumTotal,2)?> บาท</td>
	</tr>
	<tr>
		<td align="right"><b>ส่วนลด</b></td>
		<td align="right"><?=number_format($SumTotal-$SumN,2)?> บาท</td>
	</tr>
	<tr>
		<td align="right"><b>ยอดชำระ</b></td>
		<td align="right"><?=number_format($SumN,2)?> บาท</td>
		<?php 
		$_SESSION['strSUMtotal'] = $SumTotal;
		$_SESSION['strSumN'] = $SumN;
		$_SESSION['strSumD'] = $SumTotal - $SumN;
		?>
	</tr>
</table>
<p></p>
</form>
<table align="center" border="0">
	<tr height="50" align="center">
		<td width="500">
			<a class="btn btn-primary" href="show_servicecost.php">เพิ่มค่าใช้จ่าย</a>
			<a class="btn btn-secondary" href="cart_receipt.php?clear">ล้างตะกร้า</a>
			<a class="btn btn-success" href="save_receipt.php">ยืนยันแจ้งชำระ</a>
		</td>
	</tr>
</table>
</body>
</html>