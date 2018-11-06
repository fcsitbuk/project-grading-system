$(document).ready(function(){
	
	$("span.wihhn_caret").click(function(){
		$("ul.dropdown-menu").slideToggle("normal");
	});
	
    $("div#wi_section").click(function(){
		$("ul.dropdown-menu").slideUp("normal");
	});

	 $("section.content").click(function(){
		$("ul.dropdown-menu").slideUp("normal");
	});


  //iterate through each textboxes and add keyup
  //handler to trigger sum event
  $(".wissd_input").each(function() {

   $(this).change(function(){
    calculateSum();
   });
  });
  
  	
  $(".wiss_range").each(function() {

   $(this).change(function(){
    calculateSum2();
   });
  });
	

	$("p.top_history").click(function(){
		$("form.wissa_topics").slideToggle("normal");
	});
	$("input#btn_ur").click(function(){
		$("form.upload_part").slideToggle("normal");
	});
 });

 function calculateSum() {

  var sum = 0;
  var percent = 0;
  //iterate through each textboxes and add the values
  $(".wissd_input").each(function() {

   //add only if the value is number
   if(!isNaN(this.value) && this.value.length!=0) {
    sum += parseFloat(this.value);
   }

  });
  percent = sum * 0.6;
  //.toFixed() method will roundoff the final sum to 2 decimal places
  $("#sum").html(sum.toFixed(2));
  $("#percent").val(percent.toFixed(2));
  
 }
 
 function calculateSum2() {

  var sum = 0;
  var percent = 0;
  //iterate through each textboxes and add the values
  $(".wiss_range").each(function() {

   //add only if the value is number
   if(!isNaN(this.value) && this.value.length!=0) {
    sum += parseFloat(this.value);
   }

  });
  percent = sum * 0.6;
  //.toFixed() method will roundoff the final sum to 2 decimal places
   $("#sum").html(sum.toFixed(2));
   $("#percent").val(percent.toFixed(2));
   
 }
 