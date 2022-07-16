<?php
  session_start();
  $errors = array(
    'ID' => '',
    'name' => '',
    'email' => '',
    'mobile' => '',
    'telephone' => '',
    'city' => '',
    'street' => '',
    'postCode' => '',
    'bankName' => '',
    'bankBranch' => '',
    'account' => '',
  );

  if(isset($_POST['next'])){
    $ID = trim($_POST['ID']);
    $name = trim($_POST['name']);

    if(isset($_POST['bankName'])){
      $bankName = trim($_POST['bankName']);
      $bankBranch = trim($_POST['postCode']);
      $account = trim($_POST['account']);
    }

    
  //Check ID
   if(strlen((string) $ID) < 9){
     $errors['ID'] = "The ID must be only 9 digits";
   }

  //Check name
   if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
     $errors['name'] = "You must enter a Valid name";
   }

   if(!array_filter($errors)){
      foreach($_POST as $key => $value){
        $_SESSION['info'][$key] = trim($value);
      }
      $keys = array_keys($_SESSION['info']);
      if(in_array('next', $keys)){
        unset($_SESSION['info']['next']);
      }
      header("Location: step2.php");
   }

  }
?>


