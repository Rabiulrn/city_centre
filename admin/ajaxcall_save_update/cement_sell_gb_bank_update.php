<?php
session_start();
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
}
$project_name_id = $_SESSION['project_name_id'];
require '../config/config.php';
require '../lib/database.php';
$db = new Database();

$sucMsg 	= '';

$customer_id = $_POST['customerId1'];
$details_id = $_POST['details_id']; //every dealer gb has different id
$gbvalue	= $_POST['gbvalue'];
$balance	= -1 * $gbvalue;
// echo $dealer_id;
// echo $details_id;
// echo "tttttttttttttttttttttttttt";
$sql = "UPDATE details_sell_cement SET debit = '$gbvalue',debit2 = '$gbvalue', balance = '$balance' WHERE id = '$details_id' AND project_name_id = '$project_name_id'";
$sql2 = "INSERT INTO cement_sell_gb_bank_history (id, value,time,customer_id,project_name_id) 
VALUES ( '','$gbvalue',now(),'$customer_id','$project_name_id')";
if ($db->update($sql) === TRUE) {
	$sucMsg = "Gb Updated Successfully";

	$sql = "SELECT debit FROM details_sell_cement WHERE id = '$details_id' AND project_name_id = '$project_name_id'";
	$gb_read = $db->select($sql);
	if ($gb_read) {
		$row = $gb_read->fetch_assoc();
	}
	echo $row['debit'];
} else {
	echo "Error: " . $sql . "<br>" . $db->error;
}
if ($db->update($sql2) === TRUE) {
	$sucMsg = "";

	// $sql="SELECT debit FROM details_sell_cement WHERE id = '$details_id' AND project_name_id = '$project_name_id'";		
	// $gb_read = $db->select($sql);
	// if($gb_read){
	// 	$row= $gb_read->fetch_assoc();
	// }
	// echo $row['debit'];
} else {
	echo "Error: " . $sql . "<br>" . $db->error;
}



