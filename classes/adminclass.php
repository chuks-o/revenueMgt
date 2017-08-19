<?php
/**
 *
 */
 require "database.php";
class Admin
{

  public $connectDB;
  private $serverName,$dbname,$user,$dbpass;
  private $surname,$firstname,$othername,$mobile,$email,$password;

  function __construct()
  {
    # code...
  }

  public function setDatabase($serverName,$dbname,$user,$dbpass){
    $this->serverName = $serverName;
    $this->dbname = $dbname;
    $this->user = $user;
    $this->dbpass = $dbpass;
  }

  public function getDatabase(){
    return $this->serverName;
    return $this->dbname;
    return $this->user;
    return $this->dbpass;
  }


  public function connDatabase(){
    $this->getDatabase();
      try {
        $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
        $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connectDB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception($e->getMessage());

      }
  }

  public function setAdminDetails($surname,$firstname,$othername,$mobile,$email,$password){
    $this->surname = $surname;
    $this->firstname = $firstname;
    $this->othername = $othername;
    $this->mobile = $mobile;
    $this->email = $email;
    $this->password = $password;

  }

  public function getAdminDetails(){
    return $this->surname;
    return $this->firstname;
    return $this->othername;
    return $this->mobile;
    return $this->email;
    return $this->password;
  }

  public function insertRowAdmin(){
    $this->connDatabase();
    $this->getAdminDetails();
    $this->getDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("INSERT INTO admin(surname,firstname,othername,mobile,email,password)VALUES('$this->surname','$this->firstname','$this->othername','$this->mobile','$this->email','$this->password')");
      $result = $stmt->execute();

      if ($result) {
        echo "<div class='col-lg-4 col-lg-offset-4'>";
          echo "<div class='alert alert-success alert-dismissible'>You have signed up successfully, click <a href='adminlogin.php'>here</a> to login</div>";
        echo "</div>";
      }
      return $result;

      }catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function adminLogin($email,$password){
    $this->getDatabase();
    $this->getAdminDetails();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("SELECT * FROM admin WHERE email = '$email' AND password = '$password'");
      $stmt->execute();

      $rows = $stmt->fetch(PDO::FETCH_ASSOC);
      while($rows["email"] == $email && $rows["password"] == $password){
        session_start();
        $_SESSION['adminemail'] = $rows["email"];
        $_SESSION['adminsurname'] = $rows["surname"];
        $_SESSION['adminfirstname'] = $rows["firstname"];
        header("location:admindashboard.php");
      }

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function fetchPaidTaxes($query){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll();

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function taxSum(){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("SELECT SUM(amount) FROM payment");
      $stmt->execute();
      $rows = $stmt->fetch(PDO::FETCH_ASSOC);
      return $rows;

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());

    }
  }
  public function dataPresentation(){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("SELECT DISTINCT taxcategory FROM category");
      $stmt->execute();
      return $stmt->fetchAll();

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());

    }
  }


  public function categorySum(){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt1 = $connectDB->prepare("SELECT SUM(amount) FROM payment WHERE taxcategory = 'event centers'");
      $stmt1->execute();
      $stmt2 = $connectDB->prepare("SELECT SUM(amount) FROM payment WHERE taxcategory = 'fines'");
      $stmt2->execute();
      $stmt3 = $connectDB->prepare("SELECT SUM(amount) FROM payment WHERE taxcategory = 'market levy'");
      $stmt3->execute();
      $stmt4 = $connectDB->prepare("SELECT SUM(amount) FROM payment WHERE taxcategory = 'security'");
      $stmt4->execute();
      $stmt5 = $connectDB->prepare("SELECT SUM(amount) FROM payment WHERE taxcategory = 'waste management'");
      $stmt5->execute();

      $rows = array();

      $rows[] = $stmt1->fetch(PDO::FETCH_ASSOC);
      $rows[] = $stmt2->fetch(PDO::FETCH_ASSOC);
      $rows[] = $stmt3->fetch(PDO::FETCH_ASSOC);
      $rows[] = $stmt4->fetch(PDO::FETCH_ASSOC);
      $rows[] = $stmt5->fetch(PDO::FETCH_ASSOC);


      return $rows;

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());

    }
  }

  public function getNumberPerCategory(){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt1 = $connectDB->prepare("SELECT count(taxcategory) FROM payment WHERE taxcategory = 'event centers'");
      $stmt1->execute();
      $stmt2 = $connectDB->prepare("SELECT count(taxcategory) FROM payment WHERE taxcategory = 'fines'");
      $stmt2->execute();
      $stmt3 = $connectDB->prepare("SELECT count(taxcategory) FROM payment WHERE taxcategory = 'market levy'");
      $stmt3->execute();
      $stmt4 = $connectDB->prepare("SELECT count(taxcategory) FROM payment WHERE taxcategory = 'security'");
      $stmt4->execute();
      $stmt5 = $connectDB->prepare("SELECT count(taxcategory) FROM payment WHERE taxcategory = 'waste management'");
      $stmt5->execute();

      $number = array();
      $result = array();
      $number[] = $stmt1->fetch(PDO::FETCH_ASSOC);
      $number[] = $stmt2->fetch(PDO::FETCH_ASSOC);
      $number[] = $stmt3->fetch(PDO::FETCH_ASSOC);
      $number[] = $stmt4->fetch(PDO::FETCH_ASSOC);
      $number[] = $stmt5->fetch(PDO::FETCH_ASSOC);


      foreach ($number as $key => $value) {
        $result[$key] = $value['count(taxcategory)'];
      }
      return $result;
     } catch (Exception $e) {
    }
  }


  public function addNewTax($tax_cat,$tax_amount){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("INSERT INTO category(taxcategory,amount)VALUES('$tax_cat','$tax_amount')");
      $result = $stmt->execute();
      if ($result) {
        echo "<div class='alert alert-success alert-dismissible text-center'><span class='fa fa-check-circle-o fa-lg'></span> You have added a new tax!</div>";
      }
    } catch (PDOException $e) {

    }
  }


  public function getTaxEvaders() {
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("SELECT * FROM users WHERE paid=0 AND occupation='Trader'");
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }

  }

  public function finalAmountCategory() {
    $this->getDatabase();
    $this->connDatabase();
    $category = $this->dataPresentation();
    $category_sum = $this->categorySum();
    $final = array();
    $okay = array();
    $result = array();

    foreach ($category as $key => $value) {
      $final[$key] = $value['taxcategory'];
    }
    foreach ($category_sum as $key => $value) {
      if (empty($value['SUM(amount)'])) {
        $okay[$key] = 0;
      }
      else {
        # code...
        $okay[$key] = $value['SUM(amount)'];
      }
    }
    $leggo = array_combine($final,$okay);

      echo'<table class="table table-hover table-responsive table-bordered">
      <caption>Sum Total per Category</caption>
      <thead>
      <tr class="danger">
      <!-- <th>S/N</th> -->
      <th>Taxcategory</th>
      <th>SUM (NGN)</th>
      </tr>
      </thead>
      <tbody>';
        foreach ($leggo as $key => $data) {

          echo "<tr>
          <td><h4>$key</h4></td>
          <td><h4>$data</h4></td>
          <tr>";
        }

        echo"</tbody>
      </table>";

  }


}
 ?>
