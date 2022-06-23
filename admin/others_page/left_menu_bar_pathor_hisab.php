<!-- Left menu bar con -->
<div id="left_all_menu_con">
    <a class="header_mnu_left" href="../vaucher/pathor_index.php" >
        <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
        পাথর হিসাব
    </a>
    <?php
        if($_SESSION['rod_kroy_hisab'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'pathor_kroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/pathor_details_entry.php">
                <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
                <!-- ক্রয় হিসাবের দৈনিক এন্ট্রি -->
                পাথর ক্রয় হিসাব
            </a>
            <?php
        }
        if($_SESSION['rod_bikroy_hisab'] == 'yes'){
            ?>         
            <a class="mnu_left" <?php if($_SESSION['pageName'] == 'balu_bikroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/balu_details_sell_entry.php">
                <img src="../img/logo/add2.png" alt="logo" class="img_mnu">
                <!-- বিক্রয় হিসাবের দৈনিক এন্ট্রি -->
                পাথর বিক্রয় হিসাব
            </a>
            <?php
        }
        if($_SESSION['rod_category'] == 'yes'){
            ?> 
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'balu_hisab_entry'){echo 'mnu_active';}?>" href="../vaucher/balu_hisab_entry.php">
                <img src="../img/logo/add3.png" alt="logo" class="img_mnu">
                পাথর ক্যাটাগরি এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_dealer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'balu_dealer_entry'){echo 'mnu_active';}?>" href="../vaucher/balu_dealer_entry.php">
                <img src="../img/logo/add4.png" alt="logo" class="img_mnu">
                পাথর ডিলার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_customer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'balu_cusotomer_entry'){echo 'mnu_active';}?>" href="../vaucher/balu_stocks.php">
                <img src="../img/logo/add5.png" alt="logo" class="img_mnu">
                পাথর স্টক তথ্য
            </a>
            <?php
        }
        if($_SESSION['rod_buyer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'balu_buyer_entry'){echo 'mnu_active';}?>" href="../vaucher/balu_buyer_entry.php">
                <img src="../img/logo/add6.png" alt="logo" class="img_mnu">
                পাথর বায়ার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_customer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'balu_customer_entry'){echo 'mnu_active';}?>" href="../vaucher/balu_customer_entry.php">
                <img src="../img/logo/add5.png" alt="logo" class="img_mnu">
                পাথর  কাস্টমার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_report'] == 'yes'){
            ?>
            <!-- <a class="mnu_left <?php if($_SESSION['pageName'] == '45'){echo 'mnu_active';}?>" href="../vaucher/balu_report_buy_hisab.php">
                <img src="../img/logo/reportVector.svg" alt="logo" class="img_mnu">
                পাথর ও বালু রিপোর্ট
            </a> -->
            <?php
        }
    ?>
</div>