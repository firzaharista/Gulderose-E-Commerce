
$(document).ready(function(){
'use trick';
$("body,html").on("loaded",function(){
	$("#header-v1").addClass("pos-header");
}); 
// ---------scroll-------------------
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
 
  if ($("body,html").scrollTop() > 50) {
  	$("#header-v1").css("transition","all .5s ease");
    $("#header-v1").css("background","rgba(255,255,255,0.95)");
    $("#header-v1").css("box-shadow","0 10px 10px rgba(0,0,0,0.05)");
    $("#header-v1").removeClass("pos-header");
    $("nav").css("display","none");
  } else {
  		$("#header-v1").addClass("pos-header");
     	$("#header-v1").css("background","unset");
    	$("nav").css("display","block");
    	$("#header-v1").css("box-shadow","unset");
    
  }

};

});
