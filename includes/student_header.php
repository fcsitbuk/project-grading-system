<?php 
$stu_ini = explode(" ", $stu_name);
?>

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student - PM</title>
    <link href="css/assessor_style.css" rel="stylesheet" />
    <link href="bt/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
	<link rel="shortcut icon" href="img/stu.ico">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/assessor_jv.js"></script>
    <script type="text/javascript" src="js/assessor_script.js"></script>
</head>

<body>
<div id="theme"></div> 
<div id="wrapper">
	<div id="w_inner"> 
		
		<div id="wi_header"> 
			<header id="wih_header"> 
				<div id="wh_img">
                    <img src="img/buk.png" alt="buk"/>
                </div>
				<div class="wihh_name">
                    <h2><span class="wihhn_span">F</span>CSIT
                        <span class="wihhn_span">p</span>roject
                        <span class="wihhn_span">M</span>anager
                        
                    </h2>
                </div> <!-- end of wihh_name -->
                
                <div class="wihh_nav">
                    <h5 title="user category">student</h5>
                    
                    <div class="btn-group open wihhn_div">
                        <span class="wihhn_name" title="student name"><?php echo strtoupper(substr($stu_ini[0], 0, 1))." ". strtoupper(substr($stu_ini[2], 0, 1)); ?></span>
                        <span class="fa fa-navicon wihhn_caret" title=" menu"></span>
                      
                       <ul class="dropdown-menu">
							<li><a href="student_supervisor"><i class="fa fa-wpforms fa-fw"></i>&nbsp;&nbsp;Allocated Supervisor</a></li>
							
							<li><a href="checklist"><i class="fa fa-calendar-check-o fa-fw"></i>&nbsp;&nbsp;My Checklist</a></li>
							<!-- hide defense schedule untill close the period of defence-->
								<li><a href="allocation" onClick="statSche(); return false;"><i class="fa fa-clock-o fa-fw"></i>&nbsp;&nbsp;Defense schedule</a></li>
							<!-- hide defense schedule untill close the period of defence-->
                            <li><a href="upload" onClick="statUpl(); return false;"><i class="fa fa-upload fa-fw"></i>&nbsp;&nbsp;Upload for defense</a></li>
                            <li><a href="gra_projects/preject presentation guideline.pptx"><i class="fa fa-file-powerpoint-o fa-fw"></i>&nbsp;&nbsp;Presentation Template</a></li>
                            <li><a href="tips"><i class="fa fa-columns fa-fw"></i>&nbsp;&nbsp;Defense Tips</a></li>
                            
                            <li class="divider"></li>
                            <li><a href="includes/logout" title="logout"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Logout</a></li>
                        </ul>
                    </div>

                </div> <!-- end of wihh_nav -->
                
			</header>  <!-- end of wih_header -->
		</div> <!-- end of wi_header -->
		
		<script>
			function statSche(){
				alert("Sorry, you are not yet scheduled for defense!!!");
			}
			function statUpl(){
				alert("Sorry, you are not yet cleared for defense");
			}
		</script>