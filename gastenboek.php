<?php
	require_once 'misc/miscfunctions.php';
	
 	// Set settings for page
 	$nr_of_posts = 10;  // nr of gastenboek posts to show
 
    //Check if a post needs to be handled
	$requestPostadd = false; 
	$error=false;
	require ('misc/recaptchalib.php'); 

	// Was there a form submitted?
	if( isset($_POST['Naam']) ){
		$privatekey = "6Lf5we4SAAAAAAzEWbJVSnoYr2i_WZ4b1v-VDcIG";
		$resp = recaptcha_check_answer ($privatekey,
							 			$_SERVER["REMOTE_ADDR"],
										$_POST["recaptcha_challenge_field"],
										$_POST["recaptcha_response_field"] );
		$error = !($resp->is_valid);
		$errorMsg = "Er heeft een verkeerde verificatiecode ingevoerd. Probeert u het nog eens";		
		
		$requestPostadd=$_POST;
		$name = strip_tags($requestPostadd['Naam']);
		$email = trim(strip_tags($requestPostadd['Email']));
		$msg = wordwrap(strip_tags($requestPostadd['Bericht']),70); // strip message of any html tags and wrap lines that are longer than 70 characters
		//$msg = str_replace("\n","<br />\n",$msg); // ensure linebreaks are shown in message
		$copy_mail = isset($_POST['email-copy-checkbox']) ? "checked=\"checked\"": NULL;
		
		if (!$error){
			$newPostSucces = uploadNewPost();
		}
	}
	

	//Ensure db connection
	db_connect(1);
	// Check if page is available
	if (isset($_GET['page'])){
		$page = (int) $_GET['page'];
		if ( $page <=0){
			//echo"page is smaller than 0 \n";
			//echo '$page = '.$page;
			//newt_wait_for_key();
			header('Location: '.substr(strrchr($_SERVER['PHP_SELF'],"/"),0));
			exit;
		} else {
			$query = "SELECT * FROM `gastenboek`;";
			$result = mysqli_query($mysql,$query);
			$pageMax  = ceil( mysqli_num_rows($result)/$nr_of_posts );
			//echo "pageMax is $pageMax.  Why?";
			//newt_wait_for_key();
			if ($page > $pageMax){
				// select latest page
				header('Location: '.substr(strrchr($_SERVER['PHP_SELF'],"/"),0)."?page=$pageMax");
				exit;
			}
		}
	}
	
	$extra = "
		<script type=\"text/javascript\">  
			var RecaptchaOptions = {  
				theme : 'white',
				language  : 'nl'
				};  
		</script> ";
	
	$title = "Gastenboek";
	require_once 'header.php'; 
?>

<div id="content-bar">
	<div id="content">
         <h1> Gastenboek </h1>
      	
         <h3> Plaats hier je bericht </h3>
         <!-- The contact form -->
         
        <form id="guestbook" enctype="multipart/form-data" onsubmit="return validateGuestbook()" 
        			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
           <?php if($error){ ?>
           <p class="errorMsg"> <?= $errorMsg?> </p>
            <?php } ?>
           	<label for="Naam">Naam </label>
<input autofocus="" type="text" name="Naam" id="Naam" placeholder="Uw naam" <?= $error ?"value=\"$name\"" : NULL ?>  /> 
           	<label for="Email">E-mail </label> 
            <input type="text" name="Email" id="Email" placeholder="Uw e-mailadres" <?= $error ?"value=\"$email\"" : NULL ?> />

            <br />
          	<label for="Bericht">Bericht </label> 
            <textarea name="Bericht" id="Bericht" placeholder="Wat is uw ervaring met Homemade Water?"><?= $error ?$msg : NULL; ?></textarea>
            <div class="captcha" >
<?php   
		$publickey = "6Lf5we4SAAAAACZLZL-h_-MPKRNHgL4YAi1trQxp"; // you got this from the signup page
        echo recaptcha_get_html($publickey);  
?> 
           </div>
           	<input type="submit" value="Versturen" />
            <input type="reset" value="Wissen" />
           	<label class="hidden copy_mail" id="email-copy-label" for="email-copy-checkbox">Stuur mij een kopie (email)</label> 
            <input class="hidden" id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" <?= $error ? $copy_mail : "checked=\"checked\"" ?> />
        </form>


         <div id="posts">
         	<h3> Recente berichten</h3>
         	<!-- most recent post -->
<?php		
			//Check whether the pagenumber is set
			if(isset($_GET['page'])){
				$page = (int) $_GET['page'];
			} else {
				$page = 1;
			}	
			$start= $nr_of_posts * ($page-1);
			$itemsreq = $nr_of_posts+1;
            $query = "SELECT `id`,`Naam`, `Datum`, `Bericht` FROM `gastenboek` ORDER BY `Datum` DESC LIMIT $start, $itemsreq;";
            $result = mysqli_query($mysql,$query);
			$last = ($nr_of_posts+1) != mysqli_num_rows($result);			
			$end = $last ? 0 : 1;
			
			$count=0;
            while(  $count < mysqli_num_rows($result) - $end && $row = mysqli_fetch_array($result)  )  {
				if ($count==0 && $requestPostadd !== false && !$error)
					popgastItem($row,1);
				else 
				 	popgastItem($row);
				$count++;
			}
			
			pagination($page,$last);
?>	
        </div>   
            
    </div> <!-- end content -->    
    
    <div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar div -->

<?php 	require_once 'footer.php'; ?>

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
// process the incoming request (if necessary)
function uploadNewPost(){
	global $error, $requestPostadd; 
	//put it into the database
	db_connect(2);
	$name = strip_tags($requestPostadd['Naam']);
	$email = trim(strip_tags($requestPostadd['Email']));
	$msg = wordwrap(strip_tags($requestPostadd['Bericht']),70); // strip message of any html tags and wrap lines that are longer than 70 characters
	//$msg = str_replace("\n","<br />\n",$msg); // ensure linebreaks are shown in message
	$copy_mail = isset($_POST['email-copy-checkbox']) ? "checked=\"checked\"": NULL;
	
	$result = false;
	if ($name!=NULL && $email!=NULL && $msg!=NULL){
		$query =  "INSERT INTO `gastenboek`(`Naam`, `Email`, `Bericht`) VALUES (\"".$name."\" ,\"".$email."\" , \"".$msg."\" )";
		$result=mysqli_query($mysql,$query);

		// mail it (if necessary)
		if( $result && $requestPostadd['checkbox-send-copy']=="on"){
			//send mail (not yet)
			
		}
		if ($result != TRUE){
			$error = false;
			$errorMsg = "Er is iets fout gegaan tijdens de behandeling van jouw bericht. Probeer het later nog een keertje!";
		}
	}
	db_restore();
	return $result;

}


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
	<div id="<?=$db_item['id']?>" class="<?= $new==1 ? "hidden":"";?> gastItem item"> 
    	<p class="head"><label><?=$name?></label> zei: (<?=$time?> geleden)</p>
        <p><em><?=$msg?></em></p>
    </div>
<?php	
}

?>