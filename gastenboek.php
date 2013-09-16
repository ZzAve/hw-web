<?php
	$requestPostadd = false; 
	$error=false;
	
	//Check if a post needs to be handled
	if( isset($_POST['name']) ){
		$requestPostadd=true;
	}
	
	require_once 'header.php'; 
	require_once 'misc/db_connectread.php';
	setlocale(LC_TIME, 'Dutch');
?>

<div id="content-bar">
	<div id="content">
         <h1> Gastenboek </h1>
      	
         <h3> Plaats hier je bericht </h3>
         <!-- The contact form -->
        <form id="guestbook" enctype="multipart/form-data" onsubmit="return validateGuestbook()" action="gastenboek.php" method="post">
           	<label for="name">Naam </label>
            <input autofocus="" type="text" name="name" id="name" placeholder="Uw naam" <?= $error ?"value=\"$name\"" : NULL ?>  /> 
           	<label for="email">E-mail </label> 
            <input type="text" name="email"`id="email" placeholder="Uw e-mailadres" <?= $error ?"value=\"$email\"" : NULL ?> />

            <br />
          	<label for="bericht">Bericht </label> 
            <textarea name="bericht" id="bericht" placeholder="Wat is uw ervaring met Homemade Water?" <?= $error ?"value=\"$message\"" : NULL ?>></textarea>
           	<input type="submit" value="Versturen" />
           	<label id="email-copy-label" class="copy mail" for="email-copy-checkbox">Stuur mij een kopie (email)</label> 
            <input id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" <?= $error ? $copy_mail : "checked=\"checked\"" ?> /> 
        </form>
            
<?php
		 if($requestPostadd!==false){
?>		
			<div>
            	<h3> Let us process this shit</h3>
            	<pre><?=print_r($_POST)?></pre>
                <p> Wat je hier zit is alle informatie die binnen is gekomen, daar moet je het mee doen.</p>
            </div>
<?php 
		 }

?>
         <div id="posts">
         	<h3> Recente berichten</h3>
         	<!-- most recent post -->
<?php		// get most recent post 
			$lastpost=-1; // get the id of the last post to present (last meaning most recent), -1 meaning very first.
			$start="";
			$nr_of_posts = 10;
			if($lastpost!=-1){
				$start = "WHERE `ID`<=$start";
			}
            $query = "SELECT * FROM `gastenboek` $start ORDER BY `Datum` DESC LIMIT $nr_of_posts;";
            $result = mysqli_query($mysql,$query);
            while( $row = mysqli_fetch_array($result) )  {
				popgastItem($row);
			}
?>	
        </div>   
            
    </div> <!-- end content -->    
    
    <div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar div -->

<?php require_once 'footer.php'; ?>	

<!--  Document specific scripts  --> 
<script type="text/javascript" src="./js/validate.js"></script>

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
function popgastItem($db_item){
	// Obviously, the first task is error checking.
	
	// ..
	// ..
	
	// END ERROR CHECKING
	
	// get the time that has passed since the post was posted (in days)
	$passedtime = (time() - strtotime($db_item['Datum']) )/86400;
	
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
	<div class="gastItem"> 
    	<p class="head"><label> <?= $db_item['Naam']?></label> (<?= $time?> geleden)</p>
        <p><?= $db_item['Bericht']?></p>
    </div>
<?php	
}
?>