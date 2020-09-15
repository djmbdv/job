<?php
  require_once '../constants/settings.php';
  require_once '../constants/connection.php';
  require_once 'router.php';
  include_once '../constants/check-login.php';
  if(!$user_online || $_SESSION['myemail'] != ADMIN_EMAIL){
    header("location: ../login.php");
    die();
  }
  if(isset($_GET['p']))
  $page = $_GET['p'];
  else $page = '';
?><!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?=$title_site?> -  Admin </title>
  <link href="../icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/sb-admin-2.min.css?1" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include_once "sidebar_new.php";?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
<?php if(!admin_router($page)): ?>      
      <!-- Main Content -->
      <div id="content">
        <?php include_once "topbar.php"; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Principal</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download fa-sm text-white-50"></i> Generar Reporte</a>
          </div>
          <!-- Content Row -->
          <div class="row">
<?php
  $stmt = $conn->prepare("select count(*) as value from tbl_users where month(created_at) = month(now())");
  $stmt->execute();
  $usuarioMesActual = $stmt->fetchColumn();

  $stmt = $conn->prepare("select count(*) as value from tbl_users");
  $stmt->execute();
  $usuariosTotal = $stmt->fetchColumn();


  $stmt = $conn->prepare("select count(*) as value from tbl_users where verified = 0");
  $stmt->execute();
  $usuariosSinVerificar = $stmt->fetchColumn();

  $stmt = $conn->prepare("select count(*) as value from tbl_jobs ");
  $stmt->execute();
  $publicaciones = $stmt->fetchColumn();
?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuarios Registrados/Este mes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $usuarioMesActual ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de Usuarios</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $usuariosTotal ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pendientes</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$usuariosSinVerificar?></div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-danger" role="progressbar" <?= 'style="width:'.(100 * floatval($usuariosSinVerificar)/floatval($usuariosTotal)).'%;"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-question fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Publicaciones</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $publicaciones ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

          
          </div>

          
        </div>
      </div>
      <!-- End of Main Content -->
<?php endif; ?>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; AquiOnline.co  2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-arrow-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript">
    (function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').show();
    } else {
      $('.scroll-to-top').hide();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery);

function update_table_models(){
  $('.table-dinamics').each((i,e)=>{
    $.get("component.php",{"element":"table","model":$(e).attr("model"), page:$(e).attr("page"), num:$(e).attr("num"),columns:$(e).attr("columns").split(",")},data=>{
      $(e).html(data);
      $(".button-ver-model").click(e=>{
        id = $(e.currentTarget).attr("indice");
        $(".modal-ver-model").modal();
      })
    }); 
  });
  $('.model-pagination').each((i,e)=>{
    $.get("component.php", {"element":"pagination",  page:$('#'+$(e).attr("tabla")).attr("page"), num:$('#'+$(e).attr("tabla")).attr("num")},data=>{
      $(e).html(data);
      $('.page-link').click(ev=>{
        ev.preventDefault();
        $('#'+$(e).attr("tabla")).attr("page",$(ev.currentTarget).attr("page"));
        update_table_models();
      })
    })
  });
}
update_table_models();
$(".select-num").change(e=>{
  $(".table-dinamics").attr("num",$(e.currentTarget).val())
  $(".table-dinamics").attr("page",1);
  update_table_models();
});
!function(t){"use strict";t("#sidebarToggle, #sidebarToggleTop").on("click",function(o){t("body").toggleClass("sidebar-toggled"),t(".sidebar").toggleClass("toggled"),t(".sidebar").hasClass("toggled")&&t(".sidebar .collapse").collapse("hide")}),t(window).resize(function(){t(window).width()<768&&t(".sidebar .collapse").collapse("hide")}),t("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel",function(o){if(768<t(window).width()){var e=o.originalEvent,l=e.wheelDelta||-e.detail;this.scrollTop+=30*(l<0?1:-1),o.preventDefault()}}),t(document).on("scroll",function(){100<t(this).scrollTop()?t(".scroll-to-top").fadeIn():t(".scroll-to-top").fadeOut()}),t(document).on("click","a.scroll-to-top",function(o){var e=t(this);t("html, body").stop().animate({scrollTop:t(e.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}(jQuery);
  </script>
</body>
</html>