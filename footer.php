<div id="push"></div>
</div> <!-- end wrapper div -->

<div id="footer"> 
    <div id="footer-bar"></div>
    <div id="social-media-icons">
        <ul>
           <li id="fb-like"> 
             <script type="text/javascript"> 
               //<![CDATA[
                 var ieversion = 100;
                 if (/MSIE (\d+\.\d+);/.test(navigator.userAgent))
                 { ieversion=new Number(RegExp.$1); }	
                 if (ieversion>=8){
                    document.write('<fb:like href="http://www.facebook.com/HomemadeWater" send="false" layout="button_count" width="80" show_faces="false" font="arial"></fb:like>');
                 }
               //]]>
             </script>
           </li>
           <li id="fb"><a href="http://www.facebook.com/HomemadeWater" target="_blank"><img src="/images/icon_fb.png" alt="Facebook-pagina Homemade Water" title="Facebook pagina"/></a></li>
           <li id="sc"><a href="https://soundcloud.com/homemade-water" target="_blank"><img src="/images/icon_sc.png" alt="Soundcloud-pagina Homemade Water" title="Soundcloud pagina"/></a></li>
           <li id="yt"><a href="http://www.youtube.com/HomemadeWaterOfficia" target="_blank"><img src="/images/icon_yt.png" alt="Youtube-pagina Homemade Water" title="Youtube pagina"/></a></li>
        </ul>
    </div> <!-- end social media icons --> 
    
    
    <div id="copyright">
        <ul>     	
            <li> Neem contact met ons op: <a href="mailto:info@homemadewater.nl" target="_blank"> info@homemadewater.nl</a></li>
            <li><strong>Homemade water</strong> <?= date("Y")?> &copy; All rights reserved</li>
            <li class="hidden"><a href="http://www.homemadewater.nl/sitemap.xml" target="_blank"> Sitemap</a></li>
            <li class="hidden"> keywords: Homemade Water, band, coverband, pop, rock, dutch, nederlands, feestband, clash, coverbands, student, studenten, Laurens Mensink, Andrea Forzoni, Eline Burger, Moos Meijer, Julius van Dis</li>
        </ul>
   </div> <!-- end copyright div-->
</div> <!-- end footer div -->

<?php
	if(isset($mysql)){
		@mysqli_close($mysql);
	}
?>
<!--- ||| scripts ||| -->
    <!-- jquery -->
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
    
    <!-- Facebook SDK import function -->
    <div id="fb-root"></div>
    <script type="text/javascript">(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/nl_NL/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
    
    <!-- Google Analytics script -->
    <script type="text/javascript">(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-41431442-1', 'homemadewater.nl');ga('send', 'pageview');</script>
    
    <!-- main javascript for all pages -->
    <script type="text/javascript" src="/js/main.js"></script>
<!-- ||| end scripts ||| -->