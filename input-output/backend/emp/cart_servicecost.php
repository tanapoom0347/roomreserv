<?php require'header.php';?>
<?php 

if(isset($_GET['clear']))
{
	unset($_SESSION["intLine2"]);
	unset($_SESSION["strProductID2"]);
	unset($_SESSION["strQty2"]);
	header("location:cart_servicecost.php");
}

if(isset($_GET["Line2"]))
	{
		$Line2 = $_GET["Line2"];
		$_SESSION["strProductID2"][$Line2] = "";
		$_SESSION["strQty2"][$Line2] = "";
		header("location:cart_servicecost.php");
	}

if(!isset($_SESSION["intLine2"]))
{
	if(isset($_GET["svlist_id"]))
	{
		 $_SESSION["intLine2"] = 0;
		 $_SESSION["strProductID2"][0] = $_GET["svlist_id"];
		 $_SESSION["strQty2"][0] = 1;
		 header("location:cart_servicecost.php");
	}
}
else
{	
	if(isset($_GET["svlist_id"]))
	{
		 $_SESSION["intLine2"] = $_SESSION["intLine2"] + 1;
		 $intNewLine2 = $_SESSION["intLine2"];
		 $_SESSION["strProductID2"][$intNewLine2] = $_GET["svlist_id"];
		 $_SESSION["strQty2"][$intNewLine2] = 1;
		 header("location:cart_servicecost.php");
	}
}

?>

<h1 align="center" style="color:black">เลือก/ยกเลิกรายการบริการ</h1><p></p>
<form action="update_qty.php" method="post">
<table align="center" border="1">
	<thead align="center">
	<tr>
		<th width="140" align="center">รหัสรายการบริการ</th>
		<th width="100" align="center">ชื่อบริการ</th>
		<th width="100" align="center">ราคา(บาท)</th>
		<th width="100" align="center">จำนวน</th>
		<th width="120" align="center">ราคารวม(บาท)</th>
		<th width="80" align="center"></th>
	</tr>
	</thead>
<?php 
$Total2 = 0;
$SumTotal2 = 0;
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
		<td align="center"><?=$_SESSION["strProductID2"][$i];?></td>
		<td align="center"><?=$row2["svlist_name"]?></td>
		<td align="center"><?=$row2["svlist_price"]?></td>
		<td align="center">
			<select name="txtQty<?php echo $i;?>">
				<?php 
			
				for($qty=1;$qty<=20;$qty++)
			  {
					$sel = "";
					if($_SESSION["strQty2"][$i] == $qty)
				  {
						$sel = "selected";
				  }
			  ?>
				<option value="<?php echo $qty;?>" <?php echo $sel;?>><?php echo $qty;?></option>
				<?php
			  }
			  ?>
			</select>
		</td>
		<td align="center"><?=number_format($Total2,2);?></td>
		<td align="center"><a class="btn btn-danger" href="cart_servicecost.php?Line2=<?=$i;?>">ยกเลิก</a></td>
	</tr>
	<?php
	  }
  }
  ?>
</table><p></p>
<h4 align="center">รวมทั้งหมด <?=number_format($SumTotal2,2)?> บาท</h4>
  <table align="center" border="0">
  <tr height="50" align="center">
		<td align="center"><input class="btn btn-primary" type="submit" value="อัพเดต"></td>
	</tr>
	</table>
</table>
</form>
<table align="center" border="0">
	<tr height="50" align="center">
		<td width="500">
			<a class="btn btn-primary" href="choose_service.php">เพิ่มรายการบริการ</a>
			<a class="btn btn-secondary" href="cart_servicecost.php?clear">ล้างตะกร้า</a>
			<a class="btn btn-success" href="save_servicecost.php">ยืนยันค่าใช้จ่าย</a>
		</td>
	</tr>
</table>
</body>
</html>