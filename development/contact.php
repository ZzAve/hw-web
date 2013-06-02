<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--  Links  -->  
<link rel="stylesheet" type="text/css" href="style/main.css" title="style" />
<link rel="stylesheet" type="text/css" href="style/contact.css" title="style" />

<!--  Scripts  --> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="./js/validate.js"></script>


<title>contactformulier</title>

</head>


<body>
<?php include 'header.html'; ?>	
<div id="content-bar">
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
    <br />
    <p1> Voor boekingsaanvragen of informatie, kunt u het onderstaande contactformulier invullen.<br /> 
    Wij nemen dan zo snel mogelijk contact met uw op!</p1><br /> <br />
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
        
        <p>Bericht</p><textarea name="bericht" rows="10" cols="50" <?= $error ?"value=\"$message\"" : NULL ?>></textarea><br />
        <input type="submit" value="Send"><input type="reset" value="Clear">
    </form>
    <br />
    <!-- copy email -->
    
    <label id="email-copy-label" class="copy mail" for="email-copy-checkbox">Kopie verzenden naar uw eigen mail</label>
    <input id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" />
   
    <!-- for programming: if checkbox is filled in, process copy e-mail.-->
    
    </div> <!-- end div content -->
    <div id="sidebar-left"></div>
    <div id="sidebar-right"></div>

</div> <!-- end content-bar -->
<?php include 'footer.html' ?>
</body>


</html>
