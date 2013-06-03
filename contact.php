<?php 

function sendCopy($title,$mail,$number ="",$msg){
		$formcontent = "Dit is een kopie van uw bericht verstuurd vanaf <a href=\"www.homemadewater.nl/contact.php\"> homemadewater.nl</a>. Dit bericht is automatisch gegenereerd. \r\n\r\n";
		$formcontent .="From:    $title \r\n";
        $formcontent .="E-mail adres:    $mail \r\n";
        $formcontent .="Number:    $number \r\n";
        //$formcontent .="Topic: $type \r\n";
        $formcontent .="Message: \r\n $msg";
		
		$mailheader  = "Return-Path: $email \r\n";	
        $mailheader .= "From:  Homemade Water <info@homemadewater.nl> \r\n";
        $mailheader .= "Reply-To: Homemade Water <info@homemadewater.nl> \r\n";       $mailheader .= 'X-Mailer: PHP/' . phpversion();
		
		$subject = "HomemadeWater.nl - Contactformulier";
		$succes = mail($mail,$subject,$formcontent,$mailheader);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <base href="www.homemadewater.nl/development" target="_blank" /> -->
<link href="images/shortIcon.jpg" rel="shortcut icon" />
<meta name="description" content="Homemade Water is een frisse pop/rock (cover)band die elke zaal om kan toveren tot feestende bende! ">
<meta name="keywords" content="Homemade Water, band, coverband, pop, rock, dutch, nederlands, feestband, clash, coverbands, student, studenten, Laurens Mensink, Andrea Forzoni, Eline Burger, Moos Meijer, Julius van Dis">
<meta name="author" content="Homemade Water">
<meta name="publisher" content="Homemade Water" />
<meta name="Homemade Water" content="Delft band cover coverband Laurens Mensink Eline Burger Moos Meijer Andrea Forzoni Julius van Dis" />
<title>Homemade Water - Contact</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />




<!--  Links  -->  
<link rel="stylesheet" type="text/css" href="style/main.css" title="style" />
<link rel="stylesheet" type="text/css" href="style/contact.css" title="style" />

<!--  Scripts  --> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="./js/validate.js"></script>
<?php include_once("analyticstracking.php") ?>
</head>


<body>

<?php include 'header.html'; ?>	
<div id="content-bar">
    <div id="content">
    <h1> Neem contact met ons op</h1>
    <?php
    // mail contact form
    $error=false;
    if( isset($_REQUEST['name']) ){
        // if e-mail sheet is filled in, process e-mail.
        $name = strip_tags($_REQUEST['name']);
        $email = trim(strip_tags($_REQUEST['email']));
        $phone = isset($_REQUEST['phone']) ? strip_tags($_REQUEST['phone']) : "";
        $message = strip_tags($_REQUEST['bericht']);
        //$type = $_REQUEST['type'];
		if(isset($_REQUEST['checkbox-send-copy'])){
			$copy_mail = "checked =\"checked\"";
		} else {
			$copy_mail = NULL;
		}

        $formcontent ="From:    $name \r\n";
        $formcontent .="E-mail adres:    $email \r\n";
        $formcontent .="Number:    $phone \r\n";
        //$formcontent .="Topic: $type \r\n";
        $formcontent .="Message: \r\n $message";
        $recipient = "info@homemadewater.nl";
        $subject = "Contact Form 'HomemadeWater.nl'";
        
        $mailheader  = "Return-Path: $email \r\n";	
        $mailheader .= "From:  $name <$email> \r\n";
        $mailheader .= "Reply-To: $name <$email> \r\n";
        $mailheader .= 'X-Mailer: PHP/' . phpversion();
        
        $worked = mail($recipient, $subject, $formcontent, $mailheader);
        
        if( $worked) {
            $mailed="Uw bericht is verstuurd. U hoort zo spoedig mogelijk van ons!";		
			if($copy_mail != NULL){
				 sendCopy($name,$email,$phone,$message);
			}
			
            $error=false;
        } else {
            $mailed="Tijdens de verwerking van uw formulier is fout opgetreden. Probeert u het later nog eens, of stuur een e-mail naar <a href=\"mailto:info@homemadewater.nl\">info@homemadewater.nl</a>";
            $error=true;
        }
        echo "<p> $mailed </p>";
        
    } else {
        // if no form was send to this page, allow people to fill in the contactform
    ?>

    <p> Meer info? Wilt u ons boeken of om een andere reden contact opnemen? Geen probleem. Gebruik onderstaand formulier of mail naar <a href="mailto:info@homemadewater.nl">info@homemadewater.nl</a>. U krijgt zo spoedig mogelijk antwoord. </p>

    <?php } ?>
    
    <!-- The contact form -->
    <form name="contact_form" enctype="multipart/form-data" onsubmit="return validate()" action="./contact.php" method="POST">
        <p>Naam</p> <input type="text" name="name" <?= $error ?"value=\"$name\"" : NULL ?>  >
        <p>E-mail</p> <input type="text" name="email" <?= $error ?"value=\"$email\"" : NULL ?> >
        <p>Telefoon (optioneel)</p> <input type="text" name="phone"/>
        <!-- <br />
        <p>Aard van contact</p>
        <select name="type" size="1">
        <option value="booking">Boeking</option>
        <option value="info">Informatie</option>
        <option value="anders">Anders</option>
        </select>
        <br /> -->
        
        <p>Bericht</p><textarea name="bericht" rows="10" cols="58" <?= $error ?"value=\"$message\"" : NULL ?>></textarea><br />
        <input type="submit" value="Versturen"><input type="reset" value="Wissen">
        <label id="email-copy-label" class="copy mail" for="email-copy-checkbox">Kopie verzenden naar uw eigen mail</label> <input id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" <?= $error ? $copy_mail : NULL ?> />
    </form>
    <br />
    <!-- copy email -->
    
   
   
    <!-- for programming: if checkbox is filled in, process copy e-mail.-->
    
    </div> <!-- end div content -->
    <div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar -->
<?php include 'footer.html' ?>
</body>


</html>
