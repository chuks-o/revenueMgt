<?php
/**
 *
 */
 require "database.php";
class User
{
  protected $connectDB;
  public $isConn,$emailSession;
  protected $cardpin,$cardnumber,$bankname,$sec_answer,$description;
  private $transaction_id,$taxcategory,$amount,$bankName,$cardNumber,$card_pin;
  public $surname,$firstname,$othername,$mobile,$occupation,$homeaddress,$dob,$email,$password;
  public $serverName,$dbname,$user,$dbpass;
  public $sec_question;

    function __construct()
    {
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

  public function getRow($query){
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

  public function getProfile($emailSession){
    $this->getDatabase();
    $this->connDatabase();
    try {
          $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
          $stmt = $connectDB->prepare("SELECT * FROM users WHERE email = '$emailSession'");
          $stmt->execute();
          //$rows =$stmt->fetch(PDO::FETCH_ASSOC);
          while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Surname: " . $rows['surname'] . "<br>";
            echo "Firstname: " .$rows['firstname'] . "<br>";
            echo "Othername: " .$rows['othername'] ."<br>";
            echo "Mobile: " .$rows['mobile'] ."<br>";
            echo "Occupation: " .$rows['occupation'] ."<br>";
            echo "DOB: " .$rows['dob'] ."<br>";
            echo "Email: " .$rows['email'] ."<br>";
            echo "Home Address: " .$rows['homeaddress'] . "<br>";
        }
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function setUserDetails($surname,$firstname,$othername,$mobile,$occupation,$homeaddress,$dob,$email,$password,$sec_question,$sec_answer){
    $this->surname = $surname;
    $this->firstname = $firstname;
    $this->othername = $othername;
    $this->mobile = $mobile;
    $this->occupation = $occupation;
    $this->homeaddress = $homeaddress;
    $this->dob = $dob;
    $this->email = $email;
    $this->password = $password;
    $this->sec_question = $sec_question;
    $this->sec_answer = $sec_answer;

  }

  public function getUserDetails(){
    return $this->surname;
    return $this->firstname;
    return $this->othername;
    return $this->mobile;
    return $this->occupation;
    return $this->homeaddress;
    return $this->dob;
    return $this->email;
    return $this->password;
    return $this->$sec_question;
    return $this->sec_answer;
  }

  public function insertRow(){
    $this->getDatabase();
    $this->connDatabase();
    $this->getUserDetails();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("SELECT * FROM users");
      $stmt->execute();

      $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        while($rows['email'] == $this->email){
          die("Email already exists. Select another email address");
        }

      $stmt = $connectDB->prepare("INSERT INTO users(surname,firstname,othername,mobile,occupation,homeaddress,dob,email,password,sec_question,sec_answer)VALUES('$this->surname','$this->firstname','$this->othername','$this->mobile','$this->occupation','$this->homeaddress','$this->dob','$this->email','$this->password','$this->sec_question','$this->sec_answer')");
      $result = $stmt->execute();

      if ($result) {
        echo "<br>";
        echo "<div class='col-lg-4 col-lg-offset-4'>";
          echo "<div class='alert alert-success alert-dismissible'>You have successfully signed up, Click <a href='index.php'>here</a> to login</div>";
        echo "</div>";

      }
      return $result;

      }catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function setLogin($email,$password){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
      $stmt->execute();

      $rows = $stmt->fetch(PDO::FETCH_ASSOC);
      if($rows["email"] == $email && $rows["password"] == $password){
        session_start();
        $_SESSION['email'] =  $rows['email'];
        $_SESSION ['surname'] = $rows["surname"];
        $this->updatePaid($_SESSION['email']);
        header("location:dashboard.php");
      }
      else{
        die("Incorrect email or password");
      }
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }

  }

  public function deleteRow(){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare($query);
      return $stmt->execute();
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());

    }

  }

  public function dbSelect(){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("SELECT * FROM category");
      $stmt->execute();
      return $stmt->fetchAll();

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
    //return $set;
  }

  public function RandomPin(){
    $charset = array_merge(range('a','z'),range('A','Z'),range(0,9));
    shuffle($charset);
    $revenue = array('R','M','S');
    $sliced = array_slice($charset,0,8);
    $transpin = array_merge($revenue,$sliced);
    return implode('', $transpin);
  }

  public function setCardDetails($bankname,$cardnumber,$cardpin){
    $this->bankname = $bankname;
    $this->cardnumber = $cardnumber;
    $this->cardpin = $cardpin;
  }

  public function getCardDetails(){
    return $this->bankname;
    return $this->cardnumber;
    return $this->cardpin;
  }

  public function insertCardDetails($emailSession){
    $this->getCardDetails();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("UPDATE users SET bankname = '$this->bankname',cardnumber ='$this->cardnumber',cardpin ='$this->cardpin' WHERE email = '$emailSession' ");
      $result = $stmt->execute();

    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function debitCardArray($emailSession,$transaction_id,$taxcategory,$description,$amount,$bankname,$cardnumber,$cardpin){
      $cardDetails = array();
      $cardArray = array_push($cardDetails, "$emailSession", "$transaction_id", "$taxcategory", "$description", "$amount", "$bankname", "$cardnumber", "$cardpin");
        foreach ($cardDetails as $value) {
          if (empty($value)) {
            die("<h4 style='color:red'>Incomplete debit card details<h4>");

          }
        }
      return $cardDetails;
  }


  public function checkAnswer($usersession,$answer){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $feeds = $connectDB->prepare("SELECT * FROM users WHERE email = '$usersession' AND sec_answer = '$answer'");
      $feeds->execute();
      switch($feeds->rowCount())
      {
        case 1:
        return true;
        break;

        case 0:
        die("Incorrect Security Answer");
        break;
      }
    }
    catch(PDOException $e){
      throw new Exception($e->getMessage());

    }
  }


  public function insertPayment($emailSession,$transaction_id,$taxcategory,$description,$amount){
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("INSERT INTO payment(email_address,transaction_id,taxcategory,description,amount)VALUES('$emailSession','$transaction_id','$taxcategory','$description','$amount')");
      $response = $stmt->execute();

      if ($response) {
        echo "<div class='col-lg-8 col-lg-offset-2'>";
        echo "<div class='alert alert-success alert-dismissible'>Payment was processed successfully</div>";
        echo "</div>";

        echo "<div class='col-lg-4 col-lg-offset-4'>";
        echo "<a href='receipt.php?tid=$transaction_id' class='btn btn-danger btn-lg' name='gen_invoice'>Print Receipt</a>";
        echo "</div>";
      }
      else {
        echo "Payment failed";
      }

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function displayReceipt($query){
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

  public function fetchReceipt($query){
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

  public function paidTaxes($query){
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

  public function updatePaid($emailSession) {
    $this->getDatabase();
    $this->connDatabase();
    try {
      $paidcount = $this->getCountOfPaid($emailSession);
      if ($paidcount > 0) {
        $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
        $stmt = $connectDB->prepare("UPDATE users SET paid ='$paidcount' WHERE email='$emailSession'");
        $result = $stmt->execute();
        // if ($result) {
        //   echo "YES";
        // }
        // else {
        //   echo "NO";
        // }
      }
      else {
        if ($paidcount < 1) {
          $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
          $stmt = $connectDB->prepare("UPDATE users SET paid =0 WHERE email='$emailSession'");
          $stmt->execute();
        }
      }

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function getCountOfPaid($emailSession) {
    $this->getDatabase();
    $this->connDatabase();
    try {
      $connectDB = new PDO("mysql:host=$this->serverName;dbname=$this->dbname",$this->user,$this->dbpass);
      $stmt = $connectDB->prepare("SELECT payment.taxcategory,payment.transaction_id,payment.amount,payment.description,payment.datetime,users.homeaddress,users.firstname,users.surname,users.othername,users.mobile,users.email FROM payment LEFT JOIN users ON payment.email_address = users.email WHERE users.occupation = 'Trader' and payment.email_address='$emailSession'");
      $stmt->execute();
      $Countarray = $stmt->fetchAll();

      $paidcount = count($Countarray);
      return $paidcount;

    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }




}
?>
