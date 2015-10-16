/* Header js file */

$(document).ready(function() {
	$("#nav").addClass("js").after('<div id="menu">&#x2261;</div>'); // &#9776;
	$("#menu").click(function(){
		$("#nav").slideToggle();
	});
	$("#menu").mouseenter(function(){
		$("#nav").stop().slideDown(500);
	});
	$("#drawer").mouseleave(function(){
		$("#nav").stop().slideUp(450);
	});


	$("#logobox").mouseenter(function(){
		$("#overlay").stop().fadeIn();
	});
	$("#logobox").mouseleave(function(){
		$("#overlay").stop().fadeOut();
	});
});