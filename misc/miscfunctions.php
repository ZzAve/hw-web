<?php
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
            	<button <?=$disPrev?>> << Vorige pagina </button> 
            </form>
            

<?php 
        $disNext ="";
		if ($last){
			$disNext="disabled";
		}
?>
             <form action="<?=substr(strrchr($_SERVER['PHP_SELF'],"/"),0)."?page=".($page+1) ?>" method="post">
            	<button <?=$disNext?>> Volgende pagina >> </button> 
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
        <button> << Ga terug </button>
    </form>
    </div>
<?php
} // end function backToOverview


function shareDiv(){
	?>
	<!-- Share with.. <div> -->
    <div id="sharediv">                
    <p><strong>Delen:</strong></p>
      <ul>
        <li class="fblike"> 
            <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </li>
        <li> <script type="text/javascript"> 
                //<![CDATA[
                document.write('<div class="g-plusone" data-annotation="inline" data-width="100"></div>');
                //]]>
            </script>
        </li>
        <li> <script type="text/javascript"> 
                //<![CDATA[
                document.write('<a href="https://twitter.com/share" data-text="" class="twitter-share-button" data-lang="nl">Tweeten</a>');
                //]]>
            </script>
        </li>
      </ul>
    </div><!-- end 	share div -->	
<?php   
}

?>

