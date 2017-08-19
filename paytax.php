<?php
  session_start();
  if(!isset($_SESSION["surname"])){

    header("Location:login.php");
  }
  else{

?>

<?php
require_once("classes/connection.php");
require_once("paytax.php");

$obj = new User();
$obj->setDatabase($serverName,$dbname,$user,$dbpass);
$obj->getDatabase();
$obj->connDatabase();

if (isset($_POST['proceed'])) {
  $taxcategory = $_POST['category'];
  $_SESSION['taxcategory'] = $taxcategory;
  $taxcat = $_SESSION['taxcategory'];

  $describe = $_POST['description'];
  $_SESSION['description'] = $describe;
  $description = $_SESSION['description'];

  $taxarray = $obj->getRow("SELECT amount FROM category WHERE taxcategory ='$taxcat' ");
    foreach ($taxarray as $key => $value) {
      $amount = $value['amount'];
      $_SESSION['amount'] = $amount;
      $taxamount = $_SESSION['amount'];
    }

    header("location:debitcarddetails.php");
}
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
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
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

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="panel">
                    <h4>
                      Select from the list of taxes, and then click on the proceed button.
                    </h4>
                  </div>
                  <div class="col-md-6 col-md-offset-3">
                    <form role="form" action="paytax.php" method="post">
                        <?php

                          require_once("classes/database.php");
                          require_once("classes/connection.php");
                          $obj = new User();
                          $obj->setDatabase($serverName,$dbname,$user,$dbpass);
                          $obj->getDatabase();
                          $obj->connDatabase();
                          //echo $obj->RandomPin() . "<br>";
                          echo "<label for=''>Select Tax Category</label>";
                          $catObj = $obj->dbSelect();
                          //print_r($catObj);

                          echo "<select class='form-control' name='category' required='required'>";
                          echo  "<option value=''>--Please select category--</option>";

                          foreach ($catObj as $value) { ?>
                            <option value="<?php echo $value['taxcategory']?>"><?php echo $value['taxcategory']?></option>
                            <?php } ?>
                        </select>

                      <br>

                      <div class="form-group">
                        <label for="">Short description</label>
                        <textarea type="text" class="form-control" name="description" id="description" cols="40" rows="5"  style="max-width:480px; max-height:130px;" required="required"></textarea>
                      </div>

                      <div class="form-group">
                        <input type='submit' name='proceed' value='Proceed' class='btn btn-success btn-lg'>

                      </div>


                    </form><br><br><br><br><br>
                    <div class="row">
                      <br><br><br><br>

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
