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
		
		
		$select2 = $db->query("SELECT * FROM gra_student WHERE stu_venue = '".$venue."' AND stu_no=$no - 1 LIMIT 1") or die($db->error);
			if($select2->num_rows){
				$row2 = $select2->fetch_assoc();
				$stu_name2 = $row2['stu_name'];
			
		$msg = "<p style='font-size: 17px; color: #444444; background: #EEFFEE; padding: 30px 0px; letter-spacing: 1px; line-height: 35px; text-align: center;'>&nbsp; &nbsp;<i class='fa fa-bell-o text-warning'></i>&nbsp; &nbsp;Dear <b>$stu_name ($stu_reg),</b> <br/>
		You have been scheduled to defend a project titled <b>$title</b> <br/>at <b>$venue.</b> <br/> Your defense sequence number is: <b>$no</b> <br/> <br/>
		<b><i class='fa fa-bullhorn fa-2x'></i></b>&nbsp; &nbsp; You are defending immediately after <b>$stu_name2</b>
		<br/> <br/> <br/> <i class='pull-right fa fa-hand-o-right'><i>&nbsp;We wish you best of luck...</i></i>
		
		</p>";
		
		$msg .= "<p class='uploadMsg' style='font-size: 16px; color: #444444; background: #EEEEFF; padding: 30px 30px; letter-spacing: 1px; line-height: 30px; text-align: justify; margin: 30px 0px;'>&nbsp; &nbsp;<i class='fa fa-bell-o text-warning fa-2x'></i>&nbsp; &nbsp; <b style='animation: blinker 0.8s linear infinite; color: #ff0000; font-size: 30px;'>NOTE:</b> <br/>1. Make sure you upload your project in .pdf format  <br/>2. Ensure you provide the title  of your project in the project title space provided<br/>3. Ensure your comply with the project defense slide preparation template <br/><br/> Failure to comply with 1 and 2 above, you will not be graded by your supervisor and will not be legible for defense.<br/> To <b>upload or download</b> project defense slide template, use  the top-right navigation bar <i class='fa fa-navicon fa-border'></i>  
		<br/><br/><br/> <i style='text-align: right; display: block;'>Please disregard if you have uploaded your project details.</i>
		</p>";
		}
		
	}
	

?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/student_header.php"); ?>
		
		<div id="wi_section"> 
			<section id="wis_section">
                   <h4>defense schedule</h4>  

					<p><?php echo $msg;?></p> 				   
                
            </section> <!-- end of wis_section -->
		</div> <!-- end of wi_section -->
		
        <div class="clear"></div>
        
		<div id="wi_footer" title="powered by #teamSHM#">
			<?php include_once("includes/assessor_footer.php"); ?>
		</div> <!-- end of wi_footer -->
		
	</div> <!-- end of w_inner -->
</div> <!--END OF div#wrapper -->

<div class="float_background"></div>
<div class="float_cont">
<p>help contents should go here</p>
 
</div>
    
</body><!--END OF BODY -->

</html> <!--END OF HTML -->
