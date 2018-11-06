<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$lec_name = "";
$select ="";
$stu_reg = "";
$stu_name ="";
$title = "";
$mark1 ="";
$mark2 = "";
$mark3 = "";
$msg = "";
$assessedList="";

if(!isset($_SESSION['assessor'])){
	header("location: index");
}

	$lec_name = escape($_SESSION['name']);
	$lec_email = escape($_SESSION['assessor']);
	
	$select = $db->query("SELECT * FROM gra_asessor WHERE ass_name = '".$lec_name."' ORDER BY id DESC") or die($db->error);
		if($select->num_rows){
			while(($row = $select->fetch_assoc()) != null){
			$stu_reg = strtoupper($row['stu_reg']);
			$mark1 = $row['mark_pre'];
			$mark2 = $row['mark_obj'];
			$mark3 = $row['mark_que'];
				
			$select2 = $db->query("SELECT * FROM gra_student WHERE stu_reg = '".$stu_reg."' LIMIT 1") or die($db->error);
			if($select2->num_rows){
				while(($row2 = $select2->fetch_assoc()) != null){
					$stu_name = $row2['stu_name'];
					$title = $row2['stu_project'];
					
					/*modularizing the content of the wiss_students to avoid repitition*/
					$contentUp = "<div class='wiss_students'>
						 <div class='wisss_edit'>
							<a href='editassessor?stuid=$stu_reg'><i class='fa fa-pencil-square-o' title='edit allocated marks'></i></a>
						</div>
					
						<div class='wisss_name'>
							<p title='$stu_name($stu_reg)'>$stu_name<br/>($stu_reg)</p>
						</div>
						";
					$contentDown = "<div class='wisss_assess'>
							<label for='wisssa_1'>Quality of presentation:</label> 
							<input type='text' maxlength='3' class='wisssa_input' disabled value='$mark1'> <span>/10</span>
						</div> <!-- end of wisss_assess -->
						
						<div class='wisss_assess'>
							<label for='wisssa_1'>Achievement of objectives:</label> 
							<input type='text' maxlength='3' class='wisssa_input' disabled value='$mark2'> <span>/15</span>
						</div> <!-- end of wisss_assess -->
						
						<div class='wisss_assess'>
							<label for='wisssa_1'>Response to questions:</label> 
							<input type='text' maxlength='3' class='wisssa_input' disabled value='$mark3'> <span>/15</span>
						</div> <!-- end of wisss_assess -->
						
									 
						</div>";
					/*end of modularizing the content of the wiss_students to avoid repitition*/	
					if($title != ""){
						$assessedList .= "$contentUp
						<div class='wisss_title'>
							<p title='$title'> $title  </p>
						</div>
						$contentDown";
					}
					else{
						$assessedList .= "$contentUp
						<div class='wisss_title'>
							<p title='$title' class='text-danger'> $stu_name did not upload complete project details</p>
						</div>
						$contentDown";
					}
				}	
			}else{
				$msg = "<p class='uploadMsg' style='font-size: 16px; color: #444444; background: #FFEEEE; padding: 30px 0px; letter-spacing: 1px; line-height: 25px; text-align: center;'>&nbsp; &nbsp;<i class='fa fa-close text-danger'></i>&nbsp; &nbsp;Dear <b>$lec_name,</b> <br/>The students you have previously assessed could not be loaded at this time. Try again later...</i></p>";
			}
			}
			}else{
			
			$msg = "<p class='uploadMsg' style='font-size: 16px; color: #444444; background: #EEFFEE; padding: 30px 0px; letter-spacing: 1px; line-height: 25px; text-align: center;'>&nbsp; &nbsp;<i class='fa fa-bell-o text-warning'></i>&nbsp; &nbsp;Dear <b>$lec_name,</b> <br/>You have not yet assessed any student!!!<br/> To assess a student, select <b><i>'assess a student'</i></b> from the top-right navigation bar <i class='fa fa-navicon fa-border'></i></p>";
			
		}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/assessor_header.php"); ?>

		
		<div id="wi_section"> 
			<section id="wis_section">
                <h4>assessed students</h4>
               
				<p class="uploadMsg" id="uploadMsg"><?php echo $msg;?></p> 
				
                 <?php echo $assessedList; ?>
                
               
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
