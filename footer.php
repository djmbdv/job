<?php
    require_once "constants/settings.php";
    $prefix = isset($deep_url)?str_repeat("../",$deep_url):"";
?><footer class="footer-wrapper">
    <div class="main-footer">        
        <div class="container">    
            <div class="row">
                <div class="col-sm-12 ">   
                    <div class="row">
                            <div class="footer-about-us text-center">
                                <img class="img img-responsive img-footer" src="<?=$prefix?>images/LOGOBLANCo.png"   alt="Logo" />
                                <!--h4 class="footer-title" style="color: white;">Aqu&iacute;<b>Online</b></h4-->
                                <small>Somos una empresa de servicios de directorios online.</small>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <p class="copy-right">&#169; Copyright <?= date('Y'); ?> Aqui<b>Online</b></p>
                </div>
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
<script type="text/javascript" src="<?=$prefix?>js/customs.js?1"></script>
<script type="text/javascript">
    $(".only-logged").click(e=>{
        e.preventDefault();
        window.location.href = "<?=$prefix?>login.php";
    });
</script>

