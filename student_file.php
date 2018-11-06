<?php 
	error_reporting(0);
	session_start();
	require("includes/connect.php");
	require("includes/functions.php");
	
	if(!isset($_SESSION['coordinator'])){
		
		header("location: index");
		
	}
	
	$result = "";
	$pagination = "";
	
		$per_page = 20;
		
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		
		$get_count = $db->query("SELECT id FROM gra_student");
		
		$pages = ceil(($get_count->num_rows)/$per_page);
		
		$start = ($page * $per_page) - $per_page;
		
		$get_student = $db->query("SELECT stu_reg, stu_project, stu_name FROM gra_student ORDER BY id ASC");
		
		if($get_student->num_rows) {
			
			$result .= "<table class='allocate_stud'>
			
						<tr>
							<th width='5%'>S/N</th>
							<th width='15%'>Reg No.</th>
							<th width='25%'>Name</th>
							<th width='50%'>Project Title</th>
							<th>Action</th>
						</tr>";
						
			$i = 1;
			
			while($row = $get_student->fetch_assoc()) {
				
				$explode_reg = explode("/", $row['stu_reg']);
				$implode_reg = implode("_", $explode_reg);
				$file = "gra_projects/$implode_reg.pdf";
				$title = (file_exists($file)) ? "<a href='".$file."' download='".$row['stu_project']."'>Download</a>" : "<a href='#' style='#FF002A'>N/A</a>";
				$title_display = (trim($row['stu_project']) != "") ? $row['stu_project'] : "Not Available";
				
				$result .= "<tr>
								<td>$i</td>
								<td>".$row['stu_reg']."</td>
								<td class='pull_left'>".$row['stu_name']."</td>
								<td>".$title_display."</td>
								<td>$title</td>
							</tr>";
				
				
				$i++;
				
			}
			
			$result .= "</table>";
			
		}else{
			
			$result = "";
			
		}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <?php require "includes/coordinator_inner_header.php"; ?>
	
	<script>
		
		function fetch_data() {
		
			serial = $("#serial").val();
			faculty = $("#faculty").val();
			year = $("#year").val();
			dept = $("#dept").val();
			
			if(serial != "" && faculty != "" && year != "" && dept != "" && serial.length >= 5) {
				
				$(".search_result_holder").addClass("close_class");
				$(".search_inner_wrapper").css("display", "block");
				
				var send = faculty + "/" + year + "/" + dept + "/" + serial;
				
				//$("#in_search").html(send);
				
				$.ajax({
					
					url: 'process_download.php',
					type: 'post',
					data: {reg_no : send},
					success: function(data) {
						
						$(".in_search").html(data);
						
					}
					
				});
				
			}else if(serial.length == 0) {
					
				close_search();
					
			}
			
		}
		
	</script>
	
</head>

<body>

<?php require "includes/cordinator_header_download.php"; ?>

<?php require "includes/cordinator_left_nav.php"; ?>

<section class="content">
	
	<div class="student_file">
		
		<h3 class="section_head"><span class="bold_fl">S</span>tudent <span class="bold_fl">P</span>rojects</h3>
		
		<?php  echo $result; ?>
		
	</div>
	
</section>

<section id="res_holder" class="search_result_holder ">
	
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
