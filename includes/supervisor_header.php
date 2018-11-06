<?php

$lec_ini = explode("@", $lec_email);

?>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FCSIT PM</title>
	<link href="bt/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/supervisor_style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
	<link rel="shortcut icon" href="img/sys.ico">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/supervisor_script.js"></script>
	 
	
</head>

<body> 
<div id="theme"></div>
<div id="wrapper">
	<div id="w_inner"> 
		
		<div id="wi_header"> 
			<header id="wih_header"> 
				<div class="wihh_name">
                    <h2> <i class="fa fa-folder-open-o"> </i>
					
					<span class="wihhn_span">F</span>CSIT
                        <span class="wihhn_span">p</span>roject
                        <span class="wihhn_span">m</span>anager
                        
                    </h2>
                </div> <!-- end of wihh_name -->
                
                <div class="wihh_nav">
                    <h5 title="user category">supervisor</h5>
                    
                    <div class="btn-group open wihhn_div">
                        <span class="wihhn_name" title="supervisor name"><?php echo strtoupper(substr($lec_ini[0], 0, 3)); ?></span>
                        <span class="fa fa-navicon wihhn_caret" title=" menu"></span>
                      
                        <ul class="dropdown-menu">
                            <li><a href="supervisor"><i class="fa fa-home fa-fw"></i>&nbsp;&nbsp;Students</a></li>
							<li><a href="supervisor_allocation" onClick="statSche(); return false;"><i class="fa fa-wpforms fa-fw"></i>&nbsp;&nbsp;Defense schedule</a></li>
                            <li><a href="assessor" onClick="statSche(); return false;"><i class="fa fa-user fa-fw"></i>&nbsp;&nbsp;Assessor Mode</a></li>
							<li><a href="managekey"><i class="fa fa-key fa-fw"></i>&nbsp;&nbsp;Manage password</a></li>
                            
                            <li class="divider"></li>
                            <li><a href="includes/logout" title="logout"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Logout</a></li>
                        </ul>
                    </div>

                </div> <!-- end of wihh_nav -->
                
			</header>  <!-- end of wih_header -->
		</div> <!-- end of wi_header -->
		
		<script>
			function statSche(){
				alert("Sorry, feature not yet enabled...");
			}
		</script>