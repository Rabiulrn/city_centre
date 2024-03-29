<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->


</head>

<body>

  <?php
  session_start();
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();

  $dealerId  = $_POST['dealerId'];
  $dealer_id_summ      = trim($_SESSION['dealerIdInput']);
  $_SESSION['dealerIdInput'] = $_POST['dealerId'];
  // echo $dealerId;
  $project_name_id = $_SESSION['project_name_id'];
  $edit_data_permission   = $_SESSION['edit_data'];
  $delete_data_permission = $_SESSION['delete_data'];



  $sucMsg = "";

  $total_weight = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (Cem-3) Gold%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight = $row['weight'];
      if (is_null($total_weight)) {
        $total_weight = 0;
      }
    }
  } else {
    $total_weight = 0;
  }

  $total_weight1 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement Gold (OPC)%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight1 = $row['weight'];
      if (is_null($total_weight1)) {
        $total_weight1 = 0;
      }
    }
  } else {
    $total_weight1 = 0;
  }

  $total_weight2 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE 'Cement  SPECIAL (PCC)' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight2 = $row['weight'];
      if (is_null($total_weight2)) {
        $total_weight2 = 0;
      }
    }
  } else {
    $total_weight2 = 0;
  }

  $total_weight3 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (OPC)-1%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight3 = $row['weight'];
      if (is_null($total_weight3)) {
        $total_weight3 = 0;
      }
    }
  } else {
    $total_weight3 = 0;
  }

  $total_weight4 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement (OPC)-2%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight4 = $row['weight'];
      if (is_null($total_weight4)) {
        $total_weight4 = 0;
      }
    }
  } else {
    $total_weight4 = 0;
  }

  $total_weight5 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  OPC 33%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight5 = $row['weight'];
      if (is_null($total_weight5)) {
        $total_weight5 = 0;
      }
    }
  } else {
    $total_weight5 = 0;
  }

  $total_weight6 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  OPC 43%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight6 = $row['weight'];
      if (is_null($total_weight6)) {
        $total_weight6 = 0;
      }
    }
  } else {
    $total_weight6 = 0;
  }

  $total_weight7 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  OPC 53%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight7 = $row['weight'];
      if (is_null($total_weight7)) {
        $total_weight7 = 0;
      }
    }
  } else {
    $total_weight7 = 0;
  }


  $total_weight8 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement White%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight8 = $row['weight'];
      if (is_null($total_weight8)) {
        $total_weight8 = 0;
      }
    }
  } else {
    $total_weight8 = 0;
  }

  $total_weight9 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement Normal%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight9 = $row['weight'];
      if (is_null($total_weight9)) {
        $total_weight9 = 0;
      }
    }
  } else {
    $total_weight9 = 0;
  }

  $total_weight10 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (PSC)%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight10 = $row['weight'];
      if (is_null($total_weight10)) {
        $total_weight10 = 0;
      }
    }
  } else {
    $total_weight10 = 0;
  }

  $total_weight11 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (PPC)%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight11 = $row['weight'];
      if (is_null($total_weight11)) {
        $total_weight11 = 0;
      }
    }
  } else {
    $total_weight11 = 0;
  }

  $total_weight12 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (PC)%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight12 = $row['weight'];
      if (is_null($total_weight12)) {
        $total_weight12 = 0;
      }
    }
  } else {
    $total_weight12 = 0;
  }

  $total_weight13 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (PLC)%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight13 = $row['weight'];
      if (is_null($total_weight13)) {
        $total_weight13 = 0;
      }
    }
  } else {
    $total_weight13 = 0;
  }

  $total_weight14 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (PCC)%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight14 = $row['weight'];
      if (is_null($total_weight14)) {
        $total_weight14 = 0;
      }
    }
  } else {
    $total_weight14 = 0;
  }

  $total_weight15 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement Poly  (PCC)-1%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight15 = $row['weight'];
      if (is_null($total_weight15)) {
        $total_weight15 = 0;
      }
    }
  } else {
    $total_weight15 = 0;
  }
  $total_weight16 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement Poly (PCC)-2%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight16 = $row['weight'];
      if (is_null($total_weight16)) {
        $total_weight16 = 0;
      }
    }
  } else {
    $total_weight16 = 0;
  }
  $total_weight17 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (PCC A-M)%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight17 = $row['weight'];
      if (is_null($total_weight17)) {
        $total_weight17 = 0;
      }
    }
  } else {
    $total_weight17 = 0;
  }
  $total_weight18 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  (PCC B-M)%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight18 = $row['weight'];
      if (is_null($total_weight18)) {
        $total_weight18 = 0;
      }
    }
  } else {
    $total_weight18 = 0;
  }
  $total_weight19 = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars LIKE '%Cement  Slus%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_weight19 = $row['weight'];
      if (is_null($total_weight19)) {
        $total_weight19 = 0;
      }
    }
  } else {
    $total_weight19 = 0;
  }


  $total1_weight = 0;
  $sql = "SELECT SUM(count) as weight FROM details_cement WHERE particulars AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total1_weight = $row['weight'];
      if (is_null($total1_weight)) {
        $total1_weight = 0;
      }
    }
  } else {
    $total1_weight = 0;
  }





  // Start total total_motor
  $sql = "SELECT COUNT(motor_sl) as motor FROM details_cement WHERE dealer_id = '$dealerId'AND motor_sl > 0 AND project_name_id = '$project_name_id'";
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
  $sql = "SELECT SUM(motor_vara) as motor_vara FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
  $sql = "SELECT SUM(unload) as unload FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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

  // // End total total_motor
  // $sql = "SELECT COUNT(motor_vara) as motor FROM details_cement WHERE dealer_id = '$dealerId'AND motor_vara > 0 AND project_name_id = '$project_name_id'";
  // $result = $db->select($sql);
  // if ($result->num_rows > 0) {
  //   while ($row = $result->fetch_assoc()) {
  //     $total_motor = $row['motor'];
  //     if (is_null($total_motor)) {
  //       $total_motor = 0;
  //     }
  //   }
  // } else {
  //   $total_motor = 0;
  // }

  //Start GB Bank Ganti


  // //End GB Bank Ganti
  // Start total total_kg
  $sql = "SELECT SUM(weight) as shift FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_shift = $row['shift'];
      if (is_null($total_shift)) {
        $total_shift = 0;
      }
    }
  } else {
    $total_shift = 0;
  }

  $sql = "SELECT SUM(count2) as count_c FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
  $sql = "SELECT SUM(fee) as fee FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $free = $row['fee'];
      if (is_null($free)) {
        $free = 0;
      }
    }
  } else {
    $free = 0;
  }
  $mot_Bag = $total_w + $free;
  // $total_ton = $total_shift / 23.5;
  // // End total total_kg


  $sql = "SELECT SUM(oil_free) as oil_free FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $oil_free = $row['oil_free'];
      if (is_null($oil_free)) {
        $oil_free = 0;
      }
    }
  } else {
    $oil_free = 0;
  }

  $sql = "SELECT SUM(oil_sell) as oil_sell FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $oil_sell = $row['oil_sell'];
      if (is_null($oil_sell)) {
        $oil_sell = 0;
      }
    }
  } else {
    $oil_sell = 0;
  }

  // Start total total_credit/mot_mul
  $sql = "SELECT SUM(credit) as credit FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
  $sql = "SELECT SUM(debit) as debit FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
  // $total_balance = $total_debit - $total_credit - $motor_vara_and_unload;

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

  // $vara_credit = $motor_vara_and_unload + $total_cement_tel_mul;



  //End Total para/mot_mul_khoros_shoho
  $sql = "SELECT SUM(paras) as paras FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $paras = $row['paras'];
      if (is_null($paras)) {
        $paras = 0;
      }
    }
  } else {
    $paras = 0;
  }
  $sql = "SELECT SUM(debit) as debit, id FROM details_cement WHERE particulars = 'BG' AND  dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $gb_bank_ganti = $row['debit'];
      $gb_bank_ganti_db_id = $row['id'];
      if (is_null($gb_bank_ganti)) {
        $gb_bank_ganti = 0;
      }
    }
  } else {
    $gb_bank_ganti = 0;
  }

  $sql = "SELECT SUM(value) as value FROM cement_gb_bank_history WHERE  dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
  $result = $db->select($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $total_bank_g = $row['value'];
      if (is_null($total_bank_g)) {
        $total_bank_g = 0;
      }
    }
  } else {
    $total_bank_g = 0;
  }
  //End Total para/mot_mul_khoros_shoho

  $nij_joma_new = $total_debit - $total_bank_g;
  $nij_joma = $total_debit - $gb_bank_ganti;
  $company_paona_new = ($total_debit - $total_credit) - $total_bank_g;
  $company_paona = ($total_debit - $total_credit) - $gb_bank_ganti;
  $total_cement_tel_mul = $oil_sell + $total_credit;
  $total_balance = $total_debit - $total_cement_tel_mul;
  $vara_credit = $motor_vara_and_unload + $total_cement_tel_mul;
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

    


    <!-- <div class="contorlAfterDealer"> -->
      <!-- <div> <button onclick="myFunction()" class="btn printBtnDlr">Print</button></div> -->
     
      <!-- </div> -->
      <!-- <button onclick="myFunction()" class="btn printBtnDlrDown">Download</button> -->
    <!-- </div> -->
  
 

  <div id="panel">
<div style="display: flex;">
  <div>
  <table width="250px" class="summary">
      <?php
      $sql =
//         "SELECT category_name,category_id,sum(count) as 'total' 
// FROM cement_category
// LEFT JOIN details_cement
// ON details_cement.particulars_id = cement_category.category_id
// WHERE details_cement.dealer_id = '$dealerId'  AND details_cement.particulars != 'BG' AND details_cement.particulars != 'In Cash' 
// GROUP BY details_cement.particulars_id
// ";

      $sql = "SELECT DISTINCT particulars,particulars_id,SUM(count) as 'total' 
      FROM details_cement 
      WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id' AND particulars != 'BG' AND particulars != 'In Cash' 
      GROUP BY particulars_id
      HAVING SUM(count) != 0";
      // $result2 = $conn->query($sqlrr);
      $result2 = $db->select($sql);
      if ($result) {
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
      
      <td style= "background-color: grey; border: 2px solid black; color: white; text-align: center;" class="hastext"><b >ম‌োট ব্যাগ</b></td>
      <td style= "border: 2px solid black;"><b><?php echo $mot_Bag; ?></b></td>
      <!-- <td class="hastext"><b>Total Kg:</b></td>
    <td><b><?php echo $total_kg_rod400; ?></b></td> -->

    </tr>
      
    </table>

  </div>
  <div>
  <table width="748px" class="summary">
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

        <!-- <td class="hastext">Cement (Cem-3) Gold</td>
        <td><?php echo $total_weight; ?></td>
        <td class="hastext">Cement (PSC)</td>
        <td><?php echo $total_weight10; ?></td> -->
        <!-- <td class="hastext">06mm 400W/60G</td>
			<td><?php echo $mm06_rod400; ?></td> -->
      
        <td class="hastext">মোট গাড়ীঃ</td>
        <td><?php echo $total_motor; ?></td>
        <td class="hastext">জ‌িব‌ি ব্যাংক গ্যান্ট‌িঃ</td>
        <td><?php echo $total_bank_g; ?></td>

        <!-- <td style="width: 150px; position: relative; cursor:pointer;" id="gb_bank_ganti_td">
          <span id="gbbank_stable_val"><?php echo $gb_bank_ganti; ?></span>

          <input data-id="<?php echo $gb_bank_ganti_db_id; ?>" type="text" name="gb_bank_ganti" id="gb_bank_ganti" value="<?php echo $gb_bank_ganti; ?>" onfocus="this.value = this.value;">
        </td> -->

<!-- 
        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#smallShoes">
            GB-History
          </button></td> -->

        <!-- The modal -->
       

      </tr>
      <tr>

        <!-- <td class="hastext">Cement Gold (OPC)</td>
        <td><?php echo $total_weight1; ?></td>
        <td class="hastext">Cement (PPC)</td>
        <td><?php echo $total_weight11; ?></td> -->
        <!-- <td class="hastext">08mm 400W/60G</td>
			<td><?php echo $mm08_rod400; ?></td> -->
        <td class="hastext">ম‌োট ব্যাগ</td>
        <td><?php echo $total_w; ?></td>

        <td class="hastext">কোম্পানী পাওনাঃ</td>
        <td style="min-width: 85px"><?php echo $company_paona_new; ?></td>
        <!-- <td></td>
      <td></td> -->



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
        <!-- <td class="hastext">Cement SPECIAL (PCC)</td>
        <td><?php echo $total_weight2; ?></td>
        <td class="hastext">Cement (PC)</td>
        <td><?php echo $total_weight12; ?></td> -->
        <!-- <td class="hastext">16mm 400W/60G</td>
			<td><?php echo $mm16_rod400; ?></td> -->
        <td class="hastext">ম‌োট ফ্রি </td>
        <td><?php echo $free; ?></td>
        <td class="hastext">নিজ জমাঃ</td>
        <td><?php echo $nij_joma_new; ?></td>
        <!--       
      <td></td>
      <td></td> -->

      </tr>
      <tr>
        <!-- <td class="hastext">Cement (OPC)-1</td>
        <td><?php echo $total_weight3; ?></td>
        <td class="hastext">Cement (PLC)</td>
        <td><?php echo $total_weight13; ?></td> -->
        <!-- <td class="hastext">20mm 400W/60G</td>
			<td><?php echo $mm20_rod400; ?></td> -->
        <td class="hastext">ম‌োট ব্যাগ </td>
        <td><?php echo $mot_Bag; ?></td>


        <td></td>
        <td></td>


      </tr>
      <tr>
        <!-- <td class="hastext">Cement (OPC)-2</td>
        <td><?php echo $total_weight4; ?></td>
        <td class="hastext">Cement (PCC)</td>
        <td><?php echo $total_weight14; ?></td> -->
        <td class="hastext">ম‌োট তেল ফ্রি</td>
        <td><?php echo $oil_free; ?></td>
        <td></td>
        <td></td>


      </tr>

      <tr>
        <!-- <td class="hastext">Cement OPC 33 </td>
        <td><?php echo $total_weight5; ?></td>
        <td class="hastext">Cement Poly (PCC)-1 </td>
        <td><?php echo $total_weight15; ?></td> -->
        <td class="hastext">ম‌োট তেল মূলঃ</td>
        <td><?php echo $oil_sell; ?></td>

        <td class="hastext">ওজন (এম,টি )</td>
        <td><?php
            $format_number1 = number_format($total_shift, 2);
            echo $format_number1; ?></td>


<tr>
      <!-- <td class="hastext">Cement OPC 53</td>
      <td><?php echo $total_weight7; ?></td>
      <td class="hastext">Cement (PCC A-M)</td>
      <td><?php echo $total_weight17; ?></td> -->
      <!-- <td class="hastext"></td> -->
      <!-- <td><?php echo $motor_vara; ?></td> -->
      <!-- <td class="hastext"></td> -->
      <!-- <td><?php echo $total_credit; ?></td> -->



      <!-- <td></td>
      <td></td> -->
    </tr>
        <!-- <td></td>
      <td></td> -->
      </tr>
      <tr>
        <!-- <td class="hastext">Cement OPC 43 </td>
        <td><?php echo $total_weight6; ?></td>
        <td class="hastext" style="text-align: centre;"> Cement Poly (PCC)-2</td>
        <td><?php echo $total_weight16; ?></td> -->
<!--         
        <td style="background-color:#999"></td>
        <td style="background-color:#999"></td>
        <td style="background-color:#999"></td>
        <td style="background-color:#999"></td>
         -->



        <!-- <td></td>
      <td></td> -->
        <!-- <td></td>
      <td></td>  -->
      </tr>
      <tr>
        <!-- <td class="hastext">Cement OPC 53</td>
        <td><?php echo $total_weight7; ?></td>
        <td class="hastext">Cement (PCC A-M)</td>
        <td><?php echo $total_weight17; ?></td> -->
        <!-- <td class="hastext"></td> -->
        <!-- <td><?php echo $motor_vara; ?></td> -->
        <!-- <td class="hastext"></td> -->
        <!-- <td><?php echo $total_credit; ?></td> -->



        <!-- <td></td>
      <td></td> -->
      </tr>
      <tr>
      <td class="hastext">মোট গাড়ী ভাড়াঃ </td>
        <td><?php echo $motor_vara; ?></td>
        <td class="hastext">ম‌োট সিমেন্ট মূলঃ</td>
        <td><?php echo $total_credit; ?></td>
      <tr>
    



        <!-- <td></td>
      <td></td> -->

      </tr>
      <tr>
        <!-- <td class="hastext">Cement Slus</td>
        <td><?php echo $total_weight19; ?></td>
        <td class="hastext">Cement Normal</td>
        <td><?php echo $total_weight9; ?></td> -->
    <!-- <td class="hastext">Cement White</td>
        <td><?php echo $total_weight8; ?></td>
        <td class="hastext">Cement (PCC B-M)</td>
        <td><?php echo $total_weight18; ?></td> -->
        <td class="hastext">খালাস খরচঃ</td>
        <td><?php echo $unload; ?></td>
        <td class="hastext">ম‌োট সিমেন্ট ও তেল মূলঃ</td>
        <td><?php echo $total_cement_tel_mul; ?></td>
       





      </tr>
      <tr>
        <!-- <td></td>
        <td></td>
        <td></td>
        <td></td> -->
       
        <tr>
        <td class="hastext">গাড়ী ভাড়া ও খালাস খরচঃ</td>
        <td><?php echo $motor_vara_and_unload; ?></td>
        <td class="hastext">ম‌োট জমাঃ</td>
        <td><?php echo $total_debit; ?></td>
        <tr>
        <!-- <td></td>
        <td></td>
        <td></td>
        <td></td> -->
        <td class="hastext">ম‌োট মূল খরচ সহঃ</td>
        <td><?php echo $vara_credit; ?></td>
        <td class="hastext">ম‌োট পাওনা ও জেরঃ</td>
        <td><?php echo $total_balance; ?></td>
       
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
            <!-- <td width="150">Dealer ID</td> -->
            <!-- <td class="widthPercent1">Type</td> -->

            <!-- <td class="widthPercent1">Information</td> -->
            <td class="widthPercent1">Driver Name</td>
            <td class="widthPercent1">Motor Name</td>
            <td class="widthPercent1">Motor Cash</td>
            <td class="widthPercent1">Unload</td>
            <td class="widthPercent1">Cars rent & Redeem</td>
            <td class="widthPercent1">Information</td>

            <td class="widthPercent1">SL No</td>
            <!-- <td class="widthPercent2">Particulars</td> -->
            <td class="widthPercent1">Address</td>
            <td class="widthPercent1">Customer Id</td>
            <td class="widthPercent1">Challan No.</td>
            <td class="widthPercent1">Motor SL</td>
            <td class="widthPercent1">Motor Number</td>
            <td class="widthPercent1">Oil free</td>
            <td class="widthPercent1">Oil para's</td>
            <td class="widthPercent1">Challan Date</td>

            <td class="widthPercent2">SO Date</td>
            <td class="widthPercent2">Date</td>
            <td class="widthPercent2">Partculars</td>
            <td class="widthPercent2">Particulars</td>
            <td class="widthPercent2">Debit</td>
            <td class="widthPercent2">Monthly Commission</td>
            <td class="widthPercent2">Yearly Commission</td>
            <td class="widthPercent2">Total Deposit money</td>
            <td class="widthPercent3">Bag Count</td>
            <td class="widthPercent3">Free</td>
            <td class="widthPercent3">Total Bag Count</td>
            <td class="widthPercent3">Para's</td>
            <td class="widthPercent3">Discount</td>
            <td class="widthPercent3">Credit</td>
            <td class="widthPercent3" style="display: none;">Balance</td>
            <td class="widthPercent3" style="display: none;">Total Credit</td>
            <td class="widthPercent3">Weight ( MT )</td>
          </tr>
          <tr>
            <td>ডিলার আই ডি</td>
            <!-- <td>ডিলার আই ডি</td> -->
            <!-- <td>টাইপ</td> -->

            <!-- <td>মালের বিবরণ</td> -->
            <td>ড্রাইভারের নাম</td>
            <td>গাড়ী নাম</td>

            <td>গাড়ী ভাড়া</td>
            <td>আনলোড</td>
            <td>গাড়ী ভাড়া ও খালাস</td>
            <td>মালের বিবরণ</td>

            <td>ক্রমিক নং</td>
            <td>ঠিকানা</td>
            <td>কাস্টমার আই ডি</td>
            <td>ভাউচার নং</td>
            <td>গাড়ী নং</td>
            <td>গাড়ী নাম্বার</td>
            <td>তেল ফ্রি </td>
            <td>তেল মূলঃ</td>

            <td>ভাউচার তারিখ</td>
            <td>অর্ডার তারিখ</td>
            <td>তারিখ</td>
            <td>মারফ‌োত নাম</td>
            <td>ব‌িবরণ</td>
            <td>জমা টাকা</td>
            <td>মাসিক কমিশন</td>
            <td>বাৎসরিক কমিশন</td>
            <td>মোট জমা টাকা</td>

            <td>ব্যাগ পরিমান‌</td>
            <td>ফ্রি </td>
            <td>ম‌োট ব্যাগ পরিমান‌‌</td>
            <td>দর</td>
            <td>কমিশন</td>
            <td>মূল</td>
            <td style="display: none;">অবশিষ্ট</td>
            <td style="display: none;">মোট মূলঃ</td>
            <td>ওজন (এম,টি )</td>


          </tr>
          <tr>
            <td>
              <!-- <input type="text" name="customer_id" class="form-control-balu" id="customer_id" placeholder="Enter customer_id..."> -->
              <?php
              $sql = "SELECT * FROM cement_dealer WHERE project_name_id ='$project_name_id'";
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
            <!-- <td>
            <select id="type" name="type" class="form-control-balu" style="width: 160px;">
              <option value="balu">balu</option>
              <option value="cement">cement</option>
            </select>
             <input id="button1" type="button" value="Click!" /> 
          </td> -->








            <!-- <td> -->
            <!-- <input type="text" name="delear_id" class="form-control-balu" id="delear_id" placeholder="Enter delear_id..."> -->
            <?php
            // $sql = "SELECT dealer_id FROM dealers";
            // $all_custmr_id = $db->select($sql);
            // echo '<select name="delear_id" id="delear_id" class="form-control-balu" style="width: 140px;">';
            //   echo '<option value="">Select...</option>';
            //   if($all_custmr_id->num_rows > 0){
            //       while($row = $all_custmr_id->fetch_assoc()){
            //         $id = $row['dealer_id'];
            //         echo '<option value="' . $id . '">' . $id . '</option>';
            //       }
            //     } else{
            //       echo '<option value="none">0 Result</option>';
            //     }
            //   echo '</select>';
            ?>
            <!-- </td> -->

            <td>
              <input type="text" name="driver_name" class="form-control-cement" id="driver_name" placeholder="Driver name...">
            </td>
            <td>
              <input type="text" name="motor_name" class="form-control-cement" id="motor_name" placeholder="Motor name...">
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


            <?PHP
            $sql = "SELECT sl FROM details_cement ORDER BY id DESC LIMIT 1";
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


            <!-- <td>
            <input type="text" name="sl_no" class="form-control-cement" id="sl_no" value="<?php echo $newId ?>" placeholder="Enter sl no..." style="">
          </td> -->

            <td>
              <input type="text" name="sl_no" class="form-control-cement" id="sl_no" placeholder="Sl no...">
            </td>
            <td>
              <input type="text" name="address" class="form-control-cement" id="address" placeholder="Address..." pattern="[a-zA-Z0-9-\s]+" required>
            </td>
            <td>
              <input type="text" name="customer_id" class="form-control-cement" id="customer_id" placeholder="Customer id">
            </td>
            <td>
              <input type="text" name="challan_no" class="form-control-cement" id="challan_no" placeholder="Challan no..." required>
            </td>
            <td>
              <input type="text" name="motor_no" class="form-control-cement" id="motor_no" placeholder="Motor sl...">
            </td>
            <td>
              <input type="text" name="motor" class="form-control-cement" id="motor" placeholder="Motor...">
            </td>
            <td>
              <input type="text" name="oil_free" class="form-control-cement" id="oil_free" placeholder="Oil free...">
            </td>
            <td>
              <input type="text" name="oil_sell" class="form-control-cement value-calc" id="oil_sell" placeholder="Oil para...">
            </td>

            <td>
              <input onkeypress="datecheckformat(event)" type="text" name="challan_date" class="form-control-cement" id="delivery_date" placeholder="dd-mm-yyyy">
            </td>
            <td>
              <input onkeypress="datecheckformat(event)" type="text" name="so_date" class="form-control-cement" id="dates2" placeholder="dd-mm-yyyy">
            </td>
            <td>
              <input onkeypress="datecheckformat(event)" type="text" name="dates" class="form-control-cement" id="dates" placeholder="dd-mm-yyyy">
            </td>
            <td>
              <input type="text" name="partculars" class="form-control-cement" id="partculars" placeholder="Marfot...">
            </td>

            <td>
              <?php
              // var parti_val = $('#car_rent_redeem').val();
              $sql = "SELECT DISTINCT category_name,category_id FROM cement_category WHERE  category_name != ''";
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
              <input type="text" onkeypress="return isNumber(event)" name="debit" class="form-control-cement value-calc" id="debit" placeholder="Debit...">
            </td>

            <td>
              <input type="text" onkeypress="return isNumber(event)" name="monthly_com" class="form-control-cement value-calc" id="monthly_com" placeholder="Monthly commission...">
            </td>

            <td>
              <input type="text" onkeypress="return isNumber(event)" name="yearly_com" class="form-control-cement value-calc" id="yearly_com" placeholder="Yearly commission...">
            </td>
            <td>
              <input type="text" onkeypress="return isNumber(event)" name="debit2" class="form-control-cement value-calc" id="debit2" placeholder="Debit...">
            </td>
            <td>
              <input type="text" onkeypress="return isNumber(event)" name="count" class="form-control-cement value-calc" id="count" placeholder="Count...">
            </td>

            <td>
              <input type="text" onkeypress="return isNumber(event)" name="fee" class="form-control-cement value-calc" id="fee" placeholder="Fee...">
            </td>
            <td>
              <input type="text" onkeypress="return isNumber(event)" name="count2" class="form-control-cement value-calc" id="count2" placeholder="Count...">
            </td>

            <td>
              <input type="text" onkeypress="return isNumber(event)" name="paras" class="form-control-cement value-calc" id="paras" placeholder="Paras per ton...">
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
              <input type="text" name="total_credit" class="form-control-cement value-calc" id="total_credit" placeholder="Total credit...">
            </td>
            <td>
              <input type="text" onkeypress="return isNumber(event)" name="weight" name="weight" class="form-control-cement value-calc" id="weight" placeholder="Weight ( MT )...">
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
  $sql = "SELECT * FROM details_cement WHERE dealer_id='$dealerId' AND project_name_id = '$project_name_id'";
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
                <th>Dealer ID:</th>
                <th>Driver Name</th>
                <th>Motor Name</th>

                <th>Motor Cash</th>
                <th>Unload</th>
                <th>Cars rent & Redeem</th>
                <th>Information</th>
                <th>SL</th>
                <th>Address</th>
                <th>Customer Id</th>
                <th>Challan No.</th>
                <th>Motor SL</th>
                <th>Motor Number</th>
                <th>Oil free</th>
                <th>Oil para's</th>
                <th>Challan Date</th>
                <th>SO Date</th>
                <th>Date</th>
                <th>Partculars</th>
                <th>Particulars</th>
                <th>Debit</th>
                <th>Monthly Commission</th>
                <th>Yearly Commission</th>
                <th>Total Deposit money</th>
                <th>Bag Count</th>
                <th>Free</th>
                <th>Total Bag Count</th>

                <th>Para's</th>
                <th>Discount</th>
                <th>Credit</th>
                <th>Balance</th>
                <th>Total Credit</th>
                <th>Weight (MT)</th>
                <th></th>
                <th class='no_print_media'></th>
                <th class='no_print_media'></th>
              </tr>
              <tr>
                <th>ডিলার আই ডি</th>
                <!-- <td>ডিলার আই ডি</td> -->
                <!-- <td>টাইপ</td> -->

                <!-- <td>মালের বিবরণ</td> -->
                <th>ড্রাইভারের নাম</th>
                <th>গাড়ী নাম</th>

                <th>গাড়ী ভাড়া</th>
                <th>খালাস</th>
                <th>গাড়ী ভাড়া ও খালাস</th>
                <th>মালের বিবরণ</th>

                <th>ক্রমিক নং</th>
                <th>ঠিকানা</th>
                <th>কাস্টমার আই ডি</th>
                <th>ভাউচার নং</th>
                <th>গাড়ী নং</th>
                <th>গাড়ী নাম্বার</th>
                <th>তেল ফ্রি</th>
                <th>তেল মূলঃ</th>

                <th>ভাউচার তারিখ</th>
                <th>অর্ডার তারিখ</th>
                <th>তারিখ</th>
                <th>মারফ‌োত নাম</th>
                <th>ব‌িবরণ</th>

                <th>জমা টাকা</th>
                <th>মাসিক কমিশন</th>
                <th>বাৎসরিক কমিশন</th>
                <th>মোট জমা টাকা</th>
                <th>ব্যাগ পরিমান‌</th>
                <th>ফ্রি </th>
                <th>ম‌োট ব্যাগ পরিমান‌</th>
                <th>দর</th>
                <th>কমিশন</th>
                <th>মূল</th>
                <th>অবশিষ্ট</th>
                <th>মোট মূলঃ</th>
                <th>ওজন (এম,টি )</th>
                <th></th>
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
                echo "<td>" . $rows['dealer_id'] . "</td>";
                echo "<td>" . $rows['driver_name'] . "</td>";
                echo "<td>" . $rows['motor_name'] . "</td>";
                echo "<td>" . $rows['motor_vara'] . "</td>";
                echo "<td>" . $rows['unload'] . "</td>";
                echo "<td>" . $rows['cars_rent_redeem'] . "</td>";
                echo "<td>" . $rows['information'] . "</td>";
                echo "<td>" . $rows['sl'] . "</td>";
                echo "<td>" . $rows['address'] . "</td>";
                echo "<td>" . $rows['customer_id'] . "</td>";
                echo "<td>" . $rows['challan_no'] . "</td>";

                echo "<td>" . $rows['motor_sl'] . "</td>";
                echo "<td>" . $rows['motor_no'] . "</td>";
                echo "<td>" . $rows['oil_free'] . "</td>";
                echo "<td>" . $rows['oil_sell'] . "</td>";
                // echo "<td>" . $format_challan_date . "</td>";
                echo "<td>" . $rows['challan_date'] . "</td>";
                echo "<td>" . $rows['so_date'] . "</td>";
                echo "<td>" . $format_dates . "</td>";
                echo "<td>" . $rows['partculars'] . "</td>";
                echo "<td>" . $rows['particulars'] . "</td>";
                echo "<td>" . $rows['debit'] . "</td>";
                echo "<td>" . $rows['monthly_com'] . "</td>";
                echo "<td>" . $rows['yearly_com'] . "</td>";
                echo "<td>" . $rows['debit2'] . "</td>";
                echo "<td>" . $rows['count'] . "</td>";
                echo "<td>" . $rows['fee'] . "</td>";
                echo "<td>" . $rows['count2'] . "</td>";
                echo "<td>" . $rows['paras'] . "</td>";
                echo "<td>" . $rows['discount'] . "</td>";
                echo "<td>" . $rows['credit'] . "</td>";
                echo "<td>" . $rows['balance'] . "</td>";
                echo "<td>" . $rows['total_credit'] . "</td>";
                echo "<td>" . $rows['weight'] . "</td>";

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

  <script>
    // function myFunction() {
    //   document.getElementById("demo").innerHTML = "Hello World";
    // }
  </script>

</body>

</html>