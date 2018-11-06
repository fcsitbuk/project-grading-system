<?php 
error_reporting(0);
	
	session_start();
	require("includes/connect.php");
	require("includes/functions.php");
	
	if(!isset($_SESSION['coordinator'])){
		
		header("location: index");
		
	}
	
	$result = "";
	
		
		$get_venue = $db->query("SELECT DISTINCT stu_venue FROM gra_student ORDER BY stu_venue DESC");
		if($get_venue->num_rows) {
			while($row = $get_venue->fetch_assoc()) {
				$get_student = $db->query("SELECT * FROM gra_student WHERE stu_venue ='".$row['stu_venue']."' ORDER BY stu_no ASC");
				if($get_student->num_rows) {
					$result .= "<table class='allocate_stud defense_all'>
						<tr class='as_head'>
							<th colspan='7'>FCSIT, BAYERO UNIVERSITY, KANO</th>
						</tr>
						<tr class='as_head'>
							<th colspan='7'>STUDENT ALLOCATED VENUE AND DEFENSE NUMBER</th>
						</tr>
						<tr class='as_head'>
							<th colspan='7'>ALLOCATED STUDENT FOR: <b>&nbsp;&nbsp; ".$row['stu_venue']."</b></th>
						</tr>
						<tr class='as_innerHead'>
							<th>D/N</th>
							<th>Reg No.</th>
							<th>Name</th>
							<th class='asi_special'>Quality of presentation</th>
							<th class='asi_special'>Achievement of objectives</th>
							<th class='asi_special'>Response to questions</th>
						</tr>";
						
					$i = 1;
				
				while($row = $get_student->fetch_assoc()) {
				
				
				
				$result .= "<tr>
								<td>$i</td>
								<td>".$row['stu_reg']."</td>
								<td class='pull_center'>".ucwords(strtolower($row['stu_name']))."</td>
								<td class='asi_special'></td>
								<td class='asi_special'></td>
								<td class='asi_special'></td>
							</tr>";
				$i++;
			}
			$result .= "</table>";
		}else{
			
			$result = "";
			
		}
			}
		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "includes/coordinator_inner_header.php"; ?>
</head>

<body>

<?php require "includes/cordinator_header_allocation.php"; ?>

<?php require "includes/cordinator_left_nav.php"; ?>

<section class="content">
	
	<div class="student_file">
		
		<h3 class="section_head"><span class="bold_fl">D</span>efense <span class="bold_fl">A</span>llocation</h3>
		
		<div class="sf_print"> 
			<p><a class="sf_manual" href="defense_allocation"><i class="fa fa-building fa-lg btn btn-success"></i> &nbsp; Allocation per Venue</a></p>
			
			<p><a class="" href="#" onclick="print()"><i class="fa fa-print fa-lg"></i> &nbsp; Print</a></p>
		</div>
		
		<?php  echo $result; ?>
		
	</div>
	
</section>

<section id="res_holder" class="search_result_holder ">
	
	
		
</section>

<footer>
	
	
	
</footer>

</body><!--END OF BODY -->

</html> <!--END OF HTML -->

<script src="js/cordinator_app.js"></script>
