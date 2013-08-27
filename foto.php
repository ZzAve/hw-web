<?php 
// state global variables and functions

// find all albums
$album_folder="images/albums/";
$all_albumfolders=array_reverse(glob($album_folder."*",GLOB_ONLYDIR)); // get all albumfolders and order them reversely (newest first)
//usort($all_albumfolders, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));

// put all albums in an array ('date' ; 'name' ; 'place' ; 'relative url')
$all_albums = array();
$all_albumnames = array();
foreach ($all_albumfolders as $album){
	$album = substr(strrchr($album,"/"),1);
	$newrow = array_map('trim',explode("!!",$album));
	$newrow[] = $album;
	$all_albumnames[] = $newrow[1];
	$all_albums[] = $newrow;
}


/*
* Function album_present() checks whether a GET request is send to this page, 
* concerning a photo album. If so it checks whether that photo albums exist. 
* If not, or no request was send, it returns NULL. If an album is present it 
* returns the name of the album.
*/
function album_present(){
	global $album_folder; // make use of variable $album_folder as instantiated globally
	global $all_albumnames;		// idem for $all_albums
	global $all_albums;
	
	// check wheter album is requested
	if(isset($_GET['album'])){ 
		//  if album is requested, than get its name
		$album=$_GET['album'];
			
		//check whether requested album exists on server and return this (true of false)
		$test = array_search($album,$all_albumnames);
		if($test !== FALSE){
			return $all_albums[$test];
		} else {
			return FALSE;
		}
	} else {
		// no album is selected. So return value false
		return FALSE;
	}
} // end function album_present


include 'header.php'; 
?>

<div id="content-bar">  
      <div id="content">
          <div id="gallery">
            <?php 
			$album_presence = album_present(); // return album name if album is requested AND exists, NULL otherwise
			if ($album_presence !== FALSE) {
				//echo "album \"".$album_presence."\" exists";
				$album_date = $album_presence[0];
				$album_name  = $album_presence[1];
				$album_place = $album_presence[2];
				$album_location =  $album_presence[3];
				?>
            	<h1> Fotoalbum:  </label> <?= $album_name?> </h1>
                <h2> Datum: <?= $album_date?> <br /> Plaats: <?= $album_place?> </h2>
                <div id="photolist-overflow">   
                    <div id="up"></div>
                    <div id="down"></div>
                    <div id="photolist">
                        <ul id="thumbs-one-album">
                            <?php //get all photo
                            $curdir=getcwd();
                            chdir($album_folder.$album_location);
                            $photolist = glob("*_thumb.jpg");
							natsort($photolist);
                            chdir($curdir);
							$photo1=NULL;
                            foreach ($photolist as $photo){
                                $length = strlen($photo);
                                $photo_descr = substr($photo,0,$length-10);
								if($photo1==NULL){
									$photo1 = str_replace(" ","%",$photo_descr);
								}
                                ?>
                                <li> <img src="<?=$album_folder.$album_location."/".$photo?>" alt="<?=$photo_descr?>" title="<?=$photo_descr?>"/> </li>	
                                <?php
                            }
                            ?>
                        </ul>
                   </div>
                 </div>
                 <div id="showPhoto"> <!-- div that can be used to "pop up" -->
                    <img src="<?=$album_folder.$album_location."/".$photo1.".jpg"?>" alt="De gevraagde foto is helaas niet beschikbaar, door een fout op de server. Deze fout wordt z.s.m. verholpen. Ons excuses voor het ongemak" title="Awesome foto"/>   
                    <span class="hidden"> Laden . . . </span>
                    <div id="nextPhoto"></div> <!-- make it a button later on with js -->
					<div id="previousPhoto"></div> <!-- make it a button later on with js -->
                    <div id="closePhotoAlbum"></div> <!-- make it a button later on with js -->
                </div> 
			
			<?php
			} else { 
				?>
                
                <!-- Say hi to people on the page -->
                <h1> Fotoalbums </h1>
                <h2> Om een beeld te krijgen van een feestje met Homemade Water! </h2>
                
                <ul id="album-list">
					<?php
                    // Show photo-albums in an unordered list (<ul> ... </ul>)
                    foreach ($all_albums as $album_array){
                        // show a thumbnail and description
						$album_date = $album_array[0];
                        $album_name  = $album_array[1];
						$album_place = $album_array[2];
						$album_location =  $album_array[3];
						?>
                      	<li> <a href="./foto.php?album=<?=$album_name?>"> 
                        		<img src="<?=$album_folder.$album_name?>.jpg" alt="<?=$album_name?>" title="<?=$album_name?>" />
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
            
         </div> <!-- end gallery div -->
     </div>
     
     <div id="sidebar-left"></div>
     <div id="sidebar-right"></div>   
</div> <!-- end content-bar -->


<?php include 'footer.html'; ?>


<!-- page specific scripts -->
<script type="text/javascript" src="http://localhost/hw-web/js/photoalbum.js"></script>
</body>
</html>


