<?php
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$doc="";
$stu_reg ="";
$stu_name ="";
$stu_project="";
$stu_img="";
$dir = "gra_pictures/";
$mk1= "";
$mk2= "";
$mk3= "";
$mk4= "";
$mk5= "";
$mk6= "";
$mk7= "";
$mk8= "";
$mk9= "";
$mk10= "";
$mktotal="";
$ins ="";
$msg="";


if(!isset($_SESSION['assessor'])){
	header("location: index");
}

$lec_name = escape($_SESSION['name']);
$lec_email = escape($_SESSION['assessor']);

if($_SERVER['REQUEST_METHOD'] == "GET"){
	if(isset($_GET['a'])){
		$stu_reg = $_GET['a'];
		$stu_name = $_GET['b'];
		$stu_project= $_GET['c'];
	
		$stu_img = explode("/", $stu_reg);
		//$stu_img = implode ("_", $stu_img);
		$stu_img = implode ("", $stu_img);
		
		$stu_img = $dir.$stu_img.".jpg";
		
		if(file_exists($stu_img)){
			$stu_img = $stu_img;
		}
		else{
			$stu_img = "img/image.jpg";
		}
		$select = $db->query("SELECT * FROM gra_supervisor WHERE stu_reg = '".$stu_reg."' AND sup_email = '".$lec_email."' LIMIT 1") or die($db->error);
			if($select->num_rows){
				$row= $select->fetch_assoc();
				
				$mk1=  $row['mark_1'];
				$mk2=  $row['mark_2'];
				$mk3=  $row['mark_3'];
				$mk4=  $row['mark_4'];
				$mk5=  $row['mark_5'];
				$mk6=  $row['mark_6'];
				$mk7=  $row['mark_7'];
				$mk8=  $row['mark_8'];
				$mk9=  $row['mark_9'];
				$mk10=  $row['mark_10'];
				$mktotal= $row['mark_total'];
			}else{
				$mk1=  0;
				$mk2=  0;
				$mk3=  0;
				$mk4=  0;
				$mk5=  0;
				$mk6=  0;
				$mk7=  0;
				$mk8=  0;
				$mk9=  0;
				$mk10=  0;
				$mktotal= 0;
			}
	}
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['submit'])){
		$mk1= $_POST['mk1'];
		$mk2= $_POST['mk2'];
		$mk3= $_POST['mk3'];
		$mk4= $_POST['mk4'];
		$mk5= $_POST['mk5'];
		$mk6= $_POST['mk6'];
		$mk7= $_POST['mk7'];
		$mk8= $_POST['mk8'];
		$mk9= $_POST['mk9'];
		$mk10= $_POST['mk10'];
		$mktotal= $_POST['ttl'];
		$stu_reg = $_POST['stuVal'];
		
		$select = $db->query("SELECT * FROM gra_supervisor WHERE stu_reg = '".$stu_reg."' AND sup_email = '".$lec_email."' LIMIT 1") or die($db->error);
			if($select->num_rows){
				$ins = $db->prepare("UPDATE gra_supervisor SET mark_1 = ?, mark_2 = ?, mark_3 = ?, mark_4 = ?, mark_5 = ?, mark_6 = ?, mark_7 = ?, mark_8 = ?, mark_9 = ?, mark_10 = ?, mark_total = ? WHERE stu_reg='".$stu_reg."' AND sup_email='".$lec_email."'");
				$ins->bind_param("sssssssssss", $mk1, $mk2, $mk3, $mk4, $mk5, $mk6, $mk7, $mk8, $mk9, $mk10, $mktotal);
				$ins->execute();
				
				if($ins){
					$msg ="<p class='msg' style='color: #444444; background: #EEFFEE; padding: 30px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>$stu_reg successfully re-assessed!!! <br/><b>Redirecting...</b></p>";
					header("refresh:5; url= supervisor");
				}else{
					$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; color: #444; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Could not re-assess student at this time. Please try again !!!</p>";
				}
			}else{
				
				$ins = $db->prepare("INSERT INTO gra_supervisor(stu_reg, sup_email, mark_1, mark_2, mark_3, mark_4, mark_5, mark_6, mark_7, mark_8, mark_9, mark_10, mark_total) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$ins->bind_param("sssssssssssss", $stu_reg, $lec_email, $mk1, $mk2, $mk3, $mk4, $mk5, $mk6, $mk7, $mk8, $mk9, $mk10, $mktotal);
				$ins->execute();
				
				if($ins){
					$msg ="<p class='msg' style='color: #444444; background: #EEFFEE; padding: 30px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>$stu_reg successfully assessed!!! <br/><b>Redirecting...</b></p>";
					header("refresh:5; url= supervisor");
				}else{
					$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; color: #444; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Could not re-assess student at this time. Please try again !!!</p>";
				}
			}
		
		
		
		
	}
}




?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/supervisor_header.php"); ?>
		
		
		<div id="wi_section"> 
			<section id="wis_section">
				<p class="msg"> <?php echo $msg; ?></p>
			
               <div id="profile_image">
					<img src="<?php echo $stu_img; ?>"/>
			   </div>
		
				
				<div class="my_details"> 
					
					<div class="inner_my_details">
						<div class="innera"><p> Name: </p></div>
						<div class="innerb"><p> <?php echo $stu_name;?> </p> </div>
						<p class="clear"> </p>
					</div>
					
					<div class="inner_my_details">
						<div class="innera"> <p> Reg. No: </p></div>
						<div class="innerb"> <p> <?php echo $stu_reg;?> </p></div>
						<p class="clear"> </p>
					</div>
					
					<div class="inner_my_details">
						<div class="innera"><p> Project Title: </p></div>
						<div class="innerb"> <p> <?php echo $stu_project;?> </p></div>
						<p class="clear"> </p>
					</div>
					
				</div>
				
					
				
				
				
				<div class="urScore">  Allocate Score </div>
				
				
				<div class="my_details"> 
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">	
				<input type="text" value="<?php echo $stu_reg;?>" name="stuVal" hidden/>
					<div class="inner_my_details">
						<div class="inner1"><p> Abstract: </p></div>
						<div class="inner2">
						<input id="re" type="range" name="rangeInput" value="<?php echo $mk1; ?>" min="0" max="5" onchange="textInput.value=value" class="wiss_range"/>
						<input type="number" id="textInput"  name="mk1" min="0" max="5" maxlength="1"  value="<?php echo $mk1; ?>" onchange="re.value=value" class="wissd_input"/>
						<p>  / 5 </p></div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> Background of the Study/Introduction: </p></div>
						<div class="inner2">
						<input id="re2" type="range" name="rangeInput" value="<?php echo $mk2; ?>" min="0" max="5" onchange="textInput2.value=value" class="wiss_range"/>
						<input type="number" id="textInput2"  name="mk2" min="0" max="5" maxlength="1"  value="<?php echo $mk2; ?>" onchange="re2.value=value" class="wissd_input"/> <p> /&nbsp; 5 </p></div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> State of the Problem: </p></div>
						<div class="inner2">
						<input id="re3" type="range" name="rangeInput" value="<?php echo $mk3; ?>" min="0" max="5" onchange="textInput3.value=value" class="wiss_range"/>
						<input type="number" id="textInput3" name="mk3"  min="0" max="5" maxlength="1"  value="<?php echo $mk3; ?>" onchange="re3.value=value" class="wissd_input"/> <p> /&nbsp; 5 </p></div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> Aim and Objectives/Significance: </p></div>
						<div class="inner2">
						<input id="re4" type="range" name="rangeInput" value="<?php echo $mk4; ?>" min="0" max="10" onchange="textInput4.value=value" class="wiss_range"/>
						<input type="number" id="textInput4"  name="mk4" min="0" max="10" maxlength="2"  value="<?php echo $mk4; ?>" onchange="re4.value=value" class="wissd_input"/> <p> / 10</p> </div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> Literature Review: </p></div>
						<div class="inner2">
						
						<input id="re5" type="range" name="rangeInput" value="<?php echo $mk5; ?>" min="0" max="15" onchange="textInput5.value=value" class="wiss_range"/>
						
						<input type="number" id="textInput5"  name="mk5" min="0" max="15" maxlength="2"  value="<?php echo $mk5; ?>" onchange="re5.value=value" class="wissd_input"/><p>  / 15 </p></div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> Methodology or System Analysis and Design: </p></div>
						<div class="inner2">
						<input id="re6" type="range" name="rangeInput" value="<?php echo $mk6; ?>" min="0" max="15" onchange="textInput6.value=value" class="wiss_range"/>
						<input type="number" id="textInput6"  name="mk6" min="0" max="15" maxlength="2"  value="<?php echo $mk6; ?>" onchange="re6.value=value" class="wissd_input"/> <p>  / 15 </p></div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> Implementation and Testing or Results and Discussion: </p></div>
						<div class="inner2">
						<input id="re7" type="range" name="rangeInput" value="<?php echo $mk7; ?>" min="0" max="25" onchange="textInput7.value=value" class="wiss_range"/>
						<input type="number" id="textInput7"  name="mk7" min="0" max="25" maxlength="2"  value="<?php echo $mk7; ?>" onchange="re7.value=value" class="wissd_input"/> <p> / 25 </p></div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> Conclusion(s) / Recommendation(s): </p></div>
						<div class="inner2">
						<input id="re8" type="range" name="rangeInput" value="<?php echo $mk8; ?>" min="0" max="5" onchange="textInput8.value=value" class="wiss_range"/>
						<input type="number" id="textInput8"  name="mk8" min="0" max="5" maxlength="1"  value="<?php echo $mk8; ?>" onchange="re8.value=value" class="wissd_input"/> <p>  /&nbsp; 5 </p></div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> Referencing: </p></div>
						<div class="inner2">
						<input id="re9" type="range" name="rangeInput" value="<?php echo $mk9; ?>" min="0" max="5" onchange="textInput9.value=value" class="wiss_range"/>
						<input type="number" id="textInput9"  name="mk9" min="0" max="5" maxlength="1"  value="<?php echo $mk9; ?>" onchange="re9.value=value" class="wissd_input"/> <p>  /&nbsp; 5 </p> </div>
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1"><p> Overall Quality of the work (Including Structure and English): </p></div>
						<div class="inner2">
						<input id="re10" type="range" name="rangeInput" value="<?php echo $mk10; ?>" min="0" max="10" onchange="textInput10.value=value" class="wiss_range"/>
						
						<input type="number" id="textInput10"  name="mk10" min="0" max="10" maxlength="2"  value="<?php echo $mk10; ?>" onchange="re10.value=value" class="wissd_input"/> <p> / 10 </p></div>
						
						<p class="clear"> </p>
					</div>
					
					
					<div class="inner_my_details">
						<div class="inner1" id="total"><p> Total: </p></div>
						
						<div id="sum" ><?php echo round($mktotal/60*100); ?></div>
						<p class="clear"> </p>
					</div>
						
						
					<div class="inner_my_details">
						<div class="inner1" id="total"><p> Project Supervisor Marks (60%): </p></div>
						
						<div id="pp"><input type="text" id="percent" name="ttl" value="<?php echo $mktotal; ?>"/></div>
						
						<p class="clear"> </p>
					</div>
							
					<div class="inner_my_details">
						
						<div id="button" >
						<button id="bttn" type="submit" name="submit"> Submit </button>
						</div>
						<p class="clear"> </p>
					</div>

					
			</form>		
					
			</div>
		</section> <!-- end of wis_section -->
		</div> <!-- end of wi_section -->
		
		<div id="wi_footer" title="powered by #teamSHM#">
			<?php include_once("includes/assessor_footer.php"); ?>
		</div> <!-- end of wi_footer -->
		
	</div> <!-- end of w_inner -->
</div> <!--END OF div#wrapper -->

</body><!--END OF BODY -->

</html> <!--END OF HTML -->
