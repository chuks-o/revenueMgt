<?php
  session_start();
  if(!isset($_SESSION["surname"])){

    header("Location:login.php");
  }
  else{

?>

<?php

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Revenue Mgt System |  </title>

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
                  <li><a href="profile.php"><i class="fa fa-user"></i> Profile <span class="fa fa-chevron-down"></span></a></li>
                  <li><a href="paytax.php"><i class="fa fa-money"></i> Pay a tax <span class="fa fa-chevron-down"></span></a></li>
                  <li><a href="paidtaxes.php"><i class="fa fa-desktop"></i> Paid taxes<span class="fa fa-chevron-down"></span></a></li>
                  <li><a href="viewreceipt.php"><i class="fa fa-book"></i> View receipt <span class="fa fa-chevron-down"></span></a></li>
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

                    echo "<span alt=''>"; echo $_SESSION['surname']; "</span>";
                      // echo "<h5>" . "". $_SESSION['surname']. "</h5>";
                    ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                  echo "<h4>" . "Welcome ". $_SESSION['surname']. "</h4>";
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
                      Paid Taxes
                    </h4>

                    <div class="col-md-12" style="margin-top:1%; height:100%;">
                      <!-- something goes here -->

                          <?php
                            require_once("classes/database.php");
                            require_once("classes/adminclass.php");

                            $object = new Admin();
                            $object->setDatabase($serverName,$dbname,$user,$dbpass);
                            $object->getDatabase();
                            $object->connDatabase();
                            $emailSession = $_SESSION['email'];
                            $paidTaxes = $object->fetchPaidTaxes("SELECT * FROM payment WHERE email_address ='$emailSession' ORDER BY payment_id DESC");

                            if (count($paidTaxes)== 0) {
                              echo "<div class='well'>
                                <h3 style='color:#b14'>Message: You have not paid any tax yet!</h3>
                              </div>";
                            }
                            else {

                          ?>
                          <table class="table table-hover table-responsive table-bordered">
                            <caption>Paid Taxes</caption>
                            <thead>
                            <tr class="danger">
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
                              $email = $value['email_address'];
                              $transaction_id = $value['transaction_id'];
                              $taxcategory = $value['taxcategory'];
                              $description = $value['description'];
                              $amount = $value['amount'];
                              $datetime = $value['datetime'];
                              $newdate = explode(" ",date($datetime));
                              $date = $newdate[0];
                              $time = $newdate[1];

                              echo "<tr>
                              <td>$email</td>
                              <td>$transaction_id</td>
                              <td>$taxcategory</td>
                              <td>$description</td>
                              <td>$amount</td>
                              <td>$date</td>
                              <td>$time</td>
                              <tr>";
                            }
                              }
                           ?>

                        </tbody>
                      <table>

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

    <!-- <script type="text/javascript">
      $(document).ready(function(){
        $("trans").keyUp(function(){
          alert(this.value);

        });
      });
    </script> -->
  </body>
</html>

<?php } ?>
