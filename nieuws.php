<?php
	require_once('misc/db_connectread.php');
	$request = false;
	$valid_request = false;
	
	// Check what to represent
 	if(isset($_GET['item'])){
		$request=true;
		$id=intval($_GET['item']);
		$query = "SELECT * FROM  `nieuwsitems` WHERE  `ID` = $id";
		$result = mysqli_query($mysql,$query);
		$row = mysqli_fetch_array($result);
		
		if ($row != NULL && $row['ID']!= "" ) {
			$valid_request=$row;
		}
	}
    //Set a title for the page
	$pre_title = $valid_request!==false ? $valid_request['Titel']." - " : "";
    $title = $pre_title."Nieuws";
	
	//Set a facebook image
	$fb_img = $valid_request!==false ? $valid_request['Foto'] :"";
	
	//Import header
    require_once 'header.php';  
    setlocale(LC_TIME, 'Dutch'); 
?>

<div id="content-bar">
    <div id="content">
		    
<?php	// There are to options to show:
		// 	1. Show a specific item
		//  2. Show a part of the newsitems

	if($valid_request!==false){
			// Show one item
			$prev_news = strstr(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "" ,"?startat=");
?> 
            <p> 
            	<a href="nieuws.php<?= $prev_news ? $prev_news : "" ?>">Ga terug naar het nieuwsoverzicht</a>
            </p>
<?php
			popnewsitem($valid_request);
?>
            <p> <a href="nieuws.php<?= $prev_news ? $prev_news : "" ?>"> Ga terug naar het nieuwsoverzicht</a></p>
<?php

	} else {
		
		// Show 'all' the newsitems
		if($request){//show error (through an javascript alert?)
?>
			<script> 
				setTimeout(function(){alert('Helaas is het door u opgegeven nieuwsbericht niet meer beschikbaar of heeft het nooit bestaan.\n\nDesalniettemin hebben wij voor u de meest recente nieuwsbericht voor u op een rijtje gezet.');},800);
			</script>
<?php
		}
		
		$query = "SELECT `ID` FROM `nieuwsitems` ORDER BY `ID` DESC LIMIT 1;";
		$result = mysqli_query($mysql,$query);
		$ans = mysqli_fetch_array($result);
		$start = $ans['ID'];
		$top = $start;
		if(isset($_GET['startat']) && intval($_GET['startat'])>=10 && intval($_GET['startat'])<=$top ){
	 	  // give the five newsitems starting from number 'startat'
		  $start=intval($_GET['startat']);
		}
?>
        <h1> Het laatste nieuws!</h1> 
        <h2> Om ons op de voet te volgen, verwijzen we u door naar onze <a href="http://www.facebook.com/HomemadeWater">facebook pagina</a></h2>  
<?php
            morenews($start,$top);
            $query = "SELECT * FROM `nieuwsitems` WHERE `ID`<=$start ORDER BY `Datum` DESC LIMIT 5;";
            $result = mysqli_query($mysql,$query);
            while( $row = mysqli_fetch_array($result) )  {
              popnewsitem($row);
            }                 		
            
			morenews($start,$top);
		}	
?>         
    </div> <!-- end div content -->
	<div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar -->
<?php require_once 'footer.php' ?>

</body>
</html>


<?php 
/* function POPNEWSITEM creates a <div> entry for one single newsitem. It checks whether multiple newsitem need to be posted (by means of variable $special, and if so it only posts short versions of the items.
//	input:
//		$db_entry   a database entry with the newsitem, coming from the 'newsitems' table of the 'juliuqb30_hw' database.
//  output:
// 		$ one <div> with class 'newsitem' (and 'single' in case only one newsitem is requested.
//  returns nothing
*/
function popnewsitem($db_entry){
	global $valid_request;
	$date = explode("-",$db_entry['Datum']);
?> 
    <div class="newsitem <?= $valid_request!==false ? "single" : ""?>" id="<?="item" . $db_entry['ID']?>">
      <div class="date">
        <label> <?= array_pop($date)?> </label>
        <span> <?= strtoupper(strftime("%b",mktime(0, 0, 0, array_pop($date) ) ) )?> </span>
      </div>

<?php  // make both the title and image a link, such that if clicked, a screen opens with only that newsitem
	   if($valid_request===false){
?>
      <a href="<?= "nieuws.php?item=".$db_entry['ID']?> "><h3><?= $db_entry['Titel']?> </h3></a>
      <a href="<?= "nieuws.php?item=".$db_entry['ID']?>"> <img src="<?=$db_entry['Foto']?>" alt="<?=$db_entry['Alt_foto']?>" title="<?=$db_entry['Alt_foto']?>"/></a>
<?php
	   } else {
?>
      <h3><?= $db_entry['Titel']?> </h3>
      <img src="<?=$db_entry['Foto']?>" alt="<?=$db_entry['Alt_foto']?>" title="<?=$db_entry['Alt_foto']?>"/>
<?php	
	   }

		 //Ensure what message to post. 
		 //	 A short one (in case of multiple items) 
		 //  or the whole text (in case a single newsitem is requested).
		 $msg=$db_entry['Bericht'];
		 if ($valid_request===false){ 
			// a single item is not requested, thus do not show entire text!
			$msg=strstr($msg,"</p>",TRUE)."</p>";
		 }
?>
      <?=$msg ?>
<?php

		if($valid_request===false){ 
?> 
      <p><a href="<?= "nieuws.php?item=" .$db_entry['ID']?>"> Lees meer...</a> </p>
<?php 
		} 
?>
    </div>	
<?php
} //end function POPNEWSITEM

/*
Function MORENEWS puts in a div, with the text 'vorige pagina' and 'volgende pagina'. It dynamically determines what the next or previous page is based on what is currently shown.
*
Input:
  $start 	this variable refers to the ID of the first newsitem showing on the current page
  $top 		this variable refers to the item with highest ID in the database (and very likely to be the most recent one)
*
Output:
  one <div> of class 'morenews', which holds two <span> elements, for both the previous and next news page respectively.
*/
function morenews($start,$top){
?>
        <!-- Allow visitor to see more news -->
        <div class="morenews">
            <span>
<?php 
    if($start<$top){
      // show previous with link
?>
              <a href="<?= "nieuws.php?startat=".($start+5)?>" >Vorige pagina </a>
<?php
    } else { // show without link
?>
                  Vorige pagina
<?php 
    }
?>
            </span>					                
            <span>
    <?php   
        if($start>10+4){
          //show next with link
?>
              <a href="<?= "nieuws.php?startat=".($start-5)?>" >Volgende pagina </a>
<?php
        } else{ //show without link 
?> 
                Volgende pagina
<?php 
		} 
?>
            </span>
        </div>  
<?php     	
} // end function MORENEWS
?>