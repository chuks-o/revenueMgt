<?php
  session_start();
  if(!isset($_SESSION["adminemail"])){

    header("Location:adminlogin.php");
  }
  else{

?>

<?php
  require_once("classes/database.php");
  require_once("classes/adminclass.php");

  $object = new Admin();
  $object->setDatabase($serverName,$dbname,$user,$dbpass);
  $object->getDatabase();
  $object->connDatabase();
  $paidTaxes = $object->fetchPaidTaxes("SELECT * FROM payment ORDER BY payment_id DESC");
  $sumtotal = $object->taxSum();
  // echo "<pre>";
  // print_r($sumtotal);
  // echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Revenue Mgt System |  </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="build/css/custom.min.css" rel="stylesheet">
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
                  <li><a href="datapresentation.php"><i class="fa fa-bar-chart"></i> Data Presentation</a></li>
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="adminlogout.php">
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
                <h3>REVENUE MANAGEMENT BOARD</h3>
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/img.jpg" alt="">John Doe -->
                    <?php

                    echo "<span alt=''>"; echo $_SESSION['adminsurname']; "</span>";
                    ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="adminlogout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <?php
                  echo "<h4>" . "Welcome ". $_SESSION['adminsurname']. "</h4>";
                ?>
                <h3><small></small></h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="panel">
                    <h4>
                      Admin Dashboard
                    </h4>

                    <div class="col-md-12" style="margin-top:1%; height:100%;">
                      <div class="well">
                        <h2 class="" style="color:red"><?php   echo "TOTAL: (NGN)" . implode($sumtotal); ?></h2>
                      </div>

                      <table class="table table-hover table-responsive table-bordered">
                        <caption>Paid Taxes</caption>
                        <thead>
                        <tr class="success">
                          <!-- <th>S/N</th> -->
                          <th>Email Address</th>
                          <th>Transaction ID</th>
                          <th>Tax Category</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                              foreach ($paidTaxes as $value) {
                                // for ($i=1; $i <= count($paidTaxes); $i++) {

                                  $useremail = $value['email_address'];
                                  $transaction_id = $value['transaction_id'];
                                  $taxcategory = $value['taxcategory'];
                                  $description = $value['description'];
                                  $amount = $value['amount'];
                                  $datetime = $value['datetime'];
                                  $newdate = explode(" ",date($datetime));
                                  $date = $newdate[0];
                                  $time = $newdate[1];

                                    echo "<tr>
                                    <td>$useremail</td>
                                    <td>$transaction_id</td>
                                    <td>$taxcategory</td>
                                    <td>$description</td>
                                    <td>$amount</td>
                                    <td>$date</td>
                                    <td>$time</td>
                                    <tr>";

                                    // }

                              }

                             ?>
                        </tbody>
                   </table>


                    </div>
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

  </body>
</html>

<?php } ?>
