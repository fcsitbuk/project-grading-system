<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$stu_reg ="";
$stu_name ="";
$stu_mail ="";
$select ="";
$item = "";
$topic1 ="";
$topic2 ="";
$topic3 ="";
$msg ="";
$msg2 ="";
$decision ="";
$stu_project = "";
$tmpstmp = date("g:i a, F j, Y");
$red1 = md5(time());

if(!isset($_SESSION['assessor'])){
	header("location: index");
}

	$lec_name = escape($_SESSION['name']);
	$lec_email = escape($_SESSION['assessor']);
	
	$item =   escape($_SESSION['item']);
	$stu_reg = escape($_SESSION['reg']);
	
	$select = $db->query("SELECT gra_student.stu_project, gra_student.stu_mail, gra_student.stu_name, gra_submissions.topic1, gra_submissions.topic2, gra_submissions.topic3 FROM gra_student INNER JOIN gra_submissions ON gra_student.stu_reg=gra_submissions.stu_reg WHERE gra_student.stu_reg= '".$stu_reg."' LIMIT 1") or die($db->error);
	
	if($select->num_rows){
		$row = $select->fetch_assoc();
		$stu_name = ucfirst(strtolower($row['stu_name']));
		$topic1 = ucfirst($row['topic1']);
		$topic2 = ucfirst($row['topic2']);
		$topic3 = ucfirst($row['topic3']);
		$stu_mail = ucfirst($row['stu_mail']);
		$stu_project = strtoupper($row['stu_project']);
		
		if($stu_project == "" || $stu_project =="project title N/A"){
			$approved = "";
		}else{
			$approved = "<div class='approved_topic'>
						<h3>approved topic:</h3>
						<p>$stu_project</p>
						<p class='top_history btn btn-info'>View Proposed Topic</p>
						</div>
						<style>
							form.wissa_topics{
								display: none;
							}	
						</style>";
		}
		 
	}
	
	
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['submit'])){
		$topic1 = escape($_POST['topic1']);
		$topic2 = escape($_POST['topic2']);
		$topic3 = escape($_POST['topic3']);
		$decision = escape($_POST['sel_decision']);
		
		if($topic1 != "" && $topic2 != "" && $topic3 != "" && $decision != ""){
			switch($decision){
				case 1: $decision = $topic1; break;
				case 2: $decision = $topic2; break;
				case 3: $decision = $topic3; break;
			}
			
			$ins = $db->query("UPDATE gra_student SET stu_project = '".$decision."' WHERE stu_reg= '".$stu_reg."'");
			
			if($ins){
				$select = $db->query("SELECT * FROM gra_submissions WHERE stu_reg='".$stu_reg."' AND item = 'Topic' LIMIT 1") or die($db->error);
						
				if($select->num_rows){
					$ins = $db->query("UPDATE gra_submissions SET received = '".$tmpstmp."', status = 'Completed' WHERE stu_reg= '".$stu_reg."' AND item = 'Topic' LIMIT 1");
					
					$msg2 ="<p class='uploadMsg' style='background: #EEFFEE; padding: 30px 0px; letter-spacing: 2px; color: green; text-align: center;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>Approved Topic successfully sent!!!<br/>You will be notified by email when a new file arrives from $stu_name.<br/><b>Refreshing...</b></p>
					<style>
						p.instruction{
							display: none;
						}
					</style>";
					
					$to = "$stu_mail";
					$subject = "Notification of Topic Approval";
					$msgs = " <html>
					<head>
					<title>Approved Topic</title>
					</head>
					<body>
					<p>Dear ".strtoupper($stu_name).",</p>
					<p>$lec_name has approved the topic titled: <br/><center><b>$decision</b></center> </p>
					<p>You are to commence work immediately starting with a project proposal</p>											
					<p> Click <a href='www.inspiredition.com/fcsit/pgs'>here</a> to access the FCSIT Project Manager</p>
					<p> You may reply to this email for enquiries or complaint</p><br/><br/><br/>
					
					<p>This e-mail and its content are intended for the above named only and may be confidential. If they have come to you in error you MUST not copy or show them to anyone, nor should you take any action based on them, other than to notify the error by replying to the sender.</p>
					
					</body>
					</html>";
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
											
					mail($to, $subject, $msgs, $headers); 
					
					header("refresh:5; url= submitted_topic");
				}else{
					$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>This request cannot be processed now. Try again later !!!</p>";
				}					
			}else{
				$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Topic approved not sent. Please try again !!!</p>";
			}
				
		}else{
			$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Fill out the form to successfully submit!!!</p>";
		}
		
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/supervisor_header.php"); ?>
		
		<div id="wi_section"> 
		<a href="stu_checklist?<?php echo "token=$red1$red1&a=$stu_reg&red=$red1&b=$stu_name&c=$stu_project&red=$red1";?>" class="ws_backnav">&nbsp; <i class="fa fa-arrow-left"></i>&nbsp;Go back to checklist</a>
			<section id="wis_section">
                   <h4><?php echo explode(" ", $stu_name)[0]; ?>'s topic</h4>                
                <div class="wiss_assess" style="display: block;">
				
					 <p class="uploadMsg" id="uploadMsg"><?php echo $msg2;?></p>
					<?php echo $approved; ?>
					
                    <form id="wissa_form" class="wissa_topics" method="POST" onsubmit="return validateUpload()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <p class="uploadMsg" id="uploadMsg"><?php echo $msg;?></p>
                        
						<p class="instruction">These topics were proposed by <?php echo ucwords($stu_name);?> for your consideration. Please approve any of them using the select option below the last choice.  <br/> Note that you may modify the project topic before approval using the input field below the choices where applicable.</p>
						
                        <div class="wissaf_topic">
                            <label for="topic1">1st choice:</label>
							<input type="text" class="wt_input" id="topic1" name="topic1" placeholder="Enter your first topic" title="enter 1st topic" value="<?php echo $topic1; ?>" required/>
                        </div> <!-- end of wissaf_det -->
						<div class="wissaf_topic">
                            <label for="topic2">2nd choice:</label>
							<input type="text" class="wt_input" id="topic2" name="topic2" placeholder="Enter your second topic" value="<?php echo $topic2; ?>"  title="enter 2nd topic"required />
                        </div> <!-- end of wissaf_det -->
						<div class="wissaf_topic">
                            <label for="topic3">3rd choice:</label>
							<input type="text" class="wt_input" id="topic3" name="topic3" placeholder="Enter your third topic" title="enter 3rd topic" value="<?php echo $topic3; ?>" required />
                        </div> <!-- end of wissaf_det -->
                        
						<div class="wissaf_decision">
							<div class="wd_div">
								<label for="sel_decision">Approved Topic:</label>
								<select name="sel_decision" id="sel_decision" class="sel_topics" required autofocus>
									<option value="">Select Approved Topic</option>
									<option value="1">Approve 1st Choice</option>
									<option value="2">Approve 2nd Choice</option>
									<option value="3">Approve 3rd Choice</option>
								</select>
							</div>
							<div class="wd_div">
								<input type="submit" class="btn btn-success" name="submit" value="Send to <?php echo explode(" ", $stu_name)[0];?>" id="save"/>
							</div>
						</div>
						
                        
                    </form> <!-- end of wissa_form-->
                    
                </div> <!-- end of wiss_assess -->
                
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

