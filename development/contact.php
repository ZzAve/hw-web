<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/main.css" title="style" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

<script type="text/javascript" src="./js/validate.js"></script>

<title>Untitled Document</title>
</head>

<body>

<div id="content-bar">
	<?php include 'header.html'; ?>
    <div id="content">
    
    <?php
    // mail contact form
    $error=false;
    if( isset($_REQUEST['name']) ){
        // if e-mail sheet is filled in, process e-mail.
        $name = strip_tags($_REQUEST['name']);
        $email = trim(strip_tags($_REQUEST['email']));
        $phone = strip_tags($_REQUEST['phone']);
        $message = strip_tags($_REQUEST['bericht']);
        $type = $_REQUEST['type'];
        $formcontent ="From:    $name \r\n";
        $formcontent .="E-mail adres:    $email \r\n";
        $formcontent .="Number:    $phone \r\n";
        $formcontent .="Topic: $type \r\n";
        $formcontent .="Message: \r\n $message";
        $recipient = "info@homemadewater.nl";
        $subject = "Contact Form - $type";
        
        $mailheader  = "Return-Path: $email \r\n";	
        $mailheader .= "From:  $name <$email> \r\n";
        $mailheader .= "Reply-To: $name <$email> \r\n";
        $mailheader .= 'X-Mailer: PHP/' . phpversion();
        
        $worked = mail($recipient, $subject, $formcontent, $mailheader);
        
        if( $worked) {
            $mailed="Uw bericht is verstuurd. U hoort zo spoedig mogelijk van ons!";
            $error=false;
        } else {
            $mailed="Tijdens de verwerking van uw formulier is fout opgetreden. Probeert u het later nog eens, of stuur een e-mail naar <a href=\"mailto:info@homemadewater.nl\">info@homemadewater.nl</a>";
            $error=true;
        }
        echo "<p> $mailed </p>";
        
    } else {
        // if no form was send to this page, allow people to fill in the contactform
    ?>
    <p> Hallo, je kan nu het contactformulier invullen</p>
    <?php } ?>
    
    <!-- The contact form -->
    <form name="contact_form" enctype="multipart/form-data" onsubmit="return validate()" action="./contact.php" method="POST">
        <p>Naam</p> <input type="text" name="name" <?= $error ?"value=\"$name\"" : NULL ?>  >
        <p>E-mail</p> <input type="text" name="email" <?= $error ?"value=\"$email\"" : NULL ?> >
        <p>Telefoon (optional)</p> <input type="text" name="phone" <?= $error ?"value=\"$phone\"" : NULL ?>>
        <br />
        <p>Aard van contact</p>
        <select name="type" size="1">
        <option value="booking">Boeking</option>
        <option value="info">Informatie</option>
        <option value="anders">Anders</option>
        </select>
        <br />
        
        <p>Bericht</p><textarea name="bericht" rows="6" cols="25" <?= $error ?"value=\"$message\"" : NULL ?>></textarea><br />
        <input type="submit" value="Send"><input type="reset" value="Clear">
    </form>
    
    
    </div> <!-- end div middle -->
    
    <?php include 'footer.html' ?>
</div> <!-- end content-bar -->
</body>


</html>
