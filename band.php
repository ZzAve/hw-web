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
         <img src="/images/band/photo-2.jpg" alt="help" />
         
        <!-- <h4> <span class="bandmember" id="laurens"></span>Laurens Mensink </h4>
         <h4> <span class="bandmember" id="andrea"></span>Andrea Forzoni </h4>
         <h4> <span class="bandmember" id="eline"></span>Eline Burger </h4>
         <h4> <span class="bandmember" id="moos"></span>Moos Meijer </h4>
         <h4> <span class="bandmember" id="julius"></span>Julius van Dis </h4>
         -->
                  <hr />
       <div id="leden">        
         <h3> De bandleden </h3>
         <div class="col-33">
         	<a href="https://dl.dropboxusercontent.com/s/lg3y7hkf6h5aeva/HW_Clash_ronde3_14.jpg?dl=0" title="Laurens" data-lightbox="Homemade-leden">
            	<img src="https://dl.dropboxusercontent.com/s/lg3y7hkf6h5aeva/HW_Clash_ronde3_14.jpg?dl=0" alt="Laurens" />
            </a>
            <h4>Laurens</h4>
            <p>Deze zingende mafkees weet met zijn kraakheldere stem op elk feestje zijn longen uit zijn lijf te zingen. En niet alleen dat, hij speelt ook nog gitaar, een beetje percussie en weet zijn microfoon om te bouwen tot drumstel.
            </p>
         </div>
         <div class="col-33">
             <a href="https://dl.dropboxusercontent.com/s/kefxezugjpcwnv2/HW_Clash_ronde3_17.jpg?dl=0" title="Eline" data-lightbox="Homemade-leden"> 
                <img src="https://dl.dropboxusercontent.com/s/kefxezugjpcwnv2/HW_Clash_ronde3_17.jpg?dl=0" alt="Eline" />
             </a>
         	<h3>Eline</h3>
            <p>
            </p>
         </div>
         <div class="col-33">
         	<a href="https://dl.dropboxusercontent.com/s/yyanwm41qfgf1ei/HW_Reahus_29.jpg?dl=0" title="Andrea" data-lightbox="Homemade-leden"> 
            	<img src="https://dl.dropboxusercontent.com/s/yyanwm41qfgf1ei/HW_Reahus_29.jpg?dl=0" alt="Andrea" />
            </a>
            <h3>Andrea</h3>
            <p>Virtuozer dan deze jongen kan het muzikaal gezien echt niet worden. Met een niet weg te krijgen lach weet Andrea elke noot op zijn prachtige gitaar te raken. En als de solo begint... "mama mia!"
            </p>
        </div>
         <hr class="clearfix" style="margin:10px auto"/>
		 <!-- MOOS -->
         <div class="clearfix">
         	<div class="col-40">
            	<img src="https://dl.dropboxusercontent.com/s/esmaplornlkugga/HW_Clash_ronde3_13.jpg?dl=0" alt="Moos" />
            <?=getPhotos("moos/");?>
			</div>
            <div class="col-60">
                <h3>Moos</h3>
                <ul>
                  <li><label>Naam:</label> Moos Meijer </li>
                  <li><label>Favoriete gerecht:</label>Vlees </li>
                </ul>
                <p> Deze meneer is samen met de drums het fundament van de band. Met zijn goed relatief gehoor, en zijn grote krullenbos weet hij een heerlijke basis neer te zetten voor de rest van de band. Hij swingt op een feestje je zo de pan uit! Een minpuntje: hij laat nogal vieze winden.
                </p>
            </div>
         </div>
         <div class="clearfix">
          	<div class="col-60 right">
                <h3>Julius</h3>
                <ul>
                  <li><label>Naam:</label> Julius van Dis</li>
                  <li><label>Favoriete gerecht:</label>Boerenkool met worst</li>
                </ul>
                <p>
                Smeuige beats met een passie voor dynamiek omschrijft het beste de stijl van deze drummer. Met deze man achter zijn glimmende en glinsterende drumkit is er in ieder geval altijd een goede ritmesectie aanwezig om die voetjes van de vloer te krijgen.
                </p>
            </div>
         	<div class="col-40"><a href="https://dl.dropboxusercontent.com/s/eh22j3yu7ciqc4g/HW_Koornbeurs_heavy_11.jpg?dl=0" title="Julius" data-lightbox="leden"> 
         		<img src="https://dl.dropboxusercontent.com/s/eh22j3yu7ciqc4g/HW_Koornbeurs_heavy_11.jpg?dl=0" alt="Julius" />
            </a></div>
           
            
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
    	  <li class="col-20 loading hidden"><?= $folder.$photo ?></li>	
<?php
	 	}
?>
       </ul>	
<?php   
	} 
?>