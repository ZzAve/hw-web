<?php 
	// Include miscellaneous functions (such as database connection, buttons and sharedivs)
	require_once 'misc/miscfunctions.php';
	//Ensure connection
	db_connect(0);
	
	// check the request of user
	$request=false;
	$valid_request=false;
	if( isset($_REQUEST['event']) ){
		$request=true;	
		$id=intval($_GET['event']);
		$query = "SELECT * FROM  `agenda` WHERE  `ID` = $id";
		$result = mysqli_query($mysql,$query);
		$row = mysqli_fetch_array($result);
		// check if there was a return
		if ($row != NULL && $row['ID']!= "" ) {
			$valid_request=$row;
		}
	}
	// Update the title of the page
	$pre_title = $valid_request!==false ? $valid_request['Titel']." - " : "";
	$title = $pre_title."Agenda";
	
	// Additional constraints for this page - css etc
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/agendav1.2.css\" title=\"style\" />";
	
	// include the header
	require_once 'header.php'; 

?>
<div id="content-bar" >
    <div id="content">
<?php	// There are to options to show:
		// 	1. Show a specific item
		//  2. Show the entire agenda
    	
	if ($valid_request !== false){
		// show the requested item!
?>
        <div id="agendaItem" class="item">
            <h1> <?= $valid_request['Titel']?></h1>
            <img src="<?=$valid_request['Foto']?>" alt="<?=$valid_request['Titel']?>" title="<?=$valid_request['Titel']?>"> 
<?php 			$date = explode("-",$valid_request['Datum']);
				$time = explode(":",$valid_request['Tijd']); 
				$msg = $valid_request['Bericht'];
                // strip first and last p tag if present
			    if(strcasecmp(substr($msg,0,3),"<p>")==0){
				   $msg = substr($msg,3);
				   $msg = substr($msg,0,strripos($msg,"</p>"));
				}
?>
			 
            <h3> Datum: <?=strftime("%A %#d %B",mktime(0, 0, 0, $date[1],$date[2],$date[0] ) )?></h3>
            <h3> Aanvang: <?=$time[0].":".$time[2]?></h3>
            <h3> Locatie: <?=$valid_request['Locatie']?></h3>
            <p><?=$msg?></p>

<?php       $prev_agenda = strstr(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "" ,"?page=");
			backToOverview($prev_agenda); 
?>
            
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
   		 <h1>Agenda</h1>
		 <hr />
         
         <div class="agenda item">
         	<h3> Toekomstige optredens </h3>
         	<ul id="toekAgenda" class="agenda future">
<?php	 	// Get current year
		 	$curYear = strftime("%Y",time());
		 
        	// Fetch the events in the future (ascending order (first today, then tomorrow)
			$query = "SELECT * FROM `agenda` WHERE `Datum`>(CURDATE()-1) ORDER BY `Datum` ASC LIMIT 0,30";
			$result = mysqli_query($mysql,$query);			
			$counter=0;
			while( $row = mysqli_fetch_array($result) )  {
			  // while there is still an agendaitem to process, put it in a listitem
			  $counter++;
			  popagendaevent($row);
            }
			
			// Perform and error check (to check if there are no events scheduled
            if($counter==0){
?>            	<li> <em> helaas zijn er in de toekomst geen optredens gepland </em></li>         		 
<?php       }
?>
            </ul>
        </div>
        <hr />
       	<h3> Optredens in het verleden </h3>
        <div id="visualGigs">
         	<div class="col-50">
                 <h2> Optredens binnen Nederland</h2>
                 <a href="/images/hw_nederland.png" title="Waar Homemade Water allemaal speelde in Nederland?" data-lightbox="waar"><img src="/images/hw_nederland.png" alt="Wij hebben al op een boel plekken in Nederland gespeeld!" /></a>
             </div>
             <div class="col-50">
                 <h2> Optredens in Delft</h2>
                 <a href="/images/HW_Delft.jpg" title="Waar Homemade Water speelde in Delft" data-lightbox="waar"><img src="/images/HW_Delft.jpg" alt="Wij hebben al op een boel plekken binnen Delft gespeeld!" /></a><span>Homemade Water, te Delft anno <?= date("Y")?>.</span>
             </div>
             
         </div> <!-- end visualGigs --> 
         
        <div class="agenda item clearfix">

         
<?php 	 	// For each year make a itemlist
		 	// Current year
       	 	$query = "SELECT * FROM `agenda` WHERE `Datum` BETWEEN \"$curYear-01-01\" AND CURDATE()-1 ORDER BY `Datum` DESC;";
			$result = mysqli_query($mysql,$query);			
		 	$counter=0;
?>       	<h4> Optredens afgelopen jaar (<?=$curYear?>)</h4>
         	<ul class="agenda past"> 
<?php	 	while( $row = mysqli_fetch_array($result) )  {
		  		// while there is still an newsitem to process, put it in a listitem
		  		$counter++;
		  		popagendaevent($row);
		 	}
		 	if($counter==0){
?> 		      <li> <em> helaas zijn er in het verleden geen optredens gepland </em></li>         		 
<?php    	}  ?>
         </ul>
       </div>

<?php		 
		 //Previous years
		 $year = $curYear -1;
		 while ($year >=2012){
			$query = "SELECT * FROM `agenda` WHERE `Datum` BETWEEN \"$year-01-01\" AND \"$year-12-31\" ORDER BY `Datum` DESC;";
			$result = mysqli_query($mysql,$query);			
			$counter=0;
?> 			<div class="agenda item">
			<h4>Optredens in <?=$year?></h4>
			<ul class="agenda past">
<?php		while( $row = mysqli_fetch_array($result) )  {
			  // while there is still an newsitem to process, put it in a listitem
			  $counter++;
			  popagendaevent($row,false);
            } //end while
            if($counter==0){
?> 		    	<li> <em> helaas zijn er in het verleden geen optredens gepland </em></li>         		 
<?php       }
?>
          	</ul>
            </div>
<?php	
		 	$year = $year -1;
		 } // end while year check
?>


<?php
	} // end check what to show (if $valid_request!==false)
?>
    </div> <!-- end content div -->
 
</div> <!-- end content-bar div -->

<?php require_once 'footer.php'; ?>	
<!-- lightbox -->
<script type="text/javascript" src="/js/lightbox.min.js"></script>
</body>
</html>

<?php
	function popagendaevent($db_entry,$link=true){
	  //change the format of date and timestamps
	  $date = explode("-",$db_entry['Datum']);
	  $date2 = $date;
	  $time = explode(":",$db_entry['Tijd']);
?>
           <li>
             <div class="date">
             	<label><?= array_pop($date)?></label>
          	 	<span><?= strtoupper(strftime("%b",mktime(0, 0, 0, array_pop($date),1 ) ) )?></span>
             <!--<label> <?= strftime("%a %d %B %Y %H:%M",mktime($time[0],$time[1],0,$date2[1],$date2[2],$date2[0])) ?> </label> -->
             </div>
             <span>
<?php				if($link){
?>                    <span class="fst"><a href="<?="agenda.php?event=".$db_entry['ID']?>"><?= $db_entry['Titel'] ?>			
                    	<span class="snd"><?= $db_entry['Locatie'] ?></span>
                      </a></span>
<?php               } else {
?>                    <span class="fst"><?= $db_entry['Titel'] ?><span class="snd"><?= $db_entry['Locatie'] ?></span>
<?php               } ?>
             </span>	
           </li>
<?php
	} // end function popagendaevent
?>