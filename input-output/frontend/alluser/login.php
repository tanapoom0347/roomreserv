<?php require'header.php';
	if(isset($_POST['submit'])) {
		$username=$_POST['uname'];
		$password=$_POST['pword'];
		$sql="SELECT * FROM customer WHERE cus_username='$username' AND cus_password='$password'";
		$result = $db->query($sql);
		$numrows = $result->num_rows;
		if($numrows>=1){
			$row=$result->fetch_assoc();
			$_SESSION['login_cus_id']=$row['cus_id'];
			$_SESSION['login_cus_username']=$row['cus_username'];
			$result->free();$db->close();
			alert_message("ยินดีต้อนรับคุณ ".$_SESSION['login_cus_username']." เข้าสู่ระบบ");
			goto_url('../member/home.php');
		}
			else alert_message('ไม่พบผู้ใช้งานในระบบ');
	}
?>
<br/><br/>
<h1 align="center">เข้าสู่ระบบจองห้องพักรีสอร์ท</h1>
<form method="post">
	<table align="center" border="1" width="270">
		<tr height="45">
		<td width="75" align="right">ชื่อผู้ใช้&nbsp;<span style="color:red">*</span></td>
		<td align="center"><input type="text" name="uname" required></td>
		</tr>
		<tr height="45">
			<td  align="right">รหัสผ่าน&nbsp;<span style="color:red">*</span></td>
			<td align="center"><input type="password" name="pword" required></td>
		</tr>
		<tr  height="50">
			<td colspan="2" align="center">
				<input class="btn btn-success" type="submit" name="submit" value="เข้าสู่ระบบ">
				<button class="btn btn-danger" onclick="if(confirm('ต้องการออกจากหน้านี้หรือไม่?')==true)window.location='../../../';">ยกเลิก</button>
			</td>
		</tr>
	</table>
</form>
</body>
</html>