<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/main.css" title="style" />
<title>Untitled Document</title>
</head>

<body>


<?php include 'header.html'; ?>
<div id="middle"> <div id="content">
<?php
// mail contact form
if( isset($_REQUEST['name']) ){
	// if e-mail sheet is filled in, process e-mail.
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $message = $_REQUEST['bericht'];
    $type = $_REQUEST['type'];
    $formcontent="From: $name \n Number: $phone \n Topic: $type \n Message: \n $message";
    $recipient = "test@test.ts";
    $subject = "Contact Form - $type";
    $mailheader = "From: $email \r\n";
    mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
    echo "<p>Thank You!</p>";
} else {
	// if not, allow people to fill in the contactform
?>
<p> Hallo, je kan nu het contactformulier invullen</p>
<?php } ?>
<!-- contact form -->
<script type="text/javascript" src="./js/validate.js"></script>
<form name="contact_form" enctype="multipart/form-data" onsubmit="return validate()" action="./contact.php" method="POST">
<p>Naam</p> <input type="text" name="name" >
<p>E-mail</p> <input type="text" name="email" >
<p>Telefoon (optional)</p> <input type="text" name="phone" >
<br />
<p>Aard van contact</p>
<select name="type" size="1">
<option value="booking">Boeking</option>
<option value="info">Informatie</option>
<option value="anders">Anders</option>
</select>
<br />

<p>Bericht</p><textarea name="bericht" rows="6" cols="25"></textarea><br />
<input type="submit" value="Send"><input type="reset" value="Clear">
</form>
</div></div>

<?php include 'footer.html' ?>
</body>


</html>
