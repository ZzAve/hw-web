<?php	
	function putPhotoThumb($previous,$current,$next,$aLocation,$aName){
		?>
		<li id="<?=str_replace("_thumb.jpg","",$current)?>"> 
		  <img src="<?=$aLocation."/".$current?>"/> 
		  <!-- alt="<?=$aName?>" title="<?=$aName?>" --> 
		  <span class="hidden prevImage"><?= $previous?></span>
		  <span class="hidden nextImage"><?= $next?></span>
	   </li>	
       <?php
   }
   
   
   	require_once 'header.php'; 
	require_once 'misc/db_connectread.php';
?>

<div id="content-bar">  
      <div id="content">

            <?php 
			$special=FALSE;
			if(isset($_GET['album'])){
				$albumid=$_GET['album'];
				
				//check if album exists
				$query = "SELECT * FROM `fotoalbums` WHERE `ID`=$albumid;";
				$result = mysqli_query($mysql,$query);
				$row = mysqli_fetch_array($result);
				
				if (isset($row['ID']) ) {
					// now a special album is requested
					$special=TRUE;
					
					$album_id=$row['ID'];
					$album_name = $row['Titel'];
					$album_date = $row['Datum'];
					$album_place = $row['Locatie'];
					$album_location = $row['Fotofolder'];
					$album_descr = $row['Omschrijving'];
					
					?>
					<a href="foto.php"> Terug naar het album overzicht</a>            	

               		<h1> Fotoalbum:  </label> <?= $album_name?> </h1>
               	 	<div id="sharediv">                
                        <ul>
                        
                            <li class="fblike"> 
                                <script> 
									document.write('<fb:like href="http://www.homemadewater.nl/foto.php?album=<?=$album_id?>" width="200" layout="button_count" show_faces="false" send="false"></fb:like>')
                                </script> 
                            </li>
                            <li> 
                                <a href="#"  onclick="window.open(
                                'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
                                    'facebook-share-dialog', 
                                    'width=626,height=436'); 
                                    return false;">
                                    Deel op Facebook</a>
                            </li>
                            <li> <div class="g-plusone" data-annotation="inline" data-width="200"></div></li>
                            <li> 
                                <a href="https://twitter.com/share" data-text="Wat een tof fotoalbum van dat optreden van Homemade Water" class="twitter-share-button" data-lang="nl">
                                    Tweeten
                                </a>
                            </li>
                        </ul>
                    </div><!-- end 	share div -->
                    
                    <h2> Datum: <?= $album_date?> <br /> Plaats: <?= $album_place?> </h2>		
                    <p class="album_descr"> <?=$album_descr?></p>
    
                    <div id="thumblist">
                        <ul>
                            <?php //get all photo
                              $curdir=getcwd();
                              chdir($album_location);
                              $photolist = glob("*_thumb.jpg");
                              natsort($photolist);
                              chdir($curdir);
                              $firstdone=false;
							  $prevPhoto = "";
							  $curPhoto = "";
							  $nextPhoto = "";
							  foreach($photolist as $photo){
								  $prevPhoto = $curPhoto;
								  $curPhoto = $nextPhoto;
								  $nextPhoto = $photo;
                                  if (!$firstdone) {
									  $firstdone=true;
								  } else {
									  putPhotoThumb($prevPhoto,$curPhoto,$nextPhoto,$album_location,$album_name);
								  }
                              }

                           putPhotoThumb($curPhoto,$nextPhoto,"",$album_location,$album_name);
						   ?>
                        </ul>	
                    </div>
                    
                    <div class="fb_comment">
                        <script>
                            document.write('<fb:comments href="http://www.homemadewater.nl//foto.php?album=<?=$album_id?>" colorscheme="dark" width="600"></fb:comments>')
                        </script>
                    </div>
					
					<?php
				}
			} // end check for special album
			
			
			
			if (!$special){
				//no special album is requested, so give all.	
			
				?>
                
                <h1> Fotoalbums </h1>
                <h2> Om een beeld te krijgen van een feestje met Homemade Water! </h2>
                
                <ul id="album-list">
					<?php
                    // Show photo-albums in an unordered list (<ul> ... </ul>)
					$query= "SELECT * FROM `fotoalbums`  WHERE 1 ORDER BY `Datum` DESC;";
					$result = mysqli_query($mysql,$query);
                    while ($row = mysqli_fetch_array($result)){
                        // show a thumbnail and description
						$album_id = $row['ID'];
						$album_date = $row['Datum'];
                        $album_name  = $row['Titel'];
						$album_place = $row['Locatie'];
						$album_location =  $row['Fotofolder'];
						$album_thumb = $row['Thumbnail'];
						?>
                      	<li> <a href="foto.php?album=<?=$album_id?>"> 
                        		<img src="<?=$album_thumb?>" alt="<?=$album_name?>" title="<?=$album_name?>" />
                             </a> 
							 <label> <?= $album_date?> </label>	<?=$album_name?> <span> <?=$album_place?> </span>
                        </li>
                    <?php
                    } 
				?>
				</ul> <!--  end thumbnail list of photo albums -->
                <?php
			} // end if else (show ONE albums, or albumlist)
			?>
            

     </div>
     
     <div id="sidebar-left"></div>
     <div id="sidebar-right"></div>   
</div> <!-- end content-bar -->

<div id="showPhoto" class="hidden"> <!-- div that can be used to "pop up" -->
    <div id="photosite">
       	<img class="show" src="" alt="De gevraagde foto is helaas niet beschikbaar, door een fout op de server. Deze fout wordt z.s.m. verholpen. Ons excuses voor het ongemak" title="Awesome foto" />
		<span class="hidden"> Laden . . . </span>
        <div>
        	<div id="nextPhoto"> <a href="#">Volgende foto</a></div>
            <div id="previousPhoto"><a href="#">Vorige foto </a></div> 
            <div id="closePhotoAlbum" ><img src="images/close_button.png" alt="Close" title="Close" /></div>
		</div>
   </div>
</div> 

<?php require_once 'footer.php'; ?>

<!-- page specific scripts -->
<script type="text/javascript" src="js/photoalbum.js"></script>

<!-- te verwerken scripts -->
<script type="text/javascript">
  window.___gcfg = {lang: 'nl'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</body>
</html>

