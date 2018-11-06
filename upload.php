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
                   <h4>defense- project upload</h4>                
                <div class="wiss_assess" style="display: block;">
				
				<p class="uploadMsg" id="uploadMsg"><?php echo $msg;?></p>
				
					
                    <form id="wissa_form" method="POST" enctype="multipart/form-data"  onsubmit="return validateUpload()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        
                        <div class="wissaf_img">
                            <img src="<?php echo $pix; ?>" alt="student picture" title="<?php echo $stu_reg.'('.$stu_name.')'?>" id="imageView"/>
                            <div>
                            <input type="file" name="image" id="image" class="image" onchange="readURL(this);" accept="image/gif, image/jpeg, image/png" value="<?php echo $pix;?>" />
                            </div>
                        </div> <!-- end of wissaf_img-->
                        
                        <div class="wissaf_det">
                            <textarea placeholder="Enter your project title here e.g. design and implementation of human teleporting system" name="txtarea_title" id="txtarea_title" required><?php echo $title;?></textarea>
                            <p>by:</p>
                            <p><?php echo $stu_name ." <span>(".$stu_reg.")</span>"; ?></p>
                            <p>supervised by:</p>
                            <select name="supervisor" id="supervisor" class="wd_supervisor" disabled>
                                <option value="">select supervisor</option>
								<?php echo $superlist; ?>
								
                            </select>
                        </div> <!-- end of wissaf_det -->
                        
                        <div class="wissaf_mark">
							<div class="wissafm_uploaded">
								<?php echo $uploaded; ?>
							</div>
							
                            <div class="wissafm_upload" >
                                
                                    <label for="file" class="label_upload"> <i class="fa fa-upload"></i>click to upload your .pdf project file<input type="file" name="file" id="file" class="wissafmuf_file" accept=".pdf" required/> </label>
                                
                            </div> <!-- end of wissafm_upload-->
                            
                            
                           
                            <input type="submit" class="btn btn-info" name="upload" value="Upload" id="save"/>
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