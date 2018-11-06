<?php 
error_reporting(0);
	
	session_start();
	error_reporting(E_ALL);
	require("includes/connect.php");
	require("includes/functions.php");

	if(!isset($_SESSION['coordinator'])){
		
		header("location: index");
		
	}
	
	$message = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['submit']) && isset($_FILES['file']) && empty($_FILES['file']) == false) {
			
			$reg_no		=	escape($_POST['reg_no']);
			$name		=	escape($_POST['name']);
			$proj		=	escape($_POST['proj']);
			$supervisor	=	escape($_POST['supervisor']);
			$file		=	$_FILES['file'];
			$defense_no	=	escape($_POST['defense_no']);
			$venue		=	escape($_POST['venue']);
			
			$allowed_ext = array("png", "jpg", "jpeg", "JPEG", "JPG", "PNG");
			$ext = explode(".", $_FILES['file']['name']);
			
			if($reg_no != "" && $name != "" && $proj != "" && $supervisor != "" && $defense_no != "" && $venue != "") {
				
				if(in_array($ext[1], $allowed_ext)) {
					
					$check = $db->query("SELECT stu_reg FROM gra_student WHERE stu_reg='".$reg_no."' LIMIT 1") or die($db->error);
					
					if($check->num_rows) {
						
						$message = "No duplicate record allowed. $reg_no is already existing in the system";
						
					}else{
						
						$insert = $db->query("INSERT INTO gra_student(stu_reg, stu_name, stu_no, stu_venue, stu_project, stu_supervisor, stu_password) 
														VALUES('".$reg_no."', '".$name."', '".$defense_no."', '".$venue."', '".$proj."', '".$supervisor."', '".randStr()."')");
					
						if($insert) {
							
							$explode_reg = explode("/", $reg_no);
							$implode_reg = implode("_", $explode_reg);
							$pix = "gra_pictures/$implode_reg.jpg";
							
							if(move_uploaded_file($_FILES['file']['tmp_name'], $pix)) {
								
								$message = "Successful";
								
							}else{
								
								$message = "Student record was not successfully saved. Please try again!!!";
								
							}
							
						}
						
					}
					
					
				}else{
					
					$message = "Invalid image format. Try uploading image again";
					
				}
				
			}else{
				
				$message = "Incomplete form data. All form fields are required";
				
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

<?php require "includes/cordinator_header.php"; ?>

<?php require "includes/cordinator_left_nav.php"; ?>

<section class="content">
	
	<form method="post" action="#" class="add_stud" enctype="multipart/form-data">
		
		<h3 class="section_head"><span class="bold_fl">A</span>dd <span class="bold_fl">S</span>tudent</h3>
		
		<div class="form_group">
			
			<?php 
				
				if($message != "" && $message == "Successful") {
					
					echo "<p class='success'>Student Record successfully saved</p>";
					
				}elseif($message != "") {
					
					echo "<p class='failure'><span class='failure'></span>$message</p>";
					
				}
				
			?>
			
		</div>
		
		<div class="form_group">
			
			<label>Reg. Number</label>
			<input type="text" name="reg_no" value="<?php echo isset($_POST['reg_no']) && ($message != "Successful") ? htmlspecialchars($_POST['reg_no']) : ""; ?>" placeholder="Enter Reg No. E.g CST/12/COM/00934" pattern='\w{3}[\/]\d{2}[\/]\w{3}[\/]\d{5}' title='Reg Number (Format: SCI/11/COM/00926)' required />
			<p class="clear"></p>
			
		</div>
		
		<div class="form_group">
			
			<label>Full Name</label>
			<input type="text" name="name" placeholder="Enter Student's Full name" value="<?php echo isset($_POST['name']) && ($message != "Successful") ? htmlspecialchars($_POST['name']) : ""; ?>" required />
			<p class="clear"></p>
			
		</div>
		
		<div class="form_group">
			
			<label>Project Title</label>
			<input type="text" name="proj" placeholder="Enter Project Title" value="<?php echo isset($_POST['proj']) && ($message != "Successful") ? htmlspecialchars($_POST['proj']) : ""; ?>" required />
			<p class="clear"></p>
			
		</div>
		
		<div class="form_group">
			
			<label>Supervisor</label>
			<input type="text" name="supervisor" placeholder="Enter Project Supervisor" value="<?php echo isset($_POST['supervisor']) && ($message != "Successful") ? htmlspecialchars($_POST['supervisor']) : ""; ?>" required />
			<p class="clear"></p>
			
		</div>
		
		<div class="form_group">
			
			<label>Student's Photo</label>
			<input type="file" name="file" required />
			<p class="clear"></p>
			
		</div>
		
		<div class="form_group">
			
			<label>Defense Number</label>
			<input type="text" name="defense_no" placeholder="Enter Allocated Defense Number" value="<?php get_last(); ?>" required readonly />
			<p class="clear"></p>
			
		</div>
		
		<div class="form_group">
			
			<label>Defense Venue</label>
			<select name="venue" class="venue" required>
				
				<option value="">Allocated Defense Venue</option>
				<option value="Venue A">Venue A</option>
				<option value="Venue B">Venue B</option>
				<option value="Venue C">Venue C</option>
				
			</select>
			<p class="clear"></p>
			
		</div>
		
		<div class="form_group">
			
			<input type="submit" name="submit" value="Submit Form" />
			
		</div>
		
	</form>
	
</section>

<section id="res_holder" class="search_result_holder ">
	
	<div class="search_inner_wrapper">
		
		<div class="close_div">
		
			<p><span onclick="close_search()" class="close_icon">X</span></p>
			
		</div>
		
		<div class="in_search">
			
			<div class="student_listing full_width">
			
				<table width="100%" class="listing">
						
					<tr>
						<td>Name</td>
						<td colspan="3"><input type="text" id="name" value="Adamu ABdulrahman" readonly /></td>
						<td></td>
					</tr>
					
					<tr>
						<td>Reg No</td>
						<td colspan="3"><input type="text" value="SCI/11/COM/00926" id="reg_no" readonly  /></td>
						<td></td>
					</tr>
					
					<tr>
						<td>Project Title</td>
						<td colspan="3"><textarea readonly class="edit_div">Design and Implementation of Child Care Management system</textarea></td>
						<td><a href="#" title="Edit Detail"><span class="edit"></span></a></td>
					</tr>
					
					<tr>
						<td>Supervisor</td>
						<td colspan="3"><input type="text" id="supervisor" value="Mallam Usman Maitama"  /></td>
						<td><a href="#" title="Edit Detail"><span class="edit"></span></a></td>
					</tr>
					
					<tr>
						<td>Write Up</td>
						<td colspan="3"><input type="text" id="neatness" value="6%"  readonly /></td>
						<td></td>
					</tr>
					
					<tr>
						<td>Defence</td>
						<td colspan="3"><input type="text" id="supervisor" value="5%"  /></td>
						<td></td>
					</tr>
						
				</table>
				
			</div>
			
			
		</div>
	
	</div>
		
</section>

<footer>
	
	
	
</footer>

</body><!--END OF BODY -->

</html> <!--END OF HTML -->

<script src="js/cordinator_app.js"></script>
