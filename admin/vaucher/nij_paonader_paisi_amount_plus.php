<?php 
session_start();
if(!isset($_SESSION['username']) ){    
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';

$db = new Database();
$sucMsg = '';
$project_name_id = $_SESSION['project_name_id'];
$data_id = $_GET['data_id'];

if(isset($_POST['insertUpdateBtn'])) {
    $postDateArr  = explode('/', $_POST['nij_paona_date']);
    $dates        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $amount = trim($_POST['amount']);
    $nij_id = $_POST['nij_id']; //use only for update
    $insertUpdateBtn = $_POST['insertUpdateBtn'];
    // echo $insertUpdateBtn;
    if($amount == ''){
        $amount = 0;
    }
    if($insertUpdateBtn == 'Save Peyesi Amount'){
        $query = "INSERT INTO entry_nij_paonadar (nij_name,  nij_description, nij_amount, nij_date, nij_status, nij_paonadar_id, project_name_id) VALUES ('$name', '$description', '$amount', '$dates', 'add', '$data_id', '$project_name_id')";
        $insert = $db->update($query);
        if ($insert) {
            $sucMsg = 'Data Insert Successfully!';
        } else {
            $sucMsg = 'Failed to Insert Data!';
        }
        // header("Location:nij_paonader_paisi_amount.php?data_id=$data_id");
    } else {
          $query = "UPDATE entry_nij_paonadar SET nij_name='$name', nij_description='$description', nij_amount = '$amount', nij_date = '$dates' WHERE nij_id = '$nij_id' AND nij_paonadar_id = '$data_id' AND project_name_id = '$project_name_id'";
          $update = $db->update($query);
          if ($update) {
              $sucMsg = 'Data Updated Successfully!';
          } else {
              $sucMsg = 'Failed to Updated Data!';
          }
          // header("Location:nij_paonader_paisi_amount.php?data_id=$data_id");        
    }
}

if(isset($_GET['row_id'])){
    // echo '<script>' . $_GET['row_id'] . '</script>';
    $row_id = $_GET['row_id'];
    $sql = "DELETE FROM entry_nij_paonadar WHERE nij_id = '$row_id' AND nij_paonadar_id ='$data_id' AND project_name_id = '$project_name_id'";
    $delete = $db->delete($sql);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nij paonader paisi amount +</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <style type="text/css">
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
    }
    .table > thead > tr > th {
        border-bottom: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd !important;
    }
    .cancelBtn{
      float: right;
    }
    .headingOfAllProject {
        margin: 16px 0px 10px;
        min-height: 32px;
        padding-bottom: 8px;
        /*border-bottom: 1px solid #A54686 !important;*/
        font-size: 25px;
        line-height: 20px;
        text-align: center;
    }
    .headingOfAllProject:before {
       content: none;
    }
  </style>
</head>
<body>
    <?php
      include '../navbar/header_text.php';
      include '../navbar/navbar.php';    
      ?> 
      <div class="container">
          <?php
              $ph_id = $_SESSION['project_name_id'];
              $query = "SELECT * FROM project_heading WHERE id = '$ph_id'";
              $show = $db->select($query);
              if ($show) {
                while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading text-center">      
                        <h2 class="headingOfAllProject"><?php echo $rows['heading']; ?></h2>
                        <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
                    </div>
                <?php 
                }
              } 
          ?>

          <form action="" method="POST" onsubmit="return validation()">
              <?php
                  $sql = "SELECT * FROM nij_paonadar WHERE id = '$data_id' AND project_name_id = '$project_name_id'";
                  $nij_paonadar = $db->select($sql);
                  if(mysqli_num_rows($nij_paonadar) == 1){
                      $table_row = $nij_paonadar->fetch_assoc();

                      $name_read_only = $table_row['name'];
                      $description_read_only = $table_row['description'];
                      // $amount_read_only = $table_row['amount'];
                      // $nij_paona_date_read_only = $table_row['nij_paona_date'];
                  }
              ?>
              <table class="table table-bordered table-condensed" id="dynamic_field">
                  <thead>
                    <tr>
                      <th class="text-center bg-primary" colspan="4" ???>???????????????????????? ???????????? (+) ?????????????????????</th>
                    </tr>
                    <tr>
                      <th class="text-center" width="120px">???????????????</th>
                      <th class="text-center">????????? ???????????? ???????????? ????????? ?????????</th>
                      <th class="text-center">???????????????</th>
                      <th class="text-center" width="200px">????????????</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td><input type="text" name="nij_paona_date" class="form-control text-center" value="" id="nij_paona_date" placeholder="dd/mm/yy" /></td>
                        <td><input type="text" name="name" class="form-control" size="100" value="<?php echo $name_read_only; ?>" id="name" placeholder="????????? ???????????? ???????????? ????????? ?????????" readonly/></td>
                        <td><input type="text" name="description" class="form-control" size="100" value="<?php echo $description_read_only; ?>" id="description" placeholder="???????????????" readonly/></td>
                        <td><input type="text" name="amount" class="form-control" size="100" value="" id="amount" placeholder="????????????" /></td>
                      </tr>
                  </tbody>
              </table>
              <div class="form-group">
                  <input type="submit" class="form-control btn btn-primary" name="insertUpdateBtn" value="Save Peyesi Amount" id="insertUpdateBtn">
                  <input type="hidden" class="" name="nij_id" value="0" id="nij_id">
              </div>
              <div class="form-group">
                  <h4 id="updateMsg" class="text-center text-success"><?php echo $sucMsg; ?></h4>
                  <input type="button" name="" class="btn btn-danger cancelBtn" value="Cancel" onclick="page_redirect()">
              </div>
          </form>

          <?php            
              echo '<table class="table table-bordered" width="100%" style="margin: 30px 0px 80px; float: left;">';

              $sql = "SELECT * FROM nij_paonadar WHERE id = '$data_id' AND project_name_id = '$project_name_id'";
              $nij_paonadar = $db->select($sql);
              if(mysqli_num_rows($nij_paonadar) == 1){
                  $table_row = $nij_paonadar->fetch_assoc();

                  $name = trim($table_row['name']);
                  $description = trim($table_row['description']);
                  $amount = trim($table_row['amount']);
                  if($amount == ''){
                      $amount = 0;
                  }
                  $nij_paona_date = $table_row['nij_paona_date'];                  
                  echo '<tr>';
                      echo '<td class="text-center">??????????????? = </td>';
                      echo '<td>'. date("d/m/Y", strtotime($nij_paona_date)).'</td>';
                      echo '<td>'.$name.'</td>';
                      echo '<td>'.$description.'</td>';
                      echo '<td data_amount="'.$amount.'" id="total_amount_id">'.number_format($amount, 2) .'</td>';
                      echo '<td colspan="2"></td>';
                  echo '</tr>';
              }
              

              $query = "SELECT * FROM entry_nij_paonadar WHERE nij_paonadar_id = '$data_id' AND nij_status ='add' AND project_name_id = '$project_name_id' ORDER BY nij_date DESC";
              $show = $db->select($query);
              echo '<tr align="center" class="bg-primary">';
                  echo '<td width="75px">?????????????????? ??????</td>';
                  echo '<td width="85px">???????????????</td>';
                  echo '<td style="width: 440px;">????????? ???????????? ???????????? ????????? ?????????</td>';
                  echo '<td>???????????????</td>';
                  echo '<td>????????????</td>';
                  echo '<td width="50px">Delete</td>';
                  echo '<td width="60px">Edit</td>';
              echo '</tr>';
              $i = 1;
              $total_amount = 0;
              while($data = $show->fetch_assoc()) {
                  $nij_id =  trim($data['nij_id']);
                  $nij_name =  trim($data['nij_name']);
                  $nij_description =  trim($data['nij_description']);
                  $nij_amount =  trim($data['nij_amount']);
                  $nij_date =  $data['nij_date'];
                  $nij_paonadar_id = trim($data['nij_paonadar_id']);

                  $total_amount += $nij_amount;
                    echo '<tr>';
                      echo '<td class="text-center">' . $i .'</td>';
                      echo '<td>' . date("d/m/Y", strtotime($nij_date)) .'</td>';
                      echo '<td>' . $nij_name .'</td>';
                      echo '<td>' . $nij_description .'</td>';
                      echo '<td data_amount ="'.$nij_amount.'" class="single_amount_class">+ ' . number_format($nij_amount, 2) .'</td>';
                      echo '<td class="text-center"><button class="btn btn-danger entry_delete" row_id="' . $nij_id . '" data_id ="' . $data_id . '">-</button></td>';
                      echo '<td class="text-center"><button class="btn btn-success" row_id="' . $nij_id . '" onclick="display_update(this)">Edit</button></td>';
                    echo '</tr>';
                  $i++;          
              }
              if(mysqli_num_rows($show) > 0) {
                  echo '<tr>';
                    echo '<td colspan="4" class="text-right">????????? ?????????????????? = </td>';
                    echo '<td>'. number_format($total_amount, 2) .'</td>';
                    echo '<td colspan="2"></td>';
                  echo '</tr>';
                  $balance = $amount + $total_amount;
                  echo '<tr>';
                    echo '<td colspan="4" class="text-right">??????????????????????????? = </td>';
                    echo '<td>'. number_format($balance, 2) .'</td>';
                    echo '<td colspan="2"></td>';
                  echo '</tr>';
              }            
              echo '</table>';
          ?>
      </div>
      <?php include '../others_page/delete_permission_modal.php';  ?>
  <script type="text/javascript">
      function validation(){
          validReturn = false;

          //     var mName   = $('#mName').val();
          //     var mAmount = $('#mAmount').val();
          //     // alert(mName +"  "+ mAmount);
          //     if(mName == ""){
          //         alert("????????????????????? ????????? ??????????????? ????????? ?????? !");
          //         $('#mName').focus();
          //         validReturn = false;
          //     } else if(mName.length > 100){
          //         alert("????????????????????? ????????? ????????? ????????????????????? ???????????? ????????? ?????? !");
          //         $('#mName').focus();
          //         validReturn = false;
          //     } else if($.isNumeric(mName)){
          //         alert("????????????????????? ????????? ?????????????????? ????????? ???????????? ?????? !");
          //         $('#mName').focus();
          //         validReturn = false;
          //     } else {
          //       if(mAmount == ""){
          //             alert("????????? ??????????????? ????????? ?????? ! ????????? ?????? ??????????????? ??? ???????????? ???");
          //             $('#mAmount').focus();
          //             validReturn = false;
          //         } else if(!$.isNumeric(mAmount)){
          //             alert("????????? ?????????????????? ?????????????????? ????????? ????????? ???");
          //             $('#mAmount').focus();
          //             validReturn = false;
          //         } else {
          //           validReturn = true;
          //         }
          //     }


          // var submitVal = $("#insertUpdateBtn").val();
          // var total = 0;
          // var sub_total = 0;
          // total += parseInt($("#total_amount_id").attr("data_amount"));          
          // // alert(total);
          // $(".single_amount_class").each(function() {
          //     sub_total += parseInt($(this).attr("data_amount"));            
          // });
          // // alert(sub_total);
          // var amount = parseInt($("#amount").val().trim());
          // if(isNaN(amount)){
          //     amount = 0;
          // }
          // if(submitVal == 'Save Peyesi Amount'){              
          //     sub_total += amount;
          //     if(total >= sub_total){
          //         validReturn = true;
          //     } else {
          //         var extra_amount = sub_total - total;
          //         $("#updateMsg").html('Total entry amount can not greater than ' + total +'.00 !  Here, extra amount is ' + extra_amount + '.00 .');
          //     }
          // } else {
          //     sub_total -= parseInt($("#amount").attr("update_base_amount"));
          //     sub_total += amount
          //     if(total >= sub_total){
          //         validReturn = true;
          //     } else {
          //         var extra_amount = sub_total - total;
          //         $("#updateMsg").html('Total entry amount can not greater than ' + total +'.00 !  Here, extra amount is ' + extra_amount + '.00 .');
          //     }
          // }
          


          // if(validReturn){
          //     return true;
          // } else {
          //     return false;
          // }
      }
  </script>
  <script type="text/javascript">
      // var text = $('#updateMsg').html();
      // if(text == 'Data Updated Successfully!'){
      //   // alert(text);
      //   function sample(){
      //     window.location.href = 'modify_vaucher.php';
      //   }
      //   setTimeout(sample, 1000);
        
      // }

      function display_update(ele){
          var nij_date = $(ele).closest('tr').find('td').eq(1).text();
          var nij_name = $(ele).closest('tr').find('td').eq(2).text();
          var nij_desc = $(ele).closest('tr').find('td').eq(3).text();
          var nij_amount = $(ele).closest('tr').find('td').eq(4).text();
            var arr = nij_amount.split('.');
            var arr2 = arr[0].split(',');
            // console.log(arr2);
            var amount = '';
            for ( var i = 0; i < arr2.length; i++){                
                amount += arr2[i];
                // console.log(amount + '='+i);
            }
          var nij_id = $(ele).attr('row_id');
          // console.log(nij_id);

          $('#nij_paona_date').val(nij_date).change();
          $('#name').val(nij_name);
          $('#description').val(nij_desc);
          $('#amount').val(amount);
          $('#nij_id').val(nij_id);          
          $('#insertUpdateBtn').val('Update Peyesi Amount');
          $('html,body').animate({ scrollTop: 0 }, 'slow');

          $('#amount').attr('update_base_amount', amount);
          $("#updateMsg").html('');
      }



      $(document).on('click', '.entry_delete', function(event){          
          var row_id = $(event.target).attr('row_id');
          var data_id = $(event.target).attr('data_id');
          $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
          $("#matchPassword").val('');
          $("#passMsg").html('');
          $("#verifyToDeleteBtn").attr("row_id", row_id).attr("data_id", data_id);
      });
      
      $(document).on('click', '#verifyToDeleteBtn', function(event){
          var row_id = $(event.target).attr('row_id');
          var data_id = $(event.target).attr('data_id');
          console.log(row_id); console.log(data_id);

          $("#passMsg").html("").css({'margin':'0px'});          
          var pass = $("#matchPassword").val();
          $.ajax({
              url: "../ajaxcall/match_password_for_vaucher_credit.php",
              type: "post",
              data: { pass : pass },
              success: function (response) {
                  // alert(response);
                  if(response == 'password_matched'){
                      $("#verifyPasswordModal").hide();
                      ConfirmDialog('Are you sure delete paonader entry info?');
                  } else {
                      $("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
                  }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
          function ConfirmDialog(message){
              $('<div></div>').appendTo('body')
                              .html('<div><h4>'+message+'</h4></div>')
                              .dialog({
                                  modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                  width: '40%', resizable: false,
                                  position: { my: "center", at: "center center-20%", of: window },
                                  buttons: {
                                      Yes: function () {
                                          $(this).dialog("close");
                                          $.get("nij_paonader_paisi_amount_plus.php?data_id="+data_id+"&row_id="+row_id, function(data, status){
                                            // console.log(status);
                                            if(status == 'success'){
                                                window.location.href = "nij_paonader_paisi_amount_plus.php?data_id="+data_id;
                                            }
                                          });
                                      },
                                      No: function () {
                                          $(this).dialog("close");
                                      }
                                  },
                                  close: function (event, ui) {
                                      $(this).remove();
                                  }
              });
          };
      });
  </script>
  <script type="text/javascript" id="script-1">
      $(function() {
        $('#nij_paona_date').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd/mm/yy",
            changeYear: true,
        }).datepicker("setDate", new Date());
      });
  </script>
  <script type="text/javascript">
      function page_redirect(){
          window.location.href = 'modify_vaucher.php';
      }
  </script>
  <script type="text/javascript">
    $(document).on("click", ".kajol_close, .cancel", function(){
        $("#verifyPasswordModal").hide();
    });
  </script>
</body>
</html>
