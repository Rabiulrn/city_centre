<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$project_name_id = $_SESSION['project_name_id'];
	$fromdate = $_POST['fromdate'];
	$todate	  = $_POST['todate'];
	// echo $fromdate;
	// echo $todate;	
    $nije_pabo_grand_total = 0;

    echo '<table class="tableshow" id="tableshow" style="border: 1px solid #ddd; border-collapse: collapse; font-size: 14px; width: 100%;">';
	if($fromdate == ''){
		// echo "<tr><td colspan='4' class='cenText'>Please set from date !</tr></td>";
		echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Please set from date !</tr></td>';
	} else if($todate == ''){
		// echo "<tr><td colspan='4' class='cenText'>Please set to date !</tr></td>";
		echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Please set to date !</tr></td>';
	} else {		
  		$fromdateNew 	= implode('-', array_reverse(explode('-', $fromdate)));
  		$todateNew 		= implode('-', array_reverse(explode('-', $todate)));		

  		// $query = "SELECT * FROM nij_paonadar WHERE nij_paona_date BETWEEN '$fromdateNew' AND '$todateNew' AND project_name_id = '$project_name_id'";
    //       $result = $db->select($query);
    //       $row_number = mysqli_num_rows($result);


        $query = "SELECT * FROM nij_paonadar WHERE project_name_id = '$project_name_id'";
        $result = $db->select($query);
        $main_row_number = mysqli_num_rows($result);
        $show_grand_total = 0;

        if ($result && $main_row_number > 0) {
            $i = 1;
            $row_count = 0;
            $no_data = $main_row_number;

            while ($row = $result->fetch_assoc()){
                $id = trim($row['id']);
                $name = trim($row['name']);
                $description = trim($row['description']);
                $amount = trim($row['amount']);
                $nij_paona_date = trim($row['nij_paona_date']);
                if($amount == ''){
                    $amount = 0;
                }

                $sql = "SELECT * FROM entry_nij_paonadar WHERE nij_date BETWEEN '$fromdateNew' AND '$todateNew' AND nij_paonadar_id ='$id' AND project_name_id = '$project_name_id' ORDER BY nij_date ASC";
                $rslt = $db->select($sql);
                // $row_count =0;
                // $found_row_print++;
                $sub_row_num = mysqli_num_rows($rslt);
                if($rslt && $sub_row_num > 0) {
                    echo "<tr style='background-color: #8e8e8e;'>";
                        echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $i . "</th>";
                        echo "<th style='border: 1px solid #ddd; padding:3px 10px;' width='100px'>" . date("d-m-Y", strtotime($nij_paona_date)) . "</th>";
                        echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $name . "</th>";
                        echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $description . "</th>";
                        echo "<th style='border: 1px solid #ddd; padding:3px 10px; text-align: left;'>" . number_format($amount, 2) . "</th>";
                    echo "</tr>";
                    // $row_count++;
                
                    while ($rslt_row = $rslt->fetch_assoc()) {
                        $nij_id = trim($rslt_row['nij_id']);
                        $nij_name = trim($rslt_row['nij_name']);
                        $nij_description = trim($rslt_row['nij_description']);
                        $nij_amount = trim($rslt_row['nij_amount']);
                        $nij_status = trim($rslt_row['nij_status']);
                        $nij_date = trim($rslt_row['nij_date']);
                        if($nij_amount == ''){
                            $nij_amount = 0;
                        }
                        if($nij_status == 'add'){
                          $amount += $nij_amount;
                          echo "<tr>";
                              echo "<td></td>";
                              echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($nij_date)) . "</td>";
                              echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $nij_name . "</td>";
                              echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $nij_description . "</td>";
                              echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>+ " . number_format($nij_amount, 2) . "</td>";                                        
                          echo "</tr>";
                        } else {
                          $amount -= $nij_amount;
                          echo "<tr>";
                              echo "<td></td>";
                              echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($nij_date)) . "</td>";
                              echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $nij_name . "</td>";
                              echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $nij_description . "</td>";
                              echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>- " . number_format($nij_amount, 2) . "</td>";                                        
                          echo "</tr>";
                        }
                        $show_grand_total = 1;
                    }
                
                    $balance = $amount;
                    $nije_pabo_grand_total += $amount;
                    echo "<tr><td colspan='4' style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>??????????????????????????????</td><td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($balance, 2) . "</td></tr>";
                    echo "<tr><td colspan='5' style='border: 1px solid #ddd; padding:3px 10px; border-left: 1px solid transparent; border-right: 1px solid transparent;'>&nbsp;</td></tr>";
                    $i++;
                    $row_count++;
                } else {
                	// if($row_count == 0){
                 //        if($oneTimePrintNotFound == 0){
                 //            if($found_row_print == 0){
                 //                echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Data is not found !</td></tr>';
                 //                $row_count++;
                 //                $oneTimePrintNotFound++;
                 //            }
                 //        }
                 //    }
                    if($main_row_number == 1 && $sub_row_num == 0){
                        echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Data is not found !</td></tr>';
                        $show_grand_total == 0;
                        $no_data--;
                    } else if($sub_row_num == 0){
                        $no_data--;
                        if($no_data == 0 && $row_count == 0){
                            echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Data is not found !</td></tr>';
                            $show_grand_total == 0;
                        }
                    } else if($sub_row_num > 0){
                        if($row_count == 0){
                            echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Data is not found !</td></tr>';
                            $show_grand_total == 0;
                        }
                    }
                }
            }
            if($show_grand_total == 1) {
                echo "<tr><td colspan='4' style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'><b>Ground Total:</b></td><td><b>". number_format($nije_pabo_grand_total, 2) ."</b></td></tr>";
            }
        } else {
            echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Data is not found !</tr></td>';
        }
	}
  echo '</table>';
?>

	




