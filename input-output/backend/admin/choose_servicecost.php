<?php require'header.php';require'../../../public/switch.php';?>
<h1 align="center" style="color:black">รายการค่าใช้จ่าย</h1><p></p>
<form>
<table align="center" border="1">
  <tr>
    <td width="100" align="center">รหัสค่าใช้จ่าย</td>
    <td width="150" align="center">ชื่อผู้ใช้บริการ</td>
    <td width="100" align="center">ราคารวม</td>
    <td width="100" align="center">เลือก</td>
  </tr>
  <tr>
    <td width="100" align="center">SVC-1</td>
    <td width="" align="center">สมปอง ทองดี</td>
    <td width="100" align="center"><font color="green">5,000.00</font></td>
    <td width="100" align="center"><a class="btn btn-success" href="add_invoice.php" onclick="return confirm('ต้องการเลือกค่าใช้จ่ายนี้ใช่หรือไม่?')">เลือก</a></td>
  </tr>
  <tr>
    <td width="100" align="center">SVC-2</td>
    <td width="" align="center">สมหญิง แวววาว</td>
    <td width="100" align="center"><font color="green">2,000.00</font></td>
    <td width="100" align="center"><a class="btn btn-success" href="add_invoice.php" onclick="return confirm('ต้องการเลือกค่าใช้จ่ายนี้ใช่หรือไม่?')">เลือก</a></td>
  </tr>
   <tr>
    <td width="100" align="center">SVC-3</td>
    <td width="" align="center">สมชาย อยู่สุข</td>
    <td width="100" align="center"><font color="green">1,500.00</font></td>
    <td width="100" align="center"><a class="btn btn-success" href="add_invoice.php" onclick="return confirm('ต้องการเลือกค่าใช้จ่ายนี้ใช่หรือไม่?')">เลือก</a></td>
  </tr>
  <tr>
    <td width="100" align="center">SVC-4</td>
    <td width="" align="center">สมศรี ใบบัว</td>
    <td width="100" align="center"><font color="green">14,000.00</font></td>
    <td width="100" align="center"><a class="btn btn-success" href="add_invoice.php" onclick="return confirm('ต้องการเลือกค่าใช้จ่ายนี้ใช่หรือไม่?')">เลือก</a></td>
  </tr>
</table>
</form>
</body>
</html>