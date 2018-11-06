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

$c_password =	"";
$n_password = "";
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


$msg = "<p id='msg' class='bg-warning text-warning' style='padding: 10px 0px; letter-spacing: 2px; font-weight: bold;'> <i class='fa fa-info text-warning'>&nbsp; &nbsp;</i>Welcome $lec_name, Please change your password for security purposes</p>";
$select = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){

	if(isset($_POST['change'])){
		$c_password = escape($_POST['c_password']);
		$n_password = escape($_POST['n_password']);
		
		
		if(($c_password != "") && ($n_password != "")){
				$select = $db->query("SELECT * FROM lecturer_account WHERE lec_email='".$lec_email."' AND lec_name = '".$lec_name."' AND lec_password='".md5($c_password)."' LIMIT 1") or die($db->error);
				
				if($select->num_rows){
					$row = $select->fetch_assoc();
					$update = $db->query("UPDATE lecturer_account SET lec_password = '".md5($n_password)."' WHERE lec_email = '".$lec_email."' AND lec_name = '".$lec_name."' LIMIT 1");
					if($update){
						$msg = "<p id='msg' style='background: #EEFFEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>Password successfully changed. <b>Please keep it very safe </b></p>";
						header("refresh:5; url= lec_welcome");
					}else{
						$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Password could not be changed at the moment!!! </p>";
					}
					
				}
				else{
					$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Invalid password entered!!! </p>";
				}
			
		}
		else{
			$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Form data incomplete. Please fill !!! </p>";
		}
	}
}
	
	
?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once("includes/lec_welcome_header.php"); ?>

		
		<div id="wi_section"> 
			<section id="wis_section">
                <h4 style="">Password Management</h4>
               
				<div class="wiss_change wiss_div">
				
				<p class="msg" id="msg"><?php echo $msg; ?></p>
					
					<form class="wissd_form" method="post" onsubmit="return validatePass()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
						
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon"><i class="fa fa-key fa-fw fa-2x"></i></span>
                          <input class="form-control wissdf_input" type="password" placeholder="Enter current password" title="current password" name="c_password" id="c_password" required/>
                        </div>
                        
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key fa-fw fa-2x"></i></span>
                          <input class="form-control wissdf_input" type="password" placeholder="Enter secured new password" title="new password " name="n_password" id="n_password" required/>
                        </div>

                        <div>
                         <input class="btn_login btn btn-info" type="submit" title="Change" value="Change" name="change">
                        </div>
                    
                    </form>
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
