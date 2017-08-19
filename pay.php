<?php
    session_start();
    require_once("classes/database.php");
    require_once("classes/connection.php");

    $bankname = $_POST['bankname'];
    $cardnumber = $_POST['cardnumber'];
    $cardpin = $_POST['cardpin'];
    $security_answer = $_POST['security'];

    $object = new User();
    $object->setDatabase($serverName,$dbname,$user,$dbpass);
    $object->getDatabase();
    $object->connDatabase();
    $transaction_id = $object->RandomPin();
    $emailSession = $_SESSION['email'];
    $taxcat = $_SESSION['taxcategory'];
    $taxamount = $_SESSION['amount'];
    $description = $_SESSION['description'];

      $cardArray = $object->debitCardArray($emailSession,$transaction_id,$taxcat,$description,$taxamount,$bankname,$cardnumber,$cardpin);
      $object->checkAnswer($emailSession,$security_answer);
      $object->insertPayment($emailSession,$transaction_id,$taxcat,$description,$taxamount);
      $object->updatePaid($emailSession);
      // if ($securitydb == $security_answer) {
      // }

 ?>
