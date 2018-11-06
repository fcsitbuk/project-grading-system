<?php 
error_reporting(0);
session_start();

require("includes/connect.php");
require("includes/functions.php");

$stu_reg ="";
$stu_name ="";
$select ="";
$trans = "";
$count = 1;
$sent = "";
$received = "";
$item = "";
$status = "";

if(!isset($_SESSION['assessor'])){
	header("location: index");
}

	$lec_name = escape($_SESSION['name']);
	$lec_email = escape($_SESSION['assessor']);
	
if($_SERVER['REQUEST_METHOD'] == "GET"){
	if(isset($_GET['a']) && isset($_GET['b']) && isset($_GET['c'])){
		$stu_reg = $_GET['a'];
		$stu_name = $_GET['b'];
		$stu_project= $_GET['c'];
	
	}
	
	$select = $db->query("SELECT * FROM gra_submissions WHERE stu_reg = '".$stu_reg."' ORDER BY sent DESC") or die($db->error);
	
	if($select->num_rows){
		$trans = "<table class='wiss_table wiss_t_checklist' >
                    <tr class='wt_header'>
                        <th>S/N</th>
                        <th>component</th>
						<th>received</th>
                        <th>replied</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>";
		while(($row = $select->fetch_assoc()) != null){
			$sent = escape($row['sent']);
			$received = escape($row['received']);
			$item = escape($row['item']);
			$status = escape($row['status']);
			
			$trans .= "<tr class='wt_content'>
						<td class='wt_sn'>$count</td>
						<td class='wt_re2'>$item</td>
						<td class='wt_re3'>$sent</td>
						<td class='wt_re3'>$received</td>
						<td class='wt_tt2'>$status</td>
						<td class='wt_tt2'><a href='?item=$item&reg=$stu_reg'>View</a></td>
					</tr>";
			
		$count++;
		}
	}else{
		$trans = "<p class='uploadMsg text-info text-center bg-info' style='padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-info'>&nbsp; &nbsp;</i>No submissions from $stu_name</p>";
	}
	
	
	if(isset($_GET['item'])){
		
		$link = $_GET['item'];
		
		switch($link){
			case 'Topic': 	$_SESSION['item'] = "Topic";
							$_SESSION['reg'] = $_GET['reg'];
							header("location: submitted_topic");
							break;
			case 'Proposal': $_SESSION['item'] = "Proposal";
							$_SESSION['reg'] = $_GET['reg'];
							header("location: stu_progress");
							break;
			case 'Chapter 1': $_SESSION['item'] = 'Chapter 1';
							header("location: stu_progress");
							break;
			case 'Chapter 2': $_SESSION['item'] = 'Chapter 2';
							header("location: stu_progress");
							break;
			case 'Chapter 3': $_SESSION['item'] = 'Chapter 3';
							header("location: stu_progress");
							break;
			case 'Chapter 4': $_SESSION['item'] = 'Chapter 4';
							header("location: stu_progress");
							break;
			case 'Chapter 5': $_SESSION['item'] = 'Chapter 5';
							header("location: stu_progress");
							break;
			case 'Preliminaries': $_SESSION['item'] = 'Preliminaries';
							header("location: stu_progress");
							break;
			case 'References': $_SESSION['item'] = 'References';
							header("location: stu_progress");
							break;
			
		}
	}
}

	

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/supervisor_header.php"); ?>
		
		<div id="wi_section"> 
		
			<section id="wis_section">
                <h4><?php echo ucfirst(strtolower(explode(" ", $stu_name)[0])); ?>'s Checklist</h4>
                
				
                
					<?php echo $trans; ?>
                </table>
                
               
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

