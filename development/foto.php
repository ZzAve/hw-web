<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Photo page</title>
<!-- standard style and javascript -->
<link rel="stylesheet" type="text/css" href="style/main.css" title="style" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

<!-- page specific style and javascript -->
<link rel="stylesheet" type="text/css" href="style/foto.css" title="style" />
<script type="text/javascript" src="js/photoalbum.js"></script>
</head>

<body>

<!-- include the header of the page -->
<?php include 'header.html'; ?>

  <div id="middle">
  
      <div id="gallery">
        <div id="showPhoto"> <!-- div starts out empty, but get filled when clicked on image -->
        <img src="./images/album_alpha/Gig_Plankenkoorts_25042013_14.jpg" title="Awesome foto"/>   
        </div>
        
        <!-- the list with all the thumbnails -->
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
            
                    // loop through the list of files and do something with it
                    foreach( $itemlist as $file){ 
                        ?> 
                        <li> <img id="<?=$file?>" src="<?=$newdir.$file?>" alt="<?=$file?>" onclick="imageClick(this)"/></li>
                    <?php
                    }
                    chdir($curdir); // return to the old(/starting) directory
                    
                ?>	
                </ul>    
            </div> <!-- end thumbs-box-overflow -->
            <div id="prev"></div>
            <div id="next"></div>	
       </div> <!-- end thumbs-box div -->
        
     </div> <!-- end gallery div -->
 </div>


<?php include 'footer.html'; ?>


</body>
</html>