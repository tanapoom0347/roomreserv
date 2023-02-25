<?php require'../../../conn.php';
if(isset($_POST['logout']))echo "<script language='javascript' type='text/javascript'>if(window.confirm('ท่านต้องการออกจากระบบใช่หรือไม่?')==true){alert('ท่านได้ออกจากระบบแล้ว');window.location='header.php?out';}</script>";
if(isset($_GET['out'])){ob_start();session_start();
	unset($_SESSION['login_cus_id']);
	unset($_SESSION['login_cus_username']);
unset($_SESSION["intLine"]);
unset($_SESSION["strroom_id"]);
unset($_SESSION["strbooklist_datein"]);
unset($_SESSION["strbooklist_dateout"]);
unset($_SESSION["strbooklist_dateout2"]);
unset($_SESSION["checkin"]);
unset($_SESSION["checkout"]);
unset($_SESSION["num_days"]);
unset($_SESSION['sum']);
unset($_SESSION['aaa']);
unset($_SESSION['ddd']);
unset($_SESSION['bbb']);
	ob_end_clean();header("Location:../../../");}?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" type="text/css" href="../../../img/others/favicon.png" />
<link rel="stylesheet" href="../../../public/css/fontawesome.css">
<link rel="stylesheet" href="../../../public/css/bootstrap.css">
<script src="../../../public/js/jquery-3.4.1.js"></script>
<script src="../../../public/js/bootstrap.bundle.js"></script>
<title>แสงเทียน บีช รีสอร์ท</title></head>
<style>
.footer {
  left: 0;
  bottom: 0;
  width: 100%;
  text-align: center;
}
</style>
<body>
<style type="text/css">.dropdown:hover .dropdown-menu{display: block;margin-top: 0;}.dropdown .dropdown-toggle:active{pointer-events: none;}</style>
<nav class="navbar navbar-expand-sm navbar-light bg-danger">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span></button><span class="sr-only">(current)</span>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav">
<li class="nav-item"><a class="btn btn-danger" href="home.php">หน้าแรก</a></li>
<li class="nav-item"><a class="btn btn-danger" href="show_room.php">แสดงห้องพัก</a></li>
<li class="nav-item"><a class="btn btn-danger" href="show_book.php">แสดงรายการจอง</a></li>
<li class="nav-item"><a class="btn btn-danger" href="contact.php">ติดต่อเรา</a></li>
<li class="nav-item"><a class="btn btn-danger" href="gallery.php">แกลเลอรี่</a></li>
<a href="https://line.me/R/ti/p/%40sangthian" target="_blank"><img src="../../../img/others/line.png" style="width:20px;margin-top: 10px;margin-left: 25px;margin-right: 2px;"></a>
<a href="https://www.facebook.com/SangThianBeachResort/" target="_blank"><img src="../../../img/others/facebook.png" style="width:20px;margin-top: 10px;margin-left: 15px;margin-right: 2px;"></a>
<a href="https://www.instagram.com/sangthianbeachresort_samed/" target="_blank"><img src="../../../img/others/instragram.png" style="width:20px;margin-top: 10px;margin-left: 15px;margin-right: 2px;"></a>
</ul>
<ul class="navbar-nav ml-auto">
<div class="btn-group" role="group">
<li class="nav-item dropdown">
<a id="dropdownMenuButton" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">&nbsp;&nbsp;&nbsp;<i class="fas fa-user"></i> <?php echo $_SESSION["login_cus_username"]; ?>&nbsp;&nbsp;</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
<a class="dropdown-item text-success" href="edit_profile.php?id=<?php echo $_SESSION["login_cus_id"]; ?>"><i class="fas fa-user-edit"></i>&nbsp;แก้ไขข้อมูลผู้ใช้</a>
<a class="dropdown-item text-warning" href="../../../img/manual/UserManual-Cus.pdf" target="_blank"><i class="fas fa-book"></i>&nbsp;&nbsp;&nbsp;คู่มือการใช้งาน</a>
<div class="dropdown-divider"></div>
<form method="post"><button class="dropdown-item text-danger" type="submit" name="logout"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;ออกจากระบบ</button></form></div>
</li></div></ul></div></nav><footer class="footer">
        &copy; Copyright 2020 All Right Reserved , Best view in Google Chrome
</footer>
<br/>