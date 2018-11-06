<?php 
error_reporting(0);

	session_start();

	require("includes/connect.php");
	require("includes/functions.php");

	if(!isset($_SESSION['coordinator'])){
		
		header("location: index");
		
	}
	
	$result = "";
	$excel_array = array();
	
		$get_student = $db->query("SELECT * FROM gra_student ORDER BY id ASC");
		
		
		if($get_student->num_rows) {
			
			$i = 1;
			
			while($row = $get_student->fetch_assoc()) {
				
				$reg_no = $row['stu_reg'];
				$total =  get_average_defense($reg_no) + get_average_writeup($reg_no);
				$reg_arr = explode("/", $reg_no);
				$reg_str = implode("_", $reg_arr);
				
				$title = $reg_str."_title";
				$supervisor = $reg_str."_sup";
				
				$excel_array[] = array("S/N" => $i, "Reg No" => $reg_no, "Name" => $row['stu_name'], "Project" => get_average_writeup($reg_no), "Defense" => get_average_defense($reg_no), "Total" => $total);
				
				$result .= "<div class='student_listing'>
		
								<table width='100%' class='listing'>
										
									<tr>
										<td>Name</td>
										<td colspan='3'><input type='text' id='name' value='".$row['stu_name']."' readonly /></td>
										<td></td>
									</tr>
									
									<tr>
										<td>Reg No</td>
										<td colspan='3'><input type='text' value='".$row['stu_reg']."' id='reg_no' readonly  /></td>
										<td></td>
									</tr>
									
									<tr>
										<td>Project Title</td>
										<td colspan='3'><textarea id='".$title."' onkeypress=\"send_data(event, '".$title."')\" readonly class='edit_div'>".ucfirst($row['stu_project'])."</textarea></td>
										<td><a href='#' onclick=\"enable('".$title."'); return false\" title='Edit Detail'><span class='edit'></span></a></td>
									</tr>
									
									<tr>
										<td>Supervisor</td>
										<td colspan='3'><input type='text' id='".$supervisor."' onkeypress=\"send_data(event, '".$supervisor."')\" value='".$row['stu_supervisor']."' readonly  /></td>
										<td><a href='#' onclick=\"enable('".$supervisor."'); return false\" title='Edit Detail'><span class='edit'></span></a></td>
									</tr>
									
									<tr>
										<td>Project</td>
										<td><input type='text' id='neatness' value='".get_average_writeup($reg_no)."'  readonly /></td>
										<td>Defense</td>
										<td><input type='text' id='supervisor' value='".get_average_defense($reg_no)."' readonly /></td>
										<td></td>
									</tr>
									
									<tr>
										<td>Total</td>
										<td colspan='3'><input type='text' id='total' value='".$total."%'  /></td>
										<td></td>
									</tr>
										
								</table>
								
							</div>";
							
				$i++;
				
			}
			
			$get_student->free_result();
			$db->close();
			
		}else{
			
			$result = "No Student Record Available Yet!!!!!!";
			
		}
		
		if(isset($_GET['export']) && escape($_GET['export']) == 'yes') {
		
			function cleanData(&$str) {
				$str = preg_replace("/\t/", "\\t", $str);
				$str = preg_replace("/\r?\n/", "\\n", $str);
				if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
			}

		  // filename for download
			  $filename = "CSC 4600 Assessment " . date('Y-m-d') . ".xls";

			  header("Content-Disposition: attachment; filename=\"$filename\"");
			  header("Content-Type: application/vnd.ms-excel");

			  $flag = false;
			  foreach($excel_array as $row) {
				if(!$flag) {
				  // display field/column names as first row
				  echo implode("\t", array_keys($row)) . "\r\n";
				  $flag = true;
				}
				array_walk($row, __NAMESPACE__ . '\cleanData');
				echo implode("\t", array_values($row)) . "\r\n";
			  }
			  
			  exit;
			
		}
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require "includes/coordinator_inner_header.php"; ?>
</head>

<body>

<?php require "includes/cordinator_header.php"; ?>

<?php require "includes/cordinator_left_nav.php"; ?>

<section class="content">
	
	<?php echo $result; ?>
	
	<p class="clear"></p>
	
</section>

<section id="res_holder" class="search_result_holder">
	
	<div class="search_inner_wrapper">
		
		<div class="close_div">
		
			<p><span onclick="close_search()" class="close_icon">X</span></p>
			
		</div>
		
		<div class="in_search">
			
			
			
			
		</div>
	
	</div>
		
</section>

<footer>
	
	
	
</footer>

</body><!--END OF BODY -->

</html> <!--END OF HTML -->

<script src="js/cordinator_app.js"></script>
