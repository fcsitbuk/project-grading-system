<?php 
	
	require("includes/connect.php");
	require("includes/functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['reg_no']) && empty($_POST['reg_no']) == false && isset($_POST['value']) && empty($_POST['value']) == false) {
			
			$reg_no = escape($_POST['reg_no']);
			$value = escape($_POST['value']);
			
			if($reg_no != "" &&  $value != "") {
				
				$explode_reg = explode("_", $reg_no);
			
				//print_r($explode_reg);
				
				if(in_array("title", $explode_reg) || in_array("titles", $explode_reg)) {
					
					array_pop($explode_reg);
					
					$my_reg = implode("/", $explode_reg);
					
					$update_title = $db->prepare("UPDATE gra_student SET stu_project=? WHERE stu_reg=? LIMIT 1");
					
					$update_title->bind_param('ss', $value, $my_reg);
					
					if($update_title->execute()) {
						
						echo "Project Title successfully updated";
						
					}else{
						
						echo "Unable to update Project Title. Please try again";
						
					}
					
				}elseif(in_array("sup", $explode_reg) || in_array("sups", $explode_reg)) {
					
					array_pop($explode_reg);
					
					$my_reg = implode("/", $explode_reg);
					
					$update_supervisor = $db->prepare("UPDATE gra_student SET stu_supervisor=? WHERE stu_reg=? LIMIT 1");
					
					$update_supervisor->bind_param('ss', $value, $my_reg);
					
					if($update_supervisor->execute()) {
						
						echo "Project Supervisor successfully updated";
						
					}else{
						
						echo "Unable to update Project Supervisor. Please try again";
						
					}
					
				}
				
			}
			
			$db->close();
			
		}
		
	}
	
?>