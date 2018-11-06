<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$lec_name = "";
$reg_no ="";
$stu_file ="";
$title = "";
$supervisor = "";
$select ="";
$projectList ="";
$count = 1;
$venue = "";

if(!isset($_SESSION['assessor'])){
	header("location: index");
}
	
	$lec_name = escape($_SESSION['name']);
	$lec_email = escape($_SESSION['assessor']);
	
	$select = $db->query("SELECT assess_venue FROM lecturer_account WHERE lec_name = '".$lec_name."'") or die($db->error);
	if($select->num_rows){
		$row = $select->fetch_assoc();
		$venue  = $row['assess_venue'];
	}

	
	$select = $db->query("SELECT * FROM gra_student WHERE stu_venue = '".$venue."' ORDER BY stu_supervisor ASC") or die($db->error);
		
		if($select->num_rows){
			while(($row = $select->fetch_assoc()) != null){
			$reg_no = $row['stu_reg'];
			$title = $row['stu_project'];
			$supervisor = $row['stu_supervisor'];
			$venue = $row['stu_venue'];
			
			$explode = explode("/", $reg_no);
			$implode = implode("_", $explode);
			$stu_file  = "gra_projects/$implode.pdf";
			
		if(file_exists($stu_file)){
			$projectList .= "<tr class='wt_content'><td class='wt_sn'>$count</td>
					<td class='wt_re'>$reg_no</td>
                    <td class='wt_tt'><a href='$stu_file' download='$title' target='_blank'>$title</a></td>
                    <td class='wt_tt'>$venue</a></td>
                    <td class='wt_su'>$supervisor</td></tr>";
		}		
		else{
			$projectList .= "<tr class='wt_content'>
				<td class='wt_sn'>$count</td>
                <td class='wt_re'>$reg_no</td>
                <td class='wt_tt' title='project file does not exist'>$title</td>
                <td class='wt_re'>$venue</td>
                <td class='wt_su'>supervisor N/A</td></tr>";
			}

			$count++;
		}
		}
		else{
			$projectList = "<tr class='wt_content'><td class='wt_re' colspan='5'>No project found in the database</td></tr>";
		}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/assessor_header.php"); ?>
		
		<div id="wi_section"> 
			<section id="wis_section">
                <h4>list of student projects</h4>
                
				<div class="search_stud">
					
					<form class="search_form">
						
						<input type="text" id="faculty" value="CST" size="3" />
						
						<select id="year">
							
							<option value="12">12</option>
							<option value="11">11</option>
							<option value="10">10</option>
							<option value="09">09</option>
							<option value="08">08</option>
						</select>
						
						<select id="dept">
							<option value="COM">COM</option>
							<option value="SWE">SWE</option>
							<option value="ICT">ICT</option>
						</select>
						
						<input type="text" id="serial" placeholder="12345" onkeyup="fetch_student()" size="5" />
						
					</form>
					
				</div>
				
                <table class="wiss_table">
                    <tr class="wt_header">
                        <th>S/N</th>
                        <th>Reg. No.</th>
                        <th>Title</th>
                        <th>Venue</th>
                        <th>Supervisor</th>
                    </tr>
                    <?php echo $projectList; ?>
                    
                </table>
                
               
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

<section id="res_holder" class="search_result_holder ">
	
	<div class="search_inner_wrapper">
		
		<div class="close_div">
		
			<p><span onclick="close_search()" class="close_icon">X</span></p>
			
		</div>
		
		<div class="in_search">
			
			
			
			
		</div>
	
	</div>
		
</section>