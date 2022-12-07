<?php 
	session_start();
	$cement_details_id = $_POST['cement_details_id'];

	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$sucMsg ="";


if(isset($cement_details_id)){
    
    
$customer_id       = trim($_POST['customer_id']);
$information      = trim($_POST['information']);
$voucher_no     = trim($_POST['voucher_no']);
$address        = trim($_POST['address']);
if ($_POST['dates'] == '') {
  $dates = $_POST['dates'];
} else {
  $postDateArr2   = explode('-', $_POST['dates']);
  $dates          = $postDateArr2['2'] . '-' . $postDateArr2['1'] . '-' . $postDateArr2['0'];
}
$partculars     = trim($_POST['partculars']);
$particulars    = trim($_POST['particulars']);







$cash_rest          = trim($_POST['cash_rest']);
$oil_amount           = trim($_POST['oil_amount']);




$oil_paras          = trim($_POST['oil_paras']);
$bag_amount         = trim($_POST['bag_amount']);
$paras  = trim($_POST['paras']);



$paras      = trim($_POST['paras']);
$discount     = trim($_POST['discount']);
$credit      = trim($_POST['credit']);
$balance      = trim($_POST['balance']);
$total_credit = trim($_POST['total_credit']);
$weight      = trim($_POST['weight']);

	// update query is written here
	// ========================================
  // var customer_id = $(element).closest('tr').find('td:eq(0)').text();
  // // var dlar_id         = $(element).closest('tr').find('td:eq(1)').text();
  // var information = $(element).closest('tr').find('td:eq(2)').text();
  // var voucher_no = $(element).closest('tr').find('td:eq(3)').text();
  // var address = $(element).closest('tr').find('td:eq(4)').text();
  // var date = $(element).closest('tr').find('td:eq(5)').text();
  // var marfot_name = $(element).closest('tr').find('td:eq(6)').text();
  // var particulars = $(element).closest('tr').find('td:eq(7)').text();
  // var cash_rest = $(element).closest('tr').find('td:eq(8)').text();
  // var oil_amount = $(element).closest('tr').find('td:eq(9)').text();
  // var oil_paras = $(element).closest('tr').find('td:eq(10)').text();
  // var bag_amount = $(element).closest('tr').find('td:eq(11)').text();
  // var paras = $(element).closest('tr').find('td:eq(12)').text();
  // var discount = $(element).closest('tr').find('td:eq(13)').text();
  // var credit = $(element).closest('tr').find('td:eq(14)').text();
  // var cash = $(element).closest('tr').find('td:eq(15)').text();

  $sql ="UPDATE `details_sell_cement` SET `information`='$information',`challan_no`='$voucher_no',
  `address`='$address',`dates`='$dates',`partculars`='$partculars ',`particulars`='$particulars',
  `sl`='$cash_rest',`oil_free`='$oil_amount',`oil_sell`='$oil_paras',
  `count`='$bag_amount',
  `paras`='$paras',`discount`='$discount',`credit`='$credit',`balance`='$balance'  WHERE id = '$cement_details_id'";
// 	$sql = "UPDATE details_sell_cement SET motor_name = '$motor_name', driver_name = '$driver_name', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$information', sl = '$sl', voucher_no = '$voucher_no', address = '$address', motor_sl = '$motor_sl', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$particulars', debit = '$debit' WHERE id = '$cement_details_id'";
    // -- , ton & kg = '$ton_kg', length = '$length', width = '$width', height = '$height', shifty = '$shifty', inchi (-)_minus = '$inchi_minus', cft_ (-)dropperd_out = '$cft_dropperd_out', inchi (+)_added = '$inchi_added', points ( - )_dropped_out = '$points_dropped_out', shift = '$shift', total_shift = '$total_shift', paras = '$paras', discount = '$discount', balance = '$balance', discount ='$discount', credit ='$credit', balance = '$balance', cemeats_paras= '$cemeats_paras', ton = '$ton', total_shifts = '$total_shifts' tons = '$tons', bank_name = '$bank_name', fee = '$fee' WHERE id = '$cement_details_id'";

	if ($db->select($sql) === TRUE) {
		$sucMsg = "cement details updated Successfully.";
		echo "cement details updated Successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}

    
  //   if ($partculars != '') {
  //       $sql_update = "UPDATE stocks_cement SET partculars ='$partculars' ";

  //       $result2 = $db->select($sql_update);
  //       // print_r($result2);
  //       if ($result2) {
  //         // print_r($sql_update);
  //         // $sucMsg = "stocks updated Successfully.";
  //         echo "stocks updated  Successfully.";
  //       } else {
  //         echo " marfot and particular not matched ";
  //       }
	// }

}


