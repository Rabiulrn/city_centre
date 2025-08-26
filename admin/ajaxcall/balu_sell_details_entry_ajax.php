<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:../index.php');
}
$project_name_id = $_SESSION['project_name_id'];
require '../config/config.php';
require '../lib/database.php';
$db = new Database();


$customer_id       = isset($_POST['customer_id']) ? trim($_POST['customer_id']) : '';
$motor_name        = isset($_POST['motor_name']) ? trim($_POST['motor_name']) : '';
$driver_name       = isset($_POST['driver_name']) ? trim($_POST['driver_name']) : '';
$motor_vara        = isset($_POST['motor_vara']) ? trim($_POST['motor_vara']) : '';
$unload            = isset($_POST['unload']) ? trim($_POST['unload']) : '';
$car_rent_redeem   = isset($_POST['car_rent_redeem']) ? trim($_POST['car_rent_redeem']) : '';
$information       = isset($_POST['information']) ? trim($_POST['information']) : '';
// $delear_id      = trim($_POST['delear_id']);
$dealer_id   = isset($_SESSION['dealerIdInput']) ? trim($_SESSION['dealerIdInput']) : '';
$sl          = isset($_POST['sl_no']) ? trim($_POST['sl_no']) : '';
$voucher_no  = isset($_POST['delivery_no']) ? trim($_POST['delivery_no']) : '';
$address     = isset($_POST['address']) ? trim($_POST['address']) : '';
$motor_no    = isset($_POST['motor']) ? trim($_POST['motor']) : '';
$motor_sl    = isset($_POST['motor_no']) ? trim($_POST['motor_no']) : '';

// $delivery_date  = trim($_POST['delivery_date']);
if ($_POST['delivery_date'] == '') {
  $delivery_date = $_POST['delivery_date'];
} else {
  $postDateArr    = explode('-', $_POST['delivery_date']);
  $delivery_date  = $postDateArr['2'] . '-' . $postDateArr['1'] . '-' . $postDateArr['0'];
}
// $dates          = trim($_POST['dates']);
if ($_POST['dates'] == '') {
  $dates = $_POST['dates'];
} else {
  $postDateArr2   = explode('-', $_POST['dates']);
  $dates          = $postDateArr2['2'] . '-' . $postDateArr2['1'] . '-' . $postDateArr2['0'];
}
$partculars          = isset($_POST['partculars']) ? trim($_POST['partculars']) : '';
$particulars         = isset($_POST['particulars']) ? trim($_POST['particulars']) : '';
$debit               = isset($_POST['debit']) ? trim($_POST['debit']) : '';
$ton_kg              = isset($_POST['ton_kg']) ? trim($_POST['ton_kg']) : '';
$length              = isset($_POST['length']) ? trim($_POST['length']) : '';
$width               = isset($_POST['width']) ? trim($_POST['width']) : '';
$height              = isset($_POST['height']) ? trim($_POST['height']) : '';
$shifty              = isset($_POST['shifty']) ? trim($_POST['shifty']) : '';
$inchi_minus         = isset($_POST['inchi(-)_minus']) ? trim($_POST['inchi(-)_minus']) : '';
$cft_dropped_out     = isset($_POST['cft(-)_dropped_out']) ? trim($_POST['cft(-)_dropped_out']) : '';
$inchi_added         = isset($_POST['inchi(+)_added']) ? trim($_POST['inchi(+)_added']) : '';
$points_dropped_out  = isset($_POST['points(-)_dropped_out']) ? trim($_POST['points(-)_dropped_out']) : '';
$shift               = isset($_POST['shift']) ? trim($_POST['shift']) : '';
$total_shift         = isset($_POST['total_shift']) ? trim($_POST['total_shift']) : '';
$paras               = isset($_POST['paras']) ? trim($_POST['paras']) : '';
$discount            = isset($_POST['discount']) ? trim($_POST['discount']) : '';
$credit              = isset($_POST['credit']) ? trim($_POST['credit']) : '';
$balance             = isset($_POST['balance']) ? trim($_POST['balance']) : '';
$cemeats_paras       = isset($_POST['cemeats_paras']) ? trim($_POST['cemeats_paras']) : '';
$ton                 = isset($_POST['ton']) ? trim($_POST['ton']) : '';
$total_shifts        = isset($_POST['total_shifts']) ? trim($_POST['total_shifts']) : '';
$tons                = isset($_POST['tons']) ? trim($_POST['tons']) : '';
$bank_name           = isset($_POST['bank']) ? trim($_POST['bank']) : '';
$fee                 = isset($_POST['fee']) ? trim($_POST['fee']) : '';



if ($customer_id != 'none' ) {
  // $sql = "INSERT INTO details_balu (motor_name, driver_name, motor_vara, unload, cars_rent_redeem, information, buyer_id, dealer_id, voucher_no, address, motor_no, motor_sl, delivery_date, dates, partculars, debit, ton & kg, length, width , height, inchi(-)_minus, credit, cft(-)_dropped_out, inchi(+)_added, points(-)_dropped_out, shift, total_shift, paras, discount, credit, cemeats_paras, ton, total_shifts, tons, bank_name, fee, project_name_id) 
  // VALUES('$motor_name', '$driver_name', '$motor_vara', '$unload', '$car_rent_redeem', '$information', '$buyer_id', '$delear_id', '$voucher_no', '$address', '$motor_no', '$motor_sl', '$delivery_date', '$dates', '$partculars', '$particulars', '$debit', '$ton_kg', '$length', '$width', '$height ','$inchi_minus','$cft_dropped_out', '$inchi_added', '$points_dropped_out', '$shift', '$total_shift', '$paras', '$discount', '$credit', '$cemeats_paras', '$ton', '$total_shifts', '$tons', '$bank_name', '$fee', '$project_name_id')";
  // $sql_update = "UPDATE stocks_balu SET `ton` = `ton` - '$ton' WHERE partculars ='$partculars' AND particulars ='$particulars' AND `ton` - '$ton' >= 0  ORDER BY ton DESC LIMIT 1";
  // //AND $ton <= `ton`

  // $result2 = $db->select($sql_update);
  // // print_r($result2);
  // if ($result2) {
    // print_r($sql_update);
    // $sucMsg = "stocks updated Successfully.";
    // echo "stocks updated  Successfully.";

    $sql = "INSERT INTO `details_sell_balu`
           (`customer_id`, `dealer_id`, `motor_name`,`driver_name`, `motor_vara`, `unload`, `cars_rent_redeem`, `information`, `sl`, `voucher_no`, `address`, `motor_no`, `motor_sl`, `delivery_date`, `dates`, `partculars`, `particulars`, `debit`, `ton & kg`, `length`, `width`, `height`, `shifty`, `inchi (-)_minus`, `cft (-)_dropped Out`, `inchi (+)_added`, `points ( - )_dropped out`, `shift`, `total_shift`, `paras`, `discount`, `credit`,`balance`, `cemeats_paras`, `ton`, `total_shifts`, `tons`, `bank_name`, `fee`,`project_name_id`) 
    VALUES ('$customer_id', '$dealer_id', '$motor_name', '$driver_name', '$motor_vara', '$unload', '$car_rent_redeem', '$information','$sl','$voucher_no', '$address', '$motor_no', '$motor_sl', '$delivery_date', '$dates', '$partculars', '$particulars', '$debit', '$ton_kg', '$length', '$width', '$height ', '$shifty', '$inchi_minus','$cft_dropped_out', '$inchi_added', '$points_dropped_out', '$shift', '$total_shift', '$paras', '$discount', '$credit','$balance', '$cemeats_paras', '$ton', '$total_shifts', '$tons', '$bank_name', '$fee','$project_name_id')";




    $result = $db->insert($sql);
    if ($result) {
      $sucMsg = "New Entry Saved Successfully.";
      $sucMsgPopup = "New Entry Saved Successfully.";
      echo $sucMsg;
    } else {
      echo "Error: " . $sql . "<br>" . $db->error;
    }
  // } else {
  //   echo " marfot and particular not matched ";
  // }
}
?>