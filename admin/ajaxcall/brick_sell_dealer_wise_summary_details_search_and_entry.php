<?php


session_start();
require '../config/config.php';
require '../lib/database.php';
$db = new Database();

$dealerId  = $_POST['dealerId'];             //dealer is thakleo customer hishebe chaliye deoya.
$_SESSION['dealerIdInput'] = $_POST['dealerId'];
// echo $dealerId;
$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];



$sucMsg = "";


$total1_weight = 0;
$sql = "SELECT SUM(count) as weight FROM details_sell_brick WHERE particulars AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $total1_weight = $row['weight'];
        if(is_null($total1_weight)){
            $total1_weight = 0;
        }
    }
} else{
    $total1_weight = 0;
}




  
// Start total total_motor
$sql = "SELECT COUNT(motor_sl) as motor FROM details_sell_brick WHERE dealer_id = '$dealerId'AND motor_sl > 0 AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_motor = $row['motor'];
    if (is_null($total_motor)) {
      $total_motor = 0;
    }
  }
} else {
  $total_motor = 0;
}

//Start Gari vara
$sql = "SELECT SUM(motor_vara) as motor_vara FROM details_sell_brick WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $motor_vara = $row['motor_vara'];
    if (is_null($motor_vara)) {
      $motor_vara = 0;
    }
  }
} else {
  $motor_vara = 0;
}
//End Gari vara

//Start khalas/Unload
$sql = "SELECT SUM(unload) as unload FROM details_sell_brick WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $unload = $row['unload'];
    if (is_null($unload)) {
      $unload = 0;
    }
  }
} else {
  $unload = 0;
}
$motor_vara_and_unload = $motor_vara + $unload;
//End khalas/Unload

// // Start total total_motor
// Start total total_motor
$sql = "SELECT COUNT(motor_sl) as motor FROM details_sell_brick WHERE dealer_id = '$dealerId'AND motor_sl > 0 AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_motor = $row['motor'];
    if (is_null($total_motor)) {
      $total_motor = 0;
    }
  }
} else {
  $total_motor = 0;
}

// // End total total_motor

// //Start GB Bank Ganti



$sql = "SELECT SUM(count) as count_c FROM details_sell_brick WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_w = $row['count_c'];
    if (is_null($total_w)) {
      $total_w = 0;
    }
  }
} else {
  $total_w = 0;
}
// $total_ton = $total_shift / 23.5;
// // End total total_kg

// Start total total_credit/mot_mul
$sql = "SELECT SUM(credit) as credit FROM details_sell_brick WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_credit = $row['credit'];
    if (is_null($total_credit)) {
      $total_credit = 0;
    }
  }
} else {
  $total_credit = 0;
}
// End total total_credit/mot_mul

// Start total total_debit/joma
$sql = "SELECT SUM(debit) as debit FROM details_sell_brick WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_debit = $row['debit'];
    if (is_null($total_debit)) {
      $total_debit = 0;
    }
  }
} else {
  $total_debit = 0;
}
// End total total_debit/joma
$total_balance = $total_debit - $total_credit - $motor_vara_and_unload;
// // Start total total_Balance/mot_jer
//     $sql = "SELECT SUM(balance) as balance FROM details_sell_pathor WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
//     $result = $db->select($sql);
//     if($result->num_rows > 0){
//         while($row = $result->fetch_assoc()){
//             $total_balance = $row['balance'];
//             if(is_null($total_balance)){
//                 $total_balance = 0;
//             }
//         }
//     } else{
//         $total_balance = 0;
//     }
// // End total total_Balance/mot_jer

//Start Total para/mot_mul_khoros_shoho

$vara_credit = $motor_vara_and_unload + $total_credit;


?>






<div id="flip">
<label class="conchk" id="flipChkbox">Show/Hide Summary
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <div class="contorlAfterDealer">          
      
        <button onclick="myFunction()" class="btn printBtnDlr" style="position:relative; margin-left:150px; right: 0px">Print</button>
        <!-- <button onclick="myFunction()" class="btn printBtnDlrDown">Download</button> -->
    </div>
</div>

<div id="panel">
<div style="display: flex;">
    <div class="upper">
      <table width="288px" class="summary">
        <?php
      //   $sql =
      //     "SELECT category_name,category_id,sum(count) as 'total' 
      //  FROM brick_category
      //  LEFT JOIN details_brick
      //  ON details_brick.particulars_id = brick_category.category_id
      //  WHERE details_brick.dealer_id = '$dealerId'  AND details_brick.particulars != 'BG' AND details_brick.particulars != 'In Cash' 
      //  GROUP BY details_brick.particulars_id
      // ";

        $sql = "SELECT DISTINCT particulars,particulars_id,SUM(count) as 'total' 
        FROM details_sell_brick 
        WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id' AND particulars != 'BG' AND particulars != 'In Cash' 
        GROUP BY particulars_id";
        // $result2 = $conn->query($sqlrr);
        $result = $db->select($sql);
        if ($result) {
          $rowcount2 = mysqli_num_rows($result);
          if ($rowcount2 != 0) {
            if ($result->num_rows > 0) {
              // output data of each row

              while ($rows = $result->fetch_assoc()) {
                // $temp = $rows['particulars'];
                echo "<tr>";
                echo "<td>" . $rows['particulars'] . "</td>";
                echo "<td>" . $rows['total'] . "</td>";
                echo "</tr>";
                // echo "id: " . $row["id"]. " - Name: " . $row["category_name"]. " " .  "<br>";
              }
            } else {
              echo "0 results";
            }
          }
        }
        ?>
        <tr>

          <td style= "background-color: grey; border: 2px solid black; color: white; text-align: center;" class="hastext"><b>ম‌োট পিস</b></td>
          <td style= "border: 2px solid black;"><b><?php echo $total_w; ?></b></td>
          <!-- <td class="hastext"><b>Total Kg:</b></td>
    <td><b><?php echo $total_kg_rod400; ?></b></td> -->

        </tr>
      </table>
    </div>
    <div class="lower">
      <table width="709px" class="summary">
        <tr>
          <!-- <td class="hastext" width="150px">04.50mm 500W/60G</td>
			<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td>
			<td class="hastext" width="150px">04.50mm 400W/60G</td>
			<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td> -->
          <!-- <td class="hastext">মোট সেপ্টি </td>
      <td style="min-width: 85px"><?php echo $total_shift; ?></td> -->
          <!-- <td class="hastext">জ‌িব‌ি ব্যাংক গ্যান্ট‌িঃ</td>
			<td style="min-width: 85px"><?php echo $gb_bank_ganti; ?></td> -->

        </tr>
        <tr>
          <!-- <td class="hastext">১ম শ্রেণী </td>
			<td><?php echo $total_weight; ?></td> -->
          <!-- <td class="hastext">06mm 400W/60G</td>
			<td><?php echo $mm06_rod400; ?></td> -->
          <!-- <td class="hastext">ওজন (এম,টি )</td>
      <td><?php echo $total_shift; ?></td> -->
          <!-- <td class="hastext"></td>
          <td><?php echo $company_paona; ?></td> -->

        </tr>
        <tr>
          <!-- <td class="hastext">২য় শ্রেণী </td>
			<td><?php echo $total_weight1; ?></td> -->
          <!-- <td class="hastext">08mm 400W/60G</td>
			<td><?php echo $mm08_rod400; ?></td> -->
          <td class="hastext">মোট গাড়ীঃ</td>
          <td><?php echo $total_motor; ?></td>

          <td class="hastext"></td>
          <td><?php echo $nij_paona; ?></td>

        </tr>
        <tr>
          <!-- <td class="hastext">Cement White</td>
			<td><?php echo $mm10_rod500; ?></td>
			<td class="hastext">10mm 400W/60G</td>
			<td><?php echo $mm10_rod400; ?></td> -->
          <!-- <td></td>
      <td></td>
      <td></td>
      <td></td> -->
        </tr>
        <tr>
          <!-- <td class="hastext">12mm 500W/60G</td>
			<td><?php echo $mm12_rod500; ?></td>
			<td class="hastext">12mm 400W/60G</td>
			<td><?php echo $mm12_rod400; ?></td> -->
          <!-- <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td> -->
        </tr>
        <!-- Ekhan theke -->
        <tr>
          <!-- <td class="hastext">৩য় শ্রেণী</td>
			<td><?php echo $total_weight3; ?></td> -->
          <!-- <td class="hastext">16mm 400W/60G</td>
			<td><?php echo $mm16_rod400; ?></td> -->
          <!-- <td style="background-color:#555"></td>
          <td style="background-color:#555"></td>
          <td style="background-color:#555"></td>
          <td style="background-color:#555"></td> -->

        </tr>
        <tr>
          <!-- <td class="hastext">পিকেট </td>
			<td><?php echo $total_weight4; ?></td> -->
          <!-- <td class="hastext">20mm 400W/60G</td>
			<td><?php echo $mm20_rod400; ?></td> -->
          <td class="hastext">মোট গাড়ী ভাড়াঃ</td>
          <td><?php echo $motor_vara; ?></td>
          <td class="hastext">ম‌োট মূলঃ</td>
          <td><?php echo $total_credit; ?></td>

        </tr>
        <tr>
          <!-- <td class="hastext">লাল ক্লাশ</td>
            <td><?php echo $total_weight5; ?></td> -->
          <td class="hastext">মোট খালাস খরচঃ</td>
          <td><?php echo $unload; ?></td>
          <td class="hastext">ম‌োট জমাঃ</td>
          <td><?php echo $total_debit; ?></td>

        </tr>
        <tr>
          <!-- <td class="hastext">টুকরা</td>
			<td><?php echo $total_weight6; ?></td> -->
          <!-- <td class="hastext">25mm 400W/60G</td>
			<td><?php echo $mm25_rod400; ?></td> -->
          <td class="hastext">গাড়ী ভাড়া ও খালাস খরচঃ</td>
          <td><?php echo $motor_vara_and_unload; ?></td>
          <td class="hastext">ম‌োট পাওনা ও জেরঃ</td>
          <td><?php echo $total_balance; ?></td>

        </tr>
        <tr>
          <!-- <td class="hastext">গোরিয়া</td>
			<td><?php echo $total_weight7; ?></td> -->
          <td class="hastext">ম‌োট মূল খরচ সহঃ</td>
          <td><?php echo $vara_credit; ?></td>
          <td></td>
          <td></td>
        </tr>

        <tr>
          <td class="hastext"><b>Total Piece:</b></td>
          <td><b><?php echo $total_w; ?></b></td>
          <!-- <td class="hastext"><b>Total Kg:</b></td>
			<td><b><?php echo $total_kg_rod400; ?></b></td> -->
          <td></td>
          <td></td>
          <!-- <td></td>
          <td></td> -->
        </tr>
      </table>
    </div>
  </div>

</div>

<div class="rodDetailsEnCon" style="display: block;">
  <form id="form_entry">
    <!-- <h2 class="ce_header bg-primary">Details Entry</h2> -->
    <div class="scrolling-div" id="scrolling-entry-div">
      <!-- <div id="popUpNewBtn">
                    <img src="../img/others/new_entry.png" width="100%" height="100%">
                </div> -->
      <!-- <div class="scrollsign_plus" id="entry_scroll3">+</div> 
                <div class="scrollsign_plus" id="entry_scroll2">+</div>                  
                <div class="scrollsign_plus" id="entry_scroll1">+</div>                   -->
      <table border="1" id="detailsEtryTable">
        <tr>
          <td class="widthPercent1">Customer ID</td>
          <td class="widthPercent1">Dealer ID</td>
          <!-- <td width="150">Dealer ID</td> -->
          <!-- <td class="widthPercent1">Type</td> -->
          <td class="widthPercent1">Motor Name</td>
          <td class="widthPercent1">Driver Name</td>
          <td class="widthPercent1">Motor Vara</td>
          <td class="widthPercent1">Unload</td>
          <td class="widthPercent1">Cars rent & Redeem</td>
          <td class="widthPercent1">Information</td>
          <td class="widthPercent1">Address</td>
          <!-- <td width="150">Dealer ID</td> -->
          <!-- <td class="widthPercent1">Type</td> -->
          <!-- <td class="widthPercent1">Information</td> -->
          <td class="widthPercent1">SL</td>  
          <td class="widthPercent1">Voucher No.</td>
          <td class="widthPercent1">Motor Number</td>
          <td class="widthPercent1">Motor SL</td>
          <!-- <td class="widthPercent2">Particulars</td> -->
          <td class="widthPercent1">Delivery Date</td>
          <!-- <td class="widthPercent2">SO Date</td> -->
          <td class="widthPercent2">Date</td>
          <td class="widthPercent2">Partculars</td>
          <!-- <td class="widthPercent2">Particulars</td> -->
          <td class="widthPercent2">Debit</td>
          <td class="widthPercent2">Class</td>
          <td class="widthPercent3">Count</td>
          <!-- <td class="widthPercent3">Fee</td> -->
          <td class="widthPercent3">Para's</td>
          <td class="widthPercent3">Discount</td>
          <td class="widthPercent3">Credit</td>
          <td class="widthPercent3" style="display: none;">Balance</td>
          <td class="widthPercent3" style="display: none;">Total Credit</td>
        </tr>
        <tr>
          <td>কাস্টমার আই ডি</td>
          <td>ডিলার আই ডি</td>
          <!-- <td>টাইপ</td> -->
          <td>গাড়ী নাম</td>
          <td>ড্রাইভারের নাম</td>
          <td>গাড়ী ভাড়া</td>
          <td>আনলোড</td>
          <td>গাড়ী ভাড়া ও খালাস</td>
          <td>মালের বিবরণ</td>
          <td>ঠিকানা</td>
          <!-- <td>ডিলার আই ডি</td> -->
          <!-- <td>টাইপ</td> -->

          <!-- <td>মালের বিবরণ</td> -->
          <td>ক্রমিক নং</td>
          <td>ভাউচার নং</td>
          <td>গাড়ী নাম্বার</td>
          <td>গাড়ী নং</td>
          <td>ডেলিভারী তারিখঃ</td>
          <!-- <td>অর্ডার তারিখ</td> -->
          <td>তারিখ</td>
          <td>মারফ‌োত নাম</td>
          <!-- <td>বিবরণ</td> -->
         
          <td>জমা টাকা</td>
          <td>শ্রেণী</td>
          <td>পরিমান‌</td>
          <!-- <td>ফি</td> -->
          <td>দর</td>
          <td>কমিশন</td>
          <td>মূল</td>
          <td style="display: none;">অবশিষ্ট</td>
          <td style="display: none;">মোট মূলঃ</td>

        </tr>
        <tr>
          <td>
            <?php
            $sql = "SELECT customer_id, customer_name FROM customers_cement";
            $all_custmr_id = $db->select($sql);
            echo '<select name="customer_id" id="customer_id" class="form-control" style="width: 140px;">';
            echo '<option value="none">Select...</option>';
            if ($all_custmr_id->num_rows > 0) {
              while ($row = $all_custmr_id->fetch_assoc()) {
                $id = $row['customer_id'];
                $customer_name = $row['customer_name'];
                echo '<option value="' . $id . '">' . $id . '-(' . $customer_name . ')' . '</option>';
              }
            } else {
              echo '<option value="none">0 Result</option>';
            }
            echo '</select>';
            ?>

          </td>
          <?PHP
          $sql = "SELECT sl FROM details_sell_brick ORDER BY id DESC LIMIT 1";
          $customersId = $db->select($sql);
          if ($customersId->num_rows > 0) {
            $row = $customersId->fetch_assoc();
            $largestId = $row['sl'];
          } else {
            $largestId = 'sl-100000';
          }
          $matches = preg_replace('/\D/', '', $largestId);
          $newNumber = $matches + 1;
          $newId = 'SL-' . $newNumber;
          ?>

<td>
            <!-- <input type="text" name="customer_id" class="form-control-balu" id="customer_id" placeholder="Enter customer_id..."> -->
            <?php
            $sql = "SELECT * FROM brick_dealer WHERE project_name_id ='$project_name_id'";
            $all_custmr_id = $db->select($sql);
            echo '<select name="dealer_id" id="dealer_id" class="form-control" style="width: 140px; required">';
            echo '<option value="none">Select...</option>';
            if ($all_custmr_id->num_rows > 0) {
              while ($row = $all_custmr_id->fetch_assoc()) {
                $id = $row['dealer_id'];
                $dealer_name = $row['dealer_name'];
                echo '<option value="' . $id . '">' . $id . '--' . $dealer_name . '</option>';
              }
            } else {
              echo '<option value="none">0 Result</option>';
            }
            echo '</select>';
            ?>

          </td>
<td>
            <input type="text" name="motor_name" class="form-control-cement" id="motor_name" placeholder="Motor name...">
          </td>
          <td>
            <input type="text" name="driver_name" class="form-control-cement" id="driver_name" placeholder="Driver name...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="motor_vara" class="form-control-cement value-calc" id="motor_vara" placeholder="Gari vara...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="unload" name="unload" class="form-control-cement value-calc" id="unload" placeholder="Unload...">
          </td>
          <td>
            <input type="text" name="car_rent_redeem" class="form-control-cement value-calc" id="car_rent_redeem" placeholder="Cars rent & redeem...">
          </td>
          <td>
            <input type="text" name="information" class="form-control-cement" id="information" placeholder="Information...">
          </td>
          <td>
            <input type="text" name="address" class="form-control-cement" id="address" placeholder="Address..." pattern="[a-zA-Z0-9-\s]+" required>
          </td>
          <td>
            <input type="text" name="sl_no" class="form-control-cement" id="sl_no"  placeholder="Sl no..." >
          </td>
          
          <td>
            <input type="text" name="voucher_no" class="form-control-cement" id="voucher_no" placeholder="Voucher no..." required>
          </td>
          <td>
            <input type="text" name="motor_no" class="form-control-cement" id="motor_no" placeholder="Motor sl...">
          </td>
          <td>
            <input type="text" name="motor" class="form-control-cement" id="motor" placeholder="Motor...">
          </td>
        
          <td>
            <input onkeypress="datecheckformat(event)" type="text" name="delivery_date" class="form-control-cement" id="delivery_date" placeholder="dd-mm-yyyy">
          </td>
          <!-- <td>
            <input onkeypress="datecheckformat(event)" type="text" name="so_date" class="form-control-cement" id="dates2" placeholder="dd-mm-yyyy">
          </td> -->
          <td>
            <input onkeypress="datecheckformat(event)" type="text" name="dates" class="form-control-cement" id="dates" placeholder="dd-mm-yyyy">
          </td>
          <td>
            <input type="text" name="partculars" class="form-control-cement" id="partculars" placeholder="Marfot...">
          </td>
          

          <td>
            <input type="text" onkeypress="return isNumber(event)" name="debit" class="form-control-cement value-calc" id="debit" placeholder="Debit...">
          </td>
          <td>
            <?php
            // var parti_val = $('#car_rent_redeem').val();
            $sql = "SELECT DISTINCT category_name, category_id FROM brick_category WHERE  category_name != ''";
            $all_particular = $db->select($sql);
            echo '<select name="particulars" id="particulars" class="form-control" style="width: 140px;" required>';
            echo '<option value="none">Select...</option>';
            if ($all_particular->num_rows > 0) {
              while ($row = $all_particular->fetch_assoc()) {
                $particulars = $row['category_name'];
                $particulars_id = $row['category_id'];
                echo '<option value="' . $particulars_id . ',' . $particulars . ' ">' . $particulars . '</option>';
              }
            } else {
              echo '<option value="none">0 Result</option>';
            }
            echo '</select>';
            ?>

          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="count" class="form-control-cement value-calc" id="count" placeholder="Count...">
          </td>

          <!-- <td>
            <input type="text" onkeypress="return isNumber(event)" name="fee" class="form-control-cement value-calc" id="fee" placeholder="Fee...">
          </td> -->

          <td>
            <input type="text" onkeypress="return isNumber(event)" name="paras" class="form-control-cement value-calc" id="paras" placeholder="Paras ...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="discount" class="form-control-cement value-calc" id="discount" placeholder="Discount...">
          </td>
          <td>
            <input type="text" name="credit" class="form-control-cement value-calc" id="credit" placeholder="Credit...">
          </td>

          <td style="display: none;">
            <input type="text" name="balance" class="form-control-cement value-calc" id="balance" placeholder="Balance...">
          </td>
          <td style="display: none;">
            <input type="text" name="et_para" class="form-control-cement value-calc" id="et_para" placeholder="gari vara labour soho...">
          </td>
          <td style="display: none;">
            <input type="text" name="total_credit" class="form-control-cement value-calc" id="total_credit" placeholder="Total credit...">
          </td>
          <!-- <td colspan="2"></td> -->
        </tr>
      </table>
      <h4 class="text-success text-center" id="NewEntrySucMsg"></h4>
    </div>
    <input onclick="valid('insert')" type="button" name="submit" class="btn btn-primary scroll-after-btn" value="Save">

  </form>
</div>

<div class="rodDetailsEdit" style="display: none; position: relative;">
</div>

<br><br>


<?php
// $sql ="SELECT * FROM details_balu WHERE dealer_id='$dealerId' ";
$sql = "SELECT * FROM details_sell_brick WHERE dealer_id='$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result) {
  $rowcount = mysqli_num_rows($result);
  if ($rowcount != 0) {
?>
    <div id="viewDetailsSearchAfterNewEntry" style="margin-top:25px;">
      <div class="viewDetailsCon" id="viewDetails">
        <table id="detailsNewTable2">
          <thead class="header">
            <tr>
              <th>Customer ID:</th>
              <th>Dealer ID:</th>
              <th>Motor Name</th>
              <th>Driver Name</th>
              <th>Motor Vara</th>
              <th>Unload</th>
              <th>Cars rent & Redeem</th>
              <th>Information</th>
              <th>Address</th>
              <th>SL</th>
              <th>Voucher No:</th>
              <th>Motor SL</th>
              <th>Motor Number</th>
              <th>Delivery Date</th>
              <th>Date</th>
              <th>Partculars</th>
              <th>Particulars</th>
              <th>Debit</th>
              <th>Count</th>
              <!-- <th>Fee</th> -->
              <th>Para's</th>
              <th>Discount</th>
              <th>Credit</th>
              <th>Balance</th>
              <!-- <th>Total Credit</th>
              <th>Weight (MT)</th> -->
              <th></th>
              <th class='no_print_media'></th>
              <th class='no_print_media'></th>
            </tr>
            <tr>
              <th>কাস্টমার আই ডি</th>
              <th>ডিলার আই ডি</th>
              <th>গাড়ী নাম</th>
              <th>ড্রাইভারের নাম</th>
              <th>গাড়ী ভাড়া</th>
              <th>আনলোড</th>
              <th>গাড়ী ভাড়া ও খালাস</th>
              <th>মালের বিবরণ</th>
              <th>ঠিকানা</th>
              <th>ক্রমিক নং</th>    
              <th>ভাউচার নং</th>

              <th>গাড়ী নাম্বার</th>
              <th>গাড়ী নং</th>
              <th>ডেলিভারী তারিখ</th>
       
              <th>তারিখ</th>
              <th>মারফ‌োত নাম</th>
              <th>ব‌িবরণ</th>
              <th>জমা টাকা</th>
              <th>পরিমান‌</th>
              <!-- <th>ফি</th> -->
              <th>দর</th>
              <th>কমিশন</th>
              <th>মূল</th>
              <th>অবশিষ্ট</th>
              <!-- <th>মোট মূলঃ</th>
              <th>ওজন (এম,টি )</th> -->
              <th></th>
              <th class='no_print_media'></th>
              <th class='no_print_media'></th>
            </head>
          <tbody>
            <?php
            while ($rows = $result->fetch_assoc()) {
              if ($rows['challan_date'] == '0000-00-00') {
                $format_challan_date = '';
              } else {
                $challan_date = $rows['challan_date'];
                $format_challan_date = date("d-m-Y", strtotime($challan_date));
              }
              if ($rows['so_date'] == '0000-00-00') {
                $format_so_date = '';
              } else {
                $so_date = $rows['so_date'];
                $format_so_date = date("d-m-Y", strtotime($so_date));
              }
              if ($rows['dates'] == '0000-00-00') {
                $format_dates = '';
              } else {
                $dates = $rows['dates'];
                $format_dates = date("d-m-Y", strtotime($dates));
              }
              echo "<tr>";
              echo "<td>" . $rows['customer_id'] . "</td>";
              echo "<td>" . $rows['dealer_id'] . "</td>";
              echo "<td>" . $rows['motor_name'] . "</td>";
              echo "<td>" . $rows['driver_name'] . "</td>";
              echo "<td>" . $rows['motor_vara'] . "</td>";
              echo "<td>" . $rows['unload'] . "</td>";
              echo "<td>" . $rows['cars_rent_redeem'] . "</td>";
              echo "<td>" . $rows['information'] . "</td>";
              echo "<td>" . $rows['address'] . "</td>";
              echo "<td>" . $rows['sl'] . "</td>";
              echo "<td>" . $rows['voucher_no'] . "</td>";
              echo "<td>" . $rows['motor_sl'] . "</td>";
              echo "<td>" . $rows['motor_no'] . "</td>";
              // echo "<td>" . $format_challan_date . "</td>";
              echo "<td>" . $rows['delivery_date'] . "</td>";
              echo "<td>" . $format_dates . "</td>";
              echo "<td>" . $rows['partculars'] . "</td>";
              echo "<td>" . $rows['particulars'] . "</td>";
              echo "<td>" . $rows['debit'] . "</td>";
              echo "<td>" . $rows['count'] . "</td>";
              // echo "<td>" . $rows['fee'] . "</td>";
              echo "<td>" . $rows['paras'] . "</td>";
              echo "<td>" . $rows['discount'] . "</td>";
              echo "<td>" . $rows['credit'] . "</td>";
              echo "<td>" . $rows['balance'] . "</td>";
              
              // echo "<td>" . $rows[''] . "</td>";

              if ($delete_data_permission == 'yes') {
                echo "<td width='78px' class='no_print_media'><a class='btn btn-danger detailsDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
              } else {
                echo '<td width="78px" class="no_print_media"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
              }

              if ($edit_data_permission == 'yes') {
                echo "<td width='60px' class='no_print_media'><a onclick='edit_rod_popup(this," . $rows['id'] . ")'  class='btn btn-success'>Edit</a></td>";
              } else {
                echo '<td width="60px" class="no_print_media"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
              }

              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <br><br>
    </div>
<?php
  } else {
    echo '<div style="width: 100%; height: 100px;"></div>';
  }
}
?>