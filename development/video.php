<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/main.css" title="style" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="style/video.css" title="style" />
<script type="text/javascript" src="js/video.js"></script>

<title>Untitled Document</title>
</head>

<body>

<div id="content-bar">
	<?php include 'header.html'; ?>
    <div id="content">   
           <h1> Hier een video of twee om een indruk te krijgen wat we doen </h1> 
           
           <div id="videoList">
               <div class="video">
                    <img src="./images/logo.jpg" alt="video_logo" title="video_logo" onclick=playVideo("http://www.youtube-nocookie.com/embed/IBmy2bErdWM") />
               </div>
               
               <div class="video">
                	<img src="./images/logo.jpg" alt="video2" title="video_logo" onclick=playVideo("http://www.youtube.com/embed/MWqYy2H6I8E") />
               </div>
           </div> <!-- end videoList div -->
           
           <div id="showVideo">
         		<iframe title="YouTube video player" width="420" height="315" src="http://www.youtube.com/embed/MWqYy2H6I8E?wmode=transparent" frameborder="0" wmode="Opaque"></iframe>
           </div>
           
    </div> <!-- end div content -->
	<div id="sidebar-left"></div>
    <div id="sidebar-right"></div>
	<?php include 'footer.html' ?>
</div> <!-- end content-bar -->

</body>


</html>
