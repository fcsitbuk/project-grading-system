<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$select ="";
$stu_reg ="";
$stu_name ="";
$title= "";
$super = "";
$msg ="";
$topic1 ="";
$topic2 ="";
$topic3 ="";
$submitted ="";
$approved ="";
$tmpstmp = date("g:i a, F j, Y");

if(!isset($_SESSION['student'])){
	header("location: index");
}

	$stu_reg = escape($_SESSION['student']);
	
	$select = $db->query("SELECT CONCAT(lecturer_account.lec_title, ' ', lecturer_account.lec_name) AS name, lecturer_account.lec_email, gra_student.stu_name, gra_student.stu_project, gra_submissions.topic1, gra_submissions.topic2, gra_submissions.topic3 FROM gra_student INNER JOIN lecturer_account ON lecturer_account.lec_name=gra_student.stu_supervisor INNER JOIN gra_submissions ON gra_student.stu_reg=gra_submissions.stu_reg WHERE gra_student.stu_reg= '".$stu_reg."' LIMIT 1") or die($db->error);
	
	if($select->num_rows){
		$row = $select->fetch_assoc();
		$stu_name = ucfirst(strtolower($row['stu_name']));
		$super = $row['name'];
		$title= $row['stu_project'];
		$lec_mail = $row['lec_email'];
		$topic1 = ucfirst($row['topic1']);
		$topic2 = ucfirst($row['topic2']);
		$topic3 = ucfirst($row['topic3']);
		
		if($title == ""){
			$approved = "";
		}else{
			$approved = "<div class='approved_topic'>
						<h3>approved topic:</h3>
						<p>$title</p></div>
						<style>
							form.wissa_topics{
								display: none;
							}	
						</style>";
		}
		if($topic1 != "" || $topic2 != "" || $topic3 != ""){
			$submitted = "<p class='submitted_toggle'>Submitted Topics</p>
							<style>
								p.instruction{
									display: none;
								}
							</style>";
		}else{
			$submitted = "";
		}
		
	}else{
		$select = $db->query("SELECT CONCAT(lecturer_account.lec_title, ' ', lecturer_account.lec_name) AS name, lecturer_account.lec_email, gra_student.stu_name, gra_student.stu_project FROM gra_student INNER JOIN lecturer_account ON lecturer_account.lec_name=gra_student.stu_supervisor WHERE gra_student.stu_reg= '".$stu_reg."' LIMIT 1") or die($db->error);
		if($select->num_rows){
			$row = $select->fetch_assoc();
			$stu_name = ucwords(strtolower($row['stu_name']));
			$super = $row['name'];
			$lec_mail = $row['lec_email'];
		}
	}
	
	
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['submit'])){
		$topic1 = escape($_POST['topic1']);
		$topic2 = escape($_POST['topic2']);
		$topic3 = escape($_POST['topic3']);
		 
		if($topic1 != "" && $topic2 != "" && $topic3 != ""){
			$select = $db->query("SELECT * FROM gra_submissions WHERE stu_reg='".$stu_reg."' AND item='Topic'") or die($db->error);
			
			if($select->num_rows){
				$ins = $db->query("UPDATE gra_submissions SET sent= '".$tmpstmp."', topic1= '".$topic1."', topic2= '".$topic2."', topic3= '".$topic3."' WHERE stu_reg= '".$stu_reg."' AND item='Topic' LIMIT 1") or die($db->error);	
			}else{
				$ins = $db->query("INSERT INTO gra_submissions(stu_reg, item, sent, received, status, topic1, topic2, topic3) VALUES('$stu_reg', 'Topic', '$tmpstmp', 'N/A', 'Pending', '$topic1', '$topic2', '$topic3')") or die($db->error);
			}
			
			if($ins){
				$msg ="<p class='uploadMsg' style='background: #EEFFEE; padding: 30px 0px; letter-spacing: 2px; color: green;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>Topics successfully sent!!!<br/>You will be notified by email when $super replies.</p>";
				
				$to = "$lec_mail";
				$subject = "Notification of Topic Selection";
				$msgs = " <html>
				<head>
				<title>Student Topics</title>
				</head>
				<body>
				<p>Dear ".strtoupper($super).",</p>
				<p>$stu_name with registration number $stu_reg under your supervision has expressed interest in some topics and has therefore sent them for your approval. </p>
															
				<p> Click <a href='www.inspiredition.com/fcsit/pgs'>here</a> to access the FCSIT Project Manager</p>
				<p> You may reply to this email for enquiries or complaint</p><br/><br/><br/>
				
				<p>This e-mail and its content are intended for the above named only and may be confidential. If they have come to you in error you MUST not copy or show them to anyone, nor should you take any action based on them, other than to notify the error by replying to the sender.</p>
				
				</body>
				</html>";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
										
				mail($to, $subject, $msgs, $headers); 
										
			}else{
				$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Topic not sent. Please try again !!!</p>";
			}
				
		}else{
			$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Fill out the form to successfully submit!!!</p>";
		}
		
	}
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/student_header.php"); ?>
		
		<div id="wi_section"> 
		<a href="checklist" class="ws_backnav"><i class="fa fa-arrow-left"></i>&nbsp;Go back to checklist</a>
			<section id="wis_section">
                   <h4>topic management</h4>                
                <div class="wiss_assess" style="display: block;">
				
					
					<?php echo $approved; ?>
					
                    <form id="wissa_form" class="wissa_topics" method="POST" onsubmit="return validateUpload()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <p class="uploadMsg" id="uploadMsg"><?php echo $msg;?></p>
                        
						<p class="instruction">Enter the topics you will like to work on in the fields below and click on submit to send to your supervisor (<?php echo $super; ?>) </p>
						
						<?php echo $submitted; ?>
                        <div class="wissaf_topic">
                            <label for="topic1">1st choice:</label>
							<input type="text" class="wt_input" id="topic1" name="topic1" placeholder="Enter your first topic" title="enter 1st topic" value="<?php echo $topic1; ?>" required autofocus/>
                        </div> <!-- end of wissaf_det -->
						<div class="wissaf_topic">
                            <label for="topic1">2nd choice:</label>
							<input type="text" class="wt_input" id="topic2" name="topic2" placeholder="Enter your second topic" value="<?php echo $topic2; ?>"  title="enter 2nd topic"required />
                        </div> <!-- end of wissaf_det -->
						<div class="wissaf_topic">
                            <label for="topic1">3rd choice:</label>
							<input type="text" class="wt_input" id="topic3" name="topic3" placeholder="Enter your third topic" title="enter 3rd topic" value="<?php echo $topic3; ?>" required />
                        </div> <!-- end of wissaf_det -->
                        
                        <div class="wissaf_mark">
                           
                            <input type="submit" class="btn btn-info" name="submit" value="Submit to <?php echo $super;?>" id="save"/>
                        </div> <!-- end of wissaf_mark-->
                        
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

<div class="float_background" onclick="close_file()"></div>
<div class="float_cont">
<p class="close_file" onclick="close_file()"><span>X</span></p>
<embed src="<?php echo "gra_projects/$implode.pdf"; ?>" width="100%" height="95%" zoom="100%" type='application/pdf' >

</div>
    
</body><!--END OF BODY -->

</html> <!--END OF HTML -->