<?php
	setlocale(LC_TIME, 'Dutch');
	// Check if miscfunctions is already present
	if(!isset($active_db)){
		require_once 'misc/miscfunctions.php';
	}
?>
<!DOCTYPE html>
<html xml:lang="nl" lang="nl">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="fb:admins" content="100001997083297" />
    <link href="/images/shortIcon.jpg" rel="shortcut icon" />
    <link href="/images/shortIcon.jpg" rel="shortIcon" />
    <link rel="/image_src" href="<?=isset($fb_img) && $fb_img!="" ? $fb_img : "/images.logo.jpg"?>" />
    <link rel="/image_src" href="http://www.homemadewater.nl/images/logo.jpg" />
    <title><?= isset($title)?$title." | ":""?>Homemade Water</title>
    <meta name="description" content="<?= isset($description)? $description : "Homemade Water is een frisse pop/rock (cover)band die elke zaal om kan toveren in een feestende bende! Groot, klein, jong of oud? Homewade Water krijgt óók u aan het feesten!"?> "/>
    <meta name="keywords" content="Homemade Water, Delft, band, coverband, pop, rock, studenten, feestband, clash, coverbands, student, Laurens Mensink, Andrea Forzoni, Eline Burger, Moos Meijer, Julius van Dis" />
    <meta name="author" content="Homemade Water" />

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <!-- fonts -->
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro' rel='stylesheet' type='text/css' />

    <!-- stylesheets --> 
    <link rel="stylesheet" type="text/css" href="/style/header.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/main.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/footer.css" title="style" />
    <link rel="stylesheet" type="text/css" href="/style/lightbox.css" title="style" />

<?php 
	// Check if any extra settings were requested for this header
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
<?php
		// Ensure db connection
		$connection = db_connect(0);
		if ($connection !== true){
?>          <p> Er is is fout gegaan tijdens de verbinding met de database: <?= $connection ?></p>				
<?php
		} else { 
		
		$query = "SELECT * FROM `agenda` WHERE (`Datum` - CURDATE()) > -1 ORDER BY `Datum` ASC LIMIT 0,1";
		$result = mysqli_query($mysql,$query);
		$row = mysqli_fetch_array($result);
		$date = explode("-",$row['Datum']);
	  	
	
?>
       <div class="home_highlight home_agenda">
          <p><label>Eerstvolgende gig:</label>
          <a href="<?="/agenda.php?item=".$row['ID']?>" ><?=strftime("%A %#d %B",mktime(0, 0, 0, $date[1],$date[2],$date[0] ) )?><br /><?=$row['Titel']?><br /><?=$row['Locatie']?></a></p>
       </div>        
       <?php } ?>
    </div><!-- end header -->
<?php
    db_restore();
?>