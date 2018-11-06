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
					
					$get_student = $db->query("SELECT stu_reg, stu_project, stu_name FROM gra_student WHERE stu_reg='".$reg_no."' LIMIT 1");
					
					if($get_student->num_rows) {
						
						echo "<table class='allocate_stud'>
			
									<tr>
										<th width='15%'>Reg No.</th>
										<th width='30%'>Name</th>
										<th width='55%'>Project Title</th>
										<th>Action</th>
									</tr>";
									
						while($row = $get_student->fetch_assoc()) {
							
							$explode_reg = explode("/", $row['stu_reg']);
							$implode_reg = implode("_", $explode_reg);
							$file = "gra_projects/$implode_reg.pdf";
							$title = (file_exists($file)) ? "<a href='".$file."' download='".$row['stu_project']."'>Download</a>" : "<a href='#' style='#FF002A'>N/A</a>";
							$title_display = (trim($row['stu_project']) != "") ? $row['stu_project'] : "Not Available";
							
									echo "<tr>
											<td>".$row['stu_reg']."</td>
											<td class='pull_left'>".$row['stu_name']."</td>
											<td>".$title_display."</td>
											<td>$title</td>
										</tr>";
							
							
						}
						
						echo "</table>";
						
					}else{
						
						echo "<p class='failure'>".strtoupper("No Student Record found with registration number : $reg_no")."</p>";
						
					}
					
				}
				
			}
			
			$get_student->free_result();
			$db->close();
			
		}
		
	}
	
?>