<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$lec_name = "";
$msg ="";
$reg_no ="";
$stu_name = "";
$stu_pix ="";
$stu_file ="";
$s_no = "";
$title = "";
$mark1 = "";
$mark2 = "";
$mark3 = "";
$stu_detail ="";
$select = "";
$ins = "";
$venue= "";

if(!isset($_SESSION['assessor'])){
	header("location: index");
}

	$lec_name = escape($_SESSION['name']);
	$lec_email = escape($_SESSION['assessor']);
	
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	//search space codings
	if(isset($_POST['reg_no'])){
		$reg_no = escape($_POST['reg_no']);
		
		$select = $db->query("SELECT * FROM gra_student WHERE stu_reg = '".$reg_no."' LIMIT 1") or die($db->error);
		
		if($select->num_rows){
			$row = $select->fetch_assoc();
			$stu_name = $row['stu_name'];
			$s_no = $row['stu_no'];
			$title = $row['stu_project'];
			$venue = $row['stu_venue'];
			
			
			$explode = explode("/", $reg_no);
			//$implode = implode("_", $explode);
			$implode = implode("", $explode);
			$stu_pix = "gra_pictures/$implode.jpg";
			$stu_file  = "gra_projects/$implode.pdf";
			
			if(file_exists($stu_pix)){
				$stu_pix = "gra_pictures/$implode.jpg";
			}else{
				$stu_pix = "img/image.jpg";
			}
			
			if($title != ""){
				$stu_detail = "<div class='wisss_result' title='click to assess student'><img src='$stu_pix' alt='student photo' title='$stu_name($reg_no)'/><div id='wisssr_detail'><p><i class='fa fa-pencil-square-o fa-edit' title='grade student'></i>$title   
				
				
				</p><h5><span>reg. no.</span>$reg_no</h5><h5><span>name</span>$stu_name</h5><p><span>Venue</span>$venue &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>S/N:</b> $s_no</p></div> </div> ";
				
				$select2 = $db->query("SELECT * FROM gra_asessor WHERE stu_reg = '".$reg_no."' AND ass_name = '".$lec_name."' LIMIT 1") or die($db->error);
				if($select2->num_rows){
					$row2 = $select2->fetch_assoc();
					$mark1 = $row2['mark_pre'];
					$mark2 = $row2['mark_obj'];
					$mark3 = $row2['mark_que'];
				}
				else{
					$mark1 = 0;
					$mark2 = 0;
					$mark3 = 0;
				}
			}else{
				$stu_detail = "<div class='wisss_result' title='click to assess student'><img src='$stu_pix' alt='student photo' title='$stu_name($reg_no)'/><div id='wisssr_detail'><p class='text-danger'>$stu_name did not upload project details</p><h5><span>reg. no.</span>$reg_no</h5><h5><span>name</span>$stu_name</h5><p><span>S/N</span>$s_no</p></div> </div> ";
					$mark1 = 0;
					$mark2 = 0;
					$mark3 = 0;
			}
		}
		else{
			$stu_detail = "<div class='wisss_result' title='click to assess student'><div id='wisssr_detail'><p>$reg_no does not exist</p></div> </div> ";
		}
	}
	
	else if(isset($_POST['save'])){
		$reg_no = escape($_POST['assessee_reg']);
		$mark1 = escape($_POST['factor1']);
		$mark2 = escape($_POST['factor2']);
		$mark3 = escape($_POST['factor3']);
		
		
		$select = $db->query("SELECT * FROM gra_asessor WHERE stu_reg = '".$reg_no."' AND ass_name = '".$lec_name."' LIMIT 1") or die($db->error);
			if($select->num_rows){
				$ins = $db->prepare("UPDATE gra_asessor SET stu_reg = ?, ass_name =?, mark_pre=?, mark_obj=?, mark_que=? WHERE stu_reg='".$reg_no."' AND ass_name='".$lec_name."'");
				$ins->bind_param("ssiii", $reg_no, $lec_name, $mark1, $mark2, $mark3);
				$ins->execute();
				
				if($ins){
					$msg ="<p class='uploadMsg' style='color: #444444; background: #EEFFEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>$reg_no successfully re-assessed!!! <br/><b>Search to assess another student...</b></p>";
					header("refresh:5; url= assess");
				}else{
					$msg = "<p id='uploadMsg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; color: #444;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Could not assess student at this time. Please try again !!!</p>";
				}
			}
			else{
				$ins = $db->prepare("INSERT INTO gra_asessor(stu_reg, ass_name, mark_pre, mark_obj, mark_que) VALUES(?,?,?,?,?)");
				$ins->bind_param("ssiii", $reg_no, $lec_name, $mark1, $mark2, $mark3);
				$ins->execute();
				
				if($ins){
					$msg ="<p class='uploadMsg' style='color: #444444; background: #EEFFEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>$reg_no successfully assessed!!! <br/><b>Search to assess another student...</b></p>";
					header("refresh:5; url= assess");
				}else{
					$msg = "<p id='uploadMsg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; color: #444;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Could not assess student at this time. Please try again !!!</p>";
				}
			}
				
	}
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/assessor_header.php"); ?>

		
		<div id="wi_section"> 
			<section id="wis_section">
                    <h4>assess student</h4>
                
                <div class="wiss_search">
                    
                    <div class="wisss_form">
						<p class="uploadMsg" id="uploadMsg"><?php echo $msg;?></p>
                        
						<p>Enter student registration number below and press enter:</p>
						
						
                        <form class="input-group margin-bottom-sm" method="POST" onsubmit="return validateSearch()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
						
                            <input class="form-control" type="text" placeholder="cst/12/com/12345" name="reg_no" id="reg_no" value="<?php excape('reg_no');?>" pattern='\w{3}[\/]\d{2}[\/]\w{3}[\/]\d{5}' title='Reg Number (Format: CST/12/COM/12345)' required autofocus/>
                   
						</form>
                    </div> <!-- end of wisss_form -->
                    
					<!-- start of wisss_result echo -->
                        <?php echo $stu_detail; ?>
					<!-- end of wisss_result echo -->
					
                </div> <!-- end of wiss_search -->
                
                <div class="wiss_assess">
					
					<p class="uploadMsg" id="uploadMsg"><?php echo $msg;?></p>
					
                    <form id="wissa_form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <div class="wissaf_img">
                            <img src="<?php echo $stu_pix; ?>" alt="student pix" title="<?php echo $stu_name." (".$reg_no.")"; ?>"/>
                        </div> <!-- end of wissaf_img-->
                        
                        <div class="wissaf_det">
                            <h6><?php echo $title; ?><a href="#" onclick="view_file(); return false" class="download_file" target="_blank" download="<?php echo strtoupper($title."(".$reg_no.")"); ?>"><span title="View project" class="file_download">View</span></a></h6>
                            <p>by:</p>
                            <p><?php echo $stu_name; ?> <span>(<?php echo $reg_no; ?>)</span></p>
                        </div> <!-- end of wissaf_det -->
                        
                        <div class="wissaf_mark">
                            <h5>mark allocation</h5>
                            
                            <div class="wissafm_factor">
                                <label for="factor1">Quality of presentation</label>
                                
                                <input type="range" min="0" max="10" class="fac_range" id="factor1" name="factor1" value="<?php echo $mark1; ?>" onchange="range1.value=value"/>
                                
                                <input maxlength="2" type="number" class="fac_res" min="0" max="10" id="range1" name="" value="<?php echo $mark1;?>" onchange="factor1.value=value"/>&nbsp; /10
                                
                            </div> <!-- end of wissafm_factor-->
                            
                            
                            <div class="wissafm_factor">
                                <label for="factor2">Achievement of objectives</label>
                                
                                <input type="range" min="0" max="15" class="fac_range" id="factor2" name="factor2" value="<?php echo $mark2; ?>" onchange="range2.value=value"/>
                                
                                <input maxlength="2" type="number" class="fac_res" min="0" max="15" id="range2" name="" value="<?php echo $mark2; ?>" onchange="factor2.value=value"/>&nbsp; /15
                                
                            </div> <!-- end of wissafm_factor-->
                            
                            <div class="wissafm_factor">
                                <label for="factor3">Response to questions</label>
                                
                                <input type="range" min="0" max="15" class="fac_range" id="factor3" name="factor3" value="<?php echo $mark3; ?>" onchange="range3.value=value"/>
                                
                                <input type="number" maxlength="2" class="fac_res" min="0" max="15" id="range3" name="" value="<?php echo $mark3; ?>" onchange="factor3.value=value"/>&nbsp; /15
                                
                            </div> <!-- end of wissafm_factor-->
                            
                            <input type="text" value="<?php echo $reg_no; ?>" hidden name="assessee_reg"/>
							
                            <input type="submit" class="btn btn-info" name="save" value="Submit" id="save"/>
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
<embed src="<?php echo $stu_file; ?>" width="100%" height="95%" zoom="100%" type='application/pdf' >

</div>
    
</body><!--END OF BODY -->

</html> <!--END OF HTML -->

