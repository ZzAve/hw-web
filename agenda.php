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
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/agenda1.css\" title=\"style\" />";
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
			<?php $date = explode("-",$valid_request['Datum']);
				  $time = explode(":",$valid_request['Tijd']); ?>
            <h3> Datum: <?=strftime("%A %#d %B",mktime(0, 0, 0, $date[1],$date[2],$date[0] ) )?></h3>
            <h3> Aanvang: <?=$time[0].":".$time[2]?></h3>
            <h3> Locatie: <?=$valid_request['Locatie']?></h3>
            <p> <?=$valid_request['Bericht']?></p>

<?php       $prev_news = strstr(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "" ,"?page=");
			backToOverview($prev_news); 
?>
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
		 
         <div class="agenda item">
         <h3> Toekomstige optredens </h3>
         <ul id="toekAgenda" class=" agenda future">
<?php	 // Get current year
		 $curYear = strftime("%Y",time());
		 
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
         </div>
         
         <div class="agenda item">
         <h3> Optredens in het verleden </h3>
         
<?php 	 // For each year make a itemlist
		 // Current year
       	 $query = "SELECT * FROM `agenda` WHERE `Datum` BETWEEN \"$curYear-01-01\" AND CURDATE()-1 ORDER BY `Datum` DESC;";
		 $result = mysqli_query($mysql,$query);			
		 $counter=0;
?>       <h4> Optredens afgelopen jaar (<?=$curYear?>)</h4>
         <ul class="agenda past"> 
<?php	 while( $row = mysqli_fetch_array($result) )  {
		  // while there is still an newsitem to process, put it in a listitem
		  $counter++;
		  popagendaevent($row);
		 } //end while
		 if($counter==0){
?> 		     <li> <em> helaas zijn er in het verleden geen optredens gepland </em></li>         		 
<?php    }  ?>
         </ul>

<?php		 
		 //Previous years
		 $year = $curYear -1;
		 while ($year >=2012){
			$query = "SELECT * FROM `agenda` WHERE `Datum` BETWEEN \"$year-01-01\" AND \"$year-12-31\" ORDER BY `Datum` DESC;";
			$result = mysqli_query($mysql,$query);			
			$counter=0;
?> 			<h4>Optredens in <?=$year?></h4>
			<ul class="agenda past">
<?php		while( $row = mysqli_fetch_array($result) )  {
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
		 	$year = $year -1;
		 }
?>

         </div>
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
	  $date2 = $date;
	  $time = explode(":",$db_entry['Tijd']);
?>
           <li>
             <div class="date">
             	<label><?= array_pop($date)?></label>
          	 	<span><?= strtoupper(strftime("%b",mktime(0, 0, 0, array_pop($date) ) ) )?></span>
             <!--<label> <?= strftime("%a %d %B %H:%M",mktime($time[0],$time[1],0,$date2[1],$date2[2],$date2[0])) ?> </label>
             <span> </span>-->
             </div>
             <span><a href="<?="agenda.php?event=".$db_entry['ID']?>"><?= $db_entry['Titel'] ?><span><?= $db_entry['Locatie'] ?></span></a></span>	
           </li>
<?php
	} // end function popagendaevent
?>