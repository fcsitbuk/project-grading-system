<?php 
error_reporting(0);
	
	session_start();
	require("includes/connect.php");
	require("includes/functions.php");
	
	if(!isset($_SESSION['coordinator'])){
		
		header("location: index");
		
	}
	
	$username = escape($_SESSION['coordinator']);
	
$c_password =	"";
$n_password = "";
$msg = "";
$select = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){

	if(isset($_POST['change'])){
		$c_password = escape($_POST['c_password']);
		$n_password = escape($_POST['n_password']);
		
		
		if(($c_password != "") && ($n_password != "")){
				$select = $db->query("SELECT * FROM gra_coord WHERE username='".$username."' AND password='".md5($c_password)."' LIMIT 1") or die($db->error);
				
				if($select->num_rows){
					$row = $select->fetch_assoc();
					$update = $db->query("UPDATE gra_coord SET password = '".md5($n_password)."' WHERE username = '".$username."' LIMIT 1");
					if($update){
						$msg = "<p id='msg' style='background: #EEFFEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>Password successfully changed. <b>Please keep it very safe </b></p>";
						header("refresh:5; url= coordinator");
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
<head>
    <?php require "includes/coordinator_inner_header.php"; ?>
	<link href="bt/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

<?php require "includes/cordinator_header_allocation.php"; ?>

<?php require "includes/cordinator_left_nav.php"; ?>

<section class="content">
	
	<div class="student_file">
		
		<h3 class="section_head"><span class="bold_fl">p</span>roject <span class="bold_fl">c</span>oordinator <span class="bold_fl">k</span>ey <span class="bold_fl">m</span>anager</h3>
		
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
		
	</div>
	
</section>

<section id="res_holder" class="search_result_holder ">
	
	
		
</section>

<footer>
	
	
	
</footer>

</body><!--END OF BODY -->

</html> <!--END OF HTML -->

<script src="js/cordinator_app.js"></script>
