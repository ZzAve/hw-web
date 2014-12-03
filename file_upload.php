<?php 
	require_once 'misc/miscfunctions.php';
	$extra = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/style/file_uploadv1.css\" title=\"style\" />";
	require_once 'header.php';
	
	//check if requests
	// if not redirect to /images/
	$fst = "images";
	$snd = "";
	$thd = "";
	
	
	if ($_GET["fst"] != ""){
		$fst = $_GET["fst"];
		if ($_GET["snd"]!= ""){
			$snd = $_GET["snd"];
			if ($_GET["thd"] != "" ){
				$thd= $_GET["thd"];
			}
		}
	}
	
	
?>

<div id="content-bar">

	<div id="content">
        <h1> Welkom op de site van Homemade Water!</h1>

        <div class="">
<?php 	  // Get for the current folder all files
	
		  // For correct rreferencing, get the weblink.	
		  $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		  $actual_link = substr($actual_link,0,strrpos($actual_link,"/"));
          $curdir=getcwd();
		  //echo "Base: ".$curdir."<br />";
  		  //echo "Actual: ".$actual_link."<br />";

		  $dir = rtrim($curdir."/".$fst."/".$snd."/".$thd,"/")."/";
		  $add_link = rtrim($fst."/".$snd."/".$thd,"/")."/"; 
		  chdir($dir);
		  //echo "New dir: ".$dir."<br />";
		  //echo "Link dir: ".$add_link."<br />";
		  
		  //Check out every folder in the current folder
          $folderlist = glob("*",GLOB_ONLYDIR);
          natsort($folderlist);
		  $count = count($folderlist);
		  //echo print_r($folderlist);
?>			
            <ul>
              <li><a href="<?=$snd==""&&$fst=="images"?"#":"../";?>">[bovenliggende map]</a></li> <!-- terug naar vorige map -->
              <!-- all files and folders within map -->
              
<?php     foreach ($folderlist as $file){
			 $link = $actual_link."/file_upload/".$add_link.$file;
             echo "<li><a href=\"$link/\">$file</a></li>";
          }
?>		   </ul>
		   <ul class="imagelist">
<?php
          $filelist = glob("*.*");
  		  
          sort($filelist);
		  $alwdExt=array("jpg","png","gif","jpeg");
          foreach ($filelist as $file){
			  // only show images. Add a span for the correct link so photos can be shown instantly when clicked upon
			  if (in_array(strtolower(substr(strrchr($file,"."),1)),$alwdExt)){
?> 				<li class="col-25 img">
					<img src="<?=$actual_link."/".$add_link.$file?>" alt="<?=$file?>" title="<?=$file?>"/>
                    <?=$file?>
                </li>
<?php  			$count++;
			  }
		  }
?>
            </ul>
        </div>
<!--        <div class="col-50">
<?php      while ($count>0){ ?>
           	<img src="/images/logo.jpg" alt="de aangeklikte foto" title="de aangeklikte foto"/>
<?php       $count-=40;
		   } ?>
        </div>-->
		
      
    </div> <!-- end content -->    
</div> <!-- end content-bar div -->

<?php require_once 'footer.php'; ?>	
<script type="text/javascript" src="/js/agenda.js"></script>
</body>
</html>

<?php

function compareExtension($a,$b){
	// Sort function to sort an array of filenames based on their extension.
	// If equal, it's based on filename
	//strip filenames
	$a1 = strrchr($a,".");
	$b1 = strrchr($b,".");
	
	//return correct value based on extentions
	if ($a1==$b1){
		//sort on full name
		if (strtolower($a) == strtolower($b)){
			return 0;
		}
		return $a<$b ? -1:1;	
	}
	return $a1<$b1 ? -1:1;		
}

?>