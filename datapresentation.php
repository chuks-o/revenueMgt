<?php
  session_start();
  if(!isset($_SESSION["adminemail"])){

    header("Location:adminlogin.php");
  }
  else{

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Revenue Mgt System | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <!-- CORE CSS -->
      <!-- <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->

      <!-- THEME CSS -->
      <!-- <link href="assets/css/main.css" rel="stylesheet" type="text/css" /> -->
      <link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
      <!-- <link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" /> -->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="in" class="site_title"><i class="fa fa-user"></i> <span>REVENUE MGT SYSTEM</span></a>
            </div>

            <div class="clearfix"></div>
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="admindashboard.php"><i class="fa fa-book"></i> View paid taxes</a></li>
                  <li><a href="addcategory.php"><i class="fa fa-money"></i>Add new tax category</a></li>
                  <li class="active"><a href="datapresentation.php"><i class="fa fa-bar-chart"></i> Data Presentation</a></li>
                  <li><a href="evaders.php"><i class="fa fa-bar-chart"></i> Tax Evaders</a></li>

                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <!-- <h3>ONLINE REVENUE MANAGEMENT SYSTEM</h3> -->
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/img.jpg" alt="">John Doe -->
                    <?php
                    echo "<span alt=''>"; echo $_SESSION['adminsurname']; "</span>";
                      // echo "<h5>" . "". $_SESSION['surname']. "</h5>";
                    ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                  </ul>
                </li>
                <li><a href="adminlogout.php"> Log Out</a></li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">

            </div>

            <!-- <div class="clearfix"></div> -->

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel" style="height:100%;">
                  <div class="panel">
                    <h3>Data Presentation</h3>
                    <!--Chart holder starts here-->
                    <div class="chartholder">
                      <div class="">
                        <div class="col-lg-6 " style="height:400px;">
                          <?php
                          require_once("classes/database.php");
                          require_once("classes/adminclass.php");
                          $presentation = new Admin();
                          $presentation->setDatabase($serverName,$dbname,$user,$dbpass);
                          $data = $presentation->dataPresentation();
                          $sum = $presentation->categorySum();
                          $number = $presentation->getNumberPerCategory();
                          $final = $presentation->finalAmountCategory();
                          $sumtotal = $presentation->taxSum();
                          echo"<h3 class='text-center well'  style='color:#b14;'>Total Revenue: (N)". implode($sumtotal). "</h3>";


                          $result_final = implode(",",$number);
                          $check = array();

                          foreach ($data as $key => $value) {
                            $check[$key] = '"'.$value['taxcategory'].'"';
                          }
                          $category_tax = implode(",",$check);
                          ?>

                        </div>
                      </div>

                      <div id="panel-chartjs-2" class="panel panel-default col-lg-6" style="margin-top:1%;">
                        <div class="panel-heading">
                          <span class="elipsis">
                            <strong> No. of Paid taxes against Tax category</strong>
                          </span>

                          <!-- right options -->
                          <ul class="options pull-right list-inline">
                            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                            <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                            <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                          </ul>
                          <!-- /right options -->
                        </div>

                        <!-- panel content -->
                        <div class="panel-body">
                          <canvas class="chartjs fullwidth height-400" id="barChartCanvas" width="547" height="300"></canvas>
                        </div>
                        <!-- /panel content -->

                      </div>

                    </div><!--Chart holder ends here-

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright 2017.
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>



    <!-- JAVASCRIPT FILES -->
  <script type="text/javascript"> var plugin_path = 'assets/plugins/';</script>
  <script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="assets/js/app.js"></script>
        <!-- PAGE LEVEL SCRIPTS -->
      <script type="text/javascript">
        loadScript(plugin_path + 'chart.chartjs/Chart.min.js', function()
        {
          var barChartCanvas =
          {
            labels : [<?php echo $category_tax;?>],
            datasets : [
                          {
                            fillColor : "rgba(47,196,233,0.5)",
                            strokeColor : "rgba(220,220,220,0.8)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data : [<?php echo $result_final;?>]
                            // data : [0,0,0,9000]
                          }
                       ]
          };
          // barChartCanvas
          var ctx = document.getElementById("barChartCanvas").getContext("2d");
          new Chart(ctx).Bar(barChartCanvas);
        });
      </script>
  </body>
</html>
<?php } ?>
