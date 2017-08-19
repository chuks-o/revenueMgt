<?php
include ("layout/header.php");
?>
<?php
if (isset($_POST['signup'])) {
  $surname = $_POST['surname'];
  $firstname = $_POST['firstname'];
  $othername = $_POST['othername'];
  $mobile = $_POST['mobile'];
  $occupation = $_POST['occupation'];
  $homeaddress = $_POST['homeaddress'];
  $dob = $_POST['dob'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $security_question = "What is the name of your favourite uncle?";
  $sec_answer = $_POST['sec_answer'];

  require_once("classes/database.php");
  require_once("classes/connection.php");

  $obj = new User();
  $obj->setDatabase($serverName,$dbname,$user,$dbpass);
  $obj->setUserDetails($surname,$firstname,$othername,$mobile,$occupation,$homeaddress,$dob,$email,$password,$security_question,$sec_answer);
  $obj->insertRow();

}
?>

<div class="row"> <br><br>

  <div class="col-lg-4 col-lg-offset-4" style="background-color:#f8f8f9;border:1px solid #ccc; border-radius:5px;">
    <h2 style="color:#2A3F54;"><span class="fa fa-users"></span> User Signup</h2><br>
    <form role="form" action="signup.php" method="post">
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
        <label for="name">Occupation</label>
        <input type="text" class="form-control" name="occupation" placeholder="Enter Occupation" required="required">
      </div>
      <div class="form-group">
        <label for="name">Home Address</label>
          <textarea name="homeaddress" class="form-control" rows="5" cols="40" style="max-height:120px; max-width:410px;" required="required"></textarea>
      </div>
      <div class="form-group">
        <label for="name">Date of Birth</label>
        <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth" required="required">
      </div>
      <div class="form-group">
        <label for="name">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter Email" required="required">
      </div>
      <div class="form-group">
        <label for="name">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter Password" required="required">
      </div>

      <div class="form-group">
        <label for="name">Security Question</label>
        <input  style="color:red" type="text" class="form-control" value="What is the name of your favourite uncle?" name="secquestion" disabled="disabled">
      </div>
      <div class="form-group">
        <label for="security question">Security Answer</label>
        <input type="text" class="form-control" name="sec_answer" placeholder="answer" required="required">
      </div>

      <button type="submit" name="signup" class="btn btn-primary btn-lg">Sign up</button><br><br>
    </form>
  </div>
</div>
<br><br>
<?php
include ("layout/footer.php");
?>
