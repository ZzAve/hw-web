<?php 
	// It is assumed that variable $start is known! If not, random values are taken.
	// This file is used by the nieuws.php file. 
	if (!isset($start)){
		$start=15;
	}
	if (!isset($top)){
		$top = 20;
	}
?>
<!-- Allow visitor to see more news -->
<div class="morenews">
    <span>
    <?php 
        if($start<$top){
            // show previous with link
            ?>
            <a href="<?= "nieuws.php?startat=".($start+5)?>" >Vorige pagina </a>
            <?php
        } else { // show without link
            ?> Vorige pagina
        <?php } ?>
    </span>					                
    <span>
    <?php   
        if($start>10+4){
            //show next with link
            ?>
             <a href="<?= "nieuws.php?startat=".($start-5)?>" >Volgende pagina </a>
            <?php
        } else{ //show without link 
        ?> Volgende pagina
        <?php } ?>
    </span>
</div>       