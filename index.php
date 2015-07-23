<!--Author: Brandon Cai, Connie Xu-->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>C&B | Redeemed Thought</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<link href="../css/header.css" rel="stylesheet" type="text/css"/>
	<link href="../css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../css/slider.css" rel="stylesheet" type="text/css"/>
	<link href="../css/overlay.css" rel="stylesheet" type="text/css"/>
</head>

<body>
	<div class="container">
		<!--Header (Logo & Title)-->
		<header>
			<div id="logobox">
				<div id="logo"><img src="../images/CB.png" height="37" width="93" alt="C&B"></div>
				<div id="overlay"><a href="../index.php"><img src="../images/CBblue.png" height="37" width="93" alt="C&B"></a></div>
			</div>
			<div id="title"><h1>Redeemed Thought</h1></div>
			<div id="drawer"><ul id="nav">
				<li><a href="#">The Gospel</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Resources</a></li>
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
			<div class="effect-6 effects am-container" id="am-container" style="width:91.2%;margin:0px auto;">
					<?php
						$types = array("png","jpg");
						$dir = "images/entries";
						foreach (scandir($dir) as $entry){
							if(!is_dir($entry)){ // validates is a file
								$file_parts = pathinfo($dir."/".$entry);
								if(in_array($file_parts['extension'],$types))
									$date = $file_parts['filename'];
									echo "<div class=\"img\"><img src=\"" .$dir. "/" .$entry. "\"><div class=\"overlay\"><a href=\"#\" class=\"overlink\"><a href=\"#\" class=\"dropdown\">".$date."</a><a class=\"close-overlay hidden\">x</a></a></div></div>" . "\n";
							}
						}
					?>
			</div>
		</div>
	</div>

	<!--Footer-->
	<footer></footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
	<script type="text/javascript" src="../js/header.js"></script>
	<script type="text/javascript" src="../js/slider.js"></script>
	<script src="js/modernizr.js"></script>
	<script>
	    $(document).ready(function(){ // Overlay JQuery (w/ optional Modernizer)
	        if (Modernizr.touch) {
	            // show the close overlay button
	            $(".close-overlay").removeClass("hidden");
	            // handle the adding of hover class when clicked
	            $(".img").click(function(e){
	                if (!$(this).hasClass("hover")) {
	                    $(this).addClass("hover");
	                }
	            });
	            // handle the closing of the overlay
	            $(".close-overlay").click(function(e){
	                e.preventDefault();
	                e.stopPropagation();
	                if ($(this).closest(".img").hasClass("hover")) {
	                    $(this).closest(".img").removeClass("hover");
	                }
	            });
	        } else {
	            // handle the mouseenter functionality
	            $(".img").mouseenter(function(){
	                $(this).addClass("hover");
	            })
	            // handle the mouseleave functionality
	            .mouseleave(function(){
	                $(this).removeClass("hover");
	            });
	        }
	    });
	</script>
	<script type="text/javascript" src="../js/jquery.montage.min.js"></script>
	<script type="text/javascript"> // Montage JQuery
		$(function() {
			var $container 	= $('#am-container'),
							$imgs		= $container.find('img').hide(),
							totalImgs	= $imgs.length,
							cnt			= 0;
			
			$imgs.each(function(i) {
				var $img	= $(this);
				$('<img/>').load(function() {
					++cnt;
					if( cnt === totalImgs ) {
						$imgs.show();
						$container.montage({
							fixedHeight : 200
						});
					}
				}).attr('src',$img.attr('src'));
			});	
		});
	</script>
</body>
</html>
