/* Header js file */

$(document).ready(function() {
	$("#nav").addClass("js").after('<div id="menu">&#x2261;</div>'); // &#9776;
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