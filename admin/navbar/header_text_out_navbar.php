<?php
	// $ph_id = $_SESSION['project_name_id'];

	// if(!isset($ph_id)){
		$query = "SELECT banner_img_name FROM project_heading WHERE id = 1";
		$read = $db->select($query);
		if($read){
	        $row = $read->fetch_assoc();
	        $imgName = trim($row['banner_img_name']);
	    } else{
	    	echo "Image Name not Select. Error from db.";
	    }
	// } else {
	// 	$query = "SELECT banner_img_name FROM project_heading WHERE id = '$ph_id'";
	// 	$read = $db->select($query);
	// 	if($read){
	//         $row = $read->fetch_assoc();
	//         $imgName = trim($row['banner_img_name']);
	//     } else{
	//     	echo "Image Name not Select. Error from db.";
	//     }
	// }
	
    // var_dump($imgName);

?>

<div class="container-fluid" id= "banner-fluid" style="background-color: #BD0000; background-color:#074F84; background-color:#fff;border-radius: 0px; margin-bottom: 0px; color: #e3e3e3; border-bottom: 2px solid #333; padding: 5px 0px;">
	<div class="row"style="margin: 0px;">
		<div class="col-md-12" >
			<img src="img/banner/<?php echo $imgName; ?>" style="display: block; width: 60%; height: 90px; position: relative; left: 50%; margin-left: -30%;">
		</div>
	</div>
</div>