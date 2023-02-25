<?php require'header.php';require'../../../public/datediff.php';require'../../../public/switch.php';?>
<?php
$sql = "SELECT * FROM room";
$result = $db->query($sql);
$numrows = $result->num_rows;
$Per_Page = 3;   // Per Page
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
<h2 align="center">แสดงรายการห้องพัก</h2>
<form class="form-inline justify-content-center">
<input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" id="search_text">
<button class="btn btn-outline-success" type="submit">Search</button></form><p></p>
<div align="center">
  <a class="btn btn-success" href="cart_room.php">เลือก/ยกเลิกห้องพัก</a><p></p>
  <table border="1">
    <thead>
    <tr>
      <th width="100"><div align="center">รหัสห้องพัก</div></th>
      <th width="70"><div align="center">รูปห้องพัก</div></th>
      <th width="85"><div align="center">ชื่อห้องพัก</div></th>
      <th width="90"><div align="center">ราคา(บาท)</div></th>
      <th width="80"><div align="center">ประเภท</div></th>
      <th width="60"><div align="center">ขนาด</div></th>
      <th width="85"><div align="center"></div></th>
    </tr>
    </thead>
    <tbody>
    <?php
     while ($row=$result->fetch_assoc()) { ?>

      <tr>
        <td><div align="center"><?=$row['room_id']?></div></td>
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
        <td><div align="center"><a class="btn btn btn-outline-success" href="search_room.php" role="button">
        เลือก</a></div></td>
      </tr>
    
      <?php }$result->free();$db->close();?>
      </tbody>
  </table>
</div><p></p>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php if($Prev_Page==0)$Prev_Page++;?>
    <li class="page-item"><a class="page-link" href="show_list_room.php?page=<?=$Prev_Page;?>">Previous</a></li>
<?php for($i=1; $i<=$Num_Pages; $i++) {?>

<li class="page-item"><a class="page-link" href="show_list_room.php?page=<?=$i;?>"><?=$i; ?></a></li>

<?php } ?>
<?php if($Next_Page==($Num_Pages+1))$Next_Page=$Num_Pages;?>
    <li class="page-item"><a class="page-link" href="show_list_room.php?page=<?=$Next_Page;?>">Next</a></li>
  </ul>

<script type="text/javascript">
  $(document).ready(function(){
    $('#search_text').keyup(function(){
      var search = $(this).val();
      $.ajax({
        url:'ajax/list_room.php',
        method:'post',
        data:{query:search},
        success:function(response){
          $('tbody').html(response);
        }
      })
    })
  })
</script>

</body>
</html>