<?php 
	require_once 'header.php'; 
	require_once 'misc/miscfunctions.php';
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
             <img src="images/clash_win.jpg" alt="Andrea en Laurens swingen zich naar de finale van de Clash of The Coverbands (Regio West)" title="Andrea en Laurens swingen zich naar de finale van de Clash of The Coverbands (Regio West)" />
             <div class="text">
	             <h3> Eureka ! ! !</h3>

                 <p> We hebben het voor elkaar gekregen. Zaterdag 15 februari speelden we in de halve finale van de Clash of the Cover Bands (Regio West). Daar hebben we de sterren van de hemel gespeeld, en een plekje weten te bemachtigen in de finale!</p>
                 
                 <p> Deze finale zal plaatsen vinden op 18 mei, op een podium niks minder dan de <strong>main stage van de Melkweg, Amsterdam</strong>. Hoe gaaf is dat?</p>
                 
                 <p> Dit betekent ook dat we nog maar 1 ronde verwijderd zijn van de TV opnames van de Clash. De winnaars van de regiofinales gaan namelijk door naar de halve finales voor de Benelux, en hierbij worden tv opnames gemaakt!</p>
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
<?php	      // Fetch the 3 latest newsitems
              $query = "SELECT `ID`,`Titel`,`Foto` FROM `nieuwsitems` ORDER BY `Datum` DESC LIMIT 0,3";
              $result = mysqli_query($mysql,$query);		  
              while( $row = mysqli_fetch_array($result) ) {
				  $imgFile = substr($row['Foto'],0,6)=="images" ? "/" : "";
				  $imgFile = $imgFile.$row['Foto'];
?>
              <li><label><a href="<?="nieuws.php?item=".$row['ID']?>"><img src="<?=$imgFile?>" alt="Nieuwsbericht" /></a></label><span><a href="<?="nieuws.php?item=".$row['ID']?>"><?=$row['Titel']?></a></span>
              </li>
<?php 
			  }
?>
           </ul>
           <p><a href="/nieuws.php"> Meer nieuws </a></p>
        </div>    <!-- end news -->
        
    </div> <!-- end content -->    
    
    <div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar div -->

<?php require_once 'footer.php'; ?>	
</body>
</html>

<?php
	function popagendaevent($db_entry){
	  //change the format of date and timestamps
	  $date = explode("-",$db_entry['Datum']);
	  $time = explode(":",$db_entry['Tijd']);

?>
		<li>
		  <div class="date">
          <label><?= array_pop($date)?></label>
          	<span><?= strtoupper(strftime("%b",mktime(0, 0, 0, array_pop($date) ) ) )?></span>          </div>
          <span><a href="<?= "/agenda.php?event=".$db_entry['ID']?>" ><?=$db_entry['Titel']?></a></span>	
		</li>
<?php
	} // end function popagendaevent
?>