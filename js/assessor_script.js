$(window).load(function() {
	$("span.wihhn_caret").click(function(){
		$("ul.dropdown-menu").slideToggle("normal");
	});
    
    $("div#wi_section").click(function(){
		$("ul.dropdown-menu").slideUp("normal");
	});
    
    $("div.wisss_result").click(function(){
        $("div.wiss_search").slideUp("slow");
        $("div.wiss_assess").slideDown("normal");
    });
    
   /*  $("span.search").click(function(){
       $("div.wisss_result").css("display", "flex");
       $("div.wisss_result").slideDown("normal");
    }); */
    
    
	$("input#btn_ur").click(function(){
		$("form.upload_part").slideToggle("normal");
	});
	
	$("p#cr").click(function(){
		$("div.acc_login").css("display", "none");
		$("div.acc_create").fadeIn("slow");	
		$('p#msg').css('display', 'block');
		$('p#msg').slideDown('slow');
		
		//handles the custom message of email
		setTimeout(function() {
			$('p#msg').slideUp('slow');
		}, 20000);
	});
	$("p#lo").click(function(){
		$("div.acc_login").fadeIn("slow");	
		$("div.acc_create").css("display", "none");
	});
	
});


//user authentication validation
function validateUser(){
		var n = _("username").value;
		var p = _("password").value;
		
		if(n == "" || p ==""){
			_("msg").innerHTML = "<p id='msg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Some of the fields are missing!!! </p>";
			return false;
		}
		else{
			_("msg").innerHTML = "";
			return true;
		}
}

//image rendering
function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#imageView')
					.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
}

//student project upload validation 
function validateUpload(){
		//var n = _("image").value;
		var p = _("txtarea_title").value;
		//var s = _("supervisor").value;
		var q = _("file").value;
		
		if( p =="" || q == ""){
			_("uploadMsg").innerHTML = "<p class='uploadMsg' style='background: #FFEEEE; padding: 30px 0px; letter-spacing: 2px;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>Some of the fields are missing!!! </p>";
			return false;
		}
		else{
			_("uploadMsg").innerHTML = "";
			return true;
		}
}


//validate assessor search 
function validateSearch(){
		var n = _("reg_no").value;
		
		if(n == ""){
			_("uploadMsg").innerHTML = "<p id='uploadMsg' style='background: #FFEEEE; padding: 10px 0px; letter-spacing: 2px; color: #444;'> <i class='fa fa-close text-danger'>&nbsp; &nbsp;</i>regsitration number is missing!!! </p>";
			return false;
		}
		else{
			_("uploadMsg").innerHTML = "";
			return true;
		}
}


//responsible for embeding project in pdf
function view_file() {
	window.scrollTo(0, 0);
	$(".float_background").css("display", "block");
	$(".float_cont").css("display", "block");
	
}

function close_file() {
	
	$(".float_background").css("display", "none");
	$(".float_cont").css("display", "none");
	
}


//manage lecturer password management
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

//prevent lecturer from assessing before date function
function checkDate(){
			var d = new Date();
			var n = d.getFullYear(); 
			var o = d.getMonth();  
			var m = d.getDate();
			
			//var e = new Date(2016, 10, 28);
			
			if(n == "2016" && o =="10" && m <= "27"){
				$("#cdMsg").css("display", "block");
			}
			else{
				$("#cd").attr("href", "assessor");
				
			}
		}
