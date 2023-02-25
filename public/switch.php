<?php
function type_room($type1){switch ($type1){
case 1:return "<span style='color:green;'>Sea View</span>";break;
case 2:return "<span style='color:red;'>Top</span>";break;
case 3:return "<span style='color:fuchsia;'>Vip</span>";break;
case 4:return "<span style='color:blue;'>Big House</span>";break;
default:return "ไม่พบประเภท";break;}}
function status_emp($type1){switch ($type1){
case 1:return "<span style='color:green;'>ทำงาน</span>";break;
case 2:return "<span style='color:red;'>ลาออก</span>";break;
default:return "ไม่พบประเภท";break;}}
function level_emp($type1){switch ($type1) {
case 1:return "<span style='color:#0000FF;'>พนักงาน</span>";break;
case 2:return "<span style='color:fuchsia;'>เจ้าของกิจการ</span>";break;
default:return "ไม่พบประเภท";break;}}
function status_room($type1){switch ($type1) {
case 1:return "<span style='color:green;'>เปิดใช้งาน</span>";break;
case 2:return "<span style='color:red;'>ปิดปรับปรุง</span>";break;
default:return "ไม่พบประเภท";break;}}
function status_service($type1){switch ($type1) {
case 1:return "<span style='color:green;'>เปิดใช้งาน</span>";break;
case 2:return "<span style='color:red;'>ปิดปรับปรุง</span>";break;
default:return "ไม่พบประเภท";break;}}
function status_cus($type1){switch ($type1) {
case 1:return "<span style='color:green;'>ปกติ</span>";break;
case 2:return "<span style='color:red;'>แบล็คลิสต์</span>";break;
default:return "ไม่พบประเภท";break;}}
function type_cus($type1){switch ($type1) {
case 1:return "<span style='color:green;'>ทั่วไป</span>";break;
case 2:return "<span style='color:blue;'>กรุ๊ปทัวร์</span>";break;
default:return "ไม่พบประเภท";break;}}
function status_deposit($type1){switch ($type1) {
case 0:return "<span style='color:blue;'>ยกเลิกแล้ว</span>";break;
case 1:return "<span style='color:red;'>ยังไม่ได้ชำระ</span>";break;
case 2:return "<span style='color:#F39C12;'>รอการยืนยัน</span>";break;
case 3:return "<span style='color:green;'>ชำระแล้ว</span>";break;
default:return "<span style='color:green;'>ชำระแล้ว</span>";break;}}
function status_pay($type1){switch ($type1){
case 1:return "<span style='color:red;'>ยังไม่ได้ชำระ</span>";break;
case 2:return "<span style='color:green;'>ชำระแล้ว</span>";break;
case 3:return "<span style='color:red;'>ยังไม่ได้ชำระ</span>";break;
default:return "ไม่พบประเภท";break;}}
function status_svcost($type1){switch ($type1){
case 0:return "<span style='color:red;'>ยังไม่ได้ชำระ</span>";break;
case 1:return "<span style='color:green;'>ขำระแล้ว</span>";break;
default:return "ไม่พบประเภท";break;}}
function status_receipt($type1){switch ($type1){
case 0:return "<span style='color:red;'>ยังไม่ได้ชำระ</span>";break;
case 1:return "<span style='color:green;'>ชำระแล้ว</span>";break;
default:return "ไม่พบประเภท";break;}}
function dmy($type1) {if($type1!='0000-00-00')return date_format(date_create($type1),"d-m-Y");else return $type1;}
function dmy2($type1) {if($type1!='0000-00-00')return date_format(date_create($type1),"d/m/Y");else return $type1;}
function printdate() {
	$var_date = date("Y-m-d");
	$thai_month_arr=array(
	 "0"=>"",
	 "1"=>"มกราคม",
	 "2"=>"กุมภาพันธ์",
	 "3"=>"มีนาคม",
	 "4"=>"เมษายน",
	 "5"=>"พฤษภาคม",
	 "6"=>"มิถุนายน", 
	 "7"=>"กรกฎาคม",
	 "8"=>"สิงหาคม",
	 "9"=>"กันยายน",
	 "10"=>"ตุลาคม",
	 "11"=>"พฤศจิกายน",
	 "12"=>"ธันวาคม"     
	);
	$var_date2 = strtotime("$var_date");
	$thai_date_return="วันที่พิมพ์ ".date("j ",$var_date2).$thai_month_arr[date("n",$var_date2)]." ค.ศ. ".(date("Y",$var_date2));
	return $thai_date_return;}
function pay_type($type1){switch ($type1){
case 1:return "<span style='color:red;'>เงินสด</span>";break;
case 2:return "<span style='color:#3498DB;'>เงินโอน</span>";break;
case 3:return "<span style='color:#8E44AD;'>บัตรเครเดิต</span>";break;
default:return "ไม่พบประเภท";break;}}
?>