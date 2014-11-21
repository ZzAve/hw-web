<?php
	$title="Band"; 
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/bandv1.css\" title=\"style\" />";
	require_once  'header.php'; 
	$fotolocation = "images/band/";
?>

<div id="content-bar">
	<div id="content" >
       <h1> Over de band</h1>
         <!--<a href="/images/homemade_water_wallpaper.jpg" title="De enige echte Homemade Water wallpaper." data-lightbox="HW";><img src="/images/homemade_water_wallpaper.jpg" alt="De enige echte Homemade Water wallpaper" /></a>
         <p> <a href="/images/homemade_water_wallpaper.jpg" download="Homemade Water Wallpaper" title="Homemade Water Wallpaper">Klik hier om hem te downloaden</a></p>-->

       	<img src="/images/homemade_water_wallpaper.jpg" title="De enige echte Homemade Water wallpaper" alt="De enige echte Homemade Water wallpaper"/>
        <h2>Homemade Water is een band waar je u tegen zegt!</h2>

	   	<p>Homemade Water heeft als doel om deze wereld te veroveren door de mensen te betoveren met muziek. En dat zie je terug in de optredens van deze band. Zonder afbreuk te doen aan de kwaliteit van de muziek wordt er een feestje gebouwd en vooral genoten. En als wij dat doen, dan is het te aanstekelijk om niet mee te doen!</p>

		<p>Na een beginperiode waar vooral veel is gecovered, is er inmiddels een tijd aangebroken waar vooral de creativiteit van de band geuit wordt door het schrijven van eigen nummers.</p>

		<p>Vanuit een speelgrage toetseniste en drummer is het idee gekomen om met als uitgangspunt kwaliteit muziek neer te zetten begonnen met Homemade Water. Binnen een paar maanden werden door middel van advertentie die verspreid waren over de campus van (voornamelijk) de TU Delft binnen een aantal maanden de volledige aanvulling voor de band gevonden.</p>

		<p>Homemade Water is in staat om op een leuk niveau muziek te maken. Dit is hetgeen wat er over hen gezegd werd tijdens hun deelname aan de Clash of the Coverbands (2013/2014):</p>
		<img class="col-25 right" src="/images/logo.jpg" title="Het Homemade Water logo" alt="Het Homemade Water logo"/>
		<p class="quote">"5-mans Pop coverband Homemade Water uit Delft is inmiddels uitgegroeid naar een band met een eigen geluid. De vijf topmuzikanten weten zowel oude als actuele nummers zo naar zich toe te trekken dat er een band op het podium staat met een eigen identiteit. Voeg daarbij het hoge niveau van zowel de muzikale inhoud alsook het entertainmentgehalte van de podiumpresentatie van de totale band en je hebt de coverband van de toekomst." Bron: <a href="http://www.theclashofthecoverbands.com/show/verslagen/item,712,Halve-Finale-Regio-West-2013-2014.html" target="_blank">Clash of the Cover bands</a></p>
		
        <p>en:</p>
		<p class="quote">"Vijf sterke muzikanten die met een goede bandchemie vooral eigentijds repertoire spelen, maar ook niet vies zijn van ouder materiaal; Maar dan wel met een Homemade Water-sausje overgoten."Bron: <a href="http://www.theclashofthecoverbands.com/show/verslagen/item,671,Voorronde-Regio-West-2013.html" target="_blank">Clash of the Cover bands</a></p>
         <hr class="clearfix" />
       <div id="leden">        
         <h3> De bandleden </h3>
         Maar wie is, of beter gezegd, zijn Homemade Water dan? Klik hieronder op een van de foto's om meer te weten te komen over de muzikanten.  
         <div>
         	<div class="col-20">
             	<label>Laurens</label><a href="#laurens"><img src="/images/band/laurens/HW_Clash_ronde3_14.jpg" alt="Laurens" /></a>
            </div>
            <div class="col-20">
             	<label>Eline</label><a href="#eline"><img src="/images/band/eline/HW_Clash_ronde3_17.jpg" alt="Eline" /></a>
            </div>
            <div class="col-20">
             	<label>Andrea</label><a href="#andrea"><img src="/images/band/andrea/HW_Reahus_29.jpg" alt="Andrea" /></a>
            </div>
            <div class="col-20">
             	<label>Moos</label><a href="#moos"><img src="/images/band/moos/HW_Clash_ronde3_13.jpg" alt="Moos" /></a>
            </div>
            <div class="col-20">
             	<label>Julius</label><a href="#julius"><img src="/images/band/julius/HW_Koornbeurs_heavy_11.jpg" alt="Julius" /></a>
            </div>
         </div>

            
         <!-- LAURENS -->
         <div id="laurens" class="noJS-show">
             <div class="col-40">
                <img src="/images/band/laurens/HW_Clash_ronde3_14.jpg" alt="Laurens" />
                <?=getPhotos("laurens/")?>
            </div>
            <div class="col-60">
                <h4>Laurens</h4>
                <p>Deze zingende mafkees weet met zijn kraakheldere stem op elk feestje zijn longen uit zijn lijf te zingen. En niet alleen dat, hij speelt ook nog gitaar, een beetje percussie en weet zijn microfoon om te bouwen tot drumstel.
                </p>
             </div>
         </div>
         
         <!-- ELINE -->
         <div id="eline" class="clearfix noJS-show">
            <div class="col-60 right-align">
               <h3>Eline</h3>
               <p></p>
         	</div>
            <div class="col-40">
               <img src="/images/band/eline/HW_Clash_ronde3_17.jpg" alt="Eline" />
               <?= getPhotos("eline/") ?>
         	</div>
			

         </div>
         
         <!-- ANDREA -->
         <div id="andrea" class="clearfix noJS-show">

            <div class="col-40">
                <img src="/images/band/andrea/HW_Reahus_29.jpg" alt="Andrea" />
				<?=getPhotos("andrea/")?>
            </div>   
    		<div class="col-60">
                <h3>Andrea</h3>
                <p>Virtuozer dan deze jongen kan het muzikaal gezien echt niet worden. Met een niet weg te krijgen lach weet Andrea elke noot op zijn prachtige gitaar te raken. En als de solo begint... "mama mia!"
                </p> 
            </div>
        </div>
        
         <!-- MOOS -->
         <div id="moos" class="clearfix noJS-show">
         	 <div class="col-60 right-align">
                <h3>Moos</h3>
                <ul>
                  <li><label>Naam:</label> Moos Meijer </li>
                  <li><label>Favoriete gerecht:</label>Vlees </li>
                </ul>
                <p> Deze meneer is samen met de drums het fundament van de band. Met zijn goed relatief gehoor, en zijn grote krullenbos weet hij een heerlijke basis neer te zetten voor de rest van de band. Hij swingt op een feestje je zo de pan uit! Een minpuntje: hij laat nogal vieze winden.
                </p>
            </div>
            <div class="col-40 ">
            	<img src="/images/band/moos/HW_Clash_ronde3_13.jpg" alt="Moos" />
            <?=getPhotos("moos/");?>
			</div>
           
         </div>
         <div id="julius" class="clearfix noJS-show">
         	<div class="col-40">
            <img src="/images/band/julius/HW_Koornbeurs_heavy_11.jpg"/>
            <?=getPhotos("julius/");?>
			</div>
            <div class="col-60">
                <h3>Julius</h3>
                <ul>
                  <li><label>Naam:</label> Julius van Dis</li>
                  <li><label>Favoriete gerecht:</label>Boerenkool met worst</li>
                </ul>
                <p>
                Smeuige beats met een passie voor dynamiek omschrijft het beste de stijl van deze drummer. Met deze man achter zijn glimmende en glinsterende drumkit is er in ieder geval altijd een goede ritmesectie aanwezig om die voetjes van de vloer te krijgen.
                </p>
            </div>
           
            
        </div>
      </div><!--eind leden -->
		
    </div>
</div> <!-- end content-bar div -->

<?php require_once 'footer.php'; ?>	
<script type="text/javascript" src="/js/lightbox.min.js"></script>
<script type="text/javascript" src="/js/band.js"></script>
</body>
</html>


<?php  
	function getPhotos($spec_folder){
		global $fotolocation;
		// List all files in the image folder
		$folder=$fotolocation.$spec_folder;
	?>	<ul class="previews">
<?php	 //get all photos
		 $curdir=getcwd();
		 chdir($folder);
		 $photolist = glob("*.jpg");
		 chdir($curdir);
		 foreach($photolist as $photo){
?>
    	  <li class="col-20 loading img noJS-hide"><?= $folder.$photo ?></li>	
<?php
	 	}
?>
       </ul>	
<?php   
	} 
?>