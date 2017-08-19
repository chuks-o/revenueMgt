<?php
  session_start();
  if(!isset($_SESSION["surname"])){

    header("Location:login.php");
  }
  else{

?>

<?php
  require_once("classes/database.php");
  require_once("classes/connection.php");
  $object = new User();
  $object->setDatabase($serverName,$dbname,$user,$dbpass);
  $object->getDatabase();
  $object->connDatabase();
  $emailSession = $_SESSION['email'];
  $transaction_id = $_GET['tid'];
  //$receipt = $object->displayReceipt("SELECT payment.taxcategory,payment.transaction_id,payment.amount,users.firstname,users.othername FROM payment,users WHERE payment.email_address = '$emailSession' AND payment.transaction_id = 'RMSwrZXegQo' LIMIT 1 ") ;
  $receipt = $object->displayReceipt("SELECT payment.taxcategory,payment.transaction_id,payment.amount,payment.description,payment.datetime,users.homeaddress,users.firstname,users.surname,users.othername,users.mobile,users.email FROM payment LEFT JOIN users ON payment.email_address = users.email WHERE payment.transaction_id = '$transaction_id' LIMIT 1") ;

  // echo "<pre>";
  // print_r($receipt);
  // echo "</pre>";

  foreach ($receipt as $value) {
    $datetime = $value['datetime']. "<br>";
    $format = explode(" ",$datetime);
    $date = $format[0];
    $newdate = date('d-m-Y',strtotime($date));
    $newtime = $format[1];
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
                    <li><a href="logout.php"> Log Out</a></li>
                    <span class=" fa fa-angle-down"></span>
                  </a>

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
                <h3>Receipt </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 style="color:red">Revenue Management Board</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                            <i class="fa fa-globe"></i> Receipt.
                            <small class="pull-right"><?php echo "Date: ". $newdate; ?></small>
                          </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                                          <strong>Revenue Management Board.</strong>
                                          <br>No 45 University Market rd.
                                          <br>Nsukka, Enugu State
                                          <br>Phone: 1 (804) 123-9876
                                          <br>Email: revenueboardnsukka@gmail.com
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address class="">
                            <strong>
                              <?php
                                echo $value['surname'] . " ".  $value['firstname']. " " . $value['othername'];
                              ?>
                            </strong>
                            <br>
                              <?php
                                echo $value['homeaddress'];
                                echo "Phone: (+234) " . $value['mobile']."<br>";
                                echo "Email: " . $value['email'];

                               ?>


                          </address>

                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                          <b>Transaction ID:</b> <?php echo $value['transaction_id']; ?>

                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th>Tax Category</th>
                                <th>Transaction id</th>
                                <th style="width: 59%">Description</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td><?php echo $value['taxcategory'] ?></td>
                                <td><?php echo $value['transaction_id'] ?></td>
                                <td><?php echo $value['description'] ?></td>
                                <td><?php echo "NGN" . $value['amount'] ?></td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <!-- <div class="col-xs-6">
                          <p class="lead">Payment Methods:</p>
                          <img src="images/visa.png" alt="Visa">
                          <img src="images/mastercard.png" alt="Mastercard">
                          <img src="images/american-express.png" alt="American Express">
                          <img src="images/paypal.png" alt="Paypal">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            make sure you
                          </p>
                        </div> -->
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead"><?php
                                              echo $newdate. " " . $newtime;
                                          ?>
                          </p>

                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td><?php echo "NGN" . $value['amount'] ?></td>
                                </tr>

                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-danger btn-lg pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <!-- <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button> -->
                        </div>
                      </div>
                    </section>
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
    <!-- <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <!-- FastClick -->
    <!-- <script src="vendors/fastclick/lib/fastclick.js"></script> -->
    <!-- NProgress -->
    <!-- <script src="vendors/nprogress/nprogress.js"></script> -->

    <!-- Custom Theme Scripts -->
    <!-- <script src="build/js/custom.min.js"></script> -->
  </body>
</html>


<?php } } ?>
