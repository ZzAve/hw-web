<?php 
	$error=false;
	require_once 'header.php'; 
	require_once 'misc/db_connectread.php';
	setlocale(LC_TIME, 'Dutch');
?>

<div id="content-bar">
	<div id="content">
         <h1> Gastenboek </h1>
      	
         <h3> Plaats hier je bericht </h3>
         <!-- The contact form -->
        <form id="guestbook" enctype="multipart/form-data" onsubmit="return validate()" action="./contact.php" method="post">
            <p class="required">
            	<span>Naam </span>
                <input type="text" name="name" <?= $error ?"value=\"$name\"" : NULL ?>  /> 
            </p>
            <p>
            	<span>E-mail </span> 
                <input type="text" name="email" <?= $error ?"value=\"$email\"" : NULL ?> />
            </p>
            <br />
            <p>
            	<span>Bericht </span> 
                <textarea name="bericht" rows="3" cols="30" <?= $error ?"value=\"$message\"" : NULL ?>></textarea>
            </p>
            <br />
            <p>
            	<input type="submit" value="Versturen" /><input type="reset" value="Wissen" />
            	<label id="email-copy-label" class="copy mail" for="email-copy-checkbox">Kopie versturen naar uw eigen mail?</label> 
                <input id="email-copy-checkbox" type="checkbox" name="checkbox-send-copy" <?= $error ? $copy_mail : "checked=\"checked\"" ?> /> 
            </p>
        </form>
            
         <div id="posts">
         	<h3> Recente berichten</h3>
         	<!-- most recent post -->
<?php
			$lastpost=-1;
			$start="";
			if($lastpost!=-1){
				$start = "WHERE `ID`<=$start";
			}
            $query = "SELECT * FROM `gastenboek` $start ORDER BY `Datum` DESC LIMIT 10;";
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
</body>
</html>

<?php

function popgastItem($db_item){
	$passedtime = (time() - strtotime($db_item['Datum']) )/86400;
	if ($passedtime<1){
		if ($passedtime*24 < 1){
			$time = round($passedtime*24*60)." minuten";
		} else {
			$time = round($passedtime*24)." uur";
		}
	} else {
		$time = round($passedtime)." dagen";
	}
?>
	<div class="gastItem"> 
    	<p class="head"><label> <?= $db_item['Naam']?></label> (<?= $time?> geleden)</p>
        <p><?= $db_item['Bericht']?></p>
    </div>
<?php	
}
?>