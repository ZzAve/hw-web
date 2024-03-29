<?php
function sendMail($from,$mail,$number ="",$sub,$msg,$copy){
	// copy  == 1 | 0  --> 1 means that the mail is a copy for the SENDER (the person who filled in the contact form). 0 means an e-mail to Homemade Water.
	
	// set mail body
	$formcontent = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>Ingevuld contactformulier op HomemadeWater.nl</title>
		</head>
		
		<body>";
		
	if($copy==1){ // Copy for addressee
		$formcontent .= "<p style=\"align:center;\"><em>Dit is een kopie van uw bericht verstuurd vanaf <a href=\"www.homemadewater.nl/contact.php\"> homemadewater.nl</a>. Dit bericht is automatisch gegenereerd.</em></p>";
	} else { // copy for homemade water
		$formcontent .= "<p style=\"align:center;\"> <em> Er heeft iemand een berichtje gestuurd via het contactformulier op de contactpagina van de Homemade Water site. Er is mogelijk een kopie van dit bericht naar de afzender gestuurd (<strong>meneer/mevrouw $from </strong>). Als lezer word je verzocht z.s.m. op dit bericht te reageren (zij het via mail of via telefoon). Alvast bedankt </em></p>";
	}
	
	$formcontent.="			
		<table margin-top=\"10px\" width=\"100%\">
		  <tr> 
			<th width=\"104px\">  <img src=\"http://www.homemadewater.nl/images/logo.jpg\" alt=\"Homemade Water logo\" width=\"100px\"/></th>
			<th> Homemade Water's contactformulier</th>
		</tr>
			<tr>
			  <td><strong>From: </strong></td>
			  <td>$from</td>
			</tr>
			<tr>
			  <td><strong>E-mailadres: </strong></td>
			  <td>$mail</td>
			</tr>
			<tr>
			  <td><strong>Number: </strong></td>
			  <td>$number</td>
			</tr>
			<tr>
			  <td><strong>Subject:</strong></td>
			  <td>$sub</td>
			</tr>
			<tr>
			  <td valign=\"top\"><strong>Message:</strong></td>
			  <td>$msg.</td>
			</tr>
		</table>";
		
	if($copy==1){
		$formcontent.="		
			<p style=\"align:center; margin-top:10px\"><em>Dankuwel voor uw interesse in Homemade Water. Wij zullen zo snel mogelijk op u mail reageren. Kijk tot die tijd nog eens rond op onze <a href=\"http://www.homemadewater.nl/index.php\">site</a>, <a href=\"http://facebook.com/HomemadeWater/\">onze facebookpagina</a> of <a href=\"http://www.soundcloud.com/homemade-water\"> soundcloud</a>.</em></p>";
	}
	
	$formcontent.="	
		</body>
		</html>";
	// END OF MAIL BODY
	
	$mailheader  = "Return-Path: $from <$mail> \r\n";	
	$mailheader .= "From:  Homemade Water <info@homemadewater.nl> \r\n";
	
	/*if ($copy==0){
		$mailheader .= "From:     $from <$mail> \r\n";
		//$mailheader .= "Reply-To: $from <$mail> \r\n";
	} else {
		$mailheader .= "From:     Homemade Water <info@homemadewater.nl> \r\n";
		//$mailheader .= "Reply-To: Homemade Water <info@homemadewater.nl> \r\n";
	}*/
	
	$mailheader .= 'X-Mailer: PHP/' . phpversion()."\r\n";
	// Always set content-type when sending HTML email
	$mailheader .= "MIME-Version: 1.0" . "\r\n";
	$mailheader .= "Content-type:text/html;charset=utf-8" . "\r\n";
		
	$topic = "HomemadeWater.nl - Contactformulier: $sub";
	if($copy==1){
		$receiver=$mail;
	} else {
		$receiver="info@homemadewater.nl";
	}
	return mail($receiver,$topic,$formcontent,$mailheader);
}
?>