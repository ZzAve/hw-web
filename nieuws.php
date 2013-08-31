<?php 
	  require_once 'header.php';
	  require_once('misc/db_connectread.php');
	  setlocale(LC_TIME, 'Dutch'); 
?>

<div id="content-bar">
    <div id="content">
		    
    	<?php // check whether 1 newsitem is requested or something else
			$special=false; //assume visitor does not want something other than the standard page

			if(isset($_GET['id'])){
				$id=intval(str_replace('item','',$_GET['id']));
				$query = "SELECT * FROM  `nieuwsitems` WHERE  `ID` = $id";
				$result = mysqli_query($mysql,$query);
				$row = mysqli_fetch_array($result);
				if ($row != NULL && $row['ID']!= "" ) {
					$prev_news = strstr(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "" ,"?startat=");
					?> 
                    <p> 
                    	<a href="nieuws.php<?= $prev_news ? $prev_news : "" ?>">Ga terug naar het nieuwsoverzicht</a>
                    </p>
                    <?php
					// create only 1 newsitem
					$special=true;
					popnewsitem($row);
					?>
                    <p> <a href="nieuws.php<?= $prev_news ? $prev_news : "" ?>"> Ga terug naar het nieuwsoverzicht</a></p>
                    <?php
				}
			}
			
			if(!$special){
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
                  include 'misc/morenews.php';
                  $query = "SELECT * FROM `nieuwsitems` WHERE `ID`<=$start ORDER BY `Datum` DESC LIMIT 5;";
                  $result = mysqli_query($mysql,$query);
                  while( $row = mysqli_fetch_array($result) )  {
                      popnewsitem($row);
                  }
                       		
                  include 'misc/morenews.php';
	  	    } // end check for special loop
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
		global $special;
		$date = explode("-",$db_entry['Datum']);
		?> 
		<div class="newsitem <?= $special ? "single" : ""?>" id="<?="item" . $db_entry['ID']?>">
		   <div class="date">
			  <label> <?= array_pop($date)?> </label>
			  <span> <?= strtoupper(strftime("%b",mktime(0, 0, 0, array_pop($date) ) ) )?> </span>
		   </div>
           
           <?php // make both the title and image a link, such that if clicked, a screen opens with only that newsitem?>
		   <a href="<?= "nieuws.php?id=item".$db_entry['ID']?> "><h3>  <?= $db_entry['Titel']?> </h3></a>
		   <a href="<?= "nieuws.php?id=item".$db_entry['ID']?>"> <img src="<?=$db_entry['Foto']?>" alt="<?=$db_entry['Alt_foto']?>" title="<?=$db_entry['Alt_foto']?>"/></a>
		   <?php
		   	 //Ensure what message to post. 
			 //	 A short one (in case of multiple items) 
			 //  or the whole text (in case a single newsitem is requested).
		   	 $msg=$db_entry['Bericht'];
			 if (!$special){ 
			 	// a single item is not requested, thus do not show entire text!
           	 	$msg=strstr($msg,"</p>",TRUE)."</p>";
			 }
		  ?>
             
 		  <?=$msg?>
         
          <?php 
            if(!$special){ 
                ?> 
                <p><a href="<?= "nieuws.php?id=item" .$db_entry['ID']?>"> Lees meer...</a> </p>
                <?php 
            } 
          ?>
           
	    </div>	
        <?php
	}
?>
