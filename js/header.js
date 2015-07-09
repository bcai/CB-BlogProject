/* Header js file */

$(document).ready(function() {
	$("#nav").addClass("js").after('<div id="menu">&#9776;</div>');
	$("#menu").click(function(){
		$("#nav").slideToggle();
	});


	$("#logobox").mouseenter(function(){
		$("#overlay").stop().fadeIn();
	});
	$("#logobox").mouseleave(function(){
		$("#overlay").stop().fadeOut();
	});
});