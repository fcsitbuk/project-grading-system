	function toggle_class() {
	
		$(".left_nav").css("width", "190px");
		$(".left_nav").toggleClass("open");
		
	}
	
	function empty_fields() {
		
		serial = $("#serial").val('');
		
	}
	
	function enable(data) {
		
		//var str = document.getElementById(data).value;
		document.getElementById(data).removeAttribute("readonly")
		//alert(str);
		
	}
	
	function disable(data) {
		
		document.getElementById(data).setAttribute("readonly");
		
	}
	
	function send_data(event, populate) {
		
		var str = document.getElementById(populate).value;
		
		if(event.keyCode == 13) {
			
			event.preventDefault();
			
			if(str.length != 0) {
				
				$.ajax({
					
					url: 'update_field.php',
					type: 'post',
					data: {reg_no : populate, value : str},
					success: function(data) {
						
						document.getElementById(populate).value = str;
						
						$('.student_listing input[type="text"]').prop('readonly', true);
						$('.student_listing textarea').prop('readonly', true);
						
						alert("Field Successfully update");
						
					}
					
				});
				
			}
			
		}
		
	}
	
	function fetch_result() {
		
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
				
				url: 'process_search.php',
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
	
	function alert_me() {
		
		alert("alerted");
		
	}
	
	window.load(empty_fields());

	
	//manage admin password management
function validatePass(){
		var n = _("c_password").value;
		var p = _("n_password").value;
		
		if(n == "" || p ==""){
			_("msg").innerHTML = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Some of the fields are missing!!! </p>";
			return false;
		}
		else if(p.length < 6){
			_("msg").innerHTML = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Password length must be greater than 6</p>";
			return false;
		}
		else{
			_("msg").innerHTML = "";
			return true;
		}
}
