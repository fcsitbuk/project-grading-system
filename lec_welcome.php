<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");



if(!isset($_SESSION['assessor'])){
	header("location: index");
}

	$lec_name = escape($_SESSION['name']);
	$lec_email = escape($_SESSION['assessor']);
$schedule = "";	

	//determining where to navigate to when supervisor mode is clicked;
	$select = $db->query("SELECT * FROM lecturer_account WHERE lec_name='".$lec_name."' AND lec_email='".$lec_email."' LIMIT 1") or die($db->error);
				
		if($select->num_rows){
			$row = $select->fetch_assoc();
			$venue = $row['assess_venue'];
			
			if($venue == ""){
				$schedule = "supervisor";
			}else{
				$schedule = "supervisor_allocation";
			}
		}	
	
?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/lec_welcome_header.php"); ?>

		
		<div id="wi_section"> 
			<section id="wis_section">
                <h4 style="">Welcome <?php echo $lec_name; ?></h4>
               
				<div id="cdMsg" style="background: #FFFFCC; padding: 30px 20px; text-align: center; font-size: 20px; margin: 50px 0px; display: none;"><i class='fa fa-warning text-warning fa-2x'>&nbsp; &nbsp;</i>Sorry <?php echo $lec_name; ?>, you cannot assess students untill the defense day.</div>
			   
				<div class="uploadMsg" id="uploadMsg" style="background: #EEFFEE; padding: 30px 20px; text-align: justify; font-size: 17px; margin: 50px 0px 150px 0px;">
				
				<p> You can do the following with FCSIT Project Grading System: </p>
				<ol style="list-style-type: upper-roman; line-height: 30px; padding: 0px 20px;">
					<li>1. View, access project files and grade students under your project supervision by selecting <b>Supervisor Mode</b> from the top-right navigation bar <i class='fa fa-navicon fa-border'></i> </li>
					<li>2. Assess students assigned to your defense panel by selecting <b>Assessor Mode</b> from the top-right navigation bar <i class='fa fa-navicon fa-border'></i> </li>
					 
				</ol>
				
				</div> 
				
                
               
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
