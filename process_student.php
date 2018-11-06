<?php 
error_reporting(0);
	
	require("includes/connect.php");
	require("includes/functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['reg_no']) && empty($_POST['reg_no']) == false) {
			
			$reg_no = escape($_POST['reg_no']);
			
			$explode_reg = explode("/", $reg_no);
			
			//print_r($explode_reg);
			
			if(!preg_match("/\d{5}/", $explode_reg[3])) {
				
				echo "<p class='failure'>Only numbers allowed in the last field of the registration number</p>";
				
			}else{
				
				if(strlen($explode_reg[3]) < 5) {
					
					echo "<p class='failure'>The number of digits in the last field of the registration number must not be less than five</p>";
					
				}else{
					
					$get_student = $db->query("SELECT * FROM gra_student WHERE stu_reg='".$reg_no."' LIMIT 1");
					
					if($get_student->num_rows) {
						
						echo "<table class='wiss_table'>
								<tr class='wt_header'>
									<th>Reg. No.</th>
									<th>Title</th>
									<th>Venue</th>
									<th>Supervisor</th>
								</tr>";
									
						while(($row = $get_student->fetch_assoc()) != null){
							$reg_no = $row['stu_reg'];
							$title = $row['stu_project'];
							$supervisor = $row['stu_supervisor'];
							$venue = $row['stu_venue'];
							
							$explode = explode("/", $reg_no);
							$implode = implode("_", $explode);
							$stu_file  = "gra_projects/$implode.pdf";
							
						if(file_exists($stu_file)){
								echo "<tr class='wt_content'>
									<td>$reg_no</td>
									<td><a href='$stu_file' download='$title' target='_blank'>$title</a></td>
									<td>$venue</a></td>
									<td>$supervisor</td></tr>";
						}		
						else{
							echo "<tr class='wt_content'>
								<td>$reg_no</td>
								<td title='project file does not exist'>$title</td>
								<td>$venue</td>
								<td>supervisor N/A</td></tr>";
							}

							
						}
						
						echo "</table>";
						
					}else{
						
						echo "<p class='failure'>".strtoupper("No project found in the database belonging to registration number : $reg_no")."</p>";
						
					}
					
				}
				
			}
			
		}
		
	}
	
?>