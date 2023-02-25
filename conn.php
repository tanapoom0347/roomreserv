<?php 
ob_start();
session_start();
date_default_timezone_set('Asia/Bangkok');
$db = new mysqli('localhost','root','','roomreserv');
$db->query("SET NAMES utf8 COLLATE utf8_general_ci");
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
function alert_message($word){echo "<script type='text/javascript'>alert('$word')</script>";}
function goto_url($url){echo "<script type='text/javascript'>window.location='$url';</script>";}
?>