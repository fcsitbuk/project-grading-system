<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$select = "";
$lec_name ="";
$msg ="";
$assess_venue ="";
$lec_title = "";
$lec_others="";

$red1 = md5(time());

if(!isset($_SESSION['assessor'])){
	header("location: index");
}



$lec_name = escape($_SESSION['name']);
$lec_email = escape($_SESSION['assessor']);


	$select = $db->query("SELECT * FROM lecturer_account WHERE lec_name='".$lec_name."' LIMIT 1") or die($db->error);
	
	
	if($select->num_rows){
		$row = $select->fetch_assoc();
		$assess_venue = $row['assess_venue'];
		$title = $row['lec_title'];
		
		$select2 = $db->query("SELECT * FROM lecturer_account WHERE assess_venue='".$assess_venue."' AND assess_venue !='' AND lec_email != '".$lec_email."'") or die($db->error);
		
		$msg .= "<p style='margin: 40px 0px 50px 0px; font-size: 17px; color: #444444; background: #EEFFEE; padding: 30px 0px; letter-spacing: 1px; line-height: 35px; text-align: center;'>&nbsp; &nbsp;<i class='fa fa-bell-o text-warning'></i>&nbsp; &nbsp;Dear <b>$title ". strtoupper($lec_name).",</b> <br/>
		You have been scheduled to assess students defending their projects for the fulfillment <br/>of the requirements of B.Sc Computer Science at <b>$assess_venue.</b> <br/> <br/>
		<b><i class='fa fa-info fa-border'></i></b>&nbsp; &nbsp; Your co-assessors are: &nbsp; &nbsp;";
		if($select2->num_rows){
			while(($row2 = $select2->fetch_assoc()) != null){
				$lec_others = $row2['lec_name'];
				$lec_title = $row2['lec_title'];
				$msg .= "<b>$lec_title $lec_others, &nbsp;";
			}
		}
		$msg .="</b><br/> <br/> <br/> <i class='pull-right fa fa-hand-o-right'><i>&nbsp;See you...</i></i>
		
				</p>";
				
		$msg .= "<p class='uploadMsg' style='font-size: 16px; color: #444444; background: #EEEEFF; padding: 10px 30px; letter-spacing: 1px; line-height: 30px; text-align: center; margin: 10px 0px 100px 0px;'></b>To grade students under your supervision, use  the top-right navigation bar <i class='fa fa-navicon fa-border'></i> and select <i>Students</i>
		</p>";
		
		}
	

?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/supervisor_header.php"); ?>		
		<div id="wi_section"> 
			<section id="wis_section">
                   <h4>defense panel schedule</h4>  

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
