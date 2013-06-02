<?php // state global variables and functions
$album_folder="images/albums/";
$all_albums=glob($album_folder."*",GLOB_ONLYDIR);

/*
* Function album_present() checks whether a GET request is send to this page, concerning a photo album. If so it checks whether that photo albums exist. If not, or no request was send, it returns NULL. If an album is present it returns the name of the album.
*/
function album_present(){
	global $album_folder; // make use of variable $album_folder as instantiated globally
	global $all_albums;		// idem for $all_albums
	
	// check wheter album is requested
	if(isset($_GET['album'])){ 
		//  if album is requested, than get its name
		$album=$_GET['album'];
			
		//check whether requested album exists on server and return this (true of false)
		if(in_array($album_folder.$album,$all_albums)){
			return $album;
		} else {
			return NULL;
		}
	} else {
		// no album is selected. So return value false
		return NULL;
	}
} // end function album_present

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Photo page</title>
<!-- standard style and javascript -->
<link rel="stylesheet" type="text/css" href="style/main.css" title="style" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!-- page specific style and javascript -->
<link rel="stylesheet" type="text/css" href="style/foto.css" title="style" />
<script type="text/javascript" src="js/photoalbum.js"></script>
</head>

<body>
<!-- include the header of the page -->
<?php include 'header.html'; ?>
<div id="content-bar">  
      <div id="content">
      
          <div id="gallery">
          	<!-- two possibilities:
          		1. Show albums (if no album selected)
                2. Show selected album 
            -->
            <!-- check whether album is selected AND whether this album exists!
            -->
            <?php 
			$album_presence = album_present();
			if ($album_presence != NULL) {
				echo "album \"".$album_presence."\" exists";
				?>
            	<div id="showPhoto"> <!-- div that can be used to "pop up" -->
                    <img src="./images/album_alpha/Gig_Plankenkoorts_25042013_14.jpg" title="Awesome foto"/>   
                    <div id="nextPhoto"></div> <!-- make it a button later on with js -->
					<div id="previousPhoto"></div> <!-- make it a button later on with js -->
                    <div id="closePhotoAlbum"></div> <!-- make it a button later on with js -->
                </div>
                    
				<div id="photolist">
                	<ul id="thumbs-one-album">
						<?php //get all photo
                        $curdir=getcwd();
                        chdir($album_folder.$album_presence);
                        $photolist = glob("*_thumb.jpg");
						print_r($photolist);
                        chdir($curdir);
                        foreach ($photolist as $photo){
							$length = strlen($photo);
                            $photo_descr = substr($photo,0,$length-10);
                            ?>
                            <li> <img src="<?=$album_folder.$album_presence."/".$photo?>" alt="<?=$photo_descr?>"/> foto_description of <?=$photo_descr?> </li>	
                            <?php
                        }
                        ?>
                	</ul>
                </div>
			
			<?php
			}else { 
				echo "album does not exist";
				?>
                
                <!-- Say hi to people on the page -->
                <h1> De foto pagina </h1>
                <h3> De plek waarop je kan zien hoe Homemade Water haar feestje bouwt </h3>
                
                <ul id="album-list">
					<?php
                    // Show photo-albums in an unordered list (<ul> ... </ul>)
                    foreach ($all_albums as $photo_album){
                        // show a thumbnail and description
                        $album_name  = substr(strrchr($photo_album,"/"),1);
						//$album_name = substr($photo_album,0,$index);
						?>
                      	
                        <li> <img src="<?=$photo_album?>_thumb.jpg" alt="<?=$photo_album ?>" title="<?=$photo_album ?>" /> <?=$album_name?> </li>	
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

</body>
</html>


<!-- old code for album -->
<!-- the list with all the thumbnails
<div id="thumbs-box">
    <div id="thumbs-box-overflow">
        <ul id="thumbs">
        <?php 	
            // get all photos of a certain album and put those into listitems
            $newdir="images/album_alpha/";
            $curdir=getcwd(); //get current directory
            chdir($newdir); // make folder with images the current directory
            $itemlist = glob("*_thumb.jpg"); // get all jpg files of the current folder
            natsort($itemlist); // sort the items as 1 2 10 20, instead of 1 10 2 20
            chdir($curdir); // return to the old(/starting) directory    
            // loop through the list of files and do something with it
            foreach( $itemlist as $file){ 
                ?> 
                <li> <img id="<?=$file?>" src="<?=$newdir.$file?>" alt="<?=$file?>" onclick="imageClick(this)"/></li>
            <?php
            }

            
        ?>	
        </ul>    
    </div> <!-- end thumbs-box-overflow 
    <div id="prev"></div>
    <div id="next"></div>	
</div> <!-- end thumbs-box div -->
<!-- end old code for album -->