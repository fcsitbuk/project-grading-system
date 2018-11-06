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
$pix = "";
$project = "";
$msg ="";
$uploaded = "";

if(!isset($_SESSION['student'])){
	header("location: index");
}

	$stu_reg = escape($_SESSION['student']);
	
	$select = $db->query("SELECT * FROM gra_student WHERE stu_reg='".$stu_reg."' LIMIT 1") or die($db->error);
	
	if($select->num_rows){
		$row = $select->fetch_assoc();
		$stu_name = ucfirst(strtolower($row['stu_name']));
		$title = strtoupper($row['stu_project']);
		$super = $row['stu_supervisor'];
		
		$explode = explode("/", $stu_reg);
		//$implode = implode("_", $explode);
		$implode = implode("", $explode);
		$pix = "gra_pictures/$implode.jpg";
		$uploaded = "gra_projects/$implode.pdf";
		if(file_exists($pix)){
			$pix = "gra_pictures/$implode.jpg";
		}else{
			$pix = "img/image.jpg";
		}
		
		if(file_exists($uploaded)){
			$uploaded = "<p class='uploadMsg' style='background: #EEFFEE; padding: 20px 10px; letter-spacing: 2px; font-size: 16px;'> <b>Uploaded Project:</b> &nbsp;&nbsp; <a href='gra_projects/$implode.pdf' title='click to view' onclick='view_file(); return false'>".ucfirst(strtolower($title)).".pdf</a></p>";
		}else{
			$uploaded ="";
		}
		
		if($title == "PROJECT TITLE N/A"){$title = "";}else{$title = $title;}
		
		$select = $db->query("SELECT * FROM lecturer_account WHERE lec_name != 'ExamOfficer' ORDER BY lec_name ASC") or die($db->error);
		
		if($select->num_rows){
			while(($row = $select->fetch_assoc()) != null){
				if($super == $row['lec_name']){
					$superlist .= "<option selected='".$super."' value='".$row['lec_name']."'>".$row['lec_name']."</option>";
				}
				else{
					$superlist .= "<option value='".$row['lec_name']."'>".$row['lec_name']."</option>";
				}
			}
		}
	}
	
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['upload'])){
		$title = escape($_POST['txtarea_title']);
		//$super = escape($_POST['supervisor']);
		//$pic = $_FILES['image']['name'];
		$pic = $_FILES['file']['name'];
		
		//$allowed_pix = array('jpg', 'jpeg', 'png', 'gif');
		$allowed_file = array('pdf');
		
		//$img_ext = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
		
		$file_ext = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1);
		
		
		if($title != ""){
				if(in_array($file_ext, $allowed_file)){
					$explode = explode("/", $stu_reg);
					$implode = implode("", $explode);
					//$new_Image = "$implode.jpg";
					$new_File = "$implode.pdf";
					
					//$uploadImage = move_uploaded_file($_FILES['image']['tmp_name'], "gra_pictures/".$new_Image);
					$uploadFile= move_uploaded_file($_FILES['file']['tmp_name'], "gra_projects/".$new_File);
					
					if($uploadFile){
						$ins = $db->query("UPDATE gra_student SET stu_project= '".$title."' WHERE stu_reg= '".$stu_reg."'");
						if($ins){
							$msg ="<p class='uploadMsg' style='background: #EEFFEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>Successfully uploaded. You can logout!!!</p>";
						}else{
							$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Your details were not successfully saved. Please try again !!!</p>";
						}
					}
					else{
						$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>There is an error in the file upload. Please try again!!!</p>";
					}
				}
				else{
					$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>File type not accepted!!!</p>";
				}
			}
		else{
			$msg ="<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Fill out the form to successfully submit!!!</p>";
		}
		
	}
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/student_header.php"); ?>
		
		<div id="wi_section"> 
			<section id="wis_section">
                   <h4>Defense Tips</h4>                
                <div class="wiss_assess wiss_tips">
					
					<div class="wissa_left">
						<h5 class="wissal_h5"><i class='fa fa-check text-success'>&nbsp; &nbsp;</i>Defense good practices</h5>
						
						<ul class="ulmain">
							<li>Presenting your work
								<ul class="u_inner"> 
									<li>> Prepare and practise for your presentation</li>
									<li>> Have a logical structure:
										<ul class="ui_inner">
											<li>- Who you are</li>
											<li>- What you are going to talk about</li>
											<li>- Your research objectives</li>
											<li>- How you did your research</li>
										</ul>
									</li>
								</ul>
							</li>
							
							<li>The Defense
								<ul class="u_inner"> 
									<li>> Prior to your defense, summarize your project chapters</li>
									<li>> Anticipate questions (and prepare answers):
										<ul class="ui_inner">
											<li>- on preliminary issues (e.g. research focus, need for your research, etc.)</li>
											<li>- Aspects of your Lit. Rev.</li>
											<li>- Your conclusions (justified?) and associated recommendations</li>
										</ul>
									</li>
									<li>> Have a mock defense with your colleagues, family, relatives and or supervisor (asks your supervisor if he/she would not mind) </li>
									<li>> Write examiner questions down</li>
									<li>> Take your time answering questions</li>
								</ul>
							</li>
							
							<li>The Marking Scheme
								<ul class="u_inner"> 
									<li>> Find out how your project will be graded</li>
									<li>> Use it as a checklist as you do the work (are your research objectives clear, do you show evidence of critical evaluation? Etc.)</li>
									<li>> Pick up easy marks (for abstract, dissertation structure, referencing, research objectives) </li>
									<li>> Make sure that you know which sections attract more marks in your project</li>
									<li>> Before submission, have a go at marking it yourself!</li>
								</ul>
							</li>
							
							<li>Grammar
								<ul class="u_inner"> 
									<li>> Watch your language!</li>
								</ul>
							</li>
							
							<li>Plagiarism
								<ul class="u_inner"> 
									<li>> Understand the Faculty’s rules and regulations on plagiarism</li>
									<li>> Give credit where credit is due!</li>
								</ul>
							</li>
						
						</ul>
					
					</div> <!-- end of wissa_left -->
					
					<div class="wissa_right">
						<h5 class="wissal_h5"> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Defense bad practices</h5>
						
						<ul class="ulmain">
							<li>Presenting your work
								<ul class="u_inner"> 
									<li>> Do not fumble with the equipment</li>
									<li>> Do not rush through your presentation at break-neck speed!</li>
									<li>> Do not clutter your screen with text</li>
									<li>> Do not stand in front of your projector (blocking your presentation!)</li>
									<li>> Do not read directly from your notes</li>
									
								</ul>
							</li>
							
							<li>The Project
								<ul class="u_inner"> 
									<li>> Do not anticipate obvious questions</li>
									<li>> Do not rush your answers</li>
									<li>> Do not argue with the defense panel members (there is a difference between having a professional disagreement and rudeness)</li>
									<li>> Do not give monosyllabic answers (e.g. no, yes, etc)</li>
									<li>> Do not refer to your project when answering questions (you are being tested on the work that you have submitted, so it is to your work that you refer when giving answers) </li>
								</ul>
							</li>
							
							<li>Plagiarism
								<ul class="u_inner"> 
									<li>> Do not copy the work of others without due acknowledgement </li>
								</ul>
							</li>
						
						</ul>
					
					</div> <!-- end of wissa_right -->
					
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


<script>
	


	
</script>

