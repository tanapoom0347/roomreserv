<?php require'header.php';require'../../../public/switch.php';require'../../../public/datediff.php';?>
<?php
if(isset($_GET["room_id"])){
if(!isset($_SESSION["intLine"])){
$_SESSION["intLine"] = 0;
$_SESSION["strroom_id"][0] = $_GET["room_id"];
$_SESSION["strbooklist_datein"][0] = $_SESSION['ddd'];
$_SESSION["strbooklist_dateout"][0] = $_SESSION['aaa'];
$_SESSION["strbooklist_dateout2"][0] = $_SESSION['bbb'];
  unset($_SESSION["checkin"]);
  unset($_SESSION["checkout"]);
  unset($_SESSION["num_days"]);
  unset($_SESSION['sum']);
header("location:cart_room.php");}
else
{$_SESSION["intLine"] = $_SESSION["intLine"] + 1;
$intNewLine = $_SESSION["intLine"];
$_SESSION["strroom_id"][$intNewLine] = $_GET["room_id"];
$_SESSION["strbooklist_datein"][$intNewLine] = $_SESSION['ddd'];
$_SESSION["strbooklist_dateout"][$intNewLine] = $_SESSION['aaa'];
$_SESSION["strbooklist_dateout2"][$intNewLine] = $_SESSION['bbb'];
  unset($_SESSION["checkin"]);
  unset($_SESSION["checkout"]);
  unset($_SESSION["num_days"]);
  unset($_SESSION['sum']);
header("location:cart_room.php");}}
?>
<?php
if(isset($_POST['checkin'])){
$_SESSION['ddd'] = $_POST['checkin'] ;
$_SESSION['aaa'] = $_POST['checkout'];
$_SESSION['bbb'] = ((strtotime($_POST['checkout']) - strtotime($_POST['checkin']))/  ( 60 * 60 * 24 ));}
$checkin=Date($_POST['checkin']);
$checkout=Date($_POST['checkout']);
$_SESSION['checkin']=$_POST['checkin'];
$_SESSION['checkout']=$_POST['checkout'];
$_SESSION['num_days']=DateDiff("$checkin","$checkout");
$sql = "SELECT * FROM room WHERE room_id NOT IN (
SELECT e.room_id FROM book r
JOIN booklist e ON r.book_id = e.book_id
WHERE r.book_status_deposit != '4' AND (
(e.booklist_datein BETWEEN '".$_SESSION['ddd']."' AND '".$_SESSION['aaa']."')
OR ( e.booklist_dateout BETWEEN '".$_SESSION['ddd']."' AND '".$_SESSION['aaa']."') OR 
('".$_SESSION['ddd']."' BETWEEN e.booklist_datein AND e.booklist_dateout) OR 
('".$_SESSION['aaa']."' BETWEEN e.booklist_datein AND e.booklist_dateout)))";
$result = $db->query($sql);
$numrows = $result->num_rows;
$Per_Page = 4;   // Per Page
$Page = $_GET["page"];
if(!$_GET["page"])
{$Page=1;}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($numrows<=$Per_Page)
{$Num_Pages =1;}
else if(($numrows % $Per_Page)==0)
{$Num_Pages =($numrows/$Per_Page) ;}
else
{$Num_Pages =($numrows/$Per_Page)+1;
$Num_Pages = (int)$Num_Pages;}
$sql .=" ORDER BY room_id ASC LIMIT $Page_Start , $Per_Page";
$result = $db->query($sql);
?>
<h2 align="center" style="color: black">แสดงรายการห้องพัก</h2>
<p></p>
<center><b>วันที่เข้าพัก <?=dmy($_SESSION['ddd'])?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ย้ายออก <?=dmy($_SESSION['aaa'])?></b></center>
<div align="center">
  <table border="1">
    <tr>
      <td width="70"><div align="center">รูปห้องพัก</div></td>
      <td width="85"><div align="center">ชื่อห้องพัก</div></td>
      <td width="90"><div align="center">ราคาห้องพัก</div></td>
      <td width="80"><div align="center">ประเภท</div></td>
      <td width="60"><div align="center">ขนาด</div></td>
      <td width="100"><div align="center">วันที่เข้าพัก</div></td>
      <td width="100"><div align="center">วันที่ย้ายออก</div></td>
      <td width="60"><div align="center">จำนวน</div></td>
      <td width="85"><div align="center">ราคารวม</div></td>
      <td width="85"><div align="center"></div></td>
    </tr>
    <?php
     while ($row=$result->fetch_assoc()) { ?>
      <tr>
        <td><div align="center"><img src="../../../img/room/<?=$row['room_picture']; ?>" width="150" height="150" /></div></td>
        <td><div align="center"><?=$row['room_name']; ?></div></td>
        <td><div align="center"><?=number_format($row['room_rate'],2); ?></div></td>
        <td><div align="center"><?php if ($row['room_category']==1) echo "<span style='color:green;'>Sea View</span>";
if ($row['room_category']==2) echo "<span style='color:Red;'>Top</span>";
if ($row['room_category']==3) echo "<span style='color:FUCHSIA;'>Vip</span>";
if ($row['room_category']==4) echo "<span style='color:Blue;'>Big House</span>";
?>
        </div></td>
        <td><div align="center"><?=$row['room_bed']*2;echo" ท่าน"; ?></div></td>
        <td><div align="center"><?=dmy($_SESSION['ddd']);?></div></td>
        <td><div align="center"><?=dmy($_SESSION['aaa']);?></div></td>
        <td><div align="center"><?=$_SESSION['bbb']." วัน";?></div></td>
        <td><div align="center"><?=number_format($_SESSION['bbb']*$row['room_rate'],2);?></div></td>
        <td><div align="center"><a class="btn btn btn-outline-success" href="choose_room.php?room_id=<?=$row["room_id"];?>" role="button">
        เลือก</a></div></td>
      </tr>

      <?php }$result->free();$db->close();?>
  </table>
</div><p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="choose_room.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="choose_room.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="choose_room.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>
</body>
</html>