<?php
    session_start();

    $ownerId = $_SESSION['ownerId'];
    $flatId = $_SESSION['flatId'];
    $rentPeriod = $_SESSION['rentPeriod'];
    $flatPrice =  $_SESSION['flatPrice'];
    include "config.php";
    if(isset($_SESSION['client'])){
        $customerId = $_SESSION['clientID'];
    }else{
        header("Location: register.php");
    }
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $sql = "SELECT * FROM location INNER JOIN client ON location.Client_ID = client.ID   WHERE location.Client_ID = '$customerId'";
    $statment = $pdo->prepare($sql);
    $statment->execute();
    $customer = $statment->fetch(PDO::FETCH_ASSOC);

    $errors = array('cardNumber' => '', 'expire' => '');
    if(isset($_POST['rent'])){
        $cardNumber = $_POST['cardNumber'];
        $expireDate = $_POST['expire'];
        if(strlen((string) $cardNumber) < 9){
            $errors['cardNumber'] = "The Card Number must be 9 digits";
        }elseif($expireDate <= date("Y-M")){
            $errors['expire'] = "The Card is Expired";
        }else{
            if($_POST['card'] == 'visa'){
                if(!str_starts_with($cardNumber, "111")){
                    $errors['cardNumber'] = "Visa Card Number Must Start with 111";
                }
            }elseif($_POST['card'] == 'masterCard'){
                if(!str_starts_with($cardNumber, "222")){
                    $errors['cardNumber'] = "Master Card Number Must Start with 222";
                }
            }elseif($_POST['card'] == 'express'){
                if(!str_starts_with($cardNumber, "333")){
                    $errors['cardNumber'] = "Visa Card Number Must Start with 333";
                }
            }
        }

        if(!array_filter($errors)){
            $customerName = $customer['Name'];
            $customerMobile = $customer['Mobile'];
            $rent = "INSERT INTO rent (`Owner_ID`, `Customer_ID`, `Customer_Name`, `Customer_Mobile`, `Flat_ID`, `Rent_Period`) VALUES ('$ownerId', '$customerId', '$customerName', '$customerMobile', '$flatId', '$rentPeriod')";
            $stmnt = $pdo->prepare($rent);
            $stmnt->execute();
            if($stmnt){
                header("Location: successful_rent.php");
            }
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Offer Flat</title>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Assessts/CSS/style.css" />
  </head>
  <body>
    <main class="rent form_page">
      <div class="form-container">
        <div class="form-heading">
          <h1>Confirm & Payment</h1>
        </div>
        <form action="rent_confirm.php" method="POST">
            <h2>Your Info</h2>
            <div class="row">
                <div class="col-3 form-group">
                    <label for="id">#ID</label>
                    <input
                    id="id"
                    type="number"
                    name="id"
                    value="<?= $customer['Client_ID'] ?>"
                    readonly
                    />
                </div>
                <div class="col-9 form-group">
                    <label for="id">Name</label>
                    <input
                    id="name"
                    type="text"
                    name="name"
                    value="<?= $customer['Name'] ?>"
                    readonly
                    />
                </div>
            </div>
            <div class="form-group">
                <label for="street">Street Name</label>
                <input
                id="street"
                type="text"
                name="street"
                value="<?= $customer['Street_Name']?>"
                readonly
                />
            </div>
            <h2>Total Payment</h2>
            <div class="total">
                <?php echo intval($flatPrice) * 12 * intval($rentPeriod) ?> $
            </div>
            <h2>Payment</h2>
            <div class="row">
                <div class="col radio-group">
                    <input
                        id="visa"
                        type="radio"
                        name="card"
                        value="visa"
                        checked
                    />
                    <label for="visa">Visa</label>
                </div>
                <div class="col radio-group">
                    <input
                        id="masterCard"
                        type="radio"
                        name="card"
                        value="masterCard"                       
                    />
                    <label for="masterCard">MasterCard</label>
                </div>
                <div class="col radio-group">
                    <input
                        id="express"
                        type="radio"
                        name="card"
                        value="express"                     
                    />
                    <label for="express">American Express</label>
                </div>
            </div> 
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input
                id="cardNumber"
                type="number"
                name="cardNumber"
                placeholder="9 digits Card Number"
                required              
                />
                <?php if(isset($errors['cardNumber'])): ?>
                    <span class="errorMsg">
                    <?php 
                        echo $errors['cardNumber'];
                        $errors['cardNumber'] = '';
                        ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-9 form-group">
                    <label for="bank">Bank Name</label>
                    <input
                    id="bank"
                    type="text"
                    name="bank"
                    placeholder = "Card Issued Bank"
                    required    
                    />
                </div>
                <div class="col-3 form-group">
                    <label for="expire">Expire Date</label>
                    <input
                    id="expire"
                    type="month"
                    name="expire"
                    required              
                    />
                    <?php if(isset($errors['expire'])): ?>
                        <span class="errorMsg">
                        <?php 
                            echo $errors['expire'];
                            $errors['expire'] = '';
                            ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <button class="signinBtn" type="submit" name="rent">Rent</button>
        </form>
      </div>
      <div class="panel-container">
        <img src="Assessts/Img/payment.svg" />
      </div>
    </main>
  </body>
</html>
