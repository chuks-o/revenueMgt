<?php
include "layout/header.php";
?>

<?php
if (isset($_POST['adminlogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once("classes/database.php");
    require_once("classes/adminclass.php");
    $obj = new Admin();
    $obj->setDatabase($serverName,$dbname,$user,$dbpass);
    $obj->getDatabase();
    $obj->connDatabase();
    $obj->adminLogin($email,$password);
}

?>

<div class="row"><br><br>
  <div class="col-lg-4 col-lg-offset-4" style="background-color:#f8f8f9">
    <h2><span class="fa fa-user"></span> Admin Login</h2><br>
    <form role="form" method="post" action="adminlogin.php">
      <div class="form-group">
        <label for="name">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="name">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter Password">
      </div>

      <div class="form-group">
        <div class="checkbox">
          <label>
            <input type="checkbox"> Remember me
          </label>
        </div>
      </div>
      <button type="submit" name="adminlogin" class="btn btn-primary">Login</button><br><br>
    </form>
  </div>
</div>


<?php
include "layout/footer.php";
?>
