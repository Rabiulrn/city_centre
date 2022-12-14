<?php 
	session_start();
	$cement_details_id = $_POST['cement_details_id'];

	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$sucMsg ="";


if(isset($cement_details_id)){
    




	
    // $buyer_id       = trim($_POST['buyer_id']);
    // $type = trim($_POST['type']);
    $motor_name           = trim($_POST['motor_name']);
    $driver_name           = trim($_POST['driver_name']);
    $motor_vara          = trim($_POST['motor_vara']);
    $unload          = trim($_POST['unload']);
    $car_rent_redeem  = trim($_POST['cars_rent_redeem']);
    $information      = trim($_POST['information']);
    // $delear_id      = trim($_POST['delear_id']);
    // $dealer_id      = trim($_SESSION['dealerIdInput']);
    $sl      = trim($_POST['sl_no']);
    $challan_no     = trim($_POST['challan_no']);
    $address        = trim($_POST['address']);
    $motor_no          = trim($_POST['motor_number']);
    $motor_sl    = trim($_POST['motor_sl']);
  
    // $delivery_date  = trim($_POST['delivery_date']);
    if($_POST['challan_date'] == ''){
      $challan_date = $_POST['challan_date'];
    } else {
      $postDateArr    = explode('-', $_POST['challan_date']);
      $challan_date  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
    }
    if($_POST['so_date'] == ''){
      $so_date = $_POST['so_date'];
    } else {
      $postDateArr    = explode('-', $_POST['so_date']);
      $so_date  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
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
    list($data_id, $data_name) = explode(",", $_POST['particulars'], 2);
    $debit        = trim($_POST['debit']);
    $monthly_com       = trim($_POST['monthly_com']);
    $yearly_com        = trim($_POST['yearly_com']);
    $count          = trim($_POST['count']);
    $free  = trim($_POST['free']);
    $count2          = trim($_POST['count2']);
   
    $paras      = trim($_POST['paras']);
    $discount     = trim($_POST['discount']);
    $credit      = trim($_POST['credit']);
    $balance      = trim($_POST['balance']);
    $total_credit = trim($_POST['total_credit']);
    $weight      = trim($_POST['weight']);
   

	// update query likte hobe
	// ========================================
    //  $sql2 = "UPDATE details_balu SET information = '$information'";
  //  $sql = "UPDATE details_balu SET buyer_id = '$buyer_id', motor_name = '$motor_name', driver_name = '$driver_name', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$information', sl = '$sl', voucher_no = '$voucher_no', address = '$address',  motor_sl = '$motor_sl', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$particulars', debit = '$debit',`ton & kg`='$ton_kg',`length`='$length',`width`='$width',`height`='$height',`shifty`='$shifty',`inchi (-)_minus`='$inchi_minus',`cft (-)_dropped out`='$cft_dropped_out',`inchi (+)_added`='$inchi_added',`points ( - )_dropped out`='$points_dropped_out',`shift`='$shift',`total_shift`='$total_shift',`paras`='$paras',`discount`='$discount',`credit`='$credit',`balance`='$balance',`cemeats_paras`='$cemeats_paras',`ton`='$ton',`bank_name`='$bank_name',`fee`='$fee'  WHERE id = '$balu_details_id'";
 // UPDATE `details_cement` SET `id`=[value-1],`buyer_id`=[value-2],`dealer_id`=[value-3],`motor_name`=[value-4],`driver_name`=[value-5],`motor_vara`=[value-6],`unload`=[value-7],`cars_rent_redeem`=[value-8],`information`=[value-9],`sl`=[value-10],`challan_no`=[value-11],`address`=[value-12],`motor_no`=[value-13],`motor_sl`=[value-14],`so_date`=[value-15],`dates`=[value-16],`partculars`=[value-17],`particulars`=[value-18],`debit`=[value-19],`challan_date`=[value-20],`count`=[value-21],`total_credit`=[value-22],`weight`=[value-23],`paras`=[value-24],`discount`=[value-25],`credit`=[value-26],`balance`=[value-27],`fee`=[value-28],`project_name_id`=[value-29] WHERE 1;

    $sql = "UPDATE details_cement SET motor_name = '$motor_name', driver_name = '$driver_name', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$information', sl = '$sl', challan_no = '$challan_no', address = '$address',motor_no = '$motor_no',  motor_sl = '$motor_sl', dates = '$dates',so_date = '$so_date', challan_date = '$dates',  motor_no ='$challan_date',partculars = '$partculars',  debit = '$debit', monthly_com ='$monthly_com',yearly_com ='$yearly_com',count='$count',partculars='$partculars',fee='$free',

`count2`='$count2',`paras`='$paras',`discount`='$discount',`credit`='$credit',`balance`='$balance',`weight`='$weight'  WHERE id = '$cement_details_id'";
    // partculars = '$partculars', particulars = '$particulars', debit = '$debit',`ton & kg`='$ton_kg',`length`='$length',`width`='$width',`height`='$height',`shifty`='$shifty',`inchi (-)_minus`='$inchi_minus',`cft (-)_dropped out`='$cft_dropped_out',`inchi (+)_added`='$inchi_added',`points ( - )_dropped out`='$points_dropped_out',`shift`='$shift',`total_shift`='$total_shift',`ton`='$ton',
    // 
if($particulars != "" || $particulars != "Select..."){
  $sql2 = "UPDATE `details_cement` SET particulars='$data_name',particulars_id='$data_id'";
  $db->select($sql2);
}
   

   
	if ($db->select($sql) === TRUE) {
		$sucMsg = "Cement details updated Successfully.";
		echo "Cement details updated Successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}


}

