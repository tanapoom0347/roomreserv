<?php require'../../../../conn.php';require'../../../../public/switch.php';require'../../../../public/datediff.php';

	$output = '';
	if(isset($_POST['query'])){
		$search=$_POST['query'];
		$sql="
select * from room where (room_id LIKE '%$search%') and (room_id NOT IN (
SELECT e.room_id FROM book r
JOIN booklist e ON r.book_id = e.book_id
WHERE r.book_status_deposit != '4' AND (
(e.booklist_datein BETWEEN '".$_SESSION['ddd']."' AND '".$_SESSION['aaa']."')
OR ( e.booklist_dateout BETWEEN '".$_SESSION['ddd']."' AND '".$_SESSION['aaa']."') OR 
('".$_SESSION['ddd']."' BETWEEN e.booklist_datein AND e.booklist_dateout) OR 
('".$_SESSION['aaa']."' BETWEEN e.booklist_datein AND e.booklist_dateout)))";
	}
	else{

$sql = "SELECT * FROM room WHERE room_id NOT IN (
SELECT e.room_id FROM book r
JOIN booklist e ON r.book_id = e.book_id
WHERE r.book_status_deposit != '4' AND (
(e.booklist_datein BETWEEN '".$_SESSION['ddd']."' AND '".$_SESSION['aaa']."')
OR ( e.booklist_dateout BETWEEN '".$_SESSION['ddd']."' AND '".$_SESSION['aaa']."') OR 
('".$_SESSION['ddd']."' BETWEEN e.booklist_datein AND e.booklist_dateout) OR 
('".$_SESSION['aaa']."' BETWEEN e.booklist_datein AND e.booklist_dateout)))";
	
}

	$res=$db->query($sql);
	if($res->num_rows==0){
		echo $output;
	}
	else {
		while($row=$res->fetch_assoc()){
			$sql2="SELECT * FROM customer WHERE cus_id = '".$row["cus_id"]."' ";
			$result2=$db->query($sql2);
			$row2=$result2->fetch_assoc();
			$output .= '

		<tr>
        <td><div align="center"><img src="../../../img/room/'.$row['room_picture'].'" width="150" height="150" /></div></td>
        <td><div align="center">'.$row['room_name'].'</div></td>
        <td><div align="center">'.number_format($row['room_rate'],2).'</div></td>
        <td><div align="center">'.type_room($row['room_category']).'</div></td>
        <td><div align="center">'.$row['room_bed']*2.'</div></td>
        <td><div align="center">'.dmy($_SESSION['ddd']).'</div></td>
        <td><div align="center">'.dmy($_SESSION['aaa']).'</div></td>
        <td><div align="center">'.$_SESSION['bbb'].'</div></td>
        <td><div align="center">'.number_format($_SESSION['bbb']*$row['room_rate'],2).'</div></td>
        <td><div align="center"><a class="btn btn btn-outline-success" href="choose_room.php?room_id='.$row["room_id"].'" role="button">
        เลือก</a></div></td>
      </tr>

			';
		}
		echo $output;
	}

.'