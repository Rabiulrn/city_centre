<?php 
	session_start();
	$pathor_details_id = $_POST['pathor_details_id'];

	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$sucMsg ="";


if(isset($pathor_details_id)){
    
	$id           = trim($_POST['pathor_details_id']);
    $motor_name           = trim($_POST['motor_name']);
    $driver_name           = trim($_POST['driver_name']);
    $motor_vara          = trim($_POST['motor_vara']);
    $unload          = trim($_POST['unload']);
    $car_rent_redeem  = trim($_POST['car_rent_redeem']);
    $information      = trim($_POST['information']);
    // $delear_id      = trim($_POST['delear_id']);
    $delear_id      = trim($_SESSION['dealerIdInput']);
    $sl      = trim($_POST['sl_no']);
    $voucher_no     = trim($_POST['delivery_no']);
    $address        = trim($_POST['address']);
    $motor_number          = trim($_POST['motor_number']);
    $motor_sl    = trim($_POST['motor_sl']);

	// $delivery_date  = trim($_POST['delivery_date']);
	if($_POST['delivery_date'] == ''){
		$delivery_date = $_POST['delivery_date'];
	} else {
		$postDateArr    = explode('-', $_POST['delivery_date']);
		$delivery_date  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
	}
	// $dates          = trim($_POST['dates']);
	if($_POST['dates'] == ''){
		$dates = $_POST['dates'];
	} else {
		$postDateArr2   = explode('-', $_POST['dates']);
		$dates          = $postDateArr2['2'].'-'.$postDateArr2['1'].'-'.$postDateArr2['0'];
	}
	$partculars     = trim($_POST['partculars']);
    $particulars    = trim($_POST['particulars']);
    $debit        = trim($_POST['debit']);
    $ton_kg          = trim($_POST['ton & kg']);
    $length         = trim($_POST['length']);
    $width        = trim($_POST['width']);
    $height     = trim($_POST['height']);
    $shifty     = trim($_POST['shifty']);
    $inchi_minus        = trim($_POST['inchi(-)_minus']);
    $cft_dropped_out    = trim($_POST['cft(-)_dropped_out']);
    $inchi_added    = trim($_POST['inchi(+)_added']);
    $points_dropped_out      = trim($_POST['points(-)_dropped_out']);
    $shift      = trim($_POST['shift']);
    $total_shift      = trim($_POST['total_shift']);
   
    $paras      = trim($_POST['paras']);
    $discount     = trim($_POST['discount']);
    $credit      = trim($_POST['credit']);
    $balance      = trim($_POST['balance']);
    $cemeats_paras      = trim($_POST['cemeats_paras']);
    $ton    = trim($_POST['ton']);
    $total_shifts  = trim($_POST['total_shifts']);
    $tons  = trim($_POST['tons']);
    $bank_name  = trim($_POST['bank_name']);
    $fee  = trim($_POST['fee']);

	// update query likte hobe
	// ========================================
    //  $sql2 = "UPDATE details_balu SET information = '$information'";

	$sql = "UPDATE details_pathor SET motor_name = '$motor_name', driver_name = '$driver_name', dealer_id = '$dealer_id', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$information', sl = '$sl', voucher_no = '$voucher_no', address = '$address',  motor_sl = '$motor_sl', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$particulars', debit = '$debit' WHERE id = '$pathor_details_id'";
    

//    $sql2 = "UPDATE `details_balu` SET `motor_name`='$motor_name',`driver_name`='$driver_name',`motor_vara`= '$motor_vara',`unload`='$unload',`cars_rent_redeem`='$car_rent_redeem',`information`='$information',`sl`='$sl',`voucher_no`='$voucher_no',`address`='$address',`motor_no`='$motor_sl',`motor_sl`='$motor_sl',`delivery_date`='$delivery_date',
//    `dates`='$dates',`partculars`='$particulars',`particulars`='$debit'  WHERE id = '$id'";
//--    ,`debit`=[value-20],`ton & kg`=[value-21],`length`=[value-22],`width`=[value-23],`height`=[value-24],`shifty`=[value-25],`inchi (-)_minus`=[value-26],`cft (-)_dropped out`=[value-27],`inchi (+)_added`=[value-28],`points ( - )_dropped out`=[value-29],`shift`=[value-30],`total_shift`=[value-31],`paras`=[value-32],`discount`=[value-33],`credit`=[value-34],`balance`=[value-35],`cemeats_paras`=[value-36],`ton`=[value-37],`total_shifts`=[value-38],`tons`=[value-39],`bank_name`=[value-40],`fee`=[value-41] WHERE 1";
    
    //  ,  

	if ($db->select($sql) === TRUE) {
		$sucMsg = "Pathor details updated Successfully.";
		echo "Pathor details updated Successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}


}

