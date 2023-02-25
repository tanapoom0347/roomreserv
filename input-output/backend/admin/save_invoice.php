<?php require'header.php';?>
<h1 align="center" style="color:black">บันทึกการชำระ</h1>
<form>
<h3 align="center" style="color:black">รายการค่าใช้จ่าย</h3>
<table align="center" border="1">
  <tr>
    <td width="100" align="center">รหัสค่าใช้จ่าย</td>
    <td width="150" align="center">ชื่อผู้ใช้บริการ</td>
    <td width="100" align="center">ราคารวม</td>
    <td width="100" align="center">สถานะ</td>
  </tr>
  <tr>
    <td width="100" align="center">SVC-1</td>
    <td width="" align="center">สมปอง ทองดี</td>
    <td width="100" align="center">5,000.00</td>
    <td width="100" align="center"><font color="red">ยังไม่ชำระ</font></td>
  </tr>
  <tr>
    <td width="100" align="center">SVC-2</td>
    <td width="" align="center">สมหญิง แวววาว</td>
    <td width="100" align="center">2,000.00</td>
    <td width="100" align="center"><font color="red">ยังไม่ชำระ</font></td>
  </tr>
    <tr>
    <td width="100" align="center">SVC-3</td>
    <td width="" align="center">สมชาย อยู่สุข</td>
    <td width="100" align="center">1,500.00</td>
    <td width="100" align="center"><font color="red">ยังไม่ชำระ</font></td>
  </tr>
</table><p></p>
<h3 align="center">รวม <font color="red">8,500.00</font> บาท</h3><p></p>
<table align="center" border="1">
  <tr height="50">
    
    <td width="100">&nbsp;ชื่อลูกค้า<span style="color:red">*</span></td>
    <td width="200">
      <select name="cus_id">
      <?php $result=$db->query("SELECT * FROM customer");
      while ($row=$result->fetch_assoc()) {?>
        <option value="<?=$row['cus_id']?>"><?=$row['cus_name']?></option>
      <?php }?>
      </select>
    </td>
  </tr>
</table>
<table align="center" border="0">
  <tr height="50" align="center">
    <td width="500">
      <a class="btn btn-success" href="show_receipt.php" onclick="return confirm('ต้องการบันทึกการชำระใช่หรือไม่?')">บันทึก</a>
      <a class="btn btn-secondary" href="">ล้างค่า</a>
      <a class="btn btn-danger" href="add_invoice.php" onclick="return confirm('ต้องการยกเลิกใช่หรือไม่?')">ยกเลิก</a>
    </td>
  </tr>
</table>
</form>
</body>
</html>