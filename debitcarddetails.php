<?php
  session_start();
  if(!(isset($_SESSION["surname"]))){
    header("location:login.php");
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

    <title>Revenue Mgt System | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <!-- <link href="vendors/nprogress/nprogress.css" rel="stylesheet"> -->

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
                  <li><a><i class="fa fa-user"></i> Profile <span class="fa fa-chevron-down"></span></a></li>
                  <li><a href="paytax.php"><i class="fa fa-money"></i> Pay a tax <span class="fa fa-chevron-down"></span></a></li>
                  <li><a href="paidtaxes.php"><i class="fa fa-desktop"></i> Paid taxes<span class="fa fa-chevron-down"></span></a></li>
                  <li><a href="viewreceipt.php"><i class="fa fa-book"></i> View receipt <span class="fa fa-chevron-down"></span></a></li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a></li>
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
                      require "classes/connection.php";
                    echo "<span alt=''>"; echo $_SESSION['surname']; "</span>";
                      // echo "<h5>" . "". $_SESSION['surname']. "</h5>";
                    ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>

                </li>

                <!-- <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
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

              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel" style="height:700px;" id="formbody">
                  <!-- something goes here -->

                  <h4>Debit Card Details
                    <img src="images/visa.png" alt="Visa" style="margin-left:220px;">
                    <img src="images/mastercard.png" alt="Mastercard">
                    <!-- <img src="images/american-express.png" alt="American Express">
                    <img src="images/paypal.png" alt="Paypal"> -->
                  </h4><hr>

                  <div class="col-lg-6 col-lg-offset-3" id="response" >
                    <!-- <h4>Completely fill out your card details </h4> -->
                    <?php

                        $taxcateg = $_SESSION['taxcategory'];
                        $am = $_SESSION['amount'];

                        echo "<h4 style='color:red'><span class='fa fa-check-circle-o'></span> You have chosen to pay for {$taxcateg} </h4>";
                        echo "<h4 style='color:red'><span class='fa fa-check-circle-o'></span> The sum of N{$am} would be deducted from your bank account </h4><br>";

                        // echo '<span id="response"></span>';

                    ?>

                    <form role="form" id="payform"><br>
                      <div class="form-group">
                        <label for="">Bank Name</label>
                        <input type="text" class="form-control" id="Bankname" required="required">
                      </div>
                      <div class="form-group">
                        <label for="">Card Number</label>
                        <input type="text" class="form-control" id="Cardnumber" required="required">
                      </div>
                      <div class="form-group">
                        <label for="">Card Pin</label>
                        <input type="text" class="form-control" id="Cardpin" required="required">
                      </div>
                      <?php
                          require_once("classes/database.php");
                          require_once("classes/connection.php");
                          $object = new User();
                          $object->setDatabase($serverName,$dbname,$user,$dbpass);
                          $object->getDatabase();
                          $object->connDatabase();
                          $emailSession = $_SESSION['email'];
                          $result = $object->getRow("SELECT * FROM users WHERE email = '$emailSession'");
                            foreach ($result as $value) {
                              $sec_question = $value['sec_question'];
                              $sec_answer = $value['sec_answer'];
                            }
                            echo '<div class="form-group">';
                            echo '  <label for="">Security Question</label><br>';
                                echo '<div class="well" style="color:black">';
                                echo '<h4 class>'.$sec_question.'</h4>';

                                echo '</div>';
                            echo '</div>';

                            echo '<div class="form-group">';
                                echo '<input type="hidden" id="securitydb" value="'.$sec_answer.'">';
                            echo '</div>';

                       ?>
                      <div class="form-group">
                        <label for="">Answer</label>
                        <input type="text" class="form-control" id="Secanswer" required="required">
                      </div>

                      <div class="form-group">

                        <!-- <button class="btn btn-primary btn-lg"  name="complete" data-toggle="modal" data-target="#myModal">
                          Complete
                        </button> -->
                        <input type='submit' id="pay"  value="Pay" class='btn btn-success btn-lg'>

                      </div>
                    </form><br><br>



                    <!-- Modal -->


                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                      aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                          </button>
                          <h4 class="modal-title" id="myModalLabel">
                            This Modal title
                          </h4>
                        </div>
                        <div class="modal-body">
                          Click on close button to check Event functionality.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default"
                          data-dismiss="modal">
                          Close
                        </button>
                        <button type="button" class="btn btn-primary">
                          Submit changes
                        </button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

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
    <script src="js/pay.js"></script>

    <script>
    $(function () { $('#myModal').modal('hide')})});
    </script>
    <script>
    $(function () { $('#myModal').on('hide.bs.modal', function () {
      alert('Hey, I heard you like modals...');})
    });

    $(function (){
      $('#myModal').on('hide.bs.modal')
    });
    </script>

<!-- <script type="text/javascript">

$(document).ready(function() {
    $("#formbody").fadeIn();
  });

    function show_modal() {
      $("#formbody").hide(function(){
        $("#response").fadeIn();

      });

    }

</script> -->

  </body>
</html>

<?php } ?>
