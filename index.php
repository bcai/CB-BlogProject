<!--Author: Brandon Cai, Connie Xu-->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>C&amp;B | Redeemed Thought</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<link href="../css/header.css" rel="stylesheet" type="text/css"/>
	<link href="../css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../css/slider.css" rel="stylesheet" type="text/css"/>
	<link href="../css/overlay.css" rel="stylesheet" type="text/css"/>
	<link href="../css/transitions.css" rel="stylesheet" type="text/css"/>
</head>

<body>
	<div class="container">
		<!--Header (Logo & Title)-->
		<header>
			<div id="logobox">
				<div id="logo"><img src="../images/CB.png" height="37" width="93" alt="C&amp;B"></div>
				<div id="overlay"><a href="../index.php"><img src="../images/CBblue.png" height="37" width="93" alt="C&amp;B"></a></div>
			</div>
			<div id="title"><h1>Redeemed Thought</h1></div>
			<div id="drawer"><ul id="nav">
				<li><a href="../drawer.php?drawer=gospel">The Gospel</a></li>
				<li><a href="../drawer.php?drawer=about">About</a></li>
				<li><a href="../drawer.php?drawer=resources">Resources</a></li>
			</ul></div>
		</header>

		<!--Primary Content-->
		<div id="primary">
			<div class="carousel">

				<!-- Slider Panels -->
				<div class="inner">
					<div class="slide active">
						<h1></h1>
					</div>
					<div class="slide">
						<h1></h1>
					</div>
					<div class="slide">
						<h1><h1>
					</div>
				</div>

				<!-- Slider Arrows -->
				<div class="arrow arrow-left"></div>
				<div class="arrow arrow-right"></div>

			</div>
		</div>

		<!--Secondary Header-->
		<h1 class="divider">Thoughts</h1>


		<!--Secondary Content-->
		<div id="secondary">
			<div class="effect-overlay collage effect-parent">
					<?php
						if(session_status() === PHP_SESSION_NONE) {
							session_start();
							//echo session_id();
						}
						$types = array("png","jpg");
						$dir = "images/entries_img";
						foreach (scandir($dir) as $entry){
							if(!is_dir($entry)){ // validates is a file
								$file_parts = pathinfo($dir."/".$entry);
								if(in_array($file_parts['extension'],$types)){
									$date = $file_parts['filename'];
									echo "<div class=\"image-wrapper\"><img src=\"" .$dir. "/" .$entry. "\">" . 
										 "<div class=\"overlay\"><a href=\"../entries.php?entry=" .$date. "\" class=\"overlink\">" . 
										 "<a href=\"../entries.php?entry=" .$date. "\" class=\"dropdown\">".$date."</a>" . 
										 "<a class=\"close-overlay hidden\">x</a></a></div></div>"    . "\n";
								}
							}
						}
					?>
			</div>
		</div>
	</div>

	<!--Footer-->
	<hr style="visibility:hidden;">
	<div id="footer">&copy; 2015 C&amp;B Redeemed Thought. All Rights Reserved.</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
	<script type="text/javascript" src="../js/header.js"></script>
	<script type="text/javascript" src="../js/slider.js"></script>
	<script type="text/javascript" src="../js/jquery.removeWhitespace.min.js"></script>
	<script type="text/javascript" src="../js/jquery.collagePlus.min.js"></script>

	<!-- Collage -->
    <script type="text/javascript">
	    // All images need to be loaded for this plugin to work so
	    // we end up waiting for the whole window to load in this example
	    $(window).load(function () {
	        $(document).ready(function(){
	            collage();
	        });
	    });
	    // Here we apply the actual CollagePlus plugin
	    function collage() {
	        $('.collage').removeWhitespace().collagePlus(
	            {
	                'fadeSpeed'     : 2000,
	                'targetHeight'  : 240,
	                'effect'        : 'effect-4',
	                'direction'     : 'horizonal',
	                'allowPartialLastRow':true
	            }
	        );
	    };
	    // This is just for the case that the browser window is resized
	    var resizeTimer = null;
	    $(window).bind('resize', function() {
	        // hide all the images until we resize them
	        $('.collage .image-wrapper').css("opacity", 0);
	        // set a timer to re-apply the plugin
	        if (resizeTimer) clearTimeout(resizeTimer);
	        resizeTimer = setTimeout(collage, 200);
	    });
    </script>

    <!-- Image Overlay -->
	<script src="js/modernizr.js"></script>
	<script>
	    $(document).ready(function(){ // Overlay JQuery (w/ optional Modernizer)
	        if (Modernizr.touch) {
	            // show the close overlay button
	            $(".close-overlay").removeClass("hidden");
	            // handle the adding of hover class when clicked
	            $(".image-wrapper").click(function(e){
	                if (!$(this).hasClass("hover")) {
	                    $(this).addClass("hover");
	                }
	            });
	            // handle the closing of the overlay
	            $(".close-overlay").click(function(e){
	                e.preventDefault();
	                e.stopPropagation();
	                if ($(this).closest(".").hasClass("hover")) {
	                    $(this).closest(".image-wrapper").removeClass("hover");
	                }
	            }); 
	        } else { 
	            // handle the mouseenter functionality
	            $(".image-wrapper").mouseenter(function(){
	                $(this).addClass("hover");
	            })
	            // handle the mouseleave functionality
	            .mouseleave(function(){
	                $(this).removeClass("hover");
	            });
	        }
	    });
	</script>
</body>
</html>
