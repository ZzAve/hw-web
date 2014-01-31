<?php
// mail contact form
$error=false; // set error and 'am i mailed'-variables to standard value false
$mailed=false;

if( isset($_REQUEST['name']) ){
	global $error; // make use of global defined variables
	global $mailed;
	
	$mailed=true;
	
	// if e-mail sheet is filled in, process e-mail.
	$name = strip_tags($_REQUEST['name']);
	$email = trim(strip_tags($_REQUEST['email']));
	$phone = isset($_REQUEST['phone']) ? strip_tags($_REQUEST['phone']) : "";  // shorthand if statement
	$kaartNr = $_REQUEST['kaarten'];
	
	$joyride = $_REQUEST['ride'];
	//$subject = strip_tags($_REQUEST['subject']);
	$message = wordwrap(strip_tags($_REQUEST['bericht']),70); // strip message of any html tags and wrap lines that are longer than 70 characters
	$message = str_replace("\n","<br />\n",$message); // ensure linebreaks are shown in message
	require_once("mail.php"); // mail.php contains a function sendMail that requires the necessary information to send an e-mail.
	$worked = sendClash($name,$email,$phone,$kaartNr,$joyride,$message,0);
	$error=!$worked;
	if(isset($_REQUEST['checkbox-send-copy'])){
		$copy_mail = "checked =\"checked\"";
		$worked = sendClash($name,$email,$phone,$kaartNr,$joyride,$message,1);
	} else {
		$copy_mail = NULL;
	}
}

   include 'header.php'; ?>
<div id="content-bar">
	<div id="content" class="clash">
         <h1> Ik wil mee naar de Clash! </h1>
         
         <p> Op 15 februari staan wij in de Vorstin in Hilversum de sterren van de hemel te spelen. Hier moet jij natuurlijk bij zijn. Vul onderstaand formulier in, en reserveer alvast je kaarten. Inmiddels hebben wij dan ook het plan om een giga tourbus in te huren, zodat iedereen vanuit Delft en omstreken ook gewoon mee kan! Daarbij zorgen wij voor een gave lasershow en wat goede muziek om de reis een beetje in stijl te houden. </p>
         
         <p> De kaartjes gaan per twee en kosten samen &euro;15,-. Hieronder kan je aangeven met hoeveel mensen je komt. De kaartjes zullen waarschijnlijk een paar dagen tot een week voor tijd aan je overhandigt worden. Kan je echt niet wachten om ze in huis te hebben, dan kunnen we ze natuurlijk altijd nog opsturen!  </p>
         
         <p> <a href="http://www.theclashofthecoverbands.com/" target="_blank">Voor meer information over de Clash klik hier</a></p>
         <p> Nog even alles op een rijtje:
         <ul>
         	<li> De kaarten kosten &euro;15,- per 2 stuks</li>
            <li> Bij genoeg animo huren wij een gave tourbus, de 'HW-express', die jou (en ons) vanaf Delft naar Hilversum brengt.</li>
            <li> Naar verwachting komen er zo'n 500 mensen die avond!</li>
            <li> Dit wil je niet missen, <a href="http://www.youtube.com/watch?v=n9hfZ-XE36Q" target="_blank">kijk hier eens voor een voorproefje</a> </li>
        </ul>
        </p>
		<?php 
		// check if mail was processed
		if($mailed){
			// if there was mailed, check if everything went according to plan.    	       
            if(!$error) {
				// if so (everything went according to plan), say something nice
				?>
                <p ><strong>Je bericht is verstuurd. Je hoort zo spoedig mogelijk van!</strong></p>
                <?php		
            } else {
				// if not, at least let the person know
				?>
                <p class="error">Tijdens de verwerking van uw formulier is fout opgetreden. Probeert u het later nog eens, of stuur een e-mail naar <a href=\"mailto:info@homemadewater.nl\">info@homemadewater.nl</a></p>
            <?php
            }
        } ?>
		<div>
            <div id="Clash_pic" >
                <img src="./images/Clash_halveFinale.jpg" alt="Kom ons steunen bij de clash!" />
            </div>
              <!-- The contact form -->
            <form id="clash_form" enctype="multipart/form-data" onsubmit="return validateClash()" action="./Clash.php" method="post">
            	<h3> Ik wil mee!</h3>
                <p>Naam <br /><input type="text" name="name" <?= $error ?"value=\"$name\"" : NULL ?>  /> </p>
                <p>E-mail <br /><input type="text" name="email" <?= $error ?"value=\"$email\"" : NULL ?> /></p>
                <p>Telefoon (optioneel) <br /><input type="text" name="phone" <?= $error ?"value=\"$phone\"" : NULL ?>/> </p>
    
                <p> Aantal kaarten   <select name="kaarten"> 
                <?php 
                for ($i=2; $i<=40; $i+=2){
                ?>
                  <option value="<?=$i?>"> <?=$i?></option>
                <?php }
                ?>
                </select></p>
                <p> Wil je graag mee met de HW-express?<br/>
                    <input type="radio" name="ride" value="ja">Ja! <br />
                    <input type="radio" name="ride" value="nee">Nee, ik durf niet <br />
                    <input type="radio" name="ride" value="misschien">Weet ik niet <br />
                </p>
                <!--<p> Onderwerp <br /> <input type="text" name="subject"  /> </p>-->
                <p>Bericht en eventuele opmerkingen<br /><textarea name="bericht" rows="6" cols="30" <?= $error ?"value=\"$message\"" : NULL ?>></textarea></p>
                <p><label id="email-copy-label" class="copy mail" for="email-copy-checkbox">Kopie versturen naar uw eigen mail?</label> <input id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" checked="checked" /> </p>
                <p><input type="submit" value="Versturen" /><input type="reset" value="Wissen" /></p>
                
            </form>
        </div>
        

    </div> <!-- end div content -->
	<div id="sidebar-left"></div>
    <div id="sidebar-right"></div>
    

</div> <!-- end content-bar div -->

<?php include 'footer.html'; ?>	
<script type="text/javascript" src="./js/validate.js"></script>
</body>
</html>