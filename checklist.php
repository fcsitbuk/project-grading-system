<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$stu_reg ="";
$stu_name ="";
$select ="";
$status = "";
$prolog ="";
$sent = "";
$received = "";
$item = "";
$count = 1;

if(!isset($_SESSION['student'])){
	header("location: index");
}

	$stu_reg = escape($_SESSION['student']);
	
	$select = $db->query("SELECT gra_student.stu_name, gra_submissions.item, gra_submissions.sent, gra_submissions.received, gra_submissions.status FROM gra_student INNER JOIN gra_submissions ON gra_student.stu_reg=gra_submissions.stu_reg WHERE gra_student.stu_reg='".$stu_reg."' ORDER BY gra_submissions.item DESC") or die($db->error);
	
	if($select->num_rows){
			//transaction log table
			$prolog .= "<h3>progress log</h3>
					<table class='wiss_table wiss_t_checklist' >
						<tr class='wt_header'>
							<th>S/N</th>
							<th>file</th>
							<th>sent</th>
							<th>received</th>
							<th>status</th>
						</tr>";
		while(($row = $select->fetch_assoc()) != null){
			$stu_name = ucwords(strtolower($row['stu_name']));
			$status = escape($row['status']);
			$item = escape($row['item']);
			$sent = escape($row['sent']);
			$received = escape($row['received']);
			
				$prolog .= "<tr class='wt_content'>
							<td class='wt_sn'>$count</td>
							<td class='wt_re2'>$item</td>
							<td class='wt_tt2'>$sent</td>
							<td class='wt_tt2'>$received</td>
							<td class='wt_tt2'>$status</td>
						</tr>";
		$count++;
		}
		
	}else{
		$select = $db->query("SELECT * FROM gra_student WHERE stu_reg='".$stu_reg."' LIMIT 1") or die($db->error);
		if($select->num_rows){
			$row = $select->fetch_assoc();
			$stu_name = ucwords(strtolower($row['stu_name']));
		}
	}
	
	if(isset($_GET['item'])){
		$link = $_GET['item'];
		switch($link){
			case 'Proposal': $_SESSION['item'] = 'Proposal';
							header("location: progress");
							break;
			case 'Chapter 1': $_SESSION['item'] = 'Chapter 1';
							header("location: progress");
							break;
			case 'Chapter 2': $_SESSION['item'] = 'Chapter 2';
							header("location: progress");
							break;
			case 'Chapter 3': $_SESSION['item'] = 'Chapter 3';
							header("location: progress");
							break;
			case 'Chapter 4': $_SESSION['item'] = 'Chapter 4';
							header("location: progress");
							break;
			case 'Chapter 5': $_SESSION['item'] = 'Chapter 5';
							header("location: progress");
							break;
			case 'Preliminaries': $_SESSION['item'] = 'Preliminaries';
							header("location: progress");
							break;
			case 'References': $_SESSION['item'] = 'References';
							header("location: progress");
							break;
			
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/student_header.php"); ?>
		
		<div id="wi_section"> 
		
			<section id="wis_section">
                <h4>Project Checklist</h4>
                
				<p class="instruction bg-info" style="font-weight: normal; font-size: 15px;">1. Click on any component to make a new submission, view submission or view responses from supervisor.<br/> 2. The how to column provides the faculties guideline on how to write the component beside it </p>
                <table class="wiss_table wiss_t_checklist" >
                    <tr class="wt_header">
                        <th>S/N</th>
                        <th>Component</th>
                        <th>how to</th>
                    </tr>
					<tr class='wt_content'>
						<td class='wt_sn'>1.</td>
						<td class='wt_re2'><a href="topic">Topic Submission</a></td>
						<td class='wt_tt2'><a href="gra_projects/topic.pdf" class="text-danger" download="FCSIT - How to select a Topic">Select a topic</a></td>
					</tr>
					<tr class='wt_content'>
						<td class='wt_sn'>2.</td>
						<td class='wt_re2'><a href="?item=Proposal">
						Proposal</a></td>
						<td class='wt_tt2'><a href="gra_projects/proposal.pdf" class="text-danger" download="FCSIT Proposal">Write a proposal</a></td>
					</tr>
					<tr class='wt_content'>
						<td class='wt_sn'>3.</td>
						<td class='wt_re2'><a <a href="?item=Chapter 1">Chapter One</a></td>
						<td class='wt_tt2'><a href="gra_projects/1.pdf" class="text-danger" download="FCSIT - Chapter 1 writing">Write a chapter 1</a></td>
					</tr>
					<tr class='wt_content'>
						<td class='wt_sn'>4.</td>
						<td class='wt_re2'><a href="?item=Chapter 2">Chapter Two</a></td>
						<td class='wt_tt2'><a href="gra_projects/2.pdf" class="text-danger" download="FCSIT - Chapter 2 writing">Write a chapter 2</a></td>
					</tr>
					<tr class='wt_content'>
						<td class='wt_sn'>5.</td>
						<td class='wt_re2'><a href="?item=Chapter 3">Chapter Three</a></td>
						<td class='wt_tt2'><a href="gra_projects/3.pdf" class="text-danger" download="FCSIT - Chapter 3 writing">Write a chapter 3</a></td>
					</tr>
					<tr class='wt_content'>
						<td class='wt_sn'>6.</td>
						<td class='wt_re2'><a href="?item=Chapter 4">Chapter Four</a></td>
						<td class='wt_tt2'><a href="gra_projects/4.pdf" class="text-danger" download="FCSIT - Chapter 4 writing">Write a chapter 4</a></td>
					</tr>
					<tr class='wt_content'>
						<td class='wt_sn'>7.</td>
						<td class='wt_re2'><a href="?item=Chapter 5">Chapter Five</a></td>
						<td class='wt_tt2'><a href="gra_projects/5.pdf" class="text-danger" download="FCSIT - Chapter 5 writing">Write a chapter 5</a></td>
					</tr>
					<tr class='wt_content'>
						<td class='wt_sn'>8.</td>
						<td class='wt_re2'><a href="?item=Preliminaries">Preliminaries</a></td>
						<td class='wt_tt2'><a href="gra_projects/6.pdf" class="text-danger" download="FCSIT - How to arrange preliminaries">Arrange preliminaries</a></td>
					</tr>
					<tr class='wt_content'>
						<td class='wt_sn'>9.</td>
						<td class='wt_re2'><a href="?item=References">References</a></td>
						<td class='wt_tt2'><a href="gra_projects/7.pdf" class="text-danger" download="FCSIT - References">Structure references</a></td>
					</tr>
                </table>
                
				<div class="project_history">
					
						<?php echo $prolog; ?>
					</table>	
				</div> <!-- end of project_history -->
               
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

