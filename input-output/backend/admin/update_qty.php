<?php
ob_start();
session_start();
	
  for($i=0;$i<=(int)$_SESSION["intLine2"];$i++)
  {
	  if($_SESSION["strProductID2"][$i] != "")
	  {
			$_SESSION["strQty2"][$i] = $_POST["txtQty".$i];
	  }
  }
	
	header("location:cart_servicecost.php");

?>