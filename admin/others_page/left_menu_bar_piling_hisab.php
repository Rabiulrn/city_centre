<!-- Left menu bar con -->
<div id="left_all_menu_con">
    <a class="header_mnu_left" href="../vaucher/piling_index.php" >
        <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
        পাইলিং হিসাব
    </a>
    <?php
        if($_SESSION['balu_kroy_hisab'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'piling_kroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/piling_details_entry.php">
                <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
                পাইলিং জমা হিসাব
            </a>
            <?php
         }

         if($_SESSION['balu_category'] == 'yes'){
            ?> 
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'piling_hisab_entry'){echo 'mnu_active';}?>" href="../vaucher/piling_hisab_entry.php">
                <img src="../img/logo/add3.png" alt="logo" class="img_mnu">
                ক্যাটাগরি এন্ট্রি
            </a>
            <?php
         }
    
        if($_SESSION['balu_dealer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'piling_dealer_entry'){echo 'mnu_active';}?>" href="../vaucher/piling_dealer_entry.php">
                <img src="../img/logo/add4.png" alt="logo" class="img_mnu">
                ডিলার এন্ট্রি
            </a>
            <?php
        }
      
        if($_SESSION['rod_report'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == '45'){echo 'mnu_active';}?>" href="../vaucher/piling_report_buy_hisab.php">
                <img src="../img/logo/reportVector.svg" alt="logo" class="img_mnu">
                রিপোর্ট
            </a>
            <?php
        }
       

      
      
    ?>
</div>