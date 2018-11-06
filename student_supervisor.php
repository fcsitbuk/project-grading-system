<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$select ="";
$stu_reg ="";
$stu_name ="";
$title= "";
$no = "";
$venue = "";
$stu_name2 ="";
$super ="";
$title = "";
$email = "";

$msg ="";

if(!isset($_SESSION['student'])){
	header("location: index");
}

	$stu_reg = escape($_SESSION['student']);
	
	$select = $db->query("SELECT * FROM gra_student WHERE stu_reg='".$stu_reg."' LIMIT 1") or die($db->error);
	
	if($select->num_rows){
		$row = $select->fetch_assoc();
		$stu_name = ucwords(strtolower($row['stu_name']));
		$title = strtoupper($row['stu_project']);
		$no = $row['stu_no'];
		$venue = $row['stu_venue'];
		$super = $row['stu_supervisor'];
		
		
		$select2 = $db->query("SELECT lec_title, lec_email FROM lecturer_account WHERE lec_name= '".$super."' LIMIT 1") or die($db->error);
			if($select2->num_rows){
				$row2 = $select2->fetch_assoc();
				$title = $row2['lec_title'];
				$email = $row2['lec_email'];
			
		$msg = "<p style='font-size: 17px; color: #444444; background: #EEFFEE; padding: 30px 10px; letter-spacing: 1px; line-height: 35px; text-align: center;'>&nbsp; &nbsp;<i class='fa fa-bell-o text-warning'></i>&nbsp; &nbsp;Dear <b>$stu_name ($stu_reg),</b> <br/>
		The Faculty of Computer Science and Information Technology is pleased to inform you that you have been assigned a project (CSC4600) supervisor in partial fulfillment of the requirements of your B.Sc Degree. Your supervisor is: <b>$title $super</b> ($email)

		<br/> <br/> <i class='fa fa-hand-o-right' style='font-size: 20px; font-weight: bold;'>&nbsp;Click <a href='checklist'/> here</a> to find out what next </i>
		
		</p>";
		
		}
		
	}
	

?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/student_header.php"); ?>
		
		<div id="wi_section"> 
			<section id="wis_section">
                   <h4>Allocated Supervisor</h4>  

					<p><?php echo $msg;?></p> 				   
                
            </section> <!-- end of wis_section -->
		</div> <!-- end of wi_section -->
		
        <div class="clear"></div>
        
		<div id="wi_footer" title="powered by #teamSHM#">
			<?php include_once("includes/assessor_footer.php"); ?>
		</div> <!-- end of wi_footer -->
		
	</div> <!-- end of w_inner -->
</div> <!--END OF div#wrapper -->

    
</body><!--END OF BODY -->

</html> <!--END OF HTML -->
