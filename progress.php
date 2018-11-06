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
$superlist = "";
$doc = "";
$project = "";
$lec_mail ="";
$msg ="";
$uploaded = "";
$item = "";
$dir = "gra_projects";
$tmpstmp = date("g:i a, F j, Y");

if(!isset($_SESSION['student'])){
	header("location: index");
}

	$stu_reg = escape($_SESSION['student']);
	$item =  ucfirst(escape($_SESSION['item']));
	
	
	$select = $db->query("SELECT CONCAT(lecturer_account.lec_title, ' ', lecturer_account.lec_name) AS name, lecturer_account.lec_email, gra_student.stu_name, gra_student.stu_project FROM gra_student INNER JOIN lecturer_account ON lecturer_account.lec_name=gra_student.stu_supervisor WHERE gra_student.stu_reg= '".$stu_reg."' LIMIT 1") or die($db->error);
	
	$select2 = $db->query("SELECT * FROM gra_submissions WHERE stu_reg= '".$stu_reg."' AND item = '".$item."' LIMIT 1") or die($db->error);

	if($select->num_rows || $select2->num_rows){
		$row = $select->fetch_assoc();
		$row2 = $select2->fetch_assoc();
		
		$stu_name = ucfirst(strtolower($row['stu_name']));
		$title = strtoupper($row['stu_project']);
		$super = $row['name'];
		$lec_mail = $row['lec_email'];
		
		if($row2['item'] == $item){
			$sent = "Time: ".$row2['sent'];
			$received = "Time: ".$row2['received'];
		}else{
			$sent=$received="";
		}
	
		$explode = implode("", explode("/", $stu_reg));
		$uploaded = "$dir/$explode/";
		
	}
	
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['upload'])){
		$doc = $_FILES['file']['name'];
		
		$allowed_file = array('doc', 'docx');
		$file_ext = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1);
		
		
		if($doc != ""){
				if(in_array($file_ext, $allowed_file)){
					
					$explode = implode("", explode("/", $stu_reg));
					$new_File = "Sent ($item) $explode.docx";
					
					if(file_exists("$dir/$explode")){
						$uploadFile= move_uploaded_file($_FILES['file']['tmp_name'], "$dir/$explode/$new_File");
					}else{
						mkdir("$dir/$explode");
						copy("$dir/index.php", "$dir/$explode/index.php");
						$uploadFile= move_uploaded_file($_FILES['file']['tmp_name'], "$dir/$explode/$new_File");
					}
					if($uploadFile){
						$select = $db->query("SELECT * FROM gra_submissions WHERE stu_reg='".$stu_reg."' AND item = '".$item."' LIMIT 1") or die($db->error);
						
						if($select->num_rows){
							$ins = $db->query("UPDATE gra_submissions SET sent = '".$tmpstmp."' WHERE stu_reg= '".$stu_reg."' AND item = '".$item."'");
								
						}else{
							$ins = $db->query("INSERT INTO gra_submissions(stu_reg, item, sent, received, status) VALUES('$stu_reg', '$item', '$tmpstmp', 'N/A', 'Pending')");
						}
						
						if($ins){
							$msg ="<p class='uploadMsg' style='background: #EEFFEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>$item successfully sent to your supervisor ($super)</p>";
						
							$to = "$lec_mail";
							$subject = "Notification of $item submission";
							$msgs = " <html>
							<head>
							<title>$item submission</title>
							</head>
							<body>
							<p>Dear ".strtoupper($super).",</p>
							<p>$stu_name with registration number $stu_reg under your supervision has sent the $item of $title to your dashboard. </p>
							<p>The student is requesting your valuable feedback as soon as possible. </p>
																		
							<p> Click <a href='www.inspiredition.com/fcsit/pgs'>here</a> to access the FCSIT Project Manager</p>
							<p> You may reply to this email for enquiries or complaint</p><br/><br/><br/>
							
							<p>This e-mail and its content are intended for the above named only and may be confidential. If they have come to you in error you MUST not copy or show them to anyone, nor should you take any action based on them, other than to notify the error by replying to the sender.</p>
							
							</body>
							</html>";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
													
							mail($to, $subject, $msgs, $headers); 	
						}
					}else{
						$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Could not send the file at this moment. Please try again!!!</p>";
					}
					
				}
				else{
					$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>File type not accepted!!!</p>";
				}
			}
		else{
			$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Please upload the file correctly!!!</p>";
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
                   <h4><?php echo $item; ?> management</h4>        
				
                <div class="wiss_assess" style="display: block;">
				
				<div class="upload_history">
					<div class="uh_sent bg-success">
						<h5>Sent <?php echo $item; ?></h5>
						<a href="<?php 
							if(file_exists("$uploaded/Sent ($item) $explode.docx")){
								echo "$uploaded/Sent ($item) $explode.docx";
							}else{
								echo "";
							}
						?>"><?php 
							if(file_exists("$uploaded/Sent ($item) $explode.docx")){
								echo "Download $item: $title";
							}else{
								echo "<p style='text-decoration: none; font-size: 16px; color: red;'>No file sent yet!!!</p>";
							}
						?></a>
						<span class='uhs_time'><?php echo $sent; ?></span>
						
					</div>
					
					<div class="uh_received bg-info">
						<h5>Received <?php echo $item; ?></h5>
						
						<a href="<?php 
							if(file_exists("$uploaded/Received ($item) $explode.docx")){
								echo "$uploaded/Received ($item) $explode.docx";
							}
						?>"><?php 
							if(file_exists("$uploaded/Received ($item) $explode.docx")){
								echo "Download $item - $title
								<style>
									form.upload_part{
										display: none;
									}
								</style>";
							}else{
								echo "<p style='text-decoration: none; font-size: 16px; color: red;'>No replies yet!!!</p>
								<style>
									input#btn_ur{
										display: none;
									}
								</style>
								";
							}
						?></a>						
						<span class="uhs_time"><?php echo $received; ?></span>
						
						<input type="submit" class="reply btn btn-primary" value="Reply" id="btn_ur">
						
					</div>
					
				</div>
				
				<p class="uploadMsg" id="uploadMsg"><?php echo $msg;?></p>
				
					
                    <form id="wissa_form" class="upload_part" method="POST" enctype="multipart/form-data"  onsubmit="return validateUpload()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        
                       
                        
                        <div class="wissaf_mark">
							
                            <div class="wissafm_upload" >
                                
                                    <label for="file" class="label_upload"> <i class="fa fa-upload"></i>click to upload your word document <?php echo $item; ?><input type="file" name="file" id="file" class="wissafmuf_file" accept=".docx, .doc" required/> </label>
                                
                            </div> <!-- end of wissafm_upload-->
                            
                            
                           
                            <input type="submit" class="btn btn-info" name="upload" value="Send to <?php echo $super; ?>" id="save"/>
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