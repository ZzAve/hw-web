<?php
	$requestPostadd = false; 
	$error=false;
	
	//Check if a post needs to be handled
	if( isset($_POST['Naam']) ){
		$requestPostadd=$_POST;
		$requestPostadd['Datum'] = time();
	}
	
	
	$title = "Gastenboek";
	require_once 'header.php'; 
	require_once 'misc/db_guestRead.php';
	setlocale(LC_TIME, 'Dutch');
?>

<div id="content-bar">
	<div id="content">
         <h1> Gastenboek </h1>
      	
         <h3> Plaats hier je bericht </h3>
         <!-- The contact form -->
        <form id="guestbook" enctype="multipart/form-data" onsubmit="return validateGuestbook()" action="gastenboek.php" method="post">
           	<label for="Naam">Naam </label>
<input autofocus="" type="text" name="Naam" id="Naam" placeholder="Uw naam" <?= $error ?"value=\"$name\"" : NULL ?>  /> 
           	<label for="Email">E-mail </label> 
            <input type="text" name="Email"`id="Email" placeholder="Uw e-mailadres" <?= $error ?"value=\"$email\"" : NULL ?> />

            <br />
          	<label for="Bericht">Bericht </label> 
            <textarea name="Bericht" id="Bericht" placeholder="Wat is uw ervaring met Homemade Water?" <?= $error ?"value=\"$message\"" : NULL ?>></textarea>
           	<input type="submit" value="Versturen" />
           	<label class="hidden" id="email-copy-label" class="copy mail" for="email-copy-checkbox">Stuur mij een kopie (email)</label> 
            <input class="hidden" id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" <?= $error ? $copy_mail : "checked=\"checked\"" ?> />
        </form>


         <div id="posts">
         	<h3> Recente berichten</h3>
         	<!-- most recent post -->
<?php		
			$query = "SELECT MAX(`id`) FROM `gastenboek`";
			$top = mysqli_fetch_array(mysqli_query($mysql,$query));

			//Check whether startat is set
			if(isset($_GET['startat'])){
				$start= "WHERE `ID`<=". (int) $_GET['startat'];
				$current = $_GET['startat'];
			} else {
				$start="";
				$current=$top[0];
			}	
			 
			$nr_of_posts = 10;
            $query = "SELECT `Naam`, `Datum`, `Bericht` FROM `gastenboek` $start ORDER BY `Datum` DESC LIMIT $nr_of_posts;";
            $result = mysqli_query($mysql,$query);
						
			if ($requestPostadd !== false){
				popgastItem($requestPostadd,1);	
			}
            while( $row = mysqli_fetch_array($result) )  {
				popgastItem($row);
			}
			moreOf("gastenboek.php",$nr_of_posts,$current,$top[0],1);
?>	
        </div>   
            
    </div> <!-- end content -->    
    
    <div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar div -->

<?php 
	// process the incoming request (if necessary)
	if ($requestPostadd !== false){
		//put it into the database
		require_once 'misc/db_guestPost.php';
		$query =  "INSERT INTO `gastenboek`(`Naam`, `Email`, `Bericht`) VALUES (\"".$requestPostadd['Naam']."\" ,\"".$requestPostadd['Email']."\" , \"".$requestPostadd['Bericht']."\" )";
		$result=mysqli_query($mysql,$query);

		// mail it (if necessary)
		if( $result && $requestPostadd['checkbox-send-copy']=="on"){
			//send mail (not yet)
			
		}
	}

	require_once 'footer.php'; 
?>	

<!--  Document specific scripts  --> 
<script type="text/javascript" src="/js/validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
	  
	  $('#posts div.hidden').hide().removeClass("hidden").fadeIn(1000);
	  
  });
</script>

</body>
</html>

<?php

/*
* Function POPGASTITEM takes a database entry as a input argument, which holds the information about a post on the 'gastenboek' page. It calculates the time that has passed since the message was post, and uses this while it spits out some HTML code (a div with class gastItem)
*
Input:
	$db_item 	it is a database entry with the ID, Datum, and Naam information. The E-mail information is not necessary, but can be send as well (nothing will happen with it
*
Output:
	It spits out a <div> element that holds two <p> elements. These hold the header (name and time passed since post), and the post itself respectively.
*/
function popgastItem($db_item,$new=0){
	// Obviously, the first task is error checking.
	
	// TODO: IMPLEMENT ERROR CHECKING
	// ..
	
	// END ERROR CHECKING
	
	// get the time that has passed since the post was posted (in days)
	
	$name =$db_item['Naam'];
	$date = abs(time() - $db_item['Datum']) < 10 ? $db_item['Datum'] : strtotime($db_item['Datum']) ;
	$msg = $db_item['Bericht'];
	
	$passedtime = (time() - $date )/86400;
	
	// Check whether the passed time in which we want to show it is in the order of days or smaller (<1 means smaller)
	if ($passedtime<1){
		// Check whether it is also in the order of minutes (<1 means it is)
		if ($passedtime*24 < 1){
			$time = round($passedtime*24*60)." minuten";
		} else {
			// if not in the order of minutes, it is in the order of hours
			$time = round($passedtime*24)." uur";
		}
	} else {
		// if it has nog been posted within a day (24 hours) give it in days
		$time = round($passedtime)." dagen";
	}
	
	//Now post the findings (naam, passedtime and the message (bericht)
?>
	<div class="<?= $new==1 ? "hidden":"";?> gastItem"> 
    	<p class="head"><label><?=$name?></label> (<?=$time?> geleden)</p>
        <p><?=$msg?></p>
    </div>
<?php	
}

/*
Function MOREOF puts in a div, with the text 'vorige pagina' and 'volgende pagina'. It dynamically determines what the next or previous page is based on what is currently shown.
*
Input:
  $page 	name of the page
  $ippage 	number of items that are showing, per page
  $start 	this variable refers to the ID of the first newsitem showing on the current page
  $top 		this variable refers to the item with highest ID in the database (and very likely to be the most recent one)
*
Output:
  one <div> of class 'morenews', which holds two <span> elements, for both the previous and next news page respectively.
*/
function moreOf($page,$ipPage,$start,$top,$bottom=1){
?>
        <!-- Allow visitor to see more news -->
        <div class="morenews">
            <span>
<?php 
    if($start<$top){
      // show previous with link
?>
              <a href="<?= substr(strrchr($_SERVER['PHP_SELF'],"/"),1)."?startat=".(($start+$ipPage) > $top ? $top : $start+$ipPage)?>" >Vorige pagina </a>
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
        if($start>$bottom+$ipPage-1){
          //show next with link
?>
              <a href="<?= substr(strrchr($_SERVER['PHP_SELF'],"/"),1)."?startat=".(($start+$ipPage) > $top ? $top : $start+$ipPage)?>" >Volgende pagina </a>
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
} // end function MOREOF
?>