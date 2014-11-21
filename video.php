<?php 
	$title = "Video";
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/video1.css\" title=\"style\" />";
	require_once 'header.php';
	require_once 'misc/miscfunctions.php';
	//Set up connection
	db_connect(0);
?>
<div id="content-bar">
    <div id="content">   
           <h1> De afdeling beeld en geluid </h1> 
           <h2> Kijk hier nog eens terug naar de beelden van Homemade Water, en wellicht spot je jezelf wel!</h2>
           <div id="showVideo">
           		<div class="iframe">
                     <a class="iframeYT" href="http://www.youtube.com/embed/CFnpnFr-oW4?wmode=transparent"></a>
    			</div>
                <div class="description">
                    <div class="date">
                        <label> 05 </label>
                        <span> JUL </span>
                    </div>
                    <div class="info"> <!-- rest -->
                    <h3> I'm Just Me - Live @ Dorpsfeest Re&acirc;hus, Friesland</h3>
                    
                    <p> Het buitenlandse debuut van Homemade Water is ook te zien op YouTube. Het eigen nummer "I'm Just Me" werd hier gespeeld voor de uitzinnige bewoners van Re&acirc;hus. <br /><br />Credits voor de video gaan naar Arnold Burger.</p>
                    </div>
               </div>
           </div>
           
           <div id="videoList">
           		<h4> Video's van Homemade Water:</h4>
           		<ul>
<?php
				$query = "SELECT * FROM `videos` ORDER BY `Datum` DESC;";
				$result = mysqli_query($mysql,$query);
				$count=0;
				while( $row = mysqli_fetch_array($result) )  {
				  popVideoItem($row,$count++%3==0);
				}   
?>
               </ul>
           </div> <!-- end videoList div -->
           
           
      	   <?php backToOverview(""); ?>     
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

function popVideoItem($dbEntry,$clear){
	$date = explode("-",$dbEntry['Datum']);
	$id = $dbEntry['ytID'];
	$imgLoc1= "http://img.youtube.com/vi/";
	$imgLoc2= "/hqdefault.jpg";
?>
   <li class="col-33 <?=$clear?"clearfix":""?>"><span class="nodisp"><?=$id?></span>
   	  
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