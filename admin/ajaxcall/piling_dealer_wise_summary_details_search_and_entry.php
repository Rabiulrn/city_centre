<?php
session_start();
require '../config/config.php';
require '../lib/database.php';
$db = new Database();

$dealerId  = $_POST['dealerId'];
$_SESSION['dealerIdInput'] = $_POST['dealerId'];
// echo $dealerId;
$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];


$sucMsg = "";




$total1_weight = 0;
$sql = "SELECT SUM(count) as weight FROM details_brick WHERE particulars AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
$sql = "SELECT COUNT(motor_vara) as motor FROM details_brick WHERE dealer_id = '$dealerId'AND motor_vara > 0 AND project_name_id = '$project_name_id'";
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
$sql = "SELECT SUM(motor_vara) as motor_vara FROM details_brick WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
$sql = "SELECT SUM(unload) as unload FROM details_brick WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
$sql = "SELECT COUNT(motor_sl) as motor FROM details_brick WHERE dealer_id = '$dealerId'AND motor_sl > 0 AND project_name_id = '$project_name_id'";
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


// //End GB Bank Ganti
// Start total total_kg
$sql = "SELECT SUM(money_back) as total_money_back FROM details_piling WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_money_back = $row['total_money_back'];
    if (is_null($total_money_back)) {
      $total_money_back = 0;
    }
  }
} else {
  $total_money_back = 0;
}

$sql = "SELECT SUM(bill_cash) as total_joma FROM details_piling WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_joma = $row['total_joma'];
    if (is_null($total_joma)) {
      $total_joma = 0;
    }
  }
} else {
  $total_joma = 0;
}
// $total_ton = $total_shift / 23.5;
// // End total total_kg

// Start total total_credit/mot_mul
$sql = "SELECT COUNT(piling_count) as piling_count FROM details_piling WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_piling_count = $row['piling_count'];
    if (is_null($total_piling_count)) {
      $total_piling_count = 0;
    }
  }
} else {
  $total_piling_count = 0;
}
// End total total_credit/mot_mul

// Start total total_debit/joma
$total_piling_bill = 0;
$sql1 = "SELECT SUM(piling_bill) as piling_b FROM details_piling WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql1);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_piling_bill = $row['piling_b'];
    if (is_null($total_piling_bill)) {
      $total_piling_bill = 0;
    }
  }
} else {
  $total_piling_bill = 0;
}
$jer =($total_joma - $total_piling_bill) - $total_money_back;

?>

<div id="flip">
    <!-- <label class="conchk" id="flipChkbox">Show/Hide Summary 
      <input type="checkbox">
      <span class="checkmark"></span>
    </label> -->
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
      <table width="400px" class="summary">
        <?php
      //   $sql =
      //     "SELECT category_name,category_id,sum(piling_count) as 'total' 
      //  FROM piling_category
      //  LEFT JOIN details_piling
      //  ON details_piling.particulars_id = piling_category.category_id
      //  WHERE details_piling.dealer_id = '$dealerId'  AND details_piling.particulars != 'BG' AND details_piling.particulars != 'In Cash' 
      //  GROUP BY details_piling.particulars_id
      // ";

        $sql = "SELECT DISTINCT particulars,particulars_id,COUNT(piling_count) as 'total' 
        FROM details_piling 
        WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id' AND particulars != 'In Cash' 
        GROUP BY particulars_id
       ";
        // $result2 = $conn->query($sqlrr);
        $result2 = $db->select($sql);
        if ($result2) {
          $rowcount2 = mysqli_num_rows($result2);
          if ($rowcount2 != 0) {
            if ($result2->num_rows > 0) {
              // output data of each row

              while ($rows = $result2->fetch_assoc()) {
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

          <td style="background-color:grey; border:2px solid black; text-align:center; color:white;" class="hastext"><b>Total Piling:</b></td>
          <td style="border:2px solid black;"><b><?php echo $total_piling_count; ?></b></td>
          <!-- <td class="hastext"><b>Total Kg:</b></td>
    <td><b><?php echo $total_kg_rod400; ?></b></td> -->

        </tr>
      </table>
    </div>
    <div class="lower">
      <table width="600px" class="summary">

      <tr>

    
    

     </tr>
     
       
        <tr>

          <td class="hastext">মোট পাইলিং বিলঃ</td>
          <td><?php echo $total_piling_bill; ?></td>

        </tr>
        <tr>
  
          <td class="hastext">মোট জমাঃ</td>
          <td><?php echo $total_joma; ?></td>

        </tr>

      

        <tr>

          <td class="hastext">জের /পরিশোধঃ</td>
          <td><?php echo $jer; ?></td>
     
        </tr>
        <tr>

          <td class="hastext">কোম্পানির পাওনা ফেরত</td>
          <td><?php echo $total_money_back; ?></td>
    
        </tr>

        <tr>
         
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
          <td class="widthPercent1">Dealer ID</td>
          <td class="widthPercent1">SL</td>

          <td class="widthPercent2">Date</td>
          <td class="widthPercent2">Marfot Name</td>
          <td class="widthPercent2">Description</td>
          <td class="widthPercent2">Category</td>
        
          
          <td class="widthPercent1">Cape No.</td>   
          <!-- voucher is added here -->
          
          <td class="widthPercent2">Bill Cash</td>
          <!-- debit is added here -->
          <td class="widthPercent1">Address</td>
          <!-- Address is added here -->
          <!-- <td class="widthPercent2">Class</td> -->
          <td class="widthPercent3">Piling Count </td>
          <td class="widthPercent3">Feet</td>
          <td class="widthPercent3">Para's</td>
          <!-- <td class="widthPercent3">Discount</td> -->
          <td class="widthPercent3">Piling Bill</td>
          <td class="widthPercent3">Excess money back</td>
          <!-- <td class="widthPercent3">Fee</td> -->
      

        </tr>
        <tr>
          <td>ডিলার আই ডি</td>
          <td>ক্রমিক নং</td>
      
          <td>তারিখ</td>
          <td>মারফ‌োত নাম</td>
          <td>বিবরণ</td>
          <td>ক্যাটাগরি</td>

          
          <!-- <td></td> -->
          <td>কেপ নং</td>
         
          <td>জমা টাকা</td>
          <td>ঠিকানা</td>
          <td>পাইলিং পরিমান</td>
          <td>ফিট</td>
          <!-- <td>ফি</td> -->
          <td>রেট</td>
          <!-- <td>কমিশন</td> -->
          <td>পাইলিং বিলঃ</td>
          <td>অতিরিক্ত টাকা ফেরত</td>
          

         


        </tr>
        <tr>
          <td>
            <!-- <input type="text" name="customer_id" class="form-control-balu" id="customer_id" placeholder="Enter customer_id..."> -->
            <?php
            $sql = "SELECT * FROM piling_dealer WHERE project_name_id ='$project_name_id'";
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
 
          <?PHP
          $sql = "SELECT sl FROM details_brick ORDER BY id DESC LIMIT 1";
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
            <input type="text" name="sl" class="form-control-cement" id="sl"  placeholder="Enter sl no..." >
          </td>
          <td>
            <input onkeypress="datecheckformat(event)" type="text" name="dates" class="form-control-cement" id="dates" placeholder="dd-mm-yyyy">
          </td>
          <td>
            <input type="text" name="marfot_name" class="form-control-cement" id="marfot_name" placeholder="Marfot...">
          </td>
          <td>
            <input type="text" name="biboron" class="form-control-cement" id="biboron" placeholder="Description...">
          </td>

          <td>
            <?php
            // var parti_val = $('#car_rent_redeem').val();
            $sql = "SELECT DISTINCT category_name,category_id FROM piling_category WHERE  category_name != ''";
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
          <!-- <td>
            <input type="text" name="particular" class="form-control-cement" id="particular" placeholder="Particular...">
          </td> -->
          <td>
            <input type="text" name="cap_no" class="form-control-cement" id="cap_no" placeholder="Enter cape no..." required>
          </td>

          <td>
            <input type="text" onkeypress="return isNumber(event)" name="bill" class="form-control-cement value-calc" id="bill" placeholder="Bill cash...">
          </td>
          <td>
            <input type="text" name="address" class="form-control-cement" id="address" placeholder="Address..." pattern="[a-zA-Z0-9-\s]+" required>
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="piling_count" class="form-control-cement value-calc" id="piling_count" placeholder="Piling count...">
          </td>

          
         

          <td>
            <input type="text" onkeypress="return isNumber(event)" name="feet" class="form-control-cement value-calc" id="feet" placeholder="Feet...">
          </td>

          <td>
            <input type="text" onkeypress="return isNumber(event)" name="paras" class="form-control-cement value-calc" id="paras" placeholder="Paras ...">
          </td>
           <!-- <td>
            <input type="text" onkeypress="return isNumber(event)" name="discount" class="form-control-cement value-calc" id="discount" placeholder="Discount...">
          </td> -->
          <td>
            <input type="text" name="piling_bill" class="form-control-cement value-calc" id="piling_bill" placeholder="Piling bill...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="money_back" class="form-control-cement value-calc" id="money_back" placeholder="Express money back...">
          </td>
         


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
$sql = "SELECT * FROM details_piling WHERE dealer_id='$dealerId' AND project_name_id = '$project_name_id'";
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
              <th>SL</th>
              <th>Date</th>          
              <th>Marfot Name</th>
              <th>Description</th>
              <th>Cap no.</th> 
              <th>Category</th>   
              <th>Bill Cash</th>
              <th>Address</th>
              <th>Piling Serial</th>
              <th>Feet</th>
              <th>Para's</th>
              <th>Piling Bill</th>
              <th>Excess money back</th>
             
              <th class='no_print_media'></th>
              <th class='no_print_media'></th>
            </tr>
            <tr>
              <th>ক্রমিক নং</th>
             
              <th>তারিখঃ</th>
              <th>মারফোত নামঃ</th>
              <th>বিবরণ নাম</th>
              <th>কেপ নং</th>
              <th>ক্যাটাগরি</th>
              <th>জমা টাকাঃ</th>
              <th>ঠিকানা</th>
              <th>পাইলিং পরিমান</th>
              <th>ফিট</th>
              <th>রেট‌</th>
              <th>পাইলিং বিলঃ</th>
              <th>অতিরিক্ত টাকা ফেরত</th>
              
              <th class='no_print_media'></th>
              <th class='no_print_media'></th>
            </tr>
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
              echo "<td>" . $rows['sl'] . "</td>";
            //   echo "<td>" . $rows['motor_name'] . "</td>";
            //   echo "<td>" . $rows['driver_name'] . "</td>";
            //   echo "<td>" . $rows['motor_vara'] . "</td>";
            //   echo "<td>" . $rows['unload'] . "</td>";
            //   echo "<td>" . $rows['cars_rent_redeem'] . "</td>";             
            //   echo "<td>" . $rows['information'] . "</td>";
            //   echo "<td>" . $rows['address'] . "</td>";
              echo "<td>" . $rows['date'] . "</td>";
              echo "<td>" . $rows['marfot_name'] . "</td>";
              echo "<td>" . $rows['description'] . "</td>";
              echo "<td>" . $rows['cap_no'] . "</td>";
              // echo "<td>" . $format_challan_date . "</td>";
              echo "<td>" . $rows['particulars'] . "</td>";        
              // echo "<td>" . $format_dates . "</td>";
              echo "<td>" . $rows['bill_cash'] . "</td>";
              echo "<td>" . $rows['address'] . "</td>";
              echo "<td>" . $rows['piling_count'] . "</td>";
              echo "<td>" . $rows['feet'] . "</td>";
              // echo "<td>" . $rows['fee'] . "</td>";
              echo "<td>" . $rows['paras'] . "</td>";
              echo "<td>" . $rows['piling_bill'] . "</td>";
              echo "<td>" . $rows['money_back'] . "</td>";
              
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