    <?php 

require '../config/config.php';
require '../lib/database.php';
$db = new Database();

?>

<!-- total calculation section -->

<?php 
$sql_qry="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit ";

$credit = $db->select($sql_qry);
while($credit_record = $credit->fetch_array()){
  $credit_total = $credit_record['total_credit'];
}


$sql_qry_due_credit="SELECT SUM(due_credit_amount) AS total_due_credit FROM due ";

$due_credit = $db->select($sql_qry_due_credit);
while($due_credits = $due_credit->fetch_array()){
  $total_due_credit = $due_credits['total_due_credit'];
}

$total = 0;
$total_due = 0;
$all_debit_due  = 0;
$total_pabe_amount = 0;
$total_p_amount = 0;
$deu_pay_total = 0;


$sql_qry_due_debit="SELECT SUM(due_debit_amount) AS total_due_debit FROM due ";

$due_debit = $db->select($sql_qry_due_debit);
while($due_debits = $due_debit->fetch_array()){
  $total_due_debit = $due_debits['total_due_debit'];
}

$remain_credit = $credit_total + $total_due_credit;

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="../js/jquery-printme.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    function myFunction() {
      window.print();
    }
  </script>
  <script>
      $("#noprint").click(function(){
      /*$('.print-hide').hide();
      $("#values").show().printMe();*/
      alert('warning');
    });
    function click(){
      alert('warning');
      /*$("#values").show().printMe();*/
    }
    
  </script>
  <style type="text/css">
  	#borderless-cell { border: 1px solid Transparent!important; }
  	#noborders {border: none!important;}
  	.padding{padding: 20px!important;}
    @media print {
      /* Remove print button from hard copy */
      #noprint { visibility: hidden; }
    }
  </style>
  <style type="text/css">
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 2px;
    }
    .width_5px{
      width: 5px;
    }
    .width_35px{
      width: 35px;
    }
    .width_85px{
      width: 85px;
    }
    .width_100px{
      width: 100px;
    }
    .width_200px{
      width: 200px;
    }
    .width_300px{
      width: 300px;
    }
  </style>
  <style type="text/css">
    @media print {
        .table>tbody>tr.success>td, .table>tbody>tr.success>th, .table>tbody>tr>td.success, .table>tbody>tr>th.success, .table>tfoot>tr.success>td, .table>tfoot>tr.success>th, .table>tfoot>tr>td.success, .table>tfoot>tr>th.success, .table>thead>tr.success>td, .table>thead>tr.success>th, .table>thead>tr>td.success, .table>thead>tr>th.success {
        background-color: #0070C0 !important;
        color: white !important;
       -webkit-print-color-adjust: exact;
      }
      .width_100px{
      	width: 150px !important;
      }
      .width_200px {
          width: 250px !important;
      }
      .width_300px {
          width: 350px !important;
      }
      .table>tbody>tr.active>td, .table>tbody>tr.active>th, .table>tbody>tr>td.active, .table>tbody>tr>th.active, .table>tfoot>tr.active>td, .table>tfoot>tr.active>th, .table>tfoot>tr>td.active, .table>tfoot>tr>th.active, .table>thead>tr.active>td, .table>thead>tr.active>th, .table>thead>tr>td.active, .table>thead>tr>th.active {
          background-color: #00B050 !important;
          color: white !important;
      }
      body {
    	font-weight: bold !important;
      }
      .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
       border: 3px solid black !important;
      }
      a[href]:after {
       content: none !important;
      }

      #pageFooter {
          display: table-footer-group;
      }

      #pageFooter:after {
          counter-increment: page;
          content:"Page 0" counter(page);
          
      }
    }
  </style>
  <style type="text/css">

  </style>
</head>
<body>

<div class="container" id="">

  <?php include '../navbar/navbar.php'; ?>  

  <?php 
      $sql="select * from vaucher_credit";
      $p_read = $db->select($sql);
      $data=array();
      $size=0;
      if($p_read){
        while ($row= $p_read->fetch_assoc()) {
            $data[$size]['credit_name']= $row['credit_name']; 
            $data[$size]['credit_amount']= $row['credit_amount']; 
            $size++;
        }
      }
  ?> 
  <?php 
      $sqls="select * from nij_paonadar";
      $p_reads = $db->select($sqls);
      $datas=array();
      $sizes=0;
      if($p_reads){
        while ($rows= $p_reads->fetch_assoc()) {
            $datas[$sizes]['id']= $rows['id'];
            $datas[$sizes]['name']= $rows['name'];
            $datas[$sizes]['description']= $rows['description'];
            $datas[$sizes]['amount']= $rows['amount'];
            $sizes++;
        }
      }
  ?>
   <p class="text-center"><button href="#" onclick="myFunction()" class="btn btn-info" id="noprint">Print</button></p> 
  <!-- <p class="text-center"><button href="#" onclick="click()" class="btn btn-info" id="noprint">Print</button></p> -->
  <div class="print" id="values">
    <!-- project_heading modify section -->
    <?php 
      $query = "SELECT * FROM project_heading";
      $show = $db->select($query);
      if ($show) 
      {
        while ($rows = $show->fetch_assoc()) 
        {
    ?>
    <div class="project_heading text-center">
      <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
      <h4 class="text-center"><?php echo $rows['subheading']; ?></h4>
    </div>
  <?php 
        }
      } 
  ?>

  <!--  date section  -->
  <?php
      // $day_query = "SELECT * FROM day_field ORDER BY id DESC LIMIT 1";
      $day_query = "SELECT * FROM day_field ORDER BY id DESC";
      
      $day_read = $db->select($day_query);
      if ($day_read) 
      {
        while ($day_row = $day_read->fetch_assoc()) 
        {
    ?>
          <div class="project_heading text-center">
            <h5><?php echo $day_row['day']; ?></h5>
            <h5>
              <?php 

                $newdateformate = $day_row['date'];
                $newDate = date("d-m-Y", strtotime($newdateformate));
                echo $newDate; 
              ?>
                  
              </h5>
          </div>
          
    <?php  
        }
      }
    ?>



    <table class="table table-bordered" style="font-size: 12px;">
      <thead>
        <tr class="d-flex">
          <!-- <th class="col-3">Day</th> -->
        </tr>
      </thead>
    
      <thead id="noborders">
          <tr class="d-flex">
            <th class="active col-3 width_300px">কোম্পানির পাওনার নামঃ </th>
            <th class="active text-right width_5px">টাকাঃ</th>
            <!-- <th>বিবরণ</th> -->
            <th id="borderless-cell"></th>
            <th id="borderless-cell"></th>
            <th id="borderless-cell"></th>
            <th id="borderless-cell"></th>
            <th id="borderless-cell"></th>
            <th class="active width_100px">পাওনার নামঃ </th>
            <th class="active">বিবরণ</th>
            <th class="active text-right">টাকাঃ</th>
          </tr>
        </thead>
    <?php  
      $j = 0;
      $paona_query = "SELECT * FROM jara_pabe";
      $paona_read = $db->select($paona_query);
      if ($paona_read) 
      {
        while ($paona_row = $paona_read->fetch_assoc()) 
        {
    ?>
        <tbody id="noborders">
          <tr class="d-flex">
            <td class="col-3"><?php if($j<$sizes){echo $datas[$j]['name']; }?></td>
            <td class="text-right"><?php if($j<$sizes){echo $datas[$j]['amount']; $j++; }?></td>
            <td id="noborders"><?php //if($j<$sizes){echo $datas[$j]['description']; $j++; }?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td><?php echo $paona_row['pabe_name'] ?></td>
            <td><?php echo $paona_row['pabe_description'] ?></td>
            <td class="text-right"><?php echo $paona_row['pabe_amount'] ?></td>
          </tr>
        </tbody>
    <?php  
        }
      }
      while ($j < $sizes) { ?>

      <tbody id="noborders">
          <tr class="d-flex">
            <td class="col-3"><?php if($j<$sizes){echo $datas[$j]['name']; }?></td>
            <td class="text-right"><?php if($j<$sizes){echo $datas[$j]['amount']; $j++; }?></td>
            <td id="noborders"><?php //if($j<$sizes){echo $datas[$j]['description']; $j++; }?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td></td>
            <td></td>
            <td></td>
            <td id="borderless-cell"></td>
          </tr>
        </tbody>

  <?php }  ?>

      <thead>
        <tr class="active">
          <th class="col-3">জমা মারফোত নামঃ </th>
          <th class="text-right">জমাঃ</th>
          <th class="width_200px">খরচের মারফোত নামঃ </th>
          <th class="width_200px">বিবরণ নামঃ</th>
          <th class="text-right">দরঃ</th>
          <th class="text-right width_100px">জনঃ</th>
          <th class="text-right width_100px">মোট টাকাঃ</th>
          <th class="text-right">নগদ পরি‌ষদঃ</th>
          <th class="text-right width_5px">জমাঃ</th>
          <th class="text-right">জেরঃ </th>
        </tr>
      </thead>

  <?php 
    $i=0;
    $query = "SELECT * FROM debit_group";
    $read = $db->select($query);
    if ($read) 
    {
      while ($row = $read->fetch_assoc()) 
      {
    ?>
        <tbody>
          <tr class="d-flex">
            <td class="col-3"><?php if($i<$size){echo $data[$i]['credit_name']; }?></td>
            <td class="text-right"><?php if($i<$size){echo $data[$i]['credit_amount']; $i++;}?></td>
            <td class="success"><?php echo $row['group_name']; ?></td>
            <td class="success"><?php echo $row['group_description']; ?></td>
            <td class="success text-right"><?php echo $row['taka']; ?></td>
            <td class="success text-right"><?php echo $row['pices']; ?></td>
            <td class="success text-right"><?php echo $row['total_taka']; ?></td>
            <td class="success text-right"><?php echo $row['total_bill']; ?></td>
            <td class="success text-right"><?php echo $row['pay']; ?></td>
            <td class="success text-right"><?php echo $row['due']; ?></td>
          </tr>
        </tbody>
    

      <!-- view debit group data from database -->
      <?php 
      $debit_group_id = $row['id'];

      $qrys = "UPDATE debit_group_data SET group_total_taka = group_taka * group_pices";
      $result = $db->update($qrys);

      $sql_qry_debit_due="SELECT SUM(group_total_taka) AS debit_due FROM debit_group_data WHERE group_id =$debit_group_id";
      $duration_debit_due = $db->select($sql_qry_debit_due);
      while($record_debit_due = $duration_debit_due->fetch_array()){
        $total_debit_due = $record_debit_due['debit_due'];
        $total += $total_debit_due;
      } 
      
      $sql_pabe_amount="SELECT SUM(pabe_amount) AS pabe_amount FROM jara_pabe";
      $duration_pabe_amount = $db->select($sql_pabe_amount);
      while($record_pabe_amount = $duration_pabe_amount->fetch_array()){
        $pabe_amount = $record_pabe_amount['pabe_amount'];
        $total_pabe_amount += $pabe_amount;
      } 
      
      $sql_qry_debit_group_pay="SELECT SUM(group_pay) AS group_pay FROM debit_group_data WHERE group_id =$debit_group_id";
      $duration_debit_group_pay = $db->select($sql_qry_debit_group_pay);
      while($record_debit_group_pay = $duration_debit_group_pay->fetch_array()){
        $group_pay = $record_debit_group_pay['group_pay'];
      }

      $debit_pay=$total_debit_due-$group_pay;
      $all_debit_due +=$debit_pay;
      $deu_pay_total=array();
   
      $qry = "SELECT * FROM debit_group_data WHERE group_id = $debit_group_id";
      $reads = $db->select($qry);
      if ($reads) 
      {
        $cnt=0;
        while ($row = $reads->fetch_assoc()) 
        {
          if($cnt==0){
            $deu_pay_total[$debit_group_id] = $row['group_pay'];
            $cnt++;
          }
    ?>


          <tbody>
            <tr class="d-flex">
              <td class="col-3"><?php if($i<$size){echo $data[$i]['credit_name']; }?></td>
              <td class="text-right"><?php if($i<$size){echo $data[$i]['credit_amount']; $i++;}?></td>
              <td><?php echo $row['group_name']; ?></td>
              <td><?php echo $row['group_description']; ?></td>
              <td class="text-right"><?php echo $row['group_taka']; ?></td>
              <td class="text-right"><?php echo $row['group_pices']; ?></td>
              <td class="text-right"><?php echo $row['group_taka'] * $row['group_pices']; ?></td>
              <td rowspan="4"><?php //echo $total_debit_due; ?></td>
              <td class="text-right"><?php  $row['group_pay']; ?></td>
              <td class="text-right"><?php echo $row['group_due']; ?></td>
            </tr>
          </tbody>

          


  <?php  

    }
  }

  ?>

        <tbody id="borderless-cell">
            <tr class="d-flex">
              <td class="col-3"><?php if($i<$size){echo $data[$i]['credit_name']; }?></td>
              <td class="text-right"><?php if($i<$size){echo $data[$i]['credit_amount']; $i++;}?></td>
              <td id="noborders"></td>
              <td id="noborders"></td>
              <td id="noborders"></td>
              <td id="noborders"></td>
              <td id="noborders"></td>
              <td class="text-right"><?php echo $total_debit_due; ?></td>
              <td class="text-right">
                <?php 
                if (!empty($deu_pay_total[$debit_group_id])) {
                  echo $deu_pay_total[$debit_group_id];
                }
              ?>
              </td>
              <td class="text-right"><?php echo $debit_pay=$total_debit_due-$group_pay ?></td>
            </tr>
          </tbody>


  <?php  

      }
    }
    while ($i < $size) { ?>

          <tbody>
            <tr>
              <td class="col-3"><?php if($i<$size){echo $data[$i]['credit_name']; }?></td>
              <td class="text-right"><?php if($i<$size){echo $data[$i]['credit_amount']; $i++;}?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
  <?php
    }

  ?>

      


  <?php 

  	$query = "SELECT due_credit_amount, due_debit_amount, due_debit_date FROM due";
  	$show = $db->select($query);
  	if ($show) 
  	{
  	  while ($rows = $show->fetch_assoc()) 
  	  {
  ?>
      <tbody>
  		<tr>
  		  <td>পূরব‌ের জে‌রঃ-</td>
  		  <td class="text-right"><?php echo $rows['due_credit_amount']; ?></td>
        <td id="borderless-cell"></td>
        <td id="noborders"></td>
        <td id="noborders"></td>
        <td id="noborders"></td>
  		  <!-- <td>তারিখঃ-</td>
        <td class="text-right"><?php echo $rows['due_debit_date']; ?></td> -->
  		  <td>পূরব‌ের পাওনাঃ-</td>
  		  <td class="text-right"><?php echo $rows['due_debit_amount']; ?></td>
  		  <td>পাওনাঃ-</td>
  		  <td class="text-right">
          <?php 
            if(!empty($all_debit_due) && !empty($pabe_amount)){
              echo $total_p_amount=$all_debit_due+$pabe_amount; 
            }else if(!empty($all_debit_due)){
              echo $total_p_amount=$all_debit_due; 
            }else if(!empty($pabe_amount)){
              echo $total_p_amount=$pabe_amount; 
            }
          ?>
        </td>
  		</tr>
  	</tbody>
  <?php  

    }
  }

  ?>	
      <tbody id="noborders">
  		<tr>
  		  <td>ম‌োট জমাঃ-</td>
  		  <td class="text-right"><?php echo $remain_credit; ?></td>
  		  <td id="noborders"></td>
        <td id="noborders"></td>
        <td id="noborders"></td>
  		  <td id="noborders"></td>
  		  <td>খরচঃ-</td>
  		  <td class="text-right"><?php echo $remain_debit  = $total + $total_due_debit; ?></td>
  		</tr>
  	</tbody>
  	<tbody id="borderless-cell">
  	    <tr>
  	      <td id="borderless-cell"></td>
  	      <td id="borderless-cell"></td>
  	      <td id="borderless-cell"></td>
          <td id="noborders"></td>
          <td id="noborders"></td>
  	      <td id="noborders"></td>
  	      <td><!-- Total Remain --> জের / পাওনাঃ-</td>
  	      <td class="text-right"><?php echo $result = $remain_credit - $remain_debit; ?></td>
  	    </tr>
  	</tbody>
    </table>
  </div>
</div>

</body>
</html>
