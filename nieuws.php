<?php
    require 'misc/miscfunctions.php';
	//Ensure db connection
	db_connect(0);
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
	if ($valid_request !== false){
		//Set a title for the page
		$pre_title = $valid_request['Titel']." - ";
		$title = $pre_title."Nieuws";
		
		//Set the description for the page
		$description = htmlspecialchars(substr(strip_tags( $valid_request['Bericht'] ),0,200))."...";
	
		//Set a facebook image
		$fb_img = $valid_request['Foto'];
	} else { 
		$title = "Nieuws";
	}
	//Import header
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/nieuws1.1.css\" title=\"style\" />";
    require_once 'header.php';  
?>

<div id="content-bar">
    <div id="content">
		    
<?php	// There are to options to show:
		// 	1. Show a specific item
		//  2. Show a part of the newsitems

	if($valid_request!==false){
			// Show one item
?>	    <h1>Nieuwsbericht</h1> 
<?php		popnewsitem($valid_request);
			$prev_news = strstr(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "" ,"?page=");
			backToOverview($prev_news);
	} else {
		
		// Show 'all' the newsitems
		if($request){//show error (through an javascript alert?)
?>
			<script> 
				setTimeout(function(){alert('Helaas is het door u opgegeven nieuwsbericht niet meer beschikbaar of heeft het nooit bestaan.\n\nDesalniettemin hebben wij voor u de meest recente nieuwsbericht voor u op een rijtje gezet.');},800);
			</script>
<?php
		}
		
		//$query = "SELECT `ID` FROM `nieuwsitems` ORDER BY `ID` DESC LIMIT 1;";
		//$result = mysqli_query($mysql,$query);
		//$ans = mysqli_fetch_array($result);
		$nrOfItems=5;
		if(isset($_GET['page']) && intval($_GET['page'])>=2){
	 	  // give the five newsitems starting from  'page'
		  $page=intval($_GET['page']);
		} else {
		  $page = 1;
		}
?>
        <h1> Het laatste nieuws!</h1> 
        <h2> Om ons op de voet te volgen, verwijzen we u door naar onze <a href="http://www.facebook.com/HomemadeWater">facebook pagina</a></h2>  
<?php
			$start = ($page-1)*$nrOfItems;
			$limit = $nrOfItems+1;
            $query = "SELECT * FROM `nieuwsitems` ORDER BY `Datum` DESC LIMIT $start,$limit;";
            $result = mysqli_query($mysql,$query);
     		$rows = mysqli_num_rows($result); 
		    $last = $nrOfItems+1 != $rows;
			$count=0;
            while( $count < $nrOfItems && $row = mysqli_fetch_array($result) )  {
              popnewsitem($row);
			  $count++;
            }                 		
?> 		<hr />
<?php		pagination($page,$last);
		}	
?>         
    </div> <!-- end div content -->
	

</div> <!-- end content-bar -->
<?php require_once 'footer.php' ?>
	<!-- google plus script -->
    <script type="text/javascript">
      window.___gcfg = {lang: 'nl'};
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    
    <!-- twitter script -->
    <script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	<!-- ||| end page specific scripts ||| -->
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
    <hr  />
    <div class="newsitem item <?= $valid_request!==false ? "single" : ""?>" id="<?="item" . $db_entry['ID']?>">
      <div class="date">
        <label> <?= array_pop($date)?> </label>
        <span> <?= strtoupper(strftime("%b",mktime(0, 0, 0, array_pop($date) ) ) )?> </span>
      </div>

<?php  // make both the title and image a link, such that if clicked, a screen opens with only that newsitem
	   if($valid_request===false){
?>
	  <div class="description">
      <h3><a href="<?= "nieuws.php?item=".$db_entry['ID']?> "><?= $db_entry['Titel']?></a></h3>
      <a href="<?= "nieuws.php?item=".$db_entry['ID']?>"> <img src="<?=$db_entry['Foto']?>" alt="<?=$db_entry['Alt_foto']?>" title="<?=$db_entry['Alt_foto']?>"/></a>
<?php
	   } else {
?>
      <h3><?= $db_entry['Titel']?> </h3>
      <img src="<?=$db_entry['Foto']?>" alt="<?=$db_entry['Alt_foto']?>" title="<?=$db_entry['Alt_foto']?>"/>
<?php	
		if ($valid_request!==false){
			shareDiv();
		} 
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
			moreOf("nieuws.php?item=" .$db_entry['ID']);
			?> 	
	</div>
<?php	} ?>

    </div>	
<?php
} //end function POPNEWSITEM