<?php
require '../config/config.php';
require '../lib/database.php';
$db = new Database();

$usernamePost = $_POST['username'];
// echo $username . "kkkkkkkkkkkkkkkkkk";
if ($usernamePost) {
  $sql = "SELECT * FROM login WHERE username = '$usernamePost'";
  $result = $db->select($sql);
  if ($result) {
    $row = $result->fetch_assoc();
    // var_dump($row);
    //Manzu raj_kajerhisab get from login table
    $fname    = $row['first_name'];
    $lname     = $row['last_name'];
    $username = $row['username'];
    $usertype  = $row['usertype'];
    $mobile    = $row['mobile'];

    $doinik_hisab       = $row['doinik_hisab'];
    $protidiner_hisab  = $row['protidiner_hisab'];
    $modify_data       = $row['modify_data'];
    $joma_khat         = $row['joma_khat'];
    $khoros_khat       = $row['khoros_khat'];
    $khoros_khat_entry = $row['khoros_khat_entry'];
    $nije_pabo         = $row['nije_pabo'];
    $paonader          = $row['paonader'];
    $report            = $row['report'];
    $agrim_hisab       = $row['agrim_hisab'];
    $cash_calculator   = $row['cash_calculator'];
    $raj_kajer_all_hisab   =  $row['raj_kajer_all_hisab'];
    $electric_kroy_bikroy = $row['electric_kroy_bikroy'];
    $rod_hisab         = $row['rod_hisab'];
    $rod_kroy_hisab    = $row['rod_kroy_hisab'];
    $rod_bikroy_hisab  = $row['rod_bikroy_hisab'];
    $rod_category      = $row['rod_category'];
    $rod_dealer        = $row['rod_dealer'];
    $rod_customer      = $row['rod_customer'];
    $rod_buyer         = $row['rod_buyer'];
    $rod_report        = $row['rod_report'];
    $create_user       = $row['create_user'];

    $balu_hisab         = $row['balu_hisab'];
    $balu_kroy_hisab    = $row['balu_kroy_hisab'];
    $balu_bikroy_hisab  = $row['balu_bikroy_hisab'];
    $balu_category      = $row['balu_category'];
    $balu_dealer        = $row['balu_dealer'];
    $balu_customer      = $row['balu_customer'];
    $balu_buyer         = $row['balu_buyer'];
    $balu_report        = $row['balu_report'];
    $balu_stocks        = $row['balu_stocks'];

    $pathor_hisab         = $row['pathor_hisab'];
    $pathor_kroy_hisab    = $row['pathor_kroy_hisab'];
    $pathor_bikroy_hisab  = $row['pathor_bikroy_hisab'];
    $pathor_category      = $row['pathor_category'];
    $pathor_dealer        = $row['pathor_dealer'];
    $pathor_customer      = $row['pathor_customer'];
    $pathor_buyer         = $row['pathor_buyer'];
    // $balu_report        = $row['balu_report'];
    $pathor_stocks       = $row['pathor_stocks'];

    $cement_hisab         = $row['cement_hisab'];
    $cement_kroy_hisab    = $row['cement_kroy_hisab'];
    $cement_bikroy_hisab  = $row['cement_bikroy_hisab'];
    $cement_category      = $row['cement_category'];
    $cement_dealer        = $row['cement_dealer'];
    $cement_customer      = $row['cement_customer'];
    $cement_buyer         = $row['cement_buyer'];
    // $balu_report        = $row['balu_report'];
    $cement_stocks       = $row['cement_stocks'];
    $cement_report       = $row['cement_report'];


    $edit_data    = $row['edit_data'];
    $delete_data  = $row['delete_data'];

    $project_name_id = $row['project_name_id'];
    $verification     = $row['verification'];
  }
}



?>




<div class="form-control">
  <label><span class="frmLbl">Name: </span><?php echo ucfirst($fname) . " " . ucfirst($lname); ?></label>
</div>
<div class="form-control">
  <label><span class="frmLbl">Mobile: </span><?php echo $mobile; ?></label>
</div>
<div class="form-control">
  <label><span class="frmLbl">User Type: </span><?php echo ucfirst($usertype); ?></label>
</div>
<div class="form-control">
  <label><span class="frmLbl">Email Verified: </span><?php echo ucfirst($verification); ?></label>
</div>



<div class="form-control" style="height: unset;" id="project_con">
  <label style="margin: 0px;">
    <span class="frmLbl">Project Name:
      <div class="" style="display: inline-block;">
        <?php
        $hsql = "SELECT id, heading FROM project_heading";
        $h_result = $db->select($hsql);
        // var_dump($result);
        $datas = array();
        $sizes = 0;
        if ($result) {
          while ($rows = $h_result->fetch_assoc()) {
            $datas[$sizes]['id']          = $rows['id'];
            $datas[$sizes]['heading']     = $rows['heading'];
            $sizes++;
          }
        }
        // echo "<pre>";
        // var_dump($datas);
        ?>
        <select id="p_heading_list" name="p_heading_list[]" multiple="multiple" style="padding: 2px; display: inline-block;">
          <!-- <option value="none">Select one...</option> -->
          <?php
          if ($datas) {
            // if($project_name_id == 0){
            // echo '<option value="0">None...</option>';
            // }
            foreach ($datas as $row) {
              $p_id = $row['id'];
              $project_heading = $row['heading'];

              $sel = '';
              $categories = '';
              $pids = explode(",", $project_name_id);
              foreach ($pids as $pid) {
                if ($p_id == trim($pid)) {
                  $sel = 'selected';
                }
              }
              echo '<option value = "' . $p_id . '" ' . $sel . '>' . $project_heading . '</option>';
            }
          }
          ?>
        </select>
        <?php

        ?>
      </div>
    </span></label>
</div>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Permissions</title>

<style>
* { box-sizing: border-box; }
.pw { padding: 10px 0; font-family: inherit; }
.pw-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
.pw-title { font-size: 17px; font-weight: 600; color: #222; }
.sel-btn { font-size: 13px; color: #185FA5; background: transparent; border: 1px solid #c0d4ec; border-radius: 6px; padding: 5px 14px; cursor: pointer; }
.pw-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
.card { background: #fff; border: 1px solid #e4e4e4; border-radius: 10px; overflow: hidden; }
.card-head { display: flex; align-items: center; justify-content: space-between; padding: 11px 16px; background: #f7f8fa; border-bottom: 1px solid #ececec; }
.card-head-left { display: flex; align-items: center; gap: 9px; }
.card-dot { width: 8px; height: 8px; border-radius: 50%; background: #185FA5; flex-shrink: 0; }
.card-title { font-size: 13px; font-weight: 600; color: #222; }
.card-badge { font-size: 11px; color: #0C447C; background: #E6F1FB; border-radius: 20px; padding: 2px 9px; }
.card-body { padding: 8px 16px 12px; }
.check-row { display: flex; align-items: center; gap: 9px; padding: 6px 0; border-bottom: 1px solid #f2f2f2; cursor: pointer; }
.check-row:last-child { border-bottom: none; }
.check-row input[type=checkbox] { accent-color: #185FA5; width: 14px; height: 14px; cursor: pointer; flex-shrink: 0; }
.check-row span { font-size: 13.5px; color: #333; line-height: 1.4; }
.save-wrap { margin-top: 20px; }
.save-btn-custom { width: 100%; padding: 11px; background: #185FA5; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; }
.save-btn-custom:hover { background: #0C447C; }
</style>

<div class="pw">
  <div class="pw-header">
    <span class="pw-title" style="margin-top: 10px;">Allowable Pages</span>
    <!-- <button class="sel-btn" type="button" onclick="toggleAllPerms(this)">Select all</button> -->
  </div>

  <div class="pw-grid">

    <!-- দৈনিক হিসাব -->
    <div class="card">
      <div class="card-head">
        <div class="card-head-left"><div class="card-dot"></div><span class="card-title">দৈনিক হিসাব</span></div>
        <span class="card-badge">12 items</span>
      </div>
      <div class="card-body">
        <label class="check-row">
          <input type="checkbox" name="protidiner_hisab" id="protidiner_hisab" onchange="checkUncheck(this)" value="<?php echo $protidiner_hisab; ?>" <?php echo ($protidiner_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>প্রতিদিনের হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="modify_data" id="modify_data" onchange="checkUncheck(this)" value="<?php echo $modify_data; ?>" <?php echo ($modify_data == 'yes' ? 'checked' : ''); ?>>
          <span>মডিফাই ডাটা</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="joma_khat" id="joma_khat" onchange="checkUncheck(this)" value="<?php echo $joma_khat; ?>" <?php echo ($joma_khat == 'yes' ? 'checked' : ''); ?>>
          <span>জমা খাত এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="khoros_khat" id="khoros_khat" onchange="checkUncheck(this)" value="<?php echo $khoros_khat; ?>" <?php echo ($khoros_khat == 'yes' ? 'checked' : ''); ?>>
          <span>খরচ খাতের হেডার</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="khoros_khat_entry" id="khoros_khat_entry" onchange="checkUncheck(this)" value="<?php echo $khoros_khat_entry; ?>" <?php echo ($khoros_khat_entry == 'yes' ? 'checked' : ''); ?>>
          <span>খরচ খাত এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="nije_pabo" id="nije_pabo" onchange="checkUncheck(this)" value="<?php echo $nije_pabo; ?>" <?php echo ($nije_pabo == 'yes' ? 'checked' : ''); ?>>
          <span>নিজে পাবো এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="paonader" id="paonader" onchange="checkUncheck(this)" value="<?php echo $paonader; ?>" <?php echo ($paonader == 'yes' ? 'checked' : ''); ?>>
          <span>পাওনাদার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="report" id="report" onchange="checkUncheck(this)" value="<?php echo $report; ?>" <?php echo ($report == 'yes' ? 'checked' : ''); ?>>
          <span>রিপোর্ট</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="agrim_hisab" id="agrim_hisab" onchange="checkUncheck(this)" value="<?php echo $agrim_hisab; ?>" <?php echo ($agrim_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>অগ্রিম হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="cash_calculator" id="cash_calculator" onchange="checkUncheck(this)" value="<?php echo $cash_calculator; ?>" <?php echo ($cash_calculator == 'yes' ? 'checked' : ''); ?>>
          <span>ক্যাশ ক্যালকুলেটর</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="raj_kajer_all_hisab" id="raj_kajer_all_hisab" onchange="checkUncheck(this)" value="<?php echo $raj_kajer_all_hisab; ?>" <?php echo ($raj_kajer_all_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>রাজ কাজের হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="electric_kroy_bikroy" id="electric_kroy_bikroy" onchange="checkUncheck(this)" value="<?php echo $electric_kroy_bikroy; ?>" <?php echo ($electric_kroy_bikroy == 'yes' ? 'checked' : ''); ?>>
          <span>ইলেকট্রিক মালামাল ক্রয় হিসাব</span>
        </label>
      </div>
    </div>

    <!-- পাথর হিসাব -->
    <div class="card">
      <div class="card-head">
        <div class="card-head-left"><div class="card-dot"></div><span class="card-title">পাথর হিসাব</span></div>
        <span class="card-badge">7 items</span>
      </div>
      <div class="card-body">
        <label class="check-row">
          <input type="checkbox" name="pathor_kroy_hisab" id="pathor_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $pathor_kroy_hisab; ?>" <?php echo ($pathor_kroy_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>ক্রয় হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="pathor_bikroy_hisab" id="pathor_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $pathor_bikroy_hisab; ?>" <?php echo ($pathor_bikroy_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>বিক্রয় হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="pathor_category" id="pathor_category" onchange="checkUncheck(this)" value="<?php echo $pathor_category; ?>" <?php echo ($pathor_category == 'yes' ? 'checked' : ''); ?>>
          <span>ক্যাটাগরি এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="pathor_dealer" id="pathor_dealer" onchange="checkUncheck(this)" value="<?php echo $pathor_dealer; ?>" <?php echo ($pathor_dealer == 'yes' ? 'checked' : ''); ?>>
          <span>ডিলার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="pathor_customer" id="pathor_customer" onchange="checkUncheck(this)" value="<?php echo $pathor_customer; ?>" <?php echo ($pathor_customer == 'yes' ? 'checked' : ''); ?>>
          <span>কাস্টমার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="pathor_buyer" id="pathor_buyer" onchange="checkUncheck(this)" value="<?php echo $pathor_buyer; ?>" <?php echo ($pathor_buyer == 'yes' ? 'checked' : ''); ?>>
          <span>বায়ার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="pathor_stocks" id="pathor_stocks" onchange="checkUncheck(this)" value="<?php echo $pathor_stocks; ?>" <?php echo ($pathor_stocks == 'yes' ? 'checked' : ''); ?>>
          <span>স্টক তথ্য</span>
        </label>
        <!-- <label class="check-row">
          <input type="checkbox" name="pathor_report" id="pathor_report" onchange="checkUncheck(this)" value="<?php echo $pathor_report; ?>" <?php echo ($pathor_report == 'yes' ? 'checked' : ''); ?>>
          <span>রিপোর্ট</span>
        </label> -->
      </div>
    </div>

    <!-- সিমেন্ট হিসাব -->
    <div class="card">
      <div class="card-head">
        <div class="card-head-left"><div class="card-dot"></div><span class="card-title">সিমেন্ট হিসাব</span></div>
        <span class="card-badge">7 items</span>
      </div>
      <div class="card-body">
        <label class="check-row">
          <input type="checkbox" name="cement_kroy_hisab" id="cement_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $cement_kroy_hisab; ?>" <?php echo ($cement_kroy_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>ক্রয় হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="cement_bikroy_hisab" id="cement_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $cement_bikroy_hisab; ?>" <?php echo ($cement_bikroy_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>বিক্রয় হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="cement_category" id="cement_category" onchange="checkUncheck(this)" value="<?php echo $cement_category; ?>" <?php echo ($cement_category == 'yes' ? 'checked' : ''); ?>>
          <span>ক্যাটাগরি এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="cement_dealer" id="cement_dealer" onchange="checkUncheck(this)" value="<?php echo $cement_dealer; ?>" <?php echo ($cement_dealer == 'yes' ? 'checked' : ''); ?>>
          <span>ডিলার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="cement_customer" id="cement_customer" onchange="checkUncheck(this)" value="<?php echo $cement_customer; ?>" <?php echo ($cement_customer == 'yes' ? 'checked' : ''); ?>>
          <span>কাস্টমার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="cement_buyer" id="cement_buyer" onchange="checkUncheck(this)" value="<?php echo $cement_buyer; ?>" <?php echo ($cement_buyer == 'yes' ? 'checked' : ''); ?>>
          <span>বায়ার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="cement_report" id="cement_report" onchange="checkUncheck(this)" value="<?php echo $cement_report; ?>" <?php echo ($cement_report == 'yes' ? 'checked' : ''); ?>>
          <span>রিপোর্ট</span>
        </label>
      </div>
    </div>

    <!-- রড হিসাব -->
    <div class="card">
      <div class="card-head">
        <div class="card-head-left"><div class="card-dot"></div><span class="card-title">রড হিসাব</span></div>
        <span class="card-badge">7 items</span>
      </div>
      <div class="card-body">
        <label class="check-row">
          <input type="checkbox" name="rod_kroy_hisab" id="rod_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $rod_kroy_hisab; ?>" <?php echo ($rod_kroy_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>ক্রয় হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="rod_bikroy_hisab" id="rod_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $rod_bikroy_hisab; ?>" <?php echo ($rod_bikroy_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>বিক্রয় হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="rod_category" id="rod_category" onchange="checkUncheck(this)" value="<?php echo $rod_category; ?>" <?php echo ($rod_category == 'yes' ? 'checked' : ''); ?>>
          <span>ক্যাটাগরি এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="rod_dealer" id="rod_dealer" onchange="checkUncheck(this)" value="<?php echo $rod_dealer; ?>" <?php echo ($rod_dealer == 'yes' ? 'checked' : ''); ?>>
          <span>ডিলার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="rod_customer" id="rod_customer" onchange="checkUncheck(this)" value="<?php echo $rod_customer; ?>" <?php echo ($rod_customer == 'yes' ? 'checked' : ''); ?>>
          <span>কাস্টমার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="rod_buyer" id="rod_buyer" onchange="checkUncheck(this)" value="<?php echo $rod_buyer; ?>" <?php echo ($rod_buyer == 'yes' ? 'checked' : ''); ?>>
          <span>বায়ার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="rod_report" id="rod_report" onchange="checkUncheck(this)" value="<?php echo $rod_report; ?>" <?php echo ($rod_report == 'yes' ? 'checked' : ''); ?>>
          <span>রিপোর্ট</span>
        </label>
      </div>
    </div>

    <!-- বালু হিসাব -->
    <div class="card">
      <div class="card-head">
        <div class="card-head-left"><div class="card-dot"></div><span class="card-title">বালু হিসাব</span></div>
        <span class="card-badge">8 items</span>
      </div>
      <div class="card-body">
        <label class="check-row">
          <input type="checkbox" name="balu_kroy_hisab" id="balu_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $balu_kroy_hisab; ?>" <?php echo ($balu_kroy_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>ক্রয় হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="balu_bikroy_hisab" id="balu_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $balu_bikroy_hisab; ?>" <?php echo ($balu_bikroy_hisab == 'yes' ? 'checked' : ''); ?>>
          <span>বিক্রয় হিসাব</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="balu_category" id="balu_category" onchange="checkUncheck(this)" value="<?php echo $balu_category; ?>" <?php echo ($balu_category == 'yes' ? 'checked' : ''); ?>>
          <span>ক্যাটাগরি এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="balu_dealer" id="balu_dealer" onchange="checkUncheck(this)" value="<?php echo $balu_dealer; ?>" <?php echo ($balu_dealer == 'yes' ? 'checked' : ''); ?>>
          <span>ডিলার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="balu_customer" id="balu_customer" onchange="checkUncheck(this)" value="<?php echo $balu_customer; ?>" <?php echo ($balu_customer == 'yes' ? 'checked' : ''); ?>>
          <span>কাস্টমার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="balu_buyer" id="balu_buyer" onchange="checkUncheck(this)" value="<?php echo $balu_buyer; ?>" <?php echo ($balu_buyer == 'yes' ? 'checked' : ''); ?>>
          <span>বায়ার এন্ট্রি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="balu_report" id="balu_report" onchange="checkUncheck(this)" value="<?php echo $balu_report; ?>" <?php echo ($balu_report == 'yes' ? 'checked' : ''); ?>>
          <span>রিপোর্ট</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="balu_stocks" id="balu_stocks" onchange="checkUncheck(this)" value="<?php echo $balu_stocks; ?>" <?php echo ($balu_stocks == 'yes' ? 'checked' : ''); ?>>
          <span>স্টক তথ্য</span>
        </label>
      </div>
    </div>

    <!-- অন্যান্য -->
    <div class="card">
      <div class="card-head">
        <div class="card-head-left"><div class="card-dot"></div><span class="card-title">অন্যান্য</span></div>
        <span class="card-badge">3 items</span>
      </div>
      <div class="card-body">
        <label class="check-row">
          <input type="checkbox" name="create_user" id="create_user" onchange="checkUncheck(this)" value="<?php echo $create_user; ?>" <?php echo ($create_user == 'yes' ? 'checked' : ''); ?>>
          <span>Create User</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="edit_data" id="edit_data" onchange="checkUncheck(this)" value="<?php echo $edit_data; ?>" <?php echo ($edit_data == 'yes' ? 'checked' : ''); ?>>
          <span>আপডেট অনুমতি</span>
        </label>
        <label class="check-row">
          <input type="checkbox" name="delete_data" id="delete_data" onchange="checkUncheck(this)" value="<?php echo $delete_data; ?>" <?php echo ($delete_data == 'yes' ? 'checked' : ''); ?>>
          <span>ডিলেট অনুমতি</span>
        </label>
      </div>
    </div>

  </div>

  <div style="margin: 20px 0 0; float: left; width: 100%;">
    <input type="button" class="btn btn-primary btn-block save-btn-custom" name="sumbit" id="submitBtnId" value="Save" />
  </div>
</div>

<script>
function toggleAllPerms(btn) {
  const all = document.querySelectorAll('.pw input[type=checkbox]');
  const anyUnchecked = [...all].some(c => !c.checked);
  all.forEach(c => c.checked = anyUnchecked);
  btn.textContent = anyUnchecked ? 'Deselect all' : 'Select all';
}
</script>
</body>
</html>