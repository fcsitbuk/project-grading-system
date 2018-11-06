<?php
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");


if(isset($_SESSION['coordinator'])){
	header("location: coordinator");
}
if(isset($_SESSION['student'])){
	header("location: allocation");
}
if(isset($_SESSION['assessor'])){
	header("location: lec_welcome");
}



$username =	"";
$password = "";
$email ="";
$msg = "";
$select = "";
$crypt = md5("myfcsit");
$token = strtoupper(substr(md5(hexdec(bin2hex(openssl_random_pseudo_bytes(3)))), 0, 5));

if($_SERVER['REQUEST_METHOD'] == "POST"){

	if(isset($_POST['login'])){
		$username = escape($_POST['username']);
		$password = escape($_POST['password']);
		
		
		if(($username != "") && ($password != "")){
			$user_arr = str_split($username);
			
			if(in_array("_", $user_arr)){
				$select = $db->query("SELECT * FROM gra_coord WHERE username='".$username."' AND password='".md5($password)."' LIMIT 1") or die($db->error);
				
				if($select->num_rows){
					$row = $select->fetch_assoc();
					$_SESSION['coordinator'] = $row['username'];
					header("location: coordinator");
				}
				else{
					$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Invalid login details!!! </p>";
				}
			}
			else if(in_array("/", $user_arr)){
				$select = $db->query("SELECT stu_reg, stu_password, stu_venue FROM gra_student WHERE stu_reg='".$username."' AND stu_password='".$password."' LIMIT 1") or die($db->error);
				
				if($select->num_rows){
					$row = $select->fetch_assoc();
					if($row['stu_venue'] == ""){
						$_SESSION['student'] = $row['stu_reg'];
						header("location: student_supervisor");
					}else{						
						$_SESSION['student'] = $row['stu_reg'];
						header("location: allocation");
					}
				}
				else{
					$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Invalid login details!!! </p>";
					
				}
			}
			else {
				//if(in_array("@", $user_arr))
				$select = $db->query("SELECT * FROM lecturer_account WHERE lec_email='".$username."' AND lec_password='".md5($password)."' LIMIT 1") or die($db->error);
				
				if($select->num_rows){
					$row = $select->fetch_assoc();
					$_SESSION['assessor'] = $row['lec_email'];
					$_SESSION['name'] = $row['lec_name'];
					
					if($row['lec_password'] === $crypt){
						header("location:  managekey");
					}else{
						header("location:  lec_welcome");
					}
					
					
				}
				else{
					$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Invalid login details!!! </p>";
				}
			}
			/*else{
				$select = $db->query("SELECT lec_name, lec_password FROM lecturer_account WHERE lec_name='".$username."' AND lec_password='".md5($password)."' LIMIT 1") or die($db->error);
				
				if($select->num_rows){
					$row = $select->fetch_assoc();
					$_SESSION['assessor'] = $row['lec_name'];
					$_SESSION['email'] = $row['lec_email'];
					header("location: assessor");
				}
				else{
					$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Invalid login details!!! </p>";
				}
			}*/
		}
		else{
			$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Form data incomplete. Please fill !!! </p>";
		}
	}

	if(isset($_POST['create'])){
		$email = strtolower(escape($_POST['email']));
		$username = escape($_POST['username']);
		
		if(($email != "") && ($username != "")){
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Invalid email provided!!! </p>";
			}else{
				$select = $db->query("SELECT * FROM gra_student WHERE stu_mail='".$email."' LIMIT 1") or die($db->error);
					if($select->num_rows){
						$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Email has already been used by another student !!! </p>";
					}else{
						$select = $db->query("SELECT * FROM gra_student WHERE stu_reg='".$username."' LIMIT 1") or die($db->error);
						if($select->num_rows){
							$row = $select->fetch_assoc();
							if($row['stu_mail'] == ""){
								$ins = $db->query("UPDATE gra_student SET stu_mail ='".$email."', stu_password ='".$token."' WHERE stu_reg='".$username."'");
								if($ins){
									$msg = "<p id='msg' style='background: #EEFFEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>Success!!! Check the <b>Inbox or Spam</b> of $email for your LOGIN password </p>";
									
									$to = "$email, shamsuddeen2004@gmail.com";
									$subject = "FCSIT Project Manager User Password";
									$msgs = " <html>
											<head>
											<title>Student PM Password</title>
											</head>
											<body>
											<p>Dear ".strtoupper($username).",</p>
											<p>Your account creation was successfull </p>
											<p> Your login password is: </p>
											<h1><center>$token</center></h1>
											<p>Please keep it safe <b>You will be using this PIN untill you finish your project</b></p>
											
											<p> Click <a href='www.inspiredition.com/fcsit/pgs'>here</a> to return to the website </p>
											<p> You may reply to this email for enquiries or complaint</p><br/><br/><br/>
				
											<p>This e-mail and its content are intended for the above named only and may be confidential. If they have come to you in error you MUST not copy or show them to anyone, nor should you take any action based on them, other than to notify the error by replying to the sender.</p>
											</body>
											</html>";
										$headers = "MIME-Version: 1.0" . "\r\n";
										$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
										
										mail($to, $subject, $msgs, $headers); 
								}else{
									$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Ooppss!!! Could not create account at the moment, try again!!!</p>";
								}
							}else{
								$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Account already exist. Please sign in instead!!! </p>";	
							}
							
						}else{
							$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Invalid Registration Number. Contact your level coordinator!!! </p>";	
						}
				
					}
			}
		}else{
			$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Form data incomplete. Please fill !!! </p>";
		}

}

}

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/index_header.php"); ?>
		
		<div id="wi_section"> 
			<section id="wis_section">
                <div class="wiss_div acc_login">
                
                    <div class="wissd_p">
                        <p>user authentication</p>    
                    </div>
                    
					<p class="msg" id="msg"><?php echo $msg; ?></p>
					
					<form class="wissd_form" method="post" onsubmit="return validateUser()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
						
                        <div class="input-group margin-bottom-sm">
                          <span class="input-group-addon"><i class="fa fa-user fa-fw fa-2x"></i></span>
                          <input class="form-control wissdf_input" type="text" placeholder="CST/12/COM/12345" title="registration number" name="username" autofocus required value="<?php excape('username');?>" id="username">
                        </div>
                        
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key fa-fw fa-2x"></i></span>
                          <input class="form-control wissdf_input" type="password" placeholder="Password" title="password" name="password" id="password" required />
                        </div>

                        <div>
                         <input class="btn_login btn btn-primary" type="submit" title="login" value="Login" name="login">
                        </div>
                    
                    </form>
					
					<p class="ac_toggle" id="cr" title="create account" onclick="return false">Don't have an account? <a href="#">Create</a></p>
						
					<p class="ac_toggle" id="ac_forgot" title="create account">Forgot password? <a href="recover">Recover</a></p>
 
                </div>
				
				<div class="acc_create">
					<div class="wissd_p">
                        <p>account creation</p>    
                    </div>
                   
                    <form class="ac_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
						
						<p id="msg" style='background: #FFFFCC; letter-spacing: 2px; text-align: center;'> <?php echo $msg; ?>
						<b> Note: Your login password will be sent to your email address. Therefore make sure you use your valid email preferrably gmail</b></p>
						
                        
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope fa-fw fa-2x"></i></span>
                          <input class="form-control wissaf_input" type="email" placeholder="email address" title="valid email address" name="email" id="email" required/>
                        </div>
						
						<div class="input-group margin-bottom-sm">
                          <span class="input-group-addon"><i class="fa fa-user fa-fw fa-2x"></i></span>
                          <input class="form-control wissaf_input" type="text" placeholder="CST/12/COM/12345" title="registration number" name="username" id="username" required>
                        </div>
                        
						
                        <div class="input-submit">
                         <input class="btn btn-info wissaf_btn" type="submit" title="create account" value="Create Account" name="create">
                        </div>
                    
						<p class="ac_toggle" id="lo" title="login" onclick="return false">Already have an account? <a href="#">Login</a></p>
						
						<div id="wa_App" title="click to download">
							<!-- accept values for javascript -->
						</div>  <!--end of wic_App -->
                    </form>
				</div> <!-- end of acc_create-->
				
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
