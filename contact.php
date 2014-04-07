<?php 
// mail contact form
$error=false; // set error and 'am i mailed'-variables to standard value false
$mailed=false;

if( isset($_POST['name']) ){
	global $error; // make use of global defined variables
	global $mailed;
	
	$mailed=true;
	
	// if e-mail sheet is filled in, process e-mail.
	$name = strip_tags($_REQUEST['name']);
	$email = trim(strip_tags($_REQUEST['email']));
	$phone = isset($_REQUEST['phone']) ? strip_tags($_REQUEST['phone']) : "";  // shorthand if statement
	$subject = strip_tags($_REQUEST['subject']);
	$message = wordwrap(strip_tags($_REQUEST['bericht']),70); // strip message of any html tags and wrap lines that are longer than 70 characters
	$message = str_replace("\n","<br />\n",$message); // ensure linebreaks are shown in message
	require_once 'mail.php'; // mail.php contains a function sendMail that requires the necessary information to send an e-mail.
	$worked = sendMail($name,$email,$phone,$subject,$message,0);

	$error=!$worked;
	if(isset($_REQUEST['checkbox-send-copy'])){
		$copy_mail = "checked =\"checked\"";
		sendMail($name,$email,$phone,$subject,$message,1);
	} else {
		$copy_mail = NULL;
	}
}
	$title= "Contact";
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/contact.css\" title=\"style\" />";
 	require_once 'header.php'; 	
?>	
<div id="content-bar">
    <div id="content">
        <h1> Neem contact met ons op</h1>
        <?php 
		// check if mail was processed
		if($mailed){
			// if there was mailed, check if everything went according to plan.    	       
            if(!$error) {
				// if so (everything went according to plan), say something nice
                $starttxt="Uw bericht is verstuurd. U hoort zo spoedig mogelijk van ons!";		
            } else {
				// if not, at least let the person know
                $starttxt="Tijdens de verwerking van uw formulier is fout opgetreden. Probeert u het later nog eens, of stuur een e-mail naar <a href=\"mailto:info@homemadewater.nl\">info@homemadewater.nl</a>";
            }
			// state the text
            echo "<p> $starttxt </p>";
            
        } else {
            // if no form was send to this page, allow people to fill in the contactform (show standard text)
        ?>    
        <p> Meer info? Wilt u ons boeken, of om een andere reden contact met ons opnemen? Geen probleem. Gebruik onderstaand formulier of mail naar <a href="mailto:info@homemadewater.nl">info@homemadewater.nl</a>. U krijgt zo spoedig mogelijk antwoord! </p>
    
        <?php } ?>

        <!-- The contact form -->
        <form id="contact_form" enctype="multipart/form-data" onsubmit="return validateContact()" action="/contact.php" method="post">
            <img src="/images/HW_Locus_15.jpg" alt="We salute you" title="Namens Homemade Water, alvast bedankt"/>
            <p>Naam <br /><input type="text" name="name" <?= $error ?"value=\"$name\"" : NULL ?>  /> </p>
            <p>E-mail <br /><input type="email" name="email" <?= $error ?"value=\"$email\"" : NULL ?> /></p>
            <p>Telefoon (optioneel) <br /><input type="text" name="phone"/> </p>
            <p> Onderwerp <br /><input type="text" name="subject"/> </p>
            <p>Bericht <br /><textarea name="bericht" rows="10" cols="58" <?= $error ?"value=\"$message\"" : NULL ?>></textarea></p>
            <p> <input id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" <?= $error ? $copy_mail : "checked=\"checked\"" ?> /> <label id="email-copy-label" class="copy mail" for="email-copy-checkbox">Stuur een kopie naar mijn eigen e-mailadres</label> </p>
            <p><input type="submit" value="Versturen" /><input type="reset" value="Wissen" />
            </p>

        </form>
    
    </div> <!-- end div content -->
  

</div> <!-- end content-bar -->
<?php require_once 'footer.php'; ?>

<!--  Document specific scripts  --> 
<script type="text/javascript" src="./js/validate.js"></script>

</body>
</html>
