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

$dealer_id = $_POST['dealerId1'];
$details_id = $_POST['details_id']; //every dealer gb has different id
$gbvalue	= $_POST['gbvalue'];
$balance	= -1 * $gbvalue;
// echo $dealer_id;
// echo $details_id;
// echo "tttttttttttttttttttttttttt";
$sql = "UPDATE details_cement SET debit = '$gbvalue', balance = '$balance' WHERE id = '$details_id' AND project_name_id = '$project_name_id'";
$sql2 = "INSERT INTO cement_gb_bank_history (id, value,time,dealer_id,project_name_id) 
VALUES ( '','$gbvalue',now(),'$dealer_id','$project_name_id')";
if ($db->update($sql) === TRUE) {
	$sucMsg = "Gb Updated Successfully";

	$sql = "SELECT debit FROM details_cement WHERE id = '$details_id' AND project_name_id = '$project_name_id'";
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

	// $sql="SELECT debit FROM details_cement WHERE id = '$details_id' AND project_name_id = '$project_name_id'";		
	// $gb_read = $db->select($sql);
	// if($gb_read){
	// 	$row= $gb_read->fetch_assoc();
	// }
	// echo $row['debit'];
} else {
	echo "Error: " . $sql . "<br>" . $db->error;
}
