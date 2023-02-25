<?php require'header.php';require'../../../public/switch.php';require'../../../public/datediff.php';?>
<?php 
  if(isset($_SESSION['ddd'])){
    header('location:choose_room.php');
  }
?>
 <form id="form1" name="form1" method="POST" action="choose_room.php">
  <h2 style="text-align: center;"><span style="color:black">ค้นหาห้องว่าง</span></h2>
  <table width="272" height="124" border="1" align="center">
    <tr>
      <td width="72" height="36"><div align="center" style="color:black">เข้าพัก</div></td>
      <td width="184"><div align="center"><label for="checkin"></label>
      <input  id="txtDate" name="checkin" type="date" id="checkin" required="required" value="<?=date('Y-m-d')?>"></div></td>
    </tr>
    <tr>
      <td height="38"><div align="center" style="color:black">ย้ายออก</div></td>
      <td><div align="center"><label for="checkout"></label>
      <input  id="txtDate2" name="checkout" type="date" id="checkout" required="required"></div></td>
    </tr>
    <tr>
      <td height="40" colspan="2" style="text-align: center"><input class="btn btn-primary ml-1 pl-5 pr-5" type="submit" name="Submit" id="button" value="ค้นหา">
    </tr>
  </table>
</form>

<script type="text/javascript">
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#txtDate').attr('min', maxDate);
    $('#txtDate2').attr('min', maxDate);
});
</script>

</body>
</html>