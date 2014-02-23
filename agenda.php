<?php 
	require_once 'misc/miscfunctions.php';
	//Ensure connection
	db_connect(0);
	$request=false;
	$valid_request=false;
	
	// check the request of user
	if( isset($_REQUEST['event']) ){
		$request=true;	
		$id=intval($_GET['event']);
		$query = "SELECT * FROM  `agenda` WHERE  `ID` = $id";
		$result = mysqli_query($mysql,$query);
		$row = mysqli_fetch_array($result);
		
		if ($row != NULL && $row['ID']!= "" ) {
			$valid_request=$row;
		}
	}
	$pre_title = $valid_request!==false ? $valid_request['Titel']." - " : "";
	$title = $pre_title."Agenda";
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/agenda.css\" title=\"style\" />";
	require_once 'header.php'; 

?>
<div id="content-bar" class="under_construction">
    <div id="content">
<?php	// There are to options to show:
		// 	1. Show a specific item
		//  2. Show the entire agenda
    	
	if ($valid_request !== false){
		// show the requested item!
?>
        <div id="agendaItem">
            <p class="back"> <a href="agenda.php">Terug naar het overzicht</a></p>
            <h1> <?= $valid_request['Titel']?></h1>
            <img src="<?=$valid_request['Foto']?>" alt="<?=$valid_request['Titel']?>" title="<?=$valid_request['Titel']?>"> 
            <h3> Datum: <?=$valid_request['Datum']?></h3>
            <h3> Tijd: <?=$valid_request['Tijd']?></h3>
            <h3> Locatie: <?=$valid_request['Locatie']?></h3>
            <p> <?=$valid_request['Bericht']?></p>

            
            <p id="botback" class="back"> <a href="agenda.php">Terug naar het overzicht</a></p>
            <!--
            <p> De request vars: request: <?=$request? "true" : "false"?> en valid_request: <?=$valid_request!==false?"true":"false"?></p>
            <p> <pre><?=print_r($valid_request);?></pre></p>
            -->
      </div>
<?php		

	} else {
		//show the entire agenda
		if($request){//show error (through an javascript alert?)
?>
		  <script> 
                setTimeout(function(){alert('Helaas is het door u opgegeven agendapunt niet meer beschikbaar of heeft het nooit bestaan.\n\nDesalniettemin hebben wij voor u de volledige lijst met optredens voor u op een rijtje gezet.');},800);
          </script>
<?php
		}
?>
    	
         <h1> Agenda</h1>
		 
         <h3> Toekomstige optredens </h3>
         <ul>
<?php
         // Fetch the in the future (ascending order (first today, then tomorrow)
			$query = "SELECT * FROM `agenda` WHERE `Datum`>(CURDATE()-1) ORDER BY `Datum` ASC LIMIT 0,30";
			$result = mysqli_query($mysql,$query);			
			$counter=0;
			while( $row = mysqli_fetch_array($result) )  {
			  // while there is still an newsitem to process, put it in a listitem
			  $counter++;
			  popagendaevent($row);
            } //end while
            if($counter==0){
?>
             <li> <em> helaas zijn er in de toekomst geen optredens gepland </em></li>         		 
<?php
            }
?>
         </ul>
         
         <h3> Optredens in het verleden </h3>
         <ul>
<?php
         // Fetch the past gigs (yesterday before the 'day-before-yesterday')
			$query = "SELECT * FROM `agenda` WHERE `Datum`<(CURDATE()-1) ORDER BY `Datum` DESC LIMIT 0,30";
			$result = mysqli_query($mysql,$query);			
			$counter=0;
			while( $row = mysqli_fetch_array($result) )  {
			  // while there is still an newsitem to process, put it in a listitem
			  $counter++;
			  popagendaevent($row);
            } //end while
            if($counter==0){
?> 		
              <li> <em> helaas zijn er in het verleden geen optredens gepland </em></li>         		 
<?php
           }
?>
         </ul>
<?php
	} // end check what to show (if $valid_request!==false)
?>
    </div> <!-- end content div -->
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
             <label> <?= strftime("%a %d %B %H:%M",mktime($time[0],$time[1],0,$date[1],$date[2],$date[0])) ?> </label>
             <a href="<?= "agenda.php?event=".$db_entry['ID']?>" ><?=$db_entry['Titel']?></a>	
           </li>
<?php
	} // end function popagendaevent
?>