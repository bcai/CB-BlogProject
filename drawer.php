<!--Author: Brandon Cai, Connie Xu-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>C&amp;B | Redeemed Thought</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">

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
                <div id="logo"><img src="../images/CB.png" height="37" width="93" alt="C&amp;B"></div>
                <div id="overlay"><a href="../index.php"><img src="../images/CBblue.png" height="37" width="93" alt="C&amp;B"></a></div>
            </div>
            <div id="title"><h1>Redeemed Thought</h1></div>
            <div id="drawer"><ul id="nav">
                <li><a href="../drawer.php?drawer=gospel">Gospel</a></li>
                <li><a href="../drawer.php?drawer=about">About</a></li>
                <li><a href="../drawer.php?drawer=resources">Resources</a></li>
            </ul></div>
        </header>

        <!--Primary Content-->
        <div id="primary">
            <?php
                if(session_status() === PHP_SESSION_NONE) {
                    session_start();
                    //echo session_id();
                }
                //declare variables
                $title; $textFile; $txtExist = false; $linkExist = false;
                $stack = array(); // image array
                $dir = "drawer/".$_GET['drawer']."/";
                // check which link was clicked in the drawer
                if($_GET['drawer'] === 'gospel'){
                    $title = "The Gospel";
                    $dir = "drawer/gospel/";
                    if(file_exists($dir."links.txt")){
                        $links = file($dir."links.txt", FILE_IGNORE_NEW_LINES);
                        $linkExist = true;
                    }
                }
                if($_GET['drawer'] === 'about'){
                    $title = "About C&B";
                    $dir = "drawer/about/";
                    if(file_exists($dir."links.txt")){
                        $links = file($dir."links.txt", FILE_IGNORE_NEW_LINES);
                        $linkExist = true;
                    }
                }
                if($_GET['drawer'] === 'resources'){
                    $title = "Resources";
                    $dir = "drawer/resources/";
                    if(file_exists($dir."links.txt")){
                        $links = file($dir."links.txt", FILE_IGNORE_NEW_LINES);
                        $linkExist = true;
                    }
                }

                $types = array("png","jpg");
                if(file_exists($dir)){
                    foreach(scandir($dir) as $file){
                        if(!is_dir($file)){
                            // if entry folder contains images, add to image array to add in image-container
                            if(in_array(pathinfo($dir."/".$file,PATHINFO_EXTENSION),$types)){
                                array_push($stack,$file);
                            }
                            // identifies txt file for reading and creating entry title header
                            else if(pathinfo($dir."/".$file, PATHINFO_BASENAME) == $_GET['drawer'].'.txt'){ //should only be one txt file per entry folder
                                $textFile = $dir.$file; 
                                #$title = pathinfo($dir."/".$file)['filename'];
                                $txtExist = true;
                            }
                        }
                    }
                }

                if($txtExist && $linkExist){ //proceed with displaying text contents, else display error message
                    /* create text-container */
                    echo "<div id=\"text-container\">";
                        //create the title for text-container
                        echo "<h1 class=\"divider\">".$title."</h1>";

                        //read in text file to text-container
                        $fOpen = fopen($textFile, "r") or die("Unable to open file!");
                        echo fread($fOpen,filesize($textFile));
                        fclose($fOpen);

                    echo "</div>"; //end text-container
                }
                else{ // display error message if entry text not located
                    echo "<div id=\"error-message\">".
                            "<h2>Sorry! This page is in the process of being updated.</h2>".
                         "</div>";
                }

                /* image-container */
                if($txtExist && $linkExist){ //only display this container if text file exists
                    echo "<div id=\"image-container\">";

                        //display the images stored in the image array
                        $i=0;
                        $size = sizeof($stack);
                        while($i < $size){
                            $filename = pathinfo($dir.$stack[$i])['filename'];
                            echo "<div id=\"wrapper\"><a href=\"".$links[$i]."\" title=\"".$links[$i]."\"><img src=".$dir.$stack[$i]."></a></div>"; 
                            $i++;
                        }
                    echo "</div>"; //end image-container
                }
            ?>
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
                    'targetHeight'  : 230,
                    'effect'        : 'effect-4',
                    'direction'     : 'horizontal',
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
