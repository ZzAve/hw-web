<?php 
	require_once 'misc/miscfunctions.php';
	$title= "Media";
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/foto.css\" title=\"style\" />\n 
			  <link rel=\"stylesheet\" type=\"text/css\" href=\"/style/video1.css\" title=\"style\" />\n
			  <style type=\"text/css\">@charset utf-8;
				#audioList{height:auto}
				#audioList iframe{height:166px;margin-bottom:5px;margin-top:5px;width:100%}
				div h3 a{text-decoration:none}
			  </style>";
	require_once 'header.php'; 
?>	

<div id="content-bar">
    <div id="content">
        <h1> Media</h1>
        <h2> Waar Homemade Water tot leven komt</h2>
        <hr />
        <div id="foto">
            <h3><a href="/foto.php"> De laatste foto's:</a></h3>
            <ul id="album-list">                
<?php
            // Show photo-albums in an unordered list (<ul> ... </ul>)
			$query= "SELECT * FROM `fotoalbums`  WHERE 1 ORDER BY `Datum` DESC LIMIT 0,4;";
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
               <li class="col-25"> 
                 <a href="/foto.php?album=<?=$album_id?>"> 
                 <img src="<?="/".$album_thumb?>" alt="<?=$album_name?>" title="<?=$album_name?>" />
                 </a> 
                 <label> <?= $album_date?> </label>	<?=$album_name?> <span> <?=$album_place?> </span>
               </li>
<?php      } 
?>

	        </ul> <!--  end thumbnail list of photo albums -->
            <div class="clearfix navigate more">
                <form action="/foto.php" method="post">
                    <button> Meer foto's</button>
                </form>
            </div>            
        </div>
        <hr />
        
        <div id="video">
        	<h3><a href="/video.php">Video's</a></h3>
            <div id="showVideo" class="JS-hide">
           		<div class="iframe">
                     <a class="iframeYT" href="http://www.youtube.com/embed/CFnpnFr-oW4?wmode=transparent"></a>
    			</div>
                <div class="description">
                    <div class="date">
                       
                    </div>
                    <div class="info"> <!-- rest -->
                    <h3> </h3>
                    <p><!-- to be filled with info of playing item--> </p>
                    </div>
               </div>
           </div>
           
           <div id="videoList">
           		<ul>
<?php
				$query = "SELECT * FROM `videos` ORDER BY `Datum` DESC LIMIT 0,3;";
				$result = mysqli_query($mysql,$query);
				while( $row = mysqli_fetch_array($result) )  {
				  popVideoItem($row);
				}   
?>
               </ul>
           </div> <!-- end videoList div -->
   			            <div class="navigate more">
                <form action="/video.php" method="post">
                    <button> Meer video's</button>
                </form>
            </div>            
        </div>
        <hr />
        <div id="audioList">
        	<h3><a href="/audio.php">Audio</a></h3>
            <div class="audioitem item">
                <h3> Eerste demomix van Homemadewater </h3>
                <!-- First demo -->
                <a class="iframeSC" href="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F79363524&amp;color=1f78c7&amp;auto_play=false&amp;show_artwork=true"></a>
                <p> In januari 2013 heeft Homemade Water binnen korte tijd haar eerste demomix mogen opnemen op het Cultuurcentrum van de TU Delft. Dit nummer geeft een goede impressie van hetgeen wat er van de band verwacht kan worden tijdens optredens. De nummers die voorbij komen zijn achtereenvolgens: </p>
                <ul>
                    <li>Dance with somebody - Mando Diao,</li>
                    <li> I'm just me - Homemade Water,</li>
                    <li> I shot the sheriff - Eric Clapton, en</li>
                    <li> Seven Nation Army - The White Stripes </li>
                </ul> 
            </div>
            <div class="navigate more">
                <form action="/audio.php" method="post">
                    <button> Meer audio</button>
                </form>
            </div>            
        </div>
           
            
    </div> <!-- end div content -->
 
</div> <!-- end content-bar -->
<?php require_once 'footer.php' ?>
<!-- page specific scripts -->
<script type="text/javascript" src="/js/video.js"></script>

</body>
</html>

<?php
/* function POPVIDEOITEM creates a <div> entry for one single newsitem. 
//	input:
//		$db_entry   a database entry with the video, coming from the 'videos' table of the 'juliuqb30_hw' database.
//  output:
// 		$ one <li> with the video item as requested
//  returns nothing
*/

function popVideoItem($dbEntry){
	$date = explode("-",$dbEntry['Datum']);
	$id = $dbEntry['ytID'];
	$imgLoc1= "http://img.youtube.com/vi/";
	$imgLoc2= "/hqdefault.jpg";
?>
   <li class="col-33"><span class="nodisp"><?=$id?></span>
   	  
      <img src="<?=$imgLoc1.$id.$imgLoc2?>" alt="<?= $dbEntry['Titel']?>" title="<?= $dbEntry['Titel']?>"  />
      <div class="playbutton"> <img src="http://www.clker.com/cliparts/L/y/p/N/e/L/play-button-red-th.png" alt="" title=""/> <!-- tahnks to Clker.com --></div>
       <div class="date">
        <label> <?= array_pop($date)?> </label>
        <span> <?= strtoupper(strftime("%b",mktime(0, 0, 0, array_pop($date) ) ) )?> </span>
       </div>
       <h4> <?= $dbEntry['Titel']?></h4>          
       <p class="nodisp"> <?=$dbEntry['Omschrijving']?></p>
   </li>
<?php
}

?>