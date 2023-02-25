<?php require'header.php';require'../../../public/switch.php';?>
<table width="" border="1" align="center">
  <tr>
      <td align="center" colspan="2" width="317"><b>รหัสค่าใช้จ่าย SVC-2</b></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;<b>รหัสการจอง BKN-2</b></td>
    </tr>
    <tr>
      <td align="center" width="100"><b>ชื่อลูกค้า</b></td>
      <td align="center" width="217">สมชาย อยู่สุข</td>
    </tr>
    <tr>
      <td align="center" width="100"><b>รวมทั้งหมด</b></td>
      <td align="center" width="217">3,900.00 บาท</td>
    </tr>
    <tr>
      <td align="center" width="100"><b>ชำระแล้ว</b></td>
      <td align="center" width="217" style="color: green">3,900.00 บาท</td>
    </tr>
    <tr>
      <td align="center" width="100"><b>ค้างชำระ</b></td>
      <td align="center" width="217" style="color: red">0.00 บาท</td>
    </tr>
  </table>
<table align="center" width=""  border="1">
  <thead align="center">
  <tr>
    <th width="90">รหัสห้องพัก</th>
    <th width="200">ชื่อห้อง</th>
    <th width="200">วันที่เข้าพัก</th>
    <th width="200">วันที่ย้ายออก</th>
  </tr>
  </thead>
  <tbody>
  <p></p>
<h4 align="center">รายละเอียดการจอง</h4>
    <tr>
      <td align="center">1</td>
      <td align="center">room01</td>
      <td align="center">13-12-2019</td>
      <td align="center">14-12-2019</td>
    </tr>
    <tr>
      <td align="center">2</td>
      <td align="center">room02</td>
      <td align="center">13-12-2019</td>
      <td align="center">14-12-2019</td>
    </tr>
    </tbody>
</table><br>
  <h4 align="center">รายละเอียดรายการบริการ</h4>
<table align="center" width=""  border="1">
  <thead align="center">
  <tr>
    <th width="90">รหัสบริการ</th>
    <th width="110">ชื่อบริการ</th>
    <th width="95">ราคา(บาท)</th>
    <th width="65">จำนวน</th>
    <th width="120">ราคารวม(บาท)</th>
  </tr>
  </thead>
  <tbody>
  <tr>
      <td align="center">2</td>
      <td align="center">ตกปลา</td>
      <td align="center">900.00</td>
      <td align="center">1</td>
      <td align="center">900.00</td>
    </tr>
  </tbody>
</table><br>
<div align="center"><input class="btn btn-danger" name="button2" type="submit" id="button2" onclick="window.location=('show_servicecost.php');" value="ย้อนกลับ" /></td></div>
</body>
</html>