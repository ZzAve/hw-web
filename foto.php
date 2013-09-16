<?php
	require_once 'misc/db_connectread.php';
	$request=false;
	$valid_request=false;   
	
	if(isset($_GET['album'])){
		$request=true;
		$albumid=$_GET['album'];
		
		//check if album exists
		$query = "SELECT * FROM `fotoalbums` WHERE `ID`=$albumid;";
		$result = mysqli_query($mysql,$query);
		$row = mysqli_fetch_array($result);
		
		if (isset($row['ID']) && $row['ID']!="" ) {
			// now a special album is requested
			$valid_request=$row;
		}
	}

	//Set a facebook image
	$fb_img = $valid_request!==false ? $valid_request['Foto'] :"";	
	
	//Set a title for the page
	$pre_title=$valid_request!==false ? $valid_request['Titel']." - " : "";
	$title= $pre_title."Foto's";   
   	
	// Import header
	require_once 'header.php'; 7
?>

<div id="content-bar">  
      <div id="content">		
<?php  // There are to options to show:
       //   1. Show a specific item
       //   2. Show a part of the newsitems

	 if($valid_request!==false){
             // an album is requested
      	     $album_id=$row['ID'];
      	     $album_name = $row['Titel'];
      	     $album_date = $row['Datum'];
      	     $album_place = $row['Locatie'];
      	     $album_location = $row['Fotofolder'];
      	     $album_descr = $row['Omschrijving'];
?>
            <a href="foto.php"> Terug naar het album overzicht</a>            	
            <h1> Fotoalbum:  <label><?= $album_name?></label> </h1>
            <div id="sharediv">                
                <ul>
                    <li class="fblike"> 
                        <script> 
                            //<![CDATA[
                            document.write('<fb:like href="http://www.homemadewater.nl/foto.php?album=<?=$album_id?>" width="200" layout="button_count" show_faces="false" send="false"></fb:like>');
                            //]]>
                        </script> 
                    </li>
                    <li> 
                        <a href="#"  onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),'facebook-share-dialog','width=626,height=436');return false;">
                            Deel op Facebook</a>
                    </li>
                    <li> <div class="g-plusone" data-annotation="inline" data-width="200"></div></li>
                    <li> 
                        <a href="https://twitter.com/share" data-text="Wat een tof fotoalbum van dat optreden van Homemade Water" class="twitter-share-button" data-lang="nl">Tweeten</a>
                    </li>
                </ul>
            </div><!-- end 	share div -->
			
            <h2> Datum: <?= $album_date ?></h2>
            <h2> Plaats: <?= $album_place ?> </h2>		
            <p class="album_descr"> <?=$album_descr?></p>
	
            <div id="thumblist">
              <ul>
<?php		    //get all photos
				$curdir=getcwd();
				chdir($album_location);
				$photolist = glob("*_thumb.jpg");
				natsort($photolist);
				chdir($curdir);
				foreach($photolist as $photo){
				  putPhotoThumb($photo,$album_location,$album_name);
				}
?>
              </ul>	
            </div>
			
            <div class="fb_comment">
              <script>
                //<![CDATA[
                document.write('<fb:comments href="http://www.homemadewater.nl//foto.php?album=<?=$album_id?>" colorscheme="dark" width="600"></fb:comments>')
                //]]>
              </script>
            </div>
			
<?php // END OF SHOWING ONE ALBUM ! ! 
	 } else { 
		    // the overview is requested
			
			if($request){//show error (through an javascript alert?)
?>				<script> 
					setTimeout(function(){alert('Helaas is het door u opgegeven nieuwsbericht niet meer beschikbaar of heeft het nooit bestaan.\n\nDesalniettemin hebben wij voor u de meest recente nieuwsbericht voor u op een rijtje gezet.');},800);
                </script>
<?php		}
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
                      	<li> 
                          <a href="foto.php?album=<?=$album_id?>"> 
                            <img src="<?=$album_thumb?>" alt="<?=$album_name?>" title="<?=$album_name?>" />
                          </a> 
                          <label> <?= $album_date?> </label>	<?=$album_name?> <span> <?=$album_place?> </span>
                        </li>
<?php             } 
?>
				</ul> <!--  end thumbnail list of photo albums -->
                
<?php  } // end if else (show ONE albums, or albumlist)
?>
     </div> <!-- end content div -->	   
     <div id="sidebar-left"></div>
     <div id="sidebar-right"></div>   
</div> <!-- end content-bar -->

<?php require_once 'footer.php'; ?>

<!-- ||| page specific scripts ||| -->
	<!-- javascript for the photoalbums -->
	<script type="text/javascript" src="js/photoalbum.js"></script>
    
    <!-- lightbox -->
    <script type="text/javascript" src="js/lightbox-2.6.min.js"></script>
    
    <!-- google plus script -->
    <script type="text/javascript">
      window.___gcfg = {lang: 'nl'};
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    
    <!-- twitter script -->
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!-- ||| end page specific scripts ||| -->	
</body>
</html>

<?php	
	$counter=1;
	function putPhotoThumb($current,$aLocation,$aName){
		global $counter;
?>
                <li id="<?=str_replace("_thumb.jpg","",$current)?>"> 
                    <a href="<?=$aLocation."/".str_replace("_thumb","",$current)?>" data-lightbox="photo-album" title="<?=$aName?>"/> 
                      <img src="<?=$aLocation."/".$current?>"/> <!-- show thumbnail --> 
                    </a>
                </li>	
<?php
   }
?>