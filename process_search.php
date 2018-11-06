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
						
						while($row = $get_student->fetch_assoc()) {
							
							$reg_no = $row['stu_reg'];
							$total =  get_average_defense($reg_no) + get_average_writeup($reg_no);
							$reg_arr = explode("/", $reg_no);
							$reg_str = implode("_", $reg_arr);
							
							$title = $reg_str."_titles";
							$supervisor = $reg_str."_sups";
							
							echo  "<div class='student_listing full_width'>
					
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
													<td>Write Up</td>
													<td colspan='3'><input type='text' id='neatness' value='".get_average_writeup($reg_no)."'  readonly /></td>
													<td></td>
												</tr>
												
												<tr>
													<td>Defence</td>
													<td colspan='3'><input type='text' id='supervisor' value='".get_average_defense($reg_no)."' readonly /></td>
													<td></td>
												</tr>
												
												<tr>
													<td>Total</td>
													<td colspan='3'><input type='text' id='total' value='".$total."%'  /></td>
													<td></td>
												</tr>
													
											</table>
											
										</div>";

							
						}
						
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