<?php 
$lec_ini = explode("@", $lec_email);

?>

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCSIT PM</title>
    <link href="css/assessor_style.css" rel="stylesheet" />
    <link href="bt/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
	<link rel="shortcut icon" href="img/sys.ico">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/assessor_jv.js"></script>
    <script type="text/javascript" src="js/assessor_script.js"></script>
	
	<script>
		
		function fetch_student() {
			
			serial = $("#serial").val();
			faculty = $("#faculty").val();
			year = $("#year").val();
			dept = $("#dept").val();
			
			if(serial != "" && faculty != "" && year != "" && dept != "" && serial.length >= 5) {
				
				$(".search_result_holder").addClass("close_class");
				$(".search_inner_wrapper").css("display", "block");
				
				var send = faculty + "/" + year + "/" + dept + "/" + serial;
				
				//$("#in_search").html(send);
				
				$.ajax({
					
					url: 'process_student.php',
					type: 'post',
					data: {reg_no : send},
					success: function(data) {
						
						$(".in_search").html(data);
						
					}
					
				});
				
			}else if(serial.length == 0) {
					
				close_search();
					
			}
			
		}
		
		function close_search() {
		
			$(".search_result_holder").removeClass("close_class");
			$(".search_inner_wrapper").css("display", "none");
			
		}
		
	</script>
	
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
                    <h5 title="user category">assessor</h5>
                    
                    <div class="btn-group open wihhn_div">
                        <span class="wihhn_name" title="assessor name"><?php echo strtoupper(substr($lec_ini[0], 0, 3)); ?></span>
                        <span class="fa fa-navicon wihhn_caret" title=" menu"></span>
                      
                        <ul class="dropdown-menu">
                            <li><a href="assessor"><i class="fa fa-home fa-fw"></i>&nbsp;&nbsp;Assessed students</a></li>
                            <li><a href="assess"><i class="fa fa-th-list fa-fw"></i>&nbsp;&nbsp;Assess a student</a></li>
                            <li><a href="projects"><i class="fa fa-folder-o fa-fw"></i>&nbsp;&nbsp;List of projects</a></li> 
                            <li><a href="supervisor_allocation"><i class="fa fa-user fa-fw"></i>&nbsp;&nbsp;Supervisor Mode</a></li> 
                           
							<li><a href="managekey"><i class="fa fa-key fa-fw"></i>&nbsp;&nbsp;Manage password</a></li>
						   
                            <li class="divider"></li>
                            <li><a href="includes/logout" title="logout"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Logout</a></li>
                        </ul>
                    </div>

                </div> <!-- end of wihh_nav -->
                
			</header>  <!-- end of wih_header -->
		</div> <!-- end of wi_header -->