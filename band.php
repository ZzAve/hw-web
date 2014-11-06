<?php
	$title="Band"; 
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/bandv1.css\" title=\"style\" />";
	require_once  'header.php'; 
	$fotolocation = "images/band/";
?>

<div id="content-bar">
	<div id="content" >
         <h1> Over de band</h1>
         <a href="/images/homemade_water_wallpaper.jpg" title="De enige echte Homemade Water wallpaper." data-lightbox="HW";><img src="/images/homemade_water_wallpaper.jpg" alt="De enige echte Homemade Water wallpaper" /></a>
         <p> <a href="/images/homemade_water_wallpaper.jpg" download="Homemade Water Wallpaper" title="Homemade Water Wallpaper">Klik hier om hem te downloaden</a></p>
		 <p>Homemade water is de leukste band die er maar is. Iets leukers is er niet! <i> Hier wordt wat gezegd over wat Homemade Water kan en doet, en hoe tof een feestje is met HW</i></p>
         <hr />
         <h3> Het begin </h3>
         <p> Het begon allemaal lang lang geleden, in een land hier ver ver vandaan</p>         
                  <hr />
         <h3> Het ultieme doel</h3>
         <p> blaat!</p>         
         
         <hr />
         
       <div id="leden">        
         <h3> De bandleden </h3>
         klik op een van de foto's om meer te weten te komen over de verschillende bandleden!
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
         <div id="laurens" class="hiddenWell">
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
         <div id="eline" class="clearfix hiddenWell">
            <div class="col-60 right">
               <h3>Eline</h3>
               <p></p>
         	</div>
            <div class="col-40">
               <img src="/images/band/eline/HW_Clash_ronde3_17.jpg" alt="Eline" />
               <?= getPhotos("eline/") ?>
         	</div>
			

         </div>
         
         <!-- ANDREA -->
         <div id="andrea" class="clearfix hiddenWell">

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
         <div id="moos" class="clearfix hiddenWell">
         	 <div class="col-60 right">
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
         <div id="julius" class="clearfix hiddenWell">
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
    	  <li class="col-20 loading img"><?= $folder.$photo ?></li>	
<?php
	 	}
?>
       </ul>	
<?php   
	} 
?>