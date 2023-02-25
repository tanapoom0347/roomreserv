<?php require'conn.php';
if(isset($_POST['submit'])){
$username=$_POST['uname'];
$password=$_POST['pword'];
$sql="SELECT * FROM employee WHERE emp_username='$username' AND emp_password='$password'";
$result=$db->query($sql);
$numrows=$result->num_rows;
if($numrows>=1){

$row=$result->fetch_assoc();$result->free();$db->close();
$_SESSION['login_emp_id']=$row['emp_id'];
$_SESSION['login_emp_username']=$row['emp_username'];
if($row['emp_level']==2){
  if($row['emp_status']==2){alert_message("ไม่สามารถเข้าสู่ระบบ");goto_url('loginemp.php');}else{
alert_message("ยินดีต้อนรับคุณ ".$_SESSION['login_emp_username']." เข้าสู่หน้าแรก เจ้าของกิจการ");
goto_url('input-output/backend/admin/home.php');}
}
else {
  if($row['emp_status']==2){alert_message("ไม่สามารถเข้าสู่ระบบ");goto_url('loginemp.php');}else{
alert_message("ยินดีต้อนรับคุณ ".$_SESSION['login_emp_username']." เข้าสู่หน้าแรก พนักงาน");
goto_url('input-output/backend/emp/home.php');}
}}
else alert_message('ไม่พบผู้ใช้งานในระบบ');
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" type="text/css" href="img/others/favicon.png" />
<link rel="stylesheet" href="public/css/fontawesome.css">
<link rel="stylesheet" href="public/css/bootstrap.css">
<script src="public/js/jquery-3.4.1.js"></script>
<script src="public/js/bootstrap.bundle.js"></script>
<title>แสงเทียน บีช รีสอร์ท</title></head>
<style type="text/css">
body {
  background-color:;
}
</style>
<body><br><br>
  <form ACTION="" method="POST">
  <div align="center">
    <h1>เข้าสู่ระบบจองห้องพักรีสอร์ท</h1>
    <table width="272" height="" border="1" align="center">
    <tr  height="45">
      <td width="72">ชื่อผู้ใช้<span style="color:red">*</span></td>
      <td width="184">
      <input name="uname" type="text" id="uname" size="20" maxlength="20" required="required"/></td>
    </tr>
    <tr  height="45">
      <td>รหัสผ่าน<span style="color:red">*</span></td>
      <td>
      <input name="pword" type="password" id="pword" size="20" maxlength="20" required="required"/></td>
    </tr>
    <tr  height="45">
      <td  colspan="2" style="text-align: center">
      <input class="btn btn-success" name="submit" type="submit" id="submit" value="เข้าสู่ระบบ" />
      <!--<input class="btn btn-danger pl-4 pr-4" name="button2" type="reset" id="button2" onclick="" value="ยกเลิก" /></td>-->
    </tr>
  </table>
  </div>
</form>
</body>
</html>