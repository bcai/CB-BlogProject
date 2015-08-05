<!--Author: Brandon Cai, Connie Xu-->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>C&B | Redeemed Thought</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<link href="../css/header.css" rel="stylesheet" type="text/css"/>
	<link href="../css/style.css" rel="stylesheet" type="text/css"/>
	<link href="../css/overlay.css" rel="stylesheet" type="text/css"/>
	<link href="../css/transitions.css" rel="stylesheet" type="text/css"/>
	<link href="../css/entries.css" rel="stylesheet" type="text/css"/>
	<link href="../css/jquery.fancybox.css" rel="stylesheet" type="text/css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>
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
			<?php
				/* text-container */
				echo "<div id=\"text-container\">";
					if(session_status() === PHP_SESSION_NONE) {
						session_start();
						//echo session_id();
					}
					$textFile; $title; $stack = array();
					$types = array("png","jpg");
					$dir = "entries/".$_GET['entry']."/";
					foreach(scandir($dir) as $entry){
						if(!is_dir($entry)){
							// if entry folder contains images, add to image array to add in image-container
							if(in_array(pathinfo($dir."/".$entry,PATHINFO_EXTENSION),$types)){
								array_push($stack,$entry);
							}
							// identifies txt file for reading and creating entry title header
							else if(pathinfo($dir."/".$entry, PATHINFO_EXTENSION) == 'txt'){ //should only be one txt file per entry folder
								$textFile = $dir.$entry; 
								$title = pathinfo($dir."/".$entry)['filename'];
							}
						}
					}
					//create the title for text-container
					echo "<h1 class=\"divider\">".$title."</h1>";

					//create the date for text-container
					$formatDate = date_create(str_replace('.', '-', $_GET['entry']));
					$date = date_format($formatDate, 'F jS, Y');
					echo "<h1 id=\"date\">".$date."</h1>";

					//read in text file to text-container
					$fOpen = fopen($textFile, "r") or die("Unable to open file!");
					echo fread($fOpen,filesize($textFile));
					fclose($fOpen);
				echo "</div>"; //end text-container


				/* image-container */
				echo "<div id=\"image-container\">";
					//display the image for the entry displayed on the secondary grid
					$imgDir = "images/entries_img/";
					if(file_exists($imgDir.$_GET['entry'].".jpg"))
						echo "<div id=\"wrapper\"><a href=\"".$imgDir.$_GET['entry'].".jpg\" class=\"fancybox\" rel=\"gallery\" title=\"".$title."\"><img src=".$imgDir.$_GET['entry'].".jpg></a></div>";
					if(file_exists($imgDir.$_GET['entry'].".png"))
						echo "<div id=\"wrapper\"><a href=\"".$imgDir.$_GET['entry'].".png\" class=\"fancybox\" rel=\"gallery\" title=\"".$title."\"><img src=".$imgDir.$_GET['entry'].".png></a></div>";

					//display the images stored in the image array
					$i=0;
					while($i < sizeof($stack)){
						$filename = pathinfo($dir.$stack[$i])['filename'];
						echo "<div id=\"wrapper\"><a href=\"".$dir.$stack[$i]."\" class=\"fancybox\" rel=\"gallery\" title=\"".$filename."\"><img src=".$dir.$stack[$i]."></a></div>"; 
						$i++;
					}
				echo "</div>"; //end image-container
			?>
		</div>

		<!--Secondary Header-->
		<h1 class="divider">Thoughts</h1>


		<!--Secondary Content-->
		<div id="secondary">
			<div class="effect-overlay collage effect-parent">
					<?php
						if(session_status() === PHP_SESSION_NONE) {session_start();}
						$types = array("png","jpg");
						$dir = "images/entries_img";
						foreach (scandir($dir) as $entry){
							if(!is_dir($entry)){ // validates is a file
								$file_parts = pathinfo($dir."/".$entry);
								if(in_array($file_parts['extension'],$types)){
									$date = $file_parts['filename'];
									if($date === $_GET['entry']){
										echo "<div class=\"image-wrapper entry\"><img src=\"" .$dir. "/" .$entry. "\">" . 
											 "<div class=\"overlay\"><a href=\"../entries.php?entry=" .$date. "\" class=\"overlink\">" . 
											 "<a href=\"../entries.php?entry=" .$date. "\" class=\"dropdown\">".$date."</a>" . 
											 "</a></div></div>"    . "\n";
									}
									else{
										echo "<div class=\"image-wrapper\"><img src=\"" .$dir. "/" .$entry. "\">" . 
											 "<div class=\"overlay\"><a href=\"../entries.php?entry=" .$date. "\" class=\"overlink\">" . 
											 "<a href=\"../entries.php?entry=" .$date. "\" class=\"dropdown\">".$date."</a>" . 
											 "<a class=\"close-overlay hidden\">x</a></a></div></div>"    . "\n";
									}
								}
							}
						}
					?>
			</div>
		</div>
	</div>

	<!--Footer-->
	<hr style="visibility:hidden;">
	<div id="footer">&copy; 2015 C&B Redeemed Thought. All Rights Reserved.</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
	<script type="text/javascript" src="../js/header.js"></script>
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
                'targetHeight'  : 200,
                'effect'        : 'effect-2',
                'direction'     : 'vertical',
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

	<!-- FancyBox -->
	<script type="text/javascript" src="../js/jquery.fancybox.pack.js"></script>
	<script>
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
	</script>
</body>
</html>
