<?php
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$select = "";
$lec_name ="";
$msg ="";
$stu_reg ="";
$stu_name ="";
$stu_project="";
$count = 1;

$red1 = md5(time());

if(!isset($_SESSION['assessor'])){
	header("location: index");
}



$lec_email = escape($_SESSION['assessor']);

$lec_name = explode(".", $lec_email);

$select = $db->query("SELECT * FROM gra_student WHERE stu_supervisor='".$lec_name[0]."'");
	if($select->num_rows){
		while(($row = $select->fetch_assoc()) != null){		
			$stu_reg = $row['stu_reg'];
			$stu_name = strtoupper($row['stu_name']);
			$stu_project = ucwords($row['stu_project']);
		
			$msg .= "<tr>
				<td>$count</td>
				<td class='odd'>$stu_name</td>
				<td>$stu_project</td>
				<td style='border-left: 1px solid #bbb;'><a href='supervisor_assess?red=$red1$red1&a=$stu_reg&red=$red1&b=$stu_name&c=$stu_project&red=$red1'>Grade</a></td>
				<td><a href='stu_checklist?token=$red1$red1&a=$stu_reg&red=$red1&b=$stu_name&c=$stu_project&red=$red1'>View Files</a></td>
				
			</tr>";
		$count++;
		}
	}
	else{
		$msg = "<tr><td colspan='4' style='padding: 20px 0px; font-size: 16px; color: #FF0000;'>No student record found. Kindly implore your allocated students to upload their project details </td></tr>";
	}



?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/supervisor_header.php"); ?>
		
               <div class="urScore">  Your Students </div>
			   
	<section class="content">
	
	<div class="student_file">
		
		<h3>Student Details</h3>
		
		<table class="allocate_stud">
			
			<tr>
				<th>S/N</th>
				<th class="odd">Name</th>
				<th>Project Title</th>
				<th colspan="2">Actions</th>
				
			</tr>
			<?php echo $msg; ?>
			
			
			
			
		</table>
		
	</div>
	
</section>
				
			
		<div id="wi_footer" title="powered by #teamSHM#">
			<?php include_once("includes/assessor_footer.php"); ?>
		</div> <!-- end of wi_footer -->
		
	</div> <!-- end of w_inner -->
</div> <!--END OF div#wrapper -->

</body><!--END OF BODY -->

</html> <!--END OF HTML -->
