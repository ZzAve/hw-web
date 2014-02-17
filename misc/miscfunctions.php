<?php
/*
Function M<link rel="stylesheet" type="text/css" href="/hw-web/style/main.css">OREOF puts in a div, with the text 'vorige pagina' and 'volgende pagina'. It dynamically determines what the next or previous page is based on what is currently shown.
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
        <div class="morenews">
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


?>