<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#"
      xml:lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="last-modified" content="2013-10-29" />
    <meta http-equiv="content-language" content="nl" />
    <meta property="fb:admins" content="100001997083297" />
    <link href="/images/shortIcon.jpg" rel="shortcut icon" />
    <link href="/images/shortIcon.jpg" rel="shortIcon" />
    <link rel="/image_src" href="<?=isset($fb_img) ? $fb_img : ""?>" />
    <link rel="/image_src" href="http://www.homemadewater.nl/images/logo.jpg" />
    <title><?= isset($title)?$title." | ":""?>Homemade Water</title>
    <meta name="description" content="Homemade Water is een frisse pop/rock (cover)band die elke zaal om kan toveren in een feestende bende! Groot, klein, jong of oud? Homewade Water krijgt óók u aan het feesten!"/>
    <meta name="keywords" content="Homemade Water, Delft, band, coverband, pop, rock, studenten, feestband, clash, coverbands, student, Laurens Mensink, Andrea Forzoni, Eline Burger, Moos Meijer, Julius van Dis" />
    <meta name="author" content="Homemade Water" />
    <meta name="publisher" content="Homemade Water" />
    <meta name="copyright" content="Homemade Water" />
    <meta name="HomemadeWater" content="Delft band cover studentenband coverband Clash Laurens Mensink Eline Burger Moos Meijer Andrea Forzoni Julius van Dis" />

    <!-- for testing -->
   	<!--<base href="http://localhost/hw-web/" />
    <!-- for test site --
	<base href="http://development.homemadewater.nl/"/>
    <!-- for site -->
    <!--<base href="http://www.homemadewater.nl/" />-->

    <!-- fonts -->
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro' rel='stylesheet' type='text/css' />

    <!-- stylesheets --> 
    <link rel="stylesheet" type="text/css" href="/style/header.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/main.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/footer.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/lightbox.css" title="style" />

    <link rel="stylesheet" type="text/css" href="/style/agenda.css" title="style" /> 
    <link rel="stylesheet" type="text/css" href="/style/audio.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/contact.css" title="style" /> 
    <link rel="stylesheet" type="text/css" href="/style/foto.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/gastenboek.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/index.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/nieuws.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/video.css" title="style" />

<?php 
  	if (isset($extra)){
	  echo $extra;
 	 }
?>    
    
</head>

<body>
<div id="wrapper">
    <div id="header">       
        <div class="logo"> <img id="tapsplash" src="/images/tapsplash.png" alt="Stromend water uit de kraan"/>
        <a href="index.php"><img id="logo" src="/images/logo_head.png" alt="Hét Homemade Water logo"/></a>
        </div>
        
        <div id="navbar">
            <ul id="menu">
               <li class="highlight"><a href="/index.php">HOME</a></li>
               <li><a href="/band/">BAND</a></li>
               <li><a href="/nieuws.php">NIEUWS</a></li> 
               <li><a href="/agenda.php">AGENDA</a></li>
               <li><a href="/foto.php"> FOTO'S</a></li>
               <li><a href="/video.php"> VIDEO</a></li>
               <li><a href="/audio.php"> AUDIO</a></li>              	
               <li><a href="/contact.php">CONTACT</a></li>
               <li><a href="/gastenboek.php">GASTENBOEK</a></li>
            </ul>
       </div>
       
       <!--<div class="home_highlight home_news">
          <p>
          	<label> Laatste nieuws</label>
          	<a href="/nieuws.php#news_Clash4" />Clash of the Coverbands,<br />
           	voor een kwart regiofinale</a>
          </p>
       </div>-->
       <div class="home_highlight home_agenda">
          <p><label>Eerstvolgende gig:</label>
          <a href="#" >Vrijdag 21 februari<br /> Gala CSR Delft (besloten) <br /> De Roode Schuur, Nijkerk</a></p>
       </div>        
    </div><!-- end header -->
	<div class="background"> 
    	<div class="pull"></div>
    	<div>
        	<img src="/images/backgrounds/IMG_2978.jpg" alt="" title=""/>
        	<div class="gradient"><!-- gradient div --></div>
        </div>
    </div>    
