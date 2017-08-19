<?php
include ("layout/header.php");
?>
<?php
if (isset($_POST['adminsignup'])) {
  $surname = $_POST['surname'];
  $firstname = $_POST['firstname'];
  $othername = $_POST['othername'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  require_once("classes/database.php");
  require_once("classes/adminclass.php");

  $obj = new Admin();
  $obj->setDatabase($serverName,$dbname,$user,$dbpass);
  $obj->getDatabase();
  $obj->connDatabase();
  $obj->setAdminDetails($surname,$firstname,$othername,$mobile,$email,$password);
  $obj->getAdminDetails();
  $obj->insertRowAdmin();

}
?>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4" style="background-color:#f8f8f9;">
    <h2>Admin Signup</h2><br>
    <form role="form" action="adminsignup.php" method="post">
      <div class="form-group">
        <label for="name">Surname</label>
        <input type="text" class="form-control" name="surname" placeholder="Enter Surname" required="required">
      </div>
      <div class="form-group">
        <label for="name">Firstname</label>
        <input type="text" class="form-control" name="firstname" placeholder="Enter Firstname" required="required">
      </div>
      <div class="form-group">
        <label for="name">Othername</label>
        <input type="text" class="form-control" name="othername" placeholder="Enter Othername" required="required">
      </div>
      <div class="form-group">
        <label for="name">Mobile</label>
        <input type="number" class="form-control" name="mobile" placeholder="Enter Mobile" required="required">
      </div>

      <div class="form-group">
        <label for="name">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter Email" required="required">
      </div>
      <div class="form-group">
        <label for="name">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter Password" required="required">
      </div>

      <button type="submit" name="adminsignup" class="btn btn-primary">Signup</button><br><br>
    </form>
  </div>
</div>
<?php
include ("layout/footer.php");
?>
