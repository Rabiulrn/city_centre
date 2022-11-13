<?php
session_start();
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];

$_SESSION['pageName'] = 'cement_bg_entry';
$sucMsg = '';


$sql = "SELECT bg_id FROM  cement_gb_bank_history ORDER BY id DESC LIMIT 1";
$bgsId = $db->select($sql);
if ($bgsId->num_rows > 0) {
	$row = $bgsId->fetch_assoc();
	$largestId = $row['bg_id'];
} else {
	$largestId = 'bg-100000';
}
$matches = preg_replace('/\D/', '', $largestId);
$newNumber = $matches + 1;
$newId = 'bg-' . $newNumber;

$sucMsg = '';





if (isset($_POST['submit'])) {





	// File upload path

	// if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
	// Allow certain file formats

	// }else{
	//     $statusMsg = 'Please select a file to upload.';
	// }
















	$submitBtn_value = $_POST['submit'];
	// echo $submitBtn_value;

	// $document	= trim($_POST['document']);
	if ($submitBtn_value == 'Save') {


		$bg_id	= trim($_POST['bg_id']);
		$dealer_id	= trim($_POST['dealer_id']);
		$bank_name	= trim($_POST['bank_name']);
		$branch		= trim($_POST['branch']);
		$amount		= trim($_POST['amount']);
		$date		= trim($_POST['date']);
		///////////////////////
		$test = $_FILES['file'];
		// print_r($test);
		$filename = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name']; 
		$size = $_FILES['file']['size'];
		//deestination
		$dest = '../uploads/ducuments/' . $filename;

		//extension
		$extn = pathinfo($filename, PATHINFO_EXTENSION);



		if (!in_array($extn, ['jpg', 'png', 'pdf', 'zip', 'docx'])) {
			echo "You file extension must be .zip, .pdf or .docx";
		} elseif ($_FILES['file']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
			echo "File too large!";
		} else {
			// move the uploaded (temporary) file to the specified dest
			if (move_uploaded_file($fileTmpName, $dest)) {
				$sql = "INSERT INTO cement_gb_bank_history (bg_id,dealer_id,bank_name, branch, value,date, time,document,doc, project_name_id) VALUES ('$bg_id','$dealer_id','$bank_name', '$branch', '$amount','$date', now(),'$filename','$filename','$project_name_id')";

				if ($db->select($sql) === TRUE) {
					$sql = "SELECT bg_id FROM cement_gb_bank_history ORDER BY id DESC LIMIT 1";
					$bgsId = $db->select($sql);
					if ($bgsId->num_rows > 0) {
						$row = $bgsId->fetch_assoc();
						$largestId = $row['bg_id'];
					}
					$matches = preg_replace('/\D/', '', $largestId);
					$newNumber = $matches + 1;
					$newId = 'bg-' . $newNumber;
		
					$sucMsg = "New bank guarantee Saved Successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $db->error;
				}
			} else {
				echo "Failed to upload file.";
			}
		}
		///////////////////////////
		// $customer_id	= $newId; //disabled not work it,  $_POST['customer_id']
	
	} else {
		$bg_id = $_POST['bg_id'];
		echo $bg_id;
		$sql = "UPDATE cement_gb_bank_history SET bank_name = '$bank_name', branch = '$branch', date = '$date', value = '$amount' WHERE bg_id = '$bg_id'";

		if ($db->update($sql) === TRUE) {
			$sucMsg = "BG Updated Successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $db->error;
		}
	}
}


if (isset($_GET['remove_id'])) {
	$customer_delete = $_GET['remove_id'];
	$sql = "DELETE FROM cement_gb_bank_history WHERE id = '$customer_delete'";
	if ($db->select($sql) === TRUE) {
		$sucDel = "Customer delete successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}
}
?>




<!DOCTYPE html>
<html>

<head>
	<title>ব্যাংক গ্যারান্টি</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
	<link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>
	<style type="text/css">
		.dateInput {
			line-height: 22px !important;
		}

		.allowText {
			float: right;
			margin-bottom: 3px;
		}

		.table-bordered>tbody>tr>td {
			border: 1px solid #ddd;
		}

		.table>thead>tr>th {
			border-bottom: 2px solid #ddd;
		}

		.table-bordered>thead>tr>th {
			border: 1px solid #ddd;
		}

		.rodCustomerEnCon {
			position: relative;
			height: 157px;
			margin-bottom: 50px;
		}

		.showCustomerCon table {
			width: 100%;
			margin-bottom: 50px;
		}

		.showCustomerCon table tr th {
			border: 2px solid #ddd;
			text-align: center;
			padding: 5px 5px;
		}

		.showCustomerCon table tr td {
			border: 2px solid #ddd;
			padding: 2px 5px;
		}

		.customerEntryTable {
			width: 100%;
			/*margin-bottom: 10px;*/
		}

		.customerEntryTable tr th {
			border: 2px solid #ddd;
			padding: 4px 5px;
			text-align: center;
			background-color: #3e9309d4;
			Color: white;
		}

		.customerEntryTable tr td {
			border: 2px solid #ddd;
			padding: 2px;
			outline: none;
		}

		.showCustomerCon table tr:nth-child(odd) td {
			border: 2px solid #ddd;
			padding: 2px 5px;
			/* text-align: center; */
			background-color: #d2df0d40;
			color: black;
		}

		.borderLess {
			border: none !important;
		}

		.backcircle {
			font-size: 18px;
			position: absolute;
			margin-top: -20px;
		}

		.backcircle a:hover {
			text-decoration: none !important;
		}

		#submitBtn {
			width: 100px;
			position: absolute;
			right: 0px;
		}
	</style>
</head>

<body>
	<?php
	include '../navbar/header_text.php';
	// $page = 'rod_hisab';
	include '../navbar/navbar.php';
	?>
	<div class="container">

		<!-- <div class="backcircle">
			<a href="../vaucher/rod_index.php">
				<img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
			</a>
		</div> -->

	</div>

	<div class="bar_con">
		<div class="left_side_bar">
			<?php require '../others_page/left_menu_bar_cement_hisab.php'; ?>
		</div>
		<div class="main_bar">
			<?php
			$ph_id = $_SESSION['project_name_id'];
			$query = "SELECT * FROM project_heading WHERE id = $ph_id";
			$show = $db->select($query);
			if ($show) {
				while ($rows = $show->fetch_assoc()) {
			?>
					<div class="project_heading">
						<h2 class="headingOfAllProject">
							<?php echo $rows['heading']; ?> <span class="protidinHisab">ব্যাংক গ্যারান্টি</span>
							<!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; 
																?></span> -->

						</h2>
					</div>
			<?php
				}
			}
			?>
			<!-- <h4 class="customer_header">Customer Entry</h4> -->
			<div class="rodCustomerEnCon">
				<form action="" method="post" onsubmit="return validation()" enctype="multipart/form-data">
					<table class="customerEntryTable">
						<tr>
							<th width="130px">Dealer Id</th>
							<th>Bank Name</th>
							<th>Branch</th>
							<th>BG amount</th>
							<th>Date</th>
							<th>Document</th>
						</tr>
						<tr>
							<td style="display: none;">
								<input type="text" class="form-control" id="bg_id" value="<?php echo $newId; ?>" disabled>
								<input type="hidden" name="bg_id" id="customer_id_hidden" value="<?php echo $newId;; ?>">
							</td>
							<td>
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
							<td>
								<input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Enter bank name...">
							</td>
							<td>
								<input type="text" name="branch" class="form-control" id="branch" placeholder="Enter branch...">
								<!-- <textarea name="branch" class="form-control" rows="1" placeholder="Enter branch..." id='branch' style="resize: none;"></textarea> -->
							</td>
							<td>
								<input type="text" onkeypress="return isNumber(event)" name="amount" class="form-control" id="amount" placeholder="Enter BG amount...">
							</td>
							<td>
								<input type="date" onkeypress="return isNumber(event)" name="date" class="form-control" id="date" placeholder="Enter date...">
							</td>
							<td>
								<!-- <input type ="hidden"  name="hedmistress_old_ducument" id ="hedmistress_old_ducument" > -->
								<input type="file" class="form-control" name="file" id="file" placeholder="ডকুমেন্ট">
							</td>
							<!-- <td colspan="" rowspan="" headers="">
                <input type="hidden" name="document" id="document">
                <input type="file" class="form-control" name="document" id="document">
              </td> -->
						</tr>
						<tr>
							<td class="borderLess">
							</td>
							<td class="borderLess">
								<h4 id="cNameErr" class="text-danger"></h4>
							</td>
							<td class="borderLess">
								<h4 id="addressErr" class="text-danger"></h4>
							</td>
							<td class="borderLess">
								<h4 id="mobileErr" class="text-danger"></h4>
							</td>
							<td class="borderLess">
								<h4 id="buyingTypeErr" class="text-danger"></h4>
							</td>
							<td class="borderLess">
								<h4 id="buyingTypeErr" class="text-danger"></h4>
							</td>
						</tr>
					</table>
					<h4 class="text-center text-success"><?php echo $sucMsg; ?></h4>
					<input type="submit" name="submit" id="submitBtn" class="btn btn-primary" value="Save">
				</form>
			</div>

			<div class="showCustomerCon">
				<table>
					<tr class="bg-primary">
						<th>Dealer Id</th>
						<th>Bank Name</th>
						<th>Branch</th>
						<th>Amount</th>
						<th>Date</th>
						<th>Document</th>
						<th>Entry time and date</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					<?php
					$sql = "SELECT * FROM cement_gb_bank_history";
					$show = $db->select($sql);
					if ($show) {
						while ($rows = $show->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $rows['dealer_id'] . "</td>";
							echo "<td>" . $rows['bank_name'] . "</td>";
							echo "<td>" . $rows['branch'] . "</td>";
							echo "<td>" . $rows['value'] . "</td>";
							echo "<td>" . $rows['date'] . "</td>";
							echo "<td><a href=".'../uploads/ducuments/'.$rows['doc']." >". $rows['doc'] ."</td>";
							// echo "<td>".'../uploads/ducuments/' . $rows['document'] . "</td>";
							echo "<td>" . $rows['time'] . "</td>";
							echo '<td style="display: none;">' . $rows['bg_id'] . '</td>';



							if ($delete_data_permission == 'yes') {
								echo "<td width='78px'><a class='btn btn-danger customerDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
							} else {
								echo '<td width="78px"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
							}

							if ($edit_data_permission == 'yes') {
								echo "<td width='60px'><a class='btn btn-success' onclick='displayupdate(this)'>Edit</a></td>";
							} else {
								echo '<td width="60px"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
							}
							echo "</tr>";
						}
					}
					?>

				</table>
			</div>
		</div>
	</div>
	<?php include '../others_page/delete_permission_modal.php';  ?>






	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		function validation() {
			// validReturn = false;
			var bank_name = $('#bank_name').val();
			var branch = $('#branch').val();
			var mobile = $('#mobile').val();
			var buying_type = $('#buying_type').val();
			// alert(category_name);
			var customer_name_valid = false;
			var address_valid = false;
			var mobile_valid = false;
			var buying_type_valid = false;

			if (bank_name == '') {
				$('#cNameErr').html('bank name can not be empty !');
				$('#bank_name').focus();
			} else if (bank_name.length > 100) {
				$('#cNameErr').html('bank name can not greater than 100 characters !');
				$('#bank_name').focus();
			} else if ($.isNumeric(bank_name)) {
				$('#cNameErr').html('bank name can not a number !');
				$('#bank_name').focus();
			} else {
				$('#cNameErr').html('');
				customer_name_valid = true;
			}

			if (branch == '') {
				$('#addressErr').html('Address can not be empty !');
				$('#branch').focus();
			} else if (branch.length > 255) {
				$('#addressErr').html('Address cant greater than 255 characters !');
				$('#branch').focus();
			} else if ($.isNumeric(branch)) {
				$('#addressErr').html('Customer name can not a number !');
				$('#branch').focus();
			} else {
				$('#addressErr').html('');
				address_valid = true;
			}

			if (mobile == '') {
				$('#mobileErr').html('Mobile No. can not be empty !');
				$('#mobile').focus();
			} else if (mobile.length > 11) {
				$('#mobileErr').html('Mobile can not greater than 11 characters !');
				$('#mobile').focus();
			} else if (mobile.length < 11) {
				$('#mobileErr').html('Mobile can not less than 11 characters !');
				$('#mobile').focus();
			} else if (!$.isNumeric(mobile)) {
				$('#mobileErr').html('Mobile Number must a number !');
				$('#mobile').focus();
			} else {
				$('#mobileErr').html('');
				mobile_valid = true;
			}


			if (buying_type == '') {
				$('#buyingTypeErr').html('Buying Type can not be empty !');
				$('#buying_type').focus();
			} else if (buying_type.length > 100) {
				$('#buyingTypeErr').html('Buying Type can not greater than 100 characters !');
				$('#buying_type').focus();
			} else if ($.isNumeric(buying_type)) {
				$('#buyingTypeErr').html('Buying Type can not be a number !');
				$('#buying_type').focus();
			} else {
				$('#buyingTypeErr').html('');
				buying_type_valid = true;
			}




			if (customer_name_valid && address_valid && mobile_valid && buying_type_valid) {
				return true;
			} else {
				return false;
			}
		}

		function displayupdate(element) {
			var td_id = $(element).closest('tr').find('td:eq(0)').text();
			var b_name = $(element).closest('tr').find('td:eq(1)').text();
			var branch = $(element).closest('tr').find('td:eq(2)').text();
			var amount = $(element).closest('tr').find('td:eq(3)').text();
			var td_type = $(element).closest('tr').find('td:eq(4)').text();
			var bg_id = $(element).closest('tr').find('td:eq(5)').text();
			// alert(bg_id);

			$('#dealer_id').val(td_id);
			$('#customer_id_hidden').val(bg_id);
			$('#bank_name').val(b_name);
			$('#branch').val(branch);
			$('#amount').val(amount);
			$('#buying_type').val(td_type);
			$('#bg_id').val(bg_id);
			$('#submitBtn').val('Update');

			$('#cNameErr').html('');
			$('#addressErr').html('');
			$('#mobileErr').html('');
			$('#buyingTypeErr').html('');

			$("html, body").animate({
				scrollTop: 0
			}, 500);
		}
	</script>
	<script type="text/javascript">
		$(document).on('click', '.customerDelete', function(event) {
			var remove_id = $(event.target).attr('data_delete_id');
			$("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
			$("#matchPassword").val('');
			$("#passMsg").html('');
			$("#verifyToDeleteBtn").attr("data_delete_id", remove_id);
		});
		$(document).on('click', '#verifyToDeleteBtn', function(event) {
			event.preventDefault();
			var remove_id = $(event.target).attr('data_delete_id');
			console.log(remove_id);
			$("#passMsg").html("").css({
				'margin': '0px'
			});
			var pass = $("#matchPassword").val();
			$.ajax({
				url: "../ajaxcall/match_password_for_vaucher_credit.php",
				type: "post",
				data: {
					pass: pass
				},
				success: function(response) {
					// alert(response);
					if (response == 'password_matched') {
						$("#verifyPasswordModal").hide();
						ConfirmDialog('Are you sure delete customer info?');
					} else {
						$("#passMsg").html(response).css({
							'color': 'red',
							'margin-top': '10px'
						});
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});

			function ConfirmDialog(message) {
				$('<div></div>').appendTo('body')
					.html('<div><h4>' + message + '</h4></div>')
					.dialog({
						modal: true,
						title: 'Alert',
						zIndex: 10000,
						autoOpen: true,
						width: '40%',
						resizable: false,
						position: {
							my: "center",
							at: "center center-20%",
							of: window
						},
						buttons: {
							Yes: function() {
								$(this).dialog("close");
								$.get("cement_gb_hisab.php?remove_id=" + remove_id, function(data, status) {
									console.log(status);
									if (status == 'success') {
										window.location.href = 'cement_gb_hisab.php';
									}
								});
							},
							No: function() {
								$(this).dialog("close");
							}
						},
						close: function(event, ui) {
							$(this).remove();
						}
					});
			};
		});
		$(document).on('click', '.edPermit', function(event) {
			event.preventDefault();
			ConfirmDialog('You have no permission edit/delete this data !');

			function ConfirmDialog(message) {
				$('<div></div>').appendTo('body')
					.html('<div><h4>' + message + '</h4></div>')
					.dialog({
						modal: true,
						title: 'Alert',
						zIndex: 10000,
						autoOpen: true,
						width: '40%',
						resizable: false,
						position: {
							my: "center",
							at: "center center-20%",
							of: window
						},
						buttons: {
							Ok: function() {
								$(this).dialog("close");
							},
							Cancel: function() {
								$(this).dialog("close");
							}
						},
						close: function(event, ui) {
							$(this).remove();
						}
					});
			};
		});
	</script>
	<script>
		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			// if ((charCode > 31 || charCode < 46)&& charCode == 47 && (charCode < 48 || charCode > 57)) {
			if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8)) {
				Swal.fire("Should be enter a number value");
				// alert("Should be enter a number value");
				console.log("Workkkkk", evt);
				return false;
			}
			return true;
		}
	</script>
	<script type="text/javascript">
		$('.left_side_bar').height($('.main_bar').innerHeight());
	</script>
	<script type="text/javascript">
		$(document).on("click", ".kajol_close, .cancel", function() {
			$("#verifyPasswordModal").hide();
		});
	</script>
	<script src="../js/common_js.js"> </script>
</body>

</html>