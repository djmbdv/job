<?php
    require_once "constants/settings.php";
    $prefix = isset($deep_url)?str_repeat("../",$deep_url):"";
?><footer class="footer-wrapper">
    <div class="main-footer">        
        <div class="container">    
            <div class="row">
                <div class="col-sm-12 ">   
                    <div class="row">
                            <center class="footer-about-us text-center">
                                <img class="img img-responsive img-footer" src="<?=$prefix?>images/LOGOFINALBLANCO.png"   alt="Logo" />
                                <!--h4 class="footer-title" style="color: white;">Aqu&iacute;<b>Online</b></h4-->
                                <small>Somos una empresa de servicios de directorios online.</small>
                            </center> 
                    </div>
                </div>
            </div>
        </div>
    </div>        
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <center class="col-sm-4 col-md-4">
                    <p class="copy-right">&#169; Copyright <?= date('Y'); ?> Aqui<b>Online</b></p>
                </center>
                <div class="col-sm-4 col-md-4">
                </div>
                <div class="col-sm-4 col-md-4">
                    <ul class="bottom-footer-menu for-social">
                        <li><a href="<?=$tw?>"><i class="ri ri-twitter" data-toggle="tooltip" data-placement="top" title="twitter"></i></a></li>
                        <li><a href="<?=$fb?>"><i class="ri ri-facebook" data-toggle="tooltip" data-placement="top" title="facebook"></i></a></li>
                        <li><a href="<?=$ig?>"><i class="ri ri-instagram" data-toggle="tooltip" data-placement="top" title="instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="whatsapp">
    <a target="_blank"href="https://api.whatsapp.com/send?phone=+573114578317&text=Hola, me gustaria informacion sobre *aqui online*"> <img src="https://contratainternet.co/images/whatsapp.png" > </a>
</div>
<script type="text/javascript" src="<?=$prefix?>js/customs.js?8"></script>
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'ed7f6dd26db567d478d56e42c2118b72ffd52e19';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[1];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
$(".only-logged").click(e=>{
    e.preventDefault();
    window.location.href = "<?=$prefix?>login.php";
});
</script>
