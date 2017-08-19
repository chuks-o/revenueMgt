<?php
  if (isset($_POST['login'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      require_once("classes/database.php");
      require_once("classes/connection.php");
      $obj = new User();
      $obj->setDatabase($serverName,$dbname,$user,$dbpass);
      $obj->getDatabase();
      $obj->connDatabase();
      $obj->setLogin($email,$password);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RMS | Index</title>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="bootstrap/bootstrap.min.css" rel="stylesheet"> -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="style.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/basic.style.css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
    <body>

  <nav id="mainNav" class="nav navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#page-top"><span class="fa fa-money"></span> ONLINE REVENUE MANAGEMENT SYSTEM</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">

          <li class=""> <a class="dropdown-toggle" href="signup.php">Signup <i class="fa fa-sign-in"></i><span class="caret"></span> </a></li>
          <li class=""> <a class="dropdown-toggle" href="login.php">Login </a></li>
        </ul>
      </div><!-- /.navbar-collapse -->

    </div>
  </nav>
      <div class="hero-unit col-lg-8">

      </div>
      <div class="col-lg-4" style="margin-left:50px;"><br><br><br><br><br><br>
        <div class="row"><br><br>
          <!-- <div class="col-lg-4 col-lg-offset-4 well" > -->
            <h2><span class="fa fa-users"></span> User Login</h2><br>
            <form role="form" method="post" action="index.php">
              <div class="form-group">
                <label for="name">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="name">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
              </div>

              <button type="submit" name="login" class="btn btn-primary btn-lg ">Login</button><br><br>
            </form>
          <!-- </div> -->
        </div>

      </div>
    <!-- </div> -->



        <footer class="footer pull-right">
          <span>Copyright 2017</span>
        </footer>


          <!-- jQuery -->
          <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
         <!-- Bootstrap Core JavaScript -->
         <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
