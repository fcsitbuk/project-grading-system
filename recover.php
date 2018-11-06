<?php
error_reporting(0);
require("includes/connect.php");
require("includes/functions.php");


$email ="";
$msg = "";
$select = "";
$pin = "";
$username = "";

if(isset($_POST['mail'])){
		$email = escape($_POST['email']);
		
		if($email != ""){
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Invalid email provided!!! </p>";
			}else{
				$select = $db->query("SELECT * FROM gra_student WHERE stu_mail='".$email."' LIMIT 1") or die($db->error);
					if($select->num_rows){
						$row = $select->fetch_assoc();
						$username = $row['stu_reg'];
						$email = $row['stu_mail'];
						$pin = $row['stu_password'];
						if($pin != ""){
							
								$msg = "<p id='msg' style='background: #EEFFEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-check text-success'>&nbsp; &nbsp;</i>Account with the specified email found. Please check the <b>Inbox or Spam</b> of $email for your LOGIN password and keep it safe!!! </p>";
								
								$to = "$email";
								$subject = "FCSIT PM Password";
								$msgs = " <html>
										<head>
										<title>Student Logical Password Recovery</title>
										</head>
										<body>
										<p>Dear ".strtoupper($username).",</p>
										<p>Your password was successfully recovered </p>
										<p> Your login password is: </p>
										<h1><center>$pin</center></h1>
										<p>Please keep it safe <b>You will be using this PIN to always check your semester result</b></p>
										
										<p> Click <a href='www.inspiredition.com/fcsit/pgs'>here</a> to return to the website </p>
										<p> You may reply to this email for enquiries or complaint</p><br/><br/><br/>
				
										<p>This e-mail and its content are intended for the above named only and may be confidential. If they have come to you in error you MUST not copy or show them to anyone, nor should you take any action based on them, other than to notify the error by replying to the sender.</p>
										</body>
										</html>";
									$headers = "MIME-Version: 1.0" . "\r\n";
									$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
									
									mail($to, $subject, $msgs, $headers); 
							
						}else{
							$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>You have not created an account. Please create account instead!!! </p>";	
						}
						
					}else{
						$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>No account found with the spcified email. Either create an account or contact your level coordinator!!!</p>";	
					}
			}
		}else{
			$msg = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; text-align: center;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Form data incomplete. Please fill !!! </p>";
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
                        <p>Password Recovery</p>    
                    </div>
                    
					<p class="msg" id="msg"><?php echo $msg; ?></p>
					
					<form class="wissd_form" method="post" onsubmit="return validateUser()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
						
                       <p id="msg" style='letter-spacing: 2px; text-align: center;'> 
						Enter the email you provided when creating your account to recover your pin
						
						</p>
						
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw fa-2x"></i></span>
                          <input class="form-control wissaf_input" type="email" placeholder="enter your email" title="pin" name="email" id="password" autofocus required/>
                        </div>

                        <div class="input-submit">
                         <input class="btn btn-warning wissaf_btn" type="submit" title="send pin" value="Recover" name="mail">
                        </div>
						<p class="toggle text-center" id="acc_reco" title="homepage">Back to <a href="index">Homepage</a></p>
					
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

</body><!--END OF BODY -->

</html> <!--END OF HTML -->
