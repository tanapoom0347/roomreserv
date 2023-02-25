<?php
ob_start();
session_start();
	
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strroom_id"][$i] != "")
	  {
			$_SESSION["strAdultQty"][$i] = $_POST["adultvalue".$i];
			$_SESSION["strChildQty"][$i] = $_POST["childvalue".$i];
	  }
  }
	header("location:save_booking.php");

?>