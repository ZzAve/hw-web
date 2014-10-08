<?php 
	require_once 'misc/miscfunctions.php';
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/indexv1.2.css\" title=\"style\" />";
	require_once 'header.php'; 
?>

<div id="content-bar">

	<div id="content">
         <h1> Welkom op de site van Homemade Water!</h1>
         
		<p> Homemade Water is een frisse pop-rock(cover)band die naam begint te krijgen in Delft en de rest van Nederland. Het brengt een strakke en gevarie&euml;rde set bekendere rock- en popnummers en enkele eigen nummers. Met deze set zijn al vele zalen, café's en sociëteiten op de kop gezet waarbij de temperatuur regelmatig boven het kookpunt is uitgestegen! </p> 

       <!--  <p> Op onze site kunt u terecht voor al het moois dat Homemade Water de wereld te bieden heeft. Zo kunt u ons laatste nieuws bekijken, onze unieke sound beluisteren, maar u kunt een aantal optreden herleven met uniek beeld- en videomateriaal. Mocht u contact willen opnemen, schroom dan vooral niet.</p>-->

         <p> Homemade Water bestaat uit vijf technische studenten met passie voor muziek:</p>
         <ul>
            <li>Zanger Laurens Mensink</li>
            <li>Gitarist Andrea Forzoni</li>
            <li>Toetseniste Eline Burger</li>
            <li>Bassist Moos Meijer</li>
            <li>Drummer Julius van Dis</li>            
         </ul>
		
         <p> Nieuwsgierig geworden? Check onze <a href="/video.php">media</a> en <a href="/nieuws.php">laatste nieuws</a>! <br />. . . . en vergeet niet om ons te liken op facebook! (zie het icoontje onderaan deze pagina)</p> 
         
         <div class="attention">
             <img src="/images/clash_win_lau.jpg" alt="Andrea en Laurens swingen zich naar de finale van de Clash of The Coverbands (Regio West)" title="Verkozen tot best coverband van de regio West-Nederland" />
             <div class="text">
	             <h3>Joepie ! ! !</h3>

                 <p>We hebben het voor elkaar gekregen. Zondag 18 mei speelden we in de  finale van de Clash of the Cover Bands (Regio West). Daar hebben we de sterren van de hemel gespeeld, en verkozen door de jury tot beste coverband van de regio.</p>
                              
                 <p>Nu mogen we doorstomen naar internationaal succes, en zullen we spelen in de BENELUX editie, tegen bands uit ook Belgi&euml; en Luxumburg. En, en, dan zullen er ook TV-opnames gemaakt worden! De eerstvolgende ronde zal op 18 oktober zijn. Wij hebben er nu al zin in!</p>
                 
                 <p>Kijk <a href="http://clashofthecoverbands.nl/show/verslagen/item,724,Regio-Finale-Regio-West-2013-2014.html" target="_blank">hier voor het jurycommentaar van de avond</a>.</p>
             </div>
         </div>
   
         <div class="col-50" id="agenda"> 
             <h3>Agenda:</h3>
<?php 		// Ensure connection	
			$connection = db_connect(0);
			if ($connection !== true){
?>
             <p> Er is is fout gegaan tijdens de verbinding met de database: <?= $connection ?></p>			
<?php
			} else {
            
			// Fetch the 5 gigs closest to today (in the future)
			$query = "SELECT * FROM `agenda` WHERE `Datum`>(CURDATE()-1) ORDER BY `Datum` ASC LIMIT 0,5";
			$result = mysqli_query($mysql,$query);			
			$counter=0;
			while( $row = mysqli_fetch_array($result) )  {
			  // while there is still an newsitem to process, put it in a listitem
			  if($counter++ == 0){ //check whether it is the first item
?>
				<h4> Aankomende optredens</h4>
           		<ul> 
<?php
              }
			  popagendaevent($row);
           } //end while
           if($counter>0){
?> 		
			</ul>
<?php
		   }
		   if($counter<5){
?> 
             <h4> Laatste optredens: </h4> 
             <ul> 
<?php
			 $query = "SELECT * FROM `agenda` WHERE `Datum`<=(CURDATE()-1) ORDER BY `Datum` DESC LIMIT 0,".(5-$counter).";";
			 $result = mysqli_query($mysql,$query);
			 while( $row = mysqli_fetch_array($result) )  {
				// while there is still an newsitem to process, put it in a listitem
				popagendaevent($row);	     
			 }	
?>
             </ul>
<?php 
			} //end $counter<5 if 
			} // end if else statement db connection
?> 
          <p> <a href="agenda.php"> Meer optredens </a></p>
        </div> <!-- end agenda -->
        
        
         <div id="news" class="col-50" > 
            <h3>Laatste Nieuws:</h3>
            <ul>    	   
<?php	      // Fetch the 4 latest newsitems
              $query = "SELECT `ID`,`Titel`,`Foto` FROM `nieuwsitems` ORDER BY `Datum` DESC LIMIT 0,4";
              $result = mysqli_query($mysql,$query);		  
              while( $row = mysqli_fetch_array($result) ) {
				  $imgFile = substr($row['Foto'],0,6)=="images" ? "/" : "";
				  $imgFile = $imgFile.$row['Foto'];
?>
              <li>
              	<label class="col-33">
                	<a class="itemimg" href="<?="nieuws.php?item=".$row['ID']?>" style="background-image:url(<?=$imgFile?>)"></a>
                </label>
                <span class="col-66"><a href="<?="nieuws.php?item=".$row['ID']?>"><?=$row['Titel']?></a></span>
              </li>
<?php 
			  }
?>
           </ul>
           <p><a href="/nieuws.php"> Meer nieuws </a></p>
        </div>    <!-- end news -->
        
    </div> <!-- end content -->    
    


</div> <!-- end content-bar div -->

<?php require_once 'footer.php'; ?>	
</body>
</html>

<?php
	function popagendaevent($db_entry){
	  //change the format of date and timestamps
	  $date = explode("-",$db_entry['Datum']);
	  $date2= $date;
	  //print_r($date);
	  $time = explode(":",$db_entry['Tijd']);

?>
		<li>
          <div class="date">
             	<label><?= array_pop($date)?></label>
          	 	<span><?= strtoupper(strftime("%b",mktime(0, 0, 0, array_pop($date),1 ) ) )?></span>
             <!--<label> <?= strftime("%a %d %B %Y %H:%M",mktime($time[0],$time[1],0,$date2[1],$date2[2],$date2[0])) ?> </label> -->
             </div>
          <span><a href="<?= "/agenda.php?event=".$db_entry['ID']?>" ><?=$db_entry['Titel']?></a></span>	
		</li>
<?php
	} // end function popagendaevent
?>