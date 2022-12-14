<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  

  $rod_details_id = $_POST['rod_details_id'];

  if(isset($rod_details_id)){

   
    $sql = "SELECT id,dealer_id,particulars FROM details_brick WHERE id = '$rod_details_id'";
    $show = $db->select($sql);
    if ($show) {
      while ($rows = $show->fetch_assoc()) {
        $del_id = $rows['id'];
        $del_dealer = $rows['dealer_id'];
        $del_parti = $rows['particulars'];
      }
     // $sql_st_del = "UPDATE stocks_cement SET `ton` = `ton` - '$del_ton' WHERE partculars ='$del_part' AND particulars ='$del_parti' AND `ton` - '$ton' >= 0 ORDER BY ton DESC LIMIT 1";
      // $sql_update = "UPDATE stocks_balu SET `ton` = `ton` - '$del_ton' WHERE partculars ='$del_part' AND particulars ='$del_parti' AND `ton` - '$ton' >= 0 ORDER BY ton DESC LIMIT 1";
      $sql_st_del = "DELETE FROM stocks_brick WHERE dealer_id = '$del_dealer'";
      $result2 = $db->select($sql_st_del);
      if ($result2) {
        echo "stocks deleted  Successfully.";
      }
    }


      $sql = "DELETE FROM details_brick WHERE id = '$rod_details_id'";
      if ($db->select($sql) === TRUE) {
        $sucDel = "Details entry deleted successfully.";
        echo $sucDel;
      } else {
        echo "Error: " . $sql . "<br>" .$db->error;
      }
  }

?>