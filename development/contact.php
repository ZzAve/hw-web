<?php 
// mail contact form
$error=false;
$mailed=false;
if( isset($_REQUEST['name']) ){
	global $error;
	global $mailed;
	
	$mailed=true;
	// if e-mail sheet is filled in, process e-mail.
	$name = strip_tags($_REQUEST['name']);
	$email = trim(strip_tags($_REQUEST['email']));
	$phone = isset($_REQUEST['phone']) ? strip_tags($_REQUEST['phone']) : "";  // shorthand if statement
	$subject = strip_tags($_REQUEST['subject']);
	$message = wordwrap(strip_tags($_REQUEST['bericht']),70); // strip message of any html tags and wrap lines that are longer than 70 characters

	require_once("mail.php");
	$worked = sendMail($name,$email,$phone,$subject,$message,0);
	$error=!$worked;
	if(isset($_REQUEST['checkbox-send-copy'])){
		$copy_mail = "checked =\"checked\"";
		sendMail($name,$email,$phone,$subject,$message,1);
	} else {
		$copy_mail = NULL;
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"
	  xmlns:fb="http://ogp.me/ns/fb#"
      lang="nl" xml:lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- <base href="www.homemadewater.nl/development" target="_blank" /> -->
    <link href="images/shortIcon.jpg" rel="shortcut icon" />
    <link rel="image_src" href="http://www.homemadewater.nl/images/logo.jpg" />
    <link rel="image_src" href="http://www.homemadewater.nl/images/screenshot.jpg" />
    <meta name="description" content="Homemade Water is een frisse pop/rock (cover)band die elke zaal om kan toveren tot feestende bende!"/>
    <meta name="keywords" content="Homemade Water, band, coverband, pop, rock, dutch, nederlands, feestband, clash, coverbands, student, studenten, Laurens Mensink, Andrea Forzoni, Eline Burger, Moos Meijer, Julius van Dis" />
    <meta name="author" content="Homemade Water" />
    <meta name="publisher" content="Homemade Water" />
    <meta name="Homemade Water" content="Delft band cover coverband Laurens Mensink Eline Burger Moos Meijer Andrea Forzoni Julius van Dis" />
	<title>Homemade Water - Contact</title>

    <!--  Standard links and scripts  -->  
    <link rel="stylesheet" type="text/css" href="style/main.css" title="style" />
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <?php include_once("analyticstracking.php") ?>
    
    <!--  Document specific links and scripts  --> 
   <script type="text/javascript" src="./js/validate.js"></script>
   <link rel="stylesheet" type="text/css" href="style/contact.css" title="style" />
</head>

<body>
<?php include_once("facebookjssdk.php");?>
<?php include 'header.html'; ?>	
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
        <form id="contact_form" enctype="multipart/form-data" onsubmit="return validate()" action="./contact.php" method="post">
            <p>Naam <br /><input type="text" name="name" <?= $error ?"value=\"$name\"" : NULL ?>  /> </p>
            <p>E-mail <br /><input type="text" name="email" <?= $error ?"value=\"$email\"" : NULL ?> /></p>
            <p>Telefoon (optioneel) <br /><input type="text" name="phone"/> </p>
            <p> Onderwerp <br /><input type="text" name="subject"/> </p>
            <p>Bericht <br /><textarea name="bericht" rows="10" cols="58" <?= $error ?"value=\"$message\"" : NULL ?>></textarea></p>
            <p><input type="submit" value="Versturen" /><input type="reset" value="Wissen" />
            <label id="email-copy-label" class="copy mail" for="email-copy-checkbox">Kopie verzenden naar uw eigen mail</label> <input id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" <?= $error ? $copy_mail : NULL ?> /> </p>
        </form>
    
    </div> <!-- end div content -->
    <div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar -->
<?php include 'footer.html'; ?>
</body>

</html>
