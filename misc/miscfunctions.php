<?php
// active database;
$active_db = -1;
$previous_db=-1;
$mysqlhost = 'homemadewater.nl';
$mysql = NULL;

function db_connect($type){
	global $active_db, $previous_db, $mysqlhost,$mysql;
	if ($active_db != -1){
      if ($type == $active_db){ // you are already connected
		return true;
	  } else {
		//close old db. Save active db
		mysqli_close($mysql);
		$previous_db = $active_db;
	  }
	}
	
	// connect to db
	switch ($type){
		case 0: // db-read
			// Create connection with db
			$user = 'juliuqb30_HWsite';
			$passwd = 'Jelam';
			$db = 'juliuqb30_hw';
			break;
		case 1: // db-guestRead
			// Create connection with db
			$user = 'juliuqb30_HWsite';
			$passwd = 'Jelam';
			$db = 'juliuqb30_hw2';
			break;
		case 2: // db-guestPost
			// Create connection with db
			$user = 'juliuqb30_hw2';
			$passwd = 'oj1WR0fH';
			$db = 'juliuqb30_hw2';			
			break;
		case -1:
			return ('Could not connect: Wrong db type: '.$type);
	}
	
	$mysql = mysqli_connect($mysqlhost,$user, $passwd, $db);
    if (!$mysql) {
        return ('Could not connect: ' . mysql_error());
 	} else {
		$active_db =$type;	
		return true;
	}
}

function db_restore(){
	global $previous_db;
	if ($previous_db != -1){
		return db_connect($previous_db);
	} else {
		return true;
	}
}

/*
Function PAGINATION puts in a div, with the text 'vorige pagina' and 'volgende pagina'. It dynamically determines what the next or previous page is based on what is currently shown.
*
Input:
  $page 	the current page number
  $last 	boolean variable stating whether the current page is the last one
*
Output:
  one <div> of class 'morenews', which holds two <button> elements, for both the previous and next news page respectively.
*/
function pagination($page,$last){
?>
        <!-- Allow visitor to see more news -->
        <div class="navigate pagination">
<?php 		//determine acitve or non active link 
			$disPrev="";
			if ($page==1){
				$disPrev = "disabled";
			}
?>
            <form action="<?= substr(strrchr($_SERVER['PHP_SELF'],"/"),0)."?page=".($page-1)?>" method="post">
            	<button <?=$disPrev?>> &laquo;  Vorige pagina </button> 
            </form>
            

<?php 
        $disNext ="";
		if ($last){
			$disNext="disabled";
		}
?>
             <form action="<?=substr(strrchr($_SERVER['PHP_SELF'],"/"),0)."?page=".($page+1) ?>" method="post">
            	<button <?=$disNext?>> Volgende pagina &raquo; </button> 
            </form>
        </div>  
<?php     	
} // end function pagination


/*
Function Back
*/
function backToOverview($request){
?>
    <div class="navigate back">
    <form action="<?=substr(strrchr($_SERVER['PHP_SELF'],"/"),0).($request ? $request : "") ?>" method="post">
        <button> &laquo; Ga terug </button>
    </form>
    </div>
<?php
} // end function backToOverview

/*
Function more
*/
function moreOf($link){
?>
    <div class="navigate more">
    <form action="<?=$link?>" method="post">
        <button> Klik hier voor meer . . .  </button>
    </form>
    </div>
<?php
} // end function moreOf


function shareDiv(){
	?>
	<!-- Share with.. <div> -->
    <div id="sharediv" class="hiddenWell" style="overflow: hidden;">                
      <ul>
		<li class="title"> <strong>Deel dit met anderen: </strong></li>
        <li class="fblike">
        	<ul>
        		<li> 
            		<div class="fb-like" data-href="<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>" data-width="100" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
        		</li>
                <li>
                	<div class="fb-share-button" data-href="<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>" data-width="100" data-type="button_count"></div>
                </li>
        	</ul>
        </li>
        <li><ul>
            <li> 
                <script type="text/javascript"> 
                    //<![CDATA[
                        document.write('<div class="g-plusone" data-annotation="inline" data-width="250"></div>');
                    //]]>
                </script>
            </li>
            <li> <script type="text/javascript"> 
                    //<![CDATA[
                    document.write('<a href="https://twitter.com/share" data-text="" class="twitter-share-button" data-lang="nl">Tweeten</a>');
                    //]]>
                </script>
            </li>
       	</ul></li>
      </ul>

    </div><!-- end 	share div -->	
<?php   
}

?>

