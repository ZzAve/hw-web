<?php 
	require_once 'header.php'; 
	require_once 'misc/db_connectread.php';
	setlocale(LC_TIME, 'Dutch');
?>

<div id="content-bar">
	<div id="content">
         <h1> Welkom op de site van Homemade Water!</h1>
         
         <p> Homemade Water is een frisse pop-rock(cover)band die naam begint te krijgen in Delft en de rest van Nederland. Zij brengt een strakke en gevarie&euml;rde set bekendere rock- en popnummers en enkele eigen nummers. Met deze set zijn al vele zalen, café's en sociëteiten op de kop gezet waarbij de temperatuur regelmatig boven het kookpunt is uitgestegen! </p>    

         
       <!--  <p> Op onze site kunt u terecht voor al het moois dat Homemade Water de wereld te bieden heeft. Zo kunt u ons laatste nieuws bekijken, onze unieke sound beluisteren, maar u kunt een aantal optreden herleven met uniek beeld- en videomateriaal. Mocht u contact willen opnemen, schroom dan vooral niet.</p>-->

         <p> Homemade Water bestaat uit vijf technische studenten met passie voor muziek:</p>
         <ul>
         	<li>Zanger Laurens Mensink</li>
            <li>Gitarist Andrea Forzoni</li>
            <li>Toetseniste Eline Burger</li>
            <li>Bassist Moos Meijer</li>
            <li>Drummer Julius van Dis</li>            
         </ul>
		
         <p> Nieuwsgierig geworden? Check onze <a href="./audio.php">media</a> en <a href="./nieuws.php">laatste nieuws</a>! <br />. . . . en vergeet niet om ons te liken op facebook! (zie het icoontje onderaan deze pagina)</p>    
         
         <div id="agenda"> <h3>Agenda:</h3>
           <ul>
                <?php // Fetch the 3 gigs closest to today (in the future)
                $query = "SELECT * FROM `agenda` WHERE `Datum`>(CURDATE()-1) ORDER BY `Datum` ASC LIMIT 0,5";
                $result = mysqli_query($mysql,$query);			
                $counter=0;
                while( $row = mysqli_fetch_array($result) )  {
                          // while there is still an newsitem to process, put it in a listitem
                          $counter++;
                          popagendaevent($row);
				} ?>
           </ul>
           
           <?php
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
					    }	?>
                    </ul>
                    <?php 
				} //end $counter<5 if 
		  ?> 
          <p> <a href="agenda.php"> Meer optredens </a></p>
        </div>
        
        
         <div id="news"> 
            <h3>Laatste Nieuws:</h3>
            <ul>
                <?php 
                    // Fetch the 3 latest newsitems
                      $query = "SELECT * FROM `nieuwsitems` ORDER BY `Datum` DESC LIMIT 0,3";
                      $result = mysqli_query($mysql,$query);		  
                      while( $row = mysqli_fetch_array($result) ) {
                          ?>
						  <li>
                            <a href="<?="nieuws.php?id=item".$row['ID']?>"><?=$row['Titel']?></a>
                          </li>   
				   	  	  <?php 
					  }
                ?>
            </ul>
            <p><a href="nieuws.php"> Meer nieuws </a></p>
        </div>    
        
    </div> <!-- end content -->    
    
	<div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar div -->

<?php require_once 'footer.php'; ?>	
<!-- end html  (</html>) -->

<?php
	function popagendaevent($db_entry){
	  //change the format of date and timestamps
	  $date = explode("-",$db_entry['Datum']);
	  $time = explode(":",$db_entry['Tijd']);
	  ?>
	  <li>
		  <label> <?= strftime("%a %d %B %H:%M",mktime($time[0],$time[1],0,$date[1],$date[2],$date[0])) ?> </label>
  		  <a href="<?= "agenda.php?event".$db_entry['ID']?>" ><?=$db_entry['Titel']?></a>	
	  </li>
      <?php
	}
?>