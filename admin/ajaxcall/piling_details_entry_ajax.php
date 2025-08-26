<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    $project_name_id = $_SESSION['project_name_id'];
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();

    $dealer_id      = trim($_POST['dealer_id']);
    $sl      = trim($_POST['sl']);
    if($_POST['dates'] == ''){
        $dates = $_POST['dates'];
      } else {
        $postDateArr2   = explode('-', $_POST['dates']);
        $dates          = $postDateArr2['2'].'-'.$postDateArr2['1'].'-'.$postDateArr2['0'];
      }
    $marfot_name     = trim($_POST['marfot_name']);
    $biboron     = trim($_POST['biboron']);
    list($data_id, $data_name) = explode(",", $_POST['particulars'], 2);
    $cap_no       = trim($_POST['cap_no']);
    $bill       = trim($_POST['bill']);
    $address        = trim($_POST['address']);
    // $type = trim($_POST['type']);
    $count           = trim($_POST['piling_count']);
    $feet          = trim($_POST['feet']);
    $paras          = trim($_POST['paras']);
    $piling_bill  = trim($_POST['piling_bill']);
    $money_back          = trim($_POST['money_back']);


// echo $count;
// echo $piling_bill;


    if($dealer_id != 'none'){
    $sql = "INSERT INTO `details_piling`
    (`dealer_id`, `sl`, `cap_no`, `address`, `date`, `marfot_name`, `description`, `particulars`, `particulars_id`, `bill_cash`, `money_back`, `paras`,`piling_bill`, `feet`, `piling_count`, `project_name_id`) 
    VALUES ('$dealer_id', '$sl','$cap_no','$address', '$dates', '$marfot_name', '$biboron', '$data_name', '$data_id', '$bill','$money_back', '$paras', '$piling_bill', '$feet', '$count','$project_name_id')";
    

    $result = $db->insert($sql);
    if ($result) 
    {
        $sucMsg = "New Entry Saved Successfully.";
        $sucMsgPopup = "New Entry Saved Successfully.";
        echo $sucMsg;
    } else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }
  
  
    }
  ?>